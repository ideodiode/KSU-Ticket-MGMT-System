	<div>
		Found <?php echo $num_results . " " . $table; ?> 
	</div>
	
	<?php if (strlen($pagination)): ?>
	<div>
		Pages: <?php echo $pagination; ?>
	</div>
	<?php endif; ?>
	
	<div id="ajax_message">
		Confirm changes in a row with the 'Enter/Return' key
	</div>
	
	<?php echo validation_errors(); ?>
	<?php echo form_open(""); ?>
	
	<table class="builder">
		<thead>
			<?php foreach($fields as $field_name => $field_display): ?>
			<th <?php if ($sort_by == $field_name) echo "class=\"sort_$sort_order\"" ?>>
				<?php echo anchor($role . "/" . $table . "_table/$field_name/" .
					(($sort_order == 'asc' && $sort_by == $field_name) ? 'desc' : 'asc') ,
					$field_display); ?>
			</th>
			<?php endforeach; ?>
		</thead>
		
		<tbody>
			<?php foreach($results as $result): ?>
			
			<tr class="edit_r">
				<?php foreach($fields as $field_name => $field_display): ?>
	
				<td>
					<?php 
					switch ($table){
						case 'user':
							$key = 'user_id';
							$row_id = $result->user_id;
							break;
						case 'requests':
							$key = 'report_id';
							$row_id = $result->report_id;
							break;
					}
					$input = array(
						'name' => $key.$field_name,
						'id' => $key.$field_name,
						'value' => $result->$field_name,
						'table' => $table,
						'field' => $field_name,
						'row_id' => $row_id,
						'key' => $key,
						'class' => 'editText'
						
					);
					
						//create disabled checkboxes
					if($field_name=='isRepaired'){
						$input['value'] = 'accept';
						if ($result->$field_name==1)
							$input['checked'] = 'checked';
						$input['disabled'] = 'disabled';
						if($editable[$field_name])
							$input['class'] = 'editCheck';
						echo form_checkbox($input);
						
						//create text areas for feedback
					}else if ($field_name=='feedback'){
						echo form_textarea($input);
						echo "<span>".$result->$field_name."</span>";
						
						//create drop down for role
					}else if ($field_name=='role'){
						echo form_dropdown($key.$field_name, $all_roles, $result->$field_name,
						'id = "'.$key.$field_name.'"
						table = "'.$table.'"
						field = "'.$field_name.'"
						row_id = "'.$row_id.'"
						key = "'.$key.'"
						class = "editDropdown"');
						echo "<span>".$result->$field_name."</span>";
						
						//create standard textbox input	for other fields
					}else if($editable[$field_name]){
						echo form_input($input);
						echo "<span>".$result->$field_name."</span>";

						//otherwise leave as plain text
					}else
						echo '<span class="'.$field_name.'">'.$result->$field_name.'</span>';
					?>
				</td>
				<?php endforeach; ?>
			</tr>
			<?php endforeach; ?>			
		</tbody>
		
	</table>
	</form>
	
	<?php if (strlen($pagination)): ?>
	<div>
		Pages: <?php echo $pagination; ?>
	</div>
	<?php endif; ?>
	
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js" type="text/javascript" charset="utf-8"></script>	

	<script type="text/javascript" charset="utf-8">
		//Set background for even and odd rows
		$('tr').filter(":odd").css('background', '#D9D9D9');
		$('tr').filter(":even").css('background', '#FEBC11');
		$('.edit_r').css('cursor', 'pointer');
	
		$('tr').filter(":odd").filter(".edit_r").addClass('odd');
		$('tr').filter(":even").filter(".edit_r").addClass('even');
		
		var $current_row = "";
		
		$("tr").hover(function () {
			if ($(this).hasClass('odd')){
				$(this).css('background', '#EDEDED');
			}else if($(this).hasClass('even')){
				$(this).css('background', '#FFD975');
			}
		  }, function () {
			if ($(this).hasClass('odd')){
				$(this).css('background', '#D9D9D9');
			}else if($(this).hasClass('even')){
				$(this).css('background', '#FEBC11');
			}
		  }
		);
		
		$(document).ready(function() {
			//On document ready, hide all inputs
			$('td > :input').each(function() {
				if ($(this).attr('type')!='checkbox'){
					$(this).hide();
				}
			});
			
			//Event triggered when a row in table is clicked
			$('tr').mousedown(function(event) {
				if ($current_row != this){
					$current_row = this;
					$("#ajax_message").html("Confirm changes in a row with the 'Enter/Return' key");
					hideAll();
					
					//Show inputs, hide plain text, enable checkboxes on selected row
					$(this).children().children().each(function() {
						if ($(this).attr('type')=='checkbox'){
							$(this).removeAttr('disabled');
						}
						else if ($(this).attr('class')=='editText'||$(this).attr('class')=='editDropdown'){
							$(this).show();
							$(this).next().hide();
						}
					});
				}
			});
			
			//Event triggered when enter is used in any textbox or field
			$('.editText').keyup(function(event) {
				if (event.which == 13) {
					//Call update() for all text fields in row
					$(this).parents('tr').children().children('.editText,.editDropdown').each(function() {
						update($(this), $(this).val());
					});
					$current_row = "";
				}
			}).
			keydown(function(event) {
				if (event.which == 13) {
					event.preventDefault();
				}  
			});
			
			//Event triggered when checkboxes are checked
			$('.editCheck').mouseup(function(event) {
				var $date_field = $(this).parents('tr').children().children('.completionDate');
				if ($(this).attr("checked")==true){
					updateTime($date_field, $(this), false);
					update($(this), '0');
				}else{
					updateTime($date_field, $(this), true);
					update($(this), '1');
				}
				$current_row = "";
			});
			
		});
	
		//Function for hiding all inputs, showing all plain text, disabling checkboxes
		function hideAll(){
			
			$('td > :input').each(function() {    
				if ($(this).hasClass('editCheck')){
					$(this).attr('disabled',true);
				}else if ($(this).attr('class')=='editText'||$(this).attr('class')=='editDropdown'){
					$(this).next().show();
					$(this).hide();
				}
			});
		}
		
		//AJAX function call, updates field in target row and table
		function update(target, value1){
			$.post("<?php echo base_url();?>/index.php/ajax/update", {
				value: value1,
				table: target.attr("table"),
				field: target.attr("field"),
				row_id: target.attr("row_id"),
				key: target.attr("key")
				},
			function(data){
				$(target).attr('value', data);
				$(target).siblings().html(data);
				$("#ajax_message").html("Your changes have been saved");
				hideAll();
			});
		}
		
		function updateTime(target, key, value1){
			$.post("<?php echo base_url();?>/index.php/ajax/update", {
				value: value1,
				table: key.attr("table"),
				field: "completionDate",
				row_id: key.attr("row_id"),
				key: key.attr("key")
				},
			function(data){
				$(target).html(data);
			});
		}
	</script>