	<div>
		Found <?php echo $num_results . " " . $table; ?> 
	</div>
	
	<?php if (strlen($pagination)): ?>
	<div>
		Pages: <?php echo $pagination; ?>
	</div>
	<?php endif; ?>
	
	<?php echo validation_errors(); ?>
	<?php echo form_open($table. "_model/update"); ?>
	
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
					
					<?php $js = 'onKeyPress="return checkSubmit(event, this.id, this.value)"';
					$id = $role._id;
					$id = $result->;
					echo form_input($id. " " . $field_name, $result->$field_name, $js); ?>
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
		
		function update(e, id, value)
			{
			var xmlhttp;
			if (e && e.keyCode == 13){ 

				if (window.XMLHttpRequest)
				  {// code for IE7+, Firefox, Chrome, Opera, Safari
				  xmlhttp=new XMLHttpRequest();
				  }
				else
				  {// code for IE6, IE5
				  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
				  }
				xmlhttp.onreadystatechange=function()
				  {
				  if (xmlhttp.readyState==4 && xmlhttp.status==200)
					{
					document.getElementById("").innerHTML=xmlhttp.responseText;
					document.getElementById("message").innerHTML=xmlhttp.responseText;
					}
				  }
				xmlhttp.open("GET","update.php?id="+id+",val="+value,true);
				xmlhttp.send();
				}
			}
	</script>