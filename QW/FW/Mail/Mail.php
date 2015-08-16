<?php
namespace QW\FW;

use QW\FW\Basic\IllegalArgumentException;
use QW\FW\Basic\Object;

class MailException extends \Exception {

}

final class Mail extends Object {

	private $to, $subject, $text;


	public function __construct($to, $subject) {
		parent::__construct();

		if ( Validator::validateEmailUsingJakubVrana($to) ) {
			$this->to = $to;
		}
		else {
			throw new IllegalArgumentException('Neplatná E-mailová adresa.');
		}

		$this->subject = $subject;
	}

	// Jakub Vrána php.vrana.cz

	/**
	 * @param $text
	 *
	 * @throws IllegalArgumentException
	 */
	public function setText($text) {
		if ( empty( $text ) ) {
			throw new IllegalArgumentException('Prázdný text E-mailu');
		}
		else {
			$this->text = $text;
		}
	}

	public function setTextFromFile($filePath) {
		if ( !file_exists($filePath) ) {
			throw new MailException('Neexistující soubor pro text E-mailu.');
		}

		$this->text = file_get_contents($filePath);
	}

	public function showEmail() {
		echo 'To: <img src="imagepath.jpg"><br>';
		echo 'Subject: ' . $this->subject . '<br>';
		echo '<br><br>Text: ' . $this->text . '<br><br>';
		echo 'End of preview!';

		return TRUE;
	}

	public function sendEmail() {
		if ( empty( $this->text ) ) {
			throw new MailException('Prázdný text E-mailu');
		}

		return mb_send_mail($this->to, $this->subject, $this->text);
	}

	private function mimeHeaderEncode($text, $encoding = "utf-8") {
		return "=?$encoding?Q?" . imap_8bit($text) . "?=";
	}

	private function createImageOfTextEmail() {
		// fucking login to create image :))
	}

	private function deleteImageOfTextEmail() {
	}
}