<?php
	namespace QW\FW\DataStructures\Queue;

	use QW\FW\Basic\Object;

	class AbstractQueue extends Object {

		protected $size;

		public function __construct () {
			parent::__construct ();
			$this->size = 0;
		}
	}