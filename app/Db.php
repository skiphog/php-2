<?php

namespace App;

use App\Exceptions\DataBaseException;
use App\Models\Model;

class Db
{
    /**
     * @var \PDO $dbh
     */
    protected $dbh;

    public function __construct()
    {
        try {
            $config = Config::getInstance()->data['db'];
            $this->dbh = new \PDO(
                'mysql:dbname=' . $config['dbname'] . ';host=' . $config['host'],
                $config['username'],
                $config['password'],
                $config['options']
            );
        } catch (\Exception $e) {
            throw new DataBaseException('Нет соединения с БД', $e->getCode(), $e);
        }
    }

    /**
     * @param string $sql
     * @param array  $params
     * @return bool
     * @throws \App\Exceptions\DataBaseException
     */
    public function execute(string $sql, array $params = []): bool
    {
        try {
            return $this->dbh->prepare($sql)->execute($params);
        } catch (\Exception $e) {
            throw new DataBaseException('Ошибка в запросе', $e->getCode(), $e);
        }
    }

    /**
     * @param string $sql
     * @param string $class
     * @param array  $params
     * @return mixed
     * @throws \App\Exceptions\DataBaseException
     */
    public function query(string $sql, string $class, array $params = [])
    {
        try {
            $sth = $this->dbh->prepare($sql);
            $sth->execute($params);
            return $this->fetchClass($sth, $class);
        } catch (\Exception $e) {
            throw new DataBaseException('Ошибка в запросе', $e->getCode(), $e);
        }
    }

    /**
     * @param string $sql
     * @param string $class
     * @param array  $params
     * @return \Generator
     * @throws DataBaseException
     */
    public function queryEach(string $sql, string $class, array $params = [])
    {
        try {
            $sth = $this->dbh->prepare($sql);
            $sth->execute($params);

            while ($row = $sth->fetch(\PDO::FETCH_ASSOC)) {
                /** @var Model $class */
                $class = new $class();
                /**
                 * Минует __set() при заполнении модели
                 * Я пока не придумал, как сделать так, что бы __set() не вызывался
                 */
                yield $class->setRawAttributes($row);
            }
        } catch (\Exception $e) {
            throw new DataBaseException('Ошибка в запросе', $e->getCode(), $e);
        }
    }

    /**
     * @return int
     */
    public function lastInsertId(): int
    {
        return $this->dbh->lastInsertId();
    }

    /**
     * Для того, что бы не вызывался __set() при заполнении модели из БД
     * @param \PDOStatement $sth
     * @param string        $class
     * @return mixed
     */
    private function fetchClass(\PDOStatement $sth, string $class)
    {
        $data = [];
        while ($row = $sth->fetch(\PDO::FETCH_ASSOC)) {
            /** @noinspection PhpUndefinedMethodInspection */
            $data[] = (new $class)->setRawAttributes($row);
        }

        return $data;
    }
}
