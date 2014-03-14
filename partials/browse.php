<?php
	require_once("/lib/showClass.php");

	// ?p is pagination-multiplier. 1 means second page, i.e 1*DEFAULT_LIST_SIZE, etc
	if(isset($_GET["p"]))
		$pagination = $_GET['p']*DEFAULT_LIST_SIZE;
	else
		$pagination = 0;

	$showList = Show::getList($pagination);

	// Add one empty row because I'm too lazy to add padding to the CSS, deal with it
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
		/**
		 * @todo Change check for banner_url image to check for its EXISTENCE and not whether it contains .png -- this check is slow.
		**/
	?>

	<div class="small-3 columns browse-list">
		<a href="#" title="<?php echo $item->getAttribute("name"); ?>">
			<img src="media/posters/<?php echo strstr($item->getAttribute("poster"),".jpg") ? $item->getAttribute("poster") : 'assets/img/placeholder.jpg'; ?>" />
		</a>
		<a href="#" title="<?php echo $item->getAttribute("name"); ?>">
			<h5><?php echo $item->getAttribute("name"); ?></h5>
		</a>
	</div>

<?php endforeach; ?>
