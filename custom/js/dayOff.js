var manageDayOffTable;

$(document).ready(function() {
	// active top navbar categories
	$('#navCategories').addClass('active');	

	manageDayOffTable = $('#manageDayOffTable').DataTable({
		'scrollX': '200px',
		 'searching': true,
         'paging': true, 
         'info': false,         
         'lengthChange':true, 
		'scrollCollapse': true,
		'lengthMenu': [
						[ 5,10, 25, 50, -1 ],
						[ '5','10', '25', '50', 'All' ]
					], 
		'ajax' : 'php_action/fetchDayOff.php',
		'order': []
	}); // manage categories Data Table 
	// on click on submit categories form modal
	$('#addCategoriesModalBtnD').unbind('click').bind('click', function() {
		// reset the form text
		$("#submitCategoriesFormD")[0].reset();
		// remove the error text
		$(".text-danger").remove();
		// remove the form error
		$('.form-group').removeClass('has-error').removeClass('has-success');

		// submit categories form function
		$("#submitCategoriesFormD").unbind('submit').bind('submit', function() {
  
			var dayFrom = $("#dayOffFrom").val();
			var dayTo = $("#dayOffTo").val();
			var categoriesStatus = $("#categoriesStatusD").val();
			
            
			
			if(dayFrom == "") {
				$("#dayOffFrom").after('<p class="text-danger">DayOff from field is required</p>');
				$('#dayOffFrom').closest('.form-group').addClass('has-error');
			} else {
				// remov error text field
				$("#dayOffFrom").find('.text-danger').remove();
				// success out for form 
				$("#dayOffFrom").closest('.form-group').addClass('has-success');	  	
			}
			
				if(dayTo == "") {
				$("#dayOffTo").after('<p class="text-danger">DayOff to field is required</p>');
				$('#dayOffTo').closest('.form-group').addClass('has-error');
			} else {
				// remov error text field
				$("#dayOffTo").find('.text-danger').remove();
				// success out for form 
				$("#dayOffTo").closest('.form-group').addClass('has-success');	  	
			}

			if(categoriesStatus == "") {
				$("#categoriesStatusD").after('<p class="text-danger">DayOff status is required</p>');
				$('#categoriesStatusD').closest('.form-group').addClass('has-error');
			} else {
				// remov error text field
				$("#categoriesStatusD").find('.text-danger').remove();
				// success out for form 
				$("#categoriesStatusD").closest('.form-group').addClass('has-success');	  	
			}
			if(dayFrom && dayTo && categoriesStatus) {
				var form = $(this);
				// button loading
				$("#createCategoriesBtnD").button('loading');

				$.ajax({
					url : form.attr('action'),
					type: form.attr('method'),
					data: form.serialize(), 
					dataType: 'json',
					success:function(response) { 
						// button loading
						$("#createCategoriesBtnD").button('reset'); 
						
						if(response.success == true) {
							// reload the manage member table 
							manageDayOffTable.ajax.reload(null, false);						
                           
	  	  			// reset the form text
							$("#submitCategoriesFormD")[0].reset();
							// remove the error text
							$(".text-danger").remove();
							// remove the form error
							$('.form-group').removeClass('has-error').removeClass('has-success');
	  	  			
	  	  			$('#add-categories-messagesD').html('<div class="alert alert-success">'+
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
					//console.log(data);
					} // /success
				}); // /ajax	
			} // if

			return false;
		}); // submit categories form function
	}); // /on click on submit categories form modal	

}); // /document
// edit categories function
function editCategories2(categoriesId = null ) {
	if(categoriesId) {
	    //alert(categoriesId);
		//alert("Hello");
		// remove the added categories id 
		$('#editCategoriesId').remove();
		// reset the form text
		$("#editCategoriesFormD")[0].reset();
		// reset the form text-error
		$(".text-danger").remove();
		// reset the form group errro		
		$('.form-group').removeClass('has-error').removeClass('has-success');

		// edit categories messages
		$("#edit-categories-messagesD").html("");
		// modal spinner
		$('.modal-loading').removeClass('div-hide');
		// modal result
		$('.edit-categories-result').addClass('div-hide');
		//modal footer
		$(".editCategoriesFooter").addClass('div-hide');		

		$.ajax({
			url: 'php_action/fetchSelectedDayOff.php',
			type: 'post',
			data: {categoriesId: categoriesId},
			dataType: 'json',
			success:function(response) {

				// modal spinner
				$('.modal-loading').addClass('div-hide');
				// modal result
				$('.edit-categories-result').removeClass('div-hide');
				//modal footer
				$(".editCategoriesFooterD").removeClass('div-hide');	

				// set the categories name
				$("#editdayOffFrom").val(response.fromDate);
				// set the company TIN 
					// set the categories name
				$("#editdayOffTo").val(response.toDate);
				// set the categories name
				$("#editDayOffStatus").val(response.status);
				// set the categories status 
				$(".editCategoriesFooterD").after('<input type="hidden" name="editCategoriesId" id="editCategoriesId" value="'+response.id+'" />');

                //alert("HERE");
				// submit of edit categories form
				$("#editCategoriesFormD").unbind('submit').bind('submit', function() {
					var editdayOffFrom = $("#editdayOffFrom").val();  
					var editdayOffTo = $("#editdayOffTo").val(); 
					var categoriesStatus = $("#editDayOffStatus").val();
                       
					if(editdayOffFrom == "") {
						$("#editdayOffFrom").after('<p class="text-danger">DayOff from field is required</p>');
						$('#editdayOffFrom').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editdayOffFrom").find('.text-danger').remove();
						// success out for form 
						$("#editdayOffFrom").closest('.form-group').addClass('has-success');	  	
					}  
					
					if(editdayOffTo == "") {
						$("#editdayOffTo").after('<p class="text-danger">DayOff to field is required</p>');
						$('#editdayOffTo').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editdayOffTo").find('.text-danger').remove();
						// success out for form 
						$("#editdayOffTo").closest('.form-group').addClass('has-success');	  	
					}  

					if(editDayOffStatus == "") {
						$("#editDayOffStatus").after('<p class="text-danger">DayOff status field is required</p>');
						$('#editDayOffStatus').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editDayOffStatus").find('.text-danger').remove();
						// success out for form 
						$("#editDayOffStatus").closest('.form-group').addClass('has-success');	  	
					}

					if(editdayOffTo && editdayOffFrom && editDayOffStatus) {
						var form = $(this);
						// button loading
						$("#editCategoriesBtnD").button('loading');

						$.ajax({
							url : form.attr('action'),
							type: form.attr('method'),
							data: form.serialize(),
							dataType: 'json',
							success:function(response) {
								// button loading
								$("#editCategoriesBtnD").button('reset'); 
								if(response.success == true) {
									// reload the manage member table 
									manageDayOffTable.ajax.reload(null, false);									  	  			
									
									// remove the error text
									$(".text-danger").remove();
									// remove the form error
									$('.form-group').removeClass('has-error').removeClass('has-success');
			  	  			
			  	  			$('#edit-categories-messagesD').html('<div class="alert alert-success">'+
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
function removeCategories2(categoriesId = null) {
	alert(categoriesId);
	$.ajax({
		url: 'php_action/fetchSelectedDayOff.php',
		type: 'post',
		data: {categoriesId: categoriesId},
		dataType: 'json',
		success:function(response) {			

			// remove categories btn clicked to remove the categories function
			$("#removeCategoriesBtnD").unbind('click').bind('click', function() {
				// remove categories btn
				$("#removeCategoriesBtnD").button('loading');

				$.ajax({
					url: 'php_action/removeDayOff.php',
					type: 'post',
					data: {categoriesId: categoriesId},
					dataType: 'json',
					success:function(response) {
 							// remove categories btn
							$("#removeCategoriesBtnD").button('reset');
						if(response.success == true) {
							// close the modal 
							//$("#removeCategoriesModal2").modal('hide');
							// update the manage categories table
							manageDayOffTable.ajax.reload(null, false);
							// udpate the messages
							$('.remove-messagesD').html('<div class="alert alert-success">'+
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
							//$("#removeCategoriesModal2").modal('hide');

 							// udpate the messages
							$('.remove-messagesD').html('<div class="alert alert-success">'+
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