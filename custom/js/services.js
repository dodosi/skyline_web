var manageCategoriesTable;

$(document).ready(function() {
	// active top navbar categories
	$('#navCategories').addClass('active');	

	manageCategoriesTable = $('#manageCategoriesTable').DataTable({
		'ajax' : 'php_action/fetchServices.php',
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

			var servicesName = $("#serviceName").val();
			var categoriesName = $("#categoryName").val();
			var categoriesStatus = $("#categoriesStatus").val();

			if(servicesName == "") {
				$("#serviceName").after('<p class="text-danger">Service Name field is required</p>');
				$('#serviceName').closest('.form-group').addClass('has-error');
			} else {
				// remov error text field
				$("#servicesName").find('.text-danger').remove();
				// success out for form 
				$("#servicesName").closest('.form-group').addClass('has-success');	  	
			}
			
			if(categoriesName == "") {
				$("#categoryName").after('<p class="text-danger">Category Name field is required</p>');
				$('#categoryName').closest('.form-group').addClass('has-error');
			} else {
				// remov error text field
				$("#categoryName").find('.text-danger').remove();
				// success out for form 
				$("#categoryName").closest('.form-group').addClass('has-success');	  	
			}

			if(categoriesStatus == "") {
				$("#categoriesStatus").after('<p class="text-danger">Service status is required</p>');
				$('#categoriesStatus').closest('.form-group').addClass('has-error');
			} else {
				// remov error text field
				$("#categoriesStatus").find('.text-danger').remove();
				// success out for form 
				$("#categoriesStatus").closest('.form-group').addClass('has-success');	  	
			}
			if(servicesName && categoriesName && categoriesStatus) {
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
						console.log(response);
						if(response.success == true) {
							// reload the manage member table 
							manageCategoriesTable.ajax.reload(null, false);						
                           
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
                         //console.log(response)
					} // /success
					//alert(data),
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
			url: 'php_action/fetchSelectedService.php',
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
				$("#editServicesName").val(response.serviceName);
				// set the categories name
				$("#editcategoryName").val(response.serviceCategory);
				// set the company TIN 
				// set the categories name
				//$("#editgarageID").val(response.garageID);
				// set the categories status
				$("#editcategoryStatus").val(response.status);
				// add the categories id 
				$(".editCategoriesFooter").after('<input type="hidden" name="editCategoriesId" id="editCategoriesId" value="'+response.servID+'" />');


				// submit of edit categories form
				$("#editCategoriesForm").unbind('submit').bind('submit', function() {
					var categoriesName = $("#editServicesName").val(); 
					var wss_id = $("#editcategoryName").val(); 
					var categoriesStatus = $("#editcategoryStatus").val();

					if(categoriesName == "") {
						$("#editServicesName").after('<p class="text-danger">Water tape name field is required</p>');
						$('#editServicesName').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editServicesName").find('.text-danger').remove();
						// success out for form 
						$("#editServicesName").closest('.form-group').addClass('has-success');	  	
					}
					if(wss_id == "") {
						$("#editcategoryName").after('<p class="text-danger">WSS field is required</p>');
						$('#editcategoryName').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editcategoryName").find('.text-danger').remove();
						// success out for form 
						$("#editcategoryName").closest('.form-group').addClass('has-success');	  	
					} 

					if(categoriesStatus == "") {
						$("#editcategoryStatus").after('<p class="text-danger">Company status field is required</p>');
						$('#editcategoryStatus').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editcategoryStatus").find('.text-danger').remove();
						// success out for form 
						$("#editcategoryStatus").closest('.form-group').addClass('has-success');	  	
					}

					if(categoriesName && wss_id &&  categoriesStatus) {
						var form = $(this);
						// button loading
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
                               ;;;;
								if(response.success == true) {
									// reload the manage member table 
									manageCategoriesTable.ajax.reload(null, false);									  	  			
									
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
                               console.log(response)
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
		url: 'php_action/fetchSelectedCategory.php',
		type: 'post',
		data: {categoriesId: categoriesId},
		dataType: 'json',
		success:function(response) {			

			// remove categories btn clicked to remove the categories function
			$("#removeCategoriesBtn").unbind('click').bind('click', function() {
				// remove categories btn
				$("#removeCategoriesBtn").button('loading');

				$.ajax({
					url: 'php_action/removeServices.php',
					type: 'post',
					data: {categoriesId: categoriesId},
					dataType: 'json',
					success:function(response) {
 							// remove categories btn
							$("#removeCategoriesBtn").button('reset');
						if(response.success == true) {
							// close the modal 
							//$("#removeCategoriesModal").modal('hide');
							// update the manage categories table
							manageCategoriesTable.ajax.reload(null, false);
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
							//$("#removeCategoriesModal").modal('hide');

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