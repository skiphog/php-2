<?php

return [
    /**
     * Настройка соединения с базой данных
     */
    'db'  => [
        'host'     => 'localhost',
        'dbname'   => 'php-2',
        'username' => 'root',
        'password' => '',
        'options'  => [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
        ]
    ],

    /**
     * Настройка пути к файлу с логом
     */
    'log' => [
        'path' => __DIR__ . '/log.txt'
    ],
];
