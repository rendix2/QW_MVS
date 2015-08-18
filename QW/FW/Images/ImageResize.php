<?php

namespace QW\FW\Images;

use QW\FW\Boot\PrivateConstructException;
use QW\FW\Config;
use QW\FW\Math\Math;

final class ImageResize {
	public function __construct () {
		throw new PrivateConstructException();
	}

	public static function canResize ( $imagePath ) {
		$pictureInfo  = getimagesize( $imagePath );
		$memoryNeeded =
			round( ( $pictureInfo[ 0 ] * $pictureInfo[ 1 ] * $pictureInfo[ 'bits' ] * $pictureInfo[ 'channels' ] / 8 +
					Math::power( 2, 16 ) ) * 1.65 );
		$memoryLimit  = str_replace( 'M', '', Config::getMemoryLimit() ) * Math::power( 2, 20 );

		return ( $memoryLimit > ( $memoryNeeded + memory_get_usage( TRUE ) ) ) ? TRUE : FALSE;
	}

	//functios from Jakub Vrána => php.vrana.cz
	// my edit: check for file exists($file_in)

	public static function image_resize ( $file_in, $file_out, $width, $height ) {
		if ( !file_exists( $file_in ) ) return FALSE;

		$imagesize = getimagesize( $file_in );

		if ( ( !$width && !$height ) || !$imagesize[ 0 ] || !$imagesize[ 1 ] ) return FALSE;

		if ( $imagesize[ 0 ] == $width && $imagesize[ 1 ] == $height ) return copy( $file_in, $file_out );

		switch ( $imagesize[ 2 ] ) {
			case 1:
				$img = imagecreatefromgif( $file_in );
				break;
			case 2:
				$img = imagecreatefromjpeg( $file_in );
				break;
			case 3:
				$img = imagecreatefrompng( $file_in );
				break;
			default:
				return FALSE;
				break;
		}

		if ( !$img ) return FALSE;

		$img2 = imagecreatetruecolor( $width, $height );
		imagecopyresampled( $img2, $img, 0, 0, 0, 0, $width, $height, $imagesize[ 0 ], $imagesize[ 1 ] );

		if ( $imagesize[ 2 ] == 2 ) return imagejpeg( $img2, $file_out );
		else if ( $imagesize[ 2 ] == 1 && function_exists( "imagegif" ) ) {
			imagetruecolortopalette( $img2, FALSE, 256 );

			return imagegif( $img2, $file_out );
		}
		else
			return imagepng( $img2, $file_out );
	}

	// http://www.pavlatka.cz/2012/05/php-enough-memory-manage-picture/
	// calculate with used ram - my edit

	public static function image_shrink_size ( $file_in, $max_x = 0, $max_y = 0 ) {
		list( $width, $height ) = getimagesize( $file_in );

		if ( !$width || !$height ) return [ 0, 0 ];

		if ( $max_x && $width > $max_x ) {
			$height = round( $height * $max_x / $width );
			$width  = $max_x;
		}

		if ( $max_y && $height > $max_y ) {
			$width = round( $width * $max_y / $height );
			$height = $max_y;
		}

		return [ $width, $height ];
	}

}