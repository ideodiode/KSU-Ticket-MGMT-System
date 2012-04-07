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

<div class="container">
    
    <div class="header">
        <div class="nameHolder">
            <h2>
                KSU Service <br />
                Management System
            </h2>
        </div><!--End of nameHolder-->
  
        <div class="navBar">
        <ul>
            <li>Contact IT</li>
        </ul>
      </div><!--End of navBar-->
    </div><!--End of header-->