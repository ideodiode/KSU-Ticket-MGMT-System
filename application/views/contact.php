<h1>Contact us</h1>

<div class="contact">    
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
    
    <table cellpadding="10">
    	<tr>
        <td>Name</td>
        <td>
        <?php echo form_input(array(
                'name' => 'name',
                'size' => '30',
                'value' => $name
            ));
        ?>
        </td>
        </tr>
        <tr>
        <td>Email</td>
        <td>
        <?php echo form_input(array(
                'name' => 'email',
                'size' => '30',
                'value' => $email
            ));
        ?>
        </td>
        </tr>
        <tr>
        <td>Subject</td>
        <td>
        <?php echo form_input(array(
                'name' => 'subject',
                'size' => '75'
            ));
        ?>
        </td>
        </tr>
        <tr>
        <td>Issue</td>
        <td>
        <?php echo form_textarea(array(
                'name' => 'issue',
                'rows' => '10',
                'cols' => '89'
            ));
		?>
		</td>
        </tr>
        <tr>
        <td></td>
        <td>
        <?php
            echo form_submit('contact/submit', 'Submit');
        ?>
        </td>
        </tr>
        <?php echo form_close();?>
    </table>
</div>
