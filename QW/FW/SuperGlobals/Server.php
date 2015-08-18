<?php

namespace QW\FW\SuperGlobals;

use QW\FW\Interfaces\ISG;

final class Server implements ISG {
	private function __construct() {
	}

	public static function get($k) {
		return isset( $_SERVER[ mb_strtoupper($k, 'UTF-8') ] ) ? $_SERVER[ mb_strtoupper($k, 'UTF-8') ] : FALSE;
	}

	public static function getAll() {
		return $_SERVER;
	}

	public static function set($k, $v) {
		// $_SERVER[mb_strtoupper($k)] = $v;
		return FALSE;
	}
}