<?php

require_once('configurationClass.php');

class MailSender
{
	private static $instance;
	private $mailConfig = array();

	public static function getInstance()
	{
		if (!isset(MailSender::$instance))
			MailSender::$instance = new MailSender();

		return MailSender::$instance;
	}

	/**
	 * [sendMail description]
	 * 
	 *  NOTE:
	 *  It is worth noting that the mail() function is not suitable for larger volumes of email in a loop. 
	 *  This function opens and closes an SMTP socket for each email, which is not very efficient.
	 *	For the sending of large amounts of email, see the » PEAR::Mail, and » PEAR::Mail_Queue packages. 
	 * @param  [type] $to      [description]
	 * @param  [type] $message [description]
	 * @param  [type] $headers [description]
	 * @return [type]          [description]
	 */
	public function sendMail($to, $subject, $message, $headers = NULL)
	{
		if (!isset($headers))
			$headers = 'FROM: ' . $this->mailConfig['Sender'] . ' <' . $this->mailConfig['Address'] . '>' . "\r\n";


		return mail($to, $subject, $message, $headers, '-f ' . $this->mailConfig['Address']);
	}


	private function __construct() 
	{
		$this->mailConfig = Configuration::getInstance()->getConfig('Mail');
	}
}

