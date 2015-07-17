<?php

namespace QW\FW\Trees\Nary\Iterators;
;

use QW\FW\Trees\AbstractIterators\AbstractNaryTreeIterator;
use QW\FW\Trees\Nary\NaryTree;

class InOrderIterator extends AbstractNaryTreeIterator
{
    public final function __construct(NaryTree $root)
    {
        parent::__construct($root);
    }

    protected function order(NaryTree $root)
    {
        if ($root == null || $this->realRoot == $root) return;

        foreach ($root->getChildren() as $child) {
            $this->finalData[] = $child->getData();
            $this->order($child);
        }
    }
}
