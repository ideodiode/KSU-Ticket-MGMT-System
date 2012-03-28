<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title><?php
		if (isset($title)) {
			echo $title;
		} else {
			echo 'Service Center';
		}
			?></title>
		<link rel="stylesheet" href="<?php echo base_url();?>/css/style.css" type="text/css" media="screen" />
	</head>
	<body>
