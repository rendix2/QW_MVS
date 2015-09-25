<?php
namespace QW\Models;

use QW\FW\Architecture\MVC\AbstractBasicModel;
use QW\FW\Basic\String;
use QW\FW\IP\IPv4;

final class IndexModel extends AbstractBasicModel {
	public function __construct( $debug = FALSE ) {
		parent::__construct( $debug );
	}

	public function __destruct() {
		parent::__destruct();
	}

	public function index() {

		//$myIP = new IPv6("2001:4cfb:0000:0000:0000:0000:0123:4aab", TRUE);
		$myIP = new IPv4( '1.2.3.4', TRUE );

		echo 'MY IP:::::' . $myIP;

		$z = new String( "aookkooa" );

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