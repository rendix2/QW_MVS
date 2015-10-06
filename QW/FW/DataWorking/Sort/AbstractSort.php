<?php

namespace QW\FW\DataWorking\Sort;

use QW\FW\Basic\Object;

abstract class AbstractSort extends Object {
	protected $data, $length;

	abstract protected function sort( AbstractSort $sort );

	public function __construct( array $data, $debug = FALSE ) {
		parent::__construct( $debug );

		if ( $this->length == 1 ) return $this->data;

		$this->data = array_values( $data );
		$this->length = count( $this->data );
	}

	protected static function swap( array &$array, $left, $right ) {
		$tmp             = $array[ $right ];
		$array[ $right ] = $array[ $left ];
		$array[ $left ]  = $tmp;
	}

	protected static function swapSystem( &$array, $left, $right ) {
		list( $array[ $left ], $arr[ $right ] ) = [ $array[ $right ], $array[ $left ] ];
	}

	public function getArray() {
		return $this->data;
	}
}