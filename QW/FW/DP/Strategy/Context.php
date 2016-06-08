<?php

	namespace QW\FW\DP\Strategy;

	class Context {

		private $strategy;

		public function __construct ( Strategy $strategy ) {
			$this->strategy = $strategy;
		}

		public function multiply ( $a, $b ) {
			return $this->strategy->multiply ( $a, $b );
		}
	}