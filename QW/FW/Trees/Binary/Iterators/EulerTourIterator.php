<?php

namespace QW\FW\Trees\Binary\Iterators;

use QW\FW\Trees\AbstractIterators\AbstractBinaryTreeIterator;
use QW\FW\Trees\Binary\BinaryTree;

final class EulerTourIterator extends AbstractBinaryTreeIterator {

	public function __construct(BinaryTree $root) {
		parent::__construct($root);
	}

	protected function order(BinaryTree $root = NULL) {
		$this->finalData[] = $root->getData();

		if ( $root->getLeftChild() != NULL ) $this->order($root->getLeftChild());

		$this->finalData[] = $root->getData();

		if ( $root->getRightChild() != NULL ) $this->order($root->getRightChild());

		$this->finalData[] = $root->getData();
	}
}