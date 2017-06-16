<?php
require __DIR__ . '/../autoload.php';

$uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
$parts = explode('/', $uri);

/** Привожу все значения к верхнему регистру */
array_walk($parts, function (&$value) {
    $value = ucfirst($value);
});

/** Считаю, что если элементов в массиве больше одного, то последний всегда - action. Иначе - default */
$action = !empty($parts[1]) ? array_pop($parts) : 'Index';

/** Если в массиве что-то есть, то составляю контроллер. Иначе - default  */
$controller = 'App\\Controllers\\' . (!empty($parts[0]) ? implode('\\', $parts) : 'News');

/** Проверяю на существование Контроллера */
if (!class_exists($controller)) {
    http_response_code(404);
    die;
}

/** @var \App\Controllers\Controller $controller */
$controller = new $controller();
$controller->action($action);
