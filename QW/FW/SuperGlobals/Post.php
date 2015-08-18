<?php
namespace QW\FW\SuperGlobals;

use QW\FW\Boot\PrivateConstructException;

final class Post implements ISG {
	public function __construct() {
		throw new PrivateConstructException();
	}

	public static function get( $k ) {
		return isset( $_POST[ $k ] ) ? $_POST[ $k ] : FALSE;
	}

	public static function getAll() {
		return $_POST;
	}

	public static function set( $k, $v ) {
		$_POST[ $k ] = $v;

		return ( self::get( $k ) == $v ) ? TRUE : FALSE;
	}
}