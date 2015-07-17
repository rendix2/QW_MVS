<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 20. 6. 2015
 * Time: 12:29
 */

namespace QW\FW\DP\State;


final class ShowOfUse
{

    private $context;

    public function __construct()
    {
        $this->context = new Context();

        $this->context->beHappy();
        $this->context->express();

        $this->context->beSad();
        $this->context->express();
    }
}