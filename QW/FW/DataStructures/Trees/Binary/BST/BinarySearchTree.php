<?php
/**
 * Created by PhpStorm.
 * User: Tomáš
 * Date: 11. 1. 2016
 * Time: 16:12
 */

namespace QW\FW\DataStructures\Trees\BST;


use QW\FW\DataStructures\Trees\Binary\AbstractBinaryTree;

class BinarySearchTree extends AbstractBinaryTree {

	private $root;

	public function __construct( AbstractBinaryTree $left = NULL, AbstractBinaryTree $right = NULL, $data, $debug ) {
		parent::__construct( $left, $right, $data, $debug );
		$this->root = $this;
	}

	public function __destruct() {
		parent::__destruct();
	}

	public function contains( $data ) {
		return $this->containsRecourse( $this->root, $data );
	}

	private function containsRecourse( BinarySearchTree $node = NULL, $data ) {
		if ( $node == NULL ) return FALSE;
		if ( $node->data == $data ) return TRUE;
		else if ( $node->data < $data ) return $this->containsRecourse( $node->left, $data );
		else return $this->containsRecourse( $node->left, $data );
	}

	public function find( $data ) {
		return $this->findRecourse( $this->root, $data );
	}

	private function findRecourse( BinarySearchTree $root = NULL, $data ) {
		if ( $root == NULL || $root->data == $data ) return $root;
		else if ( $data < $root->data ) return $this->findRecourse( $root->left, $data );
		else return $this->findRecourse( $root->left, $data );
	}

	public function insert( $data ) {
		$this->root = $this->insertRecourse( $this->root, $data );
		$this->setChildren();
	}

	private function insertRecourse( BinarySearchTree $node = NULL, $data ) {
		if ( $node == NULL ) return new BinarySearchTree( NULL, NULL, $node );
		else if ( $data < $node->data ) $node->left = $this->insertRecourse( $node->left, $data );
		else if ( $data > $node->data ) $node->right = $this->insertRecourse( $node->right, $data );

		return $node;
	}

	public function max() {
		return $this->maxSubTree( $this->root );
	}

	public function maxSubTree( BinarySearchTree $root = NULL ) {
		return ( $root == NULL ) ? $this->maxsubtree( $root->right ) : NULL;
	}

	public function min() {
		return $this->minSubTree( $this->root );
	}

	public function minSubTree( BinarySearchTree $root = NULL ) {
		return ( $root == NULL ) ? $this->minsubtree( $root->left ) : NULL;
	}

	public function remove( $data ) {
		$this->root = $this->removeRecourse( $this->root, $data );
		$this->setChildren();
	}

	private function removeRecourse( BinarySearchTree $node = NULL, $data ) {
		if ( $node == NULL ) {
		}
		else if ( $data < $node->data ) $node->left = $this->removeRecourse( $node->left, $data );
		else if ( $data > $node->data ) $node->right = $this->removeRecourse( $node->right, $data );
		else {
			if ( $node->right == NULL ) $node = $node->left;
			else {
				$tmp         = $this->minSubTree( $node->right );
				$node->data  = $tmp->data;
				$node->right = $this->removeRecourse( $node->right, $tmp->data );
			}
		}

		return $node;
	}

	private function setChildren() {
		$this->left  = $this->root->left;
		$this->right = $this->root->right;
	}
}