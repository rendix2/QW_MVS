<?php
namespace QW\FW\Database;

final class DatabaseMySQL extends AbstractDatabase {
	public function __destruct() {
		parent::__destruct();
	}

	protected function connect() {
		$this->options[] = [ \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8' ];

		try {
			$this->connection = new \PDO('mysql:host=' . $this->host . ';dbname=' . $this->dbName . ';charser=utf8', $this->userName, $this->userPassword, $this->options);
			$this->connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
		}
		catch ( \PDOException $pdoEx ) {
			$this->checkConnection($pdoEx);
		}

		$this->userPassword = NULL;
		self::$AllConnectionsCount++;
	}
}