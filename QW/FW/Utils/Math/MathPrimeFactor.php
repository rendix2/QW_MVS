<?php
	/**
	 * Created by PhpStorm.
	 * User: Tomáš
	 * Date: 28. 5. 2016
	 * Time: 17:25
	 */

	namespace QW\FW\Utils\Math;


	class MathPrimeFactor {

		private $number;
		private $result;

		public function __construct ( $number ) {
			$this->number = $number;
			$this->result = [ ];
		}

		public function __destruct () {
			$this->number = NULL;
			$this->result = NULL;
		}

		public function getPrimeFactors () {
			$n = $this->number;
			for ( $i = 2; $i <= $n / $i; $i++ ) {
				while ( $n % $i == 0 ) {
					$this->result[] = $i;
					$n /= $i;
				}
			}

			if ( $n > 1 ) $this->result[] = $n;

			return $this->result;
		}
	}