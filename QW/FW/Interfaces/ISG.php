<?php
namespace QW\FW\Interfaces;

interface ISG
{
    public static function set($k, $v);

    public static function get($k);

    public static function getAll();
}