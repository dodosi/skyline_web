var manageDriversTable;

$(document).ready(function() {
	// active top navbar categories
	$('#navCategories').addClass('active');	

	manageDriversTable = $('#manageDriversTable').DataTable({
		'colReorder': true,
		 'totalRow': true,
		 'totalCol': true,
		 'bold': true, 
		 'scrollX': true,
                 'fixedHeader': true,
	         'lengthChange': false,
		 'order' : [],
		 'dom': 'Bfrtip',
		 'lengthMenu': [
						[ 5,10, 25, 50, -1 ],
						[ '5 rows','10 rows', '25 rows', '50 rows', 'Show all' ]
					], 
		'buttons': [
						'pageLength','colvis'
					],
		'ajax' : 'php_action/fetchHomeBookings.php',
		'order': []
	}); // manage categories Data Table 
	// on click on submit categories form modal
	$('#addCategoriesModalBtn').unbind('click').bind('click', function() {
		
		//alert("Here");
		// reset the form text
		$("#submitCategoriesForm")[0].reset();
		// remove the error text
		$(".text-danger").remove();
		// remove the form error
		$('.form-group').removeClass('has-error').removeClass('has-success');

		// submit categories form function
		$("#submitCategoriesForm").unbind('submit').bind('submit', function() {

			var fname = $("#fname").val();
			var lname = $("#lname").val();
			var phone1 = $("#phone1").val();
			var phone2 = $("#phone2").val();
			var email = $("#email").val();
			var defaultpass = $("#password").val();
			var picture = $("#picture").val();
			
			var street = $("#street").val();
			var state = $("#state").val();
			var city = $("#city").val();
			var zip = $("#zip").val();
			var regDate = $("#regDate").val();
			var status1 = $("#driverStatus").val(); 
			var proof = $("#proof").val();  
			 
			if(fname == "") {
				$("#fname").after('<p class="text-danger">First name field is required</p>');
				$('#fname').closest('.form-group').addClass('has-error');
			} else {
				// remov error text field
				$("#fname").find('.text-danger').remove();
				// success out for form 
				$("#fname").closest('.form-group').addClass('has-success');	  	
			}

			if(lname == "") {
				$("#lname").after('<p class="text-danger">Last name is required</p>');
				$('#lname').closest('.form-group').addClass('has-error');
			} else {
				// remov error text field
				$("#lname").find('.text-danger').remove();
				// success out for form 
				$("#lname").closest('.form-group').addClass('has-success');	  	
			}
			
			if(phone1 == "") {
				$("#phone1").after('<p class="text-danger">First name field is required</p>');
				$('#phone1').closest('.form-group').addClass('has-error');
			} else {
				// remov error text field
				$("#phone1").find('.text-danger').remove();
				// success out for form 
				$("#phone1").closest('.form-group').addClass('has-success');	  	
			}

			if(phone2 == "") {
				$("#phone2").after('<p class="text-danger">Last name is required</p>');
				$('#phone2').closest('.form-group').addClass('has-error');
			} else {
				// remov error text field
				$("#phone2").find('.text-danger').remove();
				// success out for form 
				$("#phone2").closest('.form-group').addClass('has-success');	  	
			}
			
			if(email == "") {
				$("#email").after('<p class="text-danger">Email address field is required</p>');
				$('#email').closest('.form-group').addClass('has-error');
			} else {
				// remov error text field
				$("#email").find('.text-danger').remove();
				// success out for form 
				$("#email").closest('.form-group').addClass('has-success');	  	
			}

			if(defaultpass == "") {
				$("#password").after('<p class="text-danger">Default password is required</p>');
				$('#password').closest('.form-group').addClass('has-error');
			} else {
				// remov error text field
				$("#password").find('.text-danger').remove();
				// success out for form 
				$("#password").closest('.form-group').addClass('has-success');	  	
			}
			if(picture == "") {
				$("#picture").after('<p class="text-danger">Default password is required</p>');
				$('#picture').closest('.form-group').addClass('has-error');
			} else {
				// remov error text field
				$("#picture").find('.text-danger').remove();
				// success out for form 
				$("#picture").closest('.form-group').addClass('has-success');	  	
			}
			
			if(state == "") {
				$("#state").after('<p class="text-danger">Default password is required</p>');
				$('#state').closest('.form-group').addClass('has-error');
			} else {
				// remov error text field
				$("#state").find('.text-danger').remove();
				// success out for form 
				$("#state").closest('.form-group').addClass('has-success');	  	
			}
			if(street == "") {
				$("#street").after('<p class="text-danger">Default password is required</p>');
				$('#street').closest('.form-group').addClass('has-error');
			} else {
				// remov error text field
				$("#street").find('.text-danger').remove();
				// success out for form 
				$("#street").closest('.form-group').addClass('has-success');	  	
			}
			if(city == "") {
				$("#city").after('<p class="text-danger">Default password is required</p>');
				$('#city').closest('.form-group').addClass('has-error');
			} else {
				// remov error text field
				$("#city").find('.text-danger').remove();
				// success out for form 
				$("#city").closest('.form-group').addClass('has-success');	  	
			}
			if(zip == "") {
				$("#zip").after('<p class="text-danger">Zip code is required</p>');
				$('#zip').closest('.form-group').addClass('has-error');
			} else {
				// remov error text field
				$("#zip").find('.text-danger').remove();
				// success out for form 
				$("#zip").closest('.form-group').addClass('has-success');	  	
			}
			if(regDate == "") {
				$("#regDate").after('<p class="text-danger">Registration Date is required</p>');
				$('#regDate').closest('.form-group').addClass('has-error');
			} else {
				// remov error text field
				$("#regDate").find('.text-danger').remove();
				// success out for form 
				$("#regDate").closest('.form-group').addClass('has-success');	  	
			}
			if(status1 == "") {
				$("#driverStatus").after('<p class="text-danger">Status field is required</p>');
				$('#driverStatus').closest('.form-group').addClass('has-error');
			} else {
				// remov error text field
				$("#driverStatus").find('.text-danger').remove();
				// success out for form 
				$("#driverStatus").closest('.form-group').addClass('has-success');	  	
			}
			if(proof == "") {
				$("#proof").after('<p class="text-danger">Proof of work field is required</p>');
				$('#proof').closest('.form-group').addClass('has-error');
			} else {
				// remov error text field
				$("#proof").find('.text-danger').remove();
				// success out for form 
				$("#proof").closest('.form-group').addClass('has-success');	  	
			} 
			
			if(fname && lname && phone1 && email && defaultpass && city && state && zip && street && proof && status1) {
				var form = $(this);
				// button loading
				alert(fname);
				$("#createCategoriesBtn").button('loading'); 
				//alert(status1)
				$.ajax({
					url : form.attr('action'),
					type: form.attr('method'),
					data: form.serialize(), 
					dataType: 'json',
					success:function(response) { 
						// button loading
						$("#createCategoriesBtn").button('reset');   
						if(response.success == true) {
							// reload the manage member table 
							manageDriversTable.ajax.reload(null, false);						
                           
	  	  			// reset the form text
							$("#submitCategoriesForm")[0].reset();
							// remove the error text
							$(".text-danger").remove();
							// remove the form error
							$('.form-group').removeClass('has-error').removeClass('has-success');
	  	  			
	  	  			$('#add-categories-messages').html('<div class="alert alert-success">'+
	            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
	            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
		          '</div>');

	  	  			$(".alert-success").delay(500).show(10, function() {
								$(this).delay(3000).hide(10, function() {
									$(this).remove();
								});
							}); // /.alert
						}  // if
                        //console.log(response);
					} // /success
					//console.log(data);
				}); // /ajax 
			} // if

			return false;
		}); // submit categories form function
	}); // /on click on submit categories form modal	

}); // /document