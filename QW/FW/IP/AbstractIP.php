<?php

namespace QW\FW\IP;

use QW\FW\Basic\Object;
use QW\FW\Boot\IllegalArgumentException;
use QW\FW\Boot\NullPointerException;
use QW\FW\Validator;

abstract class AbstractIP extends Object implements IP {
	protected $ipParted;
	protected $ipCoded;
	protected $ipCountPart;
	protected $safeMode;

	abstract public function getSecureIp();

	public function __construct( $ip, $safeMode = TRUE, $debug = FALSE ) {
		parent::__construct( $debug );

		if ( $ip == NULL ) throw new NullPointerException();
		if ( is_numeric( $ip ) ) $ip = long2ip( $ip );
		if ( !Validator::validateIpUsingFilter( $ip ) ) throw new IllegalArgumentException();
		if ( !is_bool( $safeMode ) ) throw new IllegalArgumentException();

		$this->ipParted    = explode( '.', $ip );
		$this->ipCountPart = count( $this->ipParted );
		$this->safeMode = $safeMode;
	}

	public function __destruct() {
		$this->ipParted    = NULL;
		$this->ipCoded     = NULL;
		$this->ipCountPart = NULL;

		parent::__destruct();
	}

	public function __toString() {
		return $this->safeMode == TRUE ? $this->getIp() : $this->getSecureIp();
	}

	final public function getIp() {
		return long2ip( $this->ipCoded );
	}

	final protected function getIpCountPart() {
		return $this->ipCountPart;
	}

	public function getLong() {
		return $this->ipCoded;
	}

	public function getPart( $part ) {
		if ( !is_numeric( $part ) ) throw new IllegalArgumentException();
	}
}