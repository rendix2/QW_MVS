<?php
namespace QW\FW\Utils\Math\Matrix;

use QW\FW\Basic\Object;
use QW\FW\Boot\IllegalArgumentException;
use QW\FW\Boot\NullPointerException;
use QW\FW\Utils\Math\Math;

final class Matrix extends Object {
	private $matrix, $matrixSizeA, $matrixSizeB;

	public function __construct( array $matrix, $debug = FALSE ) {
		parent::__construct( $debug );

		$this->matrix      = $matrix;
		$this->matrixSizeA = count( $this->matrix );
		$this->matrixSizeB = count( $this->matrix[ 0 ] );
	}

	public function getMatrix() {
		return $this->matrix;
	}

	public function getMatrixSizeA() {
		return $this->matrixSizeA;
	}

	public function getMatrixSizeB() {
		return $this->matrixSizeB;
	}

	public function isSameSize( Matrix $matrix = NULL ) {
		if ( $matrix == NULL ) throw new NullPointerException();
		if ( $this->getMatrixSizeA() != $matrix->getMatrixSizeA() ) return FALSE;
		foreach ( $this->getMatrix() as $k => $v )
			if ( count( $matrix->getMatrix()[ $k ] ) != count( $this->getMatrix()[ $k ] ) ) return FALSE;

		return TRUE;
	}

	public function isSquare() {
		foreach ( $this->matrix as $v ) if ( count( $v ) != $this->getMatrixSizeA() ) return FALSE;

		return TRUE;
	}

	public function numberAdd( $number ) {
		if ( !is_numeric( $number ) ) throw new IllegalArgumentException();
		$newMatrix = [ ];

		for ( $i = 0; $i < $this->getMatrixSizeA(); $i++ ) for ( $j = 0; $j < $this->getMatrixSizeB(); $j++ )
			$newMatrix[ $i ][ $j ] = $this->getMatrix()[ $i ][ $j ] + $number;

		return new Matrix( $newMatrix );
	}

	public function numberDiv( $number ) {
		if ( $number == 0 || !is_numeric( $number ) ) throw new IllegalArgumentException();
		$newMatrix = [ ];

		for ( $i = 0; $i < $this->getMatrixSizeA(); $i++ ) for ( $j = 0; $j < $this->getMatrixSizeB(); $j++ )
			$newMatrix[ $i ][ $j ] = $this->getMatrix()[ $i ][ $j ] / $number;

		return new Matrix( $newMatrix );
	}

	public function numberMult( $number ) {
		if ( !is_numeric( $number ) ) throw new IllegalArgumentException();
		$newMatrix = [ ];

		for ( $i = 0; $i < $this->getMatrixSizeA(); $i++ ) for ( $j = 0; $j < $this->getMatrixSizeB(); $j++ )
			$newMatrix[ $i ][ $j ] = $this->getMatrix()[ $i ][ $j ] * $number;

		return new Matrix( $newMatrix );
	}

	public function numberPower( $number ) {
		if ( !is_numeric( $number ) ) throw new IllegalArgumentException();
		$newMatrix = [ ];

		for ( $i = 0; $i < $this->getMatrixSizeA(); $i++ ) for ( $j = 0; $j < $this->getMatrixSizeB(); $j++ )
			$newMatrix[ $i ][ $j ] = Math::power( $this->getMatrix()[ $i ][ $j ], $number );

		return new Matrix( $newMatrix );
	}

	public function numberSub( $number ) {
		if ( !is_numeric( $number ) ) throw new IllegalArgumentException();
		$newMatrix = [ ];

		for ( $i = 0; $i < $this->getMatrixSizeA(); $i++ ) for ( $j = 0; $j < $this->getMatrixSizeB(); $j++ )
			$newMatrix[ $i ][ $j ] = $this->getMatrix()[ $i ][ $j ] / $number;

		return new Matrix( $newMatrix );
	}

	public function printMatrix() {
		foreach ( $this->matrix as $v ) {
			foreach ( $v as $v2 ) echo $v2 . ' ';

			echo '<br>' . "\n";
		}
	}

	public function transpose() {
		$newMatrix = [ ];

		for ( $i = 0; $i < $this->getMatrixSizeA(); $i++ )
			for ( $j = 0; $j < $this->getMatrixSizeB(); $j++ ) $newMatrix[ $i ][ $j ] = $this->getMatrix()[ $j ][ $i ];

		return new Matrix( $newMatrix );
	}
}