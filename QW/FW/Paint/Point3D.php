<?php
/**
 * Created by PhpStorm.
 * User: Tomáš
 * Date: 22. 9. 2015
 * Time: 23:16
 */

namespace QW\FW\Paint;


use QW\FW\Boot\IllegalArgumentException;

class Point3D extends Point {

	private $z;

	public function __construct( $x, $y, $z, $debug = FALSE ) {
		if ( !is_numeric( $z ) ) throw new IllegalArgumentException();

		parent::__construct( $x, $y, $debug );

		$this->z = $z;
	}

	public function __destruct() {
		$this->z = NULL;
	}

	final public function  getZ() {
		return $this->z;
	}
}