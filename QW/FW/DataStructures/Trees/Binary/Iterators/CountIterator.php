<?php

namespace QW\FW\DataStructures\Trees\Binary\Iterators;

use QW\FW\DataStructures\Trees\AbstractIterators\AbstractBinaryTreeIterator;
use QW\FW\DataStructures\Trees\Binary\AbstractBinaryTree;

final class CountIterator extends AbstractBinaryTreeIterator {

	private $countChildren;

	public function __construct( AbstractBinaryTree $root = NULL, $debug = FALSE ) {
		$this->countChildren = 0;
		parent::__construct( $root, $debug );
	}

	public function __destruct() {
		$this->countChildren = NULL;
		parent::__destruct();
	}

	public function getCountChildren() {
		return $this->countChildren;
	}

	protected function order( AbstractBinaryTree $root = NULL ) {
		if ( $root == NULL || $this->realRoot == $root ) return;

		$this->order( $root->getLeftChild() );
		$this->order( $root->getRightChild() );
		$this->countChildren++;
	}
}