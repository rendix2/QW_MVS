<?php

namespace QW\FW\DataStructures\Trees\AbstractIterators;

use QW\FW\Basic\Object;

abstract class AbstractTreeIterator extends Object {

	protected $finalData;
	protected $realRoot;

	public function __construct( $debug = FALSE ) {
		parent::__construct( $debug );

		$this->finalData = [ ];
		$this->realRoot  = NULL;
	}

	public function __destruct() {
		$this->finalData = NULL;
		$this->realRoot  = NULL;

		parent::__destruct();
	}

	public final function getFinalData() {
		return $this->finalData;
	}
}