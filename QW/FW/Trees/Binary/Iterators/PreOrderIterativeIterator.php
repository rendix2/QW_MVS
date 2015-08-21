<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 6. 7. 2015
 * Time: 12:58
 */

namespace QW\FW\Trees\Binary\Iterators;


use QW\FW\Trees\AbstractIterators\AbstractBinaryTreeIterator;
use QW\FW\Trees\Binary\BinaryTree;

class PreOrderIterativeIterator extends AbstractBinaryTreeIterator {
	private $stack;

	public function __construct( BinaryTree $root ) {
		$this->stack = new \SplStack();
		parent::__construct( $root );
	}

	public function __destruct() {
		$this->stack = NULL;
		parent::__destruct();
	}


	protected function order( BinaryTree $root = NULL ) {

		while ( !$this->stack->isEmpty() || $root != NULL ) {
			if ( $root != NULL ) {
				$this->finalData[] = $root->getData();

				if ( $root->getRightChild() != NULL ) $this->stack->push( $root->getRightChild() );

				$root = $root->getLeftChild();
			}
			else $root = $this->stack->pop();
		}
	}
}