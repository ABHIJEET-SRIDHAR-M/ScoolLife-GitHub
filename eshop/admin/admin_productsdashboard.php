<?php
require '../inc/core_inc.php';
require 'checksession_inc.php';
$admin_location = getfield('admin','location','id',$_SESSION['admin_id']);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin</title>

	<! Bootstrap Css links>
	<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap-theme.min.css">
	
	<!Alert Plugin links>
	<script src="../js/alert/lib/sweet-alert.min.js"></script>
	<link rel="stylesheet" href="../js/alert/lib/sweet-alert.css">
<style type = "text/css">
ul a{
	font-weight:20px;
}
.control-label{
	text-align:left;
}
form input[type=number]::-webkit-inner-spin-button, 
form input[type=number]::-webkit-outer-spin-button { 
  -webkit-appearance: none; 
  margin: 0; 
}
</style>
</head>
<body>

<?php
include 'navbar_adminpage_inc.php';
?>

<div class = "container-fluid">
<div class = "row">
<div class = "col-md-8 col-md-push-2">


<div style = "margin-bottom:20px;">
    <ul class="nav nav-tabs">
        <li><a href="admin_dashboard_editproduct.php"><span class="glyphicon glyphicon-pencil"></span>  Edit Products</a></li>
        <li class="active"><a href="admin_productsdashboard.php"><span class="glyphicon glyphicon-plus"></span>  Add Products</a></li>
<?php 
if ($admin_location == 273){
?>
        <li><a href="admin_dashboard_edittype.php"><span class="glyphicon glyphicon-pencil"></span> Edit Product Type</a></li>
        <li><a href="admin_dashboard_addtype.php"><span class="glyphicon glyphicon-plus"></span> Add Product Type</a></li>
<?php } ?>
    </ul>
</div>
<?php
include 'addproduct_form.php';
?>
</div>
</div>
</div>



    <script src="../js/jquery.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <!jquery form validation plugin>	
	<script src="../js/formvalidator/lib/jquery.js"></script>
	<script src="../js/formvalidator/dist/jquery.validate.js"></script>
	
	
	<script src="../js/myjavascript.js"></script>
<?php
if (isset($_SESSION['item_add']) && $_SESSION['item_add'] == 1){
?>
<script>
swal({   title: "Product Added Succesfully!",   text: "",   timer: 1000,   showConfirmButton: false });
</script> 
<?php
} else if (isset($_SESSION['item_add']) && $_SESSION['item_add'] == 0){
?>
<script>
sweetAlert("Oops...", "Something went wrong! Make sure all your entries are proper", "error");
</script> 	
<?php
} 
unset($_SESSION['item_add']);
?>	
<script>
$("#addproducts").addClass('active');
</script>

</body>
</html>