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


class Home extends Base {


    function __construct() {
        parent::__construct();
	}
	
	
	function index() {
		$this->load->view('home', $this->page_data);
	}
	

	function search() {
		
	}


	function browse() {
		
	}


}
