var manageCategoriesTable;

$(document).ready(function() {
	// active top navbar categories
	$('#navCategories').addClass('active');	

	manageCategoriesTable = $('#manageCategoriesTable').DataTable({
		'scrollX': '200px',
		 'searching': false,
         'paging': false, 
         'info': false,         
         'lengthChange':false, 
		'scrollCollapse': true,
		'ajax' : 'php_action/fetchWorkingHours.php',
		'order': []
	}); // manage categories Data Table 
	// on click on submit categories form modal
	$('#addCategoriesModalBtnDS').unbind('click').bind('click', function() {
		// reset the form text
		$("#submitCategoriesFormDS")[0].reset();
		// remove the error text
		$(".text-danger").remove();
		// remove the form error
		$('.form-group').removeClass('has-error').removeClass('has-success');

		// submit categories form function
		$("#submitCategoriesFormDS").unbind('submit').bind('submit', function() { 
		 
			var categoriesName = $("#dayName").val();
			var dayFrom = $("#dayFrom").val();
			var dayTo = $("#dayTo").val();
            var categoriesStatus = $("#categoriesStatus1").val(); 			

			if(categoriesName == "") {
				$("#dayName").after('<p class="text-danger">Day Name field is required</p>');
				$('#dayName').closest('.form-group').addClass('has-error');
			} else {
				// remov error text field
				$("#dayName").find('.text-danger').remove();
				// success out for form 
				$("#dayName").closest('.form-group').addClass('has-success');	  	
			}
			
			if(dayFrom == "") {
				$("#dayFrom").after('<p class="text-danger">Day Name field is required</p>');
				$('#dayFrom').closest('.form-group').addClass('has-error');
			} else {
				// remov error text field
				$("#dayFrom").find('.text-danger').remove();
				// success out for form 
				$("#dayFrom").closest('.form-group').addClass('has-success');	  	
			}
			
			if(dayTo == "") {
				$("#dayTo").after('<p class="text-danger">Day Name field is required</p>');
				$('#dayTo').closest('.form-group').addClass('has-error');
			} else {
				// remov error text field
				$("#dayTo").find('.text-danger').remove();
				// success out for form 
				$("#dayTo").closest('.form-group').addClass('has-success');	  	
			}

			if(categoriesStatus == "") {
				$("#categoriesStatus1").after('<p class="text-danger">Day status is required</p>');
				$('#categoriesStatus1').closest('.form-group').addClass('has-error');
			} else {
				// remov error text field
				$("#categoriesStatus1").find('.text-danger').remove();
				// success out for form 
				$("#categoriesStatus1").closest('.form-group').addClass('has-success');	  	
			}
			if(categoriesName && categoriesStatus) {
				var form = $(this);
				// button loading
				$("#createCategoriesBtn1").button('loading');

				$.ajax({
					url : form.attr('action'),
					type: form.attr('method'),
					data: form.serialize(), 
					dataType: 'json',
					success:function(response) { 
						// button loading
						$("#createCategoriesBtn1").button('reset'); 
						
						if(response.success == true) {
							// reload the manage member table 
							manageCategoriesTable.ajax.reload(null, false);						
                           
	  	  			// reset the form text
							$("#submitCategoriesFormDS")[0].reset();
							// remove the error text
							$(".text-danger").remove();
							// remove the form error
							$('.form-group').removeClass('has-error').removeClass('has-success');
	  	  			
	  	  			$('#add-categories-messagesSS').html('<div class="alert alert-success">'+
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
		$("#editCategoriesFormDS")[0].reset();
		// reset the form text-error
		$(".text-danger").remove();
		// reset the form group errro		
		$('.form-group').removeClass('has-error').removeClass('has-success');

		// edit categories messages
		$("#edit-categories-messagesDS").html("");
		// modal spinner
		$('.modal-loading').removeClass('div-hide');
		// modal result
		$('.edit-categories-result').addClass('div-hide');
		//modal footer
		$(".editCategoriesFooter").addClass('div-hide');		

		$.ajax({
			url: 'php_action/fetchSelectedWorkingHours.php',
			type: 'post',
			data: {categoriesId: categoriesId},
			dataType: 'json',
			success:function(response) {

				// modal spinner
				$('.modal-loading').addClass('div-hide');
				// modal result
				$('.edit-categories-result').removeClass('div-hide');
				//modal footer
				$(".editCategoriesFooterDS").removeClass('div-hide');	

				// set the categories name
				$("#editdayName").val(response.day);
				// set the categories name
				$("#editdayFrom").val(response.hourFrom);
				// set the categories name
				$("#editdayTo").val(response.hourTo);
				// set the company TIN 
				// set the categories name
				$("#editDayStatus").val(response.status);
				// set the categories status 
				$(".editCategoriesFooterDS").after('<input type="hidden" name="editCategoriesId" id="editCategoriesId" value="'+response.id+'" />');


				// submit of edit categories form
				$("#editCategoriesFormDS").unbind('submit').bind('submit', function() {
					//var categoriesName = $("#editCategoriesName").val();  
					//var categoriesStatus = $("#editcategoriesStatus").val();
					
					var editdayName = $("#editdayName").val();
			        var editdayFrom = $("#editdayFrom").val();
			        var editdayTo = $("#editdayTo").val();
                    var editDayStatus = $("#editDayStatus").val(); 	
                       
					if(editdayName == "") {
						$("#editdayName").after('<p class="text-danger">Day name field is required</p>');
						$('#editdayName').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editdayName").find('.text-danger').remove();
						// success out for form 
						$("#editdayName").closest('.form-group').addClass('has-success');	  	
					}  
					
					if(editdayFrom == "") {
						$("#editdayFrom").after('<p class="text-danger">Day From field is required</p>');
						$('#editdayFrom').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editdayFrom").find('.text-danger').remove();
						// success out for form 
						$("#editdayFrom").closest('.form-group').addClass('has-success');	  	
					}
					
					if(editdayTo == "") {
						$("#editdayTo").after('<p class="text-danger">Day To field is required</p>');
						$('#editdayTo').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editdayTo").find('.text-danger').remove();
						// success out for form 
						$("#editdayTo").closest('.form-group').addClass('has-success');	  	
					}

					if(editDayStatus == "") {
						$("#editDayStatus").after('<p class="text-danger">Status field is required</p>');
						$('#editDayStatus').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editDayStatus").find('.text-danger').remove();
						// success out for form 
						$("#editDayStatus").closest('.form-group').addClass('has-success');	  	
					}

					if(editdayName && editDayStatus && editdayTo && editdayFrom) {
						var form = $(this);
						// button loading
						$("#editCategoriesBtnDS").button('loading');

						$.ajax({
							url : form.attr('action'),
							type: form.attr('method'),
							data: form.serialize(),
							dataType: 'json',
							success:function(response) {
								// button loading
								$("#editCategoriesBtnDS").button('reset'); 
								if(response.success == true) {
									// reload the manage member table 
									manageCategoriesTable.ajax.reload(null, false);									  	  			
									
									// remove the error text
									$(".text-danger").remove();
									// remove the form error
									$('.form-group').removeClass('has-error').removeClass('has-success');
			  	  			
			  	  			$('#edit-categories-messagesDS').html('<div class="alert alert-success">'+
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
function removeCategories1(categoriesId = null) {
		
	$.ajax({
		url: 'php_action/fetchSelectedWorkingHours.php',
		type: 'post',
		data: {categoriesId: categoriesId},
		dataType: 'json',
		success:function(response) {			

			// remove categories btn clicked to remove the categories function
			$("#removeCategoriesBtnDS").unbind('click').bind('click', function() {
				// remove categories btn
				$("#removeCategoriesBtnDS").button('loading');

				$.ajax({
					url: 'php_action/removeWorkingDays.php',
					type: 'post',
					data: {categoriesId: categoriesId},
					dataType: 'json',
					success:function(response) {
 							// remove categories btn
							$("#removeCategoriesBtnDS").button('reset');
						if(response.success == true) {
							// close the modal 
							//$("#removeCategoriesModal1").modal('hide');
							// update the manage categories table
							manageCategoriesTable.ajax.reload(null, false);
							// udpate the messages
							$('.remove-messagesDS').html('<div class="alert alert-success">'+
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
							//$("#removeCategoriesModal1").modal('hide');

 							// udpate the messages
							$('.remove-messagesDS').html('<div class="alert alert-success">'+
	            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
	            '<strong><i class="fa fa-check"></i></strong> '+ response.messages +
		          '</div>');

	  	  			$(".alert-success").delay(500).show(10, function() {
								$(this).delay(3000).hide(10, function() {
									$(this).remove();
								});
							}); // /.alert
 						} // /else
						//console.log(response)
						
					} // /success function
				}); // /ajax function request server to remove the categories data
			}); // /remove categories btn clicked to remove the categories function

		} // /response
	}); // /ajax function to fetch the categories data
} // remove categories function