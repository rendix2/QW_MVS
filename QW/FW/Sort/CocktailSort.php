<?php
/**
 * Created by PhpStorm.
 * User: Tomáš
 * Date: 13. 9. 2015
 * Time: 15:29
 */

namespace QW\FW\Sort;


// OK
class CocktailSort extends AbstractSort {

	protected function sort( AbstractSort $sort ) {
		$swapped = TRUE;
		$i       = 0;
		$j       = $this->length - 1;

		while ( $i < $j && $swapped ) {
			$swapped = FALSE;
			for ( $k = i; $k < $j; $k++ ) {
				if ( $this->data[ $k ] > $this->data[ $k + 1 ] ) {
					self::swap( $this->data, $k, $k + 1 );
					$swapped = TRUE;
				}
			}
			$j--;

			if ( $swapped ) {
				$swapped = FALSE;

				for ( $k = $j; $k > $i; $k-- ) {
					if ( $this->data[ $k ] < $this->data[ $k - 1 ] ) {
						self::swap( $this->data, $k, $k - 1 );
						$swapped = TRUE;
					}
				}
			}
			$i++;
		}

		return $this->data;
	}
}