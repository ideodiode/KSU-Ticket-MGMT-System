<h4>Delete questions</h4>
<?php
echo form_open('admin/faq_delete');
foreach ($faqs as $faq) {
	$values = array(
		'value' => $faq->id,
		'name' => 'faqs[]'
	);
	echo form_checkbox($values);
	echo '' . $faq->question . '';
	echo '<br>';
}
echo form_submit('Delete', 'Delete Selected');
echo form_close();
?>

<h4>Add a question</h4>
<?php
echo form_open('admin/faq_add');
echo 'Question? ' . form_input(array('name' => 'question'));
echo '<br>';
echo 'Answer ' . form_textarea(array('name' => 'answer'));
echo '<br>';
echo form_submit('Delete', 'Add question');
echo form_close();
?>