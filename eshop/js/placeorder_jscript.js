$(document).ready(function(){
//initialize tool tip
    $('[data-toggle="popover"]').popover({
        placement : 'top',
		trigger : 'hover'
    });

//Cart Loading
	$('#cart_items_display').load('inc/cart_manage_inc.php',{display:1});

	//intiialize Date Picker for order placing
$('#show_coupon_code').click(function(){
			$(this).hide();
			$('#coupon_display').show();
});
$('#coupon_discount').click(function(){
	$('#coupon_status_block').show();
	code = $('#coupon_code').val();
	$('#coupon_code_status').load('inc/coupon_code_processing.php',{code:code},function(){
		$('#net_payable_final').load('inc/cart_manage_inc.php',{cart_pay:2});
		$('#coupon_display').hide();
	});
});
d = new Date();
d.setDate(d.getDate()+1); 
//var a = moment().add(1,'days');
$('#datetimepicker1').datetimepicker({
	timepicker:false,
	format:'d/m/Y',
	minDate:d,
	closeOnDateSelect:true
});
$('#image_button').click(function(){
	$('#datetimepicker1').datetimepicker('show'); 
});

});

// Remove from cart
	$(document).on('click','.remove_cart',function(){
		var cart_item_id = $(this).attr('id');
		cart_item_id = cart_item_id.substring(12,cart_item_id.length);
		$('#cart_items_display').load('inc/cart_manage_inc.php',{id:cart_item_id,operation:2}, function(){
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
// Coupon Code display after unsuccesfull attemp
$(document).on('click', '#coupon_tryagain',function(){
	$('#coupon_code_status').hide();
	$('#coupon_display').show();
})
