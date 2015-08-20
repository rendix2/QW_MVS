<?php
namespace QW\Models;

use QW\FW\Architecture\MVC\AbstractBasicModel;

final class IndexModel extends AbstractBasicModel {
	public function __construct() {
		parent::__construct();
	}

	public function __destruct() {
		parent::__destruct();
	}

	public function index() {
		$this->getDB()
			->query( 'SELECT user_name FROM users LIMIT 50;', [ ] );

		$res = $this->getDB()
		            ->fetchAll();

		$this->getDB()
		     ->freeStatement();

		return $res;
	}
}