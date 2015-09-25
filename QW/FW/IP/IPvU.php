<?php

namespace QW\FW\IP;

use QW\FW\Boot\IllegalArgumentException;

class IPvU extends AbstractIP {
	private $IPv;

	public function __construct( $ip, $debug = FALSE ) {
		parent::__construct( $ip );

		// IPv4
		if ( $this->getIpCountPart() == 4 ) $this->IPv = new IPv4( $ip, $debug );
		// IPv6
		else if ( $this->getIpCountPart() == 6 ) $this->IPv = new IPv6( $ip, $debug );
		else throw new IllegalArgumentException();

		$this->ipCoded = ip2long( $ip );
	}

	public function __destruct() {
		$this->IPv = NULL;
		parent::__destruct();
	}

	public function getLong() {
		return $this->IPv->getLong();
	}

	public function getPart( $part ) {
		return $this->IPv->getPart( $part );
	}
}