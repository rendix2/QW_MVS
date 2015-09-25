<?php

namespace QW\FW\IP;

use QW\FW\Basic\String;
use QW\FW\Boot\IllegalArgumentException;
use QW\FW\Boot\UnsupportedOperationException;

final class IPv6 extends AbstractIP {
	public function __construct( $ip, $safeMode = TRUE, $debug = FALSE ) {
		throw new UnsupportedOperationException();
		parent::__construct( $ip, $safeMode, $debug );

		// IPv6
		if ( $this->getIpCountPart() != 6 ) throw new IllegalArgumentException();
	}

	public function __destruct() {
		parent::__destruct();
	}

	public function getPart( $part ) {
		parent::getPart( $part );

		if ( $part < 0 || $part > 6 ) throw new IllegalArgumentException();

		return $this->ipParted[ $part ];
	}

	public function getSecureIp() {
		$string = new String( '' );

		for ( $i = 0; $i < 4; $i++ ) {
			$string = $string->concatPost( (string) $this->getPart( $i ) );
			$string = $string->concatPost( '.' );
		}

		return $string = $string->concatPost( 'XXX.XXX' );
	}
}