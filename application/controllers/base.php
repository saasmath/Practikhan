<?php
/**
 * Base Class
 *
 * All controllers are descendants of this base class
 *
 * Provides an assortment of utility functions for:
 * 		validation
 * 		format conversion
 * 		input sanitization
 * 		logging
 *
 * @package		ThinkBinder REST API
 * @subpackage	Core
 * @category	Core
 * @author		Dave Lee
 * @version		0.8
 * @link		http://thinkbinder.com
 *
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Base extends CI_Controller {
    public $page_data;
    var $person_data;
    var $v;
	
	
	function __construct() {
		parent::__construct();
		
		$this->output->set_header('P3P: CP="CAO PSA OUR"');
		
		$this->page_data['logged_in'] = 0;
		// the user is logged in, prep their basic information
		if (isset($this->session)) {
			if ($this->session->userdata('logged_in')) {
	            $this->person_data['uid']		= $this->session->userdata('uid');
	            $this->person_data['email']		= $this->session->userdata('email');
	            $this->person_data['firstname']	= $this->session->userdata('firstname');
	            $this->person_data['lastname']	= $this->session->userdata('lastname');
	            $this->person_data['picture']	= $this->session->userdata('picture');				
	            $this->page_data['person_data']	= $this->person_data;
				$this->page_data['logged_in'] = 1;
			}
		}
		
		// where are they trying to go?
        $unsecured_pages = array('',
        						 'home',
        						 'register',
        						 'search',
        						 'browse',
        						 'login',
        						 'logout',
        						 'forgot');
		
		// requesting unsecured page
        if (in_array($this->uri->segment(1), $unsecured_pages)) {
			// logged in users get redirected to main application
            if ( $this->session->userdata('logged_in') && $this->uri->segment(1) == '' ) {
                redirect('dashboard');
            }
        }
        // we should only get here when showing error pages
        else {
            if ( !$this->session->userdata('logged_in') ) {
                redirect('home');
            }
        }

		$this->load->library('Validate');
		$this->v =& $this->validate;
	}
	

	
	
	/**
	 * creates a log entry
	 *
	 * @param int uid			user id
	 * @param string note		description of action
	 */
	function respond($status, $data) {
		$result['uid'] = $this->person_data['id'];
		$data = json_encode(array('status' => $status,'data' => $data));
		$this->output->set_content_type('application/json')->set_output( $data );
	}



	
	/**
	 * creates a log entry
	 *
	 * @param int uid			user id
	 * @param string note		description of action
	 */
	function message($message, $status=0) {
		$result = array(
			'message'	=> $message
		);

		$data = json_encode(array('status' => $status,'data' => $result));
		$this->output->set_content_type('application/json')->set_output( $data );
	}
	
	
	

	/**
	 * creates a log entry
	 *
	 * @param int uid			user id
	 * @param string note		description of action
	 */
	function addLog($uid, $tag, $scope='', $note='', $flag='') {
		$ip = $_SERVER['REMOTE_ADDR'];
		if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		}

		//$ip = $_SERVER['HTTP_X_FORWARDED_FOR']?$_SERVER['HTTP_X_FORWARDED_FOR']:$_SERVER['REMOTE_ADDR'];
		if(strpos($ip,',') !== false) {
			$ip = substr($ip,0,strpos($ip,','));
		}
		
		$this->load->library('user_agent');
		$agent = array(
			'user' => $uid,
			'browser' => $this->agent->browser(),
			'version' => $this->agent->version(),
			'mobile' => $this->agent->mobile(),
			'platform' => $this->agent->platform(),
			'referrer' => $this->agent->referrer(),
			'ip' => $ip//$_SERVER['REMOTE_ADDR']
		);
		
		$this->load->model('Tb_model');
		$this->Tb_model->addLog($agent,$tag,$scope,$note,$flag);
	}



	/*
	 *--------------------------------------------------------------------------
	 * Utilities
	 *--------------------------------------------------------------------------
	 */

		
	/**
	 * generates a random string
	 *
	 * @param int length			length of generated random string
	 * @param string chars			string containing list of useable characters
	 */
	function rand_str($length = 32, $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890') {
		$random_string = "";
		$num_valid_chars = strlen($chars);
		// repeat the steps until we've created a string of the right length
		for ($i = 0; $i < $length; $i++) {
			// pick a random number from 1 up to the number of valid chars
			$random_pick = mt_rand(1, $num_valid_chars);
			// take the random character out of the string of valid chars
			// subtract 1 from $random_pick because strings are indexed starting at 0, and we started picking at 1
			$random_string .= $chars[$random_pick-1];
		}
		return $random_string;
	}

	

	
	private function _var_chk(& $var) {
        # potentially useless function        
        return (isset($var)) ? $var : NULL;
    }




	/**
	 * removes item from associated array by value
	 *
	 * @param array array			length of generated random string
	 * @param string val			string containing list of useable characters
	 */
	function remove_item_by_value($array, $val = '', $preserve_keys = true) {
		if (empty($array) || !is_array($array)) return false;
		if (!in_array($val, $array)) return $array;
	
		foreach($array as $key => $value) {
			if ($value == $val) unset($array[$key]);
		}
	
		return ($preserve_keys === true) ? $array : array_values($array);
	}
	


	// is email already being used
	function email_check($str) {
		$this->load->model('User_model');
		if (!$this->User_model->emailAvailable(mysql_real_escape_string($str))) {
			return FALSE;
		}
		else return TRUE;
	}


	// makes sure we have a real-looking full name
	function full_name_check($str) {
		$first = $last = '';
		// split on spaces to make sure there are at least 2 names
		list($first,$last) = $this->split_name($str);

		// ensure each name is at least 2 characters long
		if (strlen($first) < 2 || strlen($last) < 2) {
			//$this->form_validation->set_message('full_name_check', 'Your full name is required.');
			return FALSE;
		}
		else
			return TRUE;
	}



	/**
	 * split a full name into first and last names
	 *
	 * @param int length			length of generated random string
	 * @param string chars			string containing list of useable characters
	 */
	function split_name($str) {
		$first = $last = '';
		$str= preg_replace('/\s+/',' ',trim($str));
		$names = explode(' ',$str);

		$first = implode(' ',array_slice($names, 0, -1));
		$last = $names[sizeof($names) - 1];
		return array($first,$last);
	}

	
}
