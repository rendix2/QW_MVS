<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 7. 7. 2015
 * Time: 13:56
 */

namespace QW\FW\DataWorking\Sort;

// OK

class MergeSort extends AbstractSort {

	private function merge( array $data ) {
		$left  = $this->merge( array_slice( $data, 0, $this->length / 2 ) );
		$right = $this->merge( array_slice( $data, $this->length / 2, $this->length ) );

		return $this->mergeSort( $left, $right );
	}

	private function mergeSort( array $left, array $right ) {
		$result = [ ];

		while ( count( $left ) && count( $right ) ) if ( $left[ 0 ] < $right[ 0 ] ) $result[] = array_shift( $left );
		else
			$result[] = array_shift( $right );

		return array_merge( $result, $left, $right );

	}

	protected function sort( AbstractSort $sort ) {
		return $this->merge( $this->data );
	}
}