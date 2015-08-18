<?php

namespace QW\FW\Basic;

use QW\FW\Boot\IllegalArgumentException;

final class Integer extends Object {
	const MAX_VALUE = PHP_INT_MAX;
	const MIN_VALUE = PHP_INT_MIN;
	private $integer;

	public function __construct ( $integer ) {
		parent::__construct();

		if ( !is_double( $integer ) ) throw new IllegalArgumentException();

		$this->integer = $integer;
	}

	public function __destruct() {
		$this->integer = NULL;

		parent::__destruct();
	}

	public function __toString () {
		return (string) $this->integer;
	}

	public function ceil () {
		return new Integer( ceil( $this->integer ) );
	}

	public function floor () {
		return new Integer( floor( $this->integer ) );
	}

	public function getInteger () {
		return $this->integer;
	}

	public function max ( $number ) {
		return new Integer( max( $this->integer, max( $this->integer, $number ) ) );
	}

	public function min ( $number ) {
		return new Integer( min( $this->integer, min( $this->integer, $number ) ) );
	}

	public function round ( $precision = 0, $mode = PHP_ROUND_HALF_UP ) {
		return new Integer( round( $this->integer, $precision, $mode ) );
	}

	public function toASCII () {
		return new Integer( chr( $this->integer ) );
	}
}