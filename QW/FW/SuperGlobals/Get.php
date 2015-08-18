<?php

namespace QW\FW\SuperGlobals;

use QW\FW\Interfaces\ISG;

class Get implements ISG {
	public function __construct () {
		throw new PrivateConstructException();
	}

	public static function get ( $k ) {
		return isset( $_GET[ $k ] ) ? $_GET[ $k ] : FALSE;
	}

	public static function getAll () {
		return $_GET;
	}

	public static function set ( $k, $v ) {
		$_GET[ $k ] = $v;

		return ( self::get( $k ) == $v ) ? TRUE : FALSE;
	}
}