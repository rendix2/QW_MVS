<?php

namespace QW\FW\Blocation;

class WhiteList extends BlackList {
	public function __destruct() {
		parent::__destruct();
	}

	public function run() {
		foreach ( $this->longOfIP as $ip ) if ( $ip->getLong() == $this->myIp->getCoded() ) return TRUE;

		return FALSE;
	}
}

