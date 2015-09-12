<?php
/**
 * Created by PhpStorm.
 * User: Tomáš
 * Date: 12. 9. 2015
 * Time: 20:47
 */

namespace QW\FW\Sort;


class OddEvenSort extends AbstractSort {

	protected function sort( AbstractSort $sort ) {

		$sorted = FALSE;

		while ( !$sorted ) {
			$sorted = TRUE;

			for ( $i = 1; $i < $this->length - 1; $i += 2 ) if ( $this->data[ $i ] > $this->data[ $i + 1 ] ) {
				self::swap( $this->data, $i, $i + 1 );
				$sorted = FALSE;
			}

			for ( $i = 0; $i < $this->length - 1; $i += 2 ) if ( $this->data[ $i ] > $this->data[ $i + 1 ] ) {
				self::swap( $this->data, $i, $i + 1 );
				$sorted = FALSE;
			}
		}

	}
}