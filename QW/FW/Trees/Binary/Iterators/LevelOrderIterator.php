<?php

namespace QW\FW\Trees\Binary\Iterators;

use QW\FW\Trees\AbstractIterators\AbstractBinaryTreeIterator;
use QW\FW\Trees\Binary\BinaryTree;

class LevelOrderIterator extends AbstractBinaryTreeIterator {

	private $queue;

	public function __construct( BinaryTree $root ) {
		$this->queue = new \SplQueue();
		parent::__construct( $root );
	}

	protected function order( BinaryTree $root = NULL ) {
		if ( $root == NULL || $this->realRoot == $root ) return;

		$this->queue->enqueue( $root );

		while ( !$this->queue->isEmpty() ) {
			$current = $this->queue->dequeue();
			$this->finalData[] = $current->getData();

			if ( $current->getLeftChild() != NULL ) $this->queue->enqueue( $current->getLeftChild() );
			if ( $current->getRightChild() != NULL ) $this->queue->enqueue( $current->getRightChild() );
		}
	}
}