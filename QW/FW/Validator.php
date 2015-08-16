<?php

namespace QW\FW;

use QW\FW\Boot\PrivateConstructException;

final class Validator
{
	public function __construct()
	{
		throw new PrivateConstructException();
	}

	public static function validateIpUsingFilter( $ip )
	{
		return filter_var( $ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE );
	}

	public static function validateEmailUsingFilter( $email )
	{
		return filter_var( $email, FILTER_VALIDATE_EMAIL );
	}

	public static function validateURLUsingFilter( $url )
	{
		return filter_var( $url, FILTER_VALIDATE_URL );
	}

	// http://php.net/manual/en/function.filter-var.php
	public static function validateEmailIPv6( $email, $strict = TRUE )
	{
		$dot_string = $strict ? '(?:[A-Za-z0-9!#$%&*+=?^_`{|}~\'\\/-]|(?<!\\.|\\A)\\.(?!\\.|@))' : '(?:[A-Za-z0-9!#$%&*+=?^_`{|}~\'\\/.-])';
		$quoted_string = '(?:\\\\\\\\|\\\\"|\\\\?[A-Za-z0-9!#$%&*+=?^_`{|}~()<>[\\]:;@,. \'\\/-])';
		$ipv4_part = '(?:[0-9]|[1-9][0-9]|1[0-9][0-9]|2[0-4][0-9]|25[0-5])';
		$ipv6_part = '(?:[A-fa-f0-9]{1,4})';
		$fqdn_part = '(?:[A-Za-z](?:[A-Za-z0-9-]{0,61}?[A-Za-z0-9])?)';
		$ipv4 = "(?:(?:{$ipv4_part}\\.){3}{$ipv4_part})";
		$ipv6 = '(?:' . "(?:(?:{$ipv6_part}:){7}(?:{$ipv6_part}|:))" . '|' . "(?:(?:{$ipv6_part}:){6}(?::{$ipv6_part}|:{$ipv4}|:))" . '|' . "(?:(?:{$ipv6_part}:){5}(?:(?::{$ipv6_part}){1,2}|:{$ipv4}|:))" . '|' . "(?:(?:{$ipv6_part}:){4}(?:(?::{$ipv6_part}){1,3}|(?::{$ipv6_part})?:{$ipv4}|:))" . '|' . "(?:(?:{$ipv6_part}:){3}(?:(?::{$ipv6_part}){1,4}|(?::{$ipv6_part}){0,2}:{$ipv4}|:))" . '|' . "(?:(?:{$ipv6_part}:){2}(?:(?::{$ipv6_part}){1,5}|(?::{$ipv6_part}){0,3}:{$ipv4}|:))" . '|' . "(?:(?:{$ipv6_part}:){1}(?:(?::{$ipv6_part}){1,6}|(?::{$ipv6_part}){0,4}:{$ipv4}|:))" . '|' . "(?::(?:(?::{$ipv6_part}){1,7}|(?::{$ipv6_part}){0,5}:{$ipv4}|:))" . ')';
		$fqdn = "(?:(?:{$fqdn_part}\\.)+?{$fqdn_part})";
		$local = "({$dot_string}++|(\"){$quoted_string}++\")";
		$domain = "({$fqdn}|\\[{$ipv4}]|\\[{$ipv6}]|\\[{$fqdn}])";
		$pattern = "/\\A{$local}@{$domain}\\z/";

		return preg_match( $pattern, $email, $matches ) && ( !empty( $matches[ 2 ] ) && !isset( $matches[ 1 ][ 66 ] ) && !isset( $matches[ 0 ][ 256 ] ) || !isset( $matches[ 1 ][ 64 ] ) && !isset( $matches[ 0 ][ 254 ] ) );
	}

	// Jakub Vrana php.vrana.cz
	// Looks very pretty and easy
	public static function validateEmailUsingJakubVrana( $email )
	{
		static $atom = '[-a-z0-9!#$%&\'*+/=?^_`{|}~]';
		static $domain = '[a-z0-9]([-a-z0-9]{0,61}[a-z0-9])';

		return preg_match( ":^$atom+(\\.$atom+)*@($domain?\\.)+$domain\$:i", $email );
	}

	public static function isNumber( $number )
	{
		return is_numeric( $number );
	}
}