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
			$tmp = $this->data[ $i ];
			$j   = $i;
			while ( $j >= 1 && $this->data[ $j - 1 ] > $tmp ) {
				$this->data[ $j ] = $this->data[ $j - 1 ];
				$j--;
			}
			$this->data[ $j ] = $tmp;
		}

		return $this->data;
	}
}