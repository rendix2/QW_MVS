<?php

namespace QW\FW\DataStructures\Cache;

use QW\FW\Basic\Object;
use QW\FW\DataStructures\Cache;

abstract class AbstractCache extends Object implements ICache {

	public function __construct( $debug = FALSE ) {
		parent::__construct( $debug );
	}

	public function __destruct() {
		parent::__destruct();
	}

	public function updateCache( $data ) {
		$this->removeCache();
		$this->addCache( $data );
	}
}