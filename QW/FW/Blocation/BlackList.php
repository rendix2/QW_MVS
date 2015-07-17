<?php

namespace QW\FW\Blocation;

use QW\FW\Basic\NullPointerException;
use QW\FW\Basic\Object;
use QW\FW\Interfaces\IP;
use QW\FW\IP\IPv4;
use QW\FW\IP\IPv6;
use QW\FW\IP\IPvU;
use QW\FW\SuperGlobals\Server;

class BlackList extends Object
{
    protected $longOfIP;
    protected $myIp;

    public function __construct()
    {
        parent::__construct();

        $this->longOfIP = [];
        $this->myIp = new IPvU(Server::get('remote_addr'));
    }

    public function addIp(IP $ip)
    {
        if ($ip == null)
            throw new NullPointerException();

        $this->longOfIP[] = $ip;
    }

    public function addIPsv4(array $long)
    {
        foreach ($long as $v)
            $this->longOfIP[] = new IPv4($v);
    }

    public function addIPsv6(array $long)
    {
        foreach ($long as $v)
            $this->longOfIP[] = new IPv6($v);
    }

    public function addIPs(array $long)
    {
        foreach ($long as $v)
            $this->longOfIP[] = new IPvU($v);
    }

    public function addLong(IP $ip)
    {
        if ($ip == null)
            throw new NullPointerException();

        $this->longOfIP[] = $ip;
    }

    public function deleteIp(IP $ip)
    {
        if ($ip == null)
            throw new NullPointerException();

        foreach ($this->longOfIP as $k => $v)
            if ($v->getLong() == $ip->getLong())
                unset($this->longOfIP[$k]);
    }

    public function deleteLong(IP $ip)
    {
        if ($ip == null)
            throw new NullPointerException();

        foreach ($this->longOfIP as $k => $v)
            if ($v->getLong() == $ip->getLong())
                unset($this->longOfIP[$k]);
    }

    public function run()
    {
        foreach ($this->longOfIP as $ip) {
            if ($ip->getLong() == $this->myIp->getLong())
                die('Your IP as blacklisted.');
        }
    }

    public function __destruct()
    {
        $this->run();
        $this->longOfIP = null;
        $this->myIp = null;
    }
}