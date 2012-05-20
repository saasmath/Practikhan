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


class Problem extends Base {


    function __construct() {
        parent::__construct();
        $this->load->model('Problem_model');
	}


	function subscribe() {
		
	}


	function build() {		
		$submitted = $this->input->post('submitted');

		if (!$submitted) {
			$this->load->view('problem/build', $this->page_data);
			return;
		}

		$uid = $this->person_data['uid'];
		$name = $this->input->post('name');
		$info = $this->input->post('info');
		$topic = $this->input->post('topic');

		$vars = $this->input->post('vars');
		$question = $this->input->post('question');
		$choices = $this->input->post('choices');
		$solution = $this->input->post('solution');
		$hints = $this->input->post('hints');
		
		$this->page_data['values'] = array(
			'name'		=> $name,
			'info'		=> $info,
			'topic'		=> $topic,
			'vars'		=> $vars,
			'question'	=> $question,
			'solution'	=> $solution,
			'choices'	=> $choices,
			'hints'		=> $hints
		);

		if (!$this->v->run($name,'string')) {
			$this->page_data['errors'] = 'please include a name';				
			$this->load->view('problem/build', $this->page_data);
			return;
		}

		if (!$this->v->run($info,'string')) {
			$this->page_data['errors'] = 'please include a description';				
			$this->load->view('problem/build', $this->page_data);
			return;
		}

		if (!$this->v->run($topic,'string')) {
			$this->page_data['errors'] = 'Please select a topic';				
			$this->load->view('problem/build', $this->page_data);
			return;
		}


		if (!$vars) {
			$this->page_data['errors'] = 'vars definition required';				
			$this->load->view('problem/build', $this->page_data);
			return;
		}
		if (!$question) {
			$this->page_data['errors'] = 'question definition required';				
			$this->load->view('problem/build', $this->page_data);
			return;
		}
		if (!$solution) {
			$this->page_data['errors'] = 'question definition required';				
			$this->load->view('problem/build', $this->page_data);
			return;
		}

		$problem = $this->Problem_model->create($uid,
												$name, 
												$info, 
												$topic, 
												$vars, 
												$question, 
												$solution, 
												$choices, 
												$hints);

		if (!$problem) {
			$this->page_data['errors'] = 'There was an error on our servers, please try again';				
			$this->load->view('problem/build', $this->page_data);
			return;
		}

		// login successful, redirect to home page
		redirect(base_url()."index.php/problem/$problem/profile");
	}


	function profile() {
		$id = $this->uri->segment(2);

		$problem = $this->Problem_model->getOne('problem', array('id'=>$id));
		if (!$problem) {
			$this->page_data['errors'] = 'Question not found';				
			$this->load->view('problem/profile', $this->page_data);
			return;
		}
		$this->page_data['problem'] = $problem;
		$this->page_data['subscribed'] = 0;
		
		$this->load->view('problem/profile', $this->page_data);
	}


	function controlpanel() {
		
	}
	
	
}
