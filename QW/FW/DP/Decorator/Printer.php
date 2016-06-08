<?php

	namespace QW\FW\DP\Decorator;

	class Printer {

		public function nextLine () {
			echo "\n<br>";
		}

		public function printChar ( $char ) {
			echo $char;
		}
	}