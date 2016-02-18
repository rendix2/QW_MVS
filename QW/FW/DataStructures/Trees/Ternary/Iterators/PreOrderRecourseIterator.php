<?php

namespace QW\FW\DataStructures\Trees\Ternary\Iterators;

use QW\FW\DataStructures\Trees\AbstractIterators\AbstractTernaryTreeIterator;
use QW\FW\DataStructures\Trees\Binary\AbstractBinaryTree;
use QW\FW\DataStructures\Trees\Ternary\TernaryTree;

class PreOrderRecourseIterator extends AbstractTernaryTreeIterator {

	protected function order( AbstractBinaryTree $root = NULL ) {
		if ( $root == NULL ) return;

		$this->finalData[] = $root->getData();
		$this->order( $root->getLeftChild() );
		if ( $root instanceof TernaryTree ) $this->order( $root->getMiddleChild() );
		$this->order( $root->getRightChild() );
	}
}
