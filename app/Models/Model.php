<?php

namespace App\Models;

use App\Db;

abstract class Model
{
    protected static $table;

    public $id;

    /** @noinspection ReturnTypeCanBeDeclaredInspection
     * @return array
     */
    public static function findAll()
    {
        $sql = 'SELECT * FROM ' . static::$table;

        return (new Db())->query($sql, static::class);
    }

    /** @noinspection ReturnTypeCanBeDeclaredInspection
     * @param int $limit
     * @return array
     */
    public static function findAllLatest(int $limit)
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

    public function save(): bool
    {
        if (empty($this->id)) {
            return $this->insert();
        }

        return $this->update();
    }

    public function delete(): bool
    {
        $sql = 'DELETE FROM ' . static::$table . ' WHERE id=:id';

        return (new Db())->execute($sql, [':id' => $this->id]);
    }

    protected function insert(): bool
    {
        $data = get_object_vars($this);
        $vars = array_keys($data);

        $sql = 'INSERT INTO ' . static::$table . ' (' . implode(',', $vars) . ') 
            VALUES 
        (' . ':' . implode(',:', $vars) . ')';

        $db = new Db();
        if (true === $result = $db->execute($sql, $data)) {
            $this->id = $db->lastInsertId();
        }

        return $result;
    }

    protected function update(): bool
    {
        $data = get_object_vars($this);
        $vars = [];

        foreach ($data as $key => $value) {
            if ('id' !== $key) {
                $vars[] = $key . '=:' . $key;
            }
        }

        $sql = 'UPDATE ' . static::$table . ' SET ' . implode(',', $vars) . ' WHERE id=:id';

        return (new Db())->execute($sql, $data);
    }
}
