	<div>
		Found <?php echo $num_results . " " . $table; ?> 
	</div>
	
	<?php if (strlen($pagination)): ?>
	<div>
		Pages: <?php echo $pagination; ?>
	</div>
	<?php endif; ?>
	
	<?php echo validation_errors(); ?>
	<?php echo form_open(""); ?>
	
	<table>
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
			<tr>
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
					
					if(!$editable[$field_name]){
						$input['disabled'] = 'disabled';
					}
					
					if($field_name=='isRepaired'){
						$input['value'] = 'accept';
						if ($result->$field_name==1)
							$input['checked'] = 'checked';

						$input['class'] = 'editCheck';
						echo form_checkbox($input);
					}else if($editable[$field_name] || $field_name=='feedback'){
					
					//Standard textbox input	
					echo form_input($input);
					
					}else
						echo $result->$field_name;
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
		$('tr:odd').css('background', '#e3e3e3');
		$('tr:even').css('background', '#FEBC11');

		
		
		
		$(document).ready(function() {
			$('.editText').keyup(function(event) {
				if (event.which == 13) {
					update($(this), $(this).val());
				}
			}).
			keydown(function(event) {
				if (event.which == 13) {
					event.preventDefault();
				}  
			});
			
			$('.editCheck').mousedown(function(event) {

				if ($(this).attr("checked")==true){
				
					update($(this), '0');
				}else{
					
					update($(this), '1');
				}
			});
			
		});
	
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
			});
			//alert(value);
		}
	</script>