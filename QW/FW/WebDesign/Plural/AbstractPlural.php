<?php
/**
 * Created by PhpStorm.
 * User: Tomáš
 * Date: 7. 9. 2015
 * Time: 15:51
 */

namespace QW\FW\WebDesign\Plural;

use QW\FW\Basic\Object;

abstract class AbstractPlural extends Object {

	protected $plural;

	public function __construct( $debug = FALSE ) {
		parent::__construct( $debug );

		$this->plural = '';
	}

	public function __toString() {
		return $this->getPlural();
	}

	final public function getPlural() {
		return $this->plural;
	}
}