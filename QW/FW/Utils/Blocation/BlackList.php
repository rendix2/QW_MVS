<?php

namespace QW\FW\Utils\Blocation;

use QW\FW\Basic\Object;
use QW\FW\Boot\NullPointerException;
use QW\FW\Utils\IP\IP;
use QW\FW\Utils\IP\IPv4;
use QW\FW\Utils\IP\IPv6;
use QW\FW\Utils\IP\IPvU;
use QW\FW\Utils\SuperGlobals\Server;

class BlackList extends Object {
	protected $longOfIP;
	protected $myIp;

	public function __construct( $debug = FALSE ) {
		parent::__construct( $debug );

		$this->longOfIP = [ ];
		$this->myIp = new IPvU( Server::get( 'remote_addr' ) );
	}

	public function __destruct() {
		$this->run();
		$this->longOfIP = NULL;
		$this->myIp     = NULL;

		parent::__destruct();
	}

	public function addIPs( array $long ) {
		foreach ( $long as $v ) $this->longOfIP[] = new IPvU( $v );
	}

	public function addIPsv4( array $long ) {
		foreach ( $long as $v ) $this->longOfIP[] = new IPv4( $v );
	}

	public function addIPsv6( array $long ) {
		foreach ( $long as $v ) $this->longOfIP[] = new IPv6( $v );
	}

	public function addIp( IP $ip = NULL ) {
		if ( $ip == NULL ) throw new NullPointerException();

		$this->longOfIP[] = $ip;
	}

	public function addLong( IP $ip = NULL ) {
		if ( $ip == NULL ) throw new NullPointerException();

		$this->longOfIP[] = $ip;
	}

	public function deleteIp( IP $ip = NULL ) {
		if ( $ip == NULL ) throw new NullPointerException();

		foreach ( $this->longOfIP as $k => $v ) if ( $v->getLong() == $ip->getCoded() ) unset( $this->longOfIP[ $k ] );
	}

	public function deleteLong( IP $ip = NULL ) {
		if ( $ip == NULL ) throw new NullPointerException();

		foreach ( $this->longOfIP as $k => $v ) if ( $v->getLong() == $ip->getCoded() ) unset( $this->longOfIP[ $k ] );
	}

	public function run() {
		foreach ( $this->longOfIP as $ip )
			if ( $ip->getLong() == $this->myIp->getCoded() ) die( 'Your IP as blacklisted.' );
	}
}