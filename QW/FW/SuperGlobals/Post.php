<?php
namespace QW\FW\SuperGlobals;

use QW\FW\Interfaces\ISG;

final class Post implements ISG {
	private function __construct () {
	}

	public static function get ( $k ) {
		return isset( $_POST[ $k ] ) ? $_POST[ $k ] : FALSE;
	}

	public static function getAll () {
		return $_POST;
	}

	public static function set ( $k, $v ) {
		$_POST[ $k ] = $v;

		return ( self::get( $k ) == $v ) ? TRUE : FALSE;
	}
}