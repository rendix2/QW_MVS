<?php
namespace QW\FW\Utils\Math;

use QW\FW\Boot\IllegalArgumentException;
use QW\FW\Boot\PrivateConstructException;
use QW\FW\Utils\Math\Matrix\Matrix;

final class Math {

	public function __construct() {
		throw new PrivateConstructException();
	}

	public function __toString() {
		return '<br>Math is HELL!<br>' . "\n";
	}

	public static function absoluteValue( $x ) {
		return abs( $x );
	}

	public static function ackermann( $m, $n ) {
		if ( $m >= 4 ) throw new IllegalArgumentException();
		if ( $m == 0 ) return $n + 1;
		else if ( $n == 0 ) return self::ackermann( $m - 1, 1 );
		else return self::ackermann( $m - 1, self::ackermann( $m, $n - 1 ) );
	}

	public static function ackermannInv( $z ) {
		$result = [ ];

		for ( $x = 0; $x < $z; $x++ ) // maybe <x < 3 || $x < 4 || $x < $z
			for ( $y = 0; $y < $z; $y++ ) if ( self::ackermann( $x, $y ) == $z ) $result[] = [ $x, $y ];

		return new Matrix( $result );
	}

	public static function average() {
		return self::sum() / func_num_args();
	}

	public static function binaryToDecimal( $x ) {
		return bindec( $x );
	}

	public static function binaryToHexadecimal( $x ) {
		return base_convert( $x, 2, 16 );
	}

	public static function binaryToOctal( $x ) {
		return base_convert( $x, 2, 8 );
	}

	public static function cosecans( $x ) {
		return 1 / self::sine( $x );
	}

	public static function cosine( $x ) {
		return cos( $x );
	}

	public static function cosineArcus( $x ) {
		return acos( $x );
	}

	public static function cosineArcusHyperbolic( $x ) {
		return acosh( $x );
	}

	public static function cosineHyperbolic( $x ) {
		return cosh( $x );
	}

	/*
		public static function cotangentArcusHyperbolic($x)
		{
			return self::logarithmNatural((1 + $x) / (1 - $x)) / 2;
		}

	*/

	public static function cotangent( $x ) {
		return 1 / self::tangent( $x );
	}

	public static function cotangentArcus( $x ) {
		return ( self::pi() / 2 ) - self::tangentArcus( $x );
	}

	public static function cotangentHyperbolic( $x ) {
		return ( self::cosineHyperbolic( ( $x ) / self::sineHyperbolic( $x ) ) );
	}

	public static function cubeRoot( $x ) {
		return self::power( $x, 1 / 3 );
	}

	public static function cubed( $x ) {
		return $x * $x * $x;
	}

	public static function cubedFunction( $x ) {
		return self::power( $x, 3 );
	}

	public static function decimalToBinary( $x ) {
		return decbin( $x );
	}

	public static function decimalToHexadecimal( $x ) {
		return dechex( $x );
	}

	public static function decimalToOctal( $x ) {
		return decoct( $x );
	}

	public static function degreesToRadians( $x ) {
		return reg2rad( $x );
	}

	public static function divide( $numerator, $divisor ) {
		if ( $numerator == 0 ) return 0;
		if ( $divisor == 0 ) return NAN;

		return $numerator / $divisor;
	}

	public static function hexadecimalToBinary( $x ) {
		return base_convert( $x, 16, 2 );
	}

	public static function hexadecimalToDecimal( $x ) {
		return hexdec( $x );
	}

	public static function hexadecimalToOctal( $x ) {
		return base_convert( $x, 16, 8 );
	}

	public static function hypot( $x, $y ) {
		return Math::squareRoot( $x * x, $y * $y );
	}

	public static function hypotenuseSystem( $x, $y ) {
		return hypot( $x, $y );
	}

	public static function integerDivision( $numerator, $divisor ) {
		return (int) ( (int) $numerator / (int) $divisor );
	}

	public static function integerDivisionSystem( $numerator, $divisor ) {
		return intdiv( $numerator, $divisor );
	}

	public static function inverseNumber( $x ) {
		if ( $x == 0 ) return NAN;
		if ( $x == 1 ) return 1;

		return 1 / $x;
	}

	public static function logarithm( $x, $base ) {
		if ( $base == 10 ) return self::logarithmDecade( $x );
		if ( $x < 1.0 ) return log1p( $x );

		return log( $x, $base );
	}

	public static function logarithmDecade( $x ) {
		return log10( $x );
	}

	public static function logarithmNatural( $x ) {
		return log( $x );
	}

	public static function max() {
		$max = -999999999;
		foreach ( func_get_args() as $v ) if ( $v >= $max ) $max = $v;

		return $max;
	}

	public static function maximumFromArray( array $x ) {
		return max( $x );
	}

	public static function min() {
		$min = 999999999;
		foreach ( func_get_args() as $v ) if ( $v <= $min ) $min = $v;

		return $min;
	}

	public static function minimumFromArray( array $x ) {
		return min( $x );
	}

	public static function minus( $a, $b ) {
		if ( $a == $b ) return 0;

		return $a - $b;
	}

	public static function modulo( $numerator, $divisor ) {
		return $numerator % $divisor;
	}

	public static function octalToBinary( $x ) {
		return base_convert( $x, 8, 2 );
	}

	public static function octalToDecimal( $x ) {
		return octdec( $x );
	}

	public static function octalToHexadecimal( $x ) {
		return base_convert( $x, 8, 16 );
	}

	public static function pi() {
		return pi();
	}

	public static function plus( $a, $b ) {
		if ( $a == $b ) return 2 * $a;

		return $a + $b;
	}

	public static function power( $base, $exponent ) {
		switch ( $exponent ) {
			case 0:
				return 1;
			case 1:
				return $base;
			case 1 / 2:
				return self::squareRoot( $base );
			case 1 / 3:
				return self::cubeRoot( $base );
			case -1:
				return 1 / $base;
			default:
				//return (double)phpversion() >= 5.6 ? $base ** $exponent : pow($base, $exponent);
				return pow( $base, $exponent );
		}
	}

	public static function radiansToDegrees( $x ) {
		return rad2deg( $x );
	}

	public static function randLikeJava() {
		return self::randomInterval( 0, 100 ) / 1000000;
	}

	public static function random() {
		return rand();
	}

	public static function randomBoolean() { // women logic
		return (boolean) self::randomInterval( 0, 1 );
	}

	public static function randomInterval( $from, $to ) {
		return rand( $from, $to );
	}

	public static function secans( $x ) {
		return 1 / self::cosine( $x );
	}

	public static function sine( $x ) {
		return sin( $x );
	}

	public static function sineArcus( $x ) {
		return asin( $x );
	}

	public static function sineArcusHyperbolic( $x ) {
		return asinh( $x );
	}

	public static function sineHyperbolic( $x ) {
		return sinh( $x );
	}

	public static function squareRoot( $x ) {
		return sqrt( $x );
	}

	public static function squared( $x ) {
		return $x * $x;
	}

	public static function squaredFunction( $x ) {
		return self::power( $x, 2 );
	}

	public static function sum() {
		$sum = 0;
		foreach ( func_get_args() as $v ) $sum += $v;

		return $sum;
	}

	public static function sumArray( array $x ) {
		return array_sum( $x );
	}

	public static function tangent( $x ) {
		return tan( $x );
	}

	public static function tangentArcus( $x ) {
		return atan( $x );
	}

	public static function tangentArcusHyperbolic( $x ) {
		return atanh( $x );
	}

	public static function tangentHyperbolic( $x ) {
		return tanh( $x );
	}

	public static function times( $a, $b ) {
		if ( $a == $b ) return self::squared( $a );

		return $a * $b;
	}
}