<?php

namespace App;

use App\Exceptions\DataBaseException;

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
            return $sth->fetchAll(\PDO::FETCH_CLASS, $class);
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

            /** @noinspection PhpMethodParametersCountMismatchInspection */
            $sth->setFetchMode(\PDO::FETCH_CLASS, $class);

            while ($row = $sth->fetch()) {
                yield $row;
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
}
