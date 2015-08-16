<?php

namespace QW\FW;

use QW\FW\Boot\PrivateConstructException;
use QW\FW\Math\Math;

final class Hash {
	public function __construct() {
		throw new PrivateConstructException();
	}

	public static function r() {
		return md5(uniqid());
	}

	public static function r2() {
		return sha1(uniqid());
	}

	public static function r3() {
		return hash('sha_512', uniqid());
	}

	public static function rFromNum() {
		return hash('sha_512', self::rNum());
	}

	public static function rNum() {
		return Math::randomInterval(0, Math::randomInterval(1, Math::randomInterval(2, 1000)));
	}
}