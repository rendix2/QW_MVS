<?php

namespace QW\FW\IP;

use QW\FW\Boot\IllegalArgumentException;

class IPvU extends AbstractIP
{
	private $IPv;

	public function __construct( $ip )
	{
		parent::__construct( $ip );

		if ( $this->getIpCountPart() == 4 ) // IPv4
			$this->IPv = new IPv4( $ip ); else if ( $this->getIpCountPart() == 6 ) // IPv6
			$this->IPv = new IPv6( $ip ); else
			throw new IllegalArgumentException();

		$this->ipCoded = ip2long( $ip );
	}

	public function getPart( $part )
	{
		return $this->IPv->getPart( $part );
	}

	public function getLong()
	{
		return $this->IPv->getLong();
	}
}