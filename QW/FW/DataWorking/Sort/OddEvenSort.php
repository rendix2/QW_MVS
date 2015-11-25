<?php
/**
 * Created by PhpStorm.
 * User: Tomáš
 * Date: 12. 9. 2015
 * Time: 20:47
 */

namespace QW\FW\DataWorking\Sort;

use QW\FW\Basic\Arrays;

class OddEvenSort extends AbstractSort {

	protected function sort( AbstractSort $sort ) {

		$sorted = FALSE;

		while ( !$sorted ) {
			$sorted = TRUE;

			for ( $i = 1; $i < $this->length - 1; $i += 2 )
				if ( $this->originalData[ $i ] > $this->originalData[ $i + 1 ] ) {
					Arrays::swap( $this->originalData, $i, $i + 1 );
					$sorted = FALSE;
				}

			for ( $i = 0; $i < $this->length - 1; $i += 2 )
				if ( $this->originalData[ $i ] > $this->originalData[ $i + 1 ] ) {
					Arrays::swap( $this->originalData, $i, $i + 1 );
					$sorted = FALSE;
				}
		}
		$this->sortedData = $this->originalData;
	}
}