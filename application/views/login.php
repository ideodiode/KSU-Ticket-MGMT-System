<div class="loginRegister">
	<div class="login">
		<h1>Login</h1>
		<?php echo form_open('login/validate'); ?>

		<label for="email">Email</label>
		<?php echo form_input(array(
				'name' => 'email',
				'id' => 'email',
				'required' => '',
				'autofocus' => '',
				'value' => set_value('email', '')
			));
		?>
		<label for="passowrd">Password</label>
		<?php echo form_password(array(
				'name' => 'password',
				'id' => 'password',
				'required' => ''
			));
		?>

		<?php echo form_submit('login/submit', 'Login'); ?>
		</fieldset>
		<?php echo form_close(); ?>
	</div>
	<div class="register">
		<h1>Register</h1>
		<?php echo form_open('login/signup'); ?>
		<label for="firstName">First Name</label>
		<?php echo form_input(array(
				'name' => 'firstName',
				'placeholder' => '',
				'value' => set_value('firstName', ''),
				'id' => 'firstName',
				'required' => ''
			));
		?>
		<label for="lastName">Last Name</label>
		<?php
			echo form_input(array(
				'name' => 'lastName',
				'placeholder' => '',
				'value' => set_value('lastName', ''),
				'id' => 'lastName',
				'required' => ''
			));
		?>
		<label for="email">Email Address</label>
		<?php
			echo form_input(array(
				'name' => 'email',
				'placeholder' => '',
				'value' => set_value('email', ''),
				'id' => 'email',
				'required' => '',
				'type' => 'email'
			));
		?>

		<label for="phoneNumber">Phone</label>
		<?php
			echo form_input(array(
				'name' => 'phoneNumber',
				'placeholder' => '',
				'maxLength' => '15',
				'value' => set_value('phoneNumber', ''),
				'id' => 'phoneNumber',
				'type' => 'tel'
			));
		?>
		<label for="password">Password</label>
		<?php
			echo form_password(array(
				'name' => 'password',
				'placeholder' => ''
			));
		?>
		<label for="password1">Confirm</label>
		<?php
			echo form_password(array(
				'name' => 'password1',
				'placeholder' => ''
			));
		?>
		<?php
			echo form_submit('submit', 'Register');
			echo form_close();
		?>
	</div>

</div>
<div class="regError">
	<?php
		if (isset($errors)) {
			echo $errors;

		}
	?>
</div>
<div class="emailSent">
	<?php
		if ($this->session->flashdata('email') != '') {
			echo $this->session->flashdata('email');
		}
	?>
</div>

