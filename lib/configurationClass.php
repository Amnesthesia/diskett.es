<?php
define("PATH", substr(__DIR__, 0, -3)); // Absolute path

require_once(PATH . '/interfaces/configInterface.php');


class Configuration implements iConfiguration
{
	private static $instance = NULL;
	private static $config = array();


	/**
	 * Create an instance of Configuration
	 * @return object Configuration object
	 */
	public static function getInstance()
	{
		if (!isset(Configuration::$instance))
			Configuration::$instance = new Configuration();

		return Configuration::$instance;
	}

	/**
	 * Returns the configuration values
	 * @param  string $configType
	 * @return array  Configuration data
	 */
	public static function getConfig($configType)
	{
		if (array_key_exists($configType, Configuration::$config))
			return Configuration::$config[$configType];
		else
			return false;
	}

	/**
	 * Set a new configuration value
	 * @param string $configType
	 * @param string $value
	 */
	public static function setConfig($configType, $value)
	{
		// Not yet implemented
	}


	/**
	 * Reads the configuration details from config.php
	 * and stores them in the array Configuration::$config
	 */
	private function __construct()
	{		
		Configuration::$config = parse_ini_file(PATH . '/config/config.php', true);
	}
}