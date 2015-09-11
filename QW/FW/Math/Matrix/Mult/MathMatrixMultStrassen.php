<?php

namespace QW\FW\Math\Matrix\Mult;

use QW\FW\Boot\NullPointerException;
use QW\FW\Math\Matrix\MathMatrix;

class MathMatrixMultiStrassen extends AbstractMathMatrixMult {

	private $result;

	public function __construct( MathMatrix $a = NULL, MathMatrix $b = NULL, $debug = FALSE ) {
		parent::__construct( $debug );

		$this->result = $this->mult( $a, $b );
	}

	public function add( MathMatrix $a = NULL, MathMatrix $b = NULL ) {
		if ( $a == NULL || $b == NULL ) throw new NullPointerException();

		$length = count( $a->getMatrix() );
		$matrix = [ ];

		for ( $i = 0; $i < $length; $i++ ) for ( $j = 0; $j < $length; $j++ )
			$matrix[ $i ][ $j ] = $a->getMatrix()[ $i ][ $j ] + $b->getMatrix()[ $i ][ $j ];

		return new MathMatrix( $matrix );
	}

	public function join( MathMatrix $p = NULL, MathMatrix $c = NULL, $ib, $jb ) {
		if ( $c == NULL || $p == NULL ) throw new NullPointerException();

		$Ccount = count( $c->getMatrix() );
		$p      = $p->getMatrix();

		for ( $i1 = 0, $i2 = $ib; $i1 < $Ccount; $i1++, $i2++ )
			for ( $j1 = 0, $j2 = $jb; $j1 < $Ccount; $j1++, $j2++ ) $p[ $i1 ][ $j1 ] = $c->getMatrix()[ $i2 ][ $j2 ];

		return new MathMatrix( $p );
	}

	public function mult( MathMatrix $A = NULL, MathMatrix $B = NULL ) {
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

		$this->split( $A, new MathMatrix( $A11 ), 0, 0 );
		$this->split( $A, new MathMatrix( $A12 ), 0, $n / 2 );
		$this->split( $A, new MathMatrix( $A21 ), $n / 2, 0 );
		$this->split( $A, new MathMatrix( $A22 ), $n / 2, $n / 2 );

		$this->split( $B, new MathMatrix( $B11 ), 0, 0 );
		$this->split( $B, new MathMatrix( $B12 ), 0, $n / 2 );
		$this->split( $B, new MathMatrix( $B21 ), $n / 2, 0 );
		$this->split( $B, new MathMatrix( $B22 ), $n / 2, $n / 2 );

		$M1 = $this->mult( $this->add( new MathMatrix( $A11, new MathMatrix( $A22 ) ) ),
			$this->add( new MathMatrix( $B11 ), new MathMatrix( $B22 ) ) );
		$M2 = $this->mult( $this->add( new MathMatrix( $A21, new MathMatrix( $A22 ) ) ), new MathMatrix( $B22 ) );
		$M3 = $this->mult( new MathMatrix( $A11 ), $this->sub( new MathMatrix( $B12 ), new MathMatrix( $B22 ) ) );
		$M4 = $this->mult( new MathMatrix( $A22 ), $this->sub( new MathMatrix( $B21 ), new MathMatrix( $B11 ) ) );
		$M5 = $this->mult( $this->add( new MathMatrix( $A11 ), new MathMatrix( $A12 ) ), new MathMatrix( $B22 ) );
		$M6 = $this->mult( $this->sub( new MathMatrix( $A21 ), new MathMatrix( $A11 ) ),
			$this->add( new MathMatrix( $B11 ), new MathMatrix( $B12 ) ) );
		$M7 = $this->mult( $this->sub( new MathMatrix( $A12 ), new MathMatrix( $A22 ) ),
			$this->add( new MathMatrix( $B21 ), new MathMatrix( $B22 ) ) );

		$C11 = $this->add( $this->sub( $this->add( $M1, $M4 ), $M5 ), $M7 );
		$C12 = $this->add( $M1, $M5 );
		$C21 = $this->add( $M2, $M4 );
		$C22 = $this->add( $this->sub( $this->add( $M1, $M3 ), $M2 ), $M6 );

		$this->join( $C11, new MathMatrix( $R ), 0, 0 );
		$this->join( $C12, new MathMatrix( $R ), 0, $n / 2 );
		$this->join( $C21, new MathMatrix( $R ), 0, 0 );
		$this->join( $C22, new MathMatrix( $R ), $n / 2, $n / 2 );

		return new MathMatrix( $R );
	}

	public function split( MathMatrix $p = NULL, MathMatrix $c = NULL, $ib, $jb ) {
		if ( $c == NULL || $p == NULL ) throw new NullPointerException();

		$Ccount = count( $c->getMatrix() );
		$c      = $c->getMatrix();

		for ( $i1 = 0, $i2 = $ib; $i1 < $Ccount; $i1++, $i2++ )
			for ( $j1 = 0, $j2 = $jb; $j1 < $Ccount; $j1++, $j2++ ) $c[ $i1 ][ $j1 ] = $p->getMatrix()[ $i2 ][ $j2 ];

		return new MathMatrix( $c );
	}

	public function sub( MathMatrix $a = NULL, MathMatrix $b = NULL ) {
		if ( $a == NULL || $b == NULL ) throw new NullPointerException();

		$length = count( $a->getMatrix() );
		$matrix = [ ];

		for ( $i = 0; $i < $length; $i++ ) for ( $j = 0; $j < $length; $j++ )
			$matrix[ $i ][ $j ] = $a->getMatrix()[ $i ][ $j ] - $b->getMatrix()[ $i ][ $j ];

		return new MathMatrix( $matrix );
	}
}