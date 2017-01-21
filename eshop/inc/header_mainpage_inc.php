<div itemscope itemtype = "http://schema.org/Florist">
 <div class = "header_wrapper">
	<div class = "header_topbar">
		<div class = "topbar_call"><span class = "glyphicon glyphicon-earphone" style = "color:rgb(25, 25, 100);margin-right:7px;"></span> We are here for you 24x7 at <a href = "services_contactus.php"><span itemprop = "telephone"> +91 8185985626</span></a></div>
		<div class = "topbar_mail"><span class = "glyphicon glyphicon-envelope" style = "color:rgb(25, 25, 100);margin-right:7px;"></span>  Mail us at <a href = "services_feedback.php"><span itemprop = "email">care@sendfreshflowers.co.in</span></a></div>
	</div>
  </div>
</div>
	<span class = "clearfix"></span>
	<div class = "header_main shadow">
<!Site Logo>
	<div class = "site_logo">
		<a href = "index.php"><img src = "logo_colorful_violet.jpg" alt = "SEND FRESH FLOWERS" height= "90px"></span></a>
	</div>
	
<!cart>
	<div class = "cart" id = "cart" href = "#myModal_cart" data-toggle="modal">
			<p>
			<span class = "glyphicon glyphicon-shopping-cart" style = "color:#B15767;font-size:18px;"></span>
			<span id = "cart_item_num" class = "cart_item_num"><?php echo sizeof($_SESSION['cart']); ?></span>
			<span style = "padding-left:25px;font-size:16px;">Cart</span>
			</p>
	</div>
<!Location Selection>
		<div class = "location_select">
			
				<select id = "location_select" class="selectpicker">
<?php
	$query = "SELECT `id`, `location` FROM `locations`";
	$sth = $dbh->query($query);
	if (!isset($_SESSION['location'])){
		$_SESSION['location'] = 1;
	} 
	while ($result = $sth->fetch(PDO::FETCH_ASSOC)){
		
		echo '<option value = "'.$result['id'].'"';
		if (isset($_SESSION['location']) && $_SESSION['location'] == $result['id']){
			echo 'selected = "selected"';
		}
		echo '>'.$result['location'].'</option>';
	}
?>
				</select>
			</div>
	
	<div class = "site_menu">
		<ul class = "list-inline">
			<li style = "padding-left:20px"><a href = "index.php">Home</a></li>
			<li><a href = "services_bestsellers.php">Best Sellers</a></li>
			<li><a href = "services_faqs.php">FAQs</a></li>	
			<li><a href = "services_trackorder.php">Track My Order</a></li>	
			<li style = "padding-right:20px"><a href = "services_contactus.php">Contact Us</a></li>	
		</ul>
	</div>
<!Social Buttons>
	<div class = "social_header">
	<span itemscope itemtype = "http://schema.org/Florist">
		<link itemprop="url" href="http://www.sendfreshflowers.co.in"> 
	                    <ul class="list-inline">
                        <li><a itemprop = "sameAs" href="https://www.facebook.com/pages/Send-Fresh-Flowers/1460169447635086" target = "_blank"><i class=" fa fa-facebook" style = "color:#3b5998"></i></a></li>
                        <li><a itemprop = "sameAs" href="https://twitter.com/sendflowers_sff" target = "_blank"><i class="fa fa-twitter" style = "color: #00ACED"></i></a></li>
                        <li><a itemprop = "sameAs" href="http://google.com/+SendfreshflowersIndia" target = "_blank"><i class="fa fa-google-plus" style = "color:#D14836"></i></a></li>
	</span>
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
				<table class="table" cellspacing="0" cellpadding="1" width = "700px">
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
				<button type="button" class="btn btn-success" data-dismiss="modal" style = "width:220px;font-size:16px;"><span class = "glyphicon glyphicon-chevron-left"></span>Continue Shopping</button>
                <a href = "placeorder.php" id = "proceed_buy" type="button" class="btn btn-primary<?php if ($_SESSION['cart_price'] == 0) echo ' disabled';?>" style = "width:220px; font-size:16px;">Proceed to Place Order<span class = "glyphicon glyphicon-chevron-right"></span></a>
            </div>
        </div>
    </div>
</div>
