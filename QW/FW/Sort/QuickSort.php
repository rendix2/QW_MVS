<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 7. 7. 2015
 * Time: 13:51
 */

namespace QW\FW\Sort;


class QuickSort extends AbstractSort
{

    protected function sort(AbstractSort $sort)
    {
        // TODO: Implement sort() method.
    }


    private function quickSort(array $array, $left, $right)
    {
        if ($left < $right) {
            $boundary = $left;
            for ($i = $left + 1; $i < $right; $i++) {
                if ($array[$i] > $array[$left])
                    self::swap($array, $i, ++$boundary);
            }
            self::swap($array, $left, $boundary);
            $this->quickSort($array, $left, $boundary);
            $this->quickSort($array, $boundary + 1, $right);
        }

        return $this->data;
    }
}