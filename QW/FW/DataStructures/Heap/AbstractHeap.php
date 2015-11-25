<?php

namespace QW\FW\DataStructures\Heap;

use QW\FW\Basic\Object;

class AbstractHeap extends Object {

	protected $array;
	protected $size;

	public function __construct( $debug = FALSE ) {
		parent::__construct( $debug );
		$this->array = [ ];
	}

	public function __toString() {
		$res = '';

		foreach ( $this->array as $v ) $res .= $v . ' ';

		return $res;
	}

	public function getSize() {
		return $this->size;
	}

}