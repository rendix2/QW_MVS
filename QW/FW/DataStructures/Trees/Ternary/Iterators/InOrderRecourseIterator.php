<?php
/**
 * Created by PhpStorm.
 * User: Tomáš
 * Date: 10. 10. 2015
 * Time: 14:42
 */

namespace QW\FW\DataStructures\Trees\Ternary\Iterators;


use QW\FW\DataStructures\Trees\AbstractIterators\AbstractTernaryTreeIterator;
use QW\FW\DataStructures\Trees\Ternary\TernaryTree;

class InOrderRecourseIterator extends AbstractTernaryTreeIterator {

	protected function order( TernaryTree $root = NULL ) {
		if ( $root == NULL ) return;

		$this->order( $root->getLeftChild() );
		$this->finalData[] = $root->getData();
		$this->order( $root->getMiddleChild() );
		$this->order( $root->getRightChild() );
	}
}