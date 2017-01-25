<?php
require '../inc/core_inc.php';
require 'checksession_inc.php';
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin</title>

	<! Bootstrap Css links>
	<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap-theme.min.css">
<style type = "text/css">
ul a{
	font-weight:20px;
}

</style>
</head>
<body>

<?php
include 'navbar_adminpage_inc.php';
?>
<div class = "container-fluid">
<div class = "row">
<div class = "col-md-8 col-md-push-2">
    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle = "tab" href="#orders_immediate"><span class="glyphicon glyphicon-home"></span> Immediate Orders</a></li>
        <li><a data-toggle = "tab" href="#orders_upcoming"><span class="glyphicon glyphicon-info-sign"></span> Upcoming Orders</a></li>
        <li><a data-toggle = "tab" href="#orders_delivered"><span class="glyphicon glyphicon-ok"></span> Delivered Orders</a></li>
    </ul>
	<div class = "tab-content">
		<div id = "orders_immediate" class = "tab-pane fade-in active">
		<?php
			$query1 = "SELECT `id`, `nameofsender`, `emailofsender`, `phoneofsender`, `nameofrecipient`, `addressofrecipient_line1`, `addressofrecipient_line2`, `locationofrecipient`, `phoneofrecipient`, `notifyrecipient`, `pincodeofrecipient`, `deliverydate`, `deliverytime`, `deliverymessage`, `ordertime`, `orderstatus`, `totalcost`, `paymentstatus`, `delivery` FROM `orders` WHERE 1";
		?>
		</div>
		<div id = "orders_upcoming" class = "tab-pane fade-in">
		</div>
		<div id = "orders_delivered" class = "tab-pane fade-in">
		</div>
	</div>
	
</div>
</div>
</div>	


    <script src="../js/jquery.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <!jquery form validation plugin>	
	<script src="../js/formvalidator/lib/jquery.js"></script>
	<script src="../js/formvalidator/dist/jquery.validate.js"></script>
	
	
	<script src="../js/myjavascript.js"></script>
	
<script>
$("#vieworders").addClass('active');
</script>

</body>
</html>