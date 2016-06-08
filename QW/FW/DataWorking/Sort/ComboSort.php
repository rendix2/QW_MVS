<?php

	namespace QW\FW\DataWorking\Sort;

// OK

	use QW\FW\Basic\ArraysW;

	class ComboSort extends AbstractSort {

		protected function sort ( AbstractSort $sort ) {
			$swapped = FALSE;
			$gap     = $this->length;

			while ( $gap != 1 || $swapped ) {

				$gap /= 1.33; // 4/3
				$swapped = FALSE;

				if ( $gap < 1 ) $gap = 1;

				for ( $i = 0; $i + $gap < $this->length; $i++ )
					if ( $this->originalData[ $i ] < $this->originalData[ $i + $gap ] ) {
						ArraysW::swap ( $this->originalData, $i, $i + $gap );
						$swapped = TRUE;
					}
			}

			$this->sortedData = $this->originalData;
		}
	}