<div class="loggedAdmin">
	<div class="topContainer">
		<div class="welcome">
			<h1>Welcome,
				<?php
				$this->load->model('user_model');
				$user = $this->user_model->get_info($this->session->userdata('email'));
				echo $user->firstName;
				?>
			</h1>
		</div>
		<div class="userNavBar">
			<ul class="userNavBar">
				<li class="userNavBar">
					<?php echo anchor('admin/update', 'Profile');?>
				</li>
				<li class="userNavBar">
					<?php echo anchor('admin/user_table', 'Users');?>
				</li>
				<li class="userNavBar">
					<?php echo anchor('admin/requests_table', 'Tickets');?>
				</li>
				<li class="userNavBar">
					<?php echo anchor('admin/schedule_table', 'Schedule');?>
				</li>
			</ul>
		</div>
	</div>
	<div class="bottomContainer"></div>
</div>