<?php

namespace App;

class Db
{
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

    public function execute(string $sql, array $params = []): bool
    {
        return $this->dbh->prepare($sql)->execute($params);
    }

    public function query(string $sql, string $class, array $params = []): array
    {
        $sth = $this->dbh->prepare($sql);
        $sth->execute($params);
        return $sth->fetchAll(\PDO::FETCH_CLASS, $class);
    }

    public function lastInsertId(): int
    {
        return $this->dbh->lastInsertId();
    }
}
