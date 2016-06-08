<?php

	namespace QW\FW\DataStructures\Trees\Nary;

	use QW\FW\Boot\IllegalArgumentException;
	use QW\FW\Boot\UnsupportedOperationException;
	use QW\FW\DataStructures\Trees\AbstractTree;
	use QW\FW\DataStructures\Trees\Nary\Iterators\CountIterator;
	use QW\FW\DataStructures\Trees\Nary\Iterators\LevelOrderIterator;
	use QW\FW\DataStructures\Trees\Nary\Iterators\PostOrderIterator;
	use QW\FW\DataStructures\Trees\Nary\Iterators\PreOrderIterator;

	final class NaryTree extends AbstractTree {

		private $children;

		public function __construct ( array $children, $data ) {
			parent::__construct ( $data );

			// simulating array object type hinting :((
			if ( count ( $children ) ) foreach ( $children as $v )
				if ( $v instanceof NaryTree ) $this->directChildrenCount++;
				else  throw new IllegalArgumentException();
			else $this->directChildrenCount = 0;

			$this->children = $children;
		}

		public function __destruct () {


			$this->postOrderDestruct ( $this );

			echo 'Mažu N-arní strom';

			parent::__destruct ();
		}

		public function getChildrenCount () {
			if ( $this->childrenCount == NULL ) {
				$its = new CountIterator( $this );

				return $this->childrenCount = $its->getCountChildren ();
			} else return $this->childrenCount;
		}

		public function iteratorEulerTour () {
			throw new UnsupportedOperationException();
		}

		public function iteratorInOrderIterative () {
			throw new UnsupportedOperationException();
		}

		public function iteratorInOrderRecourse () {
			throw new UnsupportedOperationException();
		}

		public function iteratorLevelOrder () {
			return new LevelOrderIterator( $this);
		}

		public function iteratorPostOrderIterative () {
			return new PostOrderIterator( $this);
		}

		public function iteratorPostOrderRecourse () {
			throw new UnsupportedOperationException();
		}

		public function iteratorPreOrderIterative () {
			return new PreOrderIterator( $this);
		}

		public function iteratorPreOrderRecourse () {
			throw new UnsupportedOperationException();
		}

		public function addChild ( NaryTree $naryTree = NULL ) {
			$this->children[] = $naryTree;

			if ( $naryTree != NULL ) $this->childrenCount++;
			else $this->childrenCount = NULL;
		}

		public function getChild ( $id ) {
			if ( $id < 0 || $id > $this->directChildrenCount ) throw new IllegalArgumentException();

			return $this->children[ $id ];
		}

		public function getChildren () {
			return $this->children;
		}

		public function setChildren ( array $children ) {
			if ( count ( $children ) >= 1 ) foreach ( $children as $v )
				if ( !( $v instanceof NaryTree ) ) throw new IllegalArgumentException();
				else $this->childrenCount = NULL;

			$this->children            = $children;
			$this->directChildrenCount = count ( $children );
		}

		private function postOrderDestruct ( NaryTree $root = NULL ) {
			if ( $root == NULL ) return;

			foreach ( $root->getChildren () as $child ) $this->postOrderDestruct ( $child );

			$root = NULL;
		}
	}