<?php

namespace QW\FW\Lists;

use QW\FW\Basic\Object;

abstract class AbstractList extends Object implements IList {
	protected $size;

	public function __construct( $data = NULL, $debug = FALSE ) {
		parent::__construct( $debug );
		$this->size = 0;
	}

	public function __destruct() {
		$this->size = NULL;

		parent::__destruct();
	}
}