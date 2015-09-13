<?php
namespace QW\FW\Sort;

// OK

class ComboSort extends AbstractSort {

	protected function sort( AbstractSort $sort ) {
		$swapped = FALSE;
		$gap     = $this->length;

		while ( $gap != 1 || $swapped ) {

			$gap /= 1.33; // 4/3
			$swapped = FALSE;

			if ( $gap < 1 ) $gap = 1;

			for ( $i = 0; $i + $gap < $this->length; $i++ ) if ( $this->data[ $i ] < $this->data[ $i + $gap ] ) {
				self::swap( $this->data, $i, $i + $gap );
				$swapped = TRUE;
			}
		}

		return $this->data;
	}
}