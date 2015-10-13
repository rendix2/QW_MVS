<?php

namespace QW\FW\DataWorking\Sort;

// MAY BE OK

class QuickSort extends AbstractSort {
	private function quickSort( $array ) {
		$left = $right = [ ];

		$pivot_key = ( $array );
		$pivot     = array_shift( $array );

		foreach ( $array as $k => $v ) {
			if ( $v < $pivot ) $left[ $k ] = $v;
			else $right[ $k ] = $v;
		}

		return array_merge( $this->quickSort( $left ), [ $pivot_key => $pivot ], $this->quickSort( $right ) );
	}

	protected function sort( AbstractSort $sort ) {
		$this->sortedData = $this->quickSort( $this->originalData );
	}
	/*
	protected function partition( $data, $lo, $hi ) {
		$pivot = $data[ $hi ];
		$i     = $lo;

		for ( $j = $lo; $lo < $hi - 1; $j++ ) {
			if ( $data[ $j ] <= $pivot ) {
				self::swap( $data, $i, $j );
				$i = $i + 1;
			}
			self::swap( $data, $i, $hi );

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

			if ( $i < $j ) self::swap( $data, $i, $j );
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

	*/
}