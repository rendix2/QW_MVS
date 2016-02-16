<?php

namespace QW\FW\Utils;

use QW\FW\Validator;

class MakeClone {

	private $object;

	public function __clone() {
		$this->deepClone( $this->object );
	}

	public function __construct( &$object ) {
		$this->object = $object;
	}

	public function deepClone( &$object ) {
		foreach ( $object as &$val ) if ( Validator::isObject( $val ) ) $val = clone $val;
		elseif ( Validator::isArray( $val ) ) $this->deepClone( $val );
	}

	final public function getCopy() {
		return clone $this->object;
	}
}