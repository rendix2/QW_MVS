<?php

namespace QW\FW\IP;

use QW\FW\Basic\Object;
use QW\FW\Boot\IllegalArgumentException;
use QW\FW\Boot\NullPointerException;
use QW\FW\Interfaces\IP;
use QW\FW\Validator;

abstract class AbstractIP extends Object implements IP {
	protected $ipParted;
	protected $ipCoded;
	protected $ipCountPart;

	public function __construct($ip) {
		parent::__construct();

		if ( $ip == NULL ) throw new NullPointerException();

		if ( is_numeric($ip) ) $ip = long2ip($ip);

		if ( !Validator::validateIpUsingFilter($ip) ) throw new IllegalArgumentException();

		$this->ipParted    = explode('.', $ip);
		$this->ipCountPart = count($this->ipParted);
	}

	public final function getIp() {
		return long2ip($this->ipCoded);
	}

	protected final function getIpCountPart() {
		return $this->ipCountPart;
	}

	public function getLong() {
		return $this->ipCoded;
	}

	public function getPart($part) {
		if ( !is_numeric($part) ) throw new IllegalArgumentException();
	}
}