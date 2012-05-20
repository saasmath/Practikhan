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


class Dashboard extends Base {


    function __construct() {
        parent::__construct();
	}
	
	
	function index() {
		// get templates
		$this->page_data['templates'] = false;

		// get quizzes
		

		$this->load->view('dashboard', $this->page_data);	
	}
	

}
