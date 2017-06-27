<?php
use App\View;

$view = new View();

$view->test = 'test';
assert($view instanceof Iterator);
assert($view instanceof Countable);
assert(isset($view->test) && !empty($view->test));
