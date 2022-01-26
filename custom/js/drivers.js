var manageDriversTable;

$(document).ready(function() {
	// active top navbar categories
	$('#navCategories').addClass('active');	

	manageDriversTable = $('#manageDriversTable').DataTable({
		'ajax' : 'php_action/fetchDriver.php',
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
				//alert(fname);
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
// edit categories function 
function editCategories1(categoriesId = null ) {
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
		$(".editCategoriesFooter1").addClass('div-hide');		

		$.ajax({
			url: 'php_action/fetchSelectedDriver.php',
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
				/* 
				$("#getProductImage").attr('src', 'users/'+response.company_pic);

				$("#editpicture").fileinput({		      
				}); */ 

				// set the categories name
				//$("#editpicture").val(response.company_pic);
				// set the categories name
				$("#editfname").val(response.fname);
				// set the company TIN
				$("#editlname").val(response.lname); 
				// set the categories name
				$("#editphone1").val(response.phone);
				// set the categories name
				$("#editphone2").val(response.phone);
				// set the categories name
				$("#editemail").val(response.email);
				// set the categories name
				//$("#editproof").val(response.doc_proof);
				// set the categories name
				//$("#editstreet").val(response.street);
				// set the categories name
				//$("#editName").val(response.Name);
				// set the categories name
				$("#editcity").val(response.city);
				// set the categories name
				//$("#editstate").val(response.state);
				// set the categories name
				$("#editzip").val(response.zip_code);
				// set the categories name
				//$("#editregDate").val(response.regDate);
				// set the categories name
				$("#edituserType").val(response.user_type);
				// set the categories status
				$("#editStatus").val(response.status);
				// add the categories id 
				$(".editCategoriesFooter1").after('<input type="hidden" name="editCategoriesId" id="editCategoriesId" value="'+response.id+'" />');


				// submit of edit categories form
				$("#editCategoriesForm").unbind('submit').bind('submit', function() {
					var fname = $("#editfname").val(); 
					var lname = $("#editlname").val();
					var phone1 = $("#editphone1").val();
					var phone2 = $("#editphone2").val();
                                        var email = $("editemail").val(); 
                                        var street = $("editstreet").val(); 
                                        var city = $("editcity").val(); 
					var state = $("editstate").val(); 
					var zip = $("editzip").val(); 
					var regDate = $("editregDate").val();  
					
					var categoriesStatus = $("#editStatus").val();

					if(fname == "") {
						$("#editfname").after('<p class="text-danger">First name field is required</p>');
						$('#editfname').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editfname").find('.text-danger').remove();
						// success out for form 
						$("#editfname").closest('.form-group').addClass('has-success');	  	
					}
					if(lname == "") {
						$("#editlname").after('<p class="text-danger">Last name field is required</p>');
						$('#editlname').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editlname").find('.text-danger').remove();
						// success out for form 
						$("#editlname").closest('.form-group').addClass('has-success');	  	
					}
					if(phone1 == "") {
						$("#editphone1").after('<p class="text-danger">Phone number field is required</p>');
						$('#editphone1').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editphone1").find('.text-danger').remove();
						// success out for form 
						$("#editphone1").closest('.form-group').addClass('has-success');	  	
					} 
					
					if(email == "") {
						$("#editemail").after('<p class="text-danger">Email is required</p>');
						$('#editemail').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editemail").find('.text-danger').remove();
						// success out for form 
						$("#editemail").closest('.form-group').addClass('has-success');	  	
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

					if(fname && lname) {
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
								if(response.success == true) {
									console.log(response);
									// reload the manage member table 
									manageDriversTable.ajax.reload(null, false);									  	  			
									
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
							//alert("HERE") 
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
			url: 'php_action/fetchSelectedDriver.php',
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
				/* 
				$("#getProductImage").attr('src', 'users/'+response.company_pic);

				$("#editpicture").fileinput({		      
				}); */ 

				// set the categories name
				//$("#editpicture").val(response.company_pic);
				// set the categories name
				$("#editName1").val(response.fname+" "+response.lname); 
				// set the categories name
				//$("#editregDate1").val(response.regDate); 
				// set the categories status
				$("#editStatus1").val(response.status);
				// add the categories id 
				$(".editCategoriesFooter").after('<input type="hidden" name="editCategoriesId" id="editCategoriesId" value="'+response.id+'" />');


				// submit of edit categories form
				$("#editCategoriesForm").unbind('submit').bind('submit', function() {
					var fname = $("#editName1").val();  
					var zip = $("editzip").val(); 
					//var regDate = $("editregDate1").val();  
					
					var categoriesStatus = $("#editStatus1").val();
                    
					if(fname == "") {
						$("#editfname").after('<p class="text-danger">First name field is required</p>');
						$('#editfname').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editfname").find('.text-danger').remove();
						// success out for form 
						$("#editfname").closest('.form-group').addClass('has-success');	  	
					} 

					if(categoriesStatus == "") {
						$("#editStatus1").after('<p class="text-danger">Driver status field is required</p>');
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
						$("#editCategoriesBtn").button('loading');
						
						//alert(fname);
					
					    //alert(categoriesStatus);
						//alert(editCategoriesId);
						//console.log("ID from hidden place "+editCategoriesId);
					
						$.ajax({
							url : form.attr('action'),
							type: form.attr('method'),
							data: form.serialize(),
							dataType: 'json',
							success:function(response) {
								// button loading
								$("#editCategoriesBtn").button('reset'); 
								if(response.success == true) {
									//console.log(response);
									// reload the manage member table 
									manageDriversTable.ajax.reload(null, false);									  	  			
									
									// remove the error text
									$(".text-danger").remove();
									// remove the form error
									$('.form-group').removeClass('has-error').removeClass('has-success');
			  	  			
			  	  			$('#edit-categories-messagess').html('<div class="alert alert-success">'+
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
							//alert("HERE") 
						}); // /ajax
						//alert(data);
						//alert("Jumped here")
                        						
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
		url: 'php_action/fetchSelectedDriver.php',
		type: 'post',
		data: {categoriesId: categoriesId},
		dataType: 'json',
		success:function(response) {			

			// remove categories btn clicked to remove the categories function
			$("#removeCategoriesBtn").unbind('click').bind('click', function() {
				// remove categories btn
				$("#removeCategoriesBtn").button('loading');

				$.ajax({
					url: 'php_action/approveDriver.php',
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
							manageDriversTable.ajax.reload(null, false);	
							// udpate the messages
							$('.approve-messages').html('<div class="alert alert-success">'+
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
							$("#removeCategoriesModal").modal('hide');

 							// udpate the messages
							$('.approve-messages').html('<div class="alert alert-success">'+
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

// remove categories function
function removeCategories1(categoriesId = null) {
		
	$.ajax({
		url: 'php_action/fetchSelectedDriver.php',
		type: 'post',
		data: {categoriesId: categoriesId},
		dataType: 'json',
		success:function(response) {			

			// remove categories btn clicked to remove the categories function
			$("#removeCategoriesBtn1").unbind('click').bind('click', function() {
				// remove categories btn
				$("#removeCategoriesBtn1").button('loading');

				$.ajax({
					url: 'php_action/removeDriver.php',
					type: 'post',
					data: {categoriesId: categoriesId},
					dataType: 'json',
					success:function(response) {
						if(response.success == true) {
 							// remove categories btn
							$("#removeCategoriesBtn1").button('reset');
							// close the modal 
							$("#removeCategoriesModa1l").modal('hide');
							// update the manage categories table
							manageDriversTable.ajax.reload(null, false);	
							// udpate the messages
							$('.remove-messages').html('<div class="alert alert-success">'+
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
							$('.remove-messages').html('<div class="alert alert-success">'+
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