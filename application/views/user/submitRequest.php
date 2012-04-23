<div class="submitRequest">
	<?php
	echo form_open('user/submit_request');
	?>
	<table cellpadding="10">
		<tr>
			<td>Location</td>
			<td><?php
			echo form_input(array(
				'name' => 'location',
				'placeholder' => '',
				'value' => set_value('location', '')
			));
			?></td>
		</tr>
		<tr>
			<td>Description</td>
			<td><?php
			echo form_textarea(array(
				'name' => 'description',
				'placeholder' => '',
				'value' => set_value('description', '')
			));
			?></td>
		</tr>
		<tr>
			<td></td>
			<td><?php
			echo form_submit('submit', 'Submit Request');
			echo form_close();
			?></td>
		</tr>
	</table>
	<?php
	echo validation_errors();
	?>
</div>