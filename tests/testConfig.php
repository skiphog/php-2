<?php
use App\Config;

$config = Config::getInstance();
assert($config instanceof Config);
assert(is_array($config->data));
assert(is_array($config->data['db']));
