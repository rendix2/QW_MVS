<?php
namespace QW\FW\DataStructures\Trees\Binary;

final class BinaryTree extends AbstractBinaryTree {

	public function __construct( AbstractBinaryTree $left = NULL, AbstractBinaryTree $right = NULL, $data, $debug = FALSE ) {
		parent::__construct( $left, $right, $data, $debug );
	}

	public function __destruct() {
		parent::__destruct();
	}
}