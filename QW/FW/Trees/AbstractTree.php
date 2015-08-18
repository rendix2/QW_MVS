<?php

namespace QW\FW\Trees;

use QW\FW\Basic\Object;

abstract class AbstractTree extends Object {

	protected $data, $directChildrenCount, $childrenCount;

	abstract public function iteratorEulerTour ();

	abstract public function iteratorInOrderIterative ();

	abstract public function iteratorLevelOrder ();

	abstract public function iteratorPostOrderIterative ();

	abstract public function iteratorPreOrderIterative ();

	public function __construct () {
		parent::__construct();
	}

	public function __destruct () {
		$this->data                = NULL;
		$this->directChildrenCount = NULL;
		$this->directChildrenCount = NULL;

		parent::__destruct();
	}

	public function getChildrenCount () {
		return $this->directChildrenCount;
	}

	public function getData () {
		return $this->data;
	}

	public function getDirectChildrenCount () {
		return $this->directChildrenCount;
	}
}