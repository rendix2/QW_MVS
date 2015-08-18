<?php
namespace QW\Libs;

use QW\FW\Config as FWConfig;

final class Config extends FWConfig {
	const BACKSLASH = '\\';
	const EMAIL = 'rendix2@seznam.cz';
	const SLASH = '/';
	const URL = 'http://newest.vsichni-chytry.com';
	const URL_DELIMITER = '/';
	public static $dbConfig = [ 'dbHost' => 'localhost', 'dbUser' => 'xpy', 'dbPassword' => '19723698', 'dbName' => 'cvutblog' ];

	public function __construct() {
		parent::__construct();
	}
}
