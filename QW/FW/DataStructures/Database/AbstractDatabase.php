<?php

namespace QW\FW\DataStructures\Database;

use QW\FW\Basic\Object;
use QW\FW\Boot\IllegalArgumentException;
use QW\FW\Boot\NullPointerException;
use QW\FW\Utils\Log\Logger;

abstract class AbstractDatabase extends Object implements IDatabase {
	protected static $AllQueryCount;
	protected static $AllConnectionsCount;
	protected $connection;
	protected $queryCount;
	protected $statement;

	// conection begin
	protected $host;
	protected $userName;
	protected $userPassword;
	protected $dbName;
	protected $options;
	protected $log;
	protected $connectEveryQuery;
	protected $connectOnCreate;

	abstract protected function connect();

	// conection begin

	public function __construct( $host, $userName, $userPassword, $dbName, array $options, $log = FALSE, $connectEveryQuery = FALSE, $connectOnCreate = FALSE, $debug = FALSE ) {
		parent::__construct( $debug );
		self::$AllQueryCount       = 0;
		self::$AllConnectionsCount = 0;
		$this->host = $host;
		$this->userName = $userName;
		$this->userPassword = $userPassword;
		$this->dbName = $dbName;
		$this->options = $options;
		$this->queryCount = 0;
		$this->statement = NULL;
		$this->connection = NULL;

		if ( !is_bool( $log ) ) $log = FALSE;
		if ( !is_bool( $connectEveryQuery ) ) $this->connectEveryQuery = FALSE;
		if ( !is_bool( $connectOnCreate ) ) $this->connectOnCreate = FALSE;
		if ( $log ) $this->log = new Logger( Logger::LOG_TYPE_DATABASE );
		if ( $this->connectOnCreate ^ $this->connectEveryQuery ) throw new IllegalArgumentException();

		$this->connectEveryQuery = $connectEveryQuery;

		if ( $this->connectOnCreate = TRUE ) $this->connect();
	}

	public function __destruct() {
		self::$AllQueryCount       = NULL;
		self::$AllConnectionsCount = NULL;
		$this->queryCount          = NULL;
		$this->dbName              = NULL;
		$this->host                = NULL;
		$this->options             = NULL;
		$this->userName            = NULL;
		$this->userPassword        = NULL;
		$this->log                 = NULL;

		$this->disconnect();
		parent::__destruct();
	}

	public static function getAllConnectionsCount() {
		return self::$AllConnectionsCount;
	}

	public static function getAllQueryCount() {
		return self::$AllQueryCount;
	}

	protected final function checkConnection( \PDOException $pdoEx = NULL ) {
		if ( $pdoEx == NULL ) throw new NullPointerException();

		$message = '';

		switch ( $pdoEx->getCode() ) {
			case 1045:
				$message .= 'Nesprávné údaje pro přihlášení k databázovému serveru: <b>' . $this->host . '</b><br>';
				break;
			case 2002:
				$message .= 'Nepodařilo se připojit k databázovému serveru: <b>' . $this->host . '</b><br>';
				break;
			case 1044:
				$message .= 'Nepodařilo se vybrat databázi na databázovém serveru: <b>' . $this->host . '</b><br>';
				break;
			default:
				$message .= 'Neočekávaná PDO chyba číslo: <b>' . $pdoEx->getCode() .
					'</b> při připojení k databázovému serveru: <b>' . $this->host . '</b><br>';
		}

		if ( $this->log != FALSE ) $this->log->log( $message );

		die( $message );
	}

	public function disconnect() {
		if ( $this->statement != NULL ) $this->freeStatement();
		$this->connection = NULL;
	}

	public function fetch() {
		return $this->statement->fetch( \PDO::FETCH_ASSOC );
	}

	public function fetchAll() {
		return $this->statement->fetchAll( \PDO::FETCH_ASSOC );
	}

	public function fetchColumn() {
		return $this->statement->fetchColumn( \PDO::FETCH_ASSOC );
	}

	public function freeStatement() {
		$this->statement->closeCursor();
		$this->statement = NULL;
	}

	public function getQueryCount() {
		return $this->queryCount;
	}

	public function lastID() {
		return $this->connection->lastInsertId();
	}

	public function numRows() {
		$this->statement->rowCount();
	}

	public function query( $query, array $options ) {
		try {
			if ( ( $this->connectOnCreate == FALSE && $this->queryCount == 0 ) ||
				$this->connectEveryQuery == TRUE
			) $this->connect();

			if ( $this->log != FALSE ) $this->log->log( $query );

			self::$AllQueryCount++;
			$this->queryCount++;
			$this->statement = $this->connection->prepare( $query );
			$this->statement->execute( $options );

			if ( $this->connectEveryQuery == TRUE ) $this->disconnect();
		}
		catch ( \PDOException $pdoEx ) {
			$message = 'Databázová chyba!<br>';
			$message .= 'V souboru: ' . $pdoEx->getFile() . '<br>';
			$message .= 'Na řádku: ' . $pdoEx->getLine() . '<br>';
			$message .= 'Chyba číslo: ' . $pdoEx->getCode() . '<br>';
			$message .= 'Chyba: ' . $pdoEx->getMessage() . '<br>';

			if ( $this->log != FALSE ) $this->log->log( $message );

			die( $message );
		}
	}
}