<?php
/**
 * Created by PhpStorm.
 * User: Tomáš
 * Date: 13. 9. 2015
 * Time: 15:29
 */

namespace QW\FW\DataWorking\Sort;


// OK
use QW\FW\Basic\ArraysW;

class CocktailSort extends AbstractSort {

	protected function sort( AbstractSort $sort ) {
		$swapped = TRUE;
		$i       = 0;
		$j       = $this->length - 1;

		while ( $i < $j && $swapped ) {
			$swapped = FALSE;
			for ( $k = i; $k < $j; $k++ ) if ( $this->originalData[ $k ] > $this->originalData[ $k + 1 ] ) {
				ArraysW::swap( $this->originalData, $k, $k + 1 );
				$swapped = TRUE;
			}

			$j--;

			if ( $swapped ) {
				$swapped = FALSE;

				for ( $k = $j; $k > $i; $k-- ) if ( $this->originalData[ $k ] < $this->originalData[ $k - 1 ] ) {
					ArraysW::swap( $this->originalData, $k, $k - 1 );
					$swapped = TRUE;
				}
			}
			$i++;
		}

		$this->sortedData = $this->originalData;
	}
}