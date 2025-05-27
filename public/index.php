<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE);
// ini_set('display_errors', 0);

date_default_timezone_set('America/Araguaina');

// Tempo limite da sessão (6 horas)
$timeout = 60 * 60 * 6;

ini_set('session.gc_maxlifetime', $timeout);
ini_set('session.cookie_lifetime', $timeout);
session_start();

// Autoload do Composer
require __DIR__ . '/../vendor/autoload.php';

use App\Core\Environment;
use App\Core\Database;
use App\Core\RouterBase;

// Carrega variáveis de ambiente
Environment::load();

// Inicializa o banco de dados com Eloquent
Database::initialize();
if (!Database::testConnection()) {
    echo "<pre>";
    print_r(Database::getErrorConnection());
    echo "<hr>";
    print_r(Database::getConfig());
    die('Erro ao conectar ao banco de dados. Verifique as configurações.');
}


// Importa todas as rotas automaticamente
foreach (glob(__DIR__ . '/../routes/*.php') as $routeFile) {
    require $routeFile;
}

// Inicializa o roteador base
$router = new RouterBase();
$router->run();
