<?php
/**
 * Created by PhpStorm.
 * User: Tomáš
 * Date: 4. 10. 2015
 * Time: 17:54
 */

namespace QW\FW\Utils\Math\Geom;


use QW\FW\Basic\Object;

class Circle extends Object {

	private $point;

	public function __construct( Point $point, $debug = FALSE ) {
		parent::__construct( $debug );

		$this->point = $point;
	}

	public function __destruct() {
		$this->point = NULL;

		parent::__destruct();
	}
}