<?php

namespace QW\FW\Lists;

use QW\FW\Basic\IllegalArgumentException;

class SimpleLinkedList extends AbstractList
{

    private $last;

    public function __construct($data = null, $type = null)
    {
        parent::__construct($data);

        $this->last = new Node($data);
    }

    public function __toString()
    {
        $array = array();

        for ($i = 0; $i < $this->size; $i++) {
            $array[] = $this->get($i);
        }

        return '[ ' . implode(', ', $array) . ' ]';
    }

    public function get($index)
    {
        if ($index < 0)
            throw new IllegalArgumentException();

        $current = $this->last->getNextNode();

        for ($i = 0; $i < $index; $i++) {
            if ($current->getNextNode() == null) return false;

            $current = $current->getNextNode();
        }
        return $current->getData();
    }

    public function add($data)
    {
        $current = $this->last;

        while ($current->getNextNode() != null) {
            $current = $current->getNextNode();
        }

        $current->setNextNode(new Node($data));
        $this->size++;

        return true;
    }

    public function contains($data)
    {
        $current = $this->last->getNextNode();

        for ($i = 0; $i < $this->size; $i++) {
            if ($current->getData() == $data) return true;

            $current = $current->getNextNode();
        }
        return false;
    }

    public function remove($index)
    {
        if ($index < 0 || $index > $this->size)
            throw new IllegalArgumentException();

        $current = $this->last;

        for ($i = 0; $i < $index; $i++) {
            if ($current->getNextNode() == null) return false;

            $current = $current->getNextNode();
        }

        if ($index < $this->size)
            $current->setNextNode($current->getNextNode()->getNextNode());

        $this->size--;

        return true;
    }

    public function getLast()
    {
        return $this->helperGetLast($this->last);
    }

    private function helperGetLast(Node $node)
    {
        if ($node->getNextNode() == null) return $node->getData();

        $this->helperGetLast($node->getNextNode());
    }

    public function getFirst()
    {
        return $this->last->getData();
    }
}