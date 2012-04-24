<div class="loggedTech">

	<div class="topContainer">
		<div class="welcome">
			<h1>Welcome, <?php echo $user->firstName; ?></h1>
		</div>
		<div class="userNavBar">
			<ul class="userNavBar">
				<?php
					$current = $this->uri->rsegment(1) . '/' . $this->uri->rsegment(2);
					$pages = array(
						'tech/update' => 'Profile',
						'tech/requests_table' => 'Requests'
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
	
    <div class="message">
    	<?php echo $this->session->flashdata('msg'); ?>
		</div>
	</div>
<?php if($current == 'tech/index') :
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
		$('#message').fadeOut(2000);
	}

</script>
