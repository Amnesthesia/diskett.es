<?php

interface iUser
{
	public function getId();
	public function getEmail();
	public function getPassword();
	public function getRoleId();
	public function getCountryId();

	public function setEmail($_mail);
	public function setPassword($_password);
	public function setRoleId($_roleId);
	public function setCountryId($_countryId);
}