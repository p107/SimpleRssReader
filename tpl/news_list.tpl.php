<ul>
<?php foreach ($items as $item) { ?>
	<li>
		<a href="<?php echo $item->link; ?>"><?php echo $item->title; ?></a>
		<div><?php echo $item->description; ?></div>
	</li>
<?php } ?>
</ul>