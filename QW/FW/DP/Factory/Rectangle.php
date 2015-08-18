<?php

namespace QW\FW\DP\Factory;

class Rectangle {

	private $a, $b;

	public function __construct ( $a, $b ) {
		$this->a = $a;
		$this->b = $b;
	}

	function __toString () {
		return 'A: ' . $this->a . ' B: ' . $this->b . '<br>';
	}

	public function growByFactor ( $factor ) {
		return new Rectangle( $this->a * $factor, $this->b * $factor );
	}

	public function setA ( $newA ) {
		return new Rectangle( $newA, $this->a );
	}

	public function setB ( $newB ) {
		return new Rectangle( $this->a, $newB );
	}
}