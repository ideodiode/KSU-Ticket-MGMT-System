<h1>Update your info</h1>
<?php

if (isset($message)) {
	echo '<h2>' . $message . '</h2>';
}

echo form_open('user/update_info');

echo form_input(array(
	'name' => 'firstName',
	'value' => set_value('firstName', $user->firstName)
));

echo form_input(array(
	'name' => 'lastName',
	'value' => set_value('lastName', $user->lastName)
));
echo '<br />';
echo form_input(array(
	'name' => 'email',
	'value' => set_value('email', $user->email),
	'disabled' => 'true'
));
echo form_input(array(
	'name' => 'phone',
	'value' => set_value('phone', $user->phone)
));
echo '<br>';
echo form_submit('submit', 'Update info');
echo form_close();
