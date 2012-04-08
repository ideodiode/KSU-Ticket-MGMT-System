<?php

echo form_open('user/submit_request');

echo form_input(array(
	'name' => 'description',
	'placeholder' => 'Description of issue',
	'value' => set_value('description', '')
));
echo form_input(array(
	'name' => 'location',
	'placeholder' => 'Location of issue',
	'value' => set_value('location', '')
));

echo form_input(array(
	'name' => 'requestedTime',
	'placeholder' => 'Requested appointment time',
	'value' => set_value('requestedTime', '')
));

echo form_submit('submit', 'Submit Request');
echo form_close();

echo validation_errors();
