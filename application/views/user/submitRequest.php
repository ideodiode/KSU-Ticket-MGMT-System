<div class="request">
	<?php
		echo form_open('user/submit_request');
	?>
	<p>
		<?php
			echo form_input(array(
				'id' => 'location',
				'name' => 'location',
				'placeholder' => '',
				'value' => set_value('location', ''),
				'required' => ''
			));
		?>

		<label for="location">Location</label>
	</p>
	<p>
		<?php
			echo form_textarea(array(
				'name' => 'description',
				'id' => 'description',
				'min_height' => '300px',
				'placeholder' => 'Description of the issue',
				'value' => set_value('description', ''),
				'required' => ''
			));
		?>
	</p>
	<p>
		<?php
			$options = array();
			foreach ($specs as $s) {
				$options[$s->speciality_id] = $s->name;
			}
			echo form_dropdown('speciality', $options);
		?>
		<label>Type of issue</label>
	</p>
	<?php
		echo form_submit('submit', 'Submit Request');
		echo form_close();
	?>

	<?php
		echo validation_errors();
	?>
</div>