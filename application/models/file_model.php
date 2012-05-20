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
include_once (realpath(dirname(__FILE__) . "/" . "tb_model.php"));

class File_model extends Tb_model {


	function __construct() {
        parent::__construct();
    }

	
	function addFile($uid,$name,$ext,$filepath,$type,$size,$is_image) {
		$data = array(
		   'user' => $uid,
		   'name' => $name,
		   'ext' => $ext,
		   'filepath' => $filepath,
		   'type' => $type,
		   'size' => $size,
		   'image' => $is_image,
		   'created' => date('Y-m-d H:i:s')
		);
		$this->db->insert('file', $data);
		return $this->db->insert_id();
	}
	
	
	
	
	function remove($fid) {
		$file = $this->getOne('file', array('id'=>$fid));
		if (!$file) return;

		$post = $this->getOne('postings', array('file'=>$fid));
		if ($post) $this->deletePost($post->id);
		
		$this->db->where('id', $fid)->delete('file');
		
		if ($post) return $post;
		else return 0;
	}




	/**
	 * permanently delete a post/response
	 *
	 * @param int post_id			id of post
	 */
	function deletePost($id) {
		$post = $this->getOne('postings', array('id'=>$id));
		if (!$post) return;
		
		if ($post->id == $post->thread) {
			// remove responses of this post
			$responses = $this->get('responses', array('thread'=>$id));
			if (!empty($responses)) {
				foreach ($responses AS $response) {
					$this->deletePost($response->id);
				}
			}
			$post = $this->getOne('postings', array('id'=>$id));
		}
		else {
			$sql = "UPDATE post SET responses = responses-1 WHERE id = $post->thread";
			$query = $this->db->query($sql);
		}
		
		// remove file + wb
		if ($post->file) {
			$this->db->where('file', $post->file)->delete('revision');
			$this->db->where('id', $post->file)->delete('file');
		}

		// remove flags + stars
		$this->db->where('post', $id)->delete('star');
		$this->db->where('post', $id)->delete('flag');
		// delete watchlist items
		$this->db->where('thread', $id)->delete('watchlist');
		// delete post
		$this->db->where('id', $id)->delete('post');
	}
}