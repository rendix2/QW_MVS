<?php


	namespace QW\FW\DataStructures\Queue;

	use QW\FW\Basic\Object;

	class Node extends Object {

		private $value;
		private $next;

		public function __construct ( $value, Node $nextNode = NULL ) {
			parent::__construct ();
			$this->next  = $nextNode;
			$this->value = $value;
		}

		function __destruct () {
			$this->value = NULL;
			$this->next  = NULL;

			parent::__destruct ();
		}

		public function getNext () {
			return $this->next;
		}

		public function getValue () {
			return $this->value;
		}
	}