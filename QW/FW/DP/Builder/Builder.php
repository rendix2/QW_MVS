<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 21. 6. 2015
 * Time: 18:24
 */

namespace QW\FW\DP\Builder;


interface Builder
{

    public function __construct();

    public function buildFloor();

    public function buildRoof();

    public function buildWalls();

    public function getResult();

}