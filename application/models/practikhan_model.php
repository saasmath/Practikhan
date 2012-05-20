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

class Practikhan_model extends CI_Model {
	
	function __construct() {
        parent::__construct();
    }
	
	
	function getUser($id) {
		$this->db->select('id,first,last,post_count,response_count,star_count,pictureURL,history,watchlist,mail,invitation,fbID');
		$this->db->where("id",$id);
		$rez = $this->db->get('users');
		
        if ($rez->num_rows() > 0) {
            return $rez->row();
        } else {
            return FALSE;
        }
	}

	


	function updateLastVisitById($id) {
		$data = array('last_visit' => date("Y-m-d H:i:s"));
		$this->db->where('id', $id);
        $this->db->update('user', $data);
        return TRUE;
    }

	
	
	
	/******************************************************************************/
    /** UTILITIES *****************************************************************/
    //Return an array of elements
    function get($table,$where=NULL,$limit=NULL,$order=NULL,$groupBy=NULL) {
		if ($where) $this->db->where($where);
		
		if ($order) $this->db->order_by($order);
		
		if (is_array($limit)) $this->db->limit($limit[0], $limit[1]);
        elseif ($limit) $this->db->limit($limit);
		
		if ($groupBy) $this->db->group_by($groupBy);
        
		$query = $this->db->get($table);
        
        if ($query->num_rows() > 0) return $query->result();
        else return FALSE;
    }



    //return an object
    function getOne($table, $where=NULL, $order=NULL) {
		if ($where) $this->db->where($where);
		if ($order) $this->db->order_by($order);
		$this->db->limit(1);
		$query = $this->db->get($table);
        
        if ($query->num_rows() > 0) return $query->row();
        else return FALSE;
    }




    function getNum($table, $where=NULL) {
		if ($where) $this->db->where($where);
		return $this->db->count_all_results($table);
    }
	
	
	

	function update($table, $col, $val, $where) {
        $data = array(
            $col => $val
		);

		if (is_array($col)) {
			$data = $col;
			$where = $val;
		}

		if (is_array($where)) $this->db->where($where);
		else $this->db->where(array('id'=>$where));

		$this->db->update($table, $data);
	}



	function insert($table, $data) {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }


    
	function delete($table,$where) {
		$this->db->where($where)->delete($table);
	}
	
	
	
	
	function remove_item_by_value($array, $val = '', $preserve_keys = true) {
		if (empty($array) || !is_array($array)) return false;
		if (!in_array($val, $array)) return $array;
	
		foreach($array as $key => $value) {
			if ($value == $val) unset($array[$key]);
		}
	
		return ($preserve_keys === true) ? $array : array_values($array);
	}	
	


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


}

