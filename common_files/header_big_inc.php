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
		?>
		<div class="btn-group separator">
		<button data-toggle="dropdown" class="btn dropdown-toggle" style = "color:brown;padding-left:20px;padding-right:20px;">
		<span class="fa fa-user-o" style = "color:brown;margin-right:8px"></span>
		<?php echo 'Hi '.$_SESSION['parentName']?> <span class="caret" style = "margin-left:8px"></span></button>
		<ul class="dropdown-menu" style = "margin-left:10px;width:90%">
			<li><a href="user_profile.php">Profile</a></li>
			<li><a href="#">My Orders</a></li>
			<li class="divider"></li>
			<li><a href="#">Student Role </a></li>
		</ul>
		</div>
		<?php
			} else {
		?>
			<form class="navbar-form separator" action = "<?php echo $current_file;?>" method = "POST">
				<div class="input-group" style = "margin-right:10px;">
					<span class="input-group-addon"><span class="glyphicon glyphicon-earphone"></span></span>
					<input type="text" class="form-control" name = "login_userName" placeholder="Phone Num">
				</div>
				<div class="input-group" style = "margin-right:10px;">
				<span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
				<input type="password" class="form-control" name = "login_password" placeholder="Password">					
				</div>
				<button class="btn btn-info" type="submit" name="user_pass_submit">Login</button>
			</form>
		<?php 
			}
		?>
			<div class="btn-group separator head_social">
					<button type="button" class="btn btn-warning"><a href="https://www.facebook.com/pages/Send-Fresh-Flowers/1460169447635086" target = "_blank"> <i class=" fa fa-facebook">   </i> </a></button>
					<button type="button" class="btn btn-warning"> <a href="https://twitter.com/sendflowers_sff" target = "_blank"> <i class="fa fa-twitter">   </i> </a> </button>
					<button type="button" class="btn btn-warning"><a href="http://google.com/+SendfreshflowersIndia" target = "_blank"> <i class="fa fa-google-plus">   </i> </a></button> 
			</div>
			<div class = "separator last">
			<?php if(!isset($_SESSION['user_id'])){ ?>
			<a class="btn btn-default" style = "text-decoration:none; color:black;" href="/ScoolLife-GitHub/register.php">New User</a>
			<?php } else {?>
			<a class="btn btn-default" style = "text-decoration:none; color:black;" href="<?php echo $current_file.'?logout=273'?>">Logout</a>
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