<?php
	/**
	 * Created by PhpStorm.
	 * User: Tomáš
	 * Date: 4. 10. 2015
	 * Time: 17:53
	 */

	namespace QW\FW\Utils\Math\Geom;

	use QW\FW\Basic\Object;
	use QW\FW\Boot\IllegalArgumentException;
	use QW\FW\Validator;

	class Rectangle extends Object {

		private $pointLeftUp, $pointRightUp, $pointLeftDown, $pointRightDown;
		private                                              $lengthDown, $lengthRight;

		public function __construct ( Point $pointLeftUp, $lengthDown, $lengthRight ) {
			parent::__construct ();

			if ( !Validator::isNumber ( $lengthDown ) ||
			!Validator::isNumber ( $lengthRight )
			) throw new IllegalArgumentException();

			$this->pointLeftUp    = $pointLeftUp;
			$this->pointRightUp   = new Point( $this->pointLeftUp->getX () + $lengthRight, $this->pointLeftUp->getY () );
			$this->pointRightDown =
			new Point( $this->pointLeftUp->getX () + $lengthRight, $this->pointLeftUp->getY () - $lengthDown );
			$this->pointLeftDown  = new Point( $this->pointLeftUp->getX (), $this->pointLeftUp->getY () - $lengthDown );
			$this->lengthDown     = $lengthDown;
			$this->lengthRight    = $lengthRight;
		}

		public function __destruct () {
			$this->lengthDown     = NULL;
			$this->lengthRight    = NULL;
			$this->pointRightUp   = NULL;
			$this->pointRightDown = NULL;
			$this->pointLeftUp    = NULL;
			$this->pointLeftDown  = NULL;

			parent::__destruct ();
		}

		public function factorySetLengthDown ( $lengthDown ) {
			if ( !Validator::isNumber ( $lengthDown ) ) throw new IllegalArgumentException();

			return new Rectangle( $this->pointLeftUp, $lengthDown, $this->lengthRight );
		}

		public function factorySetLengthRight ( $lengthRight ) {
			if ( !Validator::isNumber ( $lengthRight ) ) throw new IllegalArgumentException();

			return new Rectangle( $this->pointLeftUp, $this->lengthDown, $lengthRight );
		}

		/**
		 * @return mixed
		 */
		public function getPointLeftDown () {
			return $this->pointLeftDown;
		}

		/**
		 * @return mixed
		 */
		public function getPointLeftUp () {
			return $this->pointLeftUp;
		}

		/**
		 * @return mixed
		 */
		public function getPointRightDown () {
			return $this->pointRightDown;
		}

		/**
		 * @return mixed
		 */
		public function getPointRightUp () {
			return $this->pointRightUp;
		}
	}