<?php

namespace App\Models;

use App\Db;
use App\Exceptions\MultiException;

/**
 * Class Model
 * @package App\Models
 * @property int $id
 */
abstract class Model
{
    /**
     * Таблица БД
     * @var string $table
     */
    protected static $table;

    /**
     * Атрибуты
     * @var array $attributes
     */
    protected $attributes = [];

    /**
     * Допустимые значения для заполнения
     * @var array
     */
    protected $fillable = [];

    /**
     * Получает все записи
     * @return mixed
     * @throws \App\Exceptions\DataBaseException
     */
    public static function findAll()
    {
        $sql = 'SELECT * FROM ' . static::$table;

        return (new Db())->query($sql, static::class);
    }

    /**
     * Получает записи отсортированные по id
     * @param int $limit
     * @return mixed
     * @throws \App\Exceptions\DataBaseException
     */
    public static function findAllLatest(int $limit)
    {
        $sql = 'SELECT * FROM ' . static::$table . ' ORDER BY id DESC LIMIT ' . $limit;

        return (new Db())->query($sql, static::class);
    }

    /**
     * Получает одну запись по id
     * @param int $id
     * @return mixed
     * @throws \App\Exceptions\DataBaseException
     */
    public static function findById($id)
    {
        $sql = 'SELECT * FROM ' . static::$table . ' WHERE id = :id LIMIT 1';
        $result = (new Db())->query($sql, static::class, [':id' => $id]);

        return empty($result) ? false : array_shift($result);
    }

    /**
     * Заполняет модель значениями
     * @param array $data
     * @return $this
     * @throws \App\Exceptions\MultiException
     */
    public function fill(array $data)
    {
        $errors = new MultiException();

        foreach ($data as $key => $value) {
            if (!in_array($key, $this->fillable, true)) {
                continue;
            }

            try {
                $this->{$key} = $this->fillAttribute($key, $value);
            } catch (\Exception $e) {
                $errors->add($e);
            }
        }

        if (!$errors->isEmpty()) {
            throw  $errors;
        }

        return $this;
    }

    /**
     * Сохраняет запись
     * @return bool
     * @throws \App\Exceptions\DataBaseException
     */
    public function save(): bool
    {
        if (empty($this->attributes['id'])) {
            return $this->insert();
        }

        return $this->update();
    }

    /**
     * Удаляет запись
     * @return bool
     * @throws \App\Exceptions\DataBaseException
     */
    public function delete(): bool
    {
        $sql = 'DELETE FROM ' . static::$table . ' WHERE id=:id';

        return (new Db())->execute($sql, [':id' => $this->attributes['id']]);
    }

    /**
     * Добавляет запись
     * @return bool
     * @throws \App\Exceptions\DataBaseException
     */
    protected function insert(): bool
    {
        $vars = array_keys($this->attributes);

        $sql = 'INSERT INTO ' . static::$table . ' (' . implode(',', $vars) . ') 
            VALUES 
        (' . ':' . implode(',:', $vars) . ')';

        $db = new Db();
        if (true === $result = $db->execute($sql, $this->attributes)) {
            $this->attributes['id'] = $db->lastInsertId();
        }

        return $result;
    }

    /**
     * Обновляет запись
     * @return bool
     * @throws \App\Exceptions\DataBaseException
     */
    protected function update(): bool
    {
        $vars = $this->attributes;
        unset($vars['id']);

        array_walk($vars, function (&$v, $k) {
            $v = $k . '=:' . $k;
        });

        $sql = 'UPDATE ' . static::$table . ' SET ' . implode(',', $vars) . ' WHERE id=:id';

        return (new Db())->execute($sql, $this->attributes);
    }


    /**
     * @param $key
     * @return mixed
     */
    public function __get($key)
    {
        if (array_key_exists($key, $this->attributes)) {
            return $this->attributes[$key];
        }

        return $this->getAttribute($key);
    }

    /**
     * @param $key
     * @param $value
     */
    public function __set($key, $value)
    {
        $this->attributes[$key] = $value;
    }

    /**
     * @param $key
     * @return bool
     */
    public function __isset($key)
    {
        return null !== $this->{$key};
    }

    /**
     * Запускает валидацию, если указан соответствующий метод
     * @param $key
     * @param $value
     * @return mixed
     */
    protected function fillAttribute($key, $value)
    {
        $data = array_map(function ($v) {
            return ucfirst($v);
        }, explode('_', $key));

        $method = 'validate' . implode('', $data);

        return method_exists($this, $method) ? $this->$method($value) : $value;
    }

    /**
     * @param $key
     * @return mixed
     */
    protected function getAttribute($key)
    {
        $method = 'get' . ucfirst($key);

        if (method_exists($this, $method)) {
            return $this->attributes[$key] = $this->$method();
        }

        return null;
    }
}
