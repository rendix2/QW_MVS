<?php
namespace QW\FW\Interfaces;

interface IUser
{

    const USER = 'user';
    const ADMIN = 'admin';

    public function getUserName();

    public function getUserId();

    public function getTemplate();

    public function getIP();

    public function isLogged();
}