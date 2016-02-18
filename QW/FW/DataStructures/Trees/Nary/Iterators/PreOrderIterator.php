<?php

namespace QW\FW\DataStructures\Trees\Nary\Iterators;

use QW\FW\DataStructures\Trees\AbstractIterators\AbstractNaryTreeIterator;
use QW\FW\DataStructures\Trees\Nary\NaryTree;

class PreOrderIterator extends AbstractNaryTreeIterator {

	public final function __construct( NaryTree $root, $debug = FALSE ) {
		parent::__construct( $root, $debug );
	}

	public function __destruct() {
		parent::__destruct();
	}

	protected function order( NaryTree $root = NULL ) {
		if ( $root == NULL ) return;

		$this->finalData[] = $root->getData();

		foreach ( $root->getChildren() as $child ) $this->order( $child );
	}
}