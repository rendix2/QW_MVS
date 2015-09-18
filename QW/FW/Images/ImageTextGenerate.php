<?php

namespace QW\FW\Images;

use QW\FW\Basic\Object;
use QW\FW\Boot\IllegalArgumentException;
use QW\FW\Boot\NullPointerException;
use QW\FW\Boot\RuntimeException;
use QW\FW\Paint\BlueColorException;
use QW\FW\Paint\Color;
use QW\FW\Paint\GreenColorException;
use QW\FW\Paint\RedColorException;

final class ImageTextGenerate extends Object {
	private $imageResource;
	private $imageTextColor;

	public function __construct( $width, $height, $trueColor = FALSE, $debug = FALSE ) {
		parent::__construct( $debug );

		$this->imageResource =
			$trueColor == TRUE ? imagecreatetruecolor( $width, $height ) : imagecreate( $width, $height );
	}

	public function __destruct() {
		if ( is_resource( $this->imageResource ) ) imagedestroy( $this->imageResource );

		$this->imageTextColor = NULL;
		$this->imageResource = NULL;
	}

	public function destroyImage() {
		if ( is_resource( $this->imageResource ) ) {
			imagedestroy( $this->imageResource );

			return TRUE;
		}

		return FALSE;
	}

	private function prepareColor( Color $color = NULL ) {
		return ( $color == NULL ) ? $this->imageTextColor :
			imagecolorallocate( $this->imageResource, $color->getRed(), $color->getGreen(), $color->getBlue() );
	}

	private function prepareFont( $fontPath ) {
		$fontPath = imageloadfont( $fontPath );

		if ( $fontPath == FALSE ) throw new IllegalArgumentException();

		return $fontPath;
	}

	public function setBackgroundColor( $red, $green, $blue ) {
		if ( $red < 0 || $red > 255 ) throw new RedColorException();
		if ( $green < 0 || $green > 255 ) throw new GreenColorException();
		if ( $blue < 0 || $blue > 255 ) throw new BlueColorException();

		imagecolorallocate( $this->imageResource, $red, $green, $blue );
	}

	public function setBackgroundColorO( Color $color = NULL ) {
		if ( $color == NULL ) throw new NullPointerException();

		imagecolorallocate( $this->imageResource, $color->getRed(), $color->getGreen(), $color->getBlue() );
	}

	public function setCharHorizontally( $fontSize, $x, $y, $char, Color $color = NULL ) {
		imagechar( $this->imageResource, $fontSize, $x, $y, $char, $this->prepareColor( $color ) );
	}

	public function setCharVertically( $fontSize, $x, $y, $char, Color $color = NULL ) {
		imagecharup( $this->imageResource, $fontSize, $x, $y, $char, $this->prepareColor( $color ) );
	}

	public function setFontCharHorizontally( $fontPath, $x, $y, $char, Color $color = NULL ) {
		imagechar( $this->imageResource, $this->prepareFont( $fontPath ), $x, $y, $char,
			$this->prepareColor( $color ) );
	}

	public function setFontCharVertically( $fontPath, $x, $y, $char, Color $color = NULL ) {
		imagecharup( $this->imageResource, $this->prepareFont( $fontPath ), $x, $y, $char,
			$this->prepareColor( $color ) );
	}

	public function setFontTextHorizontally( $fontPath, $x, $y, $string, Color $color = NULL ) {
		imagestring( $this->imageResource, $this->prepareFont( $fontPath ), $x, $y, $string,
			$this->prepareColor( $color ) );
	}

	public function setFontTextVertically( $fontPath, $x, $y, $string, Color $color = NULL ) {
		imagestringup( $this->imageResource, $this->prepareFont( $fontPath ), $x, $y, $string,
			$this->prepareColor( $color ) );
	}

	public function setTextColor( $red, $green, $blue ) {
		$this->imageTextColor = imagecolorallocate( $this->imageResource, $red, $green, $blue );
	}

	public function setTextColorO( Color $color = NULL ) {
		if ( $color == NULL ) throw new NullPointerException();

		$this->imageTextColor =
			imagecolorallocate( $this->imageResource, $color->getRed(), $color->getGreen(), $color->getBlue() );
	}

	public function setTextHorizontally( $fontSize, $x, $y, $string, Color $color = NULL ) {
		imagestring( $this->imageResource, $fontSize, $x, $y, $string, $this->prepareColor( $color ) );
	}

	public function setTextVertically( $fontSize, $x, $y, $string, Color $color = NULL ) {
		imagestringup( $this->imageResource, $fontSize, $x, $y, $string, $this->prepareColor( $color ) );
	}

	public function toBMP() {
		if ( !is_resource( $this->imageResource ) ) throw new RuntimeException();

		imagewbmp( $this->imageResource );
		imagedestroy( $this->imageResource );
	}

	public function toGIF() {
		if ( !is_resource( $this->imageResource ) ) throw new RuntimeException();

		imagegif( $this->imageResource );
		imagedestroy( $this->imageResource );
	}

	public function toJPG() {
		if ( !is_resource( $this->imageResource ) ) throw new RuntimeException();

		imagejpeg( $this->imageResource );
		imagedestroy( $this->imageResource );
	}

	public function toPNG() {
		if ( !is_resource( $this->imageResource ) ) throw new RuntimeException();

		imagepng( $this->imageResource );
		imagedestroy( $this->imageResource );
	}

	//
}