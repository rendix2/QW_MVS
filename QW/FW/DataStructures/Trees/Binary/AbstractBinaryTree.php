<?php
/**
 * Created by PhpStorm.
 * User: Tomáš
 * Date: 12. 1. 2016
 * Time: 0:03
 */

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
use QW\FW\Utils\Math\Math;

abstract class AbstractBinaryTree extends AbstractTree {

	protected $left, $right;

	public function __construct( AbstractBinaryTree $left = NULL, AbstractBinaryTree $right = NULL, $data, $debug = FALSE ) {
		parent::__construct( $data, $debug );

		$this->left  = $left;
		$this->right = $right;

		if ( $this->left != NULL ) $this->directChildrenCount++;
		if ( $this->right != NULL ) $this->directChildrenCount++;
	}

	public function __destruct() {
		$this->left  = NULL;
		$this->right = NULL;

		parent::__destruct();
	}

	public function getChildrenCount() {
		if ( $this->childrenCount == NULL ) {
			$itc = new CountIterator( $this, $this->debug );

			return $this->childrenCount = $itc->getCountChildren();
		}
		else return $this->childrenCount;
	}

	public function getHeight( AbstractBinaryTree $root = NULL ) {
		$height = 0;

		if ( $root == NULL ) $height = -1;
		else $height = 1 + Math::max( $this->getHeight( $root->left ), $this->getHeight( $root->right ) );

		return $height;
	}

	public function getLeftChild() {
		return $this->left;
	}

	public function getRightChild() {
		return $this->right;
	}

	public function iteratorEulerTour() {
		return new EulerTourIterator( $this, $this->debug );
	}

	public function iteratorInOrderIterative() {
		return new InOrderIterativeIterator( $this, $this->debug );
	}

	public function iteratorInOrderRecourse() {
		return new InOrderRecourseIterator( $this, $this->debug );
	}

	public function iteratorLevelOrder() {
		return new LevelOrderIterator( $this, $this->debug );
	}

	public function iteratorPostOrderIterative() {
		return new PostOrderIterativeIterator( $this, $this->debug );
	}

	public function iteratorPostOrderRecourse() {
		return new PostOrderRecourseIterator( $this, $this->debug );
	}

	public function iteratorPreOrderIterative() {
		return new PreOrderIterativeIterator( $this, $this->debug );
	}

	public function iteratorPreOrderRecourse() {
		return new PreOrderRecourseIterator( $this, $this->debug );
	}

	public function setLeftChild( AbstractBinaryTree $left = NULL ) {
		if ( $this->left == NULL && $left != NULL ) $this->directChildrenCount++;
		if ( $left == NULL ) $this->childrenCount = NULL;

		$this->left = $left;
	}

	public function setRightChild( AbstractBinaryTree $right = NULL ) {
		if ( $this->right == NULL && $right != NULL ) $this->directChildrenCount++;
		if ( $right == NULL ) $this->childrenCount = NULL;

		$this->right = $right;
	}
}