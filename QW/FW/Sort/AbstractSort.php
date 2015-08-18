<?php

namespace QW\FW\Sort;

use QW\FW\Basic\Object;

abstract class AbstractSort extends Object {
	protected $data, $length;

	abstract protected function sort( AbstractSort $sort );

	public function __construct( array $data ) {
		parent::__construct();

		if ( $this->length <= 1 ) return $this->data;

		foreach ( $data as $v ) $this->data[] = $v;

		$this->length = count( $this->data );
	}

	protected static function swap( array $array, $left, $right ) {
		$tmp             = $array[ $right ];
		$array[ $right ] = $array[ $left ];
		$array[ $left ]  = $tmp;
	}

	public function getArray() {
		return $this->data;
	}
}