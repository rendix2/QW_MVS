<?php
namespace QW\FW\Architecture\MVC;

use QW\FW\Basic\Object;
use QW\FW\Database\DatabaseMySQL;
use QW\Libs\Config;


final class ModelException extends \Exception {
}

abstract class AbstractBasicModel extends Object {
	private $db; //, $language, $template;

	final function __construct() {
		parent::__construct();
		//$z = DatabaseMySQL::getSingleton();

		$this->db = new DatabaseMySQL(Config::$dbConfig[ 'dbHost' ], Config::$dbConfig[ 'dbUser' ], Config::$dbConfig[ 'dbPassword' ], Config::$dbConfig[ 'dbName' ], [ ]);
		//    $this->db = DatabaseMySQL::getSingleton();
		//   $this->d

		/*
		$this->language = new Language('CZ');

		if ($jsem_user == true)
			$this->template = new TemplateUser('default');
		else
			$this->template = new TemplateAdmin();
	*/
	}

	protected final function getDB() {
		return $this->db;
	}
}