<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 20. 6. 2015
 * Time: 14:55
 */

namespace QW\FW\DP\Strategy;


class Context
{

    private $strategy;

    public function __construct(Strategy $strategy)
    {
        $this->strategy = $strategy;
    }

    public function multiply($a, $b)
    {
        return $this->strategy->multiply($a, $b);
    }

}