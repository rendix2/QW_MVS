<?php

namespace QW\FW\Sort;

class BubbleSort extends AbstractSort {

	// better then OK
	protected function sort( AbstractSort $sort ) {
		$j       = $this->length - 2;
		$swapped = TRUE;

		while ( $swapped ) {
			$swapped = FALSE;

			for ( $i = 0; $i <= $j; $i++ ) if ( $this->data[ $i ] > $this->data[ $i + 1 ] ) {
				self::swap( $this->data, $i, $i + 1 );
				$swapped = TRUE;
			}
		}
	}
}