<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 7. 7. 2015
 * Time: 13:52
 */

namespace QW\FW\Sort;


class HeapSort extends AbstractSort {


	private function repairTop ( array $array, $bottom, $topIndex ) {
		$tmp  = $array[ $topIndex ];
		$succ = $topIndex * 2 + 1;

		if ( $succ < $bottom && $array[ $succ ] > $array[ $succ + 1 ] ) $succ++;

		while ( $succ <= $bottom && $tmp > $array[ $succ ] ) {
			$array[ $topIndex ] = $array[ $succ ];
			$topIndex           = $succ;
			if ( $succ < $bottom && $array[ $succ ] > $array[ $succ + 1 ] ) $succ++;
		}
		$array[ $topIndex ] = $tmp;
	}

	protected function sort ( AbstractSort $sort ) {
		for ( $i = $this->length / 2 - 1; $i >= 0; $i-- ) $this->repairTop( $this->data, $this->length - 1, $i );

		for ( $i = $this->length - 1; $i > 0; $i-- ) {
			$this->swap( $this->data, 0, $i );
			$this->repairTop( $this->data, $i - 1, 0 );
		}

		return $this->data;
	}
}