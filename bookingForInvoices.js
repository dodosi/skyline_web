var manageCustomersTable;

$(document).ready(function() {
	// active top navbar categories
	$('#navCategories').addClass('active');	

	manageCustomersTable = $('#manageCustomersTable').DataTable({
		'scrollX': '200px',
		'scrollCollapse': true,
		'ajax' : 'php_action/fetchBookingDone.php',
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

			var categoriesName = $("#categoriesName").val();
			var categoriesStatus = $("#categoriesStatus").val();

			if(categoriesName == "") {
				$("#categoriesName").after('<p class="text-danger">Category Name field is required</p>');
				$('#categoriesName').closest('.form-group').addClass('has-error');
			} else {
				// remov error text field
				$("#categoriesName").find('.text-danger').remove();
				// success out for form 
				$("#categoriesName").closest('.form-group').addClass('has-success');	  	
			}

			if(categoriesStatus == "") {
				$("#categoriesStatus").after('<p class="text-danger">Category status is required</p>');
				$('#categoriesStatus').closest('.form-group').addClass('has-error');
			} else {
				// remov error text field
				$("#categoriesStatus").find('.text-danger').remove();
				// success out for form 
				$("#categoriesStatus").closest('.form-group').addClass('has-success');	  	
			}
			if(categoriesName && categoriesStatus) {
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
						$("#createCategoriesBtn").button('reset'); 
						
						if(response.success == true) {
							// reload the manage member table 
							manageCustomersTable.ajax.reload(null, false);						
                           
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
                        alert(response);
					} // /success
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
		$("#editCategoriesForm1")[0].reset();
		// reset the form text-error
		$(".text-danger").remove();
		// reset the form group errro		
		$('.form-group').removeClass('has-error').removeClass('has-success');

		// edit categories messages
		$("#edit-categories-messages1").html("");
		// modal spinner
		$('.modal-loading').removeClass('div-hide');
		// modal result
		$('.edit-categories-result').addClass('div-hide');
		//modal footer
		$(".editCategoriesFooter").addClass('div-hide');		

		$.ajax({
			url: 'php_action/fetchSelectedBookingPartner.php',
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
				$("#editservice").val(response.service);
				// set the categories name
				$("#editmodel").val(response.model);
				// set the categories name
				$("#editmaked").val(response.make);
				// set the categories name
				$("#editplate").val(response.plate);
				// set the categories name
				$("#editcolor").val(response.color);
				// set the categories name
				$("#editpick").val(response.pick);
				// set the categories name
				$("#editdescription").val(response.description);
				// set the categories status
				$("#editdriverEmail").val(response.driveremail);
				// add the categories id 
				$(".editCategoriesFooter").after('<input type="hidden" name="editCategoriesId" id="editCategoriesId" value="'+response.id+'" />');

 

			} // /success
		}); // /fetch the selected categories data

	} else {
		alert('Oops!! Refresh the page');
	}
} // /edit categories function

// edit categories function
function editCategories(categoriesId = null ) {
	if(categoriesId) {
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
			url: 'php_action/fetchSelectedBookingPartner.php',
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
				$("#editfname1").val(response.fname);
				// set the company TIN
				$("#editlname1").val(response.lname); 
				// set the categories name
				$("#editlname1").val(response.phone); 
				// set the categories name
				$("#editservicess").val(response.service); 
				// set the categories name
				$("#editemail1").val(response.email);  
				// add the categories id 
				$(".editCategoriesFooter").after('<input type="hidden" name="editCategoriesId" id="editCategoriesId" value="'+response.id+'" />');


				// submit of edit categories form
				$("#editCategoriesForm").unbind('submit').bind('submit', function() { 
					var editemail1 = $("#editemail1").val();
                    var editnames = $("#editnames").val();
						//alert(categoriesStatus)
						
				        //console.log(categoriesStatus)

					if(editnames == "") {
						$("#editnames").after('<p class="text-danger">Mechanical names are required</p>');
						$('#editnames').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editnames").find('.text-danger').remove();
						// success out for form 
						$("#editnames").closest('.form-group').addClass('has-success');	  	
					}
					
					if(editemail1 == "") {
						$("#editemail1").after('<p class="text-danger">Client Email is required</p>');
						$('#editemail1').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editemail1").find('.text-danger').remove();
						// success out for form 
						$("#editemail1").closest('.form-group').addClass('has-success');	  	
					}

					if(editnames && editemail1) {
						var form = $(this);
						// button loading
						//alert(editnames)
						//alert(editemail1)
						$("#editCategoriesBtn").button('loading');
                 
						//alert(categoriesStatus)
						$.ajax({
							url : form.attr('action'),
							type: form.attr('method'),
							data: form.serialize(),
							dataType: 'json',
							success:function(response) {
								//alert("HERE")
								// button loading
								$("#editCategoriesBtn").button('reset');

								if(response.success == true) {
									// reload the manage member table 
									manageCustomersTable.ajax.reload(null, false);								  	  			
									
									// remove the error text
									$(".text-danger").remove();
									// remove the form error
									$('.form-group').removeClass('has-error').removeClass('has-success');
										
										$('#edit-categories-messages').html('<div class="alert alert-success">'+
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
						 alert(data);
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
function removeCategories1(categoriesId = null) {
		
	$.ajax({
		url: 'php_action/confirmBooking.php',
		type: 'post',
		data: {categoriesId: categoriesId},
		dataType: 'json',
		success:function(response) {			

			// remove categories btn clicked to remove the categories function
			$("#removeCategoriesBtnC").unbind('click').bind('click', function() {
				// remove categories btn
				$("#removeCategoriesBtnC").button('loading');

				$.ajax({
					url: '#',
					type: 'post',
					data: {categoriesId: categoriesId},
					dataType: 'json',
					success:function(response) {
						if(response.success == true) {
 							// remove categories btn
							$("#removeCategoriesBtnC").button('reset');
							// close the modal 
							$("#removeCategoriesModalC").modal('hide');
							// update the manage categories table
							manageCustomersTable.ajax.reload(null, false);
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
							$("#removeCategoriesModalC").modal('hide');

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

function removeCategories(categoriesId = null) {
		
	$.ajax({
		url: 'php_action/rejectBooking.php',
		type: 'post',
		data: {categoriesId: categoriesId},
		dataType: 'json',
		success:function(response) {			

			// remove categories btn clicked to remove the categories function
			$("#removeCategoriesBtn").unbind('click').bind('click', function() {
				// remove categories btn
				$("#removeCategoriesBtn").button('loading');

				$.ajax({
					url: '#',
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
							manageCustomersTable.ajax.reload(null, false);
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
							$("#removeCategoriesModal").modal('hide');

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