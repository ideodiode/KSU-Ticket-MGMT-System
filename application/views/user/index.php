<div class="loggedUser">

<div class="topContainer">
<div class="welcome">
	<?php $name = $user->firstName;

	if (strlen($name) > 10) {
		$name = substr($name, 0, 4) . '...';
	}
 ?>
<h1>Welcome, <?php echo $name; ?></h1>
</div>
<div class="userNavBar">
<ul class="userNavBar">
<?php
	$current = $this->uri->rsegment(1) . '/' . $this->uri->rsegment(2);
	$pages = array(
		'user/update' => 'Profile',
		'user/requests_table' => 'History',
		'user/submit_request' => 'Create Request'
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

</div>
<?php if($current == 'user/index') :
?>
<h4>Select a page above.</h4>
<?php	endif;
	if ($this->session->flashdata('msg') != ''):
 ?>
<div id="message">
	<?php echo $this->session->flashdata('msg'); ?>
</div>
<?php endif; ?>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" charset="utf-8">
	if($('#message').length > 0) {
		$('#message').addClass('fadeOut');
		$('#message').find('p').addClass('message');
		$('#message').fadeOut(3000);
	}

</script>