<?php

namespace QW\FW\Trees;

use QW\FW\Basic\Object;

abstract class AbstractTree extends Object
{

    protected $data, $directChildrenCount, $childrenCount;

    public function __construct()
    {
        parent::__construct();
    }

    public function __destruct()
    {
        $this->data = null;
        $this->directChildrenCount = null;
        $this->directChildrenCount = null;

        parent::__destruct();
    }

    abstract public function iteratorInOrderIterative();

    abstract public function iteratorPreOrderIterative();

    abstract public function iteratorPostOrderIterative();

    abstract public function iteratorLevelOrder();

    abstract public function iteratorEulerTour();

    public function getChildrenCount()
    {
        return $this->directChildrenCount;
    }

    public function getDirectChildrenCount()
    {
        return $this->directChildrenCount;
    }

    public function getData()
    {
        return $this->data;
    }
}