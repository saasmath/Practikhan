<?=$this->load->view('scaffolding/header')?>


<div>
	<div class="clearfix">
		<h1 class="problemName span6"><?=$problem->name?> - <?=$problem->topic?></h1>
		<?php if (!$subscribed) { ?>
		<a id="problemSubscribeBtn" class="btn btn-primary pull-right">Subscribe</a>
		<?php } ?>
	</div>
	<p class="problemInfo"><?=$problem->info?></p>


	<div id="problemDemo" class="problemDemo">
		
	</div>

	<div class="problemDemo">
		<div class="exercise">
			<div class="vars">
			  <?=$problem->vars?>
			</div>

			<div class="problems">
				<div id="problem-type-or-description">
					<!-- <p class="problem"></p> -->
					<div class="question"><?=$problem->question?></div>
					<div class="solution"><?=$problem->solution?></div>
				</div>
			</div>

			<div class="hints">
			  	<?=$problem->hints?>
			</div>
		</div>
	</div>


	<div class="problemSource">
		<div class="problemAttr">
			<label for="vars">Vars</label>
			<textarea id="problemVars"><?=$problem->vars?></textarea>
		</div>
		<div class="problemAttr">
			<label for="vars">Question</label>
			<textarea id="problemVars"><?=$problem->question?></textarea>
		</div>
		<div class="problemAttr">
			<label for="vars">Solution</label>
			<textarea id="problemVars"><?=$problem->solution?></textarea>
		</div>
		<div class="problemAttr">
			<label for="vars">Choices</label>
			<textarea id="problemVars"><?=$problem->choices?></textarea>
		</div>
		<div class="problemAttr">
			<label for="vars">Hints</label>
			<textarea id="problemVars"><?=$problem->hints?></textarea>
		</div>
	</div>
</div>


<?=$this->load->view('scaffolding/footer')?>