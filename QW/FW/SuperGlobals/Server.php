<?php

namespace QW\FW\SuperGlobals;

use QW\FW\Boot\PrivateConstructException;

final class Server extends SuperGlobals implements ISG {
	public function __construct() {
		parent::__construct();

		throw new PrivateConstructException();
	}

	public static function get( $k ) {
		$k = strtoupper( $k );
		if ( self::$magicQuotes ) $k = stripslashes( $k );

		$result = isset( $_SERVER[ $k ] ) ? $_SERVER[ $k ] : FALSE;;

		if ( self::$magicQuotes && !$result ) $result = stripslashes( $result );

		return $result;
	}

	public static function getAll() {
		if ( self::$magicQuotes ) {
			$array = [ ];
			foreach ( $_SERVER as $k => $v ) {
				$array[ stripslashes( $k ) ] = stripslashes( $v );
			}

			return $array;
		}

		return $_SERVER;
	}

	public static function set( $k, $v ) {
		// $_SERVER[mb_strtoupper($k)] = $v;
		return FALSE;
	}
}