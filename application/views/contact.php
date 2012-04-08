<h1>Contact us</h1>
<?php

if (isset($message)) {
	echo $message;
}
echo form_open('contact/send');
if (isset($user)) {
	$name = $user -> firstName . ' ' . $user -> lastName;
	$email = $user -> email;
} else {
	$name = '';
	$email = '';
}
?>

<p>
	Name
</p>
<?php echo form_input(array(
		'name' => 'name',
		'size' => '30',
		'value' => $name
	));
?>
<p>
	Email
</p>
<?php echo form_input(array(
		'name' => 'email',
		'size' => '30',
		'value' => $email
	));
?>

<p>
	Subject
</p>
<?php echo form_input(array(
		'name' => 'subject',
		'size' => '75'
	));
?>

<p>
	Issue
</p>
<?php echo form_textarea(array(
		'name' => 'issue',
		'rows' => '20',
		'cols' => '99'
	));
	echo form_submit('contact/submit', 'Submit');
?>

<?php echo form_close();?>
