<?php
/**
 * ThinkBinder Javascript Library - v0.1 - April 2011
 *
 * binder.js
 *
 *
 * @package		ThinkBinder
 * @author		David Lee
 * @copyright	Copyright (c) 2011 ThinkBinder LLC
 * @license		All Rights Reserved.
 * @link		http://thinkbinder.com
 * @since		Version 0.1
 * 
 */

// ---------------------------------------------------------------------------
include_once (realpath(dirname(__FILE__) . "/" . "practikhan_model.php"));

class Account_model extends Practikhan_model {
	
	
	function __construct() {
        parent::__construct();
    }
	
	
	/*
	|--------------------------------------------------------------------------
	| Create a new user account
	|--------------------------------------------------------------------------
	|
	| will not check availability of username/email, assumes that has already
	| been done
	|
	| password argument must be UN-hashed
	|
	*/
	function create($first, $last, $email, $password, $role) {         
        $this->load->library('salty');
		
		$data = array(
			'first'		=> $first,
			'last'		=> $last,
			'email'		=> $email,
			'password'	=> $this->salty->generateHash($password),
      	    'created'   => date('Y-m-d H:i:s'),
      	    'picture'	=> 'http://djzv0pai73fmi.cloudfront.net/images/logos/badge.gray.png',
      	    'role'		=> $role
		);
        $this->db->insert('user', $data);
        $uid = $this->db->insert_id();

        if (!$uid) return FALSE;

        return $uid;
	}
	
	
	
	
	function updatePassword($uid, $pass) {
		$this->load->library('salty');

		$data = array(
			'password' => $this->salty->generateHash($pass)
		);
        $this->db->where('id',$uid)->update('user', $data);
		return TRUE;
	}
	
	
	

    function login($login_name, $password) {
        $this->load->library('salty');
        $user = $this->getUserByLogin($login_name);
        
        if ($user === FALSE) return FALSE;

        //alright, do the passwords match?
        if (! $this->salty->passwordsMatch($user->password, $password)) {
            return FALSE;
        }

		// make sure account is active AND verified
		if (!$user->active || !$user->verified) {
			
		}
		
		$this->updateLastVisitById($user->id);

        // we've got a live one! (storing session data)
        $data = array(
			'uid'		=> $user->id,
			'email'		=> $user->email,
			'firstname'	=> $user->first,
			'lastname'	=> $user->last,
			'role'		=> $user->role,
			'picture'	=> $user->picture,
			'logged_in'	=> TRUE
        );
        $this->session->set_userdata($data);
        return $user;
    }   




    function loginByID($uid) {
        $user = $this->getOne('user', array('id'=>$uid));
        
        if ($user === FALSE) return FALSE;

		// make sure account is active AND verified
		if (!$user->active || !$user->verified) {
			
		}

		$this->updateLastVisitById($user->id);

		// we've got a live one! (storing session data)
		$data = array(
			'uid'		=> $user->id,
			'email'		=> $user->email,
			'firstname'	=> $user->first,
			'lastname'	=> $user->last,
			'role'		=> $user->role,
			'picture'	=> $user->picture,
			'logged_in'	=> TRUE
		);
		$this->session->set_userdata($data);
		return $user;
    }   




   function checkLogin($login_name, $password) {
        $this->load->library('salty');
        $user = $this->getUserByLogin($login_name);
        
        if ($user === FALSE) return FALSE;

	    if ($this->salty->passwordsMatch($user->password,$password)) {
			return TRUE;
	    }
		
		return FALSE;
    }   




	function getUserByLogin($login_name) {
		$where = array(
			'email' => $login_name
		);
		return $this->getOne('user', $where);
	}
	


	
 	/*
	|--------------------------------------------------------------------------
	| Logout the user
	|--------------------------------------------------------------------------
	*/
   function logout() {
        $this->session->sess_destroy();
        return TRUE;
    }




 	/*
	|--------------------------------------------------------------------------
	| Utility Functions
	|--------------------------------------------------------------------------
	|
	*/	
	function isEmail($str) {
		$valid_email = '/\b[A-Za-z0-9][A-Za-z0-9._%+-]+@(?:[A-Za-z0-9-]+\.)+[A-Za-z]{2,4}\b/';
		
		if (preg_match($valid_email,$str)) {
			return TRUE;
		}
		else {
			return FALSE;
		}
    }
	
	
	
	
	/**
	 * get the initial set of posts for user's news feed (AJAX)
	 *
	 * @param int book_id			id of book (optional)
	 */
	function emailAvailable($str) {
        $query = $this->db->query('SELECT id FROM user WHERE email = ?', array($str));
        if($query->num_rows() > 0)
            return FALSE;
        else
            return TRUE;
	}
	
		
}

