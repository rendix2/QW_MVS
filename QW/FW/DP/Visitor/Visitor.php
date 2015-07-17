<?php

namespace QW\FW\DP\Visitor;

interface Visitor
{

    public function __toString();

    public function visitMuseum(Museum $museum);

    public function visitCinema(Cinema $cinema);

}