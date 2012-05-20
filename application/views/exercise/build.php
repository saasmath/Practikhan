<?=$this->load->view('scaffolding/header')?>


<div class="builder">
	
	<div class="builderForm">
		<h1>Create a New Exercise</h1>

		<?php if (isset($errors)) { ?>
		<div class="alert alert-error"><?=$errors?></div>
		<?php } ?>

		<form class="well" action="index.php/problem/build" method="post">
			<input type="hidden" name="submitted" value="1">

			<div class="row">
				<div class="span6">
					<div class="inline-form">
						<label>Name</label>
						<input type="text" name="name" class="span4" value="<?=$values['name']?>">
					</div>
			
					<div class="inline-form">
						<label>Description</label>
						<input type="text" name="info" class="span4" value="<?=$values['info']?>">
					</div>
				</div>
				<div class="span5">
					<div class="inline-form">
						<label style="width:80px;">Topic</label>
						<select name="topic" id="problemTopic">
							<option value=""></option>
							<option value="Arithmetic">Arithmetic</option>
							<option value="Algebra">Algebra</option>
							<option value="Geometry">Geometry</option>
							<option value="Trigonometry">Trigonometry</option>
							<option value="Probability">Probability</option>
							<option value="Statistics">Statistics</option>
							<option value="Precalculus">Precalculus</option>
							<option value="Calculus">Calculus</option>
						</select>
					</div>
				</div>
			</div>
	
			<hr>

			<div class="row builderRow">
				<div class="span6">
					<label>Vars</label>
					<div class="codemirrorWrapper">
						<textarea class="span6" name="vars" id="builderVars" style="height:40px;"><?=$values['vars']?></textarea>
					</div>
				</div>
				<div class="span4">
					<label>&nbsp;</label>
					<div>
						<div class="clearfix">
							<label class="minor pull-left">data-ensure attribute</label>
							<a href="" style="margin-left:10px;">?</a>
						</div>
						<input type="text" name="dataensure">
					</div>
					<br>
					<p>
						Variables provide a way to introduce randomness into mathematical exercises.
					</p>
					<p>
						Variables are typically defined by using a <code>&lt;var&gt;...&lt;/var&gt;</code> element.
						Specify an ID for the var which you'll refer to in the future.
						The content of a <code>&lt;var&gt;...&lt;/var&gt;</code> block will be executed as JavaScript,
						with access to to all the properties and methods provided by the JavaScript Math object, 
						as well as all the properties and methods defined in the modules which you have included.
					</p>
					<p>
						<a href="">Learn more...</a>
					</p>
				</div>
			</div>

			<div class="row builderRow">
				<div class="span11">
					<label>Problem</label>
					<textarea class="span11" name="problem" id="builderProblem" style="height:40px; resize:none;"></textarea>
				</div>
			</div>

			<div class="row builderRow">
				<div class="span11">
					<label>Question</label>
					<textarea class="span11" name="question" id="builderQuestion"><?=$values['question']?></textarea>
				</div>
			</div>


			<div class="row builderRow">
				<div class="span6">
					<label>Solution</label>
					<!-- <div class="codemirrorWrapper"> -->
						<textarea class="span6" name="solution" id="builderSolution" style="resize:none;"><?=$values['solution']?></textarea>
					<!-- </div> -->
				</div>
				<div class="span5">
					<label>&nbsp;</label>
					<div>
						<label class="minor">data-forms <em>attribute</em></label>
						<input type="text" class="span4" name="dataforms">
					</div>
					<div>
						<label class="minor">data-type <em>attribute</em></label>
						<input type="text" class="span4" name="datatype">
					</div>
				</div>
			</div>
		
			<!-- <div class="row builderRow">
				<div class="span11">
		 			<label>Choices</label>
		 			<div class="codemirrorWrapper">
						<textarea class="span11" name="choices" id="builderChoices"><?=$values['choices']?></textarea>
					</div>
				</div>
			</div> -->

			<div class="row builderRow">
				<div class="span11">
					<label>Hints</label>
					<div class="codemirrorWrapper">
						<textarea class="span11" name="hints" id="builderHints"><?=$values['hints']?></textarea>						
					</div>
				</div>
			</div>

			<button id="buildExerciseBtn" type="submit" class="btn btn-primary">Submit</button>
			<button id="testExerciseBtn" type="submit" class="btn">Test exercise</button>
		</form>
	</div>
</div>




<?=$this->load->view('scaffolding/footer')?>