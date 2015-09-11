<?php

namespace QW\FW\Math\Matrix\Mult;

use QW\FW\Boot\IllegalArgumentException;
use QW\FW\Math\Matrix\MathMatrix;

class MathMatrixMultStandard extends AbstractMathMatrixMult {
	public function __construct( MathMatrix $a = NULL, MathMatrix $b = NULL, $debug = FALSE ) {
		parent::__construct( $a, $b, $debug );
	}

	public function mult( MathMatrix $a = NULL, MathMatrix $b = NULL ) {
		$newMatrix = [ ];

		if ( $a->getMatrixSizeA() != $b->getMatrixSizeB() ) throw new IllegalArgumentException();

		for ( $i = 0; $i < $a->getMatrixSizeA(); $i++ )
			for ( $j = 0; $j < $b->getMatrixSizeB(); $j++ ) for ( $k = 0; $k < $a->getMatrixSizeB(); $k++ )
				$newMatrix[ $i ][ $j ] += $a->getMatrix()[ $i ][ $k ] * $b->getMatrix()[ $k ][ $j ];

		return new MathMatrix( $newMatrix );
	}
}