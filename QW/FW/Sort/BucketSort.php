<?php

namespace QW\FW\Sort;

use QW\FW\Boot\IllegalArgumentException;

class BucketSort extends AbstractSort {

	private $bucketCount;

	public function __construct( array $data, $bucketCount, $debug = FALSE ) {
		parent::__construct( $data );

		if ( $this->bucketCount <= 0 || !is_numeric( $bucketCount ) ) throw new IllegalArgumentException();

		$this->bucketCount = $bucketCount;
	}

	protected function sort( AbstractSort $sort ) {
		$high = $this->data[ 0 ];
		$low  = $this->data[ 0 ];

		for ( $i = 0; $i < $this->length; $i++ ) {
			if ( $this->data[ $i ] > $high ) $high = $this->data[ $i ];
			if ( $this->data[ $i ] < $low ) $low = $this->data[ $i ];
		}

		$interval = ( (float) ( $high - $low + 1 ) ) / $this->bucketCount;
		$buckets = [ ];

		for ( $i = 0; $i < $this->length; $i++ )
			$buckets[ (int) ( ( $this->data[ $i ] - $low ) / $interval ) ] = $this->data[ $i ];
	}
}