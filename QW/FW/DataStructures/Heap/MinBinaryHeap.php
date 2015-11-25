<?php

namespace QW\FW\DataStructures\Heap;

use QW\FW\Basic\Arrays;

class MinBinaryHeap extends BinaryHeap {

	public function __construct( array $array, $arraySize = 0, $debug = FALSE ) {
		parent::__construct( $debug );
		$this->size  = $arraySize;
		$this->array = $array;
	}

	private function heapify( &$array ) {
		$start = count( $array );

		for ( $i = $start / 2; $i > 0; $i-- ) $this->repairTop( $this->size, $i );
	}

	public function merge( BinaryHeap $heap ) {
		$this->heapify( Arrays::merge2( $this->array, $heap->array ) );
	}

	private function repairTop( $bottom, $topIndex ) {
		$tmp  = $this->array[ $topIndex ];
		$succ = $topIndex * 2;
		if ( $succ < $bottom && $this->array[ $succ ] > $this->array[ $succ + 1 ] ) $succ++;

		while ( $succ <= $bottom && $tmp > $this->array[ $succ ] ) {
			$this->array[ $topIndex ] = $this->array[ $succ ];
			$topIndex                 = $succ;
			$succ *= 2;

			if ( $succ < $bottom && $this->array[ $succ ] > $this->array[ $succ + 1 ] ) $succ++;
		}

		$this->array[ $topIndex ] = $tmp;
	}
}