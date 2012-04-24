<div class="schedule">
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
							$tech = $this->user_model->get_info_from_id($r);
							$name = $tech->firstName . ' ' . $tech->lastName;
							if (strlen($name) > 10) {
								$name = substr($name, 0, 7) . '...';
							}
							echo '<td><span class="user_id ' . $uid . '">' . $name . '</span>';
							echo '<span class="schedule block"><a class="save_schedule hidden" data-user-id="' . $uid . '">Save</a></span>';
							echo '<span class="schedule block"><a class="cancel_save hidden" data-user-id="' . $uid . '">Cancel</a></span>';
						} else {
							$start = date('g A', strtotime($r['start']));
							$end = date('g A', strtotime($r['end']));
							echo '<td class="' . $day . '"><span class="row_' . $uid . '">' . $start . ' - ' . $end . '</span>';
							echo '<div class="hidden row_input_' . $uid . '">';
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
</div>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" charset="utf-8">
	$('tr:odd').css('background-color', '#e3e3e3');
	$('tr:even').css('background-color', '#FEBC11');
	$('.edit_r').css('cursor', 'pointer');

	$('.edit_r').one("click", function() {
		var ID = $(this).attr('id');
		$('.row_' + ID).toggle();
		$('.row_input_' + ID).toggle();
		$(this).find('.save_schedule').toggle().css('cursor', 'pointer');
		$(this).find('.cancel_save').toggle().css('cursor', 'pointer');
		$(this).css('cursor', 'default');
		$(this).find('td:first').find('span.user_id').css('text-decoration','underline');
	});

	$('.cancel_save').click(function() {
		var id = $(this).attr('data-user-id');
		$(this).parents('tr').find('.hidden').toggle();
		$(this).parents('tr').find('.row_' + id).toggle();
	});

	$('.save_schedule').click(function() {
		var id = $(this).attr('data-user-id');
		var schedule = new Array();
		$('.selector').each(function() {
			var data = {
				"user_id" : $(this).attr('data-user-id'),
				"day_of_week" : $(this).attr('data-day'),
				"when" : $(this).attr('data-when'),
				"time" : $(this).val()
			};
			schedule.push(data);
		});
		//@formatter:off
		$.ajax({
			url: "<?php echo site_url('admin/update_schedule'); ?>",
			data: {schedule: schedule},
			type: 'POST',
			success: function(html) {$('body').html(html)},
			error: function() {}
		});
		//@formatter:on
		

	});
</script>

