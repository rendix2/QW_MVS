<?php

namespace QW\FW\Trees\AbstractIterators;

use QW\FW\Basic\Object;

abstract class AbstractTreeIterator extends Object {

	protected $finalData;
	protected $realRoot;

	public function __construct() {
		$this->finalData = [ ];
		$this->realRoot  = NULL;
	}

	public final function getFinalData() {
		return $this->finalData;
	}
}