<?php

namespace QW\FW\Cache;

use QW\FW\Basic\IllegalArgumentException;

final class APCCache extends AbstractCache {
	private $key;

	public function __construct($key) {
		parent::__construct();

		if ( apc_exists($key) ) {
			throw new IllegalArgumentException('Klíč již existuje, zvolte jiný.');
		}

		$this->key = $key;
	}

	public function addCache($data) {
		return apc_add($this->key, $data);
	}

	public function removeCache() {
		return apc_delete($this->key);
	}

	public function useCache() {
		return apc_fetch($this->key);
	}
}