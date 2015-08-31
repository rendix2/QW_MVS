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
}