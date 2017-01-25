<?php
require '../inc/core_inc.php';

if(isset($_SESSION['admin_id'])){
	header('Location: admin_user.php');
}

if (isset($_POST['inputEmail']) && isset($_POST['inputPassword'])){
	$inputEmail = $_POST['inputEmail'];
	$inputPassword= $_POST['inputPassword'];
	$pswd_hash = md5($inputPassword);
	
	if(!empty($inputEmail) && !empty($inputPassword)){
		$query = "SELECT `id` FROM `admin` WHERE `email` = :email AND `password` = :pswd";
		$sth=$dbh->prepare($query);
		$sth->bindParam(':email',$inputEmail,PDO::PARAM_STR);
		$sth->bindParam(':pswd',$pswd_hash,PDO::PARAM_STR);
		$sth->execute();
		if ($result = $sth->fetch(PDO::FETCH_ASSOC)){
			$_SESSION['admin_id'] = $result['id'];
			header('Location: admin_user.php');
		} else {
			$_SESSION['user_found'] = 0;
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
	
	<!default styles>
	<style type = "text/css">
	body{
		background-color: #eee;
	}
	.form-container{
		margin-top:50px;
	}
	.form-container input,.checkbox{
		margin-bottom:10px;
	}
	.form-signin-heading{
		margin-bottom:20px;
	}
	label.error{
		color:red;
		font-style:italic;
		padding-left:5px;
		font-weight: unset;
		font-size: 15px;
	}
	form p{
		padding:10px;
	}
	</style>
	
</head>
<body>
<!site logo>

<div class = "container-fluid">
<div class = "row" style = "background-color:#F1EEEE; height:60px">
<div class = "col-md-4 col-sm-12" style  = "height:60px;margin-left:-15px;">
<img src = "../logo_placeorder.jpg" alt = "SEND FRESH FLOWERS" height=60px;>
</div>
</div>
</div>

<! Login Form>
<div class = "container form-container">
    <div class="row">
	<div class = "col-md-4 col-md-push-4">
      <form id = "login_form" class="form-signin" action = "<?php echo $current_file; ?>" method = "POST">
        <h2 class="form-signin-heading">Please Sign In</h2>
        <label for="inputEmail" class="sr-only">Email address</label>
        <div class="form-group">
  		<input type="email" name = "inputEmail" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
        </div>
		<label for="inputPassword" class="sr-only" min-length = "5">Password</label>
        <input type="password" name = "inputPassword" id="inputPassword" class="form-control" placeholder="Password" required>
        <div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me"> Remember me
          </label>
        </div>
	
<?php
	if (isset($_SESSION['user_found'])){
		if($_SESSION['user_found'] == 0){
?>	
	<div>
	<p class = "bg-danger text-danger">Username Password Mismatch</p>
	</div>
		
<?php	
		 $_SESSION['user_found'] = -1;
		}
	}
	
?>
		
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
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
</body>

</html>
