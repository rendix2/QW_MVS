<?php

	namespace QW\FW\Utils\IP;

	use QW\FW\Boot\IllegalArgumentException;

	class IPvU extends AbstractIP {
		private $IPv;

		public function __construct ( $ip, $safeMode = TRUE ) {
			parent::__construct ( $ip, $safeMode );
			if ( $this->getIpCountPart () == 4 ) $this->IPv = new IPv4( $ip, $safeMode );
			else if ( $this->getIpCountPart () == 8 ) $this->IPv = new IPv6( $ip, $safeMode );
			else throw new IllegalArgumentException();
		}

		public function __destruct () {
			$this->IPv = NULL;
			parent::__destruct ();
		}

		public function getNiceIp () {
			return $this->IPv->getNiceIp ();
		}

		public function getPart ( $part ) {
			return $this->IPv->getPart ( $part );
		}

		public function getSecureIp () {
			return $this->IPv->getSecureIp ();
		}

		public function getLong () {
			return $this->IPv->getLong ();
		}
	}