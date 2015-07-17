<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 7. 7. 2015
 * Time: 13:55
 */

namespace QW\FW\Sort;


class ShellSort extends AbstractSort
{

    protected function sort(AbstractSort $sort)
    {
        $gap = $this->length / 2;

        while ($gap > 0) {
            for ($i = 0; $i < $this->length - $gap; $i++) {
                $j = $i + $gap;
                $tmp = $this->data[$j];

                while ($j >= $gap && $tmp > $this->data[$j - $gap]) {
                    $this->data[$j] = $this->data[$j - $gap];
                    $j -= $gap;
                }
                $this->data[$j] = $tmp;
            }
            if ($gap == 2)
                $gap = 1;
            else
                $gap /= 2.2;
        }

        return $this->data;
    }
}