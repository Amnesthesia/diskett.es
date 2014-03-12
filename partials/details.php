<?php
	require_once("lib/showClass.php");
	require_once("lib/episodeClass.php");

	// ?p is pagination-multiplier. 1 means second page, i.e 1*DEFAULT_LIST_SIZE, etc
	if(isset($_GET["p"]))
		$pagination = $_GET['p']*DEFAULT_LIST_SIZE;
	else
		$pagination = 0;

	if(!isset($_GET['id']))
		die();

	$id = $_GET['id'];

	$show = new Show($id);
	$episodes = $show->getChildren("Episode");

	// Add one empty row because I'm too lazy to add padding to the CSS, deal with it
?>
	<div class="row">&nbsp;</div>
	<div class="row">
		<div class="large-4 columns">
			<img src="<?php echo strstr($show->getAttribute("banner_url"),".png") ? $show->getAttribute("banner_url") : 'assets/img/placeholder.png'; ?>" />
		</div>
		<div class="large-8 columns">
			<div class="row">
				<div class="large-8 columns">
					<h1><?php echo $show->getAttribute("name"); ?></h1>
				</div>
			</div>
			<div class="row">
				<div class="large-8 columns">
					<div class="progress">
						<span class="meter" style="width: <?php echo $show->getAttribute("rating")*10; ?>%;">
							
						</span>

					</div>
				</div>
			</div>
			<div class="row">
				<div class="large-8 columns">
					<p><?php echo $show->getAttribute("summary"); ?></p>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="large-4 columns">
			<ul class="inline-list">
			
			</ul>
		</div>
	</div>
	<div class="row">&nbsp;</div>
	<div class="row">&nbsp;</div>
	<div class="row">
		<div class="large-12 columns">
			<table class="episode-table">
				<tr>
					<th>Season</th>
					<th>Episode</th>
					<th width="250">Title</th>
					<th width="450">Summary</th>
					<?php
						/**
						 * @todo This column should only be for logged in users
						**/
					
					?>
					<th>Watched</th>
				</tr>
				<?php foreach($episodes as $episode): ?>
				<?php 	$object = new Episode($episode); ?>
				<tr>
					<td class="text-center"><?php echo $object->getAttribute("season"); ?></td>
					<td class="text-center"><?php echo $object->getAttribute("episode"); ?></td>
					<td><?php echo $object->getAttribute("name"); ?></td>
					<td><?php echo $object->getAttribute("summary"); ?></td>

					<?php
						/**
						 * @todo This column should only be for logged in users
						**/

					?>
					<td class="text-center">
						<input type="checkbox" class="watched" id="<?php echo $show->getAttribute("id")."-".$object->getAttribute("season")."-".$object->getAttribute("episode");?>" />
					</td>
				</tr>
				<?php endforeach; ?>
			</table>
		</div>
	</div>