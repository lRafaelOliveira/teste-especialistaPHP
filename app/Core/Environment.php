<?php

namespace App\Core;


class Environment
{
    public static function load()
    {
        // Com Dotenv do Symfony

        $APP_ENV = "development";
        $dir = __DIR__."/../../";


        $envFile = $APP_ENV == "development" ? $dir . "/.env" : $dir . "/.env.prod";

        if (!file_exists($envFile)) {
            die("Arquivo de ambiente não encontrado: " . $envFile);
        }

        $lines = file($envFile);

        // Função de callback que verifica se o valor não é vazio
        $filteredArray = array_filter($lines, function ($value) {
            return !empty(trim($value)) && strpos($value, '=') !== false;
        });

        // Reindexa o array para remover os índices vazios
        $lines = array_values($filteredArray);
        foreach ($lines as $line) {
            if ($line != "") {
                putenv(trim($line));
            }
        }
    }
}
