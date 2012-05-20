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


class Logout extends Base {


    function __construct() {
        parent::__construct();
        $this->load->model('Account_model');
	}
	
	
	function index() {
		$this->Account_model->logout();
		redirect(base_url());
	}

	
}
