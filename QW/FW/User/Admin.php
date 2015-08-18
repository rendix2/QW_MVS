<?php
namespace QW\Libs\User;

final class Admin extends User {
	private $admin;

	public function __construct () {
		$this->admin = TRUE;
	}
}