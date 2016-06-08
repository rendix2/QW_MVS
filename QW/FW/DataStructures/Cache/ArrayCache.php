<?php

	namespace QW\FW\DataStructures\Cache;

	final class ArrayCache extends AbstractCache implements ICache {
		private $data;

		public function __construct () {
			parent::__construct ();
			$this->data = [ ];
		}

		public function __destruct () {
			$this->data = NULL;

			parent::__destruct ();
		}

		public function addCache ( $data ) {
			$this->data[] = $data;
		}

		public function removeCache () {
			$this->data = [ ];
		}

		public function useCache () {
			return $this->data;
		}
	}