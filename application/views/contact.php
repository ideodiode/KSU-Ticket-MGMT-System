<h1>Contact us</h1>

<div class="contact">
	<?php
		if (isset($message)) {
			echo $message;
		}
		echo form_open('contact/send');
		if (isset($user)) {
			$name = $user->firstName . ' ' . $user->lastName;
			$email = $user->email;
		} else {
			$name = '';
			$email = '';
		}
	?>

	<p>
		<?php echo form_input(array(
			'name' => 'name',
			'id' => 'name',
			'required' => '',
			'autofocus' => '',
			'value' => $name
		));
		?><label for="name">Name</label>
	</p>

	<p>
		<?php echo form_input(array(
			'name' => 'email',
			'id' => 'email',
			'value' => $email
		));
		?><label for="email">Email</label>
	</p>

	<p>
		<?php echo form_input(array(
			'name' => 'subject',
			'size' => '74',
			'id' => 'subject',
			'required' => ''
		));
		?><label for="subject">Subject</label>
	</p>

	<?php echo form_textarea(array(
		'name' => 'issue',
		'required' => '',
		'class' => 'block',
		'placeholder' => 'Question?'
	));
	?>

	<?php
		echo form_submit('contact/submit', 'Submit');
	?>

	<?php echo form_close(); ?>
</div>
