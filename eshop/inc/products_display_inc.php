<?php
 if (isset($_POST['search_key']) && !empty($_POST['search_key'])){$_SESSION['search_key'] = $_POST['search_key'];}

?>
<div class = "mainpage_body shadow_top">
<div class = "container">
<?php include 'inc/carousels_inc.php'; ?>

<div class = "productdisplay_wrap">
<div id = "nav">
<nav role="navigation" class="navbar navbar-default navbar-static">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="#" class="navbar-brand"></a>
        </div>
        <!-- Collection of nav links, forms, and other content for toggling -->
        <div id="navbarCollapse" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
			<?php
			$query1 = "SELECT `id`,`type` FROM `items_type`";
			$sth1 = $dbh->query($query1);
			while ($result1 = $sth1->fetch(PDO::FETCH_ASSOC)){
				echo '<li class = "item_type_select" id = "type_'.$result1['id'].'"><a>'.ucfirst($result1['type']).'</a></li>';
			}
			?>
            </ul>
		<div>
		<div class = "cart_fixed" id = "cart_fixed" href = "#myModal_cart" data-toggle="modal">
			<label style = "cursor:pointer">
			<span class = "glyphicon glyphicon-shopping-cart" style = "color:#FFF;font-size:18px;"></span>
			<span id = "cart_item_num_fixed" class = "cart_item_num_fixed"><?php echo sizeof($_SESSION['cart']); ?></span>
			<span style = "font-size:16px;padding-left:25px; color:white; padding-bottom: 10px;">Cart</span>
			</label>
			</div>
		</div>
			<form role="search" class="navbar-form navbar-right" action = "<?php echo $current_file;?>" method = "POST">
                <div class="form-group">
                <div class = "input-group">
                <div class = "input-group-addon"><span class="glyphicon glyphicon-search" id="basic-addon1"></span></div>
				<input id = "search_product" type="text" placeholder="Search by Name" value = "<?php if (isset($_POST['search_key']) && !empty($_POST['search_key'])){echo $_POST['search_key'];}?>" class="form-control" name = "search_key">
				</div>
				<input type = "submit" class="btn btn-default" role="button" value = "Go" style = "width:50px;margin-left:10px;">
                </div>
            </form>
        </div>
    </nav>
</div>
<div class = "container">
<div class = "row">
<div id = "product_display" style = "min-height:200px;">
 <h4 class="modal-title text-center" style = "margin-top:20px;"><i class="fa fa-spinner fa-pulse"></i> Loading...</h4>

</div>
</div>
</div>
</div>
</div>
</div>

<!Modal for Product Details>
<div id="myModal" class="modal fade">
        <div class="modal-dialog" style = "width:800px;">
            <div id = "product_details" class="modal-content">
				<div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><i class="fa fa-spinner fa-pulse"></i> Loading...</h4>
                </div>
               
            </div>
            </div>
        </div>
</div>
