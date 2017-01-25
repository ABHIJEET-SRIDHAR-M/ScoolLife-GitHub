<!-- Form Name -->
<form id = "addadmin" class="form-horizontal" method = "POST" action = "addadmin.php">
<fieldset>

<!-- Select Location -->
<div class="form-group">
  <label class="control-label col-md-3 col-md-push-2" style = "text-align:left" for="selectbasic">Location</label>
  <div class="col-md-4 col-md-push-2">
    <select id="selectbasic" name="location" class="form-control">
     <?php
	 $location_id = $admin_location;
	 if ($location_id == 273){
		 $query = "SELECT `id`, `location` from `locations`";
		 $sth = $dbh->prepare($query);
		 $sth->execute();
		 while($result = $sth->fetch(PDO::FETCH_ASSOC)){
			echo '<option value = "'.$result['id'].'">'.$result['location'].'</option>';
		}
	 } else {
		$query = "SELECT `id`, `location` from `locations` WHERE `id` = :id";
		 $sth = $dbh->prepare($query);
		 $sth->bindParam(':id',$location_id, PDO::PARAM_INT);
		 $sth->execute();
		 while($result = $sth->fetch(PDO::FETCH_ASSOC)){
			echo '<option value = "'.$result['id'].'">'.$result['location'].'</option>';
		} 
	 }
	 ?>
    </select>
  </div>
</div>

<!-- Select Product Type -->
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
			echo '<option value = "'.$result['id'].'">'.ucfirst($result['type']).'</option>';
		}
	 ?>
    </select>
  </div>
</div>

<!-- Product Title input-->
<div class="form-group">
  <label class="control-label col-md-3 col-md-push-2" style = "text-align:left" for="textinput">Product Title</label>  
  <div class="col-md-4 col-md-push-2">
  <input id="textinput" name="title" type="text" class="form-control input-md" required>
    
  </div>
</div>

<!-- Product Description -->
<div class="form-group">
  <label class="control-label col-md-3 col-md-push-2" style = "text-align:left" for="textarea">Product Description</label>
  <div class="col-md-4 col-md-push-2">                     
    <textarea class="form-control" id="textarea" name="description" rows = "4" required></textarea>
  </div>
</div>

<!-- Price-->
<div class="form-group">
  <label class="control-label col-md-3 col-md-push-2" style = "text-align:left" for="prependedtext">Price</label>
  <div class="col-md-4 col-md-push-2">
    <div class="input-group">
      <span class="input-group-addon">Rs. </span>
      <input type = "number" id="prependedtext" name="price" class="form-control" placeholder="" required>
    </div>
    
  </div>
</div>

<!-- File Button --> 
<div class="form-group">
  <label class="control-label col-md-3 col-md-push-2" style = "text-align:left" for="filebutton">Upload Pic</label>
  <div class="col-md-4 col-md-push-2">
    <input id="filebutton" name="file" class="input-file" type="file" required>
	 <span class = "help-block"> File Type Must be jpeg/jpg only.</span>
  </div>
</div>
<!-- Button -->
<div class="form-group">
  <label class="control-label col-md-3 col-md-push-2" style = "text-align:left" for="singlebutton"></label>
  <div class="col-md-4 col-md-push-2">
    <button type = "submit" id="button_submit" name="singlebutton" class="btn btn-primary">Add Product</button>
  </div>
</div>

</fieldset>
</form>