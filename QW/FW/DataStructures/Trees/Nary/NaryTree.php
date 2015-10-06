<?php

namespace QW\FW\DataStructures\Trees\Nary;

use QW\FW\Boot\IllegalArgumentException;
use QW\FW\DataStructures\Trees\AbstractTree;
use QW\FW\DataStructures\Trees\Nary\Iterators\CountIterator;
use QW\FW\DataStructures\Trees\Nary\Iterators\EulerTourIterator;
use QW\FW\DataStructures\Trees\Nary\Iterators\InOrderIterator;
use QW\FW\DataStructures\Trees\Nary\Iterators\LevelOrderIterator;
use QW\FW\DataStructures\Trees\Nary\Iterators\PostOrderIterator;
use QW\FW\DataStructures\Trees\Nary\Iterators\PreOrderIterator;

final class NaryTree extends AbstractTree {

	private $children;

	public function __construct( array $children, $data ) {
		parent::__construct();

		$this->directChildrenCount = count( $this->children );

		// simulating array object type hinting :((
		if ( $this->directChildrenCount ) foreach ( $children as $v )
			if ( !( $v instanceof NaryTree ) ) throw new IllegalArgumentException();

		$this->children = $children;
		$this->data     = $data;
	}

	public function __destruct() {
		$this->children = NULL;

		parent::__destruct();
	}

	public function addChild( NaryTree $naryTree = NULL ) {
		$this->children[] = $naryTree;

		if ( $naryTree != NULL ) $this->childrenCount++;
	}

	public function getChild( $id ) {
		if ( $id < 0 || $id > $this->directChildrenCount ) throw new IllegalArgumentException();

		return $this->children[ $id ];
	}

	public function getChildren() {
		return $this->children;
	}

	public function setChildren( array $children ) {
		foreach ( $children as $v ) if ( !( $v instanceof NaryTree ) ) throw new IllegalArgumentException();

		$this->children            = $children;
		$this->directChildrenCount = count( $children );
	}

	public function getChildrenCount() {
		$its = new CountIterator( $this );
		$this->childrenCount = $its->getCountChildren();

		parent::getChildrenCount();
	}

	public function iteratorEulerTour() {
		return new EulerTourIterator( $this );
	}

	public function iteratorInOrderIterative() {
		return new InOrderIterator( $this );
	}

	public function iteratorLevelOrder() {
		return new LevelOrderIterator( $this );
	}

	public function iteratorPostOrderIterative() {
		return new PostOrderIterator( $this );
	}

	public function iteratorPreOrderIterative() {
		return new PreOrderIterator( $this );
	}
}