<?php
	if(isset($_POST['login_userName']) && isset($_POST['login_password'])){
		$query = "SELECT `id`, `password`,`name` FROM `parents` WHERE `phone` = :phone";
		$sth = $dbh->prepare($query);
		$sth->bindParam(':phone',$_POST['login_userName'],PDO::PARAM_STR);
		$sth->execute();
		$result = $sth->fetch(PDO::FETCH_ASSOC);
		if($sth->rowCount() == 1){
			if(password_verify($_POST['login_password'],$result['password'])){
			//User Login Success
				$_SESSION['user_id'] = $result['id'];
				$_SESSION['parentName'] = $result['name'];
			} else {
			//Invalid Password
				echo 'Invalid Login';
			}
		} else {
			// No user with the details exist
			echo 'Invalid Login';
		}
	}
?>
<div class="header">
		<div class="header-logo">
			<a href="#">
				<img src="/ScoolLife-GitHub/images/logo.jpg">
			</a>
		</div>
		<div class="rightblock">						
		<?php 
			if(isset($_SESSION['user_id'])){
			echo '<span>Welcome '.$_SESSION['parentName'].'</span>';
			} else {
		?>
			<form class="navbar-form separator" action = "<?php echo $current_file;?>" method = "POST">
				<input type="text" class="form-control" name = "login_userName" placeholder="Phone Num">
				<input type="password" class="form-control" name = "login_password" placeholder="Password">					
				<button class="btn btn-info" type="submit" name="user_pass_submit">Login</button>
			</form>
		<?php 
			}
			
			
		?>
			<div class="btn-group separator">
					<button type="button" class="btn btn-warning"><a href="https://www.facebook.com/pages/Send-Fresh-Flowers/1460169447635086" target = "_blank"> <i class=" fa fa-facebook">   </i> </a></button>
					<button type="button" class="btn btn-warning"> <a href="https://twitter.com/sendflowers_sff" target = "_blank"> <i class="fa fa-twitter">   </i> </a> </button>
					<button type="button" class="btn btn-warning"><a href="http://google.com/+SendfreshflowersIndia" target = "_blank"> <i class="fa fa-google-plus">   </i> </a></button> 
			</div>
			<div class = "separator last">
			<?php if(!isset($_SESSION['user_id'])){ ?>
			<a class="btn btn-default" style = "text-decoration:none; color:black;" href="/ScoolLife-GitHub/register.php">New User</a>
			<?php } else {?>
			<a class="btn btn-default" style = "text-decoration:none; color:black;" href="/ScoolLife-GitHub/index.php?logout=273">Logout</a>
			<?php } ?>
			</div>
		</div>
		<div class="down-navbar">
			<ul>
				<li><a href="/ScoolLife-GitHub/index.php">Home</a></li>
				<li><a href="#">Pay Fees</a></li>
				<li><a href="/ScoolLife-GitHub/eshop/eshop.php">Buy Online</a></li>
				<li><a href="#">Student Corner</a></li>
				<li><a href="#">Events</a></li>
			</ul>
			<ul style = "margin-left:10px;">
				<li><a href="#">About Us</a></li>
				<li><a href="#">Help</a></li>
				<li><a href="#">Contact Us</a></li>
			</ul>
		</div>
</div>