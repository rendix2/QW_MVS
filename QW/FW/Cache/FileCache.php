<?php

namespace QW\FW\Cache;

use QW\FW\Basic\Object;
use QW\FW\Boot\IllegalArgumentException;

final class FileCache extends Object implements ICache {
	const PATH = './cache/';
	private $file;

	public function __construct($fileName) {
		parent::__construct();

		if ( !preg_match('#^[a-zA-Z0-9-]#$', $fileName) )
			throw new IllegalArgumentException();

		$this->file = new File(self::PATH . $fileName);
	}

	public function addCache($data) {
		return $this->file->setContent(self::PATH . $this->file->path(), serialize($data), FILE_APPEND);
	}

	public function removeCache() {
		return $this->file->delete();
	}

	public function useCache() {
		return unserialize($this->file->getContent());
	}
}