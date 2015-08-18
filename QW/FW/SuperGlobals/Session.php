<?php

namespace QW\FW\SuperGlobals;

use QW\FW\Boot\PrivateConstructException;
use QW\FW\Math\Math;

final class Session implements ISG {
	public function __construct() {
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

		return isset( $_SESSION[ $k ] ) ? $_SESSION[ $k ] : FALSE;
	}

	public static function getAll() {
		self::newId();

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