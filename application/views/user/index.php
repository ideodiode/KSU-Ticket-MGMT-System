<div class="loggedUser">

<div class="topContainer">
<div class="welcome">
<?php $email = $this->session->userdata('email'); ?><h1>Welcome, <?php echo $this->user_model->get_info($email)->firstName; ?></h1>
</div>
<div class="userNavBar">
<ul class="userNavBar">
<?php
	$current = $this->uri->rsegment(1) . '/' . $this->uri->rsegment(2);
	$pages = array(
		'user/update' => 'Profile',
		'user/requests_table' => 'History',
		'user/submit_request' => 'Request'
	);
	foreach ($pages as $key => $value) {// Go through the list and look at the keys and values.
		if ($key == $current) {// If you're on a page, echo out the active thing.
			echo '<li class="userNavBar active">' . anchor($key, $value) . '</li>';
		} else {
			echo '<li class="userNavBar">' . anchor($key, $value) . '</li>';
			// else, just put the class without the active.
		}
	}
				?>
			</ul>
		</div>
	</div>

	<div class="bottonContainer">
		<?php
			if (isset($message))
				echo $message;
		?>
	</div>
	<div class="message">
		<?php echo $this->session->flashdata('msg'); ?>
	</div>

</div>
<?php if($current == 'user/index') :
?>
<h4>Select a page above.</h4>
<?php	endif; ?>
