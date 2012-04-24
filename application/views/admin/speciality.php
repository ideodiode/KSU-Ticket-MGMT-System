<div class="spec">
	<div class="add">
		<h3>Add a speciality</h3>

		<?php echo form_open('admin/speciality_add'); ?>
		<label for="name">Name</label>
		<?php
			echo form_input(array(
				'name' => 'name',
				'class' => 'block',
				'id' => 'name',
				'required' => '',
				'autofocus' => ''
			));
		?>
		<label for="desc">Description</label>
		<?php
			echo form_input(array(
				'name' => 'desc',
				'class' => 'block',
				'id' => 'desc',
				'required' => ''
			));
			echo form_submit('add', 'Add');
			echo form_close();
		?>
	</div>

	<div class="delete">
		<h3>Delete specialities</h3>
		<?php
			echo form_open('admin/spec_delete');
			foreach ($specialities as $spec) {
				$values = array(
					'value' => $spec->speciality_id,
					'id' => $spec->speciality_id,
					'name' => 'specs[]'
					);
				echo form_checkbox($values); ?>
		<label for="<?php echo $spec->speciality_id; ?>"><?php echo $spec->name; ?></label>
		<br>
		<?php }
			echo form_submit('delete','Delete selected');
			echo form_close();
		?>
	</div>

</div>
