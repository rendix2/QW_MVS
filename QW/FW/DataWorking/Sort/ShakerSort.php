<?php

namespace QW\FW\DataWorking\Sort;

class ShakerSort extends AbstractSort {

	protected function sort( AbstractSort $sort ) {
		for ( $i = 0; $i < $this->length / 2; $i++ ) {
			$swapped = FALSE;

			for ( $j = $i; $j < $this->length - $i - 1; $j++ ) if ( $this->data[ $j ] < $this->data[ $j + 1 ] ) {
				self::swap( $this->data, $j, $j + 1 );
				$swapped = TRUE;
			}

			for ( $j = $this->length - 2 - $i; $j > $i; $j-- ) if ( $this->data[ $j ] > $this->data[ $j - 1 ] ) {
				self::swap( $this->data, $j, $j - 1 );
				$swapped = TRUE;
			}

			if ( $swapped ) break;
		}

		return $this->data;
	}
}