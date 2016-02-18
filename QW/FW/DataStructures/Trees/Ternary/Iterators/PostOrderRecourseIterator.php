<?php
/**
 * Created by PhpStorm.
 * User: Tomáš
 * Date: 10. 10. 2015
 * Time: 14:39
 */

namespace QW\FW\DataStructures\Trees\Ternary\Iterators;


use QW\FW\DataStructures\Trees\AbstractIterators\AbstractTernaryTreeIterator;
use QW\FW\DataStructures\Trees\Binary\AbstractBinaryTree;
use QW\FW\DataStructures\Trees\Ternary\TernaryTree;

class PostOrderRecourseIterator extends AbstractTernaryTreeIterator {

	protected function order( AbstractBinaryTree $root = NULL ) {
		if ( $root == NULL ) return;

		$this->order( $root->getLeftChild() );
		if ( $root instanceof TernaryTree ) $this->order( $root->getMiddleChild() );
		$this->order( $root->getRightChild() );
		$this->finalData[] = $root->getData();
	}
}