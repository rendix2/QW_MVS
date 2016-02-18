<?php

namespace QW\FW\DataStructures\Trees\Ternary;

use QW\FW\Boot\UnsupportedOperationException;
use QW\FW\DataStructures\Trees\Binary\AbstractBinaryTree;
use QW\FW\DataStructures\Trees\Ternary\Iterators\EulerTourIterator;
use QW\FW\DataStructures\Trees\Ternary\Iterators\InOrderRecourseIterator;
use QW\FW\DataStructures\Trees\Ternary\Iterators\LevelOrderIterator;
use QW\FW\DataStructures\Trees\Ternary\Iterators\PostOrderRecourseIterator;
use QW\FW\DataStructures\Trees\Ternary\Iterators\PreOrderRecourseIterator;
use QW\FW\Utils\Math\Math;

class TernaryTree extends AbstractBinaryTree {

	private $middle;

	public function __construct( AbstractBinaryTree $left = NULL, AbstractBinaryTree $middle = NULL, AbstractBinaryTree $right = NULL, $data, $debug = FALSE ) {
		parent::__construct( $left, $right, $data, $debug );

		$this->middle = $middle;

		if ( $this->middle != NULL ) $this->directChildrenCount++;
	}

	public function __destruct() {
		//$this->middle = NULL;

		$this->postOrderDestruct( $this );

		parent::__destruct();

		echo 'Mažu ternární strom';
	}

	public function getChildrenCount() {
		return $this->getCountRecourse( $this );
	}

	private function getCountRecourse( AbstractBinaryTree $root = NULL ) {
		if ( $root == NULL ) return 0;

		if ( $root instanceof TernaryTree ) return $this->getCountRecourse( $root->left ) +
		$this->getCountRecourse( $root->middle ) + $this->getCountRecourse( $root->right ) + 1;
		else
			return $this->getCountRecourse( $root->left ) + $this->getCountRecourse( $root->right ) + 1;
	}

	final public function getDepth( AbstractBinaryTree $root = NULL ) {
		if ( $root == NULL ) return -1;

		if ( $root instanceof TernaryTree ) return 1 +
		Math::max( $this->getDepth( $root->left ), $this->getDepth( $root->middle ), $this->getDepth( $root->right ) );
		else
			return 1 + Math::max( $this->getDepth( $root->left ), $this->getDepth( $root->right ) );
	}

	public function getMiddleChild() {
		return $this->middle;
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

	private function postOrderDestruct( AbstractBinaryTree $root = NULL ) {
		if ( $root == NULL ) return;

		$this->postOrderDestruct( $root->left );
		if ( $root instanceof TernaryTree ) $this->postOrderDestruct( $root->middle );
		$this->postOrderDestruct( $root->right );

		$root = NULL;
	}

	public function setMiddleChild( AbstractBinaryTree $middle = NULL ) {
		if ( $middle == NULL ) $this->childrenCount = NULL;
		$this->middle = $middle;
	}
}