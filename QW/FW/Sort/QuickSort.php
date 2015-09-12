<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 7. 7. 2015
 * Time: 13:51
 */

namespace QW\FW\Sort;


class QuickSort extends AbstractSort {

	protected function partition( $data, $lo, $hi ) {
		$pivot = $data[ $hi ];
		$i     = $lo;

		for ( $j = $lo; $lo < $hi - 1; $j++ ) {
			if ( $data[ $j ] <= $pivot ) {
				AbstractSort::swap( $data, $i, $j );
				$i = $i + 1;
			}
			AbstractSort::swap( $data, $i, $hi );

			return $i;
		}
	}

	protected function partition2( $data, $lo, $hi ) {
		$pivot = $data[ $lo ];
		$i     = $lo - 1;
		$j     = $hi + 1;

		while ( TRUE ) {
			do $j -= 1;
			while ( $data[ $j ] > $pivot );

			do $i += 1;
			while ( $data[ $i ] < $pivot );

			if ( $i < $j ) AbstractSort::swap( $data, $i, $j );
			else return $j;
		}
	}

	private function quickSort( array $data, $lo, $hi ) {
		if ( $lo < $hi ) {
			$p = $this->partition( $data, $lo, $hi );
			$this->quickSort( $data, $lo, $p - 1 );
			$this->quickSort( $data, $p + 1, $hi );
		}
	}

	protected function sort( AbstractSort $sort ) {
		$this->quickSort( $this->data, 0, $this->length - 1 );
	}
}