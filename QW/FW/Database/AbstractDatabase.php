<?php

namespace QW\FW\Database;

use QW\FW\Basic\Object;
use QW\FW\Interfaces\IDatabase;

abstract class AbstractDatabase extends Object implements IDatabase
{
    protected $connection;
    protected $queryCount;
    protected $statement;

    //abstract public function __construct($host, $userName, $userPassword, $dbName, array $options);

    public function query($query, array $options)
    {
        try {
            $this->queryCount++;
            $this->statement = $this->connection->prepare($query);
            $this->statement->execute($options);
        } catch (\PDOException $pdoEx) {
            echo 'Databázová chyba!<br>';
            echo 'V souboru: ' . $pdoEx->getFile() . '<br>';
            echo 'Na řádku: ' . $pdoEx->getLine() . '<br>';
            echo 'Chyba číslo: ' . $pdoEx->getCode() . '<br>';
            echo 'Chyba: ' . $pdoEx->getMessage() . '<br>';
            die();
        }
    }

    public function fetch()
    {
        return $this->statement->fetch(\PDO::FETCH_ASSOC);
    }

    public function fetchAll()
    {
        return $this->statement->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function  fetchColumn()
    {
        return $this->statement->fetchColumn(\PDO::FETCH_ASSOC);
    }

    public function numRows()
    {
        $this->statement->rowCount();
    }

    public function lastID()
    {
        return $this->connection->lastInsertId();
    }

    public function freeStatement()
    {
        $this->statement->closeCursor();
        $this->statement = null;
    }
}