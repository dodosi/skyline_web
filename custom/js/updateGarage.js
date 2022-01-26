$(document).ready(function() {
	// main menu
	/* $("#navSetting").addClass('active');
	// sub manin
	$("#topNavSetting").addClass('active'); */

	// change username
	$("#changeUsernameForm").unbind('submit').bind('submit', function() {
		var form = $(this);

		var fname = $("#fname").val();
		var phone1 = $("#phone1").val();
		var email = $("#email").val();
		var weblink = $("#weblink").val();
		var company_pic = $("#companyPic").val();
		
		var state = $("#state").val();
		var city = $("#city").val();
		var street = $("#street").val();
		var zip = $("#zip").val();
		
		var latitude = $("#latitude").val();
		var longitude = $("#longitude").val();
        
		if(fname == "") {
			$("#fname").after('<p class="text-danger">Garage name field is required</p>');
			$("#fname").closest('.form-group').addClass('has-error');
		} 
		if(phone1 == "") {
			$("#phone1").after('<p class="text-danger">Phone number field is required</p>');
			$("#phone1").closest('.form-group').addClass('has-error');
		} 
		if(email == "") {
			$("#email").after('<p class="text-danger">Email field is required</p>');
			$("#email").closest('.form-group').addClass('has-error');
		}
		if(weblink == "") {
			$("#weblink").after('<p class="text-danger">Weblink field is required</p>');
			$("#weblink").closest('.form-group').addClass('has-error');
		}
		if(company_pic == "") {
			$("#company_pic").after('<p class="text-danger">Picture field is required</p>');
			$("#company_pic").closest('.form-group').addClass('has-error');
		}
		if(state == "") {
			$("#state").after('<p class="text-danger">Weblink field is required</p>');
			$("#state").closest('.form-group').addClass('has-error');
		}
		if(city == "") {
			$("#city").after('<p class="text-danger">City field is required</p>');
			$("#city").closest('.form-group').addClass('has-error');
		}
		if(street == "") {
			$("#street").after('<p class="text-danger">Street field is required</p>');
			$("#street").closest('.form-group').addClass('has-error');
		}
		if(zip == "") {
			$("#zip").after('<p class="text-danger">Zip field is required</p>');
			$("#zip").closest('.form-group').addClass('has-error');
		}
		
		if(zip == "") {
			$("#zip").after('<p class="text-danger">ZIPCODE field is required</p>');
			$("#zip").closest('.form-group').addClass('has-error');
		}
		if(latitude == "") {
			$("#latitude").after('<p class="text-danger">latitude field is required</p>');
			$("#latitude").closest('.form-group').addClass('has-error');
		}
		if(longitude == "") {
			$("#longitude").after('<p class="text-danger">longitude field is required</p>');
			$("#longitude").closest('.form-group').addClass('has-error');
		}
		else {
			var form = $(this);
            //alert("HERE");
			 //alert(email);
		     //alert(company_pic);
		     //console.log(zip);
			
			//$(".text-danger").remove();
			//$('.form-group').removeClass('has-error');

			$("#changeUsernameBtn").button('loading');
             //alert("HERE");
			 //alert(email);
		     //alert(company_pic);
		     //console.log(zip);
		     
			$.ajax({
				url: form.attr('action'),
				type: form.attr('method'),
				data: form.serialize(),
				dataType: 'json',
				success:function(response) {
					console.log(response.messages);
					$("#changeUsernameBtn").button('reset');
					// remove text-error 
					$(".text-danger").remove();
					// remove from-group error
					$(".form-group").removeClass('has-error').removeClass('has-success');
                    //console.log(response);
					if(response.success == true)  {												
																
						// shows a successful message after operation
						$('.changeUsenrameMessages').html('<div class="alert alert-success">'+
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
						// shows a successful message after operation
						$('.changeUsenrameMessages').html('<div class="alert alert-warning">'+
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
				} // /success 
			//alert("Not");
			//console.log(data),
			}); // /ajax
			return true;
			
		}
			
		return false;
	}); 
}); // /document