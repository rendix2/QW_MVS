<?php

	namespace QW\FW\DP\Factory;

	class ShowOfUse {

		private $rectangleDefault, $rectangleA, $rectangleB, $rectangleFactored;

		public function __construct () {
			echo $this->rectangleDefault = new Rectangle( 5, 2 );
			echo $this->rectangleA = $this->rectangleDefault->setA ( 7 );
			echo $this->rectangleB = $this->rectangleDefault->setB ( 87 );
			echo $this->rectangleFactored = $this->rectangleDefault->growByFactor ( 8 );
			echo $this->rectangleB->growByFactor ( 5 );
		}
	}