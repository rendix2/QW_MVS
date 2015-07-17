<?php

namespace QW\FW\DP\Decorator;

class Printer
{

    public function printChar($char)
    {
        echo $char;
    }

    public function nextLine()
    {
        echo "\n<br>";
    }
}