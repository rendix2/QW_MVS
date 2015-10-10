<?php

namespace QW\FW\DataStructures\Trees\Ternary;

use QW\FW\DataStructures\Trees\AbstractTree;

class TernaryTree extends AbstractTree {

	private $left, $middle, $right;
	private $data;

	public function __construct( TernaryTree $left = NULL, TernaryTree $middle = NULL, TernaryTree $right = NULL, $data, $debug = FALSE ) {
		parent::__construct( $debug );
		$this->left   = $left;
		$this->middle = $middle;
		$this->right  = $right;
		$this->data   = $data;
	}

	public function __destruct() {
		$this->left     = NULL;
		$this->middle   = NULL;
		$this->right = NULL;
			$this->data = NULL;
	}

	public function getLeftChild() {
		return $this->left;
	}

	public function getMiddleChild() {
		return $this->middle;
	}

	public function getRightChild() {
		return $this->right;
	}

	public function iteratorEulerTour() {
		// TODO: Implement iteratorEulerTour() method.
	}

	public function iteratorInOrderIterative() {
		// TODO: Implement iteratorInOrderIterative() method.
	}

	public function iteratorLevelOrder() {
		// TODO: Implement iteratorLevelOrder() method.
	}

	public function iteratorPostOrderIterative() {
		// TODO: Implement iteratorPostOrderIterative() method.
	}

	public function iteratorPreOrderIterative() {
		// TODO: Implement iteratorPreOrderIterative() method.
	}

	public function setLeftChild( TernaryTree $left ) {
		$this->left = $left;
	}

	public function setMiddleChild( TernaryTree $middle ) {
		$this->middle = $middle;
	}

	public function setRightChild( TernaryTree $right ) {
		$this->right = $right;
	}
}