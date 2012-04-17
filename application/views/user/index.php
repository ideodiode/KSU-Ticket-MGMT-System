<div class="loggedUser">

    <div class="topContainer">
    	<div class="welcome">
            <h1 class="inline">Welcome, </h1>
        	<h3 class="inline">
			<?php
				$this->load->model('user_model');
				$user = $this->user_model->get_info($this->session->userdata('email'));
				echo $user->firstName;
			?>
        	</h3>
		</div>
        <div class="userNavBar">
            <ul class="userNavBar">
                <?php
					$current = $this->uri->rsegment(1) . '/' . $this->uri->rsegment(2); // get the currrent page that you're on. This would be something like admin/user_table or whatever.					
					$pages = array( // Make a list of all the pages you want
						'user/update' => 'Profile',
						'user/submit_request' => 'Submit a request',
						'user/requests_table' => 'Requests history',
					);

					foreach ($pages as $key => $value) { // Go through the list and look at the keys and values.
						if ($key == $current) { // If you're on a page, echo out the active thing.
							echo '<li class="userNavBarActive">' . anchor($key, $value) . '</li>'; 
						} else {
							echo '<li class="userNavBar">' . anchor($key, $value) . '</li>'; // else, just put the class without the active.
						}
					}
				?>
            </ul>
         </div>
    </div>
    
    <div class="bottonContainer">
        <?php if (isset($message))echo $message;?>
	</div>
    
</div>
