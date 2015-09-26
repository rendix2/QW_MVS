<?php

namespace QW\FW\IP;

use QW\FW\Basic\Object;
use QW\FW\Basic\String;
use QW\FW\Boot\IllegalArgumentException;
use QW\FW\SuperGlobals\Server;
use QW\FW\Validator;

abstract class AbstractIP extends Object implements IP {
	protected $ipParted;
	protected $ipCoded;
	protected $ipCountPart;
	protected $safeMode;

	public function __construct( $ip, $safeMode = TRUE, $debug = FALSE ) {
		parent::__construct( $debug );

		if ( $ip == NULL ) $ip = Server::get( 'remote_addr' );
		if ( !self::isIP( $ip ) ) throw new IllegalArgumentException();
		if ( !is_bool( $safeMode ) ) throw new IllegalArgumentException();

		if ( self::isIPv4( $ip ) ) {
			$this->ipCoded  = ip2long( $ip );
			$this->ipParted = explode( '.', $ip );
		}
		else {
			$this->ipCoded  = self::ip6pack( $ip );
			$this->ipParted = explode( ':', $ip );
		}

		$this->ipCountPart = count( $this->ipParted );
		$this->safeMode = $safeMode;
	}

	public function __destruct() {
		$this->ipParted    = NULL;
		$this->ipCoded     = NULL;
		$this->ipCountPart = NULL;
		$this->safeMode = NULL;

		parent::__destruct();
	}

	public function __toString() {
		return $this->safeMode == TRUE ? $this->getSecureIp()
			->getString() : (string) $this->getIp();
	}

	final public static function ip6pack( $ip6 ) {
		return current( unpack( "A16", inet_pton( $ip6 ) ) );
	}

	final public static function ip6unpack( $ip6 ) {
		return inet_ntop( pack( "A16", $ip6 ) );
	}

	final public static function isIP( $ip ) {
		return Validator::validateIpUsingFilter( $ip );
	}

	final public static function isIPv4( $ip ) {
		return Validator::validateIPv4UsingFilter( $ip );
	}

	final public static function isIPv6( $ip ) {
		return Validator::validateIPv6UsingFilter( $ip );
	}

	final public function getCoded() {
		return $this->ipCoded;
	}

	final public function getIp() {
		if ( $this->ipCountPart == 4 ) return long2ip( $this->ipCoded );
		else {
			$str = new String( self::ip6unpack( $this->ipCoded ), $this->debug );

			return $str->getString();
		}
	}

	final protected function getIpCountPart() {
		return $this->ipCountPart;
	}
}