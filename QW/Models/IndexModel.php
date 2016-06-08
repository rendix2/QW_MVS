<?php
	namespace QW\Models;

	use QW\FW\Architecture\MVC\AbstractBasicModel;
	use QW\FW\Basic\StringW;
	use QW\FW\Utils\IP\IPv6;
	use QW\FW\Utils\IP\IPvU;
	use QW\FW\Utils\Math\Math;


	final class IndexModel extends AbstractBasicModel {
		public function __construct () {
			parent::__construct ();
		}

		public function __destruct () {
			parent::__destruct ();
		}

		public function index () {

			$ipString = '2001:4cfb:bfc4:0000:0000:0000:0123:4aab';

			$myIP = new IPv6( "2001:4cfb:0000:0000:0000:0000:0123:4aab", FALSE );
			//$myIP = new IPv4( '1.2.3.4', TRUE );
			$myIP = new IPvU( $ipString, FALSE );
			//$myIP = new IPvU( "1.2.3.4", FALSE);

			echo ' IPString=' . $ipString . '<br>';
			echo 'MY IP=' . $myIP->getNiceIP () . '<br>';

			$z = new StringW( "aookkooa" );

			echo 'Text:<b>' . $z . '</b><br>Longest palindrome using Manachers algorithm: <b>' .
			$z->getLongestPalindromeManacher () . '</b>';

			$this->getDB ()
			     ->query ( 'SELECT user_name FROM users LIMIT 50;', [ ] )
			;

			$res = $this->getDB ()
			            ->fetchAll ()
			;

			$this->getDB ()
			     ->freeStatement ()
			;


			echo 'ack2:' . Math::ackermannLimitedRecoursion ( 3, 88 );

			//echo 'ack:' . Math::ackermann( 3, 17 );


			return $res;
		}
//

	}