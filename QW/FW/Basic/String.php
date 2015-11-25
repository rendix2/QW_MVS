<?php

namespace QW\FW\Basic;

use QW\FW\Boot\IllegalArgumentException;
use QW\FW\Utils\Math\Math;
use QW\FW\Validator;

class String extends Object {
	const MANACHER_DELIMITER = '|';
	protected static $separators;
	protected static $diac = [ 'ľ', 'š', 'č', 'ť', 'ž', 'ý', 'á', 'í', 'é', 'Č', 'Á', 'Ž', 'Ý', 'ó', 'ů', 'ú', 'ě',
	                           'ř' ];
	protected static $cor = [ 'l', 's', 'c', 't', 'z', 'y', 'a', 'i', 'e', 'C', 'A', 'Z', 'Y', 'o', 'u', 'u', 'e',
	                          'r' ];

	protected $string;
	protected $matches;
	protected $length;

	public function __construct( $string = "", $debug = FALSE ) {
		parent::__construct( $debug );

		if ( !Validator::isString( $string ) ) throw new IllegalArgumentException();

		$this->string  = (string) $string;
		$this->matches = NULL;
		$this->debug   = $debug;
		$this->length  = mb_strlen( $this->string, 'UTF-8' );

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

	private static function addBoundaries( array $cs ) {
		if ( $cs == NULL || count( $cs ) == 0 ) {
			$ret = new String( self::MANACHER_DELIMITER . self::MANACHER_DELIMITER );

			return $ret->toCharArray();
		}
		$cs2       = [ ];
		$cs2Length = count( $cs ) * 2 + 1;

		for ( $i = 0; $i < ( $cs2Length - 1 ); $i += 2 ) {
			$cs2[ $i ]     = self::MANACHER_DELIMITER;
			$cs2[ $i + 1 ] = $cs[ (int) ( $i / 2 ) ];
		}

		$cs2[ $cs2Length - 1 ] = self::MANACHER_DELIMITER;

		return $cs2;
	}

	private static function array2String( array &$array ) {
		$string = "";
		foreach ( $array as $v ) $string .= $v;

		return $string;
	}

	private static function removeBoundaries( array $cs ) {
		if ( $cs == NULL || count( $cs ) < 3 ) {
			$ret = new String( "" );

			return $ret->toCharArray();
		}

		$cs2       = [ ];
		$cs2Length = count( $cs ) - 1 / 2;

		for ( $i = 0; $i < $cs2Length; $i++ ) $cs2[ $i ] = $cs[ $i * 2 + 1 ];

		return $cs2;
	}

	public function addSlashes() {
		return new String( addslashes( $this->string ), $this->debug );
	}

	public function br2nl( $separator = PHP_EOL ) {
		$separator = in_array( $separator, self::$separators ) ? $separator : PHP_EOL;

		return $this->replaceRE( '/\<br(\s*)?\/?\>/i', $separator );
	}

	public function charAt( $x ) {
		if ( !Validator::isNumber( $x ) || $x < 0 ||
			$x > ( mb_strlen( $this->string, 'UTF-8' ) - 1 )
		) throw new IllegalArgumentException();

		return new Character( $this->string{$x}, $this->debug );
	}

	public function concatPost( $string ) {
		return new String( $this->string . (string) $string, $this->debug );
	}

	public function concatPostString( String $string ) {
		return new String( $string->string . $string->string, $this->debug );
	}

	public function concatPre( $string ) {
		return new String( (string) $string . $this->string, $this->debug );
	}

	public function concatPreString( String $string ) {
		return new String( $string->string . $string->string, $this->debug );
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

//	public function equals( $string ) {
//		return $this->string == (string) $string;
	//}

	public function equalsString( String $string ) {
		return $this->string == $string->string;
	}

	public function everyFirstCharInSentenceToUpper() {
		return new String( ucwords( $this->string ), $this->debug );
	}

	public function firstCharToLower() {
		return new String( lcfirst( $this->string ), $this->debug );
	}

	public function firstCharToUpper() {
		return new String( ucfirst( $this->string ), $this->debug );
	}

	public function getFirstChar() {
		return $this->charAt( 0 );
	}

	public function getLastChar() {
		return $this->charAt( $this->getLength() - 1 );
	}

	public function getLength() {
		return $this->length;
	}

	public function getLongestPalindromeManacher() {
		if ( $this->isPalindrome() ) return $this;

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
			if ( ( $i + $p[ $i ] ) > $r ) {
				$c = $i;
				$r = $i + $p[ $i ];
			}
		}

		$len = 0;
		$c   = 0;

		for ( $i = 1; $i < $s2Length; $i++ ) if ( $len < $p[ $i ] ) {
			$len = $p[ $i ];
			$c   = $i;
		}

		$ss = Arrays::copyOfRange( $s2, $c - $len, $c + $len + 1 );

		return self::arrayToString( self::removeBoundaries( $ss ) );
	}

	public function getMatches() {
		if ( $this->matches == NULL || !is_array( $this->matches ) ) return FALSE;

		return $this->matches;
	}

	public function getMiddleChar() {
		return $this->getLength() % 2 == 0 ? $this->charAt( $this->getLength() / 2 ) : FALSE;
	}

	public function getString() {
		return $this->string;
	}

	public function indexOf( $char, $start = 0 ) {
		$strlen = $this->getLength();
		$start = Math::max( 0, $start );

		if ( mb_strlen( $char, 'UTF-8' ) != 1 || $start > $strlen || $start < 0 ) throw new IllegalArgumentException();

		for ( $i = $start; $i < $strlen; $i++ ) if ( $this->string{$i} == $char ) return $i;

		return FALSE;
	}

	public function isChar( $position, $char ) {
		return $this->charAt( Math::max( 0, $position ) ) == $char;
	}

	public function isEmpty() {
		return empty( $this->string );
	}

	public function isPalindrome() {
		return $this->reverse()
		            ->equals( $this );
	}

	public function isPalindromeBetter( $ignoreCase, $ignoreWhiteSpace, $ignoreDiacritics ) {
		$string = $this;
		if ( $ignoreCase == TRUE ) $string = $string->toLowerCase();
		if ( $ignoreWhiteSpace == TRUE ) $string = $string->replaceRE( '\\\\s', '' );
		if ( $ignoreDiacritics == TRUE ) $string = $string->removeDiacritics();

		return $string->isPalindrome();
	}

	public function ltrim( $chars = '\t\n\r\0\x0B' ) {
		return new String( ltrim( $this->string, $chars ), $this->debug );
	}

	public function nl2br( $is_xhtml = NULL ) {
		if ( !is_null( $is_xhtml || !is_bool( $is_xhtml ) ) ) throw new IllegalArgumentException();

		return new String( nl2br( $this->string, $is_xhtml ), $this->debug );
	}

	public function pad( $length, $padString, $padType ) {
		return new String( str_pad( $this->string, $length, $padString, $padType ), $this->debug );
	}

	public function printf( $args = NULL ) {
		$args = new String( $args );

		return new String( printf( $this->string, $args ), $this->debug );
	}

	public function removeDiacritics() {
		return $this->replace( self::$diac, self::$cor );
	}

	public function removeHTMLTags( $allowable_tags = NULL ) {
		return new String( strip_tags( $this->string, $allowable_tags ), $this->debug );
	}

	public function removeSlashes() {
		return new String( stripslashes( $this->string ) );
	}

	public function repeat( $multiplier ) {
		return new String( str_repeat( $this->string, max( 0, $multiplier ) ), $this->debug );
	}

	public function replace( $what, $to ) {
		if ( !is_array( $what ) || !is_array( $to ) || !is_string( $what ) ||
			!is_string( $to )
		) throw new IllegalArgumentException();

		return new String( str_replace( $what, $to, $this->string ), $this->debug );
	}

	public function replaceRE( $what, $to ) {
		if ( !is_array( $what ) || !is_array( $to ) || !is_string( $what ) ||
			!is_string( $to )
		) throw new IllegalArgumentException();

		if ( is_string( $what ) ) return new String( preg_replace( '#' . preg_quote( $what, '#' ) . '#', $to,
			$this->string ), $this->debug );

		return new String( preg_replace( $what, $to, $this->string ),
			$this->debug );
	}

	public function reverse() {
		return new String( strrev( $this->string ), $this->debug );
	}

	public function rtrim( $chars = '\t\n\r\0\x0B' ) {
		return new String( rtrim( $this->string, $chars ), $this->debug );
	}

	public function setStringFromArray( array &$array ) {
		$this->string = self::array2String( $array );

		return $this;
	}

	public function shuffle() {
		return new String( str_shuffle( $this->string ), $this->debug );
	}

	public function sprintf( $format ) {
		$format = new String( $format );

		return new String( sprintf( $this->string, $format ), $this->debug );
	}

	public function starts( $string ) {
		return mb_strpos( (string) $this->string, $string, 0, 'UTF-8' );
	}

	public function subString( $start, $end = NULL ) {
		return new String( mb_substr( $this->string, Math::max( 0, $start ),
			Math::max( 0, Math::min( Math::max( 0, $end ), $this->getLength() - 1 ) ), 'UTF-8' ), $this->debug );
	}

	public function toCharArray() {
		$array = [ ];

		for ( $i = 0; $i < $this->getLength(); $i++ ) $array[ $i ] = $this->charAt( $i );

		return $array;
	}

	public function toLowerCase() {
		return new String( mb_strtolower( $this->string, 'UTF-8' ), $this->debug );
	}

	public function toUpperCase() {
		return new String( mb_strtoupper( $this->string, 'UTF-8' ), $this->debug );
	}

	public function trim( $chars = '\t\n\r\0\x0B' ) {
		return new String( trim( $this->string, $chars ), $this->debug );
	}

	public function wordsCount() {
		return str_word_count( $this->string );
	}
}