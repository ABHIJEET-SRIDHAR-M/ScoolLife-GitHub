<!cart>
	<div class = "cart" id = "cart" href = "#myModal_cart" data-toggle="modal">
			<p>
			<span class = "glyphicon glyphicon-shopping-cart" style = "color:#B15767;font-size:18px;"></span>
			<span id = "cart_item_num" class = "cart_item_num"><?php echo sizeof($_SESSION['cart']); ?></span>
			<span style = "padding-left:25px;font-size:16px;">Cart</span>
			</p>
	</div>
<?php
	$query = "SELECT `id`, `location` FROM `locations`";
	$sth = $dbh->query($query);
	if (!isset($_SESSION['location'])){
		$_SESSION['location'] = 1;
	} 
	/* while ($result = $sth->fetch(PDO::FETCH_ASSOC)){
		if (isset($_SESSION['location']) && $_SESSION['location'] == $result['id']){
			echo 'selected = "selected"';
		}
		echo '>'.$result['location'].'</option>';
	} */
?>


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
