$(document).ready(function(){
	$('#selectionModal').modal('show');
	
	//User clicks parent button from modal
	$('#parent_btn').click(function(){
		$('#selectionModal').modal('hide');
	});
	//User clicks student button from modal
	$('#student_btn').click(function(){
		$('#reg_form_parent').hide();
		$('#reg_form_student').show();
		$('#selectionModal').modal('hide');
	});
	//User clicks shopper button from modal
	$('#shopper_btn').click(function(){
		$('#selectionModal').modal('hide');
	});

	
});