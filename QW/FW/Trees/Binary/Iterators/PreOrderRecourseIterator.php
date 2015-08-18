<?php
namespace QW\FW\Trees\Binary\Iterators;
;

use QW\FW\Trees\AbstractIterators\AbstractBinaryTreeIterator;
use QW\FW\Trees\Binary\BinaryTree;

final class PreOrderRecourseIterator extends AbstractBinaryTreeIterator {
	public function __construct( BinaryTree $root = NULL ) {
		parent::__construct( $root );
	}

	protected function order( BinaryTree $root = NULL ) {
		if ( $root == NULL ) return;

		$this->finalData[] = $root->getData();
		$this->order( $root->getLeftChild() );
		$this->order( $root->getRightChild() );
	}
}