<?php
/**
 * Created by PhpStorm.
 * User: Tomáš
 * Date: 13. 9. 2015
 * Time: 20:25
 */

namespace QW\FW\Basic;


use QW\FW\Boot\IllegalArgumentException;
use QW\FW\Sort\QuickSort;

class Arrays extends Object {

	private $data;
	private $size;

	public function __construct( array $data, $debug = FALSE ) {
		parent::__construct( $debug );

		$this->data = [ ];
		$this->data = $data;
		$this->size = count( $this->data );
	}

	public function __destruct() {
		$this->data = NULL;
	}

	public function __toString() {
		return '[ ' . implode( ', ', $this->data ) . ' ]';
	}

	public function contains( $value ) {
		foreach ( $this->data as $v ) if ( $v == $value ) return TRUE;

		return FALSE;
	}

	public function fill( $value ) {
		foreach ( $this->data as $k => $v ) {
			$this->data[ $k ] = $value;
		}
	}

	public function get( $key ) {
		if ( $this->keyExists( $key ) ) return $this->data[ $key ];
		throw new IllegalArgumentException();
	}

	public function getSize() {
		return $this->size;
	}

	public function keyExists( $key ) {
		return array_key_exists( $key, $this->data );
	}

	public function merge() {
		foreach ( func_get_args() as $v ) if ( is_array( $v ) ) {
			$this->data = array_merge( $this->data, $v );
			$this->size += count( $v );
		}
	}

	public function put( $data ) {
		$this->data[] = $data;

		if ( is_array( $data ) ) $this->size += count( $data );
		else $this->size++;
	}

	public function remove( $key ) {
		if ( $this->keyExists( $key ) ) {
			unset( $this->data[ $key ] );
			$this->size--;
		}
		throw new IllegalArgumentException();
	}

	public function removeAll() {
		$this->data = [ ];
		$this->size = 0;
	}

	public function sort() {
		$obj = new QuickSort( $this->data );

		return $obj->getArray();
	}
}