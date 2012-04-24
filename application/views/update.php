<div class="updateInfo">
	<h3>Update your info</h3>

	<?php echo form_open('user/update_info'); ?>

	<label for="firstName">First</label>
	<?php echo form_input(array(
			'id' => 'firstName',
			'name' => 'firstName',
			'required' => '',
			'value' => set_value('firstName', $user->firstName)
		));
	?>
	<label for="lastName">Last</label>
	<?php echo form_input(array(
			'id' => 'lastName',
			'name' => 'lastName',
			'required' => '',
			'value' => set_value('lastName', $user->lastName)
		));
	?>
	<label for="email">Email</label>
	<?php echo form_input(array(
			'id' => 'email',
			'name' => 'email',
			'disabled' => '',
			'required' => '',
			'value' => set_value('email', $user->email)
		));
	?>
	<label for="phone">Phone</label>
	<?php echo form_input(array(
			'id' => 'phone',
			'name' => 'phone',
			'required' => '',
			'type' => 'tel',
			'value' => set_value('phone', $user->phone)
		));

		echo form_submit('submit', 'Update');
		echo form_close();
	?>
</div>
