<div class="request">
	<div class="add">
		<h3>Your request:</h3>
		<h4><?php echo $pending->description; ?></h4>
		<p>
			Was completed on <strong><?php echo date('F jS, Y', strtotime($pending->completionDate)); ?></strong>
			by <strong><?php
				$this->load->model('user_model');
				$technum = $pending->tech;
				$tech = $this->user_model->get_info_from_id($technum);
				echo $tech->firstName . ' ' . $tech->lastName;
			?></strong>. Please leave feedback below so we can contiue to improve our services.
		</p>
		<?php echo form_open('user/update_feedback', '', array('report_id' => $pending->report_id)); ?>

		<?php echo form_textarea(array(
		'name' => 'feedback',
		'placeholder' => 'feedback',
		'required' => ''
	));
		?>
		<?php echo form_submit(array(
				'class' => 'block',
				'name' => 'update'
			), 'Update feedback');
		?>

		<?php echo form_close(); ?>
	</div>
</div>