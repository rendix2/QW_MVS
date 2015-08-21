<?php

namespace QW\FW\Trees\AbstractIterators;

use QW\FW\Trees\Binary\BinaryTree;

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