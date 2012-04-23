<div class="faq">
	
    <h1>FAQs</h1>
    
	<?php
    
    foreach ($faqs as $faq) {
        echo '<h3>'.$faq->question.'</h3>';
        echo '<h4>'.$faq->answer.'</h4>';
    }
    
    ?>

</div>