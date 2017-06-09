<?php

use App\Db;

require __DIR__ . '/../autoload.php';

$db = new Db();

/** --- testExecute() ---*/
$sql = 'INSERT INTO test (id, test) VALUES (:id,:test)';
assert(true === $db->execute($sql, [':id' => null, ':test' => 'string']));

/** --- testQuery() ---*/
$sql = 'SELECT * FROM test';
$result = $db->query($sql, StdClass::class);

assert(is_array($result));
assert(array_shift($result) instanceof StdClass);
