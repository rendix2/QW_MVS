<?php

namespace QW\FW\Lists;

use QW\FW\Basic\Object;

class Node extends Object {

	private $data;
	private $nextNode;

	public function __construct( $data, Node $nextNode = NULL ) {
		parent::__construct();

		$this->data     = $data;
		$this->nextNode = $nextNode;
	}


	public function __destruct() {
		$this->data     = NULL;
		$this->nextNode = NULL;

		parent::__destruct();
	}

	public function getData() {
		return $this->data;
	}

	public function setData( $data ) {
		$this->data = $data;
	}

	public function getNextNode() {
		return $this->nextNode;
	}

	public function setNextNode( $nextNode ) {
		$this->nextNode = $nextNode;
	}
}