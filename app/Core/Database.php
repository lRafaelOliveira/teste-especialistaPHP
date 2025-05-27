<?php

namespace App\Core;

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Builder as SchemaBuilder;

class Database
{
    protected static $capsule;
    private static $dbConfig;
    private static $errorConnection;

    public static function initialize()
    {
        Environment::load(__DIR__ . '/../');

        if (!self::$capsule) {
            self::$capsule = new Capsule;

            // Carrega o arquivo de configuração de conexões
            self::$dbConfig = require_once __DIR__ . '/../../config/database.php';
            // Inicializa apenas a conexão padrão
            if (isset(self::$dbConfig['default'])) {
                self::$capsule->addConnection(self::$dbConfig['default'], 'default');
            }

            // Disponibiliza o Eloquent globalmente e inicializa
            self::$capsule->setAsGlobal();
            self::$capsule->bootEloquent();
        }

        return self::$capsule;
    }
    // Testa se a conexão com o banco está funcionando
    public static function testConnection($connection = 'default')
    {
        try {
            if (!self::$capsule) {
                self::initialize();
            }
            $conn = self::$capsule->getConnection($connection);
            // Executa um teste simples
            $conn->select('SELECT 1');
            return true;
        } catch (\Exception $e) {
            // Se quiser logar, coloque aqui
            self::$errorConnection = $e->getMessage();
            return false;
        }
    }

    // Método estático para retornar o Schema
    public static function schema(): SchemaBuilder
    {
        return self::$capsule->schema();
    }

    // método estático para obter os dados de configuração do banco
    public static function getConfig()
    {
        if (!self::$dbConfig) {
            self::$dbConfig = require __DIR__ . '/../../config/database.php';
        }
        return self::$dbConfig;
    }
    public static function getErrorConnection()
    {
        return self::$errorConnection;
    }


    // Método estático para obter uma conexão específica sob demanda
    public static function connection($connection = 'default')
    {
        // Garante que o Capsule foi inicializado
        if (!self::$capsule) {
            self::initialize([$connection]);
        }
        $dbManager = self::$capsule->getDatabaseManager();
        // Verifica se a conexão foi configurada
        if (!array_key_exists($connection, $dbManager->getConnections())) {
            // Carrega o arquivo de configuração
            $dbConfig = require __DIR__ . '/../database/config.php';

            // Adiciona a conexão, se configurada
            if (isset($dbConfig[$connection])) {
                self::$capsule->addConnection($dbConfig[$connection], $connection);
            } else {
                throw new \Exception("Configuração para a conexão '{$connection}' não encontrada.");
            }
        }

        // Retorna a conexão solicitada
        return $dbManager->connection($connection);
    }
}
