<?php
include '../../common_files/core_inc.php';
$cart_size = sizeof($_SESSION['cart']);
if (isset($_REQUEST['id']) && !empty($_REQUEST['id'])){
	$id = $_REQUEST['id'];

	$query = "SELECT `name`,`price`,`pic`,`description` FROM `items` WHERE `id` = :id";
	$sth = $dbh->prepare($query);
	$sth->bindParam(':id',$id,PDO::PARAM_INT);
	$sth->execute();
	while($result = $sth->fetch(PDO::FETCH_ASSOC)){
		echo '<div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" style = "font-size:20px;">'.$result['name'].'</h4>
                </div>
                <div class="modal-body">
                <div style = "height:300px;">
				<img src="'.$result['pic'].'" class="img-thumbnail pull-left" style = "width:300px;height:300px;margin-right:20px;" alt="'.$result['name'].'">
				<div style = "height:250px;">
				<p class = "text-warning" style = "font-size:18px;">Item Description</p><hr><p class = "text-justify" style = "font-size:15px">'.$result['description'].'</p>
				</div>
				<div class = "text-justify">
				<p class = "text-muted"><small>-Any Specific Details asked in Item description can be entered at customize section of Delivery Details page during checkout.</small></p>
				
				</div>
				</div>
				<span class = "clearfix">
				<div>
				<p style =  "margin: 10px; margin-top:20px; font-size:16px">Price: <span style = "margin-left:10px;"> &#8377 '.$result['price'].'</span></p>
				</div>
                </div>
                <div class="modal-footer">';
		if ($cart_size == 0){
				echo '<button class = "btn btn-success addtocart pull-left" id = "add2cart2_'.$id.'">Add To Cart</button>';
			} else {
			$found = 0;
			foreach($_SESSION['cart'] as $val){
				if ($val == $id){
					$found = 1;
					break;
				}
			}
			if ($found == 0){
				echo '<button class = "btn btn-success addtocart pull-left" id = "add2cart2_'.$id.'">Add To Cart</button>';
			} else if ($found == 1){
				echo '<button class = "btn btn-default disabled addtocart pull-left" id = "add2cart2_'.$id.'">Added To Cart</button>';
			}
			}
		if ($cart_size == 0){
				echo '<button type="button" id = "buy_'.$id.'" class="btn btn-info buy">Buy and Checkout</button>
                </div>';
			} else {
			if ($found == 0){
				echo '<button type="button" id = "buy_'.$id.'" class="btn btn-info buy">Buy and Checkout</button>
                </div>';
			} else if ($found == 1){
				echo '<button type="button" id = "buy_'.$id.'" class="btn btn-info checkout">Check Out</button>
                </div>';
			}
			}
		
		
	}
	
}

?>