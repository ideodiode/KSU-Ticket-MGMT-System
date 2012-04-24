<?php

	$this->load->view('includes/header');
?>
<div class="body">
	<?php
		if (isset($main_content)) {
			$this->load->view($main_content);
		} else {
			echo 'You did not set a main_content and pass it to the view';
		}

		if (isset($table_content)) {
			$this->load->view('tableView');
		}
		if (isset($secondary_content)) {
			$this->load->view($secondary_content);
		}
	?>
</div>
<?php
	$this->load->view('includes/footer');
?>
