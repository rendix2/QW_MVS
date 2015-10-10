<?php
/**
 * Created by PhpStorm.
 * User: Tomáš
 * Date: 13. 9. 2015
 * Time: 20:25
 */

namespace QW\FW\Basic;

use QW\FW\Boot\IllegalArgumentException;
use QW\FW\Boot\RuntimeException;
use QW\FW\DataWorking\Sort\QuickSort;

class Arrays extends Object implements \ArrayAccess {

	private $data;
	private $size;

	public function __construct( array $data = [ ], $debug = FALSE ) {
		parent::__construct( $debug );

		$this->data = $data;
		$this->size = count( $this->data );
	}

	public function __destruct() {
		$this->data = NULL;
		$this->size = NULL;
	}

	function __isset( $name ) {
		return isset( $this->data[ $name ] );
	}

	public function __toString() {
		return '[ <b>' . implode( '</b>, <b>', $this->data ) . '</b> ]';
	}

	function __unset( $name ) {
		unset ( $this->data[ $name ] );
		$this->size--;
	}

	public static function copyOfRange( &$array, $start, $end ) {
		$arrayNew = [ ];

		for ( $i = $start; $i < $end; $i++ ) $arrayNew[] = $array[ $i ];

		return $arrayNew;
	}

	public static function count( &$array ) {
		return count( $array );
	}

	public function add( $data ) {
		$this->data[] = $data;
		$this->size++;
	}

	public function contains( $value ) {
		if ( $this->size == 0 ) FALSE;
		foreach ( $this->data as $v ) if ( $v == $value ) return TRUE;

		return FALSE;
	}

	public function fill( $value ) {
		foreach ( $this->data as $k => $v ) $this->data[ $k ] = $value;
	}

	public function getFirst() {
		if ( $this->size == 0 ) throw new IllegalArgumentException();

		return $this->data[ 0 ];
	}

	public function getLast() {
		if ( $this->size == 0 ) throw new IllegalArgumentException();

		return $this->data[ $this->size - 1 ];
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

	public function offsetExists( $offset ) {
		return isset( $this->data[ $offset ] );
	}

	public function offsetGet( $offset ) {
		if ( $this->size == 0 || $offset > $this->size ) throw new RuntimeException();
		if ( $this->keyExists( $offset ) ) return $this->data[ $offset ];
		throw new IllegalArgumentException();
	}

	public function offsetSet( $offset, $value ) {
		if ( is_null( $offset ) ) $this->data[] = $value;
		else $this->data[ $offset ] = $value;
		$this->size++;
	}

	public function offsetUnset( $offset ) {
		if ( $this->size == 0 || $offset > $this->size ) throw new RuntimeException();
		if ( $this->keyExists( $offset ) ) {
			unset( $this->data[ $offset ] );
			$this->size--;
		}
		throw new IllegalArgumentException();
	}

	public function remove( $index ) {
		if ( $index > $this->size ) throw new IllegalArgumentException();

		for ( $i = $index + 1; $i < $this->size; $i++ ) $this->data[ $i - 1 ] = $this->data[ $i ];

		unset( $this->data[ $this->size - 1 ] );
		$this->size--;
	}

	public function removeAll() {
		$this->data = [ ];
		$this->size = 0;
	}

	public function sort() {
		$obj = new QuickSort( $this->data, $this->debug );

		return $obj->getArray();
	}
}