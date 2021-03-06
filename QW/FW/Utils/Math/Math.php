<?php
	namespace QW\FW\Utils\Math;

	use QW\FW\Boot\PrivateConstructException;
	use QW\FW\DataWorking\Sort\MergeSort;

	final class Math {

		const E   = 2.71828182846;
		const INF = INF;
		const NAN = NAN;
		const PI  = 3.14159265359;
		static $ackMemo = [ ];

		public function __construct () {
			throw new PrivateConstructException();
		}

		public function __toString () {
			return '<br>Math is HELL!<br>' . "\n";
		}

		public static function abs ( $x ) {
			if ( self::isPositive ( $x ) ) return $x;
			else return $x + 2 * $x;
		}

		public static function absSystem ( $x ) {
			return abs ( $x );
		}

		public static function ackermann ( $m, $n ) {
			//if ( $m >= 4 ) throw new IllegalArgumentException();
			if ( isset( self::$ackMemo[ $m ][ $n ] ) ) return self::$ackMemo[ $m ][ $n ];

			if ( $m == 0 ) return self::$ackMemo[ $m ][ $n ] = $n + 1;
			else if ( $n == 0 ) return self::$ackMemo[ $m ][ $n ] = self::ackermann ( $m - 1, 1 );
			else return self::$ackMemo[ $m ][ $n ] = self::ackermann ( $m - 1,
			isset( self::$ackMemo[ $m ][ $n ] ) ? self::$ackMemo[ $m ][ $n ] : self::ackermann ( $m, $n - 1 ) );
		}

		/*
			public static function ackermannInv( $z ) {
				$result = [ ];

				for ( $x = 0; $x < $z; $x++ ) // maybe <x < 3 || $x < 4 || $x < $z
					for ( $y = 0; $y < $z; $y++ ) if ( self::ackermann( $x, $y ) == $z ) $result[] = [ $x, $y ];

				return new Matrix( $result );//
			}
		*/
		public static function ackermannLimitedRecoursion ( $m, $n ) {
			if ( isset( self::$ackMemo[ $m ][ $n ] ) ) return self::$ackMemo[ $m ][ $n ];

			switch ( $m ) {
				case 0:
					return self::$ackMemo[ $m ][ $n ] = $n + 1;
				case 1:
					return self::$ackMemo[ $m ][ $n ] = $n + 2;
				case 2:
					return self::$ackMemo[ $m ][ $n ] = 2 * $n + 3;
				case 3:
					return self::$ackMemo[ $m ][ $n ] = self::power ( 2, $n + 3 ) - 3;
				case 4:
					return self::$ackMemo[ $m ][ $n ] =
					self::power ( 2, ( self::ackermannLimitedRecoursion ( 4, $n - 1 ) + 3 ) ) - 3;
			}
		}

		public static function arcCos ( $x ) {
			return acos ( $x );
		}

		public static function arcCosH ( $x ) {
			return acosh ( $x );
		}

		public static function arcCotg ( $x ) {
			return ( self::pi () / 2 ) - self::arcTg ( $x );
		}

		public static function arcCotgH ( $x ) {
			return self::logarithmNatural ( ( 1 + $x ) / ( 1 - $x ) ) / 2;
		}

		public static function arcSin ( $x ) {
			return asin ( $x );
		}

		public static function arcSinH ( $x ) {
			return asinh ( $x );
		}

		public static function arcTg ( $x ) {
			return atan ( $x );
		}

		public static function arcTg2Var ( $y, $x ) {
			return atan2 ( $y, $x );
		}

		public static function arcTgH ( $x ) {
			return atanh ( $x );
		}

		public static function average () {
			return self::sum ( func_get_args () ) / func_num_args ();
		}

		public static function binaryToDecimal ( $x ) {
			return bindec ( $x );
		}

		public static function binaryToHexadecimal ( $x ) {
			return base_convert ( $x, 2, 16 );
		}

		public static function binaryToOctal ( $x ) {
			return base_convert ( $x, 2, 8 );
		}

		public static function cos ( $x ) {
			return cos ( $x );
		}

		public static function cosH ( $x ) {
			return ( self::power ( self::E, 2 * $x ) + 1 ) / ( 2 * self::power ( self::E, $x ) );
		}

		public static function cosHSystem ( $x ) {
			return cosh ( $x );
		}

		public static function cosecans ( $x ) {
			return self::inverseNumber ( self::sin ( $x ) );
		}

		public static function cotg ( $x ) {
			return self::inverseNumber ( self::tg ( $x ) );
		}

		public static function cotgHSystem ( $x ) {
			return ( self::cosHSystem ( ( $x ) / self::sinH ( $x ) ) );
		}

		public static function csch ( $x ) {
			return 2 / self::power ( self::E, $x ) - self::power ( self::E, -$x );
		}

		public static function cubeRoot ( $x ) {
			return self::power ( $x, self::inverseNumber ( 3 ) );
		}

		public static function cubed ( $x ) {
			return self::power ( $x, 3 );
		}

		public static function decimalToBinary ( $x ) {
			return decbin ( $x );
		}

		public static function decimalToHexadecimal ( $x ) {
			return dechex ( $x );
		}

		public static function decimalToOctal ( $x ) {
			return decoct ( $x );
		}

		public static function degreesToRadians ( $x ) {
			return deg2rad ( $x );
		}

		public static function divide ( $numerator, $divisor ) {
			if ( $numerator == 0 ) return 0;
			if ( $divisor == 0 ) return NAN;

			return $numerator / $divisor;
		}

		public static function hexadecimalToBinary ( $x ) {
			return base_convert ( $x, 16, 2 );
		}

		public static function hexadecimalToDecimal ( $x ) {
			return hexdec ( $x );
		}

		public static function hexadecimalToOctal ( $x ) {
			return base_convert ( $x, 16, 8 );
		}

		public static function hypot ( $x, $y ) {
			return self::squareRoot ( $x * $x + $y * $y );
		}

		public static function hypotSystem ( $x, $y ) {
			return hypot ( $x, $y );
		}

		public static function intdiv1 ( $a, $b ) {
			return ( $a - $a % $b ) / $b;
		}

		public static function integerDivision ( $numerator, $divisor ) {
			return (int) ( (int) $numerator / (int) $divisor );
		}

		public static function integerDivisionSystem ( $numerator, $divisor ) {
			return intdiv ( $numerator, $divisor );
		}

		public static function inverseNumber ( $x ) {
			switch ( $x ) {
				case 0:
					return self::NAN;
				case 1:
					return 1;
				case 2:
					return 0.5;
				case 3:
					return 0.33333333333;
				case 4:
					return 0.25;
				case 5:
					return 0.2;
				case 10:
					return 0.1;
				case 100:
					return 0.01;
				case 1000:
					return 0.001;
				case 10000:
					return 0.0001;
				default:
					return 1 / $x;
			}
		}

		public static function isNegative ( $x ) {
			return $x <= 1;
		}

		public static function isPositive ( $x ) {
			return $x >= 1;
		}

		public static function logarithm ( $x, $base ) {
			if ( $base == 10 ) return self::logarithmDecade ( $x );
			if ( $x < 1.0 ) return log1p ( $x );

			return log ( $x, $base );
		}

		public static function logarithmDecade ( $x ) {
			return log10 ( $x );
		}

		public static function logarithmNatural ( $x ) {
			return log ( $x );
		}

		public static function max () {
			if ( func_num_args () == 1 ) return func_get_args ()[ 0 ];

			$max = -999999999;
			foreach ( func_get_args () as $v ) if ( $v >= $max ) $max = $v;

			return $max;
		}

		public static function maximumFromArray ( array $x ) {
			return max ( $x );
		}

		public static function mean ( array $data ) {
			$sum = 0;

			foreach ( $data as $v ) $sum += $v;

			return $sum / count ( $data );
		}

		public static function median ( array $data ) {
			$data = new MergeSort( $data );
			$data = $data->getSortedArray ();
			$len  = count ( $data );

			return ( $len % 2 == 0 ) ? ( $data[ (int) ( $len / 2 ) ] + $data[ (int) ( $len / 2 + 1 ) ] ) / 2 :
			$data[ (int) ( $len / 2 ) ];
		}

		public static function min () {
			if ( func_num_args () == 1 ) return func_get_args ()[ 0 ];

			$min = INF;
			foreach ( func_get_args () as $v ) if ( $v <= $min ) $min = $v;

			return $min;
		}

		public static function minMax ( array $numbers ) {
			$max    = $min = $numbers[ 0 ];
			$length = count ( $numbers );

			for ( $i = 1; $i < $length - 1; $i = $i + 2 ) if ( $numbers[ $i ] < $numbers[ $i + 1 ] ) {
				if ( $numbers[ $i ] < $min ) $min = $numbers[ $i ];
				if ( $numbers[ $i + 1 ] > $max ) $max = $numbers[ $i + 1 ];
			} else {
				if ( $numbers[ $i ] > $max ) $max = $numbers[ $i ];
				if ( $numbers[ $i + 1 ] < $min ) $min = $numbers[ $i + 1 ];
			}

			return [ 'min' => $min, 'max' => $max ];
		}

		public static function minimumFromArray ( array $x ) {
			return min ( $x );
		}

		public static function minus ( $a, $b ) {
			if ( $a == $b && $a > 0 ) return 0;

			return $a - $b;
		}

		public static function mode ( array $data ) {
			$maxValue = 0;
			$maxCount = 0;
			$count    = count ( $data );

			foreach ( $data as $v ) {
				$c = 0;

				foreach ( $data as $v2 ) if ( $v == $v2 ) ++$c;

				if ( $c > $maxCount ) {
					$maxCount = $c;
					$maxValue = $v;
				}
			}

			return $maxValue;
		}

		public static function modulo ( $numerator, $divisor ) {
			return $numerator % $divisor;
		}

		public static function octalToBinary ( $x ) {
			return base_convert ( $x, 8, 2 );
		}

		public static function octalToDecimal ( $x ) {
			return octdec ( $x );
		}

		public static function octalToHexadecimal ( $x ) {
			return base_convert ( $x, 8, 16 );
		}

		public static function pi () {
			return pi ();
		}

		public static function plus ( $a, $b ) {
			if ( $a == $b ) return 2 * $a;

			return $a + $b;
		}

		public static function power ( $base, $exponent ) {
			switch ( $exponent ) {
				case 0:
					return 1;
				case 1:
					return $base;
				case 2:
					return self::squared ( $base );
				case 3:
					return self::cubed ( $base );
				case 1 / 2:
					return self::squareRoot ( $base );
				case 1 / 3:
					return self::cubeRoot ( $base );
				case -1:
					return self::inverseNumber ( $base );
				case -2:
					return self::inverseNumber ( self::power ( $base, 2 ) );
				default:
					//return (double)phpversion() >= 5.6 ? $base ** $exponent : pow($base, $exponent);
					return pow ( $base, $exponent );
			}
		}

		public static function radiansToDegrees ( $x ) {
			return rad2deg ( $x );
		}

		public static function randLikeJava () {
			$x = ( 1103515245 * $x + 12345 ) % 4294967296;

			return $x / ( (double) 4294967296 );
		}

		public static function random () {
			return rand ();
		}

		public static function randomBoolean () { // women logic
			return (boolean) self::randomInterval ( 0, 1 );
		}

		public static function randomInterval ( $from, $to ) {
			return rand ( $from, $to );
		}

		public static function sec ( $x ) {
			return self::inverseNumber ( self::cos ( $x ) );
		}

		public static function secH ( $x ) {
			return 2 / self::power ( self::E, $x ) + self::power ( self::E, -$x );
		}

		public static function sin ( $x ) {
			return sin ( $x );
		}

		public static function sinH ( $x ) {
			return ( self::power ( self::E, 2 * $x ) - 1 ) / ( 2 * self::power ( self::E, $x ) );
		}

		public static function sinHSystem ( $x ) {
			return sinh ( $x );
		}

		public static function squareRoot ( $number ) {
			if ( $number < 0 ) return self::NAN;
			if ( $number == 0 ) return (float) 0;
			if ( $number == 1 ) return (float) 1;

			$a  = $number;
			$xk = $number;

			for ( $i = 0; $i < self::logarithm ( $number, 2 ) + 4; $i++ ) $xk = ( 0.5 ) * ( $xk + ( $a / $xk ) );

			return (float) $xk;
		}

		public static function squareRootSystem ( $x ) {
			return sqrt ( $x );
		}

		public static function squared ( $x ) {
			return $x * $x;
		}

		public static function squaredSystem ( $x ) {
			return self::power ( $x, 2 );
		}

		public static function sum ( array $data ) {
			$data = array_values ( $data );
			$c    = count ( $data );

			if ( $c == 1 ) return $data[ 0 ];

			$sum = 0;
			for ( $i = 0; $i < $c; $i += 2 ) {
				$sum += $data[ $i ];
				$sum += $data[ $i + 1 ];
			}

			return $sum;
		}

		public static function sumArgs () {
			$sum = 0;
			foreach ( func_get_args () as $v ) $sum += $v;

			return $sum;
		}

		public static function sumArray ( array $x ) {
			return array_sum ( $x );
		}

		public static function tg ( $x ) {
			return tan ( $x );
		}

		public static function tgHSystem ( $x ) {
			return tanh ( $x );
		}

		public static function times ( $a, $b ) {
			if ( $a == $b ) return self::squared ( $a );

			return $a * $b;
		}

		public function cotgH ( $x ) {
			return self::sinH ( $x ) / self::cosH ( $x );
		}

		public function isZero ( $x ) {
			return $x == 0;
		}

		public function tgH ( $x ) {
			return self::sinH ( $x ) / self::cosH ( $x );
		}
	}