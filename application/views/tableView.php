<div>
	Found <?php echo $num_results . " " . $table;?>
</div>
<table class="dataDisplay">
	<thead>
		<?php foreach($fields as $field_name => $field_display):
		?>
		<th <?php if ($sort_by == $field_name) echo 'class="sort_'.$sort_order.'"' ?>>
			<?php echo anchor($role . "/" . $table . "_table/$field_name/" . (($sort_order == 'asc' && $sort_by == $field_name) ? 'desc' : 'asc'), $field_display);?>
		</th>
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
<script type="text/javascript" charset="utf-8">
	$('tr:odd').css('background', '#e3e3e3');
	$('tr:even').css('background', '#FEBC11');

</script>
