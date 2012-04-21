<table>
	<thead>
		<tr>
			<?php
				foreach ($table['headings'] as $t) {
					echo '<th>' . $t . '</th>';
				}
			?>
		</tr>
	</thead>
	<tbody>
		<?php
			foreach ($table['data'] as $row) {
				$uid = $row['user'];
				echo '<tr class="edit_r" id="' . $uid . '">';
				foreach ($row as $day => $r) {
					if (!is_array($r)) {
						echo '<td><span class="user_id ' . $uid . '">' . $row['user'] . '</span>';
						echo '<a class="save_schedule">Save</a>';
					} else {
						$start = date('g A', strtotime($r['start']));
						$end = date('g A', strtotime($r['end']));
						echo '<td><span class="row_' . $uid . '">' . $start . ' - ' . $end . '</span>';
						echo '<div class="hide_input row_input_' . $uid . '">';
						echo '<select data-user-id="' . $uid . '" data-day="' . $day . '" data-when="start" class="selector">';
						foreach ($table['times'] as $t) {
							if ($start == $t) {// start time
								echo '<option selected="selected" value="' . $t . '">' . $t . '</option>';
							} else {
								echo '<option value="' . $t . '">' . $t . '</option>';
							}

						}
						echo '</select>';

						echo ' - ';
						echo '<select data-user-id="' . $uid . '" data-day="' . $day . '" data-when="end" class="selector">';
						foreach ($table['times'] as $t) {
							if ($end == $t) {
								echo '<option selected="selected" value="' . $t . '">' . $t . '</option>';
							} else {
								echo '<option value="' . $t . '">' . $t . '</option>';
							}
							// end time
						}
						echo '</select>';
						echo '</div>';

						echo '</td>';
					}

				}
				echo '</tr>';
			}
		?>
	</tbody>
</table>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" charset="utf-8">
	$('tr:odd').css('background-color', '#e3e3e3');
	$('tr:even').css('background-color', '#FEBC11');

	$('.edit_r').css('cursor', 'pointer');
	$('.edit_r').click(function() {
		var ID = $(this).attr('id');
		$('.row_' + ID).hide();
		$('.save_schedule').show();
		$('.row_input_' + ID).show();
		$('.save_schedule').css('display', 'block');
	});

	$('.selector').change(function() {
		var updates = new Array();
		var properties = new Array();

		properties.push($(this).attr('data-user-id'));
		properties.push($(this).attr('data-day'));
		properties.push($(this).attr('data-when'));
		properties.push($(this).val());
		// [12, Tuesday, end, 8 AM]
		var data = {
			'user_id' : properties[0],
			'day_of_week' : properties[1],
			'when' : properties[2],
			'time' : properties[3]
		};

		updates.push(data);

		$('.save_schedule').click(function() {

			$.ajax({
				url: "<?php echo site_url('admin/update_schedule'); ?>",
				data: updates[0],
				type: 'POST',
				success: function(msg) {
					
				}
			});
		});

	});


</script>
