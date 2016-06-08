<?php

	namespace QW\FW\Utils\Math\Matrix\Determinant;

	use QW\FW\Basic\Object;
	use QW\FW\Boot\IllegalArgumentException;
	use QW\FW\Utils\Math\Matrix\Matrix;

	abstract class AbstractMatrixDeterminant extends Object {

		protected $matrix;

		abstract public function determinant ( Matrix $matrix );

		public function __construct ( Matrix $matrix ) {
			parent::__construct ();

			if ( !$this->matrix->isSquare () ) throw  new IllegalArgumentException();

			$this->matrix = $matrix;
		}

		public function __destruct () {
			$this->matrix = NULL;

			parent::__destruct ();
		}

		final public function determinant1x1 () {
			return $this->matrix->getMatrixSizeA () == 1 ? $this->matrix->getMatrix ()[ 0 ][ 0 ] : FALSE;
		}

		final public function determinant2x2 () {
			return $this->matrix->getMatrixSizeA () == 2 ?
			$this->matrix[ 0 ][ 0 ] * $this->matrix[ 1 ][ 1 ] - $this->matrix[ 0 ][ 1 ] * $this->matrix[ 1 ][ 0 ] :
			FALSE;
		}

		final public function determinant3x3 () {
			return $this->matrix->getMatrixSizeA () == 3 ?
			$this->matrix[ 0 ][ 0 ] * $this->matrix[ 1 ][ 1 ] * $this->matrix[ 2 ][ 2 ] +
			$this->matrix[ 0 ][ 1 ] * $this->matrix[ 1 ][ 2 ] * $this->matrix[ 2 ][ 0 ] +
			$this->matrix[ 0 ][ 2 ] * $this->matrix[ 1 ][ 0 ] * $this->matrix[ 2 ][ 1 ] -
			$this->matrix[ 0 ][ 1 ] * $this->matrix[ 1 ][ 0 ] * $this->matrix[ 2 ][ 2 ] -
			$this->matrix[ 0 ][ 0 ] * $this->matrix[ 1 ][ 2 ] * $this->matrix[ 2 ][ 1 ] -
			$this->matrix[ 0 ][ 2 ] * $this->matrix[ 1 ][ 1 ] * $this->matrix[ 2 ][ 0 ] : FALSE;
		}

		public function getDeterminant () {
			switch ( $this->matrix->getMatrixSizeA () ) {
				case 1:
					return $this->determinant1x1 ();
				case 2:
					return $this->determinant2x2 ();
				case 3:
					return $this->determinant3x3 ();
				default :
					return $this->determinant ( $this->matrix );
			}
		}
	}