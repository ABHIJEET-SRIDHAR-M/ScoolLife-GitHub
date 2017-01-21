<?php
include '../../common_files/core_inc.php';
function display_product($result){
$cart_size = sizeof($_SESSION['cart']);
	echo '<div class="product_wrapper">
			<div class="thumbnail">';
			echo '
			<div itemscope itemtype="http://schema.org/Product">
			<h4 id = "'.$result['id'].'" class = "product_details_display text-center" style = "margin-top:2px;margin-bottom:10px;white-space: nowrap; overflow:hidden; text-overflow: ellipsis; cursor:pointer"><span itemprop = "name">'.$result['name'].'</span></h4>
			<img itemprop = "image" id = "'.$result['id'].'" class = "product_details_display" src="'.$result['pic'].'" alt="'.$result['name'].'" style = "cursor:pointer; width:228px;height:228px;">
			<div itemprop="offers" itemscope itemtype="http://schema.org/Offer">
			<p style =  "margin: 10px; margin-top:20px; font-size:16px"><span style = "margin-left:10px;"><span itemprop = "priceCurrency" content="INR" > &#8377 </span><span itemprop = "price" content = "'.$result['price'].'">'.$result['price'].'</span></span> 
			<span class = "pull-right" style = "margin-top:-5px;">';
			if ($cart_size == 0){
				echo '<button class = "btn btn-success addtocart" id = "addtocart_'.$result['id'].'">Add To Cart';
			} else {
				$found = 0;
			foreach($_SESSION['cart'] as $val){
				if ($result['id'] == $val){
					$found = 1;
					break;
				}
			}
			if ($found == 0){
			echo '<button class = "btn btn-success addtocart" id = "addtocart_'.$result['id'].'">Add To Cart';
			} else if ($found == 1){
				echo '<button class = "btn btn-default disabled addtocart" id = "addtocart_'.$result['id'].'">Added To Cart';
			}
			}
			echo '</button></span></p></div>';
			echo'</div></div>
			</div>';
}
if (isset($_SESSION['search_key']) && !empty($_SESSION['search_key'])){
		$location = $_SESSION['location'];
		$search = '%'.$_SESSION['search_key'].'%';
		$query1 = "SELECT `id`,`name`,`price`,`pic` FROM `items` WHERE `location` = '$location' AND `name` LIKE :search_key OR `description` LIKE :search_key";
		$sth1 = $dbh->prepare($query1);
		$sth1->bindParam(':search_key',$search,PDO::PARAM_STR);
		$sth1->execute();
		if ($sth1->rowCount() == 0){
			echo '<h4>Sorry! This Product type is not avaliable in Your area. Kindly contact Customer Support for further assistance.</h4>';
		} else {
		while ($result1 = $sth1->fetch(PDO::FETCH_ASSOC)){
		display_product($result1);
		}	
		}
		unset($_SESSION['search_key']);
}
else if (isset($_REQUEST['id']) && !empty($_REQUEST['id']) && isset($_SESSION['location'])){
	$id_type = substr($_REQUEST['id'],5);
	$location = $_SESSION['location'];
		$query1 = "SELECT `id`,`name`,`price`,`pic` FROM `items` WHERE `type` = '$id_type' AND `location` = '$location'";
		$sth1 = $dbh->query($query1);
		if ($sth1->rowCount() == 0){
			echo '<h4>Sorry! This Product type is not avaliable in Your area. Kindly contact Customer Support for further assistance.</h4>';
		} else {
		while ($result1 = $sth1->fetch(PDO::FETCH_ASSOC)){
		display_product($result1);
		}	
		}
		
}

?>