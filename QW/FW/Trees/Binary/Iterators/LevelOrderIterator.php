<?php

namespace QW\FW\Trees\Binary\Iterators;

use QW\FW\Trees\AbstractIterators\AbstractBinaryTreeIterator;
use QW\FW\Trees\Binary\BinaryTree;

class LevelOrderIterator extends AbstractBinaryTreeIterator
{

    private $queue;

    public function __construct(BinaryTree $root)
    {
        $this->queue = new \SplQueue();
        parent::__construct($root);
    }

    protected function order(BinaryTree $root)
    {
        if ($root == null || $this->realRoot == $root) return;

        $this->queue->enqueue($root);

        while (!$this->queue->isEmpty()) {
            $current = $this->queue->dequeue();

            $this->finalData[] = $current->getData();

            if ($current->getLeft() != null)
                $this->queue->enqueue($current->getLeft());
            if ($current->getRight() != null)
                $this->queue->enqueue($current->getRight());
        }
    }
}