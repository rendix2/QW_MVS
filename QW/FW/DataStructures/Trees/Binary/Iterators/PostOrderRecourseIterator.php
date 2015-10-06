<?php
namespace QW\FW\DataStructures\Trees\Binary\Iterators;

use QW\FW\DataStructures\Trees\AbstractIterators\AbstractBinaryTreeIterator;
use QW\FW\DataStructures\Trees\Binary\BinaryTree;

final class PostOrderRecourseIterator extends AbstractBinaryTreeIterator {
	public function __construct( BinaryTree $root = NULL ) {
		parent::__construct( $root );
	}

	public function __destruct() {
		parent::__destruct();
	}


	protected function order( BinaryTree $root = NULL ) {
		if ( $root == NULL ) return;

		$this->order( $root->getLeftChild() );
		$this->order( $root->getRightChild() );
		$this->finalData[] = $root->getData();
	}
}