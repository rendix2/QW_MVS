<?php

namespace QW\FW\Basic;

use QW\FW\Boot\IllegalArgumentException;

final class Double extends Object {
	private $double;

	public function __construct ( $double ) {
		parent::__construct();

		if ( !is_double( $double ) ) throw new IllegalArgumentException();

		$this->double = $double;
	}

	public function __toString () {
		return (string) $this->double;
	}
}