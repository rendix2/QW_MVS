<?php

namespace QW\FW\Basic;

use QW\FW\Boot\IllegalArgumentException;

final class Integer extends Object {
	const MAX_VALUE = PHP_INT_MAX;
	const MIN_VALUE = PHP_INT_MIN;
	private $integer;

	public function __construct( $integer, $debug = FALSE ) {
		parent::__construct( $debug );

		if ( !is_integer( $integer ) ) throw new IllegalArgumentException();

		$this->integer = $integer;
	}

	public function __destruct() {
		$this->integer = NULL;

		parent::__destruct();
	}

	public function __toString() {
		return (string) $this->integer;
	}

	public function ceil() {
		return new Integer( (int) ceil( $this->integer ) );
	}

	public function divide( $number ) {
		if ( $number == 0 ) throw new IllegalArgumentException();

		return new Integer( (int) ( $this->integer / $number ) );
	}

	public function floor() {
		return new Integer( (int) floor( $this->integer ) );
	}

	public function getInteger() {
		return $this->integer;
	}

	public function max( $number ) {
		return new Integer( max( $this->integer, max( $this->integer, $number ) ) );
	}

	public function min( $number ) {
		return new Integer( min( $this->integer, min( $this->integer, $number ) ) );
	}

	public function minus( $number ) {
		if ( $number == 0 ) return new Integer( $this->integer );

		return new Integer( $number - $this->integer );
	}

	public function plus( $number ) {
		if ( $number == 0 ) return new Integer( $this->integer );

		return new Integer( $number + $this->integer );
	}

	public function round( $precision = 0, $mode = PHP_ROUND_HALF_UP ) {
		return new Integer( (int) round( $this->integer, $precision, $mode ) );
	}

	public function times( $number ) {
		if ( $number == 0 ) return new Integer( 0 );
		if ( $number == 1 ) return new Integer( $this->integer );

		return new Integer( $number * $this->integer );
	}

	public function toASCII() {
		return new Integer( chr( $this->integer ) );
	}
}