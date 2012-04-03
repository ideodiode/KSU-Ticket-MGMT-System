<<<<<<< HEAD
<<<<<<< HEAD
<h1>Create an account</h1>
<fieldset>
	<legend>
		Personal Information
	</legend>
	<?php
		echo form_open('login/signup');
=======
<?php
>>>>>>> parent of 28ef7b9... styled registration page slightly

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

<<<<<<< HEAD
		echo validation_errors();
	?>
</fieldset>
=======
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
            
				<?php
                echo form_input(array(
                    'name' => 'email',
                    'id' => 'email',
                    'placeholder' => 'Your Email',
                    'value' => set_value('email', '')
                ));
                ?>
                <br /><br />
                
                <?php
                echo form_password(array(
                    'name' => 'password',
                    'placeholder' => 'Password'
                ));
                ?>
                <br /><br />
            
            </div>
            
            <div class="contentLoginSubmit">
            
				<?php
                echo form_submit('login/submit', 'Login');
                //echo anchor('login/signup', "Create account");
                echo form_close();
                ?>
            
            	<?php
				if (isset($error)) :
				?>
				<h3 class="error"><?php echo $error;?></h3>
				<?php endif;?>
            	
            </div>
        
        
    
    </div>
    
    <div class="orBar">
    	<!--<p> OR </p>-->
    </div>
    
    <div class="contentRegister">
    
        <h1>Create an Account</h1>
        
        <?php
    
            echo form_open('login/signup');
            ?>
			
			<div class="contentRegisterInput">
			
            <?php
            echo form_input(array(
                'name' => 'firstName',
                'placeholder' => 'First Name',
                'value' => set_value('firstName', '')
            ));
            ?>
            <br /><br />
            <?php
            echo form_input(array(
                'name' => 'lastName',
                'placeholder' => 'Last Name',
                'value' => set_value('lastName', '')
            ));
            ?>
            <br /><br />
            <?php
            echo form_input(array(
                'name' => 'email',
                'placeholder' => 'Email Address',
                'value' => set_value('email', '')
            ));
            ?>
            <br /><br />
            <?php
            echo form_input(array(
                'name' => 'phoneNumber',
                'placeholder' => 'Phone Number',
                'maxLength' => '15',
                'value' => set_value('phoneNumber', '')
            ));
            ?>
            <br /><br />
            <?php
            echo form_password(array(
                'name' => 'password',
                'placeholder' => 'Password'
            ));
            ?>
            <br /><br />
            <?php
            echo form_password(array(
                'name' => 'password1',
                'placeholder' => 'Confirm password'
            ));
            ?>
            <br /><br />
            <?php
            echo form_submit('submit', 'Join');
            echo form_close();
			echo validation_errors();
            ?>
			</div>
    
    </div>
    
</div>
>>>>>>> upstream/master
=======
echo validation_errors();
>>>>>>> parent of 28ef7b9... styled registration page slightly
