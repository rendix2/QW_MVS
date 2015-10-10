<?php

namespace QW\FW\Utils\SuperGlobals;

use QW\FW\Boot\PrivateConstructException;

final class Post extends SuperGlobals implements ISG {
	public function __construct() {
		parent::__construct();

		throw new PrivateConstructException();
	}

	public static function get( $k ) {
		if ( self::$magicQuotes ) $k = stripslashes( $k );

		$result = isset( $_POST[ $k ] ) ? $_POST[ $k ] : FALSE;;

		if ( self::$magicQuotes && !$result ) $result = stripslashes( $result );

		return $result;
	}

	public static function getAll() {
		if ( self::$magicQuotes ) {
			$array = [ ];
			foreach ( $_POST as $k => $v ) {
				$array[ stripslashes( $k ) ] = stripslashes( $v );
			}

			return $array;
		}

		return $_POST;
	}

	public static function set( $k, $v ) {
		$_POST[ $k ] = $v;

		return ( self::get( $k ) == $v ) ? TRUE : FALSE;
	}
}