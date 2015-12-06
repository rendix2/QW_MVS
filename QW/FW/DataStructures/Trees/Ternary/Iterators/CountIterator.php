<?php
/**
 * Created by PhpStorm.
 * User: Tomáš
 * Date: 10. 10. 2015
 * Time: 14:53
 */

namespace QW\FW\DataStructures\Trees\Ternary\Iterators;

use QW\FW\DataStructures\Trees\AbstractIterators\AbstractTernaryTreeIterator;
use QW\FW\DataStructures\Trees\Ternary\TernaryTree;

class CountIterator extends AbstractTernaryTreeIterator {

	private $countChildren;

	public function __construct( TernaryTree $root, $debug = FALSE ) {
		$this->countChildren = 0;
		parent::__construct( $root, $debug );
	}

	public function __destruct() {
		$this->countChildren = NULL;
		parent::__destruct();
	}

	public function getCountChildren() {
		return $this->countChildren;
	}

	protected function order( TernaryTree $root = NULL ) {
		if ( $root == NULL ) return;

		$this->order( $root->getLeftChild() );
		$this->order( $root->getMiddleChild() );
		$this->order( $root->getRightChild() );
		$this->countChildren++;
	}
}
