<h3>The service requests below have been marked as complete, but you haven't left any feedback. Please do so by clicking on each request.</h3>

<?php

foreach ($pending as $p) {
?>
<p>
	<?php
		echo anchor('user/feedback/' . $p->report_id, substr($p->description, 0, 50) . '...');
	?>
</p>
<?php 
}
?>
