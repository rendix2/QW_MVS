<?php
namespace QW\FW\Utils\Log;

use QW\FW\Basic\Object;
use QW\FW\Boot\IllegalArgumentException;
use QW\FW\FileSystem\File;

class Logger extends Object {

	const LOG_TYPE_DATABASE = 1;

	private $path;
	private $file;

	public function __construct($type) {
		parent::__construct();

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

		parent::__destruct();
	}

	public function log($message) {
		$this->file->addContent($message . "\n");
	}
}