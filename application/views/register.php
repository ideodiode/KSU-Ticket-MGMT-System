<?php

echo form_open('login/signup');

echo form_input(array(
	'name' => 'firstName',
	'placeholder' => 'First Name',
	'value' => set_value('firstName', '')
));
echo form_input(array(
	'name' => 'lastName',
	'placeholder' => 'Last Name',
	'value' => set_value('lastName', '')
));

echo form_input(array(
	'name' => 'email',
	'placeholder' => 'Email Address',
	'value' => set_value('email', '')
));
echo form_input(array(
	'name' => 'phoneNumber',
	'placeholder' => 'Phone Number',
	'maxLength' => '15',
	'value' => set_value('phoneNumber', '')
));
echo form_password(array(
	'name' => 'password',
	'placeholder' => 'Password'
));
echo form_password(array(
	'name' => 'password1',
	'placeholder' => 'Confirm password'
));

echo form_submit('submit', 'Create Account');
echo form_close();

echo validation_errors();
