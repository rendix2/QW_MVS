<?php
	/**
	 * Created by PhpStorm.
	 * User: Tom
	 * Date: 7. 7. 2015
	 * Time: 13:52
	 */

	namespace QW\FW\DataWorking\Sort;

// not checked

	use QW\FW\Basic\ArraysW;

	class HeapSort extends AbstractSort {

		private function repairTop ( array $array, $bottom, $topIndex ) {
			$tmp  = $array[ $topIndex ];
			$succ = $topIndex * 2 + 1;

			if ( $succ < $bottom && $array[ $succ ] > $array[ $succ + 1 ] ) $succ++;

			while ( $succ <= $bottom && $tmp > $array[ $succ ] ) {
				$array[ $topIndex ] = $array[ $succ ];
				$topIndex           = $succ;
				if ( $succ < $bottom && $array[ $succ ] > $array[ $succ + 1 ] ) $succ++;
			}
			$array[ $topIndex ] = $tmp;
		}

		protected function sort ( AbstractSort $sort ) {
			for ( $i = $this->length / 2 - 1; $i >= 0; $i-- )
				$this->repairTop ( $this->originalData, $this->length - 1, $i );

			for ( $i = $this->length - 1; $i > 0; $i-- ) {
				ArraysW::swap ( $this->originalData, 0, $i );
				$this->repairTop ( $this->originalData, $i - 1, 0 );
			}

			$this->sortedData = $this->originalData;
		}
	}