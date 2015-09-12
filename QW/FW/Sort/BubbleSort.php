<?php

namespace QW\FW\Sort;

class BubbleSort extends AbstractSort {

	protected function sort( AbstractSort $sort ) {
		for ( $i = 0; $i < $this->length - 1; $i++ ) for ( $j = 0; $j < $this->length - $i - 1; $j++ )
			if ( $this->data[ $j ] < $this->data[ $j + 1 ] ) AbstractSort::swap( $this->data, $j, $j + 1 );

		return $this->data;
	}
}