<?php

return [
    'db'  => [
        'host'     => 'localhost',
        'dbname'   => 'php-2',
        'username' => 'root',
        'password' => '',
        'options'  => [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
        ]
    ],
    'log' => [
        'path' => __DIR__ . '/log.txt'
    ]
];
