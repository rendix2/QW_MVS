<?php
namespace QW\Models;

use QW\FW\Architecture\MVC\AbstractBasicModel;
use QW\FW\Basic\String;
use QW\FW\IP\IPv6;
use QW\FW\IP\IPvU;

final class IndexModel extends AbstractBasicModel {
	public function __construct( $debug = FALSE ) {
		parent::__construct( $debug );
	}

	public function __destruct() {
		parent::__destruct();
	}

	public function index() {

		$ipString = '2001:4cfb:bfc4:0000:0000:0000:0123:4aab';

		$myIP = new IPv6( "2001:4cfb:0000:0000:0000:0000:0123:4aab", FALSE, $this->debug );
		//$myIP = new IPv4( '1.2.3.4', TRUE, $this->debug );
		$myIP = new IPvU( $ipString, FALSE, $this->debug );
		//$myIP = new IPvU( "1.2.3.4", FALSE, $this->debug );

		echo ' IPString=' . $ipString . '<br>';
		echo 'MY IP=' . $myIP->getNiceIP() . '<br>';

		$z = new String( "aookkooa", $this->debug );

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