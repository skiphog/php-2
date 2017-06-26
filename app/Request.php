<?php

namespace App;

class Request
{

    public function get($param = null)
    {
        return $this->getRequest($_GET, $param);
    }

    public function post($param = null)
    {
        return $this->getRequest($_POST, $param);
    }

    protected function getRequest(array $data, $params)
    {
        if (null === $params) {
            return $data;
        }

        $params = (array)$params;

        if (count($params) === 1) {
            return $data[array_shift($params)] ?? null;
        }

        return array_intersect_key($data, array_flip((array)$params));
    }
}
