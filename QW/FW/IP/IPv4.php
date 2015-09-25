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

		if ( $part < 1 || $part > 4 ) throw new IllegalArgumentException();

		return $this->ipParted[ $part - 1 ];
	}

	public function getSecureIp() {
		$string = new String( '', $this->debug );

		for ( $i = 1; $i <= 2; $i++ ) $string->concatPost( $this->getPart( $i ) );
		$string->concatPost( 'XXX.YYY' );

		return $string;
	}
}