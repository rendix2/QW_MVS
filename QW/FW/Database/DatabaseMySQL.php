<?php
namespace QW\FW\Database;

final class DatabaseMySQL extends AbstractDatabase
{
    public function __destruct(){
        parent::__destruct();
    }

    protected function connect(){
        $this->options[] = array(\PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');

        try {
            $this->connection = new \PDO('mysql:host=' . $this->host . ';dbname=' . $this->dbName . ';charser=utf8', $this->userName, $this->userPassword, $this->options);
            $this->connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $pdoEx) {
            if ($pdoEx->getCode() == 1045)
                echo 'Nesprávné údaje pro přihlášení k databázovému serveru: <b>' . $this->host . '</b><br>';
            else if ($pdoEx->getCode() == 2002)
                echo 'Nepodařilo se připojit k databázovému serveru: <b>' . $this->host . '</b><br>';
            else if ($pdoEx->getCode() == 1044)
                echo 'Nepodařilo se vybrat databázi na databázovém serveru: <b>' . $this->host . '</b><br>';
            else
                echo 'Neočekávaná PDO chyba číslo: <b>' . $pdoEx->getCode() . '</b> při připojení k databázovému serveru: <b>' . $this->host . '</b><br>';
        }

        $this->userPassword = null;
    }
}