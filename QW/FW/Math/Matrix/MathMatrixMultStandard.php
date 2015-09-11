<?php

namespace QW\FW\Math\Matrix;

use QW\FW\Boot\IllegalArgumentException;

class MathMatrixMultStandard extends AbstractMathMatrixMult {
	public function __construct( MathMatrix $a = NULL, MathMatrix $b = NULL, $debug = FALSE ) {
		parent::__construct( $a, $b, $debug );
	}

	public function mult( MathMatrix $a = NULL, MathMatrix $b = NULL ) {
		$matrixASize  = count( $a->getMatrix() );
		$matrixASize2 = count( $a->getMatrix()[ 0 ] );
		$matrixBSize  = count( $b->getMatrix() );
		$matrixBSize2 = count( $b->getMatrix()[ 0 ] );
		$newMatrix    = [ ];

		if ( $matrixASize != $matrixBSize ) throw new IllegalArgumentException();

		for ( $i = 0; $i < $matrixASize; $i++ ) for ( $j = 0; $j < $matrixBSize2; $j++ )
			for ( $k = 0; $k < $matrixASize2; $k++ )
				$newMatrix[ $i ][ $j ] += $a->getMatrix()[ $i ][ $k ] * $b->getMatrix()[ $k ][ $j ];

		return new MathMatrix( $newMatrix );
	}
}