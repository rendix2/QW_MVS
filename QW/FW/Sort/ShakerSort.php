<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 7. 7. 2015
 * Time: 13:54
 */

namespace QW\FW\Sort;


class ShakerSort extends AbstractSort {

	protected function sort( AbstractSort $sort ) {
		for ( $i = 0; $i < $this->length / 2; $i++ ) {
			$swapped = FALSE;

			for ( $j = $i; $j < $this->length - $i - 1; $j++ ) if ( $this->data[ $j ] < $this->data[ $j + 1 ] ) {
				$tmp                  = $this->data[ $j ];
				$this->data[ $j ]     = $this->data[ $j + 1 ];
				$this->data[ $j + 1 ] = $tmp;
				$swapped              = TRUE;
			}

			for ( $j = $this->length - 2 - $i; $j > $i; $j-- ) if ( $this->data[ $j ] > $this->data[ $j - 1 ] ) {
				$tmp                  = $this->data[ $j ];
				$this->data[ $j ]     = $this->data[ $j - 1 ];
				$this->data[ $j - 1 ] = $tmp;
				$swapped              = TRUE;
			}

			if ( $swapped ) break;
		}

		return $this->data;
	}
}