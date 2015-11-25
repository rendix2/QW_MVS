<?php
namespace QW\FW\DataWorking\Sort;

class MergeSort extends AbstractSort {
	public function __construct( array $data, $debug = FALSE ) {
		return parent::__construct( $data, $debug );
	}

	private function merge( array $arrayToSort ) {
		if ( count( $arrayToSort ) == 1 ) return $arrayToSort;

		$left  = $this->merge( array_slice( $arrayToSort, 0, count( $arrayToSort ) / 2 ) );
		$right = $this->merge( array_slice( $arrayToSort, count( $arrayToSort ) / 2, count( $arrayToSort ) ) );

		return $this->merge_sort( $left, $right );
	}

	private function merge_sort( array $left, array $right ) {
		$result = [ ];

		while ( count( $left ) && count( $right ) ) $result[] =
			( $left[ 0 ] < $right[ 0 ] ) ? array_shift( $left ) : array_shift( $right );

		return array_merge( $result, $left, $right );
	}

	public function sort( AbstractSort $sort ) {
		$this->sortedData = $this->merge( $this->originalData );
	}
}