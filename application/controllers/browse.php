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


class Browse extends Base {


    function __construct() {
        parent::__construct();
	}
	
	
	function index() {
		// get problems
		$problems = $this->practikhan_model->get('problem');
		$this->page_data['problems'] = $problems;
		$this->page_data['problems_count'] = (empty($problems) ? 0 : count($problems));
		
		$this->load->view('browse', $this->page_data);
	}


}
