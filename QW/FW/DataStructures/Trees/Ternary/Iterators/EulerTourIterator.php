<?php

namespace QW\FW\DataStructures\Trees\Ternary\Iterators;

use QW\FW\DataStructures\Trees\AbstractIterators\AbstractTernaryTreeIterator;
use QW\FW\DataStructures\Trees\Binary\AbstractBinaryTree;
use QW\FW\DataStructures\Trees\Ternary\TernaryTree;

class EulerTourIterator extends AbstractTernaryTreeIterator {

	public function __construct( AbstractBinaryTree $root, $debug = FALSE ) {
		parent::__construct( $root, $debug );
	}

	public function __destruct() {
		parent::__destruct();
	}

	protected function order( AbstractBinaryTree $root = NULL ) {
		$this->finalData[] = $root->getData();

		if ( $root->getLeftChild() != NULL ) $this->order( $root->getLeftChild() );
		$this->finalData[] = $root->getData();

		if ( $root instanceof TernaryTree && $root->getMiddleChild() != NULL ) {
			$this->order( $root->getMiddleChild() );
			$this->finalData[] = $root->getData();
		}

		if ( $root->getRightChild() != NULL ) $this->order( $root->getRightChild() );
		$this->finalData[] = $root->getData();
	}
}