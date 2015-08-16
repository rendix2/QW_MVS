<?php
namespace QW\Libs;

use QW\FW\Config as FWConfig;

final class Config extends FWConfig
{
	const SLASH = '/';
	const BACKSLASH = '\\';
	const URL = 'http://newest.vsichni-chytry.com';
	const URL_DELIMITER = '/';
	const EMAIL = 'rendix2@seznam.cz';
	static $dbConfig = [ 'dbHost' => 'localhost', 'dbUser' => 'xpy', 'dbPassword' => '19723698', 'dbName' => 'cvutblog' ];

	private function __construct()
	{
	}
}
