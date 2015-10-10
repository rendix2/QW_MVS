<?php

namespace QW\FW\DataStructures\Trees\Nary\Iterators;

use QW\FW\DataStructures\Trees\AbstractIterators\AbstractNaryTreeIterator;
use QW\FW\DataStructures\Trees\Nary\NaryTree;

class EulerTourIterator extends AbstractNaryTreeIterator {
	public function __construct( NaryTree $root, $debug = FALSE ) {
		parent::__construct( $root, $debug );

		if ( $root->getDirectChildrenCount() ) {
			foreach ( $root->getChildren() as $child ) {
				$this->finalData[] = $root->getData();
				$this->order( $child );
			}

			$this->finalData[] = $root->getData();
		}
		else $this->order( $root );
	}

	public function __destruct() {
		parent::__destruct();
	}

	protected function order( NaryTree $root = NULL ) {
		$this->finalData[] = $root->getData();

		for ( $key = 0; $key < ( $root->getDirectChildrenCount() / 2 ); $key++ )
			if ( $root->getChildren()[ $key ] != NULL ) $this->order( $root->getChildren()[ $key ] );

		$this->finalData[] = $root->getData();

		for ( $key = $root->getDirectChildrenCount() - 1 / 2; $key < $root->getDirectChildrenCount(); $key++ )
			if ( $root->getChildren()[ $key ] != NULL ) $this->order( $root->getChildren()[ $key ] );

		$this->finalData[] = $root->getData();
	}
}
