<?php

namespace QW\FW\Sort;

class CountingSort extends AbstractSort {

	protected function sort ( AbstractSort $sort ) {
		$min = $this->data[ 0 ];
		$max = $this->data[ 0 ];

		for ( $i = 1; $i < $this->length; $i++ ) if ( $this->data[ $i ] < $min ) $min = $this->data[ $i ];
		elseif ( $this->data[ $i ] > $max ) $max = $this->data[ $i ];

		$count = [ ];

		for ( $i = 0; $i < $this->length; $i++ ) $count[ $this->data[ $i ] - $min ]++;

		$count[ 0 ]--;

		for ( $i = 1; $i < count( $count ); $i++ ) $count[ $i ] = $count[ $i ] + $count[ $i - 1 ];

		$aux = [ ];
		// very dirty code :O
		for ( $i = $this->length - 1; $i >= 0; $i-- ) $aux[ $count[ $this->data[ $i ] - $min ]-- ] = $this->data[ $i ];

		return $aux;
	}
}