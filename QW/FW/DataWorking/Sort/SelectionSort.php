<?php

namespace QW\FW\DataWorking\Sort;

// OK

class SelectionSort extends AbstractSort {

	protected function sort( AbstractSort $sort ) {
		for ( $i = 0; $i < $this->length - 1; $i++ ) {
			$min = $i;
			for ( $j = $i + 1; $j < $this->length; $j++ ) if ( $this->data[ $j ] > $this->data[ $min ] ) $min = $j;

			if ( $min != $i ) // this may help
				self::swap( $this->data, $i, $min );
		}

		return $this->data;
	}
}