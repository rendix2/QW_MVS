<?php

namespace QW\FW\DataWorking\Sort;

use QW\FW\Basic\ArraysW;
use QW\FW\Basic\Object;

abstract class AbstractSort extends Object {
	protected $originalData;
	protected $length;
	protected $sortedData;

	abstract protected function sort( AbstractSort $sort );

	public function __construct( array $data, $debug = FALSE ) {
		parent::__construct( $debug );

		if ( $this->length == 1 ) return $this->originalData;

		$this->originalData = $data;
		$this->length       = count( $this->originalData );
		$this->sort( $this );
		//$this->sortedData = $this->originalData;
		$this->originalData = $data;
	}

	public function __destruct() {
		$this->originalData = NULL;
		$this->length       = NULL;
		$this->sortedData   = NULL;
		parent::__destruct();
	}

	public function __toString() {
		$original = new ArraysW( $this->originalData );
		$sorted   = new ArraysW( $this->sortedData );
		$string   = 'Original array: ' . $original . '<br>Sorted array: ' . $sorted . '<br>';
		$original = NULL;
		$sorted   = NULL;

		return $string;
	}

	public function getOriginalArray() {
		return $this->originalData;
	}

	public function getSortedArray() {
		return $this->sortedData;
	}
}