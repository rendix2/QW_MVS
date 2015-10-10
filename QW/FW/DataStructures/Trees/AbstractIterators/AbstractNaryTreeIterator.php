<?php

namespace QW\FW\DataStructures\Trees\AbstractIterators;

use QW\FW\DataStructures\Trees\Nary\NaryTree;

abstract class AbstractNaryTreeIterator extends AbstractTreeIterator {

	abstract protected function order( NaryTree $root = NULL );

	public function __construct( NaryTree $root, $debug = FALSE ) {
		parent::__construct( $debug );

		$this->realRoot = $root;
		$this->order( $root );
	}

	public function __destruct() {
		parent::__destruct();
	}
}