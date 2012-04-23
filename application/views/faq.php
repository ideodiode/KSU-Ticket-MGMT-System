<?php

foreach ($faqs as $faq) {
	echo '<h3>'.$faq->question.'</h3>';
	echo '<p>'.$faq->answer.'</p>';
}
