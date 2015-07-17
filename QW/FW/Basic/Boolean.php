<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 14. 6. 2015
 * Time: 14:07
 */

namespace QW\FW\Basic;


final class Boolean extends Object
{
    const TRUE = true;
    const FALSE = false;

    private $boolean;

    function __construct($boolean)
    {
        parent::__construct();

        if (!is_bool($boolean))
            throw new IllegalArgumentException();

        $this->boolean = $boolean;
    }

    function __toString()
    {
        return (string)$this->boolean;
    }

    public static function compare($x, $y)
    {
        if (!is_bool($x) || !is_bool($y))
            throw new IllegalArgumentException();

        return $x == $y;
    }

    public static function compareBoolean(Boolean $x, Boolean $y)
    {
        return $x->boolean == $y->boolean;
    }

    public function compareTo($boolean)
    {
        if ( !is_bool($boolean) )
            throw new IllegalArgumentException();

        return $this->boolean == $boolean;
    }

    public function compareToBoolean(Boolean $boolean)
    {
        return $this->boolean == $boolean->boolean;
    }
}