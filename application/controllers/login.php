<?php
/**
 * Star Class
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


class Login extends Base {


    function __construct() {
        parent::__construct();
        $this->load->model('Account_model');
	}
	
	
	function index() {
		$email = $this->input->post('email');
		$password = $this->input->post('password');		
		
		if (!$email) {
			$this->message('You forgot to enter your email');
			return;
		}
		if (!$password) {
			$this->message('You forgot to enter your password');
			return;
		}
		if (!$this->v->run($email,'email')) {
			$this->message('Please enter a valid email');
			return;
		}
		if (strlen($password) < 8) {
			$this->message('Account and password do not match');
			return;
		}
		
		$email = strtolower($email);
		$user = $this->Account_model->getUserByLogin($email);
		if (!$user) {
			$this->message('Account not found');
			return;
		}
		
		// check login credentials
		$check = $this->Account_model->checkLogin($email, $password);
		if ($check === FALSE) {
			//$this->addLog(null, 'passfail', 'account', $email, 'fail');
			$this->message('Account and password do not match');
			return;
		}
		
		$login = $this->Account_model->loginByID($user->id);
		if ($login === FALSE) {
			$this->message('There was an error on our servers');
			return;
		}
		
		$result = array(
			'first' => $user->first,
			'last' => $user->last,
			'email' => $user->email
		);
		$this->respond($user->id, $result);
		// $this->addLog($user->id, 'join', $club);		
	}

	
}

