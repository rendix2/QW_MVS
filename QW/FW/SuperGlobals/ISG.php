<?php
namespace QW\FW\SuperGlobals;

interface ISG {
	public static function get( $k );

	public static function getAll();

	public static function set( $k, $v );
}