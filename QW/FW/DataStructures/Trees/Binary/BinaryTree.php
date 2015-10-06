<?php
namespace QW\FW\DataStructures\Trees\Binary;

use QW\FW\DataStructures\Trees\AbstractTree;
use QW\FW\DataStructures\Trees\Binary\Iterators\CountIterator;
use QW\FW\DataStructures\Trees\Binary\Iterators\EulerTourIterator;
use QW\FW\DataStructures\Trees\Binary\Iterators\InOrderIterativeIterator;
use QW\FW\DataStructures\Trees\Binary\Iterators\InOrderRecourseIterator;
use QW\FW\DataStructures\Trees\Binary\Iterators\LevelOrderIterator;
use QW\FW\DataStructures\Trees\Binary\Iterators\PostOrderIterativeIterator;
use QW\FW\DataStructures\Trees\Binary\Iterators\PostOrderRecourseIterator;
use QW\FW\DataStructures\Trees\Binary\Iterators\PreOrderIterativeIterator;
use QW\FW\DataStructures\Trees\Binary\Iterators\PreOrderRecourseIterator;

final class BinaryTree extends AbstractTree {
	private $left, $right;

	public function __construct( BinaryTree $left = NULL, BinaryTree $right = NULL, $data ) {
		parent::__construct();
		$this->left  = $left;
		$this->right = $right;
		$this->data  = $data;

		if ( $this->left != NULL ) $this->directChildrenCount++;
		if ( $this->right != NULL ) $this->directChildrenCount++;
	}

	public function __destruct() {
		$this->left  = NULL;
		$this->right = NULL;

		parent::__destruct();
	}

	public function getChildrenCount() {
		$itc = new CountIterator( $this );
		$this->directChildrenCount = $itc->getCountChildren();

		parent::getChildrenCount();
	}

	public function getLeftChild() {
		return $this->left;
	}

	public function getRightChild() {
		return $this->right;
	}

	public function iteratorEulerTour() {
		return new EulerTourIterator( $this );
	}

	public function iteratorInOrderIterative() {
		return new InOrderIterativeIterator( $this );
	}

	public function iteratorInOrderRecourse() {
		return new InOrderRecourseIterator( $this );
	}

	public function iteratorLevelOrder() {
		return new LevelOrderIterator( $this );
	}

	public function iteratorPostOrderIterative() {
		return new PostOrderIterativeIterator( $this );
	}

	public function iteratorPostOrderRecourse() {
		return new PostOrderRecourseIterator( $this );
	}

	public function iteratorPreOrderIterative() {
		return new PreOrderIterativeIterator( $this );
	}

	public function iteratorPreOrderRecourse() {
		return new PreOrderRecourseIterator( $this );
	}

	public function setLeftChild( BinaryTree $left = NULL ) {
		if ( $this->left == NULL && $left != NULL ) $this->directChildrenCount++;

		$this->left = $left;
	}

	public function setRightChild( BinaryTree $right = NULL ) {
		if ( $this->right == NULL && $right != NULL ) $this->directChildrenCount++;

		$this->right = $right;
	}
}