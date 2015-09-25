<?php

namespace QW\FW\IP;

use QW\FW\Basic\Object;
use QW\FW\Boot\IllegalArgumentException;
use QW\FW\SuperGlobals\Server;
use QW\FW\Validator;

abstract class AbstractIP extends Object implements IP {
	protected $ipParted;
	protected $ipCoded;
	protected $ipCountPart;
	protected $safeMode;

	abstract public function getSecureIp();

	public function __construct( $ip, $safeMode = TRUE, $debug = FALSE ) {
		parent::__construct( $debug );

		if ( $ip == NULL ) $ip = Server::get( 'remote_addr' );
		if ( is_numeric( $ip ) ) $ip = long2ip( $ip );
		if ( !Validator::validateIpUsingFilter( $ip ) ) throw new IllegalArgumentException();
		if ( !is_bool( $safeMode ) ) throw new IllegalArgumentException();


		if ( Validator::validateIPv4UsingFilter( $ip ) ) {
			$this->ipCoded  = ip2long( $ip );
			$this->ipParted = explode( '.', $ip );
		}
		else {
			$this->ipCoded  = self::ip2long6( $ip );
			$this->ipParted = explode( '.', $ip );
		}

		$this->ipCountPart = count( $this->ipParted );
		$this->safeMode = $safeMode;

		print_r( $this->ipParted );
	}

	public function __destruct() {
		$this->ipParted    = NULL;
		$this->ipCoded     = NULL;
		$this->ipCountPart = NULL;

		parent::__destruct();
	}

	public function __toString() {
		return $this->safeMode == TRUE ? $this->getSecureIp()
			->getString() : $this->getIp();
	}

	public static function ip2long6( $ipv6 ) {
		$ip_n = inet_pton( $ipv6 );
		$bits = 15; // 16 x 8 bit = 128bit
		while ( $bits >= 0 ) {
			$bin      = sprintf( "%08b", ( ord( $ip_n[ $bits ] ) ) );
			$ipv6long = $bin . $ipv6long;
			$bits--;
		}

		return gmp_strval( gmp_init( $ipv6long, 2 ), 10 );
	}

	public static function long2ip6( $ipv6long ) {

		$bin = gmp_strval( gmp_init( $ipv6long, 10 ), 2 );
		if ( strlen( $bin ) < 128 ) {
			$pad = 128 - strlen( $bin );
			for ( $i = 1; $i <= $pad; $i++ ) {
				$bin = "0" . $bin;
			}
		}
		$bits = 0;
		while ( $bits <= 7 ) {
			$bin_part = substr( $bin, ( $bits * 16 ), 16 );
			$ipv6 .= dechex( bindec( $bin_part ) ) . ":";
			$bits++;
		}

		// compress

		return inet_ntop( inet_pton( substr( $ipv6, 0, -1 ) ) );
	}

	final public function getIp() {
		return $this->ipCountPart == 4 ? long2ip( $this->ipCoded ) : self::long2ip6( $this->ipCoded );
	}

	final protected function getIpCountPart() {
		return $this->ipCountPart;
	}

	public function getLong() {
		return $this->ipCoded;
	}

	public function getPart( $part ) {
		if ( !is_numeric( $part ) ) throw new IllegalArgumentException();
	}


}