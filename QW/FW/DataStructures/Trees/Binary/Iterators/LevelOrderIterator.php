<?php
namespace QW\FW\DataStructures\Trees\Binary\Iterators;

use QW\FW\DataStructures\Trees\AbstractIterators\AbstractBinaryTreeIterator;
use QW\FW\DataStructures\Trees\Binary\AbstractBinaryTree;

class LevelOrderIterator extends AbstractBinaryTreeIterator {

	private $queue;

	public function __construct( AbstractBinaryTree $root = NULL, $debug = FALSE ) {
		$this->queue = new \SplQueue();
		parent::__construct( $root, $debug );
	}

	public function __destruct() {
		$this->queue = NULL;
		parent::__destruct();
	}

	protected function order( AbstractBinaryTree $root = NULL ) {
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