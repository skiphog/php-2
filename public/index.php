<?php

use App\Logger;
use App\Controllers\Error;
use App\Exceptions\NotFoundException;
use App\Exceptions\DataBaseException;
use App\Exceptions\ForbiddenException;

require __DIR__ . '/../autoload.php';

$uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
$parts = explode('/', $uri);

array_walk($parts, function (&$value) {
    $value = ucfirst($value);
});

$action = !empty($parts[1]) ? array_pop($parts) : 'Index';
$controller = 'App\\Controllers\\' . (!empty($parts[0]) ? implode('\\', $parts) : 'News');

try {
    if (!class_exists($controller)) {
        throw new \BadMethodCallException('Контроллера ' . $controller . ' не существует');
    }
    /** @var \App\Controllers\Controller $controller */
    $controller = new $controller();
    $controller->action($action);
} catch (DataBaseException $e) {
    Logger::log($e);
    (new Error())->action(503);
} catch (NotFoundException | ForbiddenException | BadMethodCallException $e) {
    Logger::log($e);
    (new Error())->action(404);
} catch (Throwable $e) {
    Logger::log($e);
    (new Error())->action(500);
}
