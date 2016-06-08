<?php
	/**
	 * Created by PhpStorm.
	 * User: Tomáš
	 * Date: 16. 11. 2015
	 * Time: 15:39
	 */

	namespace QW\FW\DataStructures\Queue;


	class SimpleQueue extends AbstractQueue {
		private $first;
		private $last;
		private $size;

		public function __construct ( $debug = FALSE ) {
			parent::__construct ();
			$this->size = 0;
		}

		public function addLast ( $i ) {
			$node = new Node( $i, NULL );
		}
	}