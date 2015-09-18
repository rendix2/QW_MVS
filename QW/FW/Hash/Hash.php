<?php

namespace QW\FW\Hash;

use QW\FW\Boot\PrivateConstructException;
use QW\FW\Math\Math;

final class Hash {
	public function __construct() {
		throw new PrivateConstructException();
	}

	public static function joaat_hash( array $key ) {
		$hash = 0;

		foreach ( $key as $b ) {
			$hash += ( $b & 0xFF );
			$hash += ( $hash << 10 );
			$hash ^= ( $hash >>> 6 );
		}
		$hash += ( $hash << 3 );
		$hash ^= ( $hash >>> 11 );
		$hash += ( $hash << 15 );

		return $hash;
	}

	public static function r() {
		return md5( uniqid() );
	}

	public static function r2() {
		return sha1( uniqid() );
	}

	public static function r3() {
		return hash( 'sha_512', uniqid() );
	}

	public static function rFromNum() {
		return hash( 'sha_512', self::rNum() );
	}

	public static function rNum() {
		return Math::randomInterval( 0, Math::randomInterval( 1, Math::randomInterval( 2, 1000 ) ) );
	}
}