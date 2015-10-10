<?php
/**
 * Created by PhpStorm.
 * User: Tomáš
 * Date: 10. 10. 2015
 * Time: 18:20
 */

namespace QW\FW\DataStructures\Trees\Ternary\Iterators;


use QW\FW\DataStructures\Trees\AbstractIterators\AbstractTernaryTreeIterator;
use QW\FW\DataStructures\Trees\Ternary\TernaryTree;

class LevelOrderIterator extends AbstractTernaryTreeIterator {

	private $queue;

	public function __construct( TernaryTree $root = NULL, $debug = FALSE ) {
		$this->queue = new \SplQueue();
		parent::__construct( $root, $debug );
	}

	protected function order( TernaryTree $root = NULL ) {
		if ( $root == NULL || $this->realRoot == $root ) return;

		$this->queue->enqueue( $root );

		while ( !$this->queue->isEmpty() ) {
			$current           = $this->queue->dequeue();
			$this->finalData[] = $current->getData();

			if ( $current->getLeftChild() != NULL ) $this->queue->enqueue( $current->getLeftChild() );
			if ( $current->getMiddleChild() != NULL ) $this->queue->enqueue( $current->getMiddleChild() );
			if ( $current->getRightChild() != NULL ) $this->queue->enqueue( $current->getRightChild() );
		}
	}
}