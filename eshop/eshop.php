<?php
include '../common_files/core_inc.php';
//Cart Management
if (!isset($_SESSION['cart'])) {
	$_SESSION['cart'] = array();
	$_SESSION['quantity'] = array();
	$_SESSION['cart_price'] = 0;
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>ScoolLife - Order Online</title>
<!icon>
<link rel="shortcut icon" href="../images/icon.jpg" type="image/x-icon"/>
<!Css Reset>
	<link rel="stylesheet" type="text/css" href="../css/cssreset.css">
	
<! Bootstrap Css links>
	<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap-theme.min.css">

<!Select Css link>
	<link rel="stylesheet" type="text/css" href="select_master/dist/css/bootstrap-select.min.css">
<!font-awesome link>
	<link rel="stylesheet" type="text/css" href="../font-awesome/css/font-awesome.min.css">

<!Slider Css Link>
	<link rel="stylesheet" type="text/css" href="slider/slider.css">
	
	
<!Custom style sheet>
<link rel="stylesheet" type="text/css" href="css/styles_eshop.css">
<link rel="stylesheet" type="text/css" href="css/header_styles.css">

<!Alert Plugin links>
	<script src="js/alert/lib/sweet-alert.min.js"></script>
	<link rel="stylesheet" href="js/alert/lib/sweet-alert.css">
	

<style type = "text/css">
.thumbnail{
	border-radius:10px;
}
.thumbnail:hover{
	border:1px solid #CCC;
	transform: scale(1.04);
	-webkit-transform: scale(1.04);
	-moz-transform: scale(1.04);
	-ms-transform: scale(1.04);
	-o-transform: scale(1.04);
}
</style>
	
</head>
<body>
<div>
<! Main Page Header>
<?php include 'inc/header_mainpage_inc.php'; ?>
<?php include '../common_files/header_big_inc.php'; ?>

<!Products Display>
<?php include 'inc/products_display_inc.php' ?>

<!Main Page Footer>
<?php include 'inc/footer_mainpage_inc.php' ?>

</div>
<! Jquery Link>
    <script src="../js/jquery.js"></script>
<! Bootstrap jscript Link>
    <script src="../bootstrap/js/bootstrap.min.js"></script>

    <script src="js/mainsite_jscript.js"></script>
<!Select Js link>
<script src="select_master/dist/js/bootstrap-select.js"></script>

<!Slider JS Link>
<script src="slider/slider.js"></script>

</body>
</html>