<?php

namespace QW\FW\IP;


use QW\FW\Boot\IllegalArgumentException;

final class IPv4 extends AbstractIP {
	public function __construct( $ip, $debug = FALSE ) {
		parent::__construct( $ip, $debug );

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
}