<?php
namespace QW\FW\DP\Decorator;

use QW\FW\Basic\NullPointerException;
use QW\FW\Basic\String;

class PrinterWrapper {

	private $printer;
	private $charPerLine;
	private $charPerCurrentLine;

	public function __construct() {
		$this->charPerCurrentLine = 0;
		$this->charPerLine        = 100;
	}

	public function stringPrinter(Printer $printer) {
		if ( $printer == NULL ) {
			throw new NullPointerException();
		}

		$this->printer = $printer;
	}

	public function myPrint(String $s) {
		if ( $s == NULL ) {
			throw new NullPointerException();
		}

		$index = 0;

		while ( $index < $s->getLength() ) {
			if ( $this->isCurrentLineFull() ) {
				$this->wrap2NewLine();
			}

			$this->printer->printChar($s->charAt($index));
			$this->charPerCurrentLine++;
			$index++;
		}
	}

	public function isCurrentLineFull() {
		return $this->charPerCurrentLine >= $this->charPerLine;
	}

	// we cant have function print ? :O says ide

	public function wrap2NewLine() {
		if ( !( $this->printer instanceof Printer ) ) {
			throw new NullPointerException();
		}

		$this->printer->nextLine();
		$this->charPerCurrentLine = 0;
	}
}