<?php
namespace QW\FW\Math\Matrix;

use QW\FW\Basic\Object;

final class MathMatrix extends Object {
	private $matrix, $matrixSize;

	public function __construct( array $matrix, $debug = FALSE ) {
		parent::__construct( $debug );

		$this->matrix     = $matrix;
		$this->matrixSize = count( $this->matrix );
	}

	public function getMatrix() {
		return $this->matrix;
	}

	private function getMatrixSize() {
		return $this->matrixSize;
	}

	private function isSquare() {
		foreach ( $this->matrix as $v ) if ( count( $v ) != $this->matrixSize ) return FALSE;

		return TRUE;
	}

	public function printMatrix() {
		foreach ( $this->matrix as $v ) {
			foreach ( $v as $v2 ) echo $v2 . ' ';

			echo '<br>' . "\n";
		}
	}
}