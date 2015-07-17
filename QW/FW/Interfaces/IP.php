<?php

namespace QW\FW\Interfaces;

interface IP
{
    public function getIP();

    public function getPart($part);

    public function getLong();

}