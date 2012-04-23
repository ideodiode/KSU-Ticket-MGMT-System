<div class="faqAdmin">

	<div class="faqNew">
        <h3>New question</h3>
        <?php
        echo form_open('admin/faq_add');
        ?>
        
        <table cellpadding="10">
        <tr>
            <td>Question ?</td>
            <td>
                <?php
                echo form_input(array('name' => 'question'));
                ?>
            </td>
        </tr>
        <tr>
            <td>Answer </td>
            <td>
                <?php
                echo form_textarea(array('name' => 'answer'));
                ?>
            </td>
        </tr>
        <tr>
        <td></td>
        <td>
            <?php
            echo form_submit('Delete', 'Add question');
            echo form_close();
            ?>
        </td>
        </tr>
        </table>
    </div>
    
    <div class="faqDelete">
        <h3>Delete questions</h3>
        
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
			
		echo '<br>';
        echo form_submit('Delete', 'Delete Selected');
        echo form_close();
        ?>
    </div>

</div>