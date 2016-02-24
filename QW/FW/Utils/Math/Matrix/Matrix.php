<?php
namespace QW\FW\Utils\Math\Matrix;

use QW\FW\Basic\Object;
use QW\FW\Boot\IllegalArgumentException;
use QW\FW\Boot\NullPointerException;
use QW\FW\Utils\Math\Math;
use QW\FW\Utils\Math\Matrix\Determinant\MathMatrixLaplaceExtensionDeterminant;
use QW\FW\Utils\Math\Matrix\Mult\MatrixMultiStrassen;
use QW\FW\Utils\Math\Matrix\Mult\MatrixMultRecourse;
use QW\FW\Utils\Math\Matrix\Mult\MatrixMultStandard;
use QW\FW\Validator;

final class Matrix extends Object {
	private $matrix, $matrixSizeA, $matrixSizeB;

	public function __construct( array $matrix, $debug = FALSE ) {
		parent::__construct( $debug );

		$this->matrix      = $matrix;
		$this->matrixSizeA = count( $this->matrix );
		$this->matrixSizeB = count( $this->matrix[ 0 ] );
	}

	public function __destruct() {
		$this->matrix      = NULL;
		$this->matrixSizeA = NULL;
		$this->matrixSizeB = NULL;

		parent::__destruct();
	}

	public function determinantLaplaceExtension() {
		$det = new MathMatrixLaplaceExtensionDeterminant( $this, $this->debug );

		return $det->getDeterminant();
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

	public function matrixMultiplyNormal( Matrix $matrixB ) {
		return new MatrixMultStandard( $this, $matrixB, $this->debug );
	}

	public function matrixMultiplyRecourse( Matrix $matrixB ) {
		return new MatrixMultRecourse( $this, $matrixB, $this->debug );
	}

	public function matrixMultiplyStrassen( Matrix $matrixB ) {
		return new MatrixMultiStrassen( $this, $matrixB, $this->debug );
	}

	public function numberAdd( $number ) {
		if ( !Validator::isNumber( $number ) ) throw new IllegalArgumentException();
		$newMatrix = [ ];

		for ( $i = 0; $i < $this->getMatrixSizeA(); $i++ ) for ( $j = 0; $j < $this->getMatrixSizeB(); $j++ )
			$newMatrix[ $i ][ $j ] = $this->getMatrix()[ $i ][ $j ] + $number;

		return new Matrix( $newMatrix );
	}

	public function numberDiv( $number ) {
		if ( $number == 0 || !Validator::isNumber( $number ) ) throw new IllegalArgumentException();
		$newMatrix = [ ];

		for ( $i = 0; $i < $this->getMatrixSizeA(); $i++ ) for ( $j = 0; $j < $this->getMatrixSizeB(); $j++ )
			$newMatrix[ $i ][ $j ] = $this->getMatrix()[ $i ][ $j ] / $number;

		return new Matrix( $newMatrix );
	}

	public function numberMult( $number ) {
		if ( !Validator::isNumber( $number ) ) throw new IllegalArgumentException();
		$newMatrix = [ ];

		for ( $i = 0; $i < $this->getMatrixSizeA(); $i++ ) for ( $j = 0; $j < $this->getMatrixSizeB(); $j++ )
			$newMatrix[ $i ][ $j ] = $this->getMatrix()[ $i ][ $j ] * $number;

		return new Matrix( $newMatrix );
	}

	public function numberPower( $number ) {
		if ( !Validator::isNumber( $number ) ) throw new IllegalArgumentException();
		$newMatrix = [ ];

		for ( $i = 0; $i < $this->getMatrixSizeA(); $i++ ) for ( $j = 0; $j < $this->getMatrixSizeB(); $j++ )
			$newMatrix[ $i ][ $j ] = Math::power( $this->getMatrix()[ $i ][ $j ], $number );

		return new Matrix( $newMatrix );
	}

	public function numberSub( $number ) {
		if ( !Validator::isNumber( $number ) ) throw new IllegalArgumentException();
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