<?php

	namespace QW\FW\Basic;

	use QW\FW\Boot\IllegalArgumentException;
	use QW\FW\Boot\NullPointerException;
	use QW\FW\Validator;

	final class Double extends Object {
		const INF     = INF;
		const MIN_INF = -INF;
		private $double;

		public function __construct ( $double = 0.0 ) {
			parent::__construct ();

			if ( !Validator::isDouble ( $double ) ) throw new IllegalArgumentException();

			$this->double = $double;
		}

		public function __destruct () {
			$this->double = NULL;

			parent::__destruct ();
		}

		public function __toString () {
			return (string) $this->double;
		}

		public function divide ( $number ) {
			if ( $number == 0 ) throw new IllegalArgumentException();

			return new Double( (double) $this->double / (double) $number );
		}

		public function divideDouble ( Double $number = NULL ) {
			if ( $number == NULL ) throw new NullPointerException();
			if ( $number == 0 ) throw new IllegalArgumentException();

			return new Double( (double) ( $this->double / $number->double ) );
		}

		public function minus ( $number ) {
			if ( $number == 0 ) return new Double( $this->double );

			return new Double( (double) ( $number - $this->double ) );
		}

		public function minusDouble ( Double $number = NULL ) {
			if ( $number == NULL ) throw new NullPointerException();
			if ( $number == 0 ) throw new IllegalArgumentException();

			return new Double( (double) $this->double - (double) $number->double );
		}

		public function plus ( $number ) {
			if ( $number == 0 ) return new Double( $this->double );

			return new Double( (double) $number + (double) $this->double );
		}

		public function plusDouble ( Double $number = NULL ) {
			if ( $number == NULL ) throw new NullPointerException();
			if ( $number == 0 ) throw new IllegalArgumentException();

			return new Double( $this->double + $number->double );
		}

		public function times ( $number ) {
			if ( $number == 0 ) return new Double( 0.0 );
			if ( $number == 1 ) return new Double( (double) $this->double );

			return new Double( $number * $this->double );
		}

		public function timesDouble ( Double $number = NULL ) {
			if ( $number == 0 ) return new Double( 0.0 );
			if ( $number == 1 ) return new Double( (double) $this->double );

			return new Double( (double) $number->double * (double) $this->double );
		}
	}