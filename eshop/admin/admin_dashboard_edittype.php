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
	<title>Edit Type</title>
<!jquery>
	<script src="../js/jquery.js"></script>
	
	
	<! Bootstraplinks>
	<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap-theme.min.css">
        
	<script src="../bootstrap/js/bootstrap.min.js"></script>
	
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
        <li class = "active"><a href="admin_dashboard_edittype.php"><span class="glyphicon glyphicon-pencil"></span> Edit Product Type</a></li>
        <li><a href="admin_dashboard_addtype.php"><span class="glyphicon glyphicon-plus"></span> Add Product Type</a></li>
<?php } ?>
    </ul>
</div>
<!-- Form Name -->

<form id = "edittype" class="form-horizontal" method = "POST" action = "editproduct_type.php">
<fieldset>
<!-- Select Product Type to edit -->
<div class="form-group">
  <label class="control-label col-md-3 col-md-push-2" style = "text-align:left" for="selectbasic">Product Type</label>
  <div class="col-md-4 col-md-push-2">
    <select id="product_type" name="product_type" class="form-control">
     <?php
	 $location_id = $admin_location;
		$query = "SELECT `id`, `type` from `items_type`";
		 $sth = $dbh->prepare($query);
		 $sth->execute();
		 while($result = $sth->fetch(PDO::FETCH_ASSOC)){
			echo '<option value = "'.$result['type'].'">'.ucfirst($result['type']).'</option>';
		}
	 ?>
	 
    </select>
  </div>
</div>
<!-- Button (Double) -->
<div class="form-group">
  
  <div class="col-md-8 col-md-push-3" style = "margin-top:10px;">
    <button type = "button" id="button_edit" name="button1id" class="btn btn-success" style = "width:120px">Edit</button>
    <button type = "button" id="button_delete" name="button2id" class="btn btn-danger" style = "width:120px">Delete</button>
  </div>
</div>

</fieldset>
</form>
</div>
</div>
</div>

<!Modal for edit>
<div id="myModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Edit Product Type</h4>
                </div>
                <div class="modal-body">
                    <p> <input class = "form-control" type = "text" id = "type_edit_enable"></p>
                    <p class="text-warning"><small>The changes will be reflected in actual Website.</small></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="button" id = "button_proceed_edit" class="btn btn-primary">Proceed</button>
                </div>
            </div>
        </div>
    </div>
	
	
<!Modal for Delete>
<div id="deleteConfirmation" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Confirmation</h4>
                </div>
                <div class="modal-body">
                    <p>You are about to Delete the Product Type.<strong> All the products of this type will also be deleted</strong>. DO you want to Proceed?</p>
                    <p class="text-warning"><small>The changes will be reflected in actual Website.</small></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="button" id = "button_proceed_delete" class="btn btn-primary">Proceed</button>
                </div>
            </div>
        </div>
    </div>

	
	
<script>

$(document).ready(function(){
$("#addproducts").addClass('active');
var j= jQuery.noConflict();
j("#button_edit").click(function(){
			j('#myModal').modal('show');
			j("#type_edit_enable").val(j("#product_type").val()).focus();
			
			 j('#type_edit_enable').keypress(function (e) {
 var key = e.which;
 if(key == 13)  // the enter key code
  {
    j("#button_proceed_edit").click();
    return false;
  }
});
	});
 j("#button_delete").click(function(){
		j("#deleteConfirmation").modal('show');

});
j("#button_proceed_edit").click(function(){
	var type_new = j("#type_edit_enable").val();
	var type_old = j("#product_type").val();
	j.post('edit_type.php',{type_old:type_old,type_new:type_new}, function(data){
	if (data == 'success'){
			swal({   title: "Product Type Updated Succesfully!",   text: "",   timer: 1000,   showConfirmButton: false });
			
		} else if(data == 'fail'){
			sweetAlert("Oops...", "Something went wrong.. Please Contact Admin", "error");
		} else if(data == 'exists'){
			sweetAlert("Oops...", "The new Product Type you entered already exists!", "error");
		}
		window.setTimeout(function(){
		location.reload();
		},2000);
	}); 
});
j("#button_proceed_delete").click(function(){
		j("#deleteConfirmation").modal('hide');
	var type_delete = j("#product_type").val();
	
	j.post('delete_type.php',{type:type_delete}, function(data){
		if (data == 'success'){
			swal({   title: "Product Type Deleted Succesfully!",   text: "",   timer: 1000,   showConfirmButton: false });
			
		} else if(data == 'fail'){
			sweetAlert("Oops...", "Something went wrong.. Please Contact Admin", "error");
		}
		window.setTimeout(function(){
		location.reload();
		},2000);
	});
		}); 
});
</script>

</body>
</html>