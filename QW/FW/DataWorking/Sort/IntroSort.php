<?php
/**
 * Created by PhpStorm.
 * User: Tomáš
 * Date: 12. 9. 2015
 * Time: 14:55
 */

namespace QW\FW\DataWorking\Sort;


use QW\FW\Utils\Math\Math;

// not checked

class IntroSort extends QuickSort {

	private function introsort( $data, $maxDepth ) {
		if ( $maxDepth == 0 ) return new HeapSort( $data );
		else {
			$p = $this->partition( $data );
			$this->introsort( $data[ $p ], $maxDepth - 1 );
			$this->introsort( $data[ $p + 1 ], $maxDepth - 1 );
		}
	}

	protected function sort( AbstractSort $sort ) {
		$maxDepth         = Math::logarithmDecade( count( $this->originalData ) ) * 2;
		$this->sortedData = $this->introsort( $this->originalData, $maxDepth );
	}
}