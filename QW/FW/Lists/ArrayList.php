<?php

namespace QW\FW\Lists;

use QW\FW\Boot\IllegalArgumentException;

class ArrayList extends AbstractList implements IList {

	private $data;

	public function __construct() {
		parent::__construct();
		$this->data = [ ];
		$this->size = 0;
	}


	public function __destruct() {
		$this->data = NULL;

		parent::__destruct();
	}

	public function __toString() {
		return '[ ' . implode( ', ', $this->data ) . ' ]';
	}

	public function add( $data ) {
		$this->data[] = $data;
		$this->size++;
	}

	public function contains( $data ) {
		foreach ( $this->data as $v ) if ( $v == $data ) return TRUE;

		return FALSE;
	}

	public function get( $index ) {
		if ( $index > $this->size ) throw new IllegalArgumentException();

		return $this->data[ $index ];
	}

	public function getFirst() {
		return $this->data[ 0 ];
	}

	public function getLast() {
		return $this->data[ $this->size - 1 ];
	}

	public function remove( $index ) {
		if ( $index > $this->size ) throw new IllegalArgumentException();

		for ( $i = $index + 1; $i < $this->size; $i++ ) $this->data[ $i - 1 ] = $this->data[ $i ];

		unset( $this->data[ $this->size - 1 ] );
		$this->size--;
	}
}