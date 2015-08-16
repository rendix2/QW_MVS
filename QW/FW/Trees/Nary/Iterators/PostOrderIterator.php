<?php

namespace QW\FW\Trees\Nary\Iterators;
;

use QW\FW\Trees\AbstractIterators\AbstractNaryTreeIterator;
use QW\FW\Trees\Nary\NaryTree;

class PostOrderIterator extends AbstractNaryTreeIterator {

	public final function __construct(NaryTree $root) {
		parent::__construct($root);
	}

	protected function order(NaryTree $root) {
		if ( $root == NULL || $this->realRoot == $root ) {
			return;
		}

		foreach ( $root->getChildren() as $child ) {
			$this->order($child);
		}

		$this->finalData[] = $root->getData();
	}
}