<?php
include '../common_files/core_inc.php';
//Cart Management
if (!isset($_SESSION['cart'])) {
	$_SESSION['cart'] = array();
	$_SESSION['quantity'] = array();
	$_SESSION['cart_price'] = 0;
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="description" content="India's Largest Online Florist and gift shop. Gifting is now made awesome. Gift and thrill your loved ones with variety of gifts from our collection. We deliver on the day of your choice." />
<meta name="keywords" content="flowers, send flowers, send fresh flowers,send fresh flowers india, send flowers online, gift online" />
<meta name="author" content="Sandeep">
<meta name="robots" content="index, follow" />
<meta name="googlebot" content="NOODP, nofollow">
<meta name="fragment" content="!"/>
<title>ScoolLife - Order Online</title>
<!icon>
<link rel="shortcut icon" href="images/icon.jpg" type="image/x-icon"/>
<!Css Reset>
	<link rel="stylesheet" type="text/css" href="css/cssreset.css">
	
<! Bootstrap Css links>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-theme.min.css">

<!Select Css link>
	<link rel="stylesheet" type="text/css" href="select_master/dist/css/bootstrap-select.min.css">
<!font-awesome link>
	<link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css">

<!Slider Css Link>
	<link rel="stylesheet" type="text/css" href="slider/slider.css">
	
	
<!Custom style sheet>
<link rel="stylesheet" type="text/css" href="css/styles_mainpage.css">

<!Alert Plugin links>
	<script src="js/alert/lib/sweet-alert.min.js"></script>
	<link rel="stylesheet" href="js/alert/lib/sweet-alert.css">
	

<style type = "text/css">
.thumbnail{
	border-radius:10px;
}
.thumbnail:hover{
	border:1px solid #CCC;
	transform: scale(1.04);
	-webkit-transform: scale(1.04);
	-moz-transform: scale(1.04);
	-ms-transform: scale(1.04);
	-o-transform: scale(1.04);
}
</style>
	
</head>
<body>
<script type="application/ld+json">
    {
      "@context": "http://schema.org",
      "@type": "Florist",
	  "name":"Send Fresh Flowers",
      "url": "http://www.sendfreshflowers.co.in",
      "sameAs" : [ "https://www.facebook.com/pages/Send-Fresh-Flowers/1460169447635086",
    "https://twitter.com/sendflowers_sff",
    "http://google.com/+SendfreshflowersIndia"],
      "logo": "http://www.sendfreshflowers.co.in/logo.jpg",
      "contactPoint" : [
    { "@type" : "ContactPoint",
      "telephone" : "+918185985626",
      "contactType" : "customer service"
    }],
	  "email": "care@sendfreshflowers.co.in",
	  "priceRange": "Rs. 399 to Rs. 6000",
      "location": "Hyderabad"
    }
    </script>
<div>
<! Main Page Header>
<?php include 'inc/header_mainpage_inc.php'; ?>

<!Products Display>
<?php include 'inc/products_display_inc.php' ?>

<!Main Page Footer>
<?php include 'inc/footer_mainpage_inc.php' ?>

</div>
<! Jquery Link>
    <script src="js/jquery.js"></script>
<! Bootstrap jscript Link>
    <script src="bootstrap/js/bootstrap.min.js"></script>

    <script src="js/mainsite_jscript.js"></script>
<!Select Js link>
<script src="select_master/dist/js/bootstrap-select.js"></script>

<!Slider JS Link>
<script src="slider/slider.js"></script>

</body>
</html>