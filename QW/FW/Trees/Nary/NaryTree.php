<?php

namespace QW\FW\Trees\Nary;

use QW\FW\Basic\IllegalArgumentException;
use QW\FW\Trees\AbstractTree;
use QW\FW\Trees\Nary\Iterators\CountIterator;
use QW\FW\Trees\Nary\Iterators\EulerTourIterator;
use QW\FW\Trees\Nary\Iterators\InOrderIterator;
use QW\FW\Trees\Nary\Iterators\LevelOrderIterator;
use QW\FW\Trees\Nary\Iterators\PostOrderIterator;
use QW\FW\Trees\Nary\Iterators\PreOrderIterator;

final class NaryTree extends AbstractTree
{

	private $children;

	public function __construct( array $children, $data )
	{
		parent::__construct();

		$this->directChildrenCount = count( $this->children );

		// simulating array object type hinting :((
		if ( $this->directChildrenCount ) foreach ( $children as $v ) if ( !( $v instanceof NaryTree ) ) throw new IllegalArgumentException();

		$this->children = $children;
		$this->data = $data;
	}

	public function setChildren( array $children )
	{
		foreach ( $children as $v ) if ( !( $v instanceof NaryTree ) ) throw new IllegalArgumentException();

		$this->children = $children;
		$this->directChildrenCount = count( $children );
	}

	public function addChild( NaryTree $naryTree = NULL )
	{
		$this->children[] = $naryTree;

		if ( $naryTree != NULL ) $this->childrenCount++;
	}

	public function getChildrenCount()
	{
		$its = new CountIterator( $this );
		$this->childrenCount = $its->getCountChildren();

		parent::getChildrenCount();
	}

	public function getChildren()
	{
		return $this->children;
	}

	public function getChild( $id )
	{
		if ( $id < 0 || $id > $this->directChildrenCount ) throw new IllegalArgumentException();

		return $this->children[ $id ];
	}

	public function iteratorPreOrderIterative()
	{
		return new PreOrderIterator( $this );
	}

	public function iteratorInOrderIterative()
	{
		return new InOrderIterator( $this );
	}

	public function iteratorPostOrderIterative()
	{
		return new PostOrderIterator( $this );
	}

	public function iteratorLevelOrder()
	{
		return new LevelOrderIterator( $this );
	}

	public function iteratorEulerTour()
	{
		return new EulerTourIterator( $this );
	}
}