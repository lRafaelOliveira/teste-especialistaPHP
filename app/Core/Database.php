<?php

namespace App\Core;

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Builder as SchemaBuilder;

class Database
{
    protected static $capsule;

    public static function initialize()
    {
        Environment::load(__DIR__ . '/../');

        if (!self::$capsule) {
            self::$capsule = new Capsule;

            // Carrega o arquivo de configuração de conexões
            $dbConfig = require_once __DIR__ . '/../../config/database.php';
            // debug($dbConfig, true);
            // Inicializa apenas a conexão padrão
            if (isset($dbConfig['default'])) {
                self::$capsule->addConnection($dbConfig['default'], 'default');
            }

            // Disponibiliza o Eloquent globalmente e inicializa
            self::$capsule->setAsGlobal();
            self::$capsule->bootEloquent();
        }

        return self::$capsule;
    }

    // Método estático para retornar o Schema
    public static function schema(): SchemaBuilder
    {
        return self::$capsule->schema();
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
