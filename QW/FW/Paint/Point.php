<?php
/**
 * Created by PhpStorm.
 * User: Tomáš
 * Date: 22. 9. 2015
 * Time: 22:37
 */

namespace QW\FW\Paint;


use QW\FW\Basic\Object;
use QW\FW\Boot\IllegalArgumentException;

class Point extends Object {

	private $x;
	private $y;

	public function __construct( $x, $y, $debug = FALSE ) {
		parent::__construct( $debug );

		if ( !is_numeric( $x ) || !is_numeric( $y ) ) throw new IllegalArgumentException();
		$this->x = $x;
		$this->y = $y;
	}

	public function __destruct() {
		$this->x = NULL;
		$this->y = NULL;
	}

	final public function getX() {
		return $this->x;
	}

	final public function getY() {
		return $this->y;
	}

}