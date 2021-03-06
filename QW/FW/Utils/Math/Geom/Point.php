<?php
	/**
	 * Created by PhpStorm.
	 * User: Tomáš
	 * Date: 22. 9. 2015
	 * Time: 22:37
	 */

	namespace QW\FW\Utils\Math\Geom;

	use QW\FW\Basic\Object;
	use QW\FW\Boot\IllegalArgumentException;
	use QW\FW\Validator;
	use QW\FW\WebDesign\Images\Images;

	class Point extends Object {

		private $x;
		private $y;

		public function __construct ( $x, $y ) {
			parent::__construct ();

			if ( !Validator::isNumber ( $x ) || !Validator::isNumber ( $y ) ) throw new IllegalArgumentException();
			$this->x = $x;
			$this->y = $y;
		}

		public function __destruct () {
			$this->x = NULL;
			$this->y = NULL;

			parent::__destruct ();
		}

		final public function getX () {
			return $this->x;
		}

		final public function getY () {
			return $this->y;
		}

		final public function isInImage ( Images $images ) {
			return $this->getX () < $images->getWidth () && $this->getY () < $images->getHeight ();
		}

	}