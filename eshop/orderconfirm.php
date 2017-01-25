<?php
include '../common_files/core_inc.php';

if (!isset($_SESSION['sender_details'])){
	header('Location: placeorder.php');
} else if (!isset($_SESSION['delivery_details'])){
	header('Location: placeorder_deliverydetails.php');
} else if (isset($_SESSION['order_id']) && isset($_SESSION['cart']) && !empty($_SESSION['cart'])){
	$id = $_SESSION['order_id'];
	
	foreach($_SESSION['cart'] as $key=>$value){
	$quantity = $_SESSION['quantity'][$key];
	$query = "INSERT INTO `order_details` (`order_id`,`item_id`,`quantity`) VALUES ($id,$value,$quantity)";
	$sth = $dbh->query($query);
	}
	$nettotal = $_SESSION['cart_price'];
	$query1 = "UPDATE `orders` SET `totalcost` = '$nettotal' WHERE `id` = '$id'";
	$sth1 = $dbh->query($query1);
//Generate Random transaction Id
$txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);

// Update Transaction Id in data base.
	$query2 = "UPDATE `orders` SET `txnid` = '$txnid' WHERE `id` = '$id'";
	$sth2 = $dbh->query($query2);
	
// Payumoney Post for payment

// Merchant key here as provided by Payu
$MERCHANT_KEY = "iP6YTC";

// Merchant Salt as provided by Payu
$SALT = "aXQXERjl";

// End point - change to https://secure.payu.in for LIVE mode
//$PAYU_BASE_URL = "https://test.payu.in";
$PAYU_BASE_URL = "https://secure.payu.in";

$posted = array();

$posted['key'] = $MERCHANT_KEY;
$posted['txnid'] = $txnid;
$posted['amount'] = $nettotal;
$posted['productinfo'] = "Flowers";
$posted['firstname'] = getfield('orders','nameofsender','id',$_SESSION['order_id']);
$posted['email'] = getfield('orders','emailofsender','id',$_SESSION['order_id']);
$posted['phone'] = getfield('orders','phoneofsender','id',$_SESSION['order_id']);
$posted['surl'] = "http://www.scoollife.com/payment_success.php";
$posted['furl'] = "http://www.scoollife.com/payment_fail.php";

// Hash Sequence
$hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";

$hashVarsSeq = explode('|', $hashSequence);
    $hash_string = '';	
	foreach($hashVarsSeq as $hash_var) {
      $hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
      $hash_string .= '|';
    }

    $hash_string .= $SALT;


    $hash = strtolower(hash('sha512', $hash_string));
    $action = $PAYU_BASE_URL . '/_payment';

$posted['hash'] = $hash;
$posted['service_provider'] = "payu_paisa";
}

?>
<html>
<head>
</head>
<body onload="payuForm.submit();">
<h2>Please Wait...</h2>
<form action="<?php echo $action; ?>" method="post" name="payuForm">
      <input type="hidden" name="key" value="<?php echo $posted['key'] ?>" />
      <input type="hidden" name="hash" value="<?php echo $posted['hash'] ?>"/>
      <input type="hidden" name="txnid" value="<?php echo $posted['txnid'] ?>" />
      <input type="hidden" name="amount" value="<?php echo $posted['amount'] ?>" />
      <input type="hidden" name="firstname" value="<?php echo $posted['firstname'] ?>" />
      <input type="hidden" name="email" value="<?php echo $posted['email'] ?>" />
      <input type="hidden" name="phone" value="<?php echo $posted['phone'] ?>" />
      <input type="hidden" name="productinfo" value="<?php echo $posted['productinfo'] ?>" />
      <input type="hidden" name="surl" value="<?php echo $posted['surl'] ?>" />
      <input type="hidden" name="furl" value="<?php echo $posted['furl'] ?>" />
      <input type="hidden" name="service_provider" value="<?php echo $posted['service_provider'] ?>" />
	  
</form>

</body>
</html>