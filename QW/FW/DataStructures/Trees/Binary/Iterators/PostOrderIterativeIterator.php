<?php

namespace QW\FW\DataStructures\Trees\Binary\Iterators;

use QW\FW\DataStructures\Trees\AbstractIterators\AbstractBinaryTreeIterator;
use QW\FW\DataStructures\Trees\Binary\BinaryTree;

class PostOrderIterativeIterator extends AbstractBinaryTreeIterator {
	private $stack;

	public function __construct( BinaryTree $root, $debug = FALSE ) {
		$this->stack = new \SplStack();
		parent::__construct( $root, $debug );
	}

	public function __destruct() {
		$this->stack = NULL;
		parent::__destruct();
	}

	protected function order( BinaryTree $root = NULL ) {
		$lastVisited = NULL;

		while ( !$this->stack->isEmpty() || $root != NULL ) {

			if ( $root != NULL ) {
				$this->stack->push( $root );
				$root = $root->getLeftChild();
			}
			else {
				$peekNode = $this->stack->top();

				if ( $peekNode->getRightChild() != NULL && $lastVisited != $peekNode->getRightChild() ) $root =
					$peekNode->getRightChild();
				else {
					$this->finalData[] = $peekNode->getData();
					$lastVisited       = $this->stack->pop();
					$root              = NULL;
				}
			}
		}
	}
}