<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 7. 7. 2015
 * Time: 13:57
 */

namespace QW\FW\Sort;


class InsertionSort extends AbstractSort
{

	protected function sort( AbstractSort $sort )
	{
		for ( $i = 0; $i < $this->length - 1; $i++ ) {
			$j = $i + 1;
			$tmp = $this->data[ $j ];
			while ( $j > 0 && $tmp > $this->data[ $j - 1 ] ) {
				$this->data[ $j ] = $this->data[ $j - 1 ];
				$j--;
			}
			$this->data[ $j ] = $tmp;
		}

		return $this->data;
	}
}