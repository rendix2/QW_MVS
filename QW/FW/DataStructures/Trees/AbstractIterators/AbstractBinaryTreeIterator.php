<?php

namespace QW\FW\DataStructures\Trees\AbstractIterators;

use QW\FW\DataStructures\Trees\Binary\BinaryTree;

abstract class AbstractBinaryTreeIterator extends AbstractTreeIterator {

	abstract protected function order( BinaryTree $root );

	public function __construct( BinaryTree $root ) {
		parent::__construct();

		$this->realRoot = $root;
		$this->order( $root );
	}

	public function __destruct() {
		parent::__destruct();
	}
}