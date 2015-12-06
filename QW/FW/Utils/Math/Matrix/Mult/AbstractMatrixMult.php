<?php
/**
 * Created by PhpStorm.
 * User: Tomáš
 * Date: 11. 9. 2015
 * Time: 13:16
 */

namespace QW\FW\Utils\Math\Matrix\Mult;

use QW\FW\Basic\Object;
use QW\FW\Utils\Math\Matrix\Matrix;

abstract class AbstractMatrixMult extends Object {

	protected $result;

	abstract function mult( Matrix $a = NULL, Matrix $b = NULL );

	public function __construct( Matrix $a = NULL, Matrix $b = NULL, $debug = FALSE ) {
		parent::__construct( $debug );
		$this->result = $this->mult( $a, $b );
	}

	public function __destruct() {
		$this->result = NULL;

		parent::__destruct();
	}

	final public function getResult() {
		return $this->result;
	}
}