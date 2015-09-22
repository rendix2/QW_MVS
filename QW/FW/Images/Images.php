<?php

namespace QW\FW\Images;

use QW\FW\Basic\Object;
use QW\FW\Boot\IllegalArgumentException;
use QW\FW\Boot\NullPointerException;
use QW\FW\Boot\RuntimeException;
use QW\FW\Paint\Color;
use QW\FW\Paint\Point;

final class Images extends Object {
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

	public function arc( Point $center, $width, $height, $start, $end, Color $color = NULL ) {
		if ( !$center->isInImage( $this ) ) throw new IllegalArgumentException();

		imagearc( $this->imageResource, $center->getX(), $center->getY(), $width, $height, $start, $end,
			$this->prepareColor( $color ) );
	}

	public function arcFilled( Point $center, $width, $height, $start, $end, $style, Color $color = NULL ) {
		if ( !$center->isInImage( $this ) ) throw new IllegalArgumentException();

		imagefilledarc( $this->imageResource, $center->getX(), $center->getY(), $width, $height, $start, $end,
			$this->prepareColor( $color ), $style );
	}

	public function destroyImage() {
		if ( is_resource( $this->imageResource ) ) {
			imagedestroy( $this->imageResource );

			return TRUE;
		}

		return FALSE;
	}

	public function ellipse( Point $center, $width, $height, Color $color = NULL ) {
		if ( !$center->isInImage( $this ) ) throw new IllegalArgumentException();
		imageellipse( $this->imageResource, $center->getX(), $center->getY(), $width, $height,
			$this->prepareColor( $color ) );
	}

	public function ellipseFilled( Point $center, $width, $height, Color $color = NULL ) {
		if ( !$center->isInImage( $this ) ) throw new IllegalArgumentException();
		imagefilledellipse( $this->imageResource, $center->getX(), $center->getY(), $width, $height,
			$this->prepareColor( $color ) );
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

	public function line( Point $start, Point $end, Color $color = NULL ) {
		if ( !$start->isInImage( $this ) || $end->isInImage( $this ) ) throw new IllegalArgumentException();
		imageline( $this->imageResource, $start->getX(), $start->getY(), $end->getX(), $end->getY(),
			$this->prepareColor( $color ) );
	}

	public function polygon( array $points, $numPoints, Color $color = NULL ) {
		imagepolygon( $this->imageResource, $this->preparePolygon( $points ), $numPoints,
			$this->prepareColor( $color ) );
	}

	public function polygonFilled( array $points, $numPoints, Color $color = NULL ) {
		imagefilledpolygon( $this->imageResource, $this->preparePolygon( $points ), $numPoints,
			$this->prepareColor( $color ) );
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

	private function preparePolygon( array $points ) {
		$pointsAll = [ ];

		foreach ( $points as $point ) if ( $point instanceof Point ) {
			if ( !$point->isInImage( $this ) ) throw new IllegalArgumentException();

			$pointsAll[] = $point->getX();
			$pointsAll[] = $point->getY();
		}

		return $pointsAll;
	}

	public function rectangle( Point $leftUp, Point $rightDown, Color $color = NULL ) {
		if ( !$leftUp->isInImage( $this ) || !$rightDown->isInImage( $this ) ) throw new IllegalArgumentException();

		imagerectangle( $this->imageResource, $leftUp->getX(), $leftUp->getY(), $rightDown->getX(), $rightDown->getY(),
			$this->prepareColor( $color ) );
	}

	public function rectangleFilled( Point $leftUp, Point $rightDown, Color $color = NULL ) {
		if ( !$leftUp->isInImage( $this ) || !$rightDown->isInImage( $this ) ) throw new IllegalArgumentException();
		imagefilledrectangle( $this->imageResource, $leftUp->getX(), $leftUp->getY(), $rightDown->getX(),
			$rightDown->getY(), $this->prepareColor( $color ) );
	}

	public function rotate( $angle, $bgdColor, $ignoreTransparent ) {
		imagerotate( $this->imageResource, $angle, $bgdColor, $ignoreTransparent );
	}

	public function setBackgroundColorO( Color $color = NULL ) {
		if ( $color == NULL ) throw new NullPointerException();
		imagecolorallocate( $this->imageResource, $color->getRed(), $color->getGreen(), $color->getBlue() );
	}

	public function setCharHorizontally( $fontSize, Point $point, $char, Color $color = NULL ) {
		if ( !$point->isInImage( $this ) ) throw new IllegalArgumentException();

		imagechar( $this->imageResource, $fontSize, $point->getX(), $point->getY(), $char,
			$this->prepareColor( $color ) );
	}

	public function setCharVertically( $fontSize, Point $point, $char, Color $color = NULL ) {
		if ( !$point->isInImage( $this ) ) throw new IllegalArgumentException();
		imagecharup( $this->imageResource, $fontSize, $point->getX(), $point->getY(), $char,
			$this->prepareColor( $color ) );
	}

	public function setFontCharHorizontally( $fontPath, Point $point, $char, Color $color = NULL ) {
		if ( !$point->isInImage( $this ) ) throw new IllegalArgumentException();
		imagechar( $this->imageResource, $this->prepareFont( $fontPath ), $point->getX(), $point->getY(), $char,
			$this->prepareColor( $color ) );
	}

	public function setFontCharVertically( $fontPath, Point $point, $char, Color $color = NULL ) {
		if ( !$point->isInImage( $this ) ) throw new IllegalArgumentException();
		imagecharup( $this->imageResource, $this->prepareFont( $fontPath ), $point->getX(), $point->getY(), $char,
			$this->prepareColor( $color ) );
	}

	public function setFontTextHorizontally( $fontPath, Point $point, $string, Color $color = NULL ) {
		if ( !$point->isInImage( $this ) ) throw new IllegalArgumentException();
		imagestring( $this->imageResource, $this->prepareFont( $fontPath ), $point->getX(), $point->getY(), $string,
			$this->prepareColor( $color ) );
	}

	public function setFontTextVertically( $fontPath, Point $point, $string, Color $color = NULL ) {
		if ( !$point->isInImage( $this ) ) throw new IllegalArgumentException();
		imagestringup( $this->imageResource, $this->prepareFont( $fontPath ), $point->getX(), $point->getY(), $string,
			$this->prepareColor( $color ) );
	}

	public function setPixel( Point $point, Color $color ) {
		if ( !$point->isInImage( $this ) ) throw new IllegalArgumentException();
		imagesetpixel( $this->imageResource, $point->getX(), $point->getY(), $this->prepareColor( $color ) );
	}

	public function setTextColorO( Color $color = NULL ) {
		if ( $color == NULL ) throw new NullPointerException();

		$this->imageTextColor =
			imagecolorallocate( $this->imageResource, $color->getRed(), $color->getGreen(), $color->getBlue() );
	}

	public function setTextHorizontally( $fontSize, Point $point, $string, Color $color = NULL ) {
		if ( !$point->isInImage( $this ) ) throw new IllegalArgumentException();
		imagestring( $this->imageResource, $fontSize, $point->getX(), $point->getY(), $string,
			$this->prepareColor( $color ) );
	}

	public function setTextVertically( $fontSize, Point $point, $string, Color $color = NULL ) {
		if ( !$point->isInImage( $this ) ) throw new IllegalArgumentException();
		imagestringup( $this->imageResource, $fontSize, $point->getX(), $point->getY(), $string,
			$this->prepareColor( $color ) );
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

	public function triangle( Point $point1, Point $point2, Point $point3, Color $color ) {
		if ( !$point1->isInImage( $this ) || !$point2->isInImage( $this ) ||
			!$point3->isInImage( $this )
		) throw new IllegalArgumentException();

		$this->line( $point1, $point2, $this->prepareColor( $color ) );
		$this->line( $point2, $point3, $this->prepareColor( $color ) );
		$this->line( $point3, $point1, $this->prepareColor( $color ) );
	}
}