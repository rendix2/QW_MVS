<?php

namespace QW\FW\IP;


use QW\FW\Boot\IllegalArgumentException;

final class IPv4 extends AbstractIP {
	public function __construct($ip) {
		parent::__construct($ip);

		// IPv4
		if ( $this->getIpCountPart() != 4 )
			throw new IllegalArgumentException();

		$this->ipCoded = ip2long($ip);
	}

	public function getPart($part) {
		parent::getPart($part);

		if ( $part < 1 || $part > 4 )
			throw new IllegalArgumentException();

		return $this->ipParted[ $part - 1 ];
	}
}