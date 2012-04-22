<html>
<head>
<title>Insert new FAQ question and answer</title>
</head>
<body>

<?php echo validation_errors(); ?>

<?php echo form_open('/faq/add_question/'); ?>

<h5>Question:</h5>
<input type="text" name="question" value="" size="50" />

<h5>Answer:</h5>
<TEXTAREA Name="answer" ROWS=10 COLS=50></TEXTAREA>

<div><input type="submit" value="Submit" /></div>

</form>

</body>
</html>