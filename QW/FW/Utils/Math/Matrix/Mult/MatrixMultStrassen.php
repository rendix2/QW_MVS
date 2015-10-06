<?php

namespace QW\FW\Utils\Math\Matrix\Mult;


use QW\FW\Boot\NullPointerException;
use QW\FW\Utils\Math\Matrix\Matrix;

class MatrixMultiStrassen extends AbstractMatrixMult {

	public function __construct( Matrix $a = NULL, Matrix $b = NULL, $debug = FALSE ) {
		parent::__construct( $debug );
	}

	public function add( Matrix $a = NULL, Matrix $b = NULL ) {
		if ( $a == NULL || $b == NULL ) throw new NullPointerException();

		$matrix = [ ];

		for ( $i = 0; $i < $a->getMatrixSizeA(); $i++ ) for ( $j = 0; $j < $a->getMatrixSizeA(); $j++ )
			$matrix[ $i ][ $j ] = $a->getMatrix()[ $i ][ $j ] + $b->getMatrix()[ $i ][ $j ];

		return new Matrix( $matrix );
	}

	public function join( Matrix $p = NULL, Matrix $c = NULL, $ib, $jb ) {
		if ( $c == NULL || $p == NULL ) throw new NullPointerException();

		$p = $p->getMatrix();

		for ( $i1 = 0, $i2 = $ib; $i1 < $c->getMatrixSizeA(); $i1++, $i2++ )
			for ( $j1 = 0, $j2 = $jb; $j1 < $c->getMatrixSizeA(); $j1++, $j2++ )
				$p[ $i1 ][ $j1 ] = $c->getMatrix()[ $i2 ][ $j2 ];

		return new Matrix( $p );
	}

	public function mult( Matrix $A = NULL, Matrix $B = NULL ) {
		$A11 = [ ];
		$A12 = [ ];
		$A21 = [ ];
		$A22 = [ ];
		$B11 = [ ];
		$B12 = [ ];
		$B21 = [ ];
		$B22 = [ ];
		$R   = [ ];
		$n   = count( $A->getMatrix() );

		$this->split( $A, new Matrix( $A11 ), 0, 0 );
		$this->split( $A, new Matrix( $A12 ), 0, $n / 2 );
		$this->split( $A, new Matrix( $A21 ), $n / 2, 0 );
		$this->split( $A, new Matrix( $A22 ), $n / 2, $n / 2 );
		$this->split( $B, new Matrix( $B11 ), 0, 0 );
		$this->split( $B, new Matrix( $B12 ), 0, $n / 2 );
		$this->split( $B, new Matrix( $B21 ), $n / 2, 0 );
		$this->split( $B, new Matrix( $B22 ), $n / 2, $n / 2 );

		$M1 = $this->mult( $this->add( new Matrix( $A11, new Matrix( $A22 ) ) ),
			$this->add( new Matrix( $B11 ), new Matrix( $B22 ) ) );
		$M2 = $this->mult( $this->add( new Matrix( $A21, new Matrix( $A22 ) ) ), new Matrix( $B22 ) );
		$M3 = $this->mult( new Matrix( $A11 ), $this->sub( new Matrix( $B12 ), new Matrix( $B22 ) ) );
		$M4 = $this->mult( new Matrix( $A22 ), $this->sub( new Matrix( $B21 ), new Matrix( $B11 ) ) );
		$M5 = $this->mult( $this->add( new Matrix( $A11 ), new Matrix( $A12 ) ), new Matrix( $B22 ) );
		$M6 = $this->mult( $this->sub( new Matrix( $A21 ), new Matrix( $A11 ) ),
			$this->add( new Matrix( $B11 ), new Matrix( $B12 ) ) );
		$M7 = $this->mult( $this->sub( new Matrix( $A12 ), new Matrix( $A22 ) ),
			$this->add( new Matrix( $B21 ), new Matrix( $B22 ) ) );

		$C11 = $this->add( $this->sub( $this->add( $M1, $M4 ), $M5 ), $M7 );
		$C12 = $this->add( $M1, $M5 );
		$C21 = $this->add( $M2, $M4 );
		$C22 = $this->add( $this->sub( $this->add( $M1, $M3 ), $M2 ), $M6 );

		$this->join( $C11, new Matrix( $R ), 0, 0 );
		$this->join( $C12, new Matrix( $R ), 0, $n / 2 );
		$this->join( $C21, new Matrix( $R ), 0, 0 );
		$this->join( $C22, new Matrix( $R ), $n / 2, $n / 2 );

		return new Matrix( $R );
	}

	public function split( Matrix $p = NULL, Matrix $c = NULL, $ib, $jb ) {
		if ( $c == NULL || $p == NULL ) throw new NullPointerException();

		$c2 = $c->getMatrix();

		for ( $i1 = 0, $i2 = $ib; $i1 < $c->getMatrixSizeA(); $i1++, $i2++ )
			for ( $j1 = 0, $j2 = $jb; $j1 < $c->getMatrixSizeA(); $j1++, $j2++ )
				$c2[ $i1 ][ $j1 ] = $p->getMatrix()[ $i2 ][ $j2 ];

		return new Matrix( $c2 );
	}

	public function sub( Matrix $a = NULL, Matrix $b = NULL ) {
		if ( $a == NULL || $b == NULL ) throw new NullPointerException();

		$matrix = [ ];

		for ( $i = 0; $i < $a->getMatrixSizeA(); $i++ ) for ( $j = 0; $j < $a->getMatrixSizeA(); $j++ )
			$matrix[ $i ][ $j ] = $a->getMatrix()[ $i ][ $j ] - $b->getMatrix()[ $i ][ $j ];

		return new Matrix( $matrix );
	}
}