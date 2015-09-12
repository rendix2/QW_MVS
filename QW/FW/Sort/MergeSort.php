<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 7. 7. 2015
 * Time: 13:56
 */

namespace QW\FW\Sort;

class MergeSort extends AbstractSort {

	private function merge( array $array, array $aux, $left, $right ) {
		$middle     = ( $left + $right ) / 2;
		$leftIndex  = $left;
		$rightIndex = (int) $middle + 1;
		$auxIndex   = $left;

		while ( $leftIndex <= $middle && $rightIndex <= $right ) {
			if ( $array[ $leftIndex ] >= $array[ $rightIndex ] ) $aux[ $auxIndex ] = $array[ $leftIndex ];
			else $aux[ $auxIndex ] = $array[ $rightIndex ];

			$auxIndex++;
		}

		while ( $leftIndex <= $middle ) {
			$aux[ $auxIndex ] = $array[ $leftIndex++ ];
			$auxIndex++;
		}

		while ( $rightIndex <= $right ) {
			$aux[ $auxIndex ] = $array[ $rightIndex++ ];
			$auxIndex++;
		}
	}

	protected function sort( AbstractSort $sort ) {
		if ( $left == $right ) return;

		$middle = ( $left + $right ) / 2;
		$this->mergeSort( $array, $aux, $left, $middle );
		$this->mergeSort( $array, $aux, $middle + 1, $right );
		$this->merge( $array, $aux, $left, $right );

		for ( $i = $left; $i <= $right; $i++ ) $array[ $i ] = $aux[ $i ];

		return $array;
	}
}