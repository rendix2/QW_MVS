<?php

namespace QW\FW\DataStructures\Trees\Nary\Iterators;

use QW\FW\DataStructures\Trees\AbstractIterators\AbstractNaryTreeIterator;
use QW\FW\DataStructures\Trees\Nary\NaryTree;

class InOrderIterator extends AbstractNaryTreeIterator {
	public final function __construct( NaryTree $root, $debug = FALSE ) {
		parent::__construct( $root, $debug );
	}

	public function __destruct() {
		parent::__destruct();
	}

	protected function order( NaryTree $root = NULL ) {
		if ( $root == NULL || $this->realRoot == $root ) return;

		foreach ( $root->getChildren() as $child ) {
			$this->finalData[] = $child->getData();
			$this->order( $child );
		}
	}
}
