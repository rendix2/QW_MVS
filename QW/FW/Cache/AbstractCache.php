<?php

namespace QW\FW\Cache;

use QW\FW\Basic\Object;
use QW\FW\Interfaces\ICache;

abstract class AbstractCache extends Object implements ICache {
	public function __construct() {
		parent::__construct();
		// i might use some object class in class that extends this class
	}
}