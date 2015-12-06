<?php

namespace QW\FW\Utils\Math\Matrix\Mult;

use QW\FW\Boot\IllegalArgumentException;
use QW\FW\Utils\Math\Matrix\Matrix;

class MatrixMultStandard extends AbstractMatrixMult {
	public function __construct( Matrix $a = NULL, Matrix $b = NULL, $debug = FALSE ) {
		parent::__construct( $a, $b, $debug );
	}

	public function __destruct() {
		parent::__destruct();
	}

	public function mult( Matrix $a = NULL, Matrix $b = NULL ) {
		$newMatrix = [ ];

		if ( $a->getMatrixSizeA() != $b->getMatrixSizeB() ) throw new IllegalArgumentException();

		for ( $i = 0; $i < $a->getMatrixSizeA(); $i++ )
			for ( $j = 0; $j < $b->getMatrixSizeB(); $j++ ) for ( $k = 0; $k < $a->getMatrixSizeB(); $k++ )
				$newMatrix[ $i ][ $j ] += $a->getMatrix()[ $i ][ $k ] * $b->getMatrix()[ $k ][ $j ];

		return new Matrix( $newMatrix );
	}
}