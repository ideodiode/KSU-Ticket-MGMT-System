<div class="updateTech">

  	<h1>Update your information</h1>
    
	<?php
    if (isset($message)) {
        echo '<h2>' . $message . '</h2>';
    }
    echo form_open('user/updateInfo');
    ?>
	
	<div class="updateInput">
    	<table cellpadding="10">
        <tr>
        	<td>First Name :</td>
        	<td>
			<?php
            echo form_input(array(
                'name' => 'firstName',
                'value' => set_value('firstName', $user->firstName)
            ));
            ?>
       		</td>
        </tr>
        <tr>
        	<td>Last Name :</td>
        	<td>
        	<?php
            echo form_input(array(
                'name' => 'lastName',
                'value' => set_value('lastName', $user->lastName)
            ));
			?>
            </td>
        </tr>
        <tr>
        	<td>Email :</td>
            <td>
            <?php
            echo form_input(array(
                'name' => 'email',
                'value' => set_value('email', $user->email),
                'disabled' => 'true'
            ));
			?>
            </td>
       </tr>
       <tr>
       		<td>Phone :</td>
            <td>
            <?php
            echo form_input(array(
                'name' => 'phone',
                'value' => set_value('phone', $user->phone)
            ));
			?>
            </td>
       </tr>
       <tr>
       		<td></td>
            <td>
            <?php
            echo form_submit('submit', 'Update info');
            echo form_close();
            ?>
            </td>
       </table>
       		
	</div>
    
</div>

