<?=$this->load->view('scaffolding/header')?>


<div class="dashboard">
	<div class="dashboard-left">
		
		<a href="index.php/quiz/build" class="btn btn-info dashboard-btn">Create New Quiz</a>
		<div>
			<h1 class="dashboardTitle">Your Quizzes</h1>
			<?php if ($quizzes_count) { ?>
			<ul class="navList quizzes">
				<?php foreach ($quizzes AS $q) { ?>
				<li class="quiz navListItem">
					
				</li>
				<?php } ?>
			</ul>
			<?php } ?>
		</div>

		<div style="margin-top:60px;"></div>
		<a href="index.php/exercise/build" class="btn btn-info dashboard-btn">Create New Exercise</a>
		<div>
			<h1 class="dashboardTitle">Your Exercises</h1>
			<?php if ($exercises_count) { ?>
			<ul class="navList exercises">
				<?php foreach ($exercises AS $e) { ?>
				<li class="exercise navListItem">
					<a href="index.php/exercise/<?=$e->id?>/profile">
						<span class="name"><?=$e->name?></span>
						<span class="topic pull-right"><?=$e->topic?></span>
					</a>
				</li>
				<?php } ?>
			</ul>
			<?php } ?>
		</div>
	</div>

	<div class="dashboard-right">
		<div>
			<div class="span3">
				<h3 class="dashboardUsername"><?=$person_data['firstname']?> <?=$person_data['lastname']?></h3>
				<p class="dashboardEmail"><?=$person_data['email']?></p>
				<hr>
				<p class="dashboardStat">
					<strong><?=$quizzes_count?></strong> quizzes
					&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
					<strong><?=$exercises_count?></strong> problems
				</p>
			</div>
		</div>
	</div>

</div>



<?=$this->load->view('scaffolding/footer')?>