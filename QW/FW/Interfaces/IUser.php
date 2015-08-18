<?php
namespace QW\FW\Interfaces;

interface IUser {

	const ADMIN = 'admin';
	const USER = 'user';

	public function getIP ();

	public function getTemplate ();

	public function getUserId ();

	public function getUserName ();

	public function isLogged ();
}