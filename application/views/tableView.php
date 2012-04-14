<div>
	Found <?php echo $num_results . " " . $table;?>
</div>
<table class="dataDisplay">
	<thead>
		<?php foreach($fields as $field_name => $field_display):
		?>
		<th <?php if ($sort_by == $field_name) echo 'class="sort_'.$sort_order.'"' ?>><?php echo anchor($role . "/" . $table . "_table/$field_name/" . (($sort_order == 'asc' && $sort_by == $field_name) ? 'desc' : 'asc'), $field_display);?></th>
		<?php endforeach;?>
	</thead>
	<tbody>
		<?php foreach($results as $result):
		?>
		<tr>
			<?php foreach($fields as $field_name => $field_display):
			?>
			<td><?php echo $result->$field_name;?></td>
			<?php endforeach;?>
		</tr>
		<?php endforeach;?>
	</tbody>
</table>
<?php if (strlen($pagination)):
?>
<div>
	Pages: <?php echo $pagination;?>
</div>
<?php endif;?>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo base_url();?>/scripts/lightenDarken.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" charset="utf-8">
	// set the color for each row
	var col1 = '#e3e3e3';
	var col2 = '#FEBC11';
	
	//how much each row should change
	var changeAmount = -25;
	
	// odd rows get one color, even rows get another
	$('tr:odd').css('background', col1);	
	$('tr:even').css('background', col2);

	$('tr:odd').hover(function() {// when your mouse enters a row, darken the background. When it exits, restore the color
		$(this).css('background', LightenDarkenColor(col1, changeAmount));
	}, function() {
		$(this).css('background', col1);
	});
	$('tr:even').hover(function() {
		$(this).css('background', LightenDarkenColor(col2, changeAmount));
	}, function() {
		$(this).css('background', col2);
	});

</script>
