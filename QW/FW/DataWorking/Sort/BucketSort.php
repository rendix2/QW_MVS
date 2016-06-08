<?php

	namespace QW\FW\DataWorking\Sort;

	use QW\FW\Boot\IllegalArgumentException;

// NOT OK

	class BucketSort extends AbstractSort {

		private $bucketCount;

		public function __construct ( array $data, $bucketCount ) {
			parent::__construct ( $data );

			if ( $this->bucketCount <= 0 || !is_numeric ( $bucketCount ) ) throw new IllegalArgumentException();

			$this->bucketCount = $bucketCount;
		}

		protected function sort ( AbstractSort $sort ) {
			$high = $this->originalData[ 0 ];
			$low  = $this->originalData[ 0 ];

			for ( $i = 0; $i < $this->length; $i++ ) {
				if ( $this->originalData[ $i ] > $high ) $high = $this->originalData[ $i ];
				if ( $this->originalData[ $i ] < $low ) $low = $this->originalData[ $i ];
			}

			$interval = ( (float) ( $high - $low + 1 ) ) / $this->bucketCount;
			$buckets  = [ ];

			for ( $i = 0; $i < $this->length; $i++ )
				$buckets[ (int) ( ( $this->originalData[ $i ] - $low ) / $interval ) ] = $this->originalData[ $i ];

			$this->sortedData = $this->originalData;
		}
	}