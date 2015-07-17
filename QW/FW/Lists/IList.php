<?php

namespace QW\FW\Lists;

interface IList
{

    public function get($index);

    public function getLast();

    public function getFirst();

    public function add($data);

    public function contains($data);

    public function remove($index);

    public function __toString();

}