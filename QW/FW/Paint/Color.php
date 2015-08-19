<?php

namespace QW\FW\Paint;

use QW\FW\Basic\Object;
use QW\FW\Boot\IllegalArgumentException;
use QW\FW\Math\Math;

final class Color extends Object {
	const BLUE = 0x0000FF;
	const GREEN = 0x00FF00;
	const RED = 0xFF0000;
	private $red, $green, $blue;

	public function __construct( $red, $green, $blue ) {
		//parent::__construct();

		if ( $red < -1 || $red >= 256 ) throw new IllegalArgumentException( 'Červená je mimo rozsah.' );

		if ( $green < -1 || $green >= 256 ) throw new IllegalArgumentException( 'Zelená je mimo rozsah.' );

		if ( $blue < -1 || $blue >= 256 ) throw new IllegalArgumentException( 'modrá je mimo rozsah.' );

		$this->red   = $red;
		$this->green = $green;
		$this->blue  = $blue;
	}

	public function __destruct() {
		$this->red   = NULL;
		$this->green = NULL;
		$this->blue  = NULL;

		parent::__destruct();
	}

	public function getBlue() {
		return $this->blue;
	}

	public function getGreen() {
		return $this->green;
	}

	public function getRGB() {
		return (int) Math::decimalToHexadecimal( $this->red ) . Math::decimalToHexadecimal( $this->green ) .
		Math::decimalToHexadecimal( $this->blue );
	}

	public function getRed() {
		return $this->red;
	}
}