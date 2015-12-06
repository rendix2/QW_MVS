<?php

namespace QW\FW\DataStructures\Trees\Ternary\Iterators;

use QW\FW\DataStructures\Trees\AbstractIterators\AbstractTernaryTreeIterator;
use QW\FW\DataStructures\Trees\Ternary\TernaryTree;

class PreOrderRecourseIterator extends AbstractTernaryTreeIterator {

	protected function order( TernaryTree $root = NULL ) {
		if ( $root == NULL ) return;

		$this->finalData[] = $root->getData();
		$this->order( $root->getLeftChild() );
		$this->order( $root->getMiddleChild() );
		$this->order( $root->getRightChild() );
	}
}
