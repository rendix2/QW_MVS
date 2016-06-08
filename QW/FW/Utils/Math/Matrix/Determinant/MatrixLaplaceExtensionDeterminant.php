<?php

	namespace QW\FW\Utils\Math\Matrix\Determinant;

	use QW\FW\Utils\Math\Matrix\Matrix;

// O(n!)
	class MathMatrixLaplaceExtensionDeterminant extends AbstractMatrixDeterminant {

		public function __construct ( Matrix $matrix = NULL ) {
			parent::__construct ( $matrix );
		}

		public function __destruct () {
			parent::__destruct ();
		}

		public function determinant ( Matrix $matrix ) {
			$sum = 0;
			if ( $matrix->getMatrixSizeA () == 1 ) return $this->determinant1x1 ();
			else if ( $matrix->getMatrixSizeA () == 2 ) {
				return $this->determinant2x2 ();
			} else if ( $matrix->getMatrixSizeA () == 3 ) return $this->determinant3x3 ();

			for ( $i = 0; $i < $matrix->getMatrixSizeA (); $i++ ) {
				$smaller = [ ];
				for ( $a = 1; $a < $matrix->getMatrixSizeA (); $a++ ) for ( $b = 0; $b < $matrix->getMatrixSizeA (); $b++ )
					if ( $b < $i ) $smaller[ $a - 1 ][ $b ] = $matrix[ $a ][ $b ];
					else if ( $b > $i ) $smaller[ $a - 1 ][ $b - 1 ] = $matrix->getMatrix ()[ $a ][ $b ];

				$sum += ( $i % 2 == 0 ) ? 1 :
				-1 * $matrix->getMatrix ()[ 0 ][ $i ] * ( $this->determinant ( new Matrix( $smaller ) ) );
			}

			return $sum;
		}
	}