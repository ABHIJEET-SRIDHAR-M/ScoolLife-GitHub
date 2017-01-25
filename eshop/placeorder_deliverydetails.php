<?php
include 'inc/core_inc.php';
//Cart Management
if (!isset($_SESSION['cart'])) {
header('Location: index.php');
} else if ($_SESSION['cart_price'] == 0){
	header('Location: index.php');
}
if (isset($_SESSION['sender_details']) && $_SESSION['sender_details'] == 1 && isset($_SESSION['order_id'])){
		if (isset($_SESSION['delivery_details']) && $_SESSION['delivery_details'] == 1){			
			$visited = 1;
			$order_id = $_SESSION['order_id'];
			$query1 = "SELECT `nameofrecipient`, `addressofrecipient_line1`, `addressofrecipient_line2`, `phoneofrecipient`, `notifyrecipient`, `pincodeofrecipient`, `deliverydate`, `deliverytime`, `deliverymessage`, `customize` FROM `orders` WHERE `id` = '$order_id'";
			$sth1 = $dbh->query($query1);
			$userdetails = $sth1->fetch(PDO::FETCH_ASSOC);
		} else {
			$visited = 0;
		}
} else {
	header('Location: placeorder.php');
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


<!Custom style sheet>	
<link rel="stylesheet" type="text/css" href="css/styles_placeorder.css">

<!Alert Plugin links>
	<script src="js/alert/lib/sweet-alert.min.js"></script>
	<link rel="stylesheet" href="js/alert/lib/sweet-alert.css">

<!Google Fonts API Sablo Link>
	<link href='http://fonts.googleapis.com/css?family=Slabo+27px' rel='stylesheet' type='text/css'>
	
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
	<a href="placeorder_deliverydetails.php" class="active">Delivery Details</a>
	<a class = "pointer">Order Confirmation</a>
	<a class = "pointer">Payment Method</a>
</div>

	
<! form content>
	<div class = "tab-content">
	<div id = "deliveryDetails" class="tab-pane active">
		<form class="form-horizontal" action = "placeorder_processing.php" method = "POST">
		<div class="form-group" style = "padding-bottom:10px;">

            <label class="control-label col-xs-4" style = "text-align:left" for="recipientName">Recipient Name :</label>

            <div class="col-xs-8">

                <input type="text" class="form-control" id="name_recipient" name = "name_recipient" placeholder="Name" <?php if ($visited == 1) echo 'value = "'.$userdetails['nameofrecipient'].'"';?> required>

            </div>

        </div>
        <div class="form-group">
            <label for="deliveryAddress" class="control-label col-xs-4"  style = "text-align:left">Delivery Address :</label>
            <div class="col-xs-8">
                <input type="text" class="form-control" id="name_recipient" name = "address_recipient_line1" placeholder="Address Line 1" <?php if ($visited == 1) echo 'value = "'.$userdetails['addressofrecipient_line1'].'"';?> required>
            </div>
        </div>
		<div class="form-group"  style = "padding-bottom:10px;">
            <div class="col-xs-offset-4 col-xs-8">
                <input type="text" class="form-control" id="name_recipient" name = "address_recipient_line2" placeholder="Address Line 2" <?php if ($visited == 1) echo 'value = "'.$userdetails['addressofrecipient_line2'].'"';?> required>
            </div>
        </div>
		
		
        <div class="form-group" style = "padding-bottom:10px;">

            <label class="control-label col-xs-4" style = "text-align:left" for="recipientName">City :</label>

            <div class="col-xs-8">

                <input class="form-control" type="text" placeholder="<?php echo getfield('locations','location','id',$_SESSION['location'])?>" readonly>

            </div>

        </div>
		<div class="form-group" style = "padding-bottom:10px;">

            <label class="control-label col-xs-4" style = "text-align:left" for="recipientName">Pin Code :</label>

            <div class="col-xs-8">

                <input type="text" class="form-control" id="pincode" placeholder="Pin Code" name = "pincode_recipient" <?php if ($visited == 1) echo 'value = "'.$userdetails['pincodeofrecipient'].'"';?> required>

            </div>

        </div>
		
		<div class="form-group" style = "margin-bottom:2px;">

            <label class="control-label col-xs-4" style = "text-align:left" for="phoneNumber">Recipient Phone:</label>

            <div class="col-xs-8">

                <input pattern = ".{13,}" class="form-control" id="phoneNumber" name = "phone_recipient" placeholder="Phone Number" <?php if ($visited == 1) echo 'value = "'.$userdetails['phoneofrecipient'].'"'; else echo 'value = "+91 "';?> required>
            </div>

        </div>
		<div class="form-group" style = "padding-bottom:10px;">

            <div class="col-xs-offset-4 col-xs-8">

                <div class="radio">
				  <label>
					<input type="radio" name="notify_recipient" id="optionsRadios1" value="1" <?php 
					if ($visited == 1){
						if ($userdetails['notifyrecipient'] == 1){
							echo 'checked';
						}
					} ?>>
					Notify the Recipient that order is placed.
				  </label>
				  <label>
					<input type="radio" name="notify_recipient" id="optionsRadios2" value="2" <?php 
					if ($visited == 1){
						if ($userdetails['notifyrecipient'] == 0){
							echo 'checked';
						}
					} else echo 'checked'; ?>>
					Do not Notify the Recipient regarding Order.
				  </label>
				</div>
            </div>

        </div>		
		<div class="form-group" style = "padding-bottom:10px;">

            <label class="control-label col-xs-4" style = "text-align:left" for="recipientName">Delivery Date :</label>

            <div class="col-xs-8">

                <div class='input-group date'>
                    <input type='text' class="form-control" name = "delivery_date" id='datetimepicker1'  
					<?php
					if ($visited == 1){
						echo 'value = "'.$userdetails['deliverydate'].'"';
					}				
					?> required>
                    <span class="input-group-addon">
                        <span id = "image_button" class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
        </div>
		<div class="form-group" style = "padding-bottom:10px;">

            <label class="control-label col-xs-4" style = "text-align:left" for="recipientName">Preferred Time :</label>

            <div>
			<?php if ($visited == 1){
					$selected = $userdetails['deliverytime'];
			} else $selected = 1;
			?>
                    <select id = "time_select" name = "delivery_time" class = "col-xs-8 selectpicker">
					<option value = "1" <?php if ($selected == 1) echo 'selected = "selected"';?>>06:00 AM to 10:00 AM</option>
					<option value = "2" <?php if ($selected == 2) echo 'selected = "selected"';?>>10:00 AM to 02:00 PM</option>
					<option value = "3" <?php if ($selected == 3) echo 'selected = "selected"';?>>02:00 PM to 06:00 PM</option>
					<option value = "4" <?php if ($selected == 4) echo 'selected = "selected"';?>>06:00 PM to 10:00 PM</option>
					<option value = "5" <?php if ($selected == 5) echo 'selected = "selected"';?>>Mid Night Delivery</option>
					</select>
            </div>

        </div>		
		
		
		<div class="form-group"  style = "padding-bottom:10px;">
            <label for="" class="control-label col-xs-4"  style = "text-align:left">Add Your words:</label>
            <div class="col-xs-8">
                <pre><textarea class="form-control" rows="3" name = "delivery_message" required><?php if ($visited == 1) echo $userdetails['deliverymessage'];?></textarea></pre>
				<span class="help-block">This message will be printed and attached with the delivery</span>
            </div>
        </div>

		<div class="form-group"  style = "padding-bottom:10px;">
            <label for="" class="control-label col-xs-4"  style = "text-align:left">Customize:</label>
            <div class="col-xs-8">
                <pre><textarea class="form-control" rows="3" name = "delivery_customize"><?php if ($visited == 1) echo $userdetails['customize'];?></textarea></pre>
				<span class="help-block">Tell us how you would like the gift to be. Mouse over <a href = "#" data-html= "true" data-toggle = "popover" title = "What to Customize" data-content = "<div style = 'text-align :justify'>
				<p>1. You can specify the 'Number' or 'Letter' when you are ordering Number/Letter Cake or FLower pattern.</p>
				<p>2. If you want a 24 Flowers bunch, Order 2 bunches of 12 flowers and specify the same here.</p>
				<p>3. Feel Free to write any customization about your gift. We will mail/call you up in case of ambiguities.</p>
				
				">here</a> for help.</span>
            </div>
        </div>
		
        <div class="form-group">
            <div class="col-xs-offset-4 col-xs-8" style = "margin-bottom:90px;">
                <button type="submit" class="btn btn-primary">Proceed</button>
            </div>
        </div>
    </form>
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
                <a href = "placeorder_deliverydetails.php" id = "proceed_buy" type="button" class="btn btn-primary<?php if ($_SESSION['cart_price'] == 0) echo ' disabled';?>" style = "width:220px; font-size:16px;">Confirm Order<span class = "glyphicon glyphicon-chevron-right"></span></a>
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
<!Date Time Picker>
<link rel="stylesheet" type="text/css" href="datepicker/jquery.datetimepicker.css"/ >
<script src="datepicker/jquery.datetimepicker.js"></script>
<!Select Js link>
<script src="select_master/dist/js/bootstrap-select.js"></script>
<!Custom java script>
<script src="js/placeorder_jscript.js"></script>
</body>
</html>