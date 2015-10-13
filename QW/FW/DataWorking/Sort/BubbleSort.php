<?php

namespace QW\FW\DataWorking\Sort;

class BubbleSort extends AbstractSort {

	// better then OK
	protected function sort( AbstractSort $sort ) {
		$j       = $this->length - 2;
		$swapped = TRUE;

		while ( $swapped ) {
			$swapped = FALSE;

			for ( $i = 0; $i <= $j; $i++ ) if ( $this->originalData[ $i ] > $this->originalData[ $i + 1 ] ) {
				self::swap( $this->originalData, $i, $i + 1 );
				$swapped = TRUE;
			}
		}

		$this->sortedData = $this->originalData;
	}
}