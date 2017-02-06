<!DOCTYPE html>
<?php
include 'common_files/core_inc.php';

if(isset($_SESSION['user_id'])){
	header('Location: index.php');
}
//If redirected from a page in our website, user whld be redirected back to that page after registration
if(!empty($_GET['redirect'])){
}
?>
<html lang="en">
	<head>
			<meta charset="utf-8">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<title>Register with ScoolLife </title>
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
			<!--Select Css link-->
			<link rel="stylesheet" type="text/css" href="eshop/select_master/dist/css/bootstrap-select.min.css">
			<!---Custom Css Links -->
			<link rel="stylesheet" type="text/css" href="css/mainpage_styles.css">
			<link rel="stylesheet" type="text/css" href="css/header_styles.css">
			<link rel="stylesheet" type="text/css" href="css/register_styles.css">
			<link rel="stylesheet" type="text/css" href="css/footer_styles.css">
	</head>
	<body>
		<!-- Header -->
		<?php include 'common_files/header_big_inc.php';
		if(isset($_POST['name']) && isset($_POST['password']) && isset($_POST['phone']) && isset($_POST['email'])){
			//User has registered as Parent
			if(!empty($_POST['name']) && !empty($_POST['password']) && !empty($_POST['phone']) && !empty($_POST['email'])){
					$phone = $_POST['phone'];
				//First search if the user is already registered
					$query = "SELECT `id` FROM `parents` WHERE `phone` = :phone";
					$sth = $dbh->prepare($query);
					$sth->bindParam(':phone',$phone,PDO::PARAM_INT);
					$sth->execute();
					$result = $sth->fetch(PDO::FETCH_ALL);
				if(count($result) > 0){
				// User already registered TODO : SANDEEP
					echo 'User already exists!';
				} else {
				//user not already registered, register him in parents table
					//Hash password for safety
					$pass = $_POST['password'];
					$pass_hash = password_hash($pass, PASSWORD_DEFAULT);
					$query = "INSERT INTO `parents` (name,password,phone,email) VALUES (:name,:password,:phone,:email)";
					$sth = $dbh->prepare($query);
					$sth->bindParam(':name',$_POST['name'],PDO::PARAM_STR);
					$sth->bindParam(':password',$pass_hash,PDO::PARAM_STR);
					$sth->bindParam(':phone',$_POST['phone'],PDO::PARAM_STR);
					$sth->bindParam(':email',$email,PDO::PARAM_STR);
					$sth->execute();
					$_SESSION['user_id'] = $dbh->lastInsertId();
					$_SESSION['parentName'] = $_POST['name'];
					//Redirect User from where he was directed //TODO : SANDEEP
					header('Location: index.php');
				}
			} else {
				//Some input param not entered
				echo 'All Inputs not entered';
			}
		} else if (isset($_POST['name']) && isset($_POST['phone']) && isset($_POST['class']) && isset($_POST['gender']) && isset($_POST['school'])){
			//User has registered as Student
				//Check if all inputs are entered
				if(!empty($_POST['name']) && !empty($_POST['phone']) && !empty($_POST['class']) && !empty($_POST['gender']) && !empty($_POST['school'])){
				//Check if a parent has already registered with same phone number
					$query = "SELECT `id`, `name`, `num_children` FROM `parents` WHERE `phone` = :phone";
					$sth = $dbh->prepare($query);
					$sth->bindParam(':phone',$phone,PDO::PARAM_INT);
					$sth->execute();
					$result = $sth->fetch(PDO::FETCH_ALL);
					if(count($result) > 0){
					// Parent with same id exists 
						//Inform the student to merge the account 
						?>
							<div id="mergeInfoModal" class="modal fade" data-backdrop="static" style="margin-top:150px;">
								<div class="modal-dialog" style = "width:400px;">
									<div class="modal-content" style = "border: 5px solid #f2f2f2;height:200px;">
										<div class="modal-header" style = "border-bottom:2px solid #B80000">
											<h3 class="modal-title" style = "color: #B80000; text-align:center">Assosciated Parent Account found</h3>
										</div>
										<div class="modal-body">
											<div style = "margin-top:5px;">
											<p><?php echo $result['name']?> has already registered with the entered mobile number. Your account will be merged with your parents account.</p>
											</p>Password should be obtained from the parent.</p>
											</div>
										</div>
									</div>
								<div class="modal-footer">
									<a href = "placeorder.php" id = "proceed_merge" type="button" class="btn btn-primary" style = "width:220px; font-size:16px;">Proceed<span class = "glyphicon glyphicon-chevron-right"></span></a>
								</div>

								</div>
							</div>						
						<?php
						
					} else {
					// No Parent account exists
					?>	
					<div id="studentPswdModal" class="modal fade" data-backdrop="static" style="margin-top:150px;">
								<div class="modal-dialog" style = "width:400px;">
									<div class="modal-content" style = "border: 5px solid #f2f2f2;height:200px;">
										<div class="modal-header" style = "border-bottom:2px solid #B80000">
											<h3 class="modal-title" style = "color: #B80000; text-align:center">No Assosciated Parent Account found. Set Password</h3>
										</div>
										<div class="modal-body">
											<div style = "margin-top:5px;">
											<form class="form-horizontal" action = "<?php echo $current_file ?>" method = "POST">
												<div class="form-group" style = "margin-bottom:2px;">
													<label class="control-label col-xs-4" style = "text-align:left" for="phoneNumber">Password:</label>
													<div class="col-xs-8">
														<input class="form-control" type = "password" name = "password" id = "password" required>
														<span class = "help-block">No restrictions! Feel free to set what u like :D</span>
													</div>
												</div>
												<div class="form-group" style = "margin-bottom:5px;">
													<label class="control-label col-xs-4" style = "text-align:left" for="phoneNumber">Confirm Password:</label>
													<div class="col-xs-8">
														<input class="form-control" type = "password" id= "confirm_password" required>
													</div>
												</div>
											</form>
											</div>
										</div>
									</div>
								</div>
							</div>
					<?php
					}
				
				} else {
				// All inputs not entered.
				echo 'All Inputs not entered';
				}
		} else {
		
	?>
		<!-- Select User Role - Parent/ Student Modal -->
			<div id="selectionModal" class="modal fade" data-backdrop="static" style="margin-top:150px;">
				<div class="modal-dialog" style = "width:400px;">
					<div class="modal-content" style = "border: 5px solid #f2f2f2;height:200px;">
						<div class="modal-header" style = "border-bottom:2px solid #B80000">
							<h3 class="modal-title" style = "color: #B80000; text-align:center">Register with ScoolLife!!</h3>
						</div>
						<div class="modal-body">
							<div style = "margin-top:5px;">
								<button id = "parent_btn" class = "btn btn-success" style = "margin-left:40px;">I am a Parent</button>
								<button id = "student_btn" class = "btn btn-warning" style = "margin-left:50px;">I am a Student</button>
								<button id = "shopper_btn" class = "btn btn-danger" style = "margin-top:20px;margin-left:90px;">I just want to shop online!</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		<!-- Main Body -->
		<div class = "main_body" style = "width:600px">
		<h3 style = "text-align:center;border-bottom: 1px inset #B80000;padding:10px;color:#A80000">Register</h3>
		<!-- Form for Parents -->
			<div class="reg_form" id = "reg_form_parent">
				<form class="form-horizontal" action = "<?php echo $current_file ?>" method = "POST">
					<div class="form-group" style = "margin-bottom:2px;">
						<label class="control-label col-xs-4" style = "text-align:left">Phone No:</label>
						<div class="col-xs-8">
							<input pattern="[1-9]{1}[0-9]{9}" class="form-control" id="phoneNumber" name = "phone" placeholder="Phone Number" required>
							<span class = "help-block">To be used for Login. Format: 7730889469</span>
						</div>
					</div>
					<div class="form-group" style = "margin-bottom:2px;">
						<label class="control-label col-xs-4" style = "text-align:left" for="phoneNumber">Password:</label>
						<div class="col-xs-8">
							<input class="form-control" type = "password" name = "password" id = "password" required>
							<span class = "help-block">No restrictions! Feel free to set what u like :D</span>
						</div>
					</div>
					<div class="form-group" style = "margin-bottom:2px;">
						<label class="control-label col-xs-4" style = "text-align:left" for="phoneNumber">Confirm Password:</label>
						<div class="col-xs-8">
							<input class="form-control" type = "password" id= "confirm_password" required>
						</div>
					</div>
					<div class="form-group" style = "padding-bottom:10px;">
						<label class="control-label col-xs-4" style = "text-align:left">Name :</label>
						<div class="col-xs-8">
							<input type="text" class="form-control" id="name_recipient" name = "name" placeholder="Full Name" required>
						</div>
					</div>
					<div class="form-group" style = "padding-bottom:10px;">
						<label class="control-label col-xs-4" style="text-align:left" for="inputEmail">Email:</label>
						<div class="col-xs-8">
						<input pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" title="Please Enter Valid Email Address." class="form-control" id="inputEmail" placeholder="Email (Optional)" name="email_sender">
						</div>
					</div>					
					<div class="form-group">
						<div class="col-xs-offset-4 col-xs-8" style = "margin-bottom:20px;">
							<button type="submit" class="btn btn-primary">Register!</button>
						</div>
					</div>
				</form>
			</div>	
		<!-- Form for Students -->
			<div class="reg_form" id = "reg_form_student" style="display:none">
				<form class="form-horizontal" action = "" method = "POST">
					<div class="form-group" style = "margin-bottom:2px;">
						<label class="control-label col-xs-4" style = "text-align:left">Phone No:</label>
						<div class="col-xs-8">
							<input pattern="[1-9]{1}[0-9]{9}" class="form-control" id="phoneNumber" name = "phone" placeholder="Phone Number" required>
							<span class = "help-block">To be used for Login. Format: 7730889469</span>
						</div>
					</div>
					<div class="form-group" style = "padding-bottom:5px;">
						<label class="control-label col-xs-4" style = "text-align:left">Name :</label>
						<div class="col-xs-8">
							<input type="text" class="form-control" id="name_student" name = "name" placeholder="Full Name" required>
						</div>
					</div>
					<div class="form-group" style = "padding-bottom:10px;">
					<label class="control-label col-xs-4" style = "text-align:left">Gender :</label>
							<div class="radio">
							  <label style="margin-left:15px">
								<input type="radio" name="gender" id="optionsRadios1" value="1" />
								Male
							  </label>
							  <label>
								<input type="radio" name="gender" id="optionsRadios2" value="2" />
								Female
							  </label>
							</div>
					</div>		
					<div class="form-group" style = "padding-bottom:10px;">
						<label class="control-label col-xs-4" style = "text-align:left">Class :</label>
							<select id = "class_select" name = "class" class = "col-xs-8 selectpicker">
							<option value = "11">LKG</option>
							<option value = "12">UKG</option>
							<option value = "1">1</option>
							<option value = "2">2</option>
							<option value = "3">3</option>
							<option value = "4">4</option>
							<option value = "5">5</option>
							<option value = "6">6</option>
							<option value = "7">7</option>
							<option value = "8">8</option>
							<option value = "9">9</option>
							<option value = "10">10</option>
							</select>
					</div>	
					
					<div class="form-group">
						<div class="col-xs-offset-4 col-xs-8" style = "margin-bottom:20px;">
							<button type="submit" class="btn btn-primary">Register!</button>
						</div>
					</div>
				</form>
				
			</div>
		</div>
		
	<?php 
	}
	?>
	<!-- Footer -->
	<?php include 'common_files/footer_big_inc.php' ?> 
	
	<!-- Java Script Links -->
	<script src="js/jquery.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
	<!--Select Js link-->
	<script src="eshop/select_master/dist/js/bootstrap-select.js"></script>
	<script src="js/register.js"></script>
	
	</body>
</html>