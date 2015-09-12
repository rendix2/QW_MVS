<?php
/**
 * Created by PhpStorm.
 * User: Tomáš
 * Date: 12. 9. 2015
 * Time: 15:34
 */

namespace QW\FW\Sort;


class GnomeSort extends AbstractSort {

	protected function sort( AbstractSort $sort ) {
		$i = 1;
		$j = 2;

		while ( $i < $this->length - 1 ) {
			if ( $this->data[ $i - 1 ] <= $this->data[ $i ] ) {
				$i = $j;
				$j += 1;
			}
			else {
				self::swap( $this->data, $i - 1, $i );
				$i -= 1;

				if ( $i == 0 ) {
					$i = $j;
					$j += 1;
				}
			}
		}
	}
}