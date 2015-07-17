<?php

namespace QW\FW\Interfaces;

interface IDatabase
{
//    public function __construct($host, $userName, $userPassword, $dbName, array $options); // connect!

    public function fetch();

    public function fetchAll();

    public function fetchColumn();

    public function numRows();

    public function query($query, array $options);

    public function lastID();

    public function freeStatement();
}