<h1>Login</h1>
<div id="login">
	<?php
	echo form_open('login/validate');
	echo form_input(array('name' => 'email', 'id' => 'email', 'placeholder' => 'Email Address'));
	echo form_password('password', 'Password');
	echo form_submit('login/submit', 'Login');
	echo anchor('login/signup', "Create account");
	echo form_close();
?>
</div>
