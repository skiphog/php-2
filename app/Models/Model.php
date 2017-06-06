<?php
require __DIR__ . '/../Db.php';

abstract class Model
{
    protected static $table;

    public static function findAll(): array
    {
        $sql = 'SELECT * FROM ' . static::$table;

        return (new Db())->query($sql, static::class);
    }

    public static function findAllLatest(int $limit): array
    {
        $sql = 'SELECT * FROM ' . static::$table . ' ORDER BY id DESC LIMIT ' . $limit;

        return (new Db())->query($sql, static::class);
    }

    public static function findById(int $id)
    {
        $sql = 'SELECT * FROM ' . static::$table . ' WHERE id = :id LIMIT 1';
        $result = (new Db())->query($sql, static::class, [':id' => $id]);

        return empty($result) ? false : array_shift($result);
    }
}