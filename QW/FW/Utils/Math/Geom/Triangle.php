<?php
	/**
	 * Created by PhpStorm.
	 * User: Tomáš
	 * Date: 4. 10. 2015
	 * Time: 17:53
	 */

	namespace QW\FW\Utils\Math\Geom;

	use QW\FW\Basic\Object;

	class Triangle extends Object {
		private $pointA, $pointB, $pointC;

		public function __construct ( Point $pointA, Point $pointB, Point $pointC ) {
			parent::__construct ();
			$this->pointA = $pointA;
			$this->pointB = $pointB;
			$this->pointC = $pointC;
		}

		public function __destruct () {
			$this->pointA = NULL;
			$this->pointB = NULL;
			$this->pointC = NULL;

			parent::__destruct ();
		}

		public function factorySetPointA ( Point $pointA ) {
			return new Triangle( $pointA, $this->pointB, $this->pointC );
		}

		public function factorySetPointB ( Point $pointB ) {
			return new Triangle( $this->pointA, $pointB, $this->pointC );
		}

		public function factorySetPointC ( Point $pointC ) {
			return new Triangle( $this->pointA, $this->pointB, $pointC );
		}

		/**
		 * @return Point
		 */
		public function getPointA () {
			return $this->pointA;
		}

		/**
		 * @return Point
		 */
		public function getPointB () {
			return $this->pointB;
		}

		/**
		 * @return Point
		 */
		public function getPointC () {
			return $this->pointC;
		}

		public function getPoints () {
			return [ $this->pointA, $this->pointB, $this->pointC ];
		}
	}
