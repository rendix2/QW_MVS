<?php

namespace QW\FW\WebDesign\Images;


use QW\FW\Basic\Object;
use QW\FW\Boot\IllegalArgumentException;
use QW\FW\Boot\NullPointerException;
use QW\FW\Boot\RuntimeException;
use QW\FW\Utils\Math\Geom\Point;
use QW\FW\WebDesign\Paint\Color;

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
		$this->width = NULL;
		$this->height = NULL;
	}

	public function antialias( $enable = TRUE ) {
		if ( !is_bool( $enable ) ) throw new IllegalArgumentException();

		return imageantialias( $this->imageResource, $enable );
	}

	public function arc( Point $center, $width, $height, $start, $end, $style = NULL, $filled = FALSE, Color $color = NULL ) {
		if ( !$center->isInImage( $this ) ) throw new IllegalArgumentException();
		if ( $filled == TRUE && $style == NULL ) throw new IllegalArgumentException();

		$filled == TRUE ?
			imagefilledarc( $this->imageResource, $center->getX(), $center->getY(), $width, $height, $start, $end,
				$this->prepareColor( $color ), $style ) :

			imagearc( $this->imageResource, $center->getX(), $center->getY(), $width, $height, $start, $end,
				$this->prepareColor( $color ) );
	}

	public function destroyImage() {
		if ( is_resource( $this->imageResource ) ) {
			imagedestroy( $this->imageResource );

			return TRUE;
		}

		return FALSE;
	}

	public function ellipse( Point $center, $width, $height, $filled = FALSE, Color $color = NULL ) {
		if ( !$center->isInImage( $this ) ) throw new IllegalArgumentException();

		$filled == TRUE ? imagefilledellipse( $this->imageResource, $center->getX(), $center->getY(), $width, $height,
			$this->prepareColor( $color ) ) :
			imageellipse( $this->imageResource, $center->getX(), $center->getY(), $width, $height,
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

	public function polygon( array $points, $numPoints, $filled = FALSE, Color $color = NULL ) {
		$filled == TRUE ? imagefilledpolygon( $this->imageResource, $this->preparePolygon( $points ), $numPoints,
			$this->prepareColor( $color ) ) :
			imagepolygon( $this->imageResource, $this->preparePolygon( $points ), $numPoints,
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

	public function rectangle( Point $leftUp, Point $rightDown, $filled = FALSE, Color $color = NULL ) {
		if ( !$leftUp->isInImage( $this ) || !$rightDown->isInImage( $this ) ) throw new IllegalArgumentException();

		$filled == TRUE ?
			imagefilledrectangle( $this->imageResource, $leftUp->getX(), $leftUp->getY(), $rightDown->getX(),
				$rightDown->getY(), $this->prepareColor( $color ) ) :
			imagerectangle( $this->imageResource, $leftUp->getX(), $leftUp->getY(), $rightDown->getX(),
				$rightDown->getY(), $this->prepareColor( $color ) );
	}

	public function rotate( $angle, $bgdColor, $ignoreTransparent ) {
		imagerotate( $this->imageResource, $angle, $bgdColor, $ignoreTransparent );
	}

	public function setBackgroundColor( Color $color = NULL ) {
		if ( $color == NULL ) throw new NullPointerException();
		imagecolorallocate( $this->imageResource, $color->getRed(), $color->getGreen(), $color->getBlue() );
	}

	public function setChar( $fontSize, Point $point, $char, $vertically = FALSE, Color $color = NULL ) {
		if ( !$point->isInImage( $this ) ) throw new IllegalArgumentException();

		$vertically == FALSE ?

			imagechar( $this->imageResource, $fontSize, $point->getX(), $point->getY(), $char,
				$this->prepareColor( $color ) ) :
			imagecharup( $this->imageResource, $fontSize, $point->getX(), $point->getY(), $char,
				$this->prepareColor( $color ) );
	}

	public function setFontChar( $fontPath, Point $point, $char, $vertically = FALSE, Color $color = NULL ) {
		if ( !$point->isInImage( $this ) ) throw new IllegalArgumentException();

		$vertically == FALSE ?
			imagechar( $this->imageResource, $this->prepareFont( $fontPath ), $point->getX(), $point->getY(), $char,
				$this->prepareColor( $color ) ) :
			imagecharup( $this->imageResource, $this->prepareFont( $fontPath ), $point->getX(), $point->getY(), $char,
				$this->prepareColor( $color ) );
	}

	public function setFontText( $fontPath, Point $point, $string, $vertically = FALSE, Color $color = NULL ) {
		if ( !$point->isInImage( $this ) ) throw new IllegalArgumentException();

		$vertically == FALSE ?
			imagestring( $this->imageResource, $this->prepareFont( $fontPath ), $point->getX(), $point->getY(), $string,
				$this->prepareColor( $color ) ) :
			imagestringup( $this->imageResource, $this->prepareFont( $fontPath ), $point->getX(), $point->getY(),
				$string, $this->prepareColor( $color ) );
	}

	public function setPixel( Point $point, Color $color ) {
		if ( !$point->isInImage( $this ) ) throw new IllegalArgumentException();
		imagesetpixel( $this->imageResource, $point->getX(), $point->getY(), $this->prepareColor( $color ) );
	}

	public function setText( $fontSize, Point $point, $string, $vertically = FALSE, Color $color = NULL ) {
		if ( !$point->isInImage( $this ) ) throw new IllegalArgumentException();

		$vertically == FALSE ?

			imagestring( $this->imageResource, $fontSize, $point->getX(), $point->getY(), $string,
				$this->prepareColor( $color ) ) :
			imagestringup( $this->imageResource, $fontSize, $point->getX(), $point->getY(), $string,
				$this->prepareColor( $color ) );
	}

	public function setTextColor( Color $color = NULL ) {
		if ( $color == NULL ) throw new NullPointerException();

		$this->imageTextColor =
			imagecolorallocate( $this->imageResource, $color->getRed(), $color->getGreen(), $color->getBlue() );
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