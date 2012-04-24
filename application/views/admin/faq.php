<div class="faq">
	<div class="add">
		<h3>Add a FAQ</h3>
		<?php
			echo form_open('admin/faq_add');
		?>
		<p>

			<?php echo form_input(array(
				'name' => 'question',
				'for' => 'question',
				'required'=> ''
			));
			?>
			<label type="text" name="question" id="question">Question</label>
		</p>
		<p>

			<?php echo form_textarea(array(
		'name' => 'answer',
		'placeholder' => 'Answer',
		'required'=> ''
	));
			?>
		</p>
		<?php
			echo form_submit('Delete', 'Add question');
			echo form_close();
		?>
	</div>
	<div class="delete">
		<h3>Delete an FAQ</h3>
		<?php
			echo form_open('admin/faq_delete');
			foreach ($faqs as $faq) {
				$values = array(
					'value' => $faq->id,
					'id' => $faq->id,
					'name' => 'faqs[]'
				);
				echo form_checkbox($values);

		?>
		<label for="<?php echo $faq->id; ?>"><?php echo $faq->question; ?></label>
		<br>
		<?php
			}
			echo form_submit('Delete', 'Delete Selected');
			echo form_close();
		?>
	</div>

</div>