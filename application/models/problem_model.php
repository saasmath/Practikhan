<?php
/**
 *
 *
 * @package		ThinkBinder
 * @author		David Lee
 * @copyright	Copyright (c) 2012 ThinkBinder LLC
 * @license		All Rights Reserved.
 * @link		http://thinkbinder.com
 * @since		Version 0.1
 * 
 */

include_once (realpath(dirname(__FILE__) . "/" . "practikhan_model.php"));


class Problem_model extends Practikhan_model {
	
	
	function __construct() {
        parent::__construct();
    }
	

	function create($user, $name, $info, $topic, $vars, $question, $solutions, $choices=NULL, $hints=NULL) {		
		$data = array(
			'name'		=> $name,
			'info'		=> $info,
			'topic'		=> $topic,
			'vars'		=> $vars,
			'question'	=> $question,
			'solution'	=> $solutions,
			'choices'	=> $choices,
      	    'hints'		=> $hints,
      	    'created'	=> date('Y-m-d H:i:s'),
      	    'user'		=> $user
		);
        $this->db->insert('problem', $data);
        $id = $this->db->insert_id();

        if (!$id) return FALSE;

        return $id;
	}
	
	
	

	
		
}

