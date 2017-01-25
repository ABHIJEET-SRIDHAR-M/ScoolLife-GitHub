<?php
require '../inc/core_inc.php';
require 'checksession_inc.php';
$admin_location = getfield('admin','location','id',$_SESSION['admin_id']);
if ($admin_location!= 273) {
	header('Location: signout.php');
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Add Type</title>
<!jquery>
	<script src="../js/jquery.js"></script>
	
	
	<! Bootstraplinks>
	<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap-theme.min.css">
        
	<script src="../bootstrap/js/bootstrap.min.js"></script>
	
<!jquery form validation plugin>	

	<script src="../js/formvalidator/lib/jquery.js"></script>
	<script src="../js/formvalidator/dist/jquery.validate.js"></script>
	
	
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
        <li><a href="admin_productsdashboard.php"><span class="glyphicon glyphicon-plus"></span>  Add Products</a></li>
<?php 
if ($admin_location == 273){
?>
        <li><a href="admin_dashboard_edittype.php"><span class="glyphicon glyphicon-pencil"></span> Edit Product Type</a></li>
        <li class = "active"><a href="admin_dashboard_addtype.php"><span class="glyphicon glyphicon-plus"></span> Add Product Type</a></li>
<?php } ?>
    </ul>
</div>
<!-- Form Name -->
<div>
<p>Available Product Types: </p>
<ol class = "list-unstyled">
<?php
$query = "SELECT `type`,`admin_id` FROM `items_type`";
$sth = $dbh->query($query);
while($result = $sth->fetch(PDO::FETCH_ASSOC)){
	echo '<li>'.ucfirst($result['type']).'</li>';
}
?> 
</ol>
</div>
<form id = "addtype" class="form-horizontal" method = "POST" action = "addproduct_type.php">
<fieldset>
<!-- New Product Type input-->
<div class="form-group">
  <label class="control-label col-md-3 col-md-push-2" style = "text-align:left" for="textinput">Add New Product Type</label>  
  <div class="col-md-4 col-md-push-2">
  <input id="textinput" name="type" type="text" class="form-control input-md" autofocus required>
    
  </div>
</div>

<!-- Button -->
<div class="form-group">
  <label class="control-label col-md-3 col-md-push-2" style = "text-align:left" for="singlebutton"></label>
  <div class="col-md-4 col-md-push-2">
    <button type = "button" id="button_submit" name="singlebutton" class="btn btn-primary">Add Product Type</a>
  </div>
</div>

</fieldset>
</form>
</div>
</div>
</div>

<!Modal Alert>
<div id="myModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Confirmation</h4>
                </div>
                <div class="modal-body">
                    <p>You are about to add a new Prodcut Type. DO you wish to proceed?</p>
                    <p class="text-warning"><small>The changes will be reflected in actual Website.</small></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="button" id = "button_proceed" class="btn btn-primary">Proceed</button>
                </div>
            </div>
        </div>
    </div>


	
	<script src="../js/myjavascript.js"></script>

<?php
if (isset($_SESSION['type_added']) && $_SESSION['type_added'] == 1){
?>
<script>
swal({title: "Product Type Added Succesfully!",   text: "",   timer: 1000,   showConfirmButton: false });
</script> 
<?php
} else if (isset($_SESSION['type_added'])){
?>
<script>
sweetAlert("Oops...", "Something went wrong! Make sure all your entries are proper", "error");
</script> 	
<?php
}else if (isset($_SESSION['type_exists']) && $_SESSION['type_exists'] == 1){
?>
<script>
sweetAlert("Sorry...", "The Product Type already exists.", "error");	
</script>
<?php
}
unset($_SESSION['type_added']);
unset($_SESSION['type_exists'])
?>	
<script>
$("#addproducts").addClass('active');

$(document).ready(function(){
var j= jQuery.noConflict();

$("#addtype").submit(function(event){
	$("#myModal").modal('show');
	event.preventDefault();
});
$("#button_submit").click(function(){
			$('#myModal').modal('show');		
});
 
	
	j("#button_proceed").click(function(){
		j('#addtype').submit();
		}); 
});
</script>

</body>
</html>