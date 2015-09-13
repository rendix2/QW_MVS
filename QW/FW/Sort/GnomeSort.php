<?php
/**
 * Created by PhpStorm.
 * User: Tomáš
 * Date: 12. 9. 2015
 * Time: 15:34
 */

namespace QW\FW\Sort;

// OK
class GnomeSort extends AbstractSort {

	protected function sort( AbstractSort $sort ) {
		for ( $i = 1; $i < $this->length; ) if ( $this->data[ $i - 1 ] <= $this->data[ $i ] ) $i++;
		else {
			self::swap( $this->data, $i, $i - 1 );
			$i--;
			if ( $i == 0 ) $i = 1;
		}

		return $this->data;
	}
}