$(document).ready(function() {
	// main menu
	$("#navSetting").addClass('active');
	// sub manin
	$("#topNavSetting").addClass('active');

	// change username
	$("#changePasswordForm").unbind('submit').bind('submit', function() { 
		var form = $(this);
		$(".text-danger").remove();

		var currentPassword = $("#fname").val();
		var newPassword = $("#lname").val();
		var conformPassword = $("#phone1").val();
		var conformPassword = $("#email").val();
		var phone1 = $("#phone1").val();
		var phone2 = $("#phone2").val();
		var city = $("#city").val();
		var state = $("#state").val();
		var street = $("#street").val();
		
        alert(currentPassword);
		alert(newPassword);
		alert(conformPassword);
		
		if(currentPassword == "" || newPassword == "" || conformPassword == "") {
			if(currentPassword == "") {
				$("#password").after('<p class="text-danger">The Current Password field is required</p>');
				$("#password").closest('.form-group').addClass('has-error');
			} else {
				$("#password").closest('.form-group').removeClass('has-error');
				$(".text-danger").remove();
			}

			if(newPassword == "") {
				$("#npassword").after('<p class="text-danger">The New Password field is required</p>');
				$("#npassword").closest('.form-group').addClass('has-error');
			} else {
				$("#npassword").closest('.form-group').removeClass('has-error');
				$(".text-danger").remove();
			}

			if(conformPassword == "") {
				$("#cpassword").after('<p class="text-danger">The Conform Password field is required</p>');
				$("#cpassword").closest('.form-group').addClass('has-error');
			} else {
				$("#cpassword").closest('.form-group').removeClass('has-error');
				$(".text-danger").remove();
			}
		} else {
			$(".form-group").removeClass('has-error');
			$(".text-danger").remove(); 
			
			$.ajax({
				url: form.attr('action'),
				type: form.attr('method'),
				data: form.serialize(),
				dataType: 'json',
				success:function(response) {  
					if(response.success == true) {
						$('.changePasswordMessages').html('<div class="alert alert-success">'+
	            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
	            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
	          '</div>');

						// remove the mesages
	          $(".alert-success").delay(500).show(10, function() {
							$(this).delay(3000).hide(10, function() {
								$(this).remove();
							});
						}); // /.alert	    
					} else {

						$('.changePasswordMessages').html('<div class="alert alert-warning">'+
	            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
	            '<strong><i class="glyphicon glyphicon-exclamation-sign"></i></strong> '+ response.messages +
	          '</div>');

						// remove the mesages
	          $(".alert-warning").delay(500).show(10, function() {
							$(this).delay(3000).hide(10, function() {
								$(this).remove();
							});
						}); // /.alert	          	
					}
				} // /success function
			}); // /ajax function 
		} // /else


		return false;
	});
}); // /document