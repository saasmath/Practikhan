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


class Exercise extends Base {


    function __construct() {
        parent::__construct();
        $this->load->model('Exercise_model');
	}


	function subscribe() {
		
	}


	function build() {		
		$submitted = $this->input->post('submitted');

		$this->page_data['values'] = array(
			'name'		=> '',
			'info'		=> '',
			'topic'		=> '',
			'vars'		=> '',
			'dataensure'=> '',
			'problem'	=> '',
			'question'	=> '',
			'solution'	=> '',
			'dataforms'	=> '',
			'datatype'	=> '',
			'choices'	=> '',
			'hints'		=> ''
		);

		if (!$submitted) {
			$this->load->view('exercise/build', $this->page_data);
			return;
		}

		$uid = $this->person_data['uid'];
		$name = $this->input->post('name');
		$info = $this->input->post('info');
		$topic = $this->input->post('topic');

		$vars = $this->input->post('vars');
		$dataensure = $this->input->post('dataensure');
		$problem = $this->input->post('problem');
		$question = $this->input->post('question');
		$choices = $this->input->post('choices');
		$solution = $this->input->post('solution');
		$dataforms = $this->input->post('dataforms');
		$datatype = $this->input->post('datatype');
		$hints = $this->input->post('hints');
		
		$this->page_data['values'] = array(
			'name'		=> $name,
			'info'		=> $info,
			'topic'		=> $topic,
			'vars'		=> $vars,
			'dataensure'		=> $dataensure,
			'problem'	=> $problem,
			'question'	=> $question,
			'solution'	=> $solution,
			'dataforms'	=> $dataforms,
			'datatype'	=> $datatype,
			'choices'	=> $choices,
			'hints'		=> $hints
		);

		if (!$this->v->run($name,'string')) {
			$this->page_data['errors'] = 'please include a name';				
			$this->load->view('exercise/build', $this->page_data);
			return;
		}

		if (!$this->v->run($info,'string')) {
			$this->page_data['errors'] = 'please include a description';				
			$this->load->view('exercise/build', $this->page_data);
			return;
		}

		if (!$this->v->run($topic,'string')) {
			$this->page_data['errors'] = 'Please select a topic';				
			$this->load->view('exercise/build', $this->page_data);
			return;
		}


		if (!$vars) {
			$this->page_data['errors'] = 'vars definition required';				
			$this->load->view('exercise/build', $this->page_data);
			return;
		}
		if (!$question) {
			$this->page_data['errors'] = 'question definition required';				
			$this->load->view('exercise/build', $this->page_data);
			return;
		}
		if (!$solution) {
			$this->page_data['errors'] = 'question definition required';				
			$this->load->view('exercise/build', $this->page_data);
			return;
		}

		$exercise = $this->Exercise_model->create($uid,
												$name, 
												$info, 
												$topic, 
												$vars,
												$dataensure,
												$problem,
												$question, 
												$solution, 
												$dataforms,
												$datatype,
												$choices, 
												$hints);

		if (!$exercise) {
			$this->page_data['errors'] = 'There was an error on our servers, please try again';				
			$this->load->view('exercise/build', $this->page_data);
			return;
		}

		// login successful, redirect to home page
		redirect(base_url()."index.php/exercise/$exercise/profile");
	}




	function profile() {
		$id = $this->uri->segment(2);

		$exercise = $this->Exercise_model->getOne('exercise', array('id'=>$id));
		if (!$exercise) {
			$this->page_data['errors'] = 'Question not found';				
			$this->load->view('exercise/profile', $this->page_data);
			return;
		}

		if (!preg_match('/<div\s+class="vars"\s/', $exercise->vars)) {
			$exercise->vars = '<div class="vars">'.$exercise->vars.'</div>';
		}
		if (!preg_match('/<div\s+class="question"\s/', $exercise->question)) {
			$exercise->question = '<div class="question">'.$exercise->question.'</div>';
		}
		if (!preg_match('/<div\s+class="solution"\s/', $exercise->solution)) {
			$exercise->solution = '<div class="solution">'.$exercise->solution.'</div>';
		}

		// if (!preg_match('/<div\s+class="problem"\s/', $exercise->problem)) {
		// 	$exercise->problem = '<div class="problem">'.$exercise->problem.'</div>';
		// }
		if (!preg_match('/<div\s+class="choices"\s/', $exercise->choices)) {
			$exercise->choices = '<div class="choices">'.$exercise->choices.'</div>';
		}
		if (!preg_match('/<div\s+class="hints"\s/', $exercise->hints)) {
			$exercise->hints = '<div class="hints">'.$exercise->hints.'</div>';
		}

		$this->page_data['exercise'] = $exercise;
		$this->page_data['subscribed'] = 0;
		$this->page_data['loadkhan'] = 1;
		
		$this->load->view('exercise/profile', $this->page_data);
	}




	function controlpanel() {
		
	}
	
	
}
