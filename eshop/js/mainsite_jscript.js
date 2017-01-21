$(document).ready(function(){
	
// Affix Navbar
$('#nav').affix({
	offset : {
		top: 415
	}
	
});

//Location change using ajax
			$('#location_select').change(function(){
	// empty cart before changing location
		$.post('inc/cart_manage_inc.php',{cart_num:1},function(data){
				if (data == 0){
					var loc_id = $('#location_select').val();
					$.post('inc/location_select.php',{loc_id:loc_id},function(){
					location.reload();
					});
				} else {
					swal({   title: "Are you sure?",   text: "Your Cart will be emptied if You wish to change location",   type: "warning",   showCancelButton: true,   confirmButtonColor: "#DD6B55",   confirmButtonText: "Yes, Proceed",   cancelButtonText: "No, wait!",   closeOnConfirm: false,   closeOnCancel: false },
					function(isConfirm){   
					if (isConfirm) {
						$.post('inc/cart_manage_inc.php',{clear:1});
						var loc_id = $('#location_select').val();
						$.post('inc/location_select.php',{loc_id:loc_id},function(){
						location.reload();
					});
					} else {
						location.reload();
					} 
					});
		
				}
			});
	});

//Cart Loading
		$('#cart_items_display').load('inc/cart_manage_inc.php',{display:1});


});

// Load Products based on product type using ajax
	active_item_type = "type_1";
	$('#type_1').addClass('active');
	var id_type = 'type_1';
	$('#product_display').load('inc/product_display_processing.php',{id:id_type});
	
	$('.item_type_select').click(function(){
		var id_type = $(this).attr('id');
		$('#'+active_item_type).removeClass('active');
		$(this).addClass('active');
		active_item_type = id_type;
		$('#product_display').load('inc/product_display_processing.php',{id:id_type});
	});
	
// Modal For Product Details
$(document).on('click', '.product_details_display', function(){
	$('#myModal').modal('show');
	var item_id = $(this).attr('id');
	$('#product_details').load('inc/product_details_processing.php',{id:item_id});
} );

// Cart Operations
//operation 1: add; operation 2:delete;operation 3 :empty cart;
//1. Add to Cart
	$(document).on('click','.addtocart',function(){
		if ($(this).hasClass('disabled')){
			
		} else {
			$("#myModal").modal('hide');
		var cart_item_id = $(this).attr('id');
		cart_item_id = cart_item_id.substring(10,cart_item_id.length);
		$('#cart_items_display').load('inc/cart_manage_inc.php',{id:cart_item_id,operation:1}, function(){
			swal({
			title: "Product added to cart.",
			text: "<p>Add more Quantity in Cart.<p><br><a id = 'viewcart_modal' style = 'cursor:pointer;font-size:22px;font-family:Times New Roman;'>View Cart</a> <a href = 'placeorder.php' style = 'font-family:Times New Roman;font-size:22px;;margin-left:50px;'>Check Out</a>",
			html:true,
			type: "success",
			confirmButtonText: "Continue Shopping",
			confirmButtonColor: "#3fa2cf",
			allowOutsideClick: true});
			//rgba(63, 162, 207, 1)
			$('#addtocart_'+cart_item_id).addClass('btn-default').addClass('disabled').removeClass('btn-success').html('Added To Cart');
			$('#add2cart2_'+cart_item_id).addClass('btn-default').addClass('disabled').removeClass('btn-success').html('Added To Cart');
			$('#buy_'+cart_item_id).addClass('checkout').removeClass('buy').html('Check Out');
			//$('#cart_item_num').load('inc/cart_manage_inc.php',{cart_num:1});
			$('#net_payable').load('inc/cart_manage_inc.php',{cart_pay:1});
			$.post('inc/cart_manage_inc.php',{cart_num:1},function(data){
				$('#cart_item_num').html(data);
				$('#cart_modal_item_num').html(data);
				$('#cart_item_num_fixed').html(data);
			});
			$('#proceed_buy').removeClass('disabled');
		});
		}
	});
//2. Remove from cart
	$(document).on('click','.remove_cart',function(){
		var cart_item_id = $(this).attr('id');
		cart_item_id = cart_item_id.substring(12,cart_item_id.length);
		$('#cart_items_display').load('inc/cart_manage_inc.php',{id:cart_item_id,operation:2}, function(){
			
			$('#addtocart_'+cart_item_id).removeClass('btn-default').removeClass('disabled').addClass('btn-success').html('Add To Cart');
			$('#add2cart2_'+cart_item_id).removeClass('btn-default').removeClass('disabled').addClass('btn-success').html('Add To Cart');
			$('#net_payable').load('inc/cart_manage_inc.php',{cart_pay:1});
			$.post('inc/cart_manage_inc.php',{cart_num:1},function(data){
				$('#cart_item_num').html(data);
				$('#cart_modal_item_num').html(data);
				if (data == 0) {
					$('#proceed_buy').addClass('disabled');
				}
			});
		});
	});
//Buy and Proceed to check out Button Click
	$(document).on('click','.buy',function(){
		var buy_item_id = $(this).attr('id');
		buy_item_id = buy_item_id.substring(4,buy_item_id.length);
		$.post('inc/cart_manage_inc.php',{id:buy_item_id,operation:1}, function(){
			//window.location = "http://localhost/sendfreshflowers/placeorder.php";
			window.location = "http://www.sendfreshflowers.co.in/placeorder.php";
		});
	});
	$(document).on('click','.checkout',function(){
		//window.location = "http://localhost/sendfreshflowers/placeorder.php";
		window.location = "http://www.sendfreshflowers.co.in/placeorder.php";
	});
// Cart Display on click from successful item addition to cart
$(document).on('click','#viewcart_modal',function(){
	swal.close();
	$('#myModal').modal('hide');
	$('#myModal_cart').modal('show');
});
// Quantity Selection in Cart

//plugin bootstrap minus and plus
//http://jsfiddle.net/laelitenetwork/puJ6G/
$(document).on('click', '.btn-number', function(e){
	e.preventDefault();
    
    fieldName = $(this).attr('data-field');
    type      = $(this).attr('data-type');
    var input = $("input[name='"+fieldName+"']");
    var currentVal = parseInt(input.val());
    if (!isNaN(currentVal)) {
        if(type == 'minus') {
            
            if(currentVal > input.attr('min')) {
                input.val(currentVal - 1).change();
            } 
            if(parseInt(input.val()) == input.attr('min')) {
                $(this).attr('disabled', true);
            }

        } else if(type == 'plus') {

            if(currentVal < input.attr('max')) {
                input.val(currentVal + 1).change();
            }
            if(parseInt(input.val()) == input.attr('max')) {
                $(this).attr('disabled', true);
            }

        }
    } else {
        input.val(0);
    }
});
$('.input-number').on('focusin', function(){
   $(this).data('oldValue', $(this).val());
});
$(document).on('change','.input-number',function(){
//$('.input-number').on('change',function() {
    
    minValue =  parseInt($(this).attr('min'));
    maxValue =  parseInt($(this).attr('max'));
    valueCurrent = parseInt($(this).val());
    var item_id = $(this).attr('id');
	item_id = item_id.substring(9,item_id.length);
	name = $(this).attr('name');
    if(valueCurrent <= maxValue) {
		if(valueCurrent >= minValue) {
        $('#cart_items_display').load('inc/cart_manage_inc.php',{itemid:item_id,quantity:valueCurrent},function(){
		$('#net_payable').load('inc/cart_manage_inc.php',{cart_pay:1});
		});
		} else {
        alert('Sorry, the minimum value is 1');
        $(this).val($(this).data('oldValue'));
		}
    } else {
        alert('Sorry, the maximum value is 10');
        $(this).val($(this).data('oldValue'));
    }
    
    
});
$(".input-number").on('keydown', function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
             // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) || 
             // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });


