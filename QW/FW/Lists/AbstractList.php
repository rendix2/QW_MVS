<?php

namespace QW\FW\Lists;

use QW\FW\Basic\Object;

abstract class AbstractList extends Object implements IList {

	protected $size;

	public function __construct($data = NULL) {
		parent::__construct();
		$this->size = 0;
	}
}