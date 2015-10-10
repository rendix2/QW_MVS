<?php

namespace QW\FW\DataStructures\Trees\AbstractIterators;

use QW\FW\DataStructures\Trees\Ternary\TernaryTree;

abstract class AbstractTernaryTreeIterator extends AbstractTreeIterator {

	abstract protected function order( TernaryTree $root = NULL );

	public function __construct( TernaryTree $root, $debug = FALSE ) {
		parent::__construct( $debug );

		$this->order( $root );
	}

	public function __destruct() {
		parent::__destruct();
	}

}