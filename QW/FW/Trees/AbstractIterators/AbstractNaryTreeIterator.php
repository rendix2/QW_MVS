<?php

namespace QW\FW\Trees\AbstractIterators;

use QW\FW\Trees\Nary\NaryTree;

abstract class AbstractNaryTreeIterator extends AbstractTreeIterator {

	abstract protected function order( NaryTree $root );

	public function __construct( NaryTree $root ) {
		parent::__construct();

		$this->realRoot = $root;
		$this->order( $root );
	}

	public function __destruct() {
		parent::__destruct();
	}
}