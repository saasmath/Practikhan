<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Salty
 *
 * @package     ThinkBinder
 * @subpackage	Libaries
 * @category	Encryption
 * @author		David Lee
 * @version		1.0
 * @file		Salty.php
 */

class Salty {
	var $salt_length;

	function __construct() {
		#$this->salt_length = $params['salt_length'];
	}
	
	// creates a hash from given password for storing in DB
	// must hash all passwords before storing
	function generateHash($password='', $nonce=NULL) {
		$salt = 'tHesKyiSfaLlinG129H23ljLk1j3lQ2l';
		// use Blowfish Crypt (bcrypt) to hash passwords
		return crypt($password, '$2a$07$'.$salt.'$');
	}
	
	// used by the login system to verify credentials
	function passwordsMatch($stored, $given) {
		return $this->generateHash($given) == $stored;
	}

}
