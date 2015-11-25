<?php

namespace QW\FW\Utils\Math;

use QW\FW\Boot\IllegalArgumentException;
use QW\FW\Boot\PrivateConstructException;

final class MathDiscreet {

	public function __construct() {
		throw new PrivateConstructException();
	}

	public static function gcd( $a, $b ) {
		if ( $a < 1 || $b < 1 ) throw new IllegalArgumentException();

		while ( $b != 0 ) {
			$tmp = $a;
			$a   = $b;
			$b   = $tmp % $b;
		}

		return $a;
	}

	public static function gcdRecourse( $a, $b ) {
		if ( $b == 0 ) return $a;

		return self::gcdRecourse( $b, $a % $b );
	}

	public static function horner( $x, $koeficienty, $stupen ) {
		$r = 0;

		for ( $i = 0; $i < $stupen; $i++ ) $r = $r * $x + $koeficienty[ $i ];

		return $r;
	}

	public static function isPerfect( $number ) {
		if ( $number % 2 == 1 ) return FALSE;

		$result = 1;
		$i      = 2;

		while ( $i * $i <= $number ) {
			if ( $number % $i == 0 ) {
				$result += $i;
				$result += $number / $i;
			}
			$i++;
		}

		if ( $i * $i == $number ) $result -= $i;

		return $result == $number;
	}

	public static function isPrime( $number ) {

		switch ( $number ) {
			case 1:
				return FALSE;
			case 2:
				return TRUE;
		}

		if ( $number % 2 == 2 ) return FALSE;

		for ( $i = 3; $i < Math::squareRoot( $number ); $i += 2 ) if ( $number % $i == 0 ) return FALSE;

		return TRUE;
	}

	public static function isPrimeBetter( $number ) {
		if ( $number <= 1 ) return FALSE;
		else if ( $number <= 3 ) return TRUE;
		else if ( $number % 2 == 0 || $number % 3 == 0 ) return FALSE;

		$i = 5;

		while ( $i * $i <= $number ) {
			if ( $number % $i == 0 || $number % ( $i + 2 ) == 0 ) return FALSE;
			$i += 6;
		}

		return TRUE;
	}

	public static function lcm( $a, $b ) {
		if ( $a == 0 || $b == 0 ) return 0;

		return ( $a * $b ) / self::gcd( $a, $b );
	}

	public static function lcmRecourse( $a, $b ) {
		if ( $a == 0 || $b == 0 ) return 0;

		return ( $a * $b ) / self::gcdRecourse( $a, $b );
	}

	public static function sieveOfEratosthenes( $number ) {
		$sieve      = [ ];
		$sieve[ 0 ] = $sieve[ 1 ] = TRUE;
		$squareRoot = Math::squareRoot( $number );

		for ( $i = 2; $i <= $squareRoot; $i++ ) {
			if ( $sieve[ $i ] == TRUE ) continue;

			for ( $j = 2 * $i; $j < $number; $j += $i ) $sieve[ $j ] = TRUE;
		}

		return $sieve;
	}
}