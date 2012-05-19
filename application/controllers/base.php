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
		#$this->output->set_header('Access-Control-Allow-Origin: http://thinkbinder.com');
		#$this->output->set_header('Access-Control-Allow-Methods: POST, GET');

		$is_ie8 = 0;
		$is_XP = 0;
		$this->load->library('user_agent');
		if (isset($this->agent)) {
			// are we dealing with an XP user?
		    $is_XP = (preg_match('/Windows XP/', $this->agent->platform()) ? 1 : 0);
			
			// redirect unsupported browsers to upgrade message
			$browser = $this->agent->browser();
			$version = intval($this->agent->version());
			if (preg_match('/explorer/i', $browser) && $version < 8) {
				redirect('unsupported');
				return;
			}
			
			$is_ie8 = (preg_match('/explorer/i', $browser) && $version == 8 ? 1 : 0);

			$this->page_data['browser'] = $browser;
		}
		$this->page_data['isXP'] = $is_XP;
		$this->page_data['is_ie8'] = $is_ie8;
		
		// the user is logged in, prep their basic information
		if (isset($this->session)) {
			if ($this->session->userdata('logged_in')) {
	            $this->person_data['id']				= $this->session->userdata('uid');
	            $this->person_data['uid']				= $this->session->userdata('uid');
	            $this->person_data['email']				= $this->session->userdata('email');
	            $this->person_data['name']				= $this->session->userdata('firstname').' '.$this->session->userdata('lastname');
	            $this->person_data['firstname']			= $this->session->userdata('firstname');
	            $this->person_data['lastname']			= $this->session->userdata('lastname');
				
	            $this->person_data['pictureURL']		= $this->session->userdata('pictureURL');
	            $this->person_data['pic']				= $this->session->userdata('pictureURL');

	            $this->person_data['fbID']				= $this->session->userdata('fbID');
	            $this->person_data['fbOAuthToken']		= $this->session->userdata('fbOAuthToken');

	            $this->person_data['notifyHistory']		= $this->session->userdata('notifyHistory');
	            $this->person_data['notifyWatchlist']	= $this->session->userdata('notifyWatchlist');
	            $this->person_data['notifyMail']		= $this->session->userdata('notifyMail');
	            $this->person_data['notifyInvitation']	= $this->session->userdata('notifyInvitation');
	            $this->person_data['notifyRequest']		= $this->session->userdata('notifyRequest');
				
	            $this->page_data['person_data']			= $this->person_data;
			}
		}
		
		// where are they trying to go?
        $unsecured_pages = array('login',
        						 'register',
        						 'forgot',
        						 'main',
        						 'verify',
        						 'gate',
        						 '',
        						 'funnel',
        						 'start',
        						 'join',
        						 'log',
        						 'invitation',
        						 'unsupported',
        						 'unsubscribe');
		
		if ($this->uri->segment(1) == 'bind') {

		}
		elseif ($this->uri->segment(1) == 'posted') {
			
		}
		elseif ($this->uri->segment(1) == 'invitation') {
			
		}
		elseif ($this->uri->segment(1) == 'unsubscribe') {
			
		}
		elseif ($this->uri->segment(1) == 'fb') {
			
		}
		elseif ($this->uri->segment(1) == 'logout') {
			
		}
		// requesting unsecured page
        elseif (in_array($this->uri->segment(1), $unsecured_pages)) {
			// logged in users get redirected to main application
            if ($this->session->userdata('logged_in') && $this->uri->segment(1) != 'funnel' 
                && $this->uri->segment(1) != 'join' && $this->uri->segment(1) != 'start')
            {
                
                redirect(base_url().'app');
            }
        }
		// not logged in + not going to public page, redirect to splash page
		elseif (isset($this->session)) {
			// this is a really bad XP specific hack
			// XP users seems to be getting stuck in the inner conditional
			// which doesn't make sense
			if (!$this->session->userdata('logged_in')) {
				if ($is_XP) {
            		//$this->addLog(null, 'XP user', 'flag');
				}
				elseif ($this->uri->segment(1) == 'app' && preg_match('/^\d+$/', $this->uri->segment(2))) {
            		$this->addLog(null,'nologin','app',$this->uri->segment(2),'fail');
					$this->session->set_flashdata('club', $this->uri->segment(2));
					redirect(base_url().'login');
					return;
				}
				
			    redirect(base_url());
			}
        }
        // we should only get here when showing error pages
        else {
        	
        }
	}
	


	
	/**
	 * creates a log entry
	 *
	 * @param int uid			user id
	 * @param string note		description of action
	 */
	function message($message,$status=0) {
		$result = array();
		$result['message'] = $message;
		$result['uid'] = ($this->session->userdata('logged_in') ? $this->person_data['id'] : 0);
		$data = json_encode(array('status' => $status,'result' => $result));
		$this->output->set_content_type('application/json')->set_output( $data );
	}
	
	
	
	
	/**
	 * creates a log entry
	 *
	 * @param int uid			user id
	 * @param string note		description of action
	 */
	function response($status,$result) {
		$result['uid'] = $this->person_data['id'];
		$data = json_encode(array('status' => $status,'result' => $result));
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




	/**
	 * creates a log entry
	 *
	 * @param int uid			user id
	 * @param string note		description of action
	 */
	function addVisit($uid, $club, $token) {
		$ip = $_SERVER['REMOTE_ADDR'];
		if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		}

		//$ip = $_SERVER['HTTP_X_FORWARDED_FOR']?$_SERVER['HTTP_X_FORWARDED_FOR']:$_SERVER['REMOTE_ADDR'];
		if(strpos($ip,',') !== false) {
			$ip = substr($ip,0,strpos($ip,','));
		}
		
		$this->load->library('user_agent');
		$data = array(
			'browser' => $this->agent->browser(),
			'version' => $this->agent->version(),
			'mobile' => $this->agent->mobile(),
			'platform' => $this->agent->platform(),
			'referrer' => $this->agent->referrer(),
			'ip' => $ip,
			'user' => $uid,
			'club' => $club,
			'created' => date('Y-m-d H:i:s'),
			'token' => $token
		);
		
		$this->load->model('Tb_model');
		$this->Tb_model->addVisit($data);
	}
	
	
	
	

	function in_club($uid, $cid) {
		$this->load->model('Tb_model');
		$mem = $this->Tb_model->getOne('membership', array('user'=>$uid, 'club'=>$cid));

		if ($mem) {
			switch ($mem->status) {
				case 'active':
					return true;
				case 'pending':
					return false;
				default:
					return false;
			}
		}

		return false;
	}
	



	function has_admin($cid) {
		$this->load->model('Tb_model');
		$members = $this->Tb_model->get('members', array('club'=>$cid));

		if (!empty($mem)) {
			foreach ($members AS $m) {
				if (!preg_match('/^\d+$/', $m->email) && $m->admin) {
					return TRUE;
				}
			}
		}

		return FALSE;
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
