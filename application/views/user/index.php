<div class="loggedUser">

    <div class="topContainer">
    	
        
            <h3 class="welcome">Welcome to your profile</h3>
        
        
        
            <ul class="userNavBar">
                <li class ="userNavBar"><?php echo anchor('user/update', 'Update profile');?></li>
                <li class ="userNavBar"><?php echo anchor('user/submit_request', 'Submit a request');?></li>
                <li class ="userNavBar"><?php echo anchor('user/requests_table', 'Requests history');?></li>
            </ul>
        
    	
    </div>
 	
    <div class="bottonContainer">
        <?php if (isset($message))echo $message;?>
	</div>
    
</div>