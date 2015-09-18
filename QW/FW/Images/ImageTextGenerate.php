<?php

namespace QW\FW\Images;

use QW\FW\Basic\Object;
use QW\FW\Boot\NullPointerException;
use QW\FW\Boot\RuntimeException;
use QW\FW\Paint\Color;

final class ImageTextGenerate extends Object {
	private $imageResource;
	private $imageTextColor;

	public function __construct( $width, $height, $trueColor = FALSE, $debug = FALSE ) {
		parent::__construct( $debug );

		if ( $trueColor == TRUE ) $this->imageResource = imagecreatetruecolor( $width, $height );
		else $this->imageResource = imagecreate( $width, $height );
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

	public function setBackgroundColor( $red, $green, $blue ) {
		imagecolorallocate( $this->imageResource, $red, $green, $blue );
	}

	public function setBackgroundColorO( Color $color = NULL ) {
		if ( $color == NULL ) throw new NullPointerException();

		imagecolorallocate( $this->imageResource, $color->getRed(), $color->getGreen(), $color->getBlue() );
	}

	public function setFontTextHorizontally( $fontPath, $x, $y, $string ) {
		imagestring( $this->imageResource, imageloadfont( $fontPath ), $x, $y, $string, $this->imageTextColor );
	}

	public function setFontTextVertically( $fontPath, $x, $y, $string ) {
		imagestringup( $this->imageResource, imageloadfont( $fontPath ), $x, $y, $string, $this->imageTextColor );
	}

	public function setTextColor( $red, $green, $blue ) {
		$this->imageTextColor = imagecolorallocate( $this->imageResource, $red, $green, $blue );
	}

	public function setTextColorO( Color $color = NULL ) {
		if ( $color == NULL ) throw new NullPointerException();

		$this->imageTextColor =
			imagecolorallocate( $this->imageResource, $color->getRed(), $color->getGreen(), $color->getBlue() );
	}

	public function setTextHorizontally( $fontSize, $x, $y, $string ) {
		imagestring( $this->imageResource, $fontSize, $x, $y, $string, $this->imageTextColor );
	}

	public function setTextVertically( $fontSize, $x, $y, $string ) {
		imagestringup( $this->imageResource, $fontSize, $x, $y, $string, $this->imageTextColor );
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
}