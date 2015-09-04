<?php

namespace QW\FW\Cache;


final class ArrayCache extends AbstractCache implements ICache {
	private $data;

	public function __construct( $debug = FALSE ) {
		parent::__construct( $debug );
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