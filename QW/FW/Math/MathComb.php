<?php
namespace QW\FW\Math;

use QW\FW\Boot\IllegalArgumentException;
use QW\FW\Boot\PrivateConstructException;

final class MathComb {

	static $fib = [ ];
	static private $fibMemo = [ ];

	public function __construct() {
		throw new PrivateConstructException();
	}

	public static function factorial( $x ) {
		if ( $x < 0 ) throw new IllegalArgumentException();

		if ( $x == 0 || $x == 1 ) return 1;

		for ( $i = 2; $i <= $x; $i++ ) $i *= $i;

		return $i;
	}

	public static function factorialRecurse( $x ) {
		if ( $x < 0 ) throw new IllegalArgumentException();

		if ( $x == 0 || $x == 1 ) return 1;

		return $x * self::factorialRecurse( $x - 1 );
	}

	public static function fibonacci( $x ) {
		if ( $x < 0 ) throw new IllegalArgumentException();

		if ( $x == 0 ) return 0;

		if ( $x == 1 ) return 1;

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

	public static function fibonacciBetter( $x ) {
		foreach ( range( 1, $x + 1 ) as $k ) {

			if ( $k <= 2 ) $f = 1;
			else $f = self::$fib[ $k - 1 ] + self::$fib[ $k ];

			self::$fib[ $k ] = $f;
		}

		return self::$fib[ $x ];
	}

	// constant O(n)
	public static function fibonacciBetterRecurse( $x ) {
		if ( $x < 0 ) throw new IllegalArgumentException();
		if ( in_array( $x, self::$fibMemo ) ) return self::$fibMemo[ $x ];

		$f                   = self::fibonacciBetterRecurse( $x - 1 ) + self::fibonacciBetterRecurse( $x - 2 );
		self::$fibMemo[ $x ] = $f;

		return $f;
	}


	// exponential!!! O(2^(n/2))
	public static function fibonacciRecurse( $x ) {
		if ( $x < 0 ) throw new IllegalArgumentException();

		switch ( $x ) {
			case 0:
			case 1:
				return $x;
		}

		return self::fibonacciRecurse( $x - 1 ) + self::fibonacciRecurse( $x - 2 );
	}

}