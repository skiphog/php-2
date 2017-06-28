<?php

return [
    /**
     * Настройка соединения с базой данных
     */
    'db'   => [
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
    'log'  => [
        'path' => __DIR__ . '/log.txt'
    ],

    /**
     * Настройка для Twig
     */
    'twig' => [
        'path'        => __DIR__ . '/template',
        'cache'       => __DIR__ . '/storage/cache',
        'auto_reload' => true,
        'debug'       => true
    ]
];
