<?php

	namespace QW\FW\Utils\IP;

	use QW\FW\Basic\StringW;
	use QW\FW\Boot\IllegalArgumentException;

	final class IPv6 extends AbstractIP {
		public function __construct ( $ip, $safeMode = TRUE ) {
			parent::__construct ( $ip, $safeMode );
			if ( $this->getIpCountPart () != 8 ) throw new IllegalArgumentException();
		}

		public function __destruct () {
			parent::__destruct ();
		}

		public function getNiceIp () {
			$str = new StringW( '' );

			for ( $i = 0; $i < 8; $i++ ) {
				$substr = new StringW( $this->getPart ( $i ) );
				$substr = $substr->pad ( 4, '0', STR_PAD_LEFT );

				if ( $substr->getLength () != 4 ) $str = $str->concatPostString ( $substr );
				else $str = $str->concatPost ( $substr->getString () )
				                ->concatPost ( ':' )
				;
			}

			return $str->subString ( 0, $str->getLength () - 1 )
			           ->getString ()
			;

		}

		public function getPart ( $part ) {
			if ( !Validator::is_numeric ( $part ) || $part < 0 || $part > 8 ) throw new IllegalArgumentException();

			return $this->ipParted[ $part ];
		}

		public function getSecureIp () {
			$string = new StringW( '' );

			for ( $i = 0; $i < 6; $i++ ) $string = $string->concatPost ( (string) $this->getPart ( $i ) )
			                                              ->concatPost ( ':' )
			;

			return $string = $string->concatPost ( 'XXX:XXX' );
		}
	}