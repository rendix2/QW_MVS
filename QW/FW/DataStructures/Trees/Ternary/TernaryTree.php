<?php

namespace QW\FW\DataStructures\Trees\Ternary;

use QW\FW\Boot\UnsupportedOperationException;
use QW\FW\DataStructures\Trees\AbstractTree;
use QW\FW\DataStructures\Trees\Ternary\Iterators\EulerTourIterator;
use QW\FW\DataStructures\Trees\Ternary\Iterators\InOrderRecourseIterator;
use QW\FW\DataStructures\Trees\Ternary\Iterators\LevelOrderIterator;
use QW\FW\DataStructures\Trees\Ternary\Iterators\PostOrderRecourseIterator;
use QW\FW\DataStructures\Trees\Ternary\Iterators\PreOrderRecourseIterator;
use QW\FW\Utils\Math\Math;

class TernaryTree extends AbstractTree {

	private $left, $middle, $right;

	public function __construct( TernaryTree $left = NULL, TernaryTree $middle = NULL, TernaryTree $right = NULL, $data, $debug = FALSE ) {
		parent::__construct( $data, $debug );
		$this->left   = $left;
		$this->middle = $middle;
		$this->right  = $right;

		if ( $this->left != NULL ) $this->directChildrenCount++;
		if ( $this->middle != NULL ) $this->directChildrenCount++;
		if ( $this->right != NULL ) $this->directChildrenCount++;
	}

	public function __destruct() {
		$this->left   = NULL;
		$this->middle = NULL;
		$this->right  = NULL;

		parent::__destruct();
	}

	public function getChildrenCount() {
		return $this->getCountRecourse( $this );
	}

	private function getCountRecourse( TernaryTree $root = NULL ) {
		if ( $root == NULL ) return 0;

		return $this->getCountRecourse( $root->left ) + $this->getCountRecourse( $root->middle ) +
		$this->getCountRecourse( $root->right ) + 1;
	}

	public function getDepth( TernaryTree $root = NULL ) {
		if ( $root == NULL ) return -1;

		return 1 +
		Math::max( $this->getDepth( $root->left ), $this->getDepth( $root->middle ), $this->getDepth( $root->right ) );
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
		return new EulerTourIterator( $this, $this->debug );
	}

	public function iteratorInOrderIterative() {
		throw new UnsupportedOperationException();
	}

	public function iteratorInOrderRecourse() {
		return new InOrderRecourseIterator( $this, $this->debug );
	}

	public function iteratorLevelOrder() {
		return new LevelOrderIterator( $this, $this->debug );
	}

	public function iteratorPostOrderIterative() {
		throw new UnsupportedOperationException();
	}

	public function iteratorPostOrderRecourse() {
		return new PostOrderRecourseIterator( $this, $this->debug );
	}

	public function iteratorPreOrderIterative() {
		throw new UnsupportedOperationException();
	}

	public function iteratorPreOrderRecourse() {
		return new PreOrderRecourseIterator( $this, $this->debug );
	}

	public function setLeftChild( TernaryTree $left = NULL ) {
		if ( $left == NULL ) $this->childrenCount = NULL;
		$this->left = $left;
	}

	public function setMiddleChild( TernaryTree $middle = NULL ) {
		if ( $middle == NULL ) $this->childrenCount = NULL;
		$this->middle = $middle;
	}

	public function setRightChild( TernaryTree $right = NULL ) {
		if ( $right == NULL ) $this->childrenCount = NULL;
		$this->right = $right;
	}
}