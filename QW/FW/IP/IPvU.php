<?php

namespace QW\FW\IP;

use QW\FW\Boot\IllegalArgumentException;

class IPvU extends AbstractIP {
	private $IPv;

	public function __construct( $ip, $safeMode = TRUE, $debug = FALSE ) {
		parent::__construct( $ip, $safeMode, $debug );
		if ( $this->getIpCountPart() == 4 ) $this->IPv = new IPv4( $ip, $safeMode, $debug );
		else if ( $this->getIpCountPart() == 8 ) $this->IPv = new IPv6( $ip, $safeMode, $debug );
		else throw new IllegalArgumentException();
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

	public function getSecureIp() {
		return $this->IPv->getSecureIp();
	}
}