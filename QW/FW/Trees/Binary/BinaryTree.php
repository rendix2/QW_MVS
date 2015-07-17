<?php
namespace QW\FW\Trees\Binary;

use QW\FW\Trees\AbstractTree;
use QW\FW\Trees\Binary\Iterators\CountIterator;
use QW\FW\Trees\Binary\Iterators\EulerTourIterator;
use QW\FW\Trees\Binary\Iterators\InOrderIterativeIterator;
use QW\FW\Trees\Binary\Iterators\InOrderRecourseIterator;
use QW\FW\Trees\Binary\Iterators\LevelOrderIterator;
use QW\FW\Trees\Binary\Iterators\PostOrderIterativeIterator;
use QW\FW\Trees\Binary\Iterators\PostOrderRecourseIterator;
use QW\FW\Trees\Binary\Iterators\PreOrderIterativeIterator;
use QW\FW\Trees\Binary\Iterators\PreOrderRecourseIterator;

final class BinaryTree extends AbstractTree
{
    private $left, $right;

    public function __construct(BinaryTree $left = null, BinaryTree $right = null, $data)
    {
        parent::__construct();

        $this->left = $left;
        $this->right = $right;
        $this->data = $data;

        if ($this->left != null)
            $this->directChildrenCount++;
        if ($this->right != null)
            $this->directChildrenCount++;
    }

    public function setLeftChild(BinaryTree $left = null)
    {
        if ($this->left == null && $left != null)
            $this->directChildrenCount++;

        $this->left = $left;
    }

    public function setRightChild(BinaryTree $right = null)
    {
        if ($this->right == null && $right != null)
            $this->directChildrenCount++;

        $this->right = $right;
    }

    public function getLeftChild()
    {
        return $this->left;
    }

    public function getRightChild()
    {
        return $this->right;
    }

    public function getChildrenCount()
    {
        $itc = new CountIterator($this);
        $this->directChildrenCount = $itc->getCountChildren();

        parent::getChildrenCount();
    }

    public function iteratorPreOrderRecourse()
    {
        return new PreOrderRecourseIterator($this);
    }

    public function iteratorPreOrderIterative()
    {
        return new PreOrderIterativeIterator($this);
    }

    public function iteratorInOrderRecourse()
    {
        return new InOrderRecourseIterator($this);
    }

    public function iteratorInOrderIterative()
    {
        return new InOrderIterativeIterator($this);
    }

    public function iteratorPostOrderRecourse()
    {
        return new PostOrderRecourseIterator($this);
    }

    public function iteratorPostOrderIterative()
    {
        return new PostOrderIterativeIterator($this);
    }

    public function iteratorLevelOrder()
    {
        return new LevelOrderIterator($this);
    }

    public function iteratorEulerTour()
    {
        return new EulerTourIterator($this);
    }
}