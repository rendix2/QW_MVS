<?php
/**
 * Created by PhpStorm.
 * User: Tomáš
 * Date: 18. 8. 2015
 * Time: 16:01
 */

namespace QW\FW\Utils\Log;

use QW\FW\Boot\IllegalArgumentException;
use QW\FW\FileSystem\File;

class Logger {

	const LOG_TYPE_DATABASE = 1;


	private $path;
	private $file;

	public function __construct($type) {

		$this->path = './logs/';

		switch ( $type ) {
			case self::LOG_TYPE_DATABASE:
				$this->path .= 'database.txt';
				break;
			default:
				throw new IllegalArgumentException();
		}

		$this->file = new File($this->path, TRUE);
	}

	public function __destruct() {
		$this->file = NULL;
		$this->path = NULL;
	}

	public function log($message) {
		$this->file->addContent($message . "\n");
	}
}