<?php
namespace QW\Libs\User;

use QW\FW\Interfaces\IUser;
use QW\FW\SuperGlobals\Session;
use QW\FW\User\AbstractUser;

class User extends AbstractUser implements IUser {
	protected $userName, $userId, $userTemplate, $userIP;
	private $admin;

	public function __construct() {
		$this->admin = FALSE;
	}

	public function getIP() {
		return $this->userIP;
	}

	public function getTemplate() {
		return $this->userTemplate;
	}

	public function getUserId() {
		return $this->userId;
	}

	public function getUserName() {
		return $this->userName;
	}

	public function isAdmin() {
		return Session::get('Admin');
	}

	public function isLogged() {
		return Session::get('Logged');
	}
}