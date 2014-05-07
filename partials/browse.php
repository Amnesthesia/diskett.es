<?php
	require_once(PATH."/lib/showClass.php");

	// ?p is pagination-multiplier. 1 means second page, i.e 1*DEFAULT_LIST_SIZE, etc
	if(isset($_GET["p"]))
		$pagination = $_GET['p']*DEFAULT_LIST_SIZE;
	else
		$pagination = 0;

	$showList = Show::getList($pagination);
?>
	<div class="row">

<?php
	$count = 0;
	
	foreach($showList as $item):
		$count++;
?>
	

	<?php
	$imageFile = (file_exists('media/posters/' . $item->getAttribute("poster")) ? 'media/posters/' . $item->getAttribute("poster") : 'assets/img/placeholder.png');	
	?>

	<div class="small-3 columns browse-list browse-item overlay-trigger" id="<?php echo $item->getAttribute("id");?>">
		<a href="?page=details&amp;id=<?php echo $item->getAttribute("id");?>" title="<?php echo $item->getAttribute("name"); ?>">
			<img src="<?php echo $imageFile ?>" alt="<?php echo $imageFile ?>" />
		</a>
		<a href="#" title="<?php echo $item->getAttribute("name"); ?>">
			<h5><?php echo $item->getAttribute("name"); ?></h5>
		</a>
		<div class="grid-list-overlay">
			<fieldset class="list-item-summary">
				<label class="title"><?php echo $item->getAttribute("name"); ?></label>
				<div class="star" style="width: <?php echo $item->getAttribute("rating")*16; ?>px;">&nbsp;</div>
				<label><?php echo $item->getAttribute("summary"); ?></label>
				

			</fieldset>
		</div>
	</div>

<?php endforeach; ?>
