<?php

namespace QW\FW\Utils\SuperGlobals;

abstract class SuperGlobals {

	protected static $magicQuotes;

	public function __construct() {
		self::$magicQuotes = get_magic_quotes_gpc();
	}

	public function __destruct() {
		self::$magicQuotes = NULL;
	}
}