<?php

namespace QW\FW\Utils\IP;

use QW\FW\Basic\StringW;
use QW\FW\Boot\IllegalArgumentException;

final class IPv4 extends AbstractIP {
	public function __construct( $ip, $safeMode = TRUE, $debug = FALSE ) {
		parent::__construct( $ip, $safeMode, $debug );
		if ( $this->getIpCountPart() != 4 ) throw new IllegalArgumentException();
	}

	public function __destruct() {
		parent::__destruct();
	}

	public function getNiceIp() {
		return $this->getIp();
	}

	public function getPart( $part ) {
		if ( !is_numeric( $part ) || $part < 0 || $part > 4 ) throw new IllegalArgumentException();

		return $this->ipParted[ $part ];
	}

	public function getSecureIp() {
		$string = new StringW( '' );

		for ( $i = 0; $i < 2; $i++ ) $string = $string->concatPost( (string) $this->getPart( $i ) )
		                                              ->concatPost( '.' );

		return $string = $string->concatPost( 'xxx.xxx' );
	}
}