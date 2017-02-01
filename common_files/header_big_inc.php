<div class="header">
		<div class="header-logo">
			<a href="#">
				<img src="/ScoolLife-GitHub/images/logo.jpg">
			</a>
		</div>
		<div class="rightblock">						
		<?php 
			if(isset($_SESSION['user_id'])){
			$query = "SELECT `name` FROM `items` WHERE `id` = :id";
			$sth = $dbh->prepare($query);
			$sth->bindParam(':id',$id,PDO::PARAM_INT);
			$sth->execute();
			while($result = $sth->fetch(PDO::FETCH_ASSOC)){}
			} else {
		?>
			<form class="navbar-form separator">
				<input type="text" class="form-control" placeholder="Username">
				<input type="text" class="form-control" placeholder="Password">					
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
			<a class="btn btn-default" style = "text-decoration:none; color:black;" href="/ScoolLife-GitHub/register.php">New User</a>
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