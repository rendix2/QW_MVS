<?php

namespace QW\FW\Basic;

use QW\FW\Boot\IllegalArgumentException;

final class Double extends Object {
	private $double;

	public function __construct( $double = 0.0, $debug = FALSE ) {
		parent::__construct( $debug );

		if ( !is_double( $double ) ) throw new IllegalArgumentException();

		$this->double = $double;
	}

	public function __destruct() {
		$this->double = NULL;

		parent::__destruct();
	}

	public function __toString() {
		return (string) $this->double;
	}

	public function divide( $number ) {
		if ( $number == 0 ) throw new IllegalArgumentException();

		return new Integer( $this->double / $number );
	}

	public function minus( $number ) {
		if ( $number == 0 ) return new Integer( $this->double );

		return new Integer( $number - $this->double );
	}

	public function plus( $number ) {
		if ( $number == 0 ) return new Integer( $this->double );

		return new Integer( $number + $this->double );
	}

	public function times( $number ) {
		if ( $number == 0 ) return new Integer( 0 );
		if ( $number == 1 ) return new Integer( $this->double );

		return new Integer( $number * $this->double );
	}
}