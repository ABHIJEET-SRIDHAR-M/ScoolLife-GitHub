<?php
include 'inc/core_inc.php';

$status=$_POST["status"];
$firstname=$_POST["firstname"];
$amount=$_POST["amount"];
$txnid=$_POST["txnid"];
$posted_hash=$_POST["hash"];
$key=$_POST["key"];
$productinfo=$_POST["productinfo"];
$email=$_POST["email"];
$salt="GQs7yium";
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	
	<title>Send Fresh Flowers</title>
<!Css Reset>
	<link rel="stylesheet" type="text/css" href="css/cssreset.css">
	
<! Bootstrap Css links>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-theme.min.css">

<!Select Css link>
	<link rel="stylesheet" type="text/css" href="select_master/dist/css/bootstrap-select.min.css">
<!font-awesome link>
	<link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css">

<!Custom style sheet>
<link rel="stylesheet" type="text/css" href="css/styles_mainpage.css">
<link rel="stylesheet" type="text/css" href="css/styles_services.css">

<!Alert Plugin links>
	<script src="js/alert/lib/sweet-alert.min.js"></script>
	<link rel="stylesheet" href="js/alert/lib/sweet-alert.css">
</head>
<body>
<div>
<! Main Page Header>
<?php include 'inc/header_mainpage_inc.php'; ?>

<div class = "mainbody_wrapper shadow_top">
<h2 class = "text-center" style = "	font-family: 'Slabo 27px', serif;
	padding-top:15px;">Payment Status</h2>
<hr>
<p style = "text-align:left; font-size:15px;">
<?php
If (isset($_POST["additionalCharges"])) {
       $additionalCharges=$_POST["additionalCharges"];
        $retHashSeq = $additionalCharges.'|'.$salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
        
                  }
	else {	  

        $retHashSeq = $salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;

         }
		 $hash = hash("sha512", $retHashSeq);
		 
       if ($hash != $posted_hash) {
	       echo "Invalid Transaction. Please try again";
		   }
	   else {
           	   
          echo "<h3>Thank You. Your order status is ". $status .".</h3>";
          echo "<h4>Your Transaction ID for this transaction is ".$txnid.".</h4>";
          echo "<h4>We have received a payment of Rs. " . $amount . ". Your order will be delivered on your desired date.</h4>";
//Update successful Transaction
$query1 = "UPDATE `orders` SET `paymentstatus` = 1 WHERE `id` = '$_SESSION['order_id']'";         
mysql_query($query1);

//Send Order Received Mail to Send Fresh Flowers
	$to = 'care.sendfreshflowers@gmail.com';
	$subject = 'Order Received';
	$from = 'From: Send Fresh Flowers <no-reply@sendfreshflowers.co.in>' . "\r\n";
	$body = 'Order Received from '.$_SESSION['email_customer'];
	mail ($to, $subject, $body, $from);
	
// Send Confirmation Mail to customer
	$to = $_SESSION['email_customer'];
	$from = 'From: Send Fresh Flowers <no-reply@sendfreshflowers.co.in>' . "\r\n";
	$subject = 'Order Received';
	
	$headers = "From: Send Fresh Flowers <no-reply@sendfreshflowers.co.in>" . "\r\n";
	$headers .= "CC: msandeep273@gmail.com\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

$message = '<html><body>';
$message .= "<p>Dear Customer,</p>";
$message .= "<p>We are glad to inform you that your order at Send Fresh Flowers has been successfully Placed. You can check the status of your order at our website.</p><br>";
$message .= '<p>Your Transaction Id is'. $txnid.'</p>';
$message .= '<p>For any carifications/confirmations kindly contact us on 8185985626.</p><br>';
$message .= '<p>Regards,</p>';
$message .= '<p>Send Fresh Flowers.</p>';
	mail ($to, $subject, $message, $headers);
	session_destroy();
}
		
		
		 session_destroy();
		   }         


?>
</p>
<p>View your order status at <a href = "services_trackorder.php">Track My Order</a> in Homepage</p>
</div>
</div>

</div>
<!footer>
<footer>

	<div class="footer-bottom" style = "position:absolute; bottom:0px;">
        <div class="container">
            <p class="pull-left"> Copyright © Send Fresh Flowers. All right reserved. </p>
            <div class="pull-right">
                <ul class="nav nav-pills payments">
                	<li><i class="fa fa-cc-visa"></i></li>
                    <li><i class="fa fa-cc-mastercard"></i></li>
                    <li><i class="fa fa-cc-amex"></i></li>
                    <li><i class="fa fa-cc-paypal"></i></li>
                </ul> 
            </div>
        </div>
    </div>
</footer>
</div>
<! Jquery Link>
    <script src="js/jquery.js"></script>
<! Bootstrap jscript Link>
    <script src="bootstrap/js/bootstrap.min.js"></script>

    <script src="js/mainsite_jscript.js"></script>
<!Select Js link>
<script src="select_master/dist/js/bootstrap-select.js"></script>

</body>
</html>