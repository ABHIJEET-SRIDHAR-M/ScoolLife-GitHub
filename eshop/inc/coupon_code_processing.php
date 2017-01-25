<?php
include '/ScoolLife-GitHub/common_files/core_inc.php';

if (isset($_REQUEST['code']) && !empty($_REQUEST['code'])){
	if ($_REQUEST['code'] == "FIRST100"){
		$_SESSION['cart_price'] -= 100;
		$_SESSION['coupon_code'] = 'Promo Code Succesfully applied. Discount of Rs. 100 on Net total';
		echo $_SESSION['coupon_code'];
	} else {
		echo 'Please Enter a valid coupon Code.<span id = "coupon_tryagain" style = "color:blue;cursor:pointer">Try Again</span>';
	}
} else {
	echo 'Please Enter a valid coupon Code.<span id = "coupon_tryagain" style = "color:blue;cursor:pointer">Try Again</span>';
}

?>