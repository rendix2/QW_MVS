<?php

namespace QW\FW\Lists;

use QW\FW\Basic\IllegalArgumentException;

class SimpleLinkedList extends AbstractList {

	private $last;

	public function __construct($data = NULL, $type = NULL) {
		parent::__construct($data);
		$this->last = new Node($data);
	}

	public function __toString() {
		$array = [ ];

		for ( $i = 0; $i < $this->size; $i++ )
			$array[] = $this->get($i);

		return '[ ' . implode(', ', $array) . ' ]';
	}

	public function add($data) {
		$current = $this->last;

		while ( $current->getNextNode() != NULL )
			$current = $current->getNextNode();

		$current->setNextNode(new Node($data));
		$this->size++;

		return TRUE;
	}

	public function contains($data) {
		$current = $this->last->getNextNode();

		for ( $i = 0; $i < $this->size; $i++ ) {
			if ( $current->getData() == $data )
				return TRUE;

			$current = $current->getNextNode();
		}

		return FALSE;
	}

	public function get($index) {
		if ( $index < 0 )
			throw new IllegalArgumentException();

		$current = $this->last->getNextNode();

		for ( $i = 0; $i < $index; $i++ ) {
			if ( $current->getNextNode() == NULL )
				return FALSE;

			$current = $current->getNextNode();
		}

		return $current->getData();
	}

	public function getFirst() {
		return $this->last->getData();
	}

	public function getLast() {
		return $this->helperGetLast($this->last);
	}

	private function helperGetLast(Node $node = NULL) {
		if ( $node == NULL )
			throw new \QW\FW\Boot\IllegalArgumentException();

		if ( $node->getNextNode() == NULL )
			return $node->getData();

		$this->helperGetLast($node->getNextNode());
	}

	public function remove($index) {
		if ( $index < 0 || $index > $this->size )
			throw new IllegalArgumentException();

		$current = $this->last;

		for ( $i = 0; $i < $index; $i++ ) {
			if ( $current->getNextNode() == NULL )
				return FALSE;

			$current = $current->getNextNode();
		}

		if ( $index < $this->size )
			$current->setNextNode($current->getNextNode()
			                              ->getNextNode());

		$this->size--;

		return TRUE;
	}
}