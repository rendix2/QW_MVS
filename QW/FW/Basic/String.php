<?php

namespace QW\FW\Basic;

use QW\FW\Boot\IllegalArgumentException;
use QW\FW\Validator;

class String extends Object {
	protected static $separators;
	protected $string;
	protected $matches;

	public function __construct( $string = "", $debug = FALSE ) {
		parent::__construct( $debug );

		$this->string     = (string) $string;
		$this->matches    = NULL;
		self::$separators = [ "\n", "\r", "\r\n", "\n\r", chr( 30 ), chr( 155 ), PHP_EOL ];
	}

	function __destruct() {
		$this->matches = NULL;
		$this->string  = NULL;
		self::$separators = NULL;

		parent::__destruct();
	}

	public function __toString() {
		return $this->string;
	}

	public static function ArrayToString( array &$array ) {
		return new String( self::array2String( $array ) );
	}

	private static function addBoundaries( $cs ) {
		if ( $cs == NULL || count( $cs ) == 0 ) {
			$ret = new String( '||' );

			return $ret->toCharArray();
		}
		$cs2       = [ ];
		$cs2Length = count( $cs );

		for ( $i = 0; $i < ( $cs2Length - 1 ); $i = $i + 2 ) {
			$cs2[ $i ]     = '|';
			$cs2[ $i + 1 ] = $cs[ (int) ( $i / 2 ) ];
		}

		$cs2[ $cs2Length - 1 ] = '|';

		return $cs2;
	}

	private static function array2String( array &$array ) {
		$string = "";
		foreach ( $array as $v ) {
			$string .= $v;
		}

		return $string;
	}

	private static function removeBoundaries( $cs ) {
		if ( $cs == NULL || count( $cs ) < 3 ) {
			$ret = new String( "" );

			return $ret->toCharArray();
		}

		$cs2       = [ ];
		$cs2Length = count( $cs2 );

		for ( $i = 0; $i < $cs2Length; $i++ ) {
			$cs2[ $i ] = $cs[ $i * 2 + 1 ];
		}

		return $cs2;
	}

	public function addSlashes() {
		return new String( addslashes( $this->string ) );
	}

	public function br2nl( $separator = PHP_EOL ) {
		$separator = in_array( $separator, self::$separators ) ? $separator : PHP_EOL;

		return $this->replaceRE( '/\<br(\s*)?\/?\>/i', $separator );
	}

	public function charAt( $x ) {
		if ( !Validator::isNumber( $x ) || $x < 0 ||
			$x > ( mb_strlen( $this->string, 'UTF-8' ) - 1 )
		) throw new IllegalArgumentException();

		return $this->string{$x};
	}

	public function concatPost( $string ) {
		return new String( $this->string . (string) $string );
	}

	public function concatPostString( String $string ) {
		return new String( $string->string . $string->string );
	}

	public function concatPre( $string ) {
		return new String( (string) $string . $this->string );
	}

	public function concatPreString( String $string ) {
		return new String( $string->string . $string->string );
	}

	public function contains( $string ) {
		return mb_strpos( $this->string, (string) $string, 0, 'UTF-8' ) == TRUE ? TRUE : FALSE;
	}

	public function containsRE( $string ) {
		return preg_match( $this->string, '#' . preg_quote( (string) $string, '#' ) . '#', $this->matches );
	}

	public function ends( $string ) {
		return mb_strpos( $this->string, (string) $string,
			mb_strlen( $this->string, 'UTF-8' ) - mb_strlen( (string) $string, 'UTF-8' ), 'UTF-8' ) == TRUE ? TRUE :
			FALSE;
	}

	public function equals( $string ) {
		return $this->string == (string) $string;
	}

	public function equalsString( String $string ) {
		return $this->string == $string->string;
	}

	public function everyFirstCharInSentenceToUpper() {
		return new String( ucwords( $this->string ) );
	}

	public function firstCharToLower() {
		return new String( lcfirst( $this->string ) );
	}

	public function firstCharToUpper() {
		return new String( ucfirst( $this->string ) );
	}

	public function getLength() {
		return mb_strlen( $this->string, 'UTF-8' );
	}

	public function getLongestPalindromeManacher() {
		$s2       = self::addBoundaries( $this->toCharArray() );
		$s2Length = count( $s2 );
		$p        = [ ];
		$c        = 0;
		$r        = 0;
		$m        = 0;
		$n        = 0;

		for ( $i = 1; $i < $s2Length; $i++ ) {
			if ( $i > $r ) {
				$p[ $i ] = 0;
				$m       = $i - 1;
				$n       = $i + 1;
			}
			else {
				$i2 = $c * 2 - $i;

				if ( $p[ $i2 ] < ( $r - $i ) ) {
					$p[ $i ] = $p[ $i2 ];
					$m       = -1;
				}
				else {
					$p[ $i ] = $r - $i;
					$n       = $r + 1;
					$m       = $i * 2 - $n;
				}
			}

			while ( $m >= 0 && $n < $s2Length && $s2[ $m ] == $s2[ $n ] ) {
				$p[ $i ]++;
				$m--;
				$n++;
			}
			if ( $i + $p[ $i ] > $r ) {
				$c = $i;
				$r = $i + $p[ $i ];
			}
		}

		$len = 0;
		$c   = 0;

		for ( $i = 1; $i < $s2Length; $i++ ) {
			if ( $len < $p[ $i ] ) {
				$len = $p[ $i ];
				$c   = $i;
			}
		}

		$ss = Arrays::copyOfRange( $s2, $c - $len, $c + $len + 1 );

		return self::charArrayToString( self::removeBoundaries( $ss ) );
	}

	public function getMatches() {
		if ( $this->matches == NULL || !is_array( $this->matches ) ) return FALSE;

		return $this->matches;
	}

	public function getString() {
		return $this->string;
	}

	public function indexOf( $char, $start = 0 ) {
		$strlen = $this->getLength();
		$start = max( 0, $start );

		if ( mb_strlen( $char, 'UTF-8' ) != 1 || $start > $strlen || $start < 0 ) throw new IllegalArgumentException();

		for ( $i = $start; $i < $strlen; $i++ ) if ( $this->string{$i} == $char ) return $i;

		return FALSE;
	}

	public function isEmpty() {
		return empty( $this->string );
	}

	public function isPalindrome() {
		return $this->reverse()
		            ->getString() == $this->getString();
	}

	public function ltrim( $chars = '\t\n\r\0\x0B' ) {
		return new String( ltrim( $this->string, $chars ) );
	}

	public function nl2br( $is_xhtml = NULL ) {
		if ( !is_null( $is_xhtml || !is_bool( $is_xhtml ) ) ) throw new IllegalArgumentException();

		return new String( nl2br( $this->string, $is_xhtml ) );
	}

	public function printf( $args = NULL ) {
		$args = new String( $args );

		return new String( printf( $this->string, $args ) );
	}

	public final function removeHTMLTags( $allowable_tags = NULL ) {
		return new String( strip_tags( $this->string, $allowable_tags ) );
	}

	public function removeSlashes() {
		return new String( stripslashes( $this->string ) );
	}

	public function repeat( $multiplier ) {
		return new String( str_repeat( $this->string, max( 0, $multiplier ) ) );
	}

	public function replace( $what, $to ) {
		return new String( str_replace( (string) $what, (string) $to, $this->string ) );
	}

	public function replaceRE( $what, $to ) {
		return new String( preg_replace( '#' . preg_quote( (string) $what, '#' ) . '#', (string) $to, $this->string ) );
	}

	public function reverse() {
		return new String( strrev( $this->string ) );
	}

	// http://php.net/manual/en/function.nl2br.php

	public function rtrim( $chars = '\t\n\r\0\x0B' ) {
		return new String( rtrim( $this->string, $chars ) );
	}

	public function setStringFromArray( array &$array ) {
		$this->string = self::array2String( $array );

		return $this;
	}

	public function sprintf( $format ) {
		$format = new String( $format );

		return new String( sprintf( $this->string, $format ) );
	}

	public function starts( $string ) {
		return mb_strpos( (string) $this->string, $string, 0, 'UTF-8' );
	}

	public function subString( $start, $end = NULL ) {
		if ( $start < 0 ||
			( $end > mb_strlen( $this->string, 'UTF-8' ) && $end != NULL )
		) throw new IllegalArgumentException();

		return new String( mb_substr( $this->string, $start, $end, 'UTF-8' ) );
	}

	public function toCharArray() {
		$array = [ ];

		for ( $i = 0; $i < $this->getLength(); $i++ ) {
			$array[] = $this->charAt( $i );
		}

		return $array;
	}

	public function toLowerCase() {
		return new String( mb_strtolower( $this->string ) );
	}

	public function toUpperCase() {
		return new String( mb_strtoupper( $this->string, 'UTF-8' ) );
	}

	public function trim( $chars = '\t\n\r\0\x0B' ) {
		return new String( trim( $this->string, $chars ) );
	}

	public function wordsCount() {
		return new String( str_word_count( $this->string ) );
	}
}