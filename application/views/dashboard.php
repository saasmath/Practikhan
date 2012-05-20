<?=$this->load->view('scaffolding/header')?>


<div class="dashboard">
	<div class="dashboard-left">
		
		<a href="index.php/quiz/build" class="btn btn-info dashboard-btn">Create New Quiz</a>
		<a href="index.php/problem/build" class="btn btn-info dashboard-btn">Create New Problem</a>

		<div class="dashboard-col dashboard-col-left">
			<h1>Your Quizzes</h1>
			
		</div>

		<div class="dashboard-col dashboard-col-right">
			<h1>Your Templates</h1>
			
		</div>
	</div>

	<div class="dashboard-right">
		
	</div>

</div>



<?=$this->load->view('scaffolding/footer')?>