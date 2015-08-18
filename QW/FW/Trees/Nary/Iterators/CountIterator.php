<?php

namespace QW\FW\Trees\Nary\Iterators;

use QW\FW\Trees\AbstractIterators\AbstractNaryTreeIterator;
use QW\FW\Trees\Nary\NaryTree;

final class CountIterator extends AbstractNaryTreeIterator {

	private $countChildren;

	public function __construct( NaryTree $root ) {
		$this->countChildren = 0;

		parent::__construct( $root );
	}

	public function getCountChildren() {
		return $this->countChildren;
	}

	protected function order( NaryTree $root = NULL ) {
		if ( $root == NULL || $this->realRoot == $root ) return;

		foreach ( $root->getChildren() as $child ) $this->order( $child );

		$this->countChildren++;
	}
}