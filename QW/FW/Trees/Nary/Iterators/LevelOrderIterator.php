<?php

namespace QW\FW\Trees\Nary\Iterators;

use QW\FW\Trees\AbstractIterators\AbstractNaryTreeIterator;
use QW\FW\Trees\Nary\NaryTree;

class LevelOrderIterator extends AbstractNaryTreeIterator {

	private $queue;

	public function __construct ( NaryTree $root ) {
		$this->queue = new \SplQueue();
		parent::__construct( $root );
	}

	protected function order ( NaryTree $root = NULL ) {
		if ( $root == NULL || $this->realRoot == $root ) return;

		$this->queue->enqueue( $root );

		while ( !$this->queue->isEmpty() ) {
			$current           = $this->queue->dequeue();
			$this->finalData[] = $current->getData();

			foreach ( $current->getChildren() as $child ) if ( $child != NULL ) $this->queue->enqueue( $child );
		}
	}
}