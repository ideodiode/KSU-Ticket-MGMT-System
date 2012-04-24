<div class="faq">
	<h1>FAQs</h1>
	<?php

		foreach ($faqs as $faq) {
			echo '<h3>' . $faq->question . '</h3>';
			echo '<h4>' . $faq->answer . '</h4>';
		}
	?>
</div>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" charset="utf-8">
	$('h3').next('h4').hide();
	$('h3').click(function() {
		$(this).next('h4').toggle();
	});

	$('h3').css('cursor', 'pointer');

</script>