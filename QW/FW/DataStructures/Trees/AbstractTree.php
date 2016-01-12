<?php

namespace QW\FW\DataStructures\Trees;

use QW\FW\Basic\Object;

abstract class AbstractTree extends Object {

	protected $data, $directChildrenCount, $childrenCount;

	abstract public function getChildrenCount();

	abstract public function iteratorEulerTour();

	abstract public function iteratorInOrderIterative();

	abstract public function iteratorInOrderRecourse();

	abstract public function iteratorLevelOrder();

	abstract public function iteratorPostOrderIterative();

	abstract public function iteratorPostOrderRecourse();

	abstract public function iteratorPreOrderIterative();

	abstract public function iteratorPreOrderRecourse();

	public function __construct( $data, $debug = FALSE ) {
		parent::__construct( $debug );

		$this->data = $data;
	}

	public function __destruct() {
		$this->data                = NULL;
		$this->childrenCount       = NULL;
		$this->directChildrenCount = NULL;//

		parent::__destruct();
	}

	public function getData() {
		return $this->data;
	}

	public function getDirectChildrenCount() {
		return $this->directChildrenCount;
	}
}