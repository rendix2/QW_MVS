<?php

	namespace QW\FW\DataStructures\Trees\AbstractIterators;

	use QW\FW\DataStructures\Trees\Binary\AbstractBinaryTree;

	abstract class AbstractTernaryTreeIterator extends AbstractTreeIterator {

		abstract protected function order ( AbstractBinaryTree $root = NULL );

		public function __construct ( AbstractBinaryTree $root ) {
			parent::__construct ();

			$this->order ( $root );
		}

		public function __destruct () {
			parent::__destruct ();
		}
	}