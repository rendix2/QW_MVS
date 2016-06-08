<?php

	namespace QW\FW\DataStructures\Trees\Binary\Iterators;

	use QW\FW\DataStructures\Trees\AbstractIterators\AbstractBinaryTreeIterator;
	use QW\FW\DataStructures\Trees\Binary\AbstractBinaryTree;

	class InOrderIterativeIterator extends AbstractBinaryTreeIterator {

		private $stack;

		public function __construct ( AbstractBinaryTree $root = NULL ) {
			$this->stack = new \SplStack();
			parent::__construct ( $root );
		}

		public function __destruct () {
			$this->stack = NULL;
			parent::__destruct ();
		}

		protected function order ( AbstractBinaryTree $root = NULL ) {
			while ( !$this->stack->isEmpty () || $root != NULL ) {
				if ( $root != NULL ) {
					$this->stack->push ( $root );
					$root = $root->getLeftChild ();
				} else {
					$root              = $this->stack->pop ();
					$this->finalData[] = $root->getData ();
					$root              = $root->getRightChild ();
				}
			}
		}
	}