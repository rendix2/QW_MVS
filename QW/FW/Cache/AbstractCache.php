<?php

namespace QW\FW\Cache;

use QW\FW\Basic\Object;

abstract class AbstractCache extends Object implements ICache {

	public function __construct( $debug = FALSE ) {
		parent::__construct( $debug );
	}

	public function updateCache( $data ) {
		$this->removeCache();
		$this->addCache( $data );
	}
}