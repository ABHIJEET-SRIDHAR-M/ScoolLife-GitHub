<?php
include 'inc/core_inc.php';
//Cart Management
if (!isset($_SESSION['cart'])) {
	header('Location: index.php');
} else if ($_SESSION['cart_price'] == 0){
	header('Location: index.php');
}
if (!isset($_SESSION['sender_details'])){
	header('Location: placeorder.php');
} else if (!isset($_SESSION['delivery_details'])){
	header('Location: placeorder_deliverydetails.php');
} else if (isset($_SESSION['order_id'])){
	$id = $_SESSION['order_id'];
	$query = "SELECT * FROM `orders` WHERE `id` = '$id'";
	$sth = $dbh->query($query);
	$order_details = $sth->fetch(PDO::FETCH_ASSOC);
}
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

<!Date Picker Link>	
<link rel="stylesheet" type="text/css" href="datepicker/css/bootstrap-datetimepicker.min.css">

<!Custom style sheet>	
<link rel="stylesheet" type="text/css" href="css/styles_placeorder.css">

<!Alert Plugin links>
	<script src="js/alert/lib/sweet-alert.min.js"></script>
	<link rel="stylesheet" href="js/alert/lib/sweet-alert.css">

<!Google Fonts API Sablo Link>
	<link href='http://fonts.googleapis.com/css?family=Slabo+27px' rel='stylesheet' type='text/css'>

<style type = "text/css">
.tab-content{
	padding-top:0px;
	width:600px;
}
.block_heading{
	border-bottom:2px solid #eee;
	padding:5px;
}
.block_heading h4{
	margin-left:250px;
	float:left;
	
}
.block_heading h5{
	float:right;
}
.block_content{
	padding:10px 0px;
}
.block_row{
	padding:10px 0px;
}
.block_row .field{
	float:left;
	width:100px;
}
.block_row .info{
	float:left;
	text-align:left;
}
.confirm_button{
	text-align:center;
	margin:20px 0px;
}
</style>	
	
</head>
<body>

<! Main Page Header>
<?php include 'inc/header_placeorder_inc.php'; ?>
<span class = "clearfix"></span>
<div class = "placeorder_wrapper">
<div class = "placeorder_info shadow">
<! navbar for placing order>	
	    
<div class="breadcrumb flat">
	<a href="placeorder.php">My Info</a>
	<a href="placeorder_deliverydetails.php">Delivery Details</a>
	<a href="placeorder_confirmation.php" class="active">Order Confirmation</a>
	<a class = "pointer">Payment Method</a>
</div>

	
<! form content>
	<div class = "tab-content">
	<div id = "order_confirmation" class="tab-pane active">

	
	<div class = "display_block">
		<div class = "block_heading">
		<h4>My Info</h4>
		<h5><a href = "placeorder.php"><span style = "margin-right:3px;" class="glyphicon glyphicon-pencil"></span><span>Modify</span></a></h5>
		<span class = "clearfix"></span>
		</div>		
		
			<div class = "block_content">
				<div class = "block_row">
					<div class = "field">Name: </div>
					<div class = "info"><?php echo $order_details['nameofsender']; ?></div>
				</div>
				<span class = "clearfix"></span>
				<div class = "block_row">
					<div class = "field">Email: </div>
					<div class = "info"><?php echo $order_details['emailofsender']; ?></div>
				</div>
				<span class = "clearfix"></span>
				<div class = "block_row">
					<div class = "field">Phone: </div>
					<div class = "info"><?php echo $order_details['phoneofsender'] ?></div>
				</div>
				<span class = "clearfix"></span>
			</div>
	</div>
	
	<div class = "display_block">
		<div class = "block_heading">
		<h4 style = "margin-left:225px;">Delivery Details</h4>
		<h5><a href = "placeorder_deliverydetails.php"><span style = "margin-right:3px;" class="glyphicon glyphicon-pencil"></span><span>Modify</span></a></h5>
		<span class = "clearfix"></span>
		</div>		
		
			<div class = "block_content">
				<div class = "block_row">
					<div class = "field">Address: </div>
					<div class = "info">
					<p><?php echo $order_details['nameofrecipient'] ?>,</p>
					<p><?php echo $order_details['addressofrecipient_line1'] ?>,</p>
					<p><?php echo $order_details['addressofrecipient_line2'] ?>,</p>
					<p><?php echo $order_details['locationofrecipient'] ?>.</p>
					<p>Pincode: <?php echo $order_details['pincodeofrecipient'] ?></p>
					</div>
				</div>
				<span class = "clearfix"></span>
				<div class = "block_row">
					<div class = "field">Phone: </div>
					<div class = "info"><?php echo $order_details['phoneofrecipient'] ?></div>
				</div>
				<span class = "clearfix"></span>
				<div class = "block_row">
					<div class = "field">Date: </div>
					<div class = "info"><?php echo $order_details['deliverydate'] ?></div>
				</div>
				<span class = "clearfix"></span>
				<div class = "confirm_button">
					<a href = "orderconfirm.php" class = "btn btn-success">Place Order</a>
				</div>
			</div>
	</div>
	
	</div>
</div>
</div>
<div class = "placeorder_orderdetails shadow">
<h3>Order Summary</h3>
<div id = "orderdetails_table">
<table class = "table table-hover orderdetails_table">
	<thead>
		<tr>
			<th min-width = "100px">Item</th>
			<th min-width = "50px" style = "text-align:center">Quantity</th>
			<th min-width = "150px" style = "text-align:center">Price</th>
		</tr>
	</thead>
	<tbody>
<?php
	foreach($_SESSION['cart'] as $key=>$id){
		echo '
		<tr>
			<td min-width = "100px"><img class = "img-circle" width = "50px" src = "'.getfield('items','pic','id',$id).'"><p>'.getfield('items','name','id',$id).'</p></td>
			<td min-width = "50px" style = "text-align:center">'.$_SESSION['quantity'][$key].'</td>
			<td min-width = "150px" style = "text-align:center"><span>&#8377 </span>'.$_SESSION['quantity'][$key]*getfield('items','price','id',$id).'</td>
		</tr>';	
	}
?>
	<tr style = "font-size:18px;color:#B91845;font-weight:bold">
		<td colspan = "2" style = "text-align:right;"> Net Payable: </td>
		<td style = "text-align:center;"><span>&#8377 </span><?php echo $_SESSION['cart_price']; ?></td>
	</tr>
	
<!Coupon Code block>
<?php 
	if (!isset($_SESSION['coupon_code'])){
?>	
	<tr style = "font-size:13px;color:blue;">
		<td id = "show_coupon_code" colspan = "3" style = "text-align:right;cursor:pointer"> Have a Promo code?</td>
	</tr>
	<tr id = "coupon_status_block" style = "font-size:13px;color:blue;display:none;">
		<td id = "coupon_code_status" colspan = "3" style = "text-align:left;">Applying Coupon...</td>
	</tr>
	<tr id = "coupon_display" style = "font-size:13px; display:none">
		<td colspan = "2" style = "text-align:left;"> <input id = "coupon_code" type = "text" class = "form-control" style = "height:30px;margin-top:10px" placeholder = "Promo Code"> </td>
		<td  style = "text-align:right;"> <button id = "coupon_discount" class = "btn btn-default" style = "height:30px;padding:4px 12px;margin-top:10px">Apply</button> </td>
	</tr>
<?php
} else {
	echo '<tr id = "coupon_status_block" style = "font-size:13px;color:blue;">
		<td id = "coupon_code_status" colspan = "3" style = "text-align:left;">'.$_SESSION['coupon_code'].'</td>
	</tr>';
}
?>

	
	</tbody>
</table>
</div>
<div class = "ordersummary_buttons">
	<a href = "index.php" class = "btn btn-success pull-left" ><span class="glyphicon glyphicon-arrow-left"></span> Shop More</a>
	<button class = "btn btn-warning pull-right" href = "#myModal_cart" data-toggle="modal"><span class="glyphicon glyphicon-pencil"></span> Modify</button>
</div>
</div>
</div>



<!Cart Modal>

<div id="myModal_cart" class="modal fade">
    <div class="modal-dialog" style = "width:800px;">
        <div class="modal-content" style = "border: 5px solid #f2f2f2;height:490px;">
            <div class="modal-header" style = "border-bottom:2px solid #B80000">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style = "font-size:38px;">&times;</button>
                <h3 class="modal-title" style = "color: #B80000" ><span class = "glyphicon glyphicon-shopping-cart" style = "font-size:20px;padding-right:10px; "></span>MY CART</h3>
            </div>
            <div class="modal-body">
			<p class = "pull-left" style = "font-size:18px;"><span id = "cart_modal_item_num"><?php echo sizeof($_SESSION['cart']);?></span> Item(s) in Your Cart</p>
			<p class = "pull-right" style = "font-size:20px;margin-right:10px;"> Net Payable:<span> &#8377 </span> <span id = "net_payable"><?php echo $_SESSION['cart_price']; ?></span><span style = "font-size:13px"> (Free Delivery)</small></p>
			<span class = "clearfix"></span>
				<div style = "height:280px; margin-top:5px;">
				<table class="table ctable" cellspacing="0" cellpadding="1" width = "700px">
					<thead>
						<tr>
							<th style = "min-width:150px">Product</th>
							<th style = "min-width:180px">Product Name</th>
							<th style = "min-width:170px;padding-left:40px;">Quantity</th>
							<th style = "min-width:100px">Price</th>
							<th width = "100px"></th>
						</tr>
					</thead>
					<tbody id = "cart_items_display" style = "height:240px; overflow:auto;">
					</tbody>
				</table>
				</div>
				
            </div>
            <div class="modal-footer">
				<a href = "index.php" style = "text-decoration:none;color:white"><button type="button" class="btn btn-default" data-dismiss="modal" style = "width:220px;font-size:16px;"><span class = "glyphicon glyphicon-chevron-left"></span>Shop More</button></a>
                <a href = "placeorder_confirmation.php" id = "proceed_buy" type="button" class="btn btn-primary<?php if ($_SESSION['cart_price'] == 0) echo ' disabled';?>" style = "width:220px; font-size:16px;">Confirm Order<span class = "glyphicon glyphicon-chevron-right"></span></a>
            </div>
        </div>
    </div>
</div>


</div>
<span class = "clearfix"></span>
<footer>

	<div class="footer-bottom">
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

<! Jquery Link>
    <script src="js/jquery.js"></script>
<! Bootstrap jscript Link>
    <script src="bootstrap/js/bootstrap.js"></script>
<!Date Picker JS>
	<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
    <script src="datepicker/js/bootstrap-datetimepicker.min.js"></script>
<!Select Js link>
<script src="select_master/dist/js/bootstrap-select.js"></script>
<!Custom java script>
<script src="js/placeorder_jscript.js"></script>
</body>
</html>