# Sistema Biblioteca – Teste Técnico PHP

Projeto desenvolvido em **PHP 8+**, Eloquent ORM (standalone), padrão MVC e MySQL, utilizando Docker, Composer, TailwindCSS nas telas principais e Bootstrap 5 nos relatórios.

---

## Estrutura do Projeto

* `app/Controllers` – Lógica das requisições (Controllers MVC)
* `app/Models` – Modelos Eloquent (ORM)
* `app/Core` – Lógica de roteamento, Requests e controller base da aplicacao
* `app/Views` – Templates HTML/PHP (telas do sistema, relatórios, partials)
* `app/Middlewares` – Middlewares de autenticação/permissão
* `config/` – Configurações do sistema, helpers globais e conexão com banco
* `public/` – Arquivos acessíveis via navegador (index.php, assets)
* `routes/` – Arquivos de rotas da aplicação
* `docker/` – Infraestrutura Docker (MySQL, scripts de init)
* `tests/` – (Opcional) Testes PHPUnit
* `.env.example` – Exemplo de variáveis de ambiente

---

## Como rodar o projeto

1. **Clone o repositório:**
   ```
   git clone https://github.com/lRafaelOliveira/teste-especialistaPHP.git
   cd teste-especialistaPHP
   ```

2. **Configure o ambiente:**
   ```
   cp .env.example .env
   ```

3. **Suba o ambiente Docker:**
   ```
   docker-compose up -d --build
   ```

4. **Acesse pelo navegador:**
   - [http://localhost:8080](http://localhost:8080)

---

## Scripts do Banco de Dados

* O script de criação das tabelas, procedures e view está em `docker/mysql/init/init.sql`
* Ao subir o container, tudo é criado automaticamente no primeiro start.
* Para executar manualmente:
  ```
  docker-compose exec db mysql -uroot -p biblioteca < ./docker/mysql/init/init.sql
  ```

---

## Funcionalidades

* CRUD completo de Livros, Autores e Assuntos (relacionamentos N:N)
* Autenticação de usuários (login e registro)
* Máscara de valor monetário (R$)
* Relatório de livros por view SQL, com filtros de título, autor e assunto
* Mensagens flash de sucesso/erro
* Docker para fácil setup em qualquer ambiente

---

## Como usar

1. Cadastre um usuário em `/register`
2. Faça login em `/login`
3. Gerencie livros, autores e assuntos pelo painel principal
4. Gere relatórios completos e filtrados em `/relatorios/livros`

---

## Autor

Desenvolvido por **Rafael Oliveira**  
* GitHub: [lRafaelOliveira](https://github.com/lRafaelOliveira)
* LinkedIn: [linkedin.com/in/dev-rafaeloliveira/](https://www.linkedin.com/in/dev-rafaeloliveira/)

---


# Tests com PHPUnit 
### Para rodar os testes utilize o comando: 
``` docker-compose exec app ./vendor/bin/phpunit tests```