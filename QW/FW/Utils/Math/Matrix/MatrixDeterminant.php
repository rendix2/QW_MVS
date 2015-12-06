<?php

namespace QW\FW\Utils\Math\Matrix;

use QW\FW\Basic\Object;

class MathMatrixDeterminant extends Object {

	public function __construct( Matrix $matrix = NULL, $debug = FALSE ) {
		parent::__construct( $debug );
	}

	public function __destruct() {
		parent::__destruct();
	}

	public function determinant( array $matrix ) {
		$sum = 0;
		$s   = 0;
		if ( count( $matrix ) == 1 ) return ( $matrix[ 0 ][ 0 ] );
		else if ( count( $matrix ) == 2 ) {
			$tmp          = $this->matrix;
			$this->matrix = $matrix;
			$det          = $this->determinant2x2();
			$this->matrix = $tmp;

			return $det;
		}
		else if ( count( $matrix ) == 3 ) {
			$tmp          = $this->matrix;
			$this->matrix = $matrix;
			$det          = $this->determinant3x3();
			$this->matrix = $tmp;

			return $det;
		}

		for ( $i = 0; $i < count( $matrix ); $i++ ) {
			$smaller = [ ];
			for ( $a = 1; $a < count( $matrix ); $a++ ) for ( $b = 0; $b < count( $matrix ); $b++ )
				if ( $b < $i ) $smaller[ $a - 1 ][ $b ] = $matrix[ $a ][ $b ];
				else if ( $b > $i ) $smaller[ $a - 1 ][ $b - 1 ] = $matrix[ $a ][ $b ];


			$s = ( $i % 2 == 0 ) ? 1 : -1;
			$sum += $s * $matrix[ 0 ][ $i ] * ( $this->determinant( $smaller ) );
		}

		return ( $sum );
	}

	public function determinant2x2() {
		if ( $this->isSquare() && $this->matrixSize == 2 ) return $this->matrix[ 0 ][ 0 ] * $this->matrix[ 1 ][ 1 ] -
		$this->matrix[ 0 ][ 1 ] * $this->matrix[ 1 ][ 0 ];
		else return FALSE;
	}

	private function determinant3x3() {
		if ( $this->isSquare() && $this->getMatrixSize() == 3 ) return $this->matrix[ 0 ][ 0 ] *
		$this->matrix[ 1 ][ 1 ] * $this->matrix[ 2 ][ 2 ] +
		$this->matrix[ 0 ][ 1 ] * $this->matrix[ 1 ][ 2 ] * $this->matrix[ 2 ][ 0 ] +
		$this->matrix[ 0 ][ 2 ] * $this->matrix[ 1 ][ 0 ] * $this->matrix[ 2 ][ 1 ] -
		$this->matrix[ 0 ][ 1 ] * $this->matrix[ 1 ][ 0 ] * $this->matrix[ 2 ][ 2 ] -
		$this->matrix[ 0 ][ 0 ] * $this->matrix[ 1 ][ 2 ] * $this->matrix[ 2 ][ 1 ] -
		$this->matrix[ 0 ][ 2 ] * $this->matrix[ 1 ][ 1 ] * $this->matrix[ 2 ][ 0 ];
		else return FALSE;
	}

}