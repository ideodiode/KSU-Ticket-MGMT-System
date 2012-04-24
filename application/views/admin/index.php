<div class="topContainer">
	<div class="welcome">
		<?php
			$name = $user->firstName;
			if (strlen($name) > 7) {
				$name = substr($name, 0, 3) . '..';
			}
		?>
		<h1>Welcome, <?php echo $name; ?></h1>
	</div>
	<div class="userNavBar">
		<ul class="userNavBar">
			<?php
				$current = $this->uri->rsegment(1) . '/' . $this->uri->rsegment(2);
				// get the currrent page that you're on. This would be something like admin/user_table or whatever.
				$pages = array(// Make a list of all the pages you want
					'admin/update' => 'Profile',
					'admin/user_table' => 'Users',
					'admin/requests_table' => 'Tickets',
					'admin/schedule_table' => 'Schedule',
					'admin/faq' => 'FAQ',
					'admin/speciality' => 'Specialties'
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

<?php if($current == 'admin/index') :
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