<?php

/**
 * Valida se é uma senha Válida]
 * @param string $password
 * @return bool
 */
function is_passwd(string $password)
{
    return (mb_strlen($password) >= CONF_PASSWD_MIN_LEN && mb_strlen($password) <= CONF_PASSWD_MAX_LEN ? true : false);
}

/**
 * gera um Hach MD5 de uma senha
 * @param string $password]
 * @return bool
 */
function passwd(string $password)
{
    return md5($password);
}
/**
 * Verifica se a senha é válida e se o hash bate com o gerado
 */
function verify_passwd(string $password, string $hash)
{
    return passwd($password) === $hash;
}
/**
 * verifica se o usuário está logado
 * @return bool
 */
function is_logged()
{
    return isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
}

function is_admin()
{
    return isset($_SESSION['is_admin']) && !empty($_SESSION['is_admin']);
}
/**
 * 
 * Funcao para debugar dados
 * @param mixed $data
 * @param bool $die
 */
function debug($data, $die = false)
{
    $style = "max-width: 100%; word-wrap: break-word;background-color:#ccc;font-size:15px;font-family: Consolas, Courier New, monospace;padding:20px;";
    echo "<div style='$style'>";
    echo "<hr>";
    echo "<pre style='white-space: pre-wrap;'>";
    print_r($data);
    echo "</pre>";
    echo "<hr>";
    echo "</div>";
    if ($die) {
        die();
    }
}
