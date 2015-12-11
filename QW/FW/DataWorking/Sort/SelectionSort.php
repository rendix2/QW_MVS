<?php

namespace QW\FW\DataWorking\Sort;

// OK

use QW\FW\Basic\ArraysW;

class SelectionSort extends AbstractSort {

	protected function sort( AbstractSort $sort ) {
		for ( $i = 0; $i < $this->length - 1; $i++ ) {
			$min = $i;
			for ( $j = $i + 1; $j < $this->length; $j++ )
				if ( $this->originalData[ $j ] > $this->originalData[ $min ] ) $min = $j;

			if ( $min != $i ) // this may help
				ArraysW::swap( $this->originalData, $i, $min );
		}

		$this->sortedData = $this->originalData;
	}
}