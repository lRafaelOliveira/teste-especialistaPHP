CREATE DATABASE IF NOT EXISTS biblioteca;

USE biblioteca;

-- Tabela de usuários
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(50) DEFAULT 'user'
);

-- Tabela de autores
CREATE TABLE autores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL
);

-- Tabela de assuntos
CREATE TABLE assuntos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    descricao VARCHAR(255) NOT NULL
);

-- Tabela de livros (agora com user_id)
CREATE TABLE livros (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL,
    valor DECIMAL(10,2) NOT NULL,
    data_publicacao DATE NOT NULL,
    user_id INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Tabela de relacionamento livro-autor (muitos para muitos)
CREATE TABLE livro_autor (
    livro_id INT NOT NULL,
    autor_id INT NOT NULL,
    PRIMARY KEY (livro_id, autor_id),
    FOREIGN KEY (livro_id) REFERENCES livros(id) ON DELETE CASCADE,
    FOREIGN KEY (autor_id) REFERENCES autores(id) ON DELETE CASCADE
);

-- Tabela de relacionamento livro-assunto (muitos para muitos)
CREATE TABLE livro_assunto (
    livro_id INT NOT NULL,
    assunto_id INT NOT NULL,
    PRIMARY KEY (livro_id, assunto_id),
    FOREIGN KEY (livro_id) REFERENCES livros(id) ON DELETE CASCADE,
    FOREIGN KEY (assunto_id) REFERENCES assuntos(id) ON DELETE CASCADE
);

-- Tabela de auditoria para livros
CREATE TABLE auditoria_livro (
    id INT AUTO_INCREMENT PRIMARY KEY,
    livro_id INT,
    acao VARCHAR(20),
    data_evento DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- View de relatório agrupando por autor
CREATE OR REPLACE VIEW vw_relatorio_livros AS
SELECT 
    a.nome AS autor,
    l.titulo AS livro,
    l.valor,
    l.data_publicacao,
    s.descricao AS assunto,
    u.name AS usuario
FROM 
    livros l
JOIN users u ON l.user_id = u.id
JOIN livro_autor la ON l.id = la.livro_id
JOIN autores a ON la.autor_id = a.id
JOIN livro_assunto ls ON l.id = ls.livro_id
JOIN assuntos s ON ls.assunto_id = s.id
ORDER BY a.nome, l.titulo;

-- Trigger de auditoria (exemplo para INSERT)
DELIMITER //
CREATE TRIGGER tg_auditoria_livro AFTER INSERT ON livros
FOR EACH ROW
BEGIN
    INSERT INTO auditoria_livro (livro_id, acao) VALUES (NEW.id, 'INSERCAO');
END;
//
DELIMITER ;

-- Procedure para atualizar valor em massa
DELIMITER //
CREATE PROCEDURE atualizar_valor_livros(IN percentual DECIMAL(5,2))
BEGIN
    UPDATE livros SET valor = valor * (1 + percentual/100);
END;
//
DELIMITER ;

-- Procedure para criar novo Autor 
DELIMITER $$

CREATE PROCEDURE sp_criar_autor (
    IN p_nome VARCHAR(255)
)
BEGIN
    -- Opcional: verifica se já existe
    IF EXISTS (SELECT 1 FROM autores WHERE nome = p_nome) THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Autor já cadastrado!';
    ELSE
        INSERT INTO autores (nome) VALUES (p_nome);
    END IF;
END$$

DELIMITER ;

-- Procedue para criar novo assunto 
DELIMITER $$

CREATE PROCEDURE sp_criar_assunto (
    IN p_descricao VARCHAR(255)
)
BEGIN
    -- Opcional: verifica se já existe
    IF EXISTS (SELECT 1 FROM assuntos WHERE descricao = p_descricao) THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Assunto já cadastrado!';
    ELSE
        INSERT INTO assuntos (descricao) VALUES (p_descricao);
    END IF;
END$$

DELIMITER ;
