<?php
/**
 * Created by PhpStorm.
 * User: Tomáš
 * Date: 13. 9. 2015
 * Time: 15:01
 */

namespace QW\FW\Sort;


class PigeonSort extends AbstractSort {

	protected function sort( AbstractSort $sort ) {
		$min = $max = $this->data[ 0 ];

		foreach ( $this->data as $num ) {
			if ( $num < $min ) $min = $num;
			if ( $num > $max ) $max = $num;
		}

		$d   = [ ];
		$res = [ ];

		foreach ( $this->data as $num ) $d[ $num - $min ]++;

		for ( $i = 0; $i < $max - $min; $i++ ) while ( $d[ $i + $min ]-- > 0 ) $res[] = $i + $min;

		return $this->data;
	}
}