<?=$this->load->view('scaffolding/header')?>

<div>
	<h1 style="color:#666; margin:10px 30px;">All Problems</h1>
	<?php if ($problems_count) { ?>
	<ul class="navList problems">
		<?php foreach ($problems AS $p) { ?>
		<li class="problem navListItem">
			<a href="index.php/problem/<?=$p->id?>/profile">
				<span class="name"><?=$p->name?></span>
				<span class="topic pull-right"><?=$p->topic?></span>
			</a>
		</li>
		<?php } ?>
	</ul>
	<?php } ?>
</div>




<?=$this->load->view('scaffolding/footer')?>