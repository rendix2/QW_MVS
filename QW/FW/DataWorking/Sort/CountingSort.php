<?php

namespace QW\FW\DataWorking\Sort;

// not checked

class CountingSort extends AbstractSort {

	protected function sort( AbstractSort $sort ) {
		$min = $this->originalData[ 0 ];
		$max = $this->originalData[ 0 ];

		for ( $i = 1; $i < $this->length; $i++ )
			if ( $this->originalData[ $i ] < $min ) $min = $this->originalData[ $i ];
			elseif ( $this->originalData[ $i ] > $max ) $max = $this->originalData[ $i ];

		$count = [ ];

		for ( $i = 0; $i < $this->length; $i++ ) $count[ $this->originalData[ $i ] - $min ]++;

		$count[ 0 ]--;

		for ( $i = 1; $i < count( $count ); $i++ ) $count[ $i ] = $count[ $i ] + $count[ $i - 1 ];

		$aux = [ ];
		// very dirty code :O
		for ( $i = $this->length - 1; $i >= 0; $i-- )
			$aux[ $count[ $this->originalData[ $i ] - $min ]-- ] = $this->originalData[ $i ];

		$this->sortedData = $this->originalData;
	}
}