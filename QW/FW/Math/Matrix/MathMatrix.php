<?php
namespace QW\FW\Math\Matrix;

use QW\FW\Basic\Object;
use QW\FW\Boot\IllegalArgumentException;
use QW\FW\Math\Math;

final class MathMatrix extends Object {
	private $matrix, $matrixSizeA, $matrixSizeB;

	public function __construct( array $matrix, $debug = FALSE ) {
		parent::__construct( $debug );

		$this->matrix      = $matrix;
		$this->matrixSizeA = count( $this->matrix );
		$this->matrixSizeB = count( $this->matrix[ 0 ] );
	}

	final public function getMatrix() {
		return $this->matrix;
	}

	final public function getMatrixSizeA() {
		return $this->matrixSizeA;
	}

	final public function getMatrixSizeB() {
		return $this->matrixSizeB;
	}

	final public function isSquare() {
		foreach ( $this->matrix as $v ) if ( count( $v ) != $this->getMatrixSizeA() ) return FALSE;

		return TRUE;
	}

	public function numberAdd( $number ) {
		$newMatrix = [ ];

		for ( $i = 0; $i < $this->getMatrixSizeA(); $i++ ) for ( $j = 0; $j < $this->getMatrixSizeB(); $j++ )
			$newMatrix[ $i ][ $j ] = $this->getMatrix()[ $i ][ $j ] + $number;

		return new MathMatrix( $newMatrix );
	}

	public function numberDiv( $number ) {
		if ( $number == 0 ) throw new IllegalArgumentException();
		$newMatrix = [ ];

		for ( $i = 0; $i < $this->getMatrixSizeA(); $i++ ) for ( $j = 0; $j < $this->getMatrixSizeB(); $j++ )
			$newMatrix[ $i ][ $j ] = $this->getMatrix()[ $i ][ $j ] / $number;

		return new MathMatrix( $newMatrix );
	}

	public function numberMult( $number ) {
		$newMatrix = [ ];

		for ( $i = 0; $i < $this->getMatrixSizeA(); $i++ ) for ( $j = 0; $j < $this->getMatrixSizeB(); $j++ )
			$newMatrix[ $i ][ $j ] = $this->getMatrix()[ $i ][ $j ] * $number;

		return new MathMatrix( $newMatrix );
	}

	public function numberPower( $number ) {
		$newMatrix = [ ];

		for ( $i = 0; $i < $this->getMatrixSizeA(); $i++ ) for ( $j = 0; $j < $this->getMatrixSizeB(); $j++ )
			$newMatrix[ $i ][ $j ] = Math::power( $this->getMatrix()[ $i ][ $j ], $number );

		return new MathMatrix( $newMatrix );
	}

	public function numberSub( $number ) {
		$newMatrix = [ ];

		for ( $i = 0; $i < $this->getMatrixSizeA(); $i++ ) for ( $j = 0; $j < $this->getMatrixSizeB(); $j++ )
			$newMatrix[ $i ][ $j ] = $this->getMatrix()[ $i ][ $j ] / $number;

		return new MathMatrix( $newMatrix );
	}

	public function printMatrix() {
		foreach ( $this->matrix as $v ) {
			foreach ( $v as $v2 ) echo $v2 . ' ';

			echo '<br>' . "\n";
		}
	}
}