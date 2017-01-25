<?php
require '../inc/core_inc.php';
require 'checksession_inc.php';
if(getfield_admin('location')!=273){
	header('Location:signout.php');
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Manage Admin</title>

	<! Bootstrap Css links>
	<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap-theme.min.css">
<style type = "text/css">


</style>
</head>
<body>

<?php
include 'navbar_adminpage_inc.php';
?>
<div class = "container-fluid">
<div class = "row">
<div class = "col-md-8 col-md-push-2">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#"><span class="glyphicon glyphicon-plus"></span>Add Admin</a></li>
        <li><a href="#"><span class="glyphicon glyphicon-pencil"></span> Edit Admins</a></li>
    </ul>
</div>
</div>
</div>	


    <script src="../js/jquery.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <!jquery form validation plugin>	
	<script src="../js/formvalidator/lib/jquery.js"></script>
	<script src="../js/formvalidator/dist/jquery.validate.js"></script>
	
	
	<script src="../js/myjavascript.js"></script>
	
<script>
$("#manageadmin").addClass('active');
</script>

</body>
</html>