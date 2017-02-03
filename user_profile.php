<?php
include 'common_files/core_inc.php';
if(!isset($_SESSION['user_id'])){
	header('Location: index.php');
}
if(!empty($_GET['logout'])){
	session_destroy();
	header('Location: index.php');
}

?>

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
			<link rel="stylesheet" type="text/css" href="css/user_profile_styles.css">
			
	</head>
	<body>
	
		<!-- Header -->
		<?php include 'common_files/header_big_inc.php' ?> 

		<!-- Main Body -->
		<div class = "main_body">
			<div class = "profile_block thumbnail" id = "profile_details_wrapper">
					<h4>Profile</h4>
					<span class="fa fa-pencil edit_btn" id = "profile_edit"></span>
					<span style="clear:both"></span>
					<span class = "line"></span>
					<div style = "display:block;width:100%">
					<table>
						<tr>
							<td>Name</td>
							<td>:</td>
							<td>Sandeep</td>
						</tr>
						<tr>
							<td>Phone</td>
							<td>:</td>
							<td>7730889469</td>
						</tr>
						<tr>
							<td>Email</td>
							<td>:</td>
							<td>msandep273@gmail.com</td>
						</tr>
					</table>
					</div>
			</div>
			<div class = "profile_block thumbnail" id = "add_details_wrapper">
					<h4>Address</h4>
					<span class="fa fa-pencil edit_btn" id = "profile_edit"></span>
					<span style="clear:both"></span>
					<span class = "line"></span>
					<div style = "display:block;width:100%">
					<table>
						<tr>
							<td>Name</td>
							<td>:</td>
							<td>Sandeep</td>
						</tr>
						<tr>
							<td>Phone</td>
							<td>:</td>
							<td>7730889469</td>
						</tr>
						<tr>
							<td>Email</td>
							<td>:</td>
							<td>msandep273@gmail.com</td>
						</tr>
					</table>
					</div>
			</div>
			<div class = "profile_block thumbnail" id = "profile_details_wrapper">
					<h4>Student Info</h4>
					<span class="fa fa-pencil edit_btn" id = "profile_edit"></span>
					<span style="clear:both"></span>
					<span class = "line"></span>
					<div style = "display:block;width:100%">
					<table>
						<tr>
							<td>Name</td>
							<td>:</td>
							<td>Sandeep</td>
						</tr>
						<tr>
							<td>Phone</td>
							<td>:</td>
							<td>7730889469</td>
						</tr>
						<tr>
							<td>Email</td>
							<td>:</td>
							<td>msandep273@gmail.com</td>
						</tr>
					</table>
					</div>
			</div>
			<span style="clear:both"></span>
		</div>
		
	<!-- Footer -->
	<?php include 'common_files/footer_big_inc.php' ?> 
	
	
	<!-- Java Script Links -->
	<script src="js/jquery.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
	<script src="js/mainpage.js"></script>

	</body>
</html>