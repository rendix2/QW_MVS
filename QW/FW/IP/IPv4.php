<?php

namespace QW\FW\IP;

use QW\FW\Basic\String;
use QW\FW\Boot\IllegalArgumentException;

final class IPv4 extends AbstractIP {
	public function __construct( $ip, $safeMode = TRUE, $debug = FALSE ) {
		parent::__construct( $ip, $safeMode, $debug );

		// IPv4
		if ( $this->getIpCountPart() != 4 ) throw new IllegalArgumentException();

		$this->ipCoded = ip2long( $ip );
	}

	public function __destruct() {
		parent::__destruct();
	}

	public function getPart( $part ) {
		parent::getPart( $part );

		if ( $part < 0 || $part > 4 ) throw new IllegalArgumentException();

		return $this->ipParted[ $part ];
	}

	public function getSecureIp() {
		$string = new String( '' );

		for ( $i = 0; $i < 2; $i++ ) {
			$string = $string->concatPost( (string) $this->getPart( $i ) );
			$string = $string->concatPost( '.' );
		}

		return $string = $string->concatPost( 'XXX.XXX' );
	}
}