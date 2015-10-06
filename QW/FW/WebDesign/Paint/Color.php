<?php

namespace QW\FW\WebDesign\Paint;

use QW\FW\Basic\Object;
use QW\FW\Boot\IllegalArgumentException;
use QW\FW\Utils\Math\Math;

final class Color extends Object {
	const BLUE = 0x0000FF;
	const GREEN = 0x00FF00;
	const RED = 0xFF0000;
	private $red, $green, $blue;

	public function __construct( $red = 0, $green = 0, $blue = 0, $debug = FALSE ) {
		parent::__construct( $debug );
		self::checkColor( $red, $green, $blue );

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

	public static function checkColor( $red = 0, $green = 0, $blue = 0 ) {
		if ( !is_numeric( $red ) || !is_numeric( $green ) ||
			!is_numeric( $blue )
		) throw new IllegalArgumentException();
		if ( $red < 0 || $red > 255 ) throw new RedColorException();
		if ( $green < 0 || $green > 255 ) throw new GreenColorException();
		if ( $blue < 0 || $blue > 255 ) throw new BlueColorException();

		return TRUE;
	}

	public function getBlue() {
		return $this->blue;
	}

	public function getBlueHexa() {
		return Math::decimalToHexadecimal( $this->blue );
	}

	public function getGreen() {
		return $this->green;
	}

	public function getGreenHexa() {
		return Math::decimalToHexadecimal( $this->green );
	}

	public function getRGB() {
		return (int) Math::decimalToHexadecimal( $this->red ) . Math::decimalToHexadecimal( $this->green ) .
		Math::decimalToHexadecimal( $this->blue );
	}

	public function getRed() {
		return $this->red;
	}

	public function getRedHexa() {
		return Math::decimalToHexadecimal( $this->red );
	}

	public function getWebRGB() {
		return '#' . $this->getRGB();
	}
}