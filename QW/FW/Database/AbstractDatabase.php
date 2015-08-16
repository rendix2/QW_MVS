<?php

namespace QW\FW\Database;

use QW\FW\Basic\Object;
use QW\FW\Interfaces\IDatabase;

abstract class AbstractDatabase extends Object implements IDatabase
{
    protected static $AllQueryCount;

    protected $connection;
    protected $queryCount;
    protected $statement;

    // conection begin
    protected $host;
    protected $userName;
    protected $userPassword;
    protected $dbName;
    protected $options;
    // conection begin

    abstract protected function connect();

    public function __construct($host, $userName, $userPassword, $dbName, array $options){
        parent::__construct();

        $this->host = $host;
        $this->userName = $userName;
        $this->userPassword = $userPassword;
        $this->dbName = $dbName;
        $this->options = $options;

        $this->queryCount = 0;
        $this->statement = null;
        $this->connection = null;
        self::$AllQueryCount = 0;
    }

    public function __destruct(){

        if ( $this->statement != null )
            $this->freeStatement();

        $this->queryCount = null;
        $this->connection = null;
        $this->dbName = null;
        $this->host = null;
        $this->options = null;

        $this->userName = null;
        $this->userPassword = null;

        parent::__destruct();
    }

    public static function getAllQueryCount()
    {
        return self::$AllQueryCount;
    }

    public function query($query, array $options)
    {
        try {

            if ( $this->queryCount == 0 )
            {
                $this->connect();
            }

            self::$AllQueryCount++;
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

    public function getQueryCount()
    {
        return $this->queryCount;
    }

    public function fetch()
    {
        return $this->statement->fetch(\PDO::FETCH_ASSOC);
    }

    public function fetchAll()
    {
        return $this->statement->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function fetchColumn()
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