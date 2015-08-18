<?php

namespace QW\FW\Trees\Binary\Iterators;

use QW\FW\Trees\AbstractIterators\AbstractBinaryTreeIterator;
use QW\FW\Trees\Binary\BinaryTree;

class PostOrderIterativeIterator extends AbstractBinaryTreeIterator {
	private $stack;

	public function __construct ( BinaryTree $root ) {
		$this->stack = new \SplStack();
		parent::__construct( $root );
	}

	protected function order ( BinaryTree $root = NULL ) {
		$lastVisited = NULL;

		while ( !$this->stack->isEmpty() || $root != NULL ) {

			if ( $root != NULL ) {
				$this->stack->push( $root );
				$root = $root->getLeftChild();
			}
			else {
				$peekNode = $this->stack->top();

				if ( $peekNode->getRight() != NULL && $lastVisited != $peekNode->getRight() ) $root =
					$peekNode->getRight();
				else {
					$this->finalData[] = $peekNode->getData();
					$lastVisited       = $this->stack->pop();
					$root              = NULL;
				}
			}
		}
	}
}