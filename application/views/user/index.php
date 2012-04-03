<h2>What do you need to do?</h2>
<p>
	<?php echo anchor('user/logout', 'Log Out');?>
</p>
<p>
	<?php echo anchor('user/update', 'Update your info');?>
</p>
<p>
	<?php echo anchor('user/submit_request', 'Submit service requests');?>
</p>
<p>
	<?php echo anchor('user/requests_table', 'View your service requests');?>
</p>
<?php if (isset($message))echo $message;?>