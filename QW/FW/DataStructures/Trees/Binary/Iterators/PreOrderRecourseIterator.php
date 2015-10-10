<?php
namespace QW\FW\DataStructures\Trees\Binary\Iterators;

use QW\FW\DataStructures\Trees\AbstractIterators\AbstractBinaryTreeIterator;
use QW\FW\DataStructures\Trees\Binary\BinaryTree;

final class PreOrderRecourseIterator extends AbstractBinaryTreeIterator {
	public function __construct( BinaryTree $root, $debug = FALSE ) {
		parent::__construct( $root, $debug );
	}

	public function __destruct() {
		parent::__destruct();
	}

	protected function order( BinaryTree $root = NULL ) {
		if ( $root == NULL ) return;

		$this->finalData[] = $root->getData();
		$this->order( $root->getLeftChild() );
		$this->order( $root->getRightChild() );
	}
}