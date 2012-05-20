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
		$uid = $this->person_data['uid'];

		// get problems
		$exercises = $this->practikhan_model->get('exercise', array('user'=>$uid));
		$this->page_data['exercises'] = $exercises;
		$this->page_data['exercises_count'] = (empty($exercise) ? 0 : count($exercise));

		// get quizzes
		$quizzes = $this->practikhan_model->get('quiz', array('user'=>$uid));
		$this->page_data['quizzes'] = $quizzes;
		$this->page_data['quizzes_count'] = (empty($quizzes) ? 0 : count($quizzes));
		

		$this->load->view('dashboard', $this->page_data);	
	}
	

}
