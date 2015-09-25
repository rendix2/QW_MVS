<?php
namespace QW\Models;

use QW\FW\Architecture\MVC\AbstractBasicModel;
use QW\FW\Basic\String;

final class IndexModel extends AbstractBasicModel {
	public function __construct( $debug = FALSE ) {
		parent::__construct( $debug );
	}

	public function __destruct() {
		parent::__destruct();
	}

	public function index() {

		$z = new String( "akajak" );

		echo 'Text:<b>' . $z . '</b><br>Longest palindrome using Manachers algorithm: <b>' .
			$z->getLongestPalindromeManacher() . '</b>';

		$this->getDB()
			->query( 'SELECT user_name FROM users LIMIT 50;', [ ] );

		$res = $this->getDB()
		            ->fetchAll();

		$this->getDB()
		     ->freeStatement();

		return $res;
	}
}