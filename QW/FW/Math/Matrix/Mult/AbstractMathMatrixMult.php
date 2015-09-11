<?php
/**
 * Created by PhpStorm.
 * User: Tomáš
 * Date: 11. 9. 2015
 * Time: 13:16
 */

namespace QW\FW\Math\Matrix\Mult;

use QW\FW\Basic\Object;
use QW\FW\Math\Matrix\MathMatrix;

abstract class AbstractMathMatrixMult extends Object {

	protected $result;

	abstract function mult( MathMatrix $a = NULL, MathMatrix $b = NULL );

	public function __construct( MathMatrix $a = NULL, MathMatrix $b = NULL, $debug = FALSE ) {
		parent::__construct( $debug );
		$this->result = $this->mult( $a, $b );
	}

	final public function getResult() {
		return $this->result;
	}
}