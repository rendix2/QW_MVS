<?php

namespace QW\FW\Trees\Nary\Iterators;

use QW\FW\Trees\AbstractIterators\AbstractNaryTreeIterator;
use QW\FW\Trees\Nary\NaryTree;

class EulerTourIterator extends AbstractNaryTreeIterator {
	public function __construct(NaryTree $root) {
		parent::__construct($root);

		if ( $root->getDirectChildrenCount() ) {
			foreach ( $root->getChildren() as $child ) {
				$this->finalData[] = $root->getData();
				$this->order($child);
			}

			$this->finalData[] = $root->getData();
		}
		else $this->order($root);
	}

	protected function order(NaryTree $root = NULL) {
		$this->finalData[] = $root->getData();

		for ( $key = 0; $key < ( $root->getDirectChildrenCount() / 2 ); $key++ )
			if ( $root->getChildren()[ $key ] != NULL )
				$this->order($root->getChildren()[ $key ]);

		$this->finalData[] = $root->getData();

		for ( $key = $root->getDirectChildrenCount() - 1 / 2; $key < $root->getDirectChildrenCount(); $key++ )
			if ( $root->getChildren()[ $key ] != NULL )
				$this->order($root->getChildren()[ $key ]);

		$this->finalData[] = $root->getData();
	}
}
