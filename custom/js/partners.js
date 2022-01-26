var managePartnersTable;

$(document).ready(function() {
	// active top navbar categories
	$('#navCategories').addClass('active');	

	managePartnersTable = $('#managePartnersTable').DataTable({
		'ajax' : 'php_action/fetchPartners.php',
		'order': []
	}); // manage categories Data Table 
	// on click on submit categories form modal
	$('#addCategoriesModalBtn').unbind('click').bind('click', function() {
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
			var garageName = $("#garageName").val();
			var street = $("#street").val();
			var state = $("#state").val();
			var city = $("#city").val();
			var zip = $("#zip").val();
			var regDate = $("#regDate").val(); 
			
			var garage_role = $("#garage_role").val();
			//var categoriesStatus = $("#categoriesStatus").val();

			if(fname == "") {
				$("#fname").after('<p class="text-danger">FName field is required</p>');
				$('#fname').closest('.form-group').addClass('has-error');
			} else {
				// remov error text field
				$("#fname").find('.text-danger').remove();
				// success out for form 
				$("#fname").closest('.form-group').addClass('has-success');	  	
			}
			if(lname == "") {
				$("#lname").after('<p class="text-danger">LName field is required</p>');
				$('#lname').closest('.form-group').addClass('has-error');
			} else {
				// remov error text field
				$("#lname").find('.text-danger').remove();
				// success out for form 
				$("#lname").closest('.form-group').addClass('has-success');	  	
			}

			if(phone1 == "") {
				$("#phone1").after('<p class="text-danger">Mobile number is required</p>');
				$('#phone1').closest('.form-group').addClass('has-error');
			} else {
				// remov error text field
				$("#phone1").find('.text-danger').remove();
				// success out for form 
				$("#phone1").closest('.form-group').addClass('has-success');	  	
			}
			if(phone2 == "") {
				$("#phone2").after('<p class="text-danger">Office number is required</p>');
				$('#phone2').closest('.form-group').addClass('has-error');
			} else {
				// remov error text field
				$("#phone2").find('.text-danger').remove();
				// success out for form 
				$("#phone2").closest('.form-group').addClass('has-success');	  	
			}
			if(email == "") {
				$("#email").after('<p class="text-danger">Email is required</p>');
				$('#email').closest('.form-group').addClass('has-error');
			} else {
				// remov error text field
				$("#email").find('.text-danger').remove();
				// success out for form 
				$("#email").closest('.form-group').addClass('has-success');	  	
			}
			if(garage_role == "") {
				$("#garage_role").after('<p class="text-danger">Garage role is required</p>');
				$('#garage_role').closest('.form-group').addClass('has-error');
			} else {
				// remov error text field
				$("#garage_role").find('.text-danger').remove();
				// success out for form 
				$("#garage_role").closest('.form-group').addClass('has-success');	  	
			}
			if(garageName == "") {
				$("#garageName").after('<p class="text-danger">Select the garage name</p>');
				$('#garageName').closest('.form-group').addClass('has-error');
			} else {
				// remov error text field
				$("#garageName").find('.text-danger').remove();
				// success out for form 
				$("#garageName").closest('.form-group').addClass('has-success');	  	
			}
			if(street == "") {
				$("#street").after('<p class="text-danger">The street name is required</p>');
				$('#street').closest('.form-group').addClass('has-error');
			} else {
				// remov error text field
				$("#street").find('.text-danger').remove();
				// success out for form 
				$("#street").closest('.form-group').addClass('has-success');	  	
			}
			if(state == "") {
				$("#state").after('<p class="text-danger">The state name is required</p>');
				$('#state').closest('.form-group').addClass('has-error');
			} else {
				// remov error text field
				$("#state").find('.text-danger').remove();
				// success out for form 
				$("#state").closest('.form-group').addClass('has-success');	  	
			}
			if(city == "") {
				$("#city").after('<p class="text-danger">The city name is required</p>');
				$('#city').closest('.form-group').addClass('has-error');
			} else {
				// remov error text field
				$("#city").find('.text-danger').remove();
				// success out for form 
				$("#city").closest('.form-group').addClass('has-success');	  	
			}
			if(zip == "") {
				$("#zip").after('<p class="text-danger">The zip code is required</p>');
				$('#zip').closest('.form-group').addClass('has-error');
			} else {
				// remov error text field
				$("#zip").find('.text-danger').remove();
				// success out for form 
				$("#zip").closest('.form-group').addClass('has-success');	  	
			}
			if(regDate == "") {
				$("#regDate").after('<p class="text-danger">The registration date is required</p>');
				$('#regDate').closest('.form-group').addClass('has-error');
			} else {
				// remov error text field
				$("#regDate").find('.text-danger').remove();
				// success out for form 
				$("#regDate").closest('.form-group').addClass('has-success');	  	
			}
			if(fname && lname && phone1 && phone2 && email && garage_role && garageName && street && state && city && zip && regDate) {
				var form = $(this);
				// button loading
				$("#createCategoriesBtn").button('loading');

				$.ajax({
					url : form.attr('action'),
					type: form.attr('method'),
					data: form.serialize(), 
					dataType: 'json',
					success:function(response) { 
						// button loading
						console.log(response);
						$("#createCategoriesBtn").button('reset'); 
						
						if(response.success == true) {
							// reload the manage member table 
							managePartnersTable.ajax.reload(null, false);						
                           
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
                       
					} // /success
				}); // /ajax 			
			} // if

			return false;
		}); // submit categories form function
	}); // /on click on submit categories form modal	

}); // /document
// edit categories function
function editCategories(categoriesId = null ) {
	if(categoriesId) {
	    //alert(categoriesId);
		//alert("Hello");
		// remove the added categories id 
		$('#editCategoriesId').remove();
		// reset the form text
		$("#editCategoriesForm")[0].reset();
		// reset the form text-error
		$(".text-danger").remove();
		// reset the form group errro		
		$('.form-group').removeClass('has-error').removeClass('has-success');

		// edit categories messages
		$("#edit-categories-messages").html("");
		// modal spinner
		$('.modal-loading').removeClass('div-hide');
		// modal result
		$('.edit-categories-result').addClass('div-hide');
		//modal footer
		$(".editCategoriesFooter").addClass('div-hide');		

		$.ajax({
			url: 'php_action/fetchSelectedPartner.php',
			type: 'post',
			data: {categoriesId: categoriesId},
			dataType: 'json',
			success:function(response) {

				
				// modal spinner
				$('.modal-loading').addClass('div-hide');
				// modal result
				$('.edit-categories-result').removeClass('div-hide');
				//modal footer
				$(".editCategoriesFooter").removeClass('div-hide');	

				// set the categories name
				$("#editfname").val(response.fname);
				// set the company TIN
				$("#editlname").val(response.lname); 
				// set the categories name
				$("#editphone1").val(response.phone1);
				// set the categories name
				$("#editphone2").val(response.phone1);
				// set the categories name
				$("#editemail").val(response.email);
				// set the categories name
				$("#editstreet").val(response.street);
				// set the categories name
				$("#editName").val(response.Name);
				// set the categories name
				$("#editcity").val(response.city);
				// set the categories name
				$("#editstate").val(response.state);
				// set the categories name
				$("#editzip").val(response.zip);
				// set the categories name
				$("#editregDate").val(response.regDate);
				// set the categories name
				$("#edituserType").val(response.user_type);
				// set the categories status
				$("#editStatus").val(response.categories_active);
				// add the categories id 
				$(".editCategoriesFooter").after('<input type="hidden" name="editCategoriesId" id="editCategoriesId" value="'+response.id+'" />');


				// submit of edit categories form
				$("#editCategoriesForm").unbind('submit').bind('submit', function() {
					var categoriesName = $("#editCategoriesName").val(); 
					var wss_id = $("#editWSS").val();
					var wp_region = $("#editWPRegion").val(); 
					var categoriesStatus = $("#editCategoriesStatus").val();

					if(categoriesName == "") {
						$("#editCategoriesName").after('<p class="text-danger">Water tape name field is required</p>');
						$('#editCategoriesName').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editCategoriesName").find('.text-danger').remove();
						// success out for form 
						$("#editCategoriesName").closest('.form-group').addClass('has-success');	  	
					}
					if(wss_id == "") {
						$("#editWSS").after('<p class="text-danger">WSS field is required</p>');
						$('#editWSS').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editWSS").find('.text-danger').remove();
						// success out for form 
						$("#editWSS").closest('.form-group').addClass('has-success');	  	
					}
					if(wp_region == "") {
						$("#editWPRegion").after('<p class="text-danger">Company Email field is required</p>');
						$('#editWPRegion').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editWPRegion").find('.text-danger').remove();
						// success out for form 
						$("#editWPRegion").closest('.form-group').addClass('has-success');	  	
					} 

					if(categoriesStatus == "") {
						$("#editCategoriesStatus").after('<p class="text-danger">Company status field is required</p>');
						$('#editCategoriesStatus').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editCategoriesStatus").find('.text-danger').remove();
						// success out for form 
						$("#editCategoriesStatus").closest('.form-group').addClass('has-success');	  	
					}

					if(categoriesName && wss_id && wp_region && categoriesStatus) {
						var form = $(this);
						// button loading
						$("#editCategoriesBtn").button('loading');

						$.ajax({
							url : form.attr('action'),
							type: form.attr('method'),
							data: form.serialize(),
							dataType: 'json',
							success:function(response) {
								// button loading
								$("#editCategoriesBtn").button('reset');
                                console.log(data);
								if(response.success == true) {
									// reload the manage member table 
									managePartnersTable.ajax.reload(null, false);									  	  			
									
									// remove the error text
									$(".text-danger").remove();
									// remove the form error
									$('.form-group').removeClass('has-error').removeClass('has-success');
			  	  			
			  	  			$('#edit-categories-messages').html('<div class="alert alert-success">'+
			            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
			            '<strong><i class="fa fa-check"></i></strong> '+ response.messages +
				          '</div>');

			  	  			$(".alert-success").delay(500).show(10, function() {
										$(this).delay(3000).hide(10, function() {
											$(this).remove();
										});
									}); // /.alert
								}  // if

							} // /success
						}); // /ajax	
					} // if


					return false;
				}); // /submit of edit categories form

			} // /success
		}); // /fetch the selected categories data

	} else {
		alert('Oops!! Refresh the page');
	}
} // /edit categories function


// edit categories function
function editCategories1(categoriesId = null ) {
	if(categoriesId) {
	    //alert(categoriesId);
		//alert("Hello");
		// remove the added categories id 
		$('#editCategoriesId').remove();
		// reset the form text
		$("#editCategoriesForm1")[0].reset();
		// reset the form text-error
		$(".text-danger").remove();
		// reset the form group errro		
		$('.form-group').removeClass('has-error').removeClass('has-success');

		// edit categories messages
		$("#edit-categories-messagesss").html("");
		// modal spinner
		$('.modal-loading').removeClass('div-hide');
		// modal result
		$('.edit-categories-result').addClass('div-hide');
		//modal footer
		$(".editCategoriesFooter1").addClass('div-hide');		

		$.ajax({
			url: 'php_action/fetchSelectedPartner.php',
			type: 'post',
			data: {categoriesId: categoriesId},
			dataType: 'json',
			success:function(response) {

				
				// modal spinner
				$('.modal-loading').addClass('div-hide');
				// modal result
				$('.edit-categories-result').removeClass('div-hide');
				//modal footer
				$(".editCategoriesFooter1").removeClass('div-hide');	

				// set the categories name
				$("#editName1").val(response.fname+" "+response.lname);  
				// set the categories name
				$("#editregDate1").val(response.regDate); 
				// set the categories status
				$("#editStatus1").val(response.active);
				// add the categories id 
				$(".editCategoriesFooter1").after('<input type="hidden" name="editCategoriesId" id="editCategoriesId" value="'+response.id+'" />');


				// submit of edit categories form
				$("#editCategoriesForm1").unbind('submit').bind('submit', function() {
					var categoriesName = $("#editName1").val();  
					
					var categoriesStatus = $("#editStatus1").val();

					if(categoriesName == "") {
						$("#editName1").after('<p class="text-danger">Partner name field is required</p>');
						$('#editName1').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editName1").find('.text-danger').remove();
						// success out for form 
						$("#editName1").closest('.form-group').addClass('has-success');	  	
					}  

					if(categoriesStatus == "") {
						$("#editStatus1").after('<p class="text-danger">Partner status field is required</p>');
						$('#editStatus1').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editStatus1").find('.text-danger').remove();
						// success out for form 
						$("#editStatus1").closest('.form-group').addClass('has-success');	  	
					}

					if(categoriesStatus) {
						var form = $(this);
						// button loading
						$("#editCategoriesBtn1").button('loading');

						$.ajax({
							url : form.attr('action'),
							type: form.attr('method'),
							data: form.serialize(),
							dataType: 'json',
							success:function(response) {
								// button loading
								$("#editCategoriesBtn1").button('reset');
                                console.log(response);
								if(response.success == true) {
									// reload the manage member table 
									managePartnersTable.ajax.reload(null, false);									  	  			
									
									// remove the error text
									$(".text-danger").remove();
									// remove the form error
									$('.form-group').removeClass('has-error').removeClass('has-success');
			  	  			
			  	  			$('#edit-categories-messagesss').html('<div class="alert alert-success">'+
			            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
			            '<strong><i class="fa fa-check"></i></strong> '+ response.messages +
				          '</div>');

			  	  			$(".alert-success").delay(500).show(10, function() {
										$(this).delay(3000).hide(10, function() {
											$(this).remove();
										});
									}); // /.alert
								}  // if

							} // /success
						}); // /ajax	
					} // if


					return false;
				}); // /submit of edit categories form

			} // /success
		}); // /fetch the selected categories data

	} else {
		alert('Oops!! Refresh the page');
	}
} // /edit categories function

// remove categories function
function removeCategories(categoriesId = null) {
		
	$.ajax({
		url: 'php_action/fetchSelectedPartner.php',
		type: 'post',
		data: {categoriesId: categoriesId},
		dataType: 'json',
		success:function(response) {			

			// remove categories btn clicked to remove the categories function
			$("#removeCategoriesBtn").unbind('click').bind('click', function() {
				// remove categories btn
				$("#removeCategoriesBtn").button('loading');

				$.ajax({
					url: 'php_action/approvePartner.php',
					type: 'post',
					type: 'post',
					data: {categoriesId: categoriesId},
					dataType: 'json',
					success:function(response) {
						if(response.success == true) {
 							// remove categories btn
							$("#removeCategoriesBtn").button('reset');
							// close the modal 
							$("#removeCategoriesModal").modal('hide');
							// update the manage categories table
							managePartnersTable.ajax.reload(null, false);
							// udpate the messages
							$('.remove-messages').html('<div class="alert alert-success">'+
	            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
	            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
		          '</div>');

	  	  			$(".alert-success").delay(500).show(10, function() {
								$(this).delay(3000).hide(10, function() {
									$(this).remove();
								});
							}); // /.alert
 						} else {
 							// close the modal 
							$("#removeCategoriesModal").modal('hide');

 							// udpate the messages
							$('.remove-messages').html('<div class="alert alert-success">'+
	            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
	            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
		          '</div>');

	  	  			$(".alert-success").delay(500).show(10, function() {
								$(this).delay(3000).hide(10, function() {
									$(this).remove();
								});
							}); // /.alert
 						} // /else
						
						
					} // /success function
				}); // /ajax function request server to remove the categories data
			}); // /remove categories btn clicked to remove the categories function

		} // /response
	}); // /ajax function to fetch the categories data
} // remove categories function

function removeCategoriesP(categoriesId = null) {
		
	$.ajax({
		url: 'php_action/fetchSelectedPartner.php',
		type: 'post',
		data: {categoriesId: categoriesId},
		dataType: 'json',
		success:function(response) {			

			// remove categories btn clicked to remove the categories function
			$("#removeCategoriesBtnP").unbind('click').bind('click', function() {
				// remove categories btn
				$("#removeCategoriesBtnP").button('loading');

				$.ajax({
					url: 'php_action/removePartner.php',
					type: 'post',
					data: {categoriesId: categoriesId},
					dataType: 'json',
					success:function(response) {
							console.log(response);
						if(response.success == true) {
 							// remove categories btn
							$("#removeCategoriesBtnP").button('reset');
							// close the modal 
							$("#removeCategoriesModalP").modal('hide');
							// update the manage categories table
							managePartnersTable.ajax.reload(null, false);
							// udpate the messages
							$('.dismiss-messages').html('<div class="alert alert-success">'+
	            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
	            '<strong><i class="fa fa-check"></i></strong> '+ response.messages +
		          '</div>');

	  	  			$(".alert-success").delay(500).show(10, function() {
								$(this).delay(3000).hide(10, function() {
									$(this).remove();
								});
							}); // /.alert
 						} else {
 							// close the modal 
							$("#removeCategoriesModal1").modal('hide');

 							// udpate the messages
							$('.dismiss-messages').html('<div class="alert alert-success">'+
	            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
	            '<strong><i class="fa fa-check"></i></strong> '+ response.messages +
		          '</div>');

	  	  			$(".alert-success").delay(500).show(10, function() {
								$(this).delay(3000).hide(10, function() {
									$(this).remove();
								});
							}); // /.alert
 						} // /else
						
						
					} // /success function
				}); // /ajax function request server to remove the categories data
			}); // /remove categories btn clicked to remove the categories function

		} // /response
	}); // /ajax function to fetch the categories data
} // remove categories function