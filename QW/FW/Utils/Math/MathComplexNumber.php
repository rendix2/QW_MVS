<?php
/**
 * Created by PhpStorm.
 * User: Tomáš
 * Date: 25. 2. 2016
 * Time: 10:35
 */

namespace QW\FW\Utils\Math;


use QW\FW\Basic\Object;

class MathComplexNumber extends Object {

	private $real;
	private $imaginary;

	public function __construct( $realPart, $imginaryPart, $debug = FALSE ) {
		parent::__construct( $debug );

		$this->real      = $realPart;
		$this->imaginary = $imginaryPart;
	}

	public function __toString() {
		if ( $this->imaginary == 0 ) return $this->real;
		else if ( $this->real == 0 ) return $this->imaginary . 'i';

		return $this->real . ' ' . $this->imaginary . 'i';
	}

	public function abs() {
		return Math::hypot( $this->real, $this->imaginary );
	}

	public function conjugate() {
		return new MathComplexNumber( $this->real, -$this->imaginary, $this->debug );
	}

	public function cos() {
		return new MathComplexNumber( Math::cos( $this->real ) * Math::cosH( $this->imaginary ),
			-Math::sin( $this->real ) * Math::sinH( $this->imaginary ) );
	}

	public function cotg() {
		return $this->cos()
		            ->divide( $this->sin() );
	}

	public function divide( MathComplexNumber $b ) {
		return $this->mult( $b->reciprocal() );
	}

	public function minus( MathComplexNumber $b ) {
		return new MathComplexNumber( $this->real - $b->real, $this->imaginary - $b->imaginary, $this->debug );
	}

	public function mult( MathComplexNumber $b ) {
		$real = $this->real * $b->real - $this->imaginary * $b->imaginary;
		$imag = $this->real * $b->imaginary + $this->imaginary * $b->real;

		return new MathComplexNumber( $real, $imag, $this->debug );
	}

	public function multAplha( $alpha ) {
		return new MathComplexNumber( $this->real * $alpha, $this->imaginary * $alpha, $this->debug );
	}

	public function phase() {
		return Math::arcTg2Var( $this->imaginary, $this->real );
	}

	public function plus( MathComplexNumber $b ) {
		return new MathComplexNumber( $this->real + $b->real, $this->imaginary + $b->imaginary, $this->debug );
	}

	public function reciprocal() {
		$scale = $this->real * $this->real + $this->imaginary * $this->imaginary;

		return new MathComplexNumber( $this->real / $scale, -$this->imaginary / $scale, $this->debug );
	}

	public function sin() {
		return new MathComplexNumber( Math::sin( $this->real ) * Math::cosH( $this->imaginary ),
			Math::cos( $this->real ) * Math::sinH( $this->imaginary ) );
	}

	public function tg() {
		return $this->sin()
		            ->divide( $this->cos() );
	}
}