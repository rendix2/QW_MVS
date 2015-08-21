<?php

namespace QW\FW\Cache;

use QW\FW\Basic\Object;

final class ArrayCache extends Object implements ICache {
	private $data;

	public function __construct() {
		parent::__construct();
		$this->data = [ ];
	}

	public function __destruct() {
		$this->data = NULL;

		parent::__destruct();
	}

	public function addCache( $data ) {
		$this->data[] = $data;
	}

	public function removeCache() {
		$this->data = [ ];
	}

	public function useCache() {
		return $this->data;
	}
}