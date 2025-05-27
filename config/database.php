<?php
return [
    'default' => [
        'driver' => 'mysql',
        'host' => getenv('DB_HOST'),
        'database' => getenv('DB_DATABASE'),
        'username' => getenv('DB_USERNAME'),
        'password' => getenv('DB_PASSWORD'),
        'port' => getenv('DB_PORT'),
        'options'   => [
            PDO::ATTR_TIMEOUT => 3,
        ],
        'pooling' => true,
        'charset' => 'utf8',
    ]
];
