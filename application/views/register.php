<div class ="contentLoginOrRegister">
	<div class="contentLogin">
		<h1>Login</h1>
		<?php
		if (isset($message)) {
			echo "<h3>" . $message . "<h3>";
		}
		?>

		<?php
		echo form_open('login/validate');
		?>

		<div class="contentLoginInput">
			<table cellpadding="5">
				<tr>
					<td>Email Address :</td>
					<td><?php
					echo form_input(array('name' => 'email', 'id' => 'email', 'placeholder' => '', 'value' => set_value('email', '')));
					?></td>
				</tr>
				<tr>
					<td>Password :</td>
					<td><?php
					echo form_password(array('name' => 'password', 'placeholder' => ''));
					?></td>
				</tr>
				<tr>
					<td></td>
					<td class="submitButton"><?php
					echo form_submit('login/submit', 'Login');
					echo form_close();
					?></td>
					</td>
			</table>
		</div>
		<div class="contentLoginSubmit">
			<?php
			//echo form_submit('login/submit', 'Login');
			//echo anchor('login/signup', "Create account");
			//echo form_close();
			?>

			<?php
if (isset($error)) :
			?>
			<h3 class="error"><?php echo $error;?></h3>
			<?php endif;?>

			<!--Verification for Account Creation goes here-->
			<?php
			echo validation_errors();
			?>
		</div>
	</div>
	<div class="orBar">
		<!--<h1> OR </h1>-->
	</div>
	<div class="contentRegister">
		<h1>Create an Account</h1>
		<?php

		echo form_open('login/signup');
		?>

		<div class="contentRegisterInput">
			<table cellpadding="5">
				<tr>
					<td>First Name :</td>
					<td><?php
					echo form_input(array('name' => 'firstName', 'placeholder' => '', 'value' => set_value('firstName', '')));
					?></td>
				</tr>
				<tr>
					<td>Last Name :</td>
					<td><?php
					echo form_input(array('name' => 'lastName', 'placeholder' => '', 'value' => set_value('lastName', '')));
					?></td>
				</tr>
				<tr>
					<td>Email Address :</td>
					<td><?php
					echo form_input(array('name' => 'email', 'placeholder' => '', 'value' => set_value('email', '')));
					?></td>
				</tr>
				<tr>
					<td>Phone Number :</td>
					<td><?php
					echo form_input(array('name' => 'phoneNumber', 'placeholder' => '', 'maxLength' => '15', 'value' => set_value('phoneNumber', '')));
					?></td>
				</tr>
				<tr>
					<td>Password :</td>
					<td><?php
					echo form_password(array('name' => 'password', 'placeholder' => ''));
					?></td>
				</tr>
				<tr>
					<td>Confirm password :</td>
					<td><?php
					echo form_password(array('name' => 'password1', 'placeholder' => ''));
					?></td>
				</tr>
				<tr>
					<td></td>
					<td class="submitButton"><?php
					echo form_submit('submit', 'Join');
					echo form_close();
					?></td>
				</tr>
			</table>
		</div>
	</div>
</div>