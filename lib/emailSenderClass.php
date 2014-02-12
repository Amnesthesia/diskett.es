<?php

require_once('configurationClass.php');

class MailSender
{
	private static $instance;
	private $mailConfig = array();

	/**
	 * Create and return an instance of MailSender class
	 * @return object MailSender
	 */
	public static function getInstance()
	{
		if (!isset(MailSender::$instance))
			MailSender::$instance = new MailSender();

		return MailSender::$instance;
	}

	/**
	 * Generic function for sending mail to users of Epguide
	 * 
	 *  NOTE:
	 *  It is worth noting that the mail() function is not suitable for larger volumes of email in a loop. 
	 *  This function opens and closes an SMTP socket for each email, which is not very efficient.
	 *	For the sending of large amounts of email, see the » PEAR::Mail, and » PEAR::Mail_Queue packages.
	 *	 
	 * @param  string $to      Mail address (recipient)
	 * @param  string $subject Subject of mail
	 * @param  string $message Message to send
	 * @param  string $headers Optional headers
	 * @return integer         True or false, indicating if the mail was sent or not
	 */
	public function sendMail($to, $subject, $message, $headers = NULL)
	{
		if (!isset($headers))
			$headers = 'FROM: ' . $this->mailConfig['Sender'] . ' <' . $this->mailConfig['Address'] . '>' . "\r\n";


		return mail($to, $subject, $message, $headers, '-f ' . $this->mailConfig['Address']);
	}

	/**
	 * Get mail specific configuration values
	 */
	private function __construct() 
	{
		$this->mailConfig = Configuration::getInstance()->getConfig('Mail');
	}
}

MailSender::getInstance()->sendMail('tommy.ingdal@gmail.com', 'Test mail', 'This is the message');

