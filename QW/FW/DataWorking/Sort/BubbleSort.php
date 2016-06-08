<?php

	namespace QW\FW\DataWorking\Sort;

	use QW\FW\Basic\ArraysW;

	class BubbleSort extends AbstractSort {

		// better then OK
		protected function sort ( AbstractSort $sort ) {
			$j       = $this->length - 2;
			$swapped = TRUE;

			while ( $swapped ) {
				$swapped = FALSE;

				for ( $i = 0; $i <= $j; $i++ ) if ( $this->originalData[ $i ] > $this->originalData[ $i + 1 ] ) {
					ArraysW::swap ( $this->originalData, $i, $i + 1 );
					$swapped = TRUE;
				}
			}

			$this->sortedData = $this->originalData;
		}
	}