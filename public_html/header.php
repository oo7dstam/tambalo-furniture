<?php
	session_start();
	ob_start();
	header( 'Cache-Control: no-store, no-cache, must-revalidate' );
	header( 'Cache-Control: post-check=0, pre-check=0', false );
	header( 'Pragma: no-cache' );
	require 'functions.php';

?>
<!DOCTYPE html>
<html>
	<head>
		<title> <?php echo $page_title ? $page_title : 'E Classroom' ?> </title>
		<meta name="author" content=""/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
		<meta name="apple-mobile-web-app-capable" content="yes"/>
		<meta name="keywords" content="e-classroom-mba"/>
		<meta name="description" content="<?php echo $page_description ? $page_description : ' '; ?>"/>
		<meta name="apple-mobile-web-app-status-bar-style" content="black"/>
		<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
		<meta charset="utf-8">
		<link rel="canonical" href="http://translate.google.com/?tl=de"/>
		<link href="assets/images/logo.png" rel="shortcut icon" type="image/png" />
		<link href='https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700' rel='stylesheet' type='text/css'>

		<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="https://cdn.datatables.net/1.10.10/css/jquery.dataTables.min.css"> -->

		<!-- local resources -->
		<link rel="stylesheet" href="assets/css/font-awesome.min.css">
		<link rel="stylesheet" href="assets/css/jquery.dataTables.min.css">
		<link rel="stylesheet" href="assets/css/index.min.css">

	</head>
	<body class="<?php echo basename($_SERVER["SCRIPT_FILENAME"], '.php'); ?>">
