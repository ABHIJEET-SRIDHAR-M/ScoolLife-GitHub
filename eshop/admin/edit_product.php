<?php
require '../inc/core_inc.php';
require 'checksession_inc.php';
$admin_location = getfield('admin','location','id',$_SESSION['admin_id']);
if(isset($_GET['id']) && !empty($_GET['id'])){
	$product_id = $_GET['id'];
	$_SESSION['edit_product_id'] = $product_id;
	$query = "SELECT `name`,`description`,`type`,`price`,`pic`,`location`,`admin_id`,`date` FROM `items` WHERE `id` = :id";
	$sth = $dbh->prepare($query);
	$sth->bindParam(':id',$product_id,PDO::PARAM_INT);
	$sth->execute();
	$result = $sth->fetch(PDO::FETCH_ASSOC);
}
// Form processing - product updation

if(isset($_POST['title']) && isset($_POST['description']) && isset($_POST['price']) && isset($_FILES['file']['name'])){
		$type = $_POST['product_type'];
		$title = $_POST['title'];
		$description = $_POST['description'];
		$price = $_POST['price'];
		$location = $_POST['location'];
		if(!empty($title) && !empty($description) && !empty($price)){
			$query = "UPDATE `items` SET `type` = :type,`name` = :name,`description` = :description,`price` = :price,`location` = :location,`admin_id` = :admin_id WHERE `id` = :id";
			$sth = $dbh->prepare($query);
			$sth->bindParam(':type',$type,PDO::PARAM_INT);
			$sth->bindParam(':name',$title,PDO::PARAM_STR);
			$sth->bindParam(':description',$description,PDO::PARAM_STR);
			$sth->bindParam(':price',$price,PDO::PARAM_INT);
			$sth->bindParam(':location',$location,PDO::PARAM_INT);
			$sth->bindParam(':admin_id',$_SESSION['admin_id'],PDO::PARAM_INT);
			$sth->bindParam(':id',$_SESSION['edit_product_id'],PDO::PARAM_INT);
			$sth->execute();
						
			if (!empty($_FILES['file']['name'])){
				$item_id = $_SESSION['edit_product_id'];
				unset($_SESSION['edit_product_id']);
				$name_pic_received = $_FILES['file']['name'];
				$extension = substr($name_pic_received,strpos($name_pic_received,'.')+1);
				
				if ($extension == 'jpeg' || $extension == 'jpg'){
					$size = $_FILES['file']['size'];
					if($size !=0){
						$name = "img_".$item_id;
						$temp_name = $_FILES['file']['tmp_name'];
						$location = '../pics/'.$name.'.'.$extension;
						$location_save='pics/'.$name.'.'.$extension;
						if (move_uploaded_file($temp_name,$location)){
							$query = "UPDATE `items` SET `pic` = :path WHERE `id` = :id";
							$sth = $dbh->prepare($query);
							$sth->bindParam(':path',$location_save,PDO::PARAM_STR);
							$sth->bindParam(':id',$item_id,PDO::PARAM_INT);
							if ($sth->execute()){
								$_SESSION['item_edit'] = 1;
								header('location: admin_dashboard_editproduct.php');
							} else {
								$_SESSION['item_edit'] = 0;
								header('location: admin_dashboard_editproduct.php');
							}
						}
					} else {
						$_SESSION['item_edit'] = 0;
						header('location: admin_dashboard_editproduct.php');
					}	
				} else {
					$_SESSION['item_edit'] = 0;
					header('location: admin_dashboard_editproduct.php');
				}
			} else {
				$_SESSION['item_edit'] = 1;
				header('location: admin_dashboard_editproduct.php');
			}
		}
	}

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
        <li class="active"><a href="admin_dashboard_editproduct.php"><span class="glyphicon glyphicon-pencil"></span>  Edit Products</a></li>
        <li><a href="admin_productsdashboard.php"><span class="glyphicon glyphicon-plus"></span>  Add Products</a></li>
<?php 
if ($admin_location == 273){
?>
        <li><a href="admin_dashboard_edittype.php"><span class="glyphicon glyphicon-pencil"></span> Edit Product Type</a></li>
        <li><a href="admin_dashboard_addtype.php"><span class="glyphicon glyphicon-plus"></span> Add Product Type</a></li>
<?php } ?>
    </ul>
</div>
<a href="admin_dashboard_editproduct.php" class = "btn btn-primary"><span class="glyphicon glyphicon-arrow-left"></a>
<div>
</div>
<!-- Form Name -->
<form id = "upload" class="form-horizontal" enctype = "multipart/form-data" method = "POST" action = "edit_product.php">
<fieldset>


<!-- Product Title input-->
<div class="form-group">
  <label class="control-label col-md-3 col-md-push-2" style = "text-align:left" for="textinput"">Product Title</label>  
  <div class="col-md-4 col-md-push-2">
  <input id="textinput" name="title" type="text" class="form-control input-md"  value = "<?php echo $result['name'];?>" style = "overflow:hidden" required>
    
  </div>
</div>

<!-- Product Description -->
<div class="form-group">
  <label class="control-label col-md-3 col-md-push-2" style = "text-align:left" for="textarea">Product Description</label>
  <div class="col-md-4 col-md-push-2">                     
    <textarea class="form-control" id="textarea" name="description" rows = "4" required><?php echo $result['description'];?></textarea>
  </div>
</div>

<!-- Price-->
<div class="form-group">
  <label class="control-label col-md-3 col-md-push-2" style = "text-align:left" for="prependedtext">Price</label>
  <div class="col-md-4 col-md-push-2">
    <div class="input-group">
      <span class="input-group-addon">Rs. </span>
      <input type = "text" id="prependedtext" name="price" class="form-control" placeholder="" value = "<?php echo $result['price'];?>" required>
    </div>
    
  </div>
</div>

<!-- Select Product Type -->
<div class="form-group">
  <label class="control-label col-md-3 col-md-push-2" style = "text-align:left" for="selectbasic">Product Type</label>
  <div class="col-md-4 col-md-push-2">
    <select id="product_type" name="product_type" class="form-control">
     <?php
	 $location_id = $admin_location;
		$query1 = "SELECT `id`, `type` from `items_type`";
		 $sth1 = $dbh->prepare($query1);
		 $sth1->execute();
		 while($result1 = $sth1->fetch(PDO::FETCH_ASSOC)){
			echo '<option value = "'.$result1['id'].'" ';
			if ($result1['id'] == $result['type']){
				echo 'selected = "selected"';
			}
			echo '>'.ucfirst($result1['type']).'</option>';
		}
	 ?>
    </select>
  </div>
</div>

<!-- Select Location -->
<div class="form-group">
  <label class="control-label col-md-3 col-md-push-2" style = "text-align:left" for="selectbasic">Location</label>
  <div class="col-md-4 col-md-push-2">
    <select id="selectbasic" name="location" class="form-control">
     <?php
	 $location_id = $admin_location;
	 if ($location_id == 273){
		 $query2 = "SELECT `id`, `location` from `locations`";
		 $sth2 = $dbh->prepare($query2);
		 $sth2->execute();
		 while($result2 = $sth2->fetch(PDO::FETCH_ASSOC)){
			echo '<option value = "'.$result2['id'].'"';
			if ($result2['id'] == $result['location']){
				echo 'selected = "selected"';
			}
			echo '>'.$result2['location'].'</option>';
		}
	 } else {
		$query2 = "SELECT `id`, `location` from `locations` WHERE `id` = :id";
		 $sth2 = $dbh->prepare($query2);
		 $sth2->bindParam(':id',$location_id, PDO::PARAM_INT);
		 $sth2->execute();
		 while($result2 = $sth2->fetch(PDO::FETCH_ASSOC)){
			echo '<option value = "'.$result2['id'].'">'.$result2['location'].'</option>';
		} 
	 }
	 ?>
    </select>
  </div>
</div>

<!-- File Button --> 
<div class="form-group">
  <label class="control-label col-md-3 col-md-push-2" style = "text-align:left" for="filebutton">Upload Pic</label>
  <div class="col-md-4 col-md-push-2">
    <input id="filebutton" name="file" class="input-file" type="file">
	 <span class = "help-block"> File Type Must be jpeg/jpg only.</span>
	 <span class = "help-block"> Select a pic to update. If not selected, previous pic remains</span>
  </div>
</div>
<!-- Button -->
<div class="form-group">
  <label class="control-label col-md-3 col-md-push-2" style = "text-align:left" for="singlebutton"></label>
  <div class="col-md-4 col-md-push-2">
    <button type = "submit" id="button_submit" name="singlebutton" class="btn btn-primary">Update Product</button>
  </div>
</div>

</fieldset>
</form>
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
swal({   title: "Product Added Succesfully!",   text: "",   timer: 2000,   showConfirmButton: false });
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