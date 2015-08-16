<?php

namespace QW\FW\DP\Proxy;

class BetterTable implements Table {

	private $easyTable;

	public function __construct(EasyTable $easyTable) {
		$this->easyTable = $easyTable;
	}

	private function canRead() {
		return TRUE;
	}

	private function canWrite() {
		return FALSE;
	}

	public function read($key) {
		if ( $this->canRead() ) {
			$this->easyTable->read($key);
		}
		else {
			throw new \Exception('Access denied');
		}
	}

	public function write($key, $value) {
		if ( $this->canWrite() ) {
			$this->easyTable->write($key, $value);
		}
		else {
			throw new \Exception('Access denied');
		}
	}
}