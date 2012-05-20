<?=$this->load->view('scaffolding/header')?>


<div class="builder">
	
	<div class="builderForm">
		<h1>Create a New Problem</h1>

		<?php if (isset($errors)) { ?>
		<div class="alert alert-error"><?=$errors?></div>
		<?php } ?>
		<form class="well" action="problem/build" method="post">
			<input type="hidden" name="submitted" value="1">

			<div class="inline-form">
				<label>Name</label>
				<input type="text" name="name" class="span4" value="<?=$values['name']?>">
			</div>
	
			<div class="inline-form">
				<label>Description</label>
				<input type="text" name="info" class="span4" value="<?=$values['info']?>">
			</div>

			<div class="inline-form">
				<label>Topic</label>
				<select name="topic" id="problemTopic">
					<option value=""></option>
					<option value="Arithmetic">Arithmetic</option>
					<option value="Algebra">Algebra</option>
					<option value=""></option>
					<option value=""></option>
					<option value=""></option>
					<option value=""></option>
					<option value=""></option>
					<option value=""></option>
				</select>
			</div>

			<hr>

			<label>Vars</label>
			<textarea class="span6" name="vars"><?=$values['vars']?></textarea>

			<label>Question</label>
			<textarea class="span6" name="question"><?=$values['question']?></textarea>

 			<label>Choices</label>
			<textarea class="span6" name="choices"><?=$values['choices']?></textarea>

			<label>Solution</label>
			<textarea class="span6" name="solution"><?=$values['solution']?></textarea>

			<label>Hints</label>
			<textarea class="span6" name="hints"><?=$values['hints']?></textarea>

			<button type="submit" class="btn btn-primary">Submit</button>
		</form>
	</div>

	<div class="builderPreview">
		
	</div>
</div>




<?=$this->load->view('scaffolding/footer')?>