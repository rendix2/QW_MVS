<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 7. 7. 2015
 * Time: 13:57
 */

namespace QW\FW\DataWorking\Sort;
// OK

class InsertionSort extends AbstractSort {

	protected function sort( AbstractSort $sort ) {
		for ( $i = 1; $i < $this->length; $i++ ) {
			$tmp = $this->originalData[ $i ];
			$j   = $i;
			while ( $j >= 1 && $this->originalData[ $j - 1 ] > $tmp ) {
				$this->originalData[ $j ] = $this->originalData[ $j - 1 ];
				$j--;
			}
			$this->originalData[ $j ] = $tmp;
		}

		$this->sortedData = $this->originalData;
	}
}