<?php

	echo form_open('login/signup');

	echo form_input('firstName', set_value('firstName', 'First Name'));
	echo form_input('lastName', set_value('lastName', 'Last Name'));
	echo form_input('email', set_value('email', "Email Address"));
	echo form_password('password', 'Password');
	echo form_password('password1', 'Confirm');
	echo form_submit('submit', 'Create Account');
	echo form_close();
	
	
	echo validation_errors();
