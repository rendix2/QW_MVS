<?php
namespace QW\FW\DataStructures\Trees\Binary;

final class BinaryTree extends AbstractBinaryTree {

	public function __construct( AbstractBinaryTree $left = NULL, AbstractBinaryTree $right = NULL, $data, $debug = FALSE ) {
		parent::__construct( $left, $right, $data, $debug );

		if ( $this->left != NULL ) $this->directChildrenCount++;
		if ( $this->right != NULL ) $this->directChildrenCount++;
	}

	public function __destruct() {
		parent::__destruct();
	}
}