<?php

	namespace QW\FW\DataWorking\Sort;

// OK
	use QW\FW\Basic\ArraysW;

	class GnomeSort extends AbstractSort {

		protected function sort ( AbstractSort $sort ) {
			for ( $i = 1; $i < $this->length; ) if ( $this->originalData[ $i - 1 ] <= $this->originalData[ $i ] ) $i++;
			else {
				ArraysW::swap ( $this->originalData, $i, $i - 1 );
				$i--;
				if ( $i == 0 ) $i = 1;
			}

			$this->sortedData = $this->originalData;
		}
	}