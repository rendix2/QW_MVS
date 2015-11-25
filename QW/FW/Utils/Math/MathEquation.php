<?php
namespace QW\FW\Utils\Math;

use QW\FW\Boot\PrivateConstructException;

final class MathEquation {
	public function __construct() {
		throw new PrivateConstructException();
	}

	public static function discriminant2( $a, $b, $c ) {
		return Math::power( $b, 2 ) - 4 * $a * $c;
	}

	public static function discriminant3( $a, $b, $c, $d ) {
		return 18 * $a * $b * $c * $d - 4 * Math::power( $b, 3 ) * $d + Math::power( $b, 2 ) * Math::power( $c, 2 ) -
		4 * $a * Math::power( $c, 3 ) - 27 * Math::power( $a, 2 ) * Math::power( $d, 2 );
	}

	public static function solveCubicEquation( $a, $b, $c, $d ) {
		$dis = self::discriminant3( $a, $b, $c, $d );

		if ( $d == 0 ) {
			$resQuad = self::solveQuadraticEquation( $b, $c, $d );

			return [ 0, $resQuad[ 0 ], $resQuad[ 1 ] ];
		}

		if ( $dis == 0 ) {

		}
		else if ( $dis > 0 ) {

		}
		else if ( $dis < 0 ) {

		}

		return;
	}

	public static function solveLinearEquation( $a, $b ) {
		return -$b / $a;
	}

	public static function solveQuadraticEquation( $a, $b, $c ) {
		if ( $b == 0 && $c <= 0 ) {
			$c = Math::abs( $c );
			$c /= $a;
			$cSqrt = Math::squareRoot( $c );

			return [ 0 => $cSqrt, 1 => -$cSqrt ];
		}

		$d = self::discriminant2( $a, $b, $c );

		if ( $d < 0 ) return NULL;
		else if ( $d == 0 || $a == 0 ) return [ 0 => -$b / 2 * $a, 1 => NULL ];
		else return [ 0 => -$b + Math::squareRoot( $d ) / ( 2 * $a ), 1 => -$b - Math::squareRoot( $d ) / ( 2 * $a ) ];
	}
}