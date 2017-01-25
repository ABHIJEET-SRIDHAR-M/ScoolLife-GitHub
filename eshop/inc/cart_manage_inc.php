<?php
include '../../common_files/core_inc.php';

/*
Cart being Loaded through Ajax.
Cart to Do following functions:
1. Load the cart from current session on page load. Ajax load called from document.ready 
2. Add item to the cart.
3. Delete item from the cart
4. Remove all items in the cart.
5. Update cart items each time one of the above is done.
6. Change items button to Added to cart after addition.

*/
//Cart Items Display function
function cart_items_display(){
	global $dbh;
	if (sizeof($_SESSION['cart']) == 0){
		echo '<h3 style = "text-align:center;">Your Cart is Empty!!!</h3>';
	} else {
		foreach($_SESSION['cart'] as $key => $id){
		$quant = $_SESSION['quantity'][$key];
		$query = "SELECT `name`,`price`,`pic` FROM `items` WHERE `id` = '$id'";
		$sth = $dbh->query($query);
		$result = $sth->fetch(PDO::FETCH_ASSOC);
		echo '			<tr>
							<td style = "min-width:150px"><img style = "height:100px;" src = "'.$result['pic'].'"></td>
							<td style = "min-width:180px">'.$result['name'].'</td>
							<td style = "min-width:170px">
								<div class="input-group" style = "width:120px;">
									  <span class="input-group-btn">
										  <button type="button" class="btn btn-default btn-number"';  
										  if ($quant == 1) {
											  echo 'disabled="disabled"';
										  }
										  echo 'data-type="minus" data-field="quant'.$id.'">
											  <span class="glyphicon glyphicon-minus"></span>
										  </button>
									  </span>
									  <input id = "quantity_'.$id.'" type="text" name="quant'.$id.'" class="form-control input-number" value="'.$quant.'" min="1" max="10">
									  <span class="input-group-btn">
										  <button type="button" class="btn btn-default btn-number" data-type="plus" data-field="quant'.$id.'" '; 
										  if ($quant == 10) {
											  echo 'disabled="disabled"';
										  }
										  echo'>
											  <span class="glyphicon glyphicon-plus"></span>
										  </button>
									  </span>
								</div>
							</td>
							<td style = "min-width:100px"><span>&#8377 </span><span class = "price_item">'.$result['price']*$quant.'</span></td>
							<td style = "width:100px"><span style = "color: #337AB7;cursor:pointer;" id = "remove_cart_'.$id.'" class = "remove_cart" href = "#">Remove</span></td>
						</tr>';
		}
	}
}

// Cart Items Operations Ajax Request
if (isset($_REQUEST['id']) && !empty($_REQUEST['id']) && isset($_REQUEST['operation']) ){
	$id = $_REQUEST['id'];
	$operation = $_REQUEST['operation'];
	switch($operation){
		case 1:
			$q = 1;
			$exists = 0;
			foreach($_SESSION['cart'] as $key=>$val){
				if ($val == $id){
					$exists = 1;
				}
			}
			if ($exists == 1){
				break;
			} else {
			array_push($_SESSION['cart'],$id);
			array_push($_SESSION['quantity'],$q);
			$_SESSION['cart_price'] = $_SESSION['cart_price'] + getfield('items','price','id',$id);
			}
			
			break;
		case 2:
			foreach($_SESSION['cart'] as $key=>$val){
				if ($val == $id){
					unset($_SESSION['cart'][$key]);
					unset($_SESSION['quantity'][$key]);
					break;
				}
			}
			$_SESSION['cart_price'] = $_SESSION['cart_price'] - getfield('items','price','id',$id);
			break;
	}
	cart_items_display();
}

//Cart Clear on location change
if(isset($_REQUEST['clear']) && !empty($_REQUEST['clear'])){
	if ($_REQUEST['clear'] == 1){
		foreach($_SESSION['cart'] as $key=>$val){
				unset($_SESSION['cart'][$key]);
				unset($_SESSION['quantity'][$key]);
			}
		$_SESSION['cart_price'] = 0;
	}
}

//Cart Display on page startup Ajax Request
if (isset($_REQUEST['display']) && !empty($_REQUEST['display'])){
	if ($_REQUEST['display'] == 1) {
		cart_items_display();	
	}
}

//Cart Number Update after cart operations
if (isset($_REQUEST['cart_num']) && !empty($_REQUEST['cart_num'])){
	if ($_REQUEST['cart_num'] == 1) {
		echo sizeof($_SESSION['cart']);
	}
}

// Cart Net Payable Update
if (isset($_REQUEST['cart_pay']) && !empty($_REQUEST['cart_pay'])){
	if ($_REQUEST['cart_pay'] == 1) {
		$_SESSION['cart_price'] = 0;
	foreach($_SESSION['cart'] as $key=>$id){
		$_SESSION['cart_price'] = $_SESSION['cart_price'] + $_SESSION['quantity'][$key]*getfield('items','price','id',$id);
	}
		unset($_SESSION['coupon_code']);
		echo $_SESSION['cart_price'];	
		
	} else if ($_REQUEST['cart_pay'] == 2){
		echo $_SESSION['cart_price'];
	}
	
	//}
}
//Cart quantity update
if (isset($_REQUEST['itemid']) && !empty($_REQUEST['itemid']) && isset($_REQUEST['quantity']) && !empty($_REQUEST['quantity'])){
	foreach($_SESSION['cart'] as $key=>$val){
		if ($val == $_REQUEST['itemid']){
			$_SESSION['quantity'][$key] = $_REQUEST['quantity'];
			break;
		}
	}
	cart_items_display();
}

?>
