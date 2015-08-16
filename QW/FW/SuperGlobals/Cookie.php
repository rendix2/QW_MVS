<?php

namespace QW\FW\SuperGlobals;

use QW\FW\Interfaces\ISG;

final class Cookie implements ISG {
	public static function get($k) {
		return isset( $_COOKIE[ $k ] ) ? $_COOKIE[ $k ] : FALSE;
	}

	public static function getAll() {
		return $_COOKIE;
	}

	public static function set($k, $v) {
		return setcookie($k, $v);
	}

	private function __construct() {
	}
}