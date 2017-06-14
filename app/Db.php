<?php

namespace App;

class Db
{
    /**
     * @var \PDO $dbh
     */
    protected $dbh;

    public function __construct()
    {
        $config = Config::getInstance()->data['db'];
        $this->dbh = new \PDO(
            'mysql:dbname=' . $config['dbname'] . ';host=' . $config['host'],
            $config['username'],
            $config['password'],
            $config['options']
        );
    }

    /**
     * @param string $sql
     * @param array  $params
     * @return bool
     */
    public function execute(string $sql, array $params = []): bool
    {
        return $this->dbh->prepare($sql)->execute($params);
    }

    /**
     * @param string $sql
     * @param string $class
     * @param array  $params
     * @return mixed
     */
    public function query(string $sql, string $class, array $params = [])
    {
        $sth = $this->dbh->prepare($sql);
        $sth->execute($params);
        return $sth->fetchAll(\PDO::FETCH_CLASS, $class);
    }

    /**
     * @return int
     */
    public function lastInsertId(): int
    {
        return $this->dbh->lastInsertId();
    }
}
