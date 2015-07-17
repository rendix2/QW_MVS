<?php

namespace QW\FW\Blocation;

class WhiteList extends BlackList
{
    public function run()
    {
        foreach ($this->longOfIP as $ip) {
            if ($ip->getLong() == $this->myIp->getLong())
                return true;
        }

        return false;
    }

    public function __destruct()
    {
        parent::__destruct();
    }
}

