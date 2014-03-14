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
	<?php if($count % 11 == 0): ?>
	</div>
	<div class="row">
	<?php endif; ?>

	<?php
	$imageFile = (file_exists('media/posters/' . $item->getAttribute("poster")) ? 'media/posters/' . $item->getAttribute("poster") : 'assets/img/placeholder.png');	
	?>

	<div class="small-3 columns browse-list">
		<a href="?page=details&amp;id=<?php echo $item->getAttribute("id");?>" title="<?php echo $item->getAttribute("name"); ?>">
			<img src="<?php echo $imageFile ?>" />
		</a>
		<a href="#" title="<?php echo $item->getAttribute("name"); ?>">
			<h5><?php echo $item->getAttribute("name"); ?></h5>
		</a>
	</div>

<?php endforeach; ?>
