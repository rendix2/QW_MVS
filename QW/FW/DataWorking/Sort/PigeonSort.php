<?php

namespace QW\FW\DataWorking\Sort;

class PigeonSort extends AbstractSort {

	protected function sort( AbstractSort $sort ) {
		$min = $max = $this->originalData[ 0 ];

		foreach ( $this->originalData as $num ) {
			if ( $num < $min ) $min = $num;
			if ( $num > $max ) $max = $num;
		}

		$d   = [ ];
		$res = [ ];

		foreach ( $this->originalData as $num ) $d[ $num - $min ]++;

		for ( $i = 0; $i < $max - $min; $i++ ) while ( $d[ $i + $min ]-- > 0 ) $res[] = $i + $min;

		$this->sortedData = $this->originalData;
	}
}