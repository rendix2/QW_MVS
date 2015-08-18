<?php
namespace QW\FW\Math;

use QW\FW\Basic\Object;

final class MathMatrix extends Object {
	private $matrix, $matrixSize;

	public function __construct ( array $matrix ) {
		parent::__construct();

		$this->matrix     = $matrix;
		$this->matrixSize = count( $this->matrix );
	}

	public function add ( MathMatrix $matrix ) {

	}

	public function determinant ( array $matrix ) {
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

	public function determinant2x2 () {
		if ( $this->isSquare() && $this->matrixSize == 2 ) return $this->matrix[ 0 ][ 0 ] * $this->matrix[ 1 ][ 1 ] -
		$this->matrix[ 0 ][ 1 ] * $this->matrix[ 1 ][ 0 ];
		else return FALSE;
	}

	private function determinant3x3 () {
		if ( $this->isSquare() && $this->getMatrixSize() == 3 ) return $this->matrix[ 0 ][ 0 ] *
		$this->matrix[ 1 ][ 1 ] * $this->matrix[ 2 ][ 2 ] +
		$this->matrix[ 0 ][ 1 ] * $this->matrix[ 1 ][ 2 ] * $this->matrix[ 2 ][ 0 ] +
		$this->matrix[ 0 ][ 2 ] * $this->matrix[ 1 ][ 0 ] * $this->matrix[ 2 ][ 1 ] -
		$this->matrix[ 0 ][ 1 ] * $this->matrix[ 1 ][ 0 ] * $this->matrix[ 2 ][ 2 ] -
		$this->matrix[ 0 ][ 0 ] * $this->matrix[ 1 ][ 2 ] * $this->matrix[ 2 ][ 1 ] -
		$this->matrix[ 0 ][ 2 ] * $this->matrix[ 1 ][ 1 ] * $this->matrix[ 2 ][ 0 ];
		else return FALSE;
	}

	public function getMatrix () {
		return $this->matrix;
	}

	private function getMatrixSize () {
		return $this->matrixSize;
	}

	private function isSquare () {
		foreach ( $this->matrix as $v ) if ( count( $v ) != $this->matrixSize ) return FALSE;

		return TRUE;
	}

	public function multiply ( MathMatrix $matrix ) {

	}

	public function printMatrix () {
		foreach ( $this->matrix as $v ) {
			foreach ( $v as $v2 ) echo $v2 . ' ';

			echo '<br>' . "\n";
		}
	}
}