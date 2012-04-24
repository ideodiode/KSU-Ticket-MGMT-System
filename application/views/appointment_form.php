<html>
<head>
<title>Schedule New Appointment</title>
</head>
<body>

<?php echo validation_errors(); ?>

<?php echo form_open('/appointments/set_schedule/'); ?>

<h5>Please include a description of your problem before submitting:</h5>
<input type="text" name="description" value="" size="50" />

<div><input type="submit" value="Submit" /></div>

</form>

</body>
</html>