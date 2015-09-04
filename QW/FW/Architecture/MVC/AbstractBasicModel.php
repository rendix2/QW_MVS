<?php
namespace QW\FW\Architecture\MVC;

use QW\FW\Basic\Object;
use QW\FW\Database\DatabaseMySQL;
use QW\Libs\Config;

abstract class AbstractBasicModel extends Object {
	private $db; //, $language, $template;

	public function __construct( $debug = FALSE ) {
		parent::__construct( $debug );
		$this->db = new DatabaseMySQL( Config::$dbConfig[ 'dbHost' ], Config::$dbConfig[ 'dbUser' ],
			Config::$dbConfig[ 'dbPassword' ], Config::$dbConfig[ 'dbName' ], [ ] );
	}

	public function __destruct() {
		$this->db->disconnect();
		$this->db = NULL;

		parent::__destruct();
	}

	protected final function getDB() {
		return $this->db;
	}
}