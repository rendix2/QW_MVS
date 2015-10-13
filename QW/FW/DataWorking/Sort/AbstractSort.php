<?php

namespace QW\FW\DataWorking\Sort;

use QW\FW\Basic\Object;

abstract class AbstractSort extends Object {
	protected $originalData, $length;
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

	protected static function swap( array &$array, $left, $right ) {
		$tmp             = $array[ $right ];
		$array[ $right ] = $array[ $left ];
		$array[ $left ]  = $tmp;
	}

	protected static function swapSystem( &$array, $left, $right ) {
		list( $array[ $left ], $arr[ $right ] ) = [ $array[ $right ], $array[ $left ] ];
	}

	public function getOriginalArray() {
		return $this->originalData;
	}

	public function getSortedArray() {
		return $this->sortedData;
	}
}