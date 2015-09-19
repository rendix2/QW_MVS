<?php

namespace QW\FW\Images;

use QW\FW\Basic\Object;
use QW\FW\Boot\IllegalArgumentException;
use QW\FW\Boot\NullPointerException;
use QW\FW\Boot\RuntimeException;
use QW\FW\Paint\Color;

final class ImageTextGenerate extends Object {
	private $imageResource;
	private $imageTextColor;

	private $width;
	private $height;

	public function __construct( $width, $height, $trueColor = FALSE, $debug = FALSE ) {
		parent::__construct( $debug );

		if ( !is_numeric( $width ) || !is_numeric( $height ) ) throw new IllegalArgumentException();

		$this->imageResource =
			$trueColor == TRUE ? imagecreatetruecolor( $width, $height ) : imagecreate( $width, $height );

		$this->height = $height;
		$this->width  = $width;
	}

	public function __destruct() {
		if ( is_resource( $this->imageResource ) ) imagedestroy( $this->imageResource );

		$this->imageTextColor = NULL;
		$this->imageResource = NULL;
	}

	public function antialias( $enable = TRUE ) {
		if ( !is_bool( $enable ) ) throw new IllegalArgumentException();

		return imageantialias( $this->imageResource, $enable );
	}

	public function arc( $x, $y, $width, $height, $start, $end, Color $color = NULL ) {
		imagearc( $this->imageResource, $x, $y, $width, $height, $start, $end, $this->prepareColor( $color ) );
	}

	public function destroyImage() {
		if ( is_resource( $this->imageResource ) ) {
			imagedestroy( $this->imageResource );

			return TRUE;
		}

		return FALSE;
	}

	public function ellipse( $x, $y, $width, $height, Color $color = NULL ) {
		imageellipse( $this->imageResource, $x, $y, $width, $height, $this->prepareColor( $color ) );
	}

	public function filledArc( $x, $y, $width, $height, $start, $end, $style, Color $color = NULL ) {
		imagefilledarc( $this->imageResource, $x, $y, $width, $height, $start, $end, $this->prepareColor( $color ),
			$style );
	}

	public function filledEllipse( $x, $y, $width, $height, Color $color = NULL ) {
		imagefilledellipse( $this->imageResource, $x, $y, $width, $height, $this->prepareColor( $color ) );
	}

	public function filledPolygon( $x0, $x1, $y0, $y1, $numPoints, Color $color = NULL ) {
		imagefilledpolygon( $this->imageResource, [ $x0, $y0, $x1, $y1 ], $numPoints, $this->prepareColor( $color ) );
	}

	public function filledRectangle( $x1, $x2, $y1, $y2, Color $color = NULL ) {
		imagefilledrectangle( $this->imageResource, $x1, $y1, $x2, $y2, $this->prepareColor( $color ) );
	}

	public function filter( $filterType, $arg1, $arg2, $arg3, $arg4 ) {
		imagefilter( $this->imageResource, $filterType, $arg1, $arg2, $arg3, $arg4 );
	}

	public function getHeight() {
		return $this->height;
	}

	public function getSupportedImagesTypes() {
		return imagetypes();
	}

	public function getWidth() {
		return $this->width;
	}

	public function interlace( $enable = FALSE ) {
		imageinterlace( $this->imageResource, (int) $enable );
	}

	public function line( $x1, $x2, $y1, $y2, Color $color = NULL ) {
		imageline( $this->imageResource, $x1, $y1, $x2, $y2, $this->prepareColor( $color ) );
	}

	public function polygon( $x0, $x1, $y0, $y1, $numPoints, Color $color = NULL ) {
		imagepolygon( $this->imageResource, [ $x0, $y0, $x1, $y1 ], $numPoints, $this->prepareColor( $color ) );
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

	public function rectangle( $x1, $x2, $y1, $y2, Color $color = NULL ) {
		imagerectangle( $this->imageResource, $x1, $y1, $x2, $y2, $this->prepareColor( $color ) );
	}

	public function rotate( $angle, $bgdColor, $ignoreTransparent ) {
		imagerotate( $this->imageResource, $angle, $bgdColor, $ignoreTransparent );
	}

	public function setBackgroundColor( $red = 0, $green = 0, $blue = 0 ) {
		Color::checkColor( $red, $green, $blue );
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

	public function setPixel( $x, $y, Color $color ) {
		imagesetpixel( $this->imageResource, $x, $y, $this->prepareColor( $color ) );
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
}