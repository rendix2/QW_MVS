<?php

namespace QW\FW\Cache;

class ArrayCache extends AbstractCache
{
    private $data;

    public function __construct()
    {
        parent::__construct();

        $this->data = [];
    }

    public function addCache($data)
    {
        $this->data[] = $data;
    }

    public function useCache()
    {
        return $this->data;
    }

    public function removeCache()
    {
        $this->data = array();
    }
}