<?php

namespace QW\FW\SuperGlobals;

use QW\FW\Boot\PrivateConstructException;

final class Server implements ISG {
	public function __construct () {
		throw new PrivateConstructException();
	}

	public static function get ( $k ) {
		return isset( $_SERVER[ mb_strtoupper( $k, 'UTF-8' ) ] ) ? $_SERVER[ mb_strtoupper( $k, 'UTF-8' ) ] : FALSE;
	}

	public static function getAll () {
		return $_SERVER;
	}

	public static function set ( $k, $v ) {
		// $_SERVER[mb_strtoupper($k)] = $v;
		return FALSE;
	}
}