<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 7. 7. 2015
 * Time: 13:59
 */

namespace QW\FW\Sort;


use QW\FW\Basic\IllegalArgumentException;

class BucketSort extends AbstractSort
{

    private $bucketCount;

    public function __construct(array $data, $bucketCount)
    {
        parent::__construct($data);

        if ($this->bucketCount <= 0 || !is_numeric($bucketCount)) throw new IllegalArgumentException();

        $this->bucketCount = $bucketCount;
    }

    protected function sort(AbstractSort $sort)
    {
        $high = $this->data[0];
        $low = $this->data[0];

        for ($i = 0; $i < $this->length; $i++) {
            if ($this->data[$i] > $high) $high = $this->data[$i];
            if ($this->data[$i] < $low) $low = $this->data[$i];
        }

        $interval = ((float)($high - $low + 1)) / $this->bucketCount;

        $buckets = array();

        for ($i = 0; $i < $this->length; $i++) {
            $buckets[(int)(($this->data[$i] - $low) / $interval)] = $this->data[$i];
        }
    }
}