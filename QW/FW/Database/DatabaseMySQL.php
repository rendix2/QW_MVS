<?php
namespace QW\FW\Database;

final class DatabaseMySQL extends AbstractDatabase
{
    public final function __construct($host, $userName, $userPassword, $dbName, array $options)
    {
        parent::__construct();

        $options[] = array(\PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');

        try {
            $this->connection = new \PDO('mysql:host=' . $host . ';dbname=' . $dbName . ';charser=utf8', $userName, $userPassword, $options);
            $this->connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $pdoEx) {
            if ($pdoEx->getCode() == 1045)
                echo 'Nesprávné údaje pro přihlášení k databázovému serveru: <b>' . $host . '</b><br>';
            else if ($pdoEx->getCode() == 2002)
                echo 'Nepodařilo se připojit k databázovému serveru: <b>' . $host . '</b><br>';
            else if ($pdoEx->getCode() == 1044)
                echo 'Nepodařilo se vybrat databázi na databázovému serveru: <b>' . $host . '</b><br>';
            else
                echo 'Neočekávaná PDO chyba číslo: <b>' . $pdoEx->getCode() . '</b> při připojení k databázovému serveru: <b>' . $host . '</b><br>';
        }
    }
}