<?php
namespace QW\Models;

use QW\FW\Architecture\MVC\AbstractBasicModel;

final class IndexModel extends AbstractBasicModel
{
    public function index()
    {
        $this->getDB()->query('SELECT user_name FROM users LIMIT 50;', array());
        return $this->getDB()->fetchAll();
    }
}