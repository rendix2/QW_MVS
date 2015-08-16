<?php

namespace QW\FW\FileSystem;

use QW\FW\Basic\IllegalArgumentException;
use QW\FW\Basic\Object;

class File extends Object {
	protected $filePath;

	public function __construct($filePath, $create = FALSE) {
		parent::__construct();

		if ( $create == FALSE && !file_exists($filePath) ) {
			throw new IllegalArgumentException();
		}
		else if ( $create == TRUE && file_exists($filePath) ) {
			touch($filePath);
		}

		if ( !is_file($filePath) ) {
			throw new IllegalArgumentException();
		}

		$this->filePath = $filePath;
	}

	final public function accessTime() {
		return fileatime($this->filePath);
	}

	final public function addContent($content) {
		return file_put_contents($this->filePath, $content, FILE_APPEND);
	}

	final public function chmod($mod) {
		return chmod($this->filePath, $mod);
	}

	final public function createTime() {
		return filectime($this->filePath);
	}

	public function delete() {
		return unlink($this->filePath);
	}

	final public function getContent() {
		return file_get_contents($this->filePath);
	}

	final public function group() {
		return filegroup($this->filePath);
	}

	final public function inode() {
		return fileinode($this->filePath);
	}

	final public function  modificationTime() {
		return filemtime($this->filePath);
	}

	final public function moveUploaded($to) {
		if ( !is_dir($to) ) {
			throw new IllegalArgumentException();
		}

		return move_uploaded_file($this->filePath, $to);
	}

	final public function owner() {
		return fileowner($this->filePath);
	}

	final public function parseIni() {
		return parse_ini_file($this->filePath);
	}

	final public function path() {
		return $this->filePath;
	}

	public function permitions() {
		return fileperms($this->filePath);
	}

	final public function readable() {
		return is_readable($this->filePath);
	}

	final public function setContent($content) {
		return file_put_contents($this->filePath, $content);
	}

	public function size() {
		return filesize($this->filePath);
	}

	final public function type() {
		return filetype($this->filePath);
	}

	final public function writable() {
		return is_writable($this->filePath);
	}
}