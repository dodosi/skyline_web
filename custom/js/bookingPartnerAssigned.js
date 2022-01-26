var manageCustomersTable;

$(document).ready(function() {
	// active top navbar categories
	$('#navCategories').addClass('active');	

	manageCustomersTable = $('#manageCustomersTable').DataTable({
		'scrollX': '200px',
		'scrollCollapse': true,
		'ajax' : 'php_action/fetchBookingPartnerAssigned.php',
		'order': []
	}); // manage categories Data Table  

}); // /document
// edit categories function 

function editCategories3(categoriesId = null ) {
	if(categoriesId) {
		//alert(categoriesId);
		// remove the added categories id 
		$('#editCategoriesId').remove();
		// reset the form text
		$("#editCategoriesForm3")[0].reset();
		// reset the form text-error
		$(".text-danger").remove();
		// reset the form group errro		
		$('.form-group').removeClass('has-error').removeClass('has-success');

		// edit categories messages
		$("#confirm-categories-messages").html("");
		// modal spinner
		$('.modal-loading').removeClass('div-hide');
		// modal result
		$('.edit-categories-result').addClass('div-hide');
		//modal footer
		$(".editCategoriesFooterE").addClass('div-hide');

		$.ajax({
			url: 'php_action/fetchSelectedBookingAssigned.php',
			type: 'post',
			data: {categoriesId: categoriesId},
			dataType: 'json',
			success:function(response) {

				// modal spinner
				$('.modal-loading').addClass('div-hide');
				// modal result
				$('.edit-categories-result').removeClass('div-hide');
				//modal footer
				$(".editCategoriesFooterE").removeClass('div-hide');	
		        
				// set the categories name
				$("#email").val(response.id); 
				$("#book").val(response.bookID); 
				// add the categories id 
				$(".editCategoriesFooterE").after('<input type="hidden" name="editCategoriesId" id="editCategoriesId" value="'+response.id+'" />');


				// submit of edit categories form
				$("#editCategoriesForm3").unbind('submit').bind('submit', function() { 
					var editCategoriesId = $("#email").val();
                                        var bookID = $("#book").val();
					 //alert(editCategoriesId);
                                        //  alert(bookID);
						
				        //console.log(editCategoriesId)  

					if(editCategoriesId) {
						var form = $(this);
						// button loading
						//alert(editnames)
						//alert(editemail1)
						$("#editCategoriesBtn3").button('loading');
                 
						//alert(categoriesStatus)
						$.ajax({
							url : form.attr('action'),
							type: form.attr('method'),
							data: form.serialize(),
							dataType: 'json',
							success:function(response) {
								//alert("HERE")
								// button loading
								$("#editCategoriesBtn3").button('reset');

								if(response.success == true) {
									// reload the manage member table 
									manageCustomersTable.ajax.reload(null, false);								  	  			
									
									// remove the error text
									$(".text-danger").remove();
									// remove the form error
									$('.form-group').removeClass('has-error').removeClass('has-success');
										
										$('#confirm-categories-messages').html('<div class="alert alert-success">'+
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
				}); // /submit of edit categories form

			} // /success
		}); // /fetch the selected categories data

	} else {
		alert('Oops!! Refresh the page');
	}
} // /edit categories function


function removeCategories(categoriesId = null) {
	//alert(categoriesId);
	$.ajax({
		url: 'php_action/fetchSelectedBookingAssigned.php',
		type: 'post',
		data: {categoriesId: categoriesId},
		dataType: 'json',
		success:function(response) {			
           //alert("Here");
			// remove categories btn clicked to remove the categories function
			$("#removeCategoriesBtn").unbind('click').bind('click', function() {
				// remove categories btn
				$("#removeCategoriesBtn").button('loading');
                            //console.log("Here birahageraa");
				$.ajax({
					url: 'php_action/doneBooking.php',
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
					//console.log(data);
				}); // /ajax function request server to remove the categories data
				
                            //console.log(response);
			}); // /remove categories btn clicked to remove the categories function

		} // /response
	}); // /ajax function to fetch the categories data
} // remove categories function