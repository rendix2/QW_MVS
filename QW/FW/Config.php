<?php

namespace QW\FW;

class Config {
	const EMAIL = '';
	const URL = '';
	const URL_DELIMITER = '/';
	static $dbConfig = [ 'dbHost' => '', 'dbUser' => '', 'dbPassword' => '', 'dbName' => '' ];

	public static function getAllPHPIni() {
		return parse_ini_file(php_ini_loaded_file(), TRUE);
	}

	public static function getAllowUrlFopen() {
		return ini_get('allow_url_fopen');
	}

	public static function getAllowUrlInclude() {
		return ini_get('allow_url_include');
	}

	public static function getDisplayErrors() {
		return ini_get('display_errors');
	}

	public static function getMaxExecutionTime() {
		return ini_get('max_execution_time');
	}

	public static function getMaxFileUploads() {
		return ini_get('max_file_uploads');
	}

	public static function getMemoryLimit() {
		return ini_get('memory_limit');
	}

	public static function getPostMaxSize() {
		return ini_get('post_max_size');
	}

	public static function getRegisterGlobals() {
		return ini_get('register_globals');
	}

	public static function getSafeMode() {
		return ini_get('safe_mode');
	}

	public static function getUplaodMaxFileSize() {
		return ini_get('upload_max_filesize');
	}

	private function __construct() {
	}
}