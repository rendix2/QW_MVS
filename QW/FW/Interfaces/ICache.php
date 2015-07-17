<?php

namespace QW\FW\Interfaces;

interface ICache
{
    public function addCache($data);

    public function useCache();

    public function removeCache();
}
