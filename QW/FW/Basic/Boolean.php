<?php

namespace QW\FW\Basic;

use QW\FW\Boot\IllegalArgumentException;

final class Boolean extends Object {
	const FALSE = FALSE;
	const TRUE = TRUE;
	private $boolean;

	public function __construct($boolean) {
		parent::__construct();

		if ( !is_bool($boolean) )
			throw new IllegalArgumentException();

		$this->boolean = $boolean;
	}

	public function __toString() {
		return (string) $this->boolean;
	}

	public static function compare($x, $y) {
		if ( !is_bool($x) || !is_bool($y) )
			throw new IllegalArgumentException();

		return $x == $y;
	}

	public static function compareBoolean(Boolean $x = NULL, Boolean $y = NULL) {
		if ( $x == NULL || $y == NULL )
			throw new IllegalArgumentException();

		return $x->boolean == $y->boolean;
	}

	public function compareTo($boolean) {
		if ( !is_bool($boolean) )
			throw new IllegalArgumentException();

		return $this->boolean == $boolean;
	}

	public function compareToBoolean(Boolean $boolean = NULL) {
		if ( $boolean == NULL )
			throw new IllegalArgumentException();

		return $this->boolean == $boolean->boolean;
	}

	public function f() {
		return a();
	}
}