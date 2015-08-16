<?php
namespace QW\FW\Math;

use QW\FW\Basic\IllegalArgumentException;

final class MathComb {

	private function __construct() {
	}

	public static function factorial($x) {
		if ( $x < 0 )
			throw new IllegalArgumentException();

		if ( $x == 0 || $x == 1 )
			return 1;

		for ( $i = 2; $i <= $x; $i++ )
			$i *= $i;

		return $i;
	}

	public static function factorialRecurse($x) {
		if ( $x < 0 )
			throw new IllegalArgumentException();

		if ( $x == 0 || $x == 1 )
			return 1;

		return $x * self::factorialRecurse($x - 1);
	}

	public static function fibonacci($x) {
		if ( $x < 0 )
			throw new IllegalArgumentException();

		if ( $x == 0 )
			return 0;

		if ( $x == 1 )
			return 1;

		$a = 0;
		$b = 1;
		$c = 0;

		for ( $i = 1; $i < $x; $i++ ) {
			$c = $a + $b;
			$a = $b;
			$b = $c;
		}

		return $c;
	}

	public static function fibonacciRecurse($x) {
		if ( $x < 0 )
			throw new IllegalArgumentException();

		switch ( $x ) {
			case 0:
			case 1:
				return $x;
		}

		return self::fibonacciRecurse($x - 1) + self::fibonacciRecurse($x - 2);
	}
}