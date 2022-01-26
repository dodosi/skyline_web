var manageGaragesTable;

$(document).ready(function() {
	// active top navbar categories
	$('#navCategories').addClass('active');	

	manageGaragesTable = $('#manageGaragesTable').DataTable({
		'ajax' : 'php_action/fetchGarages.php',
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

			var name = $("#garageName").val();
			var email = $("#email").val();
			var phone = $("#phone").val();
			var weblink = $("#weblink").val();
			var thumbnail = $("#companyPic").val();
			
			var state = $("#state").val();
			var city = $("#city").val();
			var street = $("#street").val();
			var zip = $("#zip").val();
			
			var latitude = $("#latitude").val();
			var longitude = $("#longitude").val();
			
			var garageStatus = $("#garageStatus").val();

			if(name == "") {
				$("#garageName").after('<p class="text-danger">Garage Name field is required</p>');
				$('#garageName').closest('.form-group').addClass('has-error');
			} else {
				// remov error text field
				$("#garageName").find('.text-danger').remove();
				// success out for form 
				$("#garageName").closest('.form-group').addClass('has-success');	  	
			}
			if(email == "") {
				$("#email").after('<p class="text-danger">The email field is required</p>');
				$('#email').closest('.form-group').addClass('has-error');
			} else {
				// remov error text field
				$("#email").find('.text-danger').remove();
				// success out for form 
				$("#email").closest('.form-group').addClass('has-success');	  	
			}
			if(phone == "") {
				$("#phone").after('<p class="text-danger">The phone number field is required</p>');
				$('#phone').closest('.form-group').addClass('has-error');
			} else {
				// remov error text field
				$("#phone").find('.text-danger').remove();
				// success out for form 
				$("#phone").closest('.form-group').addClass('has-success');	  	
			}
			if(weblink == "") {
				$("#weblink").after('<p class="text-danger">The weblink field is required</p>');
				$('#weblink').closest('.form-group').addClass('has-error');
			} else {
				// remov error text field
				$("#weblink").find('.text-danger').remove();
				// success out for form 
				$("#weblink").closest('.form-group').addClass('has-success');	  	
			}
			
			if(thumbnail == "") {
				$("#companyPic").after('<p class="text-danger">The photo field is required</p>');
				$('#companyPic').closest('.form-group').addClass('has-error');
			} else {
				// remov error text field
				$("#companyPic").find('.text-danger').remove();
				// success out for form 
				$("#companyPic").closest('.form-group').addClass('has-success');	  	
			}
			if(state == "") {
				$("#state").after('<p class="text-danger">The state field is required</p>');
				$('#state').closest('.form-group').addClass('has-error');
			} else {
				// remov error text field
				$("#state").find('.text-danger').remove();
				// success out for form 
				$("#state").closest('.form-group').addClass('has-success');	  	
			}
			if(city == "") {
				$("#city").after('<p class="text-danger">The city is required</p>');
				$('#city').closest('.form-group').addClass('has-error');
			} else {
				// remov error text field
				$("#city").find('.text-danger').remove();
				// success out for form 
				$("#city").closest('.form-group').addClass('has-success');	  	
			}
			if(street == "") {
				$("#street").after('<p class="text-danger">The street field is required</p>');
				$('#street').closest('.form-group').addClass('has-error');
			} else {
				// remov error text field
				$("#street").find('.text-danger').remove();
				// success out for form 
				$("#street").closest('.form-group').addClass('has-success');	  	
			}

			if(garageStatus == "") {
				$("#garageStatus").after('<p class="text-danger">Garage status is required</p>');
				$('#garageStatus').closest('.form-group').addClass('has-error');
			} else {
				// remov error text field
				$("#garageStatus").find('.text-danger').remove();
				// success out for form 
				$("#garageStatus").closest('.form-group').addClass('has-success');	  	
			}
			if(name && phone && email && thumbnail && state && city && street && garageStatus) {
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
							manageGaragesTable.ajax.reload(null, false);						
                           
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
			url: 'php_action/fetchSelectedGarage.php',
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
				$("#editname").val(response.Name);
				// set the company TIN
				$("#editemail").val(response.Email); 
				// set the company TIN
				$("#editphone").val(response.phone); 
				// set the company TIN
				$("#editweblink").val(response.Websitelink); 
				// set the company TIN
				$("#editthumbnail").val(response.garage_thumbnail); 
				// set the company TIN
				// set the company TIN
				$("#editstate").val(response.state); 
				// set the company TIN
				$("#editcity").val(response.city);
				$("#editstreet").val(response.street); 
				$("#editzip").val(response.zip); 
				$("#editlongitude").val(response.longitude); 
				// set the company TIN
				$("#editlatitude").val(response.latitude); 
				// set the categories name 
				// set the company TIN 
				$("#editgarageStatus").val(response.status); 
				
				// add the categories id 
				$(".editCategoriesFooter").after('<input type="hidden" name="editCategoriesId" id="editCategoriesId" value="'+response.garageID+'" />');


				// submit of edit categories form
				$("#editCategoriesForm").unbind('submit').bind('submit', function() {
					var name = $("#editname").val(); 
					var email = $("#editemail").val();
					var phone = $("#editphone").val(); 
					var links = $("#editweblink").val();
					
					var thumbnail = $("#editthumbnail").val();
					var state = $("#editstate").val();
					var city = $("#editcity").val();
					var street = $("#editstreet").val();
					var zip = $("#editzip").val();
					var latitude = $("#editlatitude").val();
					var longitude = $("#editlongitude").val();
					var categoriesStatus = $("#editgarageStatus").val();

					if(name == "") {
						$("#editname").after('<p class="text-danger">Water tape name field is required</p>');
						$('#editname').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editname").find('.text-danger').remove();
						// success out for form 
						$("#editname").closest('.form-group').addClass('has-success');	  	
					}
					if(email == "") {
						$("#editemail").after('<p class="text-danger">WSS field is required</p>');
						$('#editemail').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editemail").find('.text-danger').remove();
						// success out for form 
						$("#editemail").closest('.form-group').addClass('has-success');	  	
					}
					if(phone == "") {
						$("#editphone").after('<p class="text-danger">Company Email field is required</p>');
						$('#editphone').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editphone").find('.text-danger').remove();
						// success out for form 
						$("#editphone").closest('.form-group').addClass('has-success');	  	
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

					if(name && email && phone && categoriesStatus) {
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
                                console.log(response);
								if(response.success == true) {
									// reload the manage member table 
									manageGaragesTable.ajax.reload(null, false);									  	  			
									
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

// remove categories function
function removeCategories(categoriesId = null) {
		
	$.ajax({
		url: 'php_action/fetchSelectedGarage.php',
		type: 'post',
		data: {categoriesId: categoriesId},
		dataType: 'json',
		success:function(response) {			

			// remove categories btn clicked to remove the categories function
			$("#removeCategoriesBtn").unbind('click').bind('click', function() {
				// remove categories btn
				$("#removeCategoriesBtn").button('loading');

				$.ajax({
					url: 'php_action/removeGarage.php',
					type: 'post',
					data: {categoriesId: categoriesId},
					dataType: 'json',
					success:function(response) {
 							// remove categories btn
							$("#removeCategoriesBtn").button('reset');
						//console.log(response);
						if(response.success == true) {
							// close the modal 
							//$("#removeCategoriesModal").modal('hide');
							// update the manage categories table
							manageGaragesTable.ajax.reload(null, false);
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