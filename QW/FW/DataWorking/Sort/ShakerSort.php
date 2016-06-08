<?php

	namespace QW\FW\DataWorking\Sort;

	use QW\FW\Basic\ArraysW;

	class ShakerSort extends AbstractSort {

		protected function sort ( AbstractSort $sort ) {
			for ( $i = 0; $i < $this->length / 2; $i++ ) {
				$swapped = FALSE;

				for ( $j = $i; $j < $this->length - $i - 1; $j++ )
					if ( $this->originalData[ $j ] < $this->originalData[ $j + 1 ] ) {
						ArraysW::swap ( $this->originalData, $j, $j + 1 );
						$swapped = TRUE;
					}

				for ( $j = $this->length - 2 - $i; $j > $i; $j-- )
					if ( $this->originalData[ $j ] > $this->originalData[ $j - 1 ] ) {
						ArraysW::swap ( $this->originalData, $j, $j - 1 );
						$swapped = TRUE;
					}

				if ( $swapped ) break;
			}

			$this->sortedData = $this->originalData;
		}
	}