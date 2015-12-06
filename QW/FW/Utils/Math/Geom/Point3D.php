<?php
/**
 * Created by PhpStorm.
 * User: Tomáš
 * Date: 22. 9. 2015
 * Time: 23:16
 */

namespace QW\FW\Utils\Math\Geom;


use QW\FW\Boot\IllegalArgumentException;
use QW\FW\Validator;

class Point3D extends Point {

	private $z;

	public function __construct( $x, $y, $z, $debug = FALSE ) {
		parent::__construct( $x, $y, $debug );
		if ( !Validator::isNumber( $z ) ) throw new IllegalArgumentException();

		$this->z = $z;
	}

	public function __destruct() {
		$this->z = NULL;

		parent::__destruct();
	}

	final public function getZ() {
		return $this->z;
	}
}