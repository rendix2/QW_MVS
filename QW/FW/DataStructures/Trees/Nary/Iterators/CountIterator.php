<?php

namespace QW\FW\DataStructures\Trees\Nary\Iterators;


use QW\FW\DataStructures\Trees\AbstractIterators\AbstractNaryTreeIterator;
use QW\FW\DataStructures\Trees\Nary\NaryTree;

final class CountIterator extends AbstractNaryTreeIterator {

	private $countChildren;

	public function __construct( NaryTree $root ) {
		$this->countChildren = 0;

		parent::__construct( $root );
	}

	public function __destruct() {
		$this->countChildren = NULL;
		parent::__destruct();
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