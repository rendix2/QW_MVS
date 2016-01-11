<?php
namespace QW\FW\DataStructures\Trees\Binary\Iterators;

use QW\FW\DataStructures\Trees\AbstractIterators\AbstractBinaryTreeIterator;
use QW\FW\DataStructures\Trees\Binary\AbstractBinaryTree;

final class InOrderRecourseIterator extends AbstractBinaryTreeIterator {
	public function __construct( AbstractBinaryTree $root = NULL, $debug = FALSE ) {
		parent::__construct( $root, $debug );
	}

	public function __destruct() {
		parent::__destruct();
	}

	protected function order( AbstractBinaryTree $root = NULL ) {
		if ( $root == NULL ) return;

		$this->order( $root->getLeftChild() );
		$this->finalData[] = $root->getData();
		$this->order( $root->getRightChild() );
	}
}