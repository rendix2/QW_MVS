<?php

namespace QW\FW\IP;

use QW\FW\Basic\IllegalArgumentException;

final class IPv6 extends AbstractIP
{
    public function __construct($ip)
    {
        parent::__construct($ip);

        if ($this->getIpCountPart() != 6) // IPv6
            throw new IllegalArgumentException();

        $this->ipCoded = ip2long($ip);
    }

    public function getPart($part)
    {
        parent::getPart($part);

        if ($part < 1 || $part > 6)
            throw new IllegalArgumentException();

        return $this->ipParted[$part - 1];
    }
}