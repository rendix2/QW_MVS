<?php

namespace QW\FW\DataStructures\Trees\Nary\Iterators;

use QW\FW\DataStructures\Trees\AbstractIterators\AbstractNaryTreeIterator;
use QW\FW\DataStructures\Trees\Nary\NaryTree;

class LevelOrderIterator extends AbstractNaryTreeIterator {

	private $queue;

	public function __construct( NaryTree $root, $debug = FALSE ) {
		$this->queue = new \SplQueue();
		parent::__construct( $root, $debug );
	}

	public function __destruct() {
		$this->queue = NULL;
		parent::__destruct();
	}

	protected function order( NaryTree $root = NULL ) {
		if ( $root == NULL ) return;

		$this->queue->enqueue( $root );

		while ( !$this->queue->isEmpty() ) {
			$current           = $this->queue->dequeue();
			$this->finalData[] = $current->getData();

			foreach ( $current->getChildren() as $child ) if ( $child != NULL ) $this->queue->enqueue( $child );
		}
	}
}