<?php

namespace QW\FW\Trees\Binary\Iterators;

use QW\FW\Trees\AbstractIterators\AbstractBinaryTreeIterator;
use QW\FW\Trees\Binary\BinaryTree;

final class CountIterator extends AbstractBinaryTreeIterator {

	private $countChildren;

	public function __construct(BinaryTree $root) {
		$this->countChildren = 0;

		parent::__construct($root);
	}

	public function getCountChildren() {
		return $this->countChildren;
	}

	protected function order(BinaryTree $root = NULL) {
		if ( $root == NULL || $this->realRoot == $root )
			return;

		$this->order($root->getLeftChild());
		$this->order($root->getRightChild());
		$this->countChildren++;
	}
}