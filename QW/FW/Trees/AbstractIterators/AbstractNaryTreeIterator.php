<?php

namespace QW\FW\Trees\AbstractIterators;

use QW\FW\Trees\Nary\NaryTree;

abstract class AbstractNaryTreeIterator extends AbstractTreeIterator
{

    public function __construct(NaryTree $root)
    {
        parent::__construct();

        $this->realRoot = $root;
        $this->order($root);
    }

    abstract protected function order(NaryTree $root);
}