<h1>Login</h1>
<?php
	if (isset($message)) {
		echo "<h3>" . $message . "<h3>";
	}
?>
<div id="login">
	<?php
		echo form_open('login/validate');
		echo form_input(array(
			'name' => 'email',
			'id' => 'email',
			'placeholder' => 'Email Address',
			'class' => 'login_class'
		));
		echo form_password('password', 'Password');
		echo form_submit('login/submit', 'Login');
		echo anchor('login/signup', "Create account");
		echo form_close();
	?>
</div>
<?php
if (isset($error)) :
?>
<h3 class="error"><?php echo $error;?></h3>
<?php endif;?>
