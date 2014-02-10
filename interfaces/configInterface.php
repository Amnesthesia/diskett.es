<?php

interface iConfiguration
{
	public static function getInstance();
	public static function getConfig($configType);
	public static function setConfig($configType, $value);
}