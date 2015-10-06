<?php

namespace QW\FW\Utils\SuperGlobals;

use QW\FW\Boot\PrivateConstructException;
use QW\FW\Math\Math;

final class Session extends SuperGlobals implements ISG {
	public function __construct() {
		parent::__construct();

		throw new PrivateConstructException();
	}

	public static function end() {
		self::newId();

		$_SESSION = [ ];
		unset( $_SESSION );

		return session_destroy();
	}

	public static function get( $k ) {
		self::newId();

		if ( self::$magicQuotes ) $k = stripslashes( $k );

		$result = isset( $_SESSION[ $k ] ) ? $_SESSION[ $k ] : FALSE;;

		if ( self::$magicQuotes && !$result ) $result = stripslashes( $result );

		return $result;
	}

	public static function getAll() {
		self::newId();

		if ( self::$magicQuotes ) {
			$array = [ ];
			foreach ( $_SESSION as $k => $v ) {
				$array[ stripslashes( $k ) ] = stripslashes( $v );
			}

			return $array;
		}

		return $_SESSION;
	}

	public static function id() {
		return session_id();
	}

	public static function newId() {
		usleep( Math::randomInterval( 2, 4 ) * 100 );
		for ( $i = 0; $i < Math::randomInterval( 2, 5 ); $i++ ) {
			usleep( 100 );
			session_regenerate_id( TRUE );
			usleep( 100 );
		}
		usleep( Math::randomInterval( 2, 4 ) * 100 );

		return self::id();
	}

	public static function set( $k, $v ) {
		self::newId();
		$_SESSION[ $k ] = $v;

		return ( self::get( $k ) == $v ) ? TRUE : FALSE;
	}

	public static function start() {
		session_start();
		self::newId();

		return self::id();
	}
}