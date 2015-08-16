<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 7. 7. 2015
 * Time: 13:54
 */

namespace QW\FW\Sort;


class SelectionSort extends AbstractSort {

	protected function sort(AbstractSort $sort) {
		for ( $i = 0; $i < $this->length - 1; $i++ ) {
			$maxIndex = $i;
			for ( $j = $i + 1; $j < $this->length; $j++ )
				if ( $this->data[ $j ] > $this->data[ $maxIndex ] )
					$maxIndex = $j;

			$tmp                     = $this->data[ $i ];
			$this->data[ $i ]        = $this->data[ $maxIndex ];
			$this->data[ $maxIndex ] = $tmp;
		}

		return $this->data;
	}
}