<?php
require '../inc/core_inc.php';
require 'checksession_inc.php';
$admin_location = getfield('admin','location','id',$_SESSION['admin_id']);

//function to display products

function display_product($result){
	$phpdate = strtotime($result['date']);
	$mysqldate = date( 'M j, Y', $phpdate );
	echo '<div class="col-sm-6 col-xs-6 col-md-2">
			<div class="thumbnail">';
			echo '<h4 style = "margin-top:2px;margin-bottom:10px;white-space: nowrap; overflow:hidden; text-overflow: ellipsis;">'.$result['name'].'</h4>
			<img src="../'.$result['pic'].'" alt="'.$result['name'].'" style = "width: 155px; height:155px;">
			<div class="caption">
			<p style = "white-space: nowrap; overflow:hidden; text-overflow: ellipsis;">'.$result['description'].'</p>
			<p>Location: '.getfield('locations','location','id',$result['location']).'</p>
			<p>Added By : '.getfield('admin','firstname','id',$result['admin_id']).'</p><p> on '.$mysqldate.' </p>
			<p><a href="edit_product.php?id='.$result['id'].'" style = "width:65px" class="btn btn-success" role="button">Edit</a> <a id = "delete_'.$result['id'].'" class="btn_delete btn btn-danger" role="button">Delete</a></p>
			</div>';
			echo'</div>
			</div>';
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
        <li class = "active"><a href="admin_dashboard_editproduct.php"><span class="glyphicon glyphicon-pencil"></span>  Edit Products</a></li>
        <li><a href="admin_productsdashboard.php"><span class="glyphicon glyphicon-plus"></span>  Add Products</a></li>
<?php 
//show additional options for super admin
if ($admin_location == 273){
?>
        <li><a href="admin_dashboard_edittype.php"><span class="glyphicon glyphicon-pencil"></span> Edit Product Type</a></li>
        <li><a href="admin_dashboard_addtype.php"><span class="glyphicon glyphicon-plus"></span> Add Product Type</a></li>
<?php } ?>
    </ul>
</div>

        <form role="search" class="navbar-form navbar-left" action = "<?php echo $current_file;?>" method = "POST">

            <div class="form-group">
				<div class = "input-group">
                <div class = "input-group-addon"><span class="glyphicon glyphicon-search" id="basic-addon1"></span></div>
				<input type="text" placeholder="Search by Name" value = "<?php if (isset($_POST['search_key']) && !empty($_POST['search_key'])){echo $_POST['search_key'];}?>" class="form-control" name = "search_key">
				</div>
				<input type = "submit" class="btn btn-primary" role="button" value = "Go" style = "width:50px;margin-left:25px;">
            </div>

        </form>
<?php
if (isset($_POST['search_key']) && !empty($_POST['search_key'])){
?>
<a href="admin_dashboard_editproduct.php" class = "btn btn-primary pull-right"><span class="glyphicon glyphicon-arrow-left"></a>
<?php
}
?>
</div>
</div>
</div>

<! Products Display>

<div class = "container">
<div class="row" style = "margin-top:20px;">
<?php
if (isset($_POST['search_key']) && !empty($_POST['search_key'])){
	if($admin_location == 273){
		$query1 = "SELECT `id`,`name`,`description`,`price`,`pic`,`location`,`admin_id`,`date` FROM `items` WHERE `name` LIKE '%".$_POST['search_key']."%'";
	} else {
		$query1 = "SELECT `id`,`name`,`description`,`price`,`pic`,`location`,`admin_id`,`date` FROM `items` WHERE `name` LIKE '%".$_POST['search_key']."%' AND `location` = '$admin_location'";
	}
	$sth1 = $dbh->query($query1);
	if($sth1->rowCount() == 0){
			echo '<p>No Products to Display.</p>';
		}
		while($result = $sth1->fetch(PDO::FETCH_ASSOC)){
			display_product($result);
		}
} else {
	$query1 = "SELECT `id`,`type` FROM `items_type`";
	$sth1 = $dbh->query($query1);
	while($item_type = $sth1->fetch(PDO::FETCH_ASSOC)){
		$item_id = $item_type['id'];
		echo '<h4>'.ucfirst($item_type['type']).': </h4><hr>';
if($admin_location == 273){
		$query2 = "SELECT `id`,`name`,`description`,`price`,`pic`,`location`,`admin_id`,`date` FROM `items` WHERE `type` = $item_id";
} else {
		$query2 = "SELECT `id`,`name`,`description`,`price`,`pic`,`location`,`admin_id`,`date` FROM `items` WHERE `type` = $item_id AND `location` = '$admin_location'";
}
		$sth2 = $dbh->query($query2);
		if($sth2->rowCount() == 0){
			echo '<p>No Products to Display in this Category.</p>';
		}
		while($result2 = $sth2->fetch(PDO::FETCH_ASSOC)){
			display_product($result2);
		}
	echo '<span class = "clearfix"></span>';
	}
}
    
?>
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
                    <p>You are about to Delete the Product. DO you want to Proceed?</p>
                    <p class="text-warning"><small>The changes will be reflected in actual Website.</small></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="button" id = "button_proceed_delete" class="btn btn-primary">Proceed</button>
                </div>
            </div>
        </div>
    </div>

<?php
if (isset($_SESSION['item_edit']) && $_SESSION['item_edit'] == 1){
?>
<script>
swal({   title: "Product Updated Succesfully!", text: "", timer: 1000, showConfirmButton: false });
</script>
<?php
} else if (isset($_SESSION['item_edit']) && $_SESSION['item_edit'] == 0){
sweetAlert("Oops...", "Something went wrong! Some entried were not proper", "error");
}
unset($_SESSION['item_edit']);
?>	
	
<script>

$("#addproducts").addClass('active');
$(document).ready(function(){
var j= jQuery.noConflict();
j(".btn_delete").click(function(){
		id = j(this).attr('id');
		j("#deleteConfirmation").modal('show');

});
j("#button_proceed_delete").click(function(){
	j("#deleteConfirmation").modal('hide');
	j.post('delete_product.php',{id:id}, function(data){
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