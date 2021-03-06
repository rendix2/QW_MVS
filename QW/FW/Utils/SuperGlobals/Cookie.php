<?php

	namespace QW\FW\Utils\SuperGlobals;

	use QW\FW\Boot\PrivateConstructException;

	final class Cookie extends SuperGlobals implements ISG {
		public function __construct () {
			parent::__construct ();

			throw new PrivateConstructException();
		}

		public function __destruct () {
			parent::__destruct (); // TODO: Change the autogenerated stub
		}

		public static function get ( $k ) {
			if ( self::$magicQuotes ) $k = stripslashes ( $k );

			$result = isset( $_COOKIE[ $k ] ) ? $_COOKIE[ $k ] : FALSE;;

			if ( self::$magicQuotes && !$result ) $result = stripslashes ( $result );

			return $result;
		}

		public static function getAll () {
			if ( self::$magicQuotes ) {
				$array = [ ];
				foreach ( $_COOKIE as $k => $v ) $array[ stripslashes ( $k ) ] = stripslashes ( $v );

				return $array;
			}

			return $_COOKIE;
		}

		public static function set ( $k, $v ) {
			return setcookie ( $k, $v );
		}
	}