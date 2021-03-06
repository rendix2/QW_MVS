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

		public function __construct ( AbstractBinaryTree $left = NULL, AbstractBinaryTree $right = NULL, $data ) {
			parent::__construct ( $data );

			$this->left  = $left;
			$this->right = $right;

			if ( $this->left != NULL ) $this->directChildrenCount++;
			if ( $this->right != NULL ) $this->directChildrenCount++;
		}

		public function __destruct () {
			$this->postOrderDestruct ( $this );

			parent::__destruct ();
		}

		public function getChildrenCount () {
			return $this->getCountRecourse ( $this );
		}

		public function iteratorEulerTour () {
			return new EulerTourIterator( $this );
		}

		public function iteratorInOrderIterative () {
			return new InOrderIterativeIterator( $this );
		}

		public function iteratorInOrderRecourse () {
			return new InOrderRecourseIterator( $this );
		}

		public function iteratorLevelOrder () {
			return new LevelOrderIterator( $this );
		}

		public function iteratorPostOrderIterative () {
			return new PostOrderIterativeIterator( $this );
		}

		public function iteratorPostOrderRecourse () {
			return new PostOrderRecourseIterator( $this );
		}

		public function iteratorPreOrderIterative () {
			return new PreOrderIterativeIterator( $this );
		}

		public function iteratorPreOrderRecourse () {
			return new PreOrderRecourseIterator( $this );
		}

		public function bal () {
			return $this->getCountRecourse ( $this->left ) - $this->getCountRecourse ( $this->right );
		}

		private function getCountRecourse ( AbstractBinaryTree $root = NULL ) {
			if ( $root == NULL ) return 0;

			return $this->getCountRecourse ( $root->left ) + $this->getCountRecourse ( $root->right ) + 1;
		}

		public function getDepth ( AbstractBinaryTree $root = NULL ) {
			if ( $root == NULL ) return -1;

			return Math::max ( $this->getDepth ( $root->left ), $this->getDepth ( $root->right ) ) + 1;
		}

		public function getLeftChild () {
			return $this->left;
		}

		public function getRightChild () {
			return $this->right;
		}

		private function postOrderDestruct ( AbstractBinaryTree $root = NULL ) {
			if ( $root == NULL ) return;

			$this->postOrderDestruct ( $root->left );
			$this->postOrderDestruct ( $root->right );

			$root = NULL;
		}

		public function setLeftChild ( AbstractBinaryTree $left = NULL ) {
			if ( $this->left == NULL && $left != NULL ) $this->directChildrenCount++;
			if ( $left == NULL ) $this->childrenCount = NULL;

			$this->left = $left;
		}

		public function setRightChild ( AbstractBinaryTree $right = NULL ) {
			if ( $this->right == NULL && $right != NULL ) $this->directChildrenCount++;
			if ( $right == NULL ) $this->childrenCount = NULL;

			$this->right = $right;
		}
	}