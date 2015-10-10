<?php

namespace QW\FW\DataStructures\Trees\AbstractIterators;

use QW\FW\DataStructures\Trees\Binary\BinaryTree;

abstract class AbstractBinaryTreeIterator extends AbstractTreeIterator {

	abstract protected function order( BinaryTree $root = NULL );

	public function __construct( BinaryTree $root, $debug = FALSE ) {
		parent::__construct( $debug );

		$this->realRoot = $root;
		$this->order( $root );
	}

	public function __destruct() {
		parent::__destruct();
	}
}