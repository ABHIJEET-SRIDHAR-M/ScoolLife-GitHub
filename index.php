<!DOCTYPE html>
<html lang="en">
	<head>
			<meta charset="utf-8">
			<meta name="viewport" content="width=device-width, initial-scale=1">

			<title> Welcome to ScoolLife </title>
			<!icon>
			<link rel="shortcut icon" href="images/icon.jpg" type="image/x-icon"/>
			<!-- CSS Links -->
			<!-- Css Reset -->
			<link rel="stylesheet" type="text/css" href="css/cssreset.css">
			<!-- Bootstrap Css Link -->
			<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
			<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-theme.min.css">

			<!-- font-awesome link -->
			<link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css">
			
			<!---Custom Css Links -->
			<link rel="stylesheet" type="text/css" href="css/mainpage_styles.css">
			<link rel="stylesheet" type="text/css" href="css/header_styles.css">
			<link rel="stylesheet" type="text/css" href="css/footer_styles.css">
			<link rel="stylesheet" type="text/css" href="css/slider_mp_styles.css">
			<link rel="stylesheet" type="text/css" href="css/school_zone_styles.css">
	</head>
	<body>
	
		<!-- Header -->
		<?php include 'common_files/header_big_inc.php' ?> 

		<!-- Main Body -->
		<div class = "main_body">
			<?php include 'common_files/slider_mp_inc.php' ?> 
			<?php include 'common_files/school_zone_mp_inc.php' ?> 
		</div>
		
	<!-- Footer -->
	<?php include 'common_files/footer_big_inc.php' ?> 
	
	
	<!-- Java Script Links -->
	<script src="js/jquery.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
	<script src="js/mainpage.js"></script>

	</body>
</html>