<?php

class Db
{
    protected $dbh;

    public function __construct()
    {
        $this->dbh = new \PDO('mysql:dbname=php-2;host=localhost', 'root', '');
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
}
