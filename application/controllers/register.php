<?php
/**
 * Registration Class
 *
 * @package		ThinkBinder REST API
 * @subpackage	news
 * @category	personal
 * @author		Dave Lee
 * @version		0.8
 * @link		http://thinkbinder.com
 *
 */

include_once (realpath(dirname(__FILE__) . "/" . "base.php"));


class Register extends Base {


    function __construct() {
        parent::__construct();
        $this->load->model('Account_model');
	}
	
	
	function index() {
		$name = $this->input->post('name');
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$password_conf = $this->input->post('passwordConfirmation');
		
		if (!$name) {
			$this->message('Please include your name');
			return;
		}
		if (!$this->v->run($name,'name')) {
			$this->message('Please enter your full name');
			return;
		}
		if (!$this->full_name_check($name)) {
			$this->message('Please include both your first and last name');
			return;
		}

		// password stuff
		if ($password) {
			if (strlen($password) < 8) {
				$this->message('Passwords must be at least 8 characters');
				return;
			}		
			if ($password != $password_conf) {
				$this->message('Passwords must match');
				return;
			}
		}
		else {
			$this->message('You must provide a password');
			return;
		}
		
		// email stuff
		if (!$email) {
			$this->message('Please include an email address');
			return;
		}
		if (!$this->v->run($email, 'email')) {
			$this->message('Please enter a valid email address');
			return;
		}
		if (!$this->email_check($email)) {
			$this->message('The email address you entered is already being used by another ThinkBinder account');
			return;
		}
		
		// create new account
		list($first,$last) = $this->split_name($name);
		
		// every things looks good, moving on
		$uid = $this->Account_model->create($first, $last, strtolower($email), $password, 'teacher');
		if (!$uid) {
			//$this->addLog(null, 'userfail', 'start', '', 'error');
			$this->message('There was an error on our servers, please try again.');
			return;
		}

		$user = $this->Account_model->loginByID($uid);
		$result = array(
			'first' => $first,
			'last' => $last,
			'email' => $email
		);
		$this->respond($uid, $result);
	}




	/**
	 * check email address uniqueness
	 *
	 * @param email		user submitted email address
	 */
	function email_check($str) {
		$str = strtolower($str);
		$currEmail = $this->person_data['email'];
		if ( $str ===  $currEmail ) {
			return TRUE;
		}
		
		if (!$this->Account_model->emailAvailable(mysql_real_escape_string($str))) {
			return FALSE;
		}
		else {
			return TRUE;
		}
	}




	/**
	 * check email address uniqueness
	 *
	 * @param email		user submitted email address
	 */
	function emailAvailable() {
		$str = $this->input->get_post('email');
		$str = strtolower($str);
		
		if ($this->Account_model->emailAvailable(mysql_real_escape_string($str))) {
			$this->message("Email available ($str)", 1);
		}
		else {
			$this->message("Email unavailable ($str)", 0);
		}
	}

	
}
