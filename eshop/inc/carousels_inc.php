
<!carousel displays>
<div class = "carousel_wrapper">
	<div class = "banner">
	 <div id="sliderFrame">
        <div id="slider">
            <img src = "pics/pic-1.jpg" width = "720px" height = "200px">
            <img src = "pics/pic-2.jpg" width = "720" height = "250px">
        </div>
     </div>
	
	</div>	

	
	
	<div class = "topsellers">
		<div id="myCarousel2" class="carousel slide" data-interval="13000" data-ride="carousel">
			<div class  = "carousel-inner">
				<?php
				$location = $_SESSION['location'];
				$query1 = "SELECT `id`,`name`,`price`,`pic` FROM `items` WHERE `location` = '$location' ORDER BY `orders` DESC LIMIT 5";
				$sth1 = $dbh->query($query1);
				$count = 1;
				while ($result1 = $sth1->fetch(PDO::FETCH_ASSOC)){
					if ($count++ == 1){
						echo '<div class = "active item">';
					} else {
					echo '<div class = "item">';
					}
					echo '<div class="thumbnail">';
					echo '<img id = "'.$result1['id'].'" class = "product_details_display" src="'.$result1['pic'].'" alt="'.$result1['name'].'" style = "height:180px; !margin-top:-20px;cursor:pointer">';
					echo'</div></div>';
				}

				?>
			
				  <!-- Carousel nav -->
					<a class="carousel-control left" href="#myCarousel2" data-slide="prev" style = "width:10%">
						<span class="glyphicon glyphicon-chevron-left"></span>
					</a>
					<a class="carousel-control right" href="#myCarousel2" data-slide="next" style = "width:10%">
						<span class="glyphicon glyphicon-chevron-right"></span>
					</a>
			</div>
		</div>
	</div>
	<div id="ribbon-container">
<a href="services_bestsellers.php" id="ribbon">Best Sellers</a>
</div>
</div>
<span class = "clearfix"></span>


