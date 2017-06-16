<?php

namespace App;

class Request
{

    public static function uri(): string
    {
        return trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
    }

    public static function get(...$params)
    {
        return self::getParams($_GET, $params);
    }

    public static function post(...$params)
    {
        return self::getParams($_POST, $params);
    }

    public static function getParams(array $data, $params)
    {

        if (empty($params)) {
            return $data;
        }

        if (count($params) === 1) {
            return $data[$params[0]] ?? null;
        }

        $answer = [];

        foreach ((array)$params as $param) {
            $answer[$param] = $data[$param] ?? null;
        }

        return $answer;
    }
}
