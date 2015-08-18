<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 6. 7. 2015
 * Time: 12:48
 */

namespace QW\FW\Trees\Binary\Iterators;


use QW\FW\Trees\AbstractIterators\AbstractBinaryTreeIterator;
use QW\FW\Trees\Binary\BinaryTree;

class InOrderIterativeIterator extends AbstractBinaryTreeIterator {

	private $stack;

	public function __construct(BinaryTree $root) {
		$this->stack = new \SplStack();
		parent::__construct($root);
	}

	protected function order(BinaryTree $root = NULL) {
		while ( !$this->stack->isEmpty() || $root != NULL ) {
			if ( $root != NULL ) {
				$this->stack->push($root);
				$root = $root->getLeftChild();
			}
			else {
				$root              = $this->stack->pop();
				$this->finalData[] = $root->getData();
				$root              = $root->getRight();
			}
		}
	}
}