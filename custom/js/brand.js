var manageBrandTable;

$(document).ready(function() {
	// top bar active
	$('#navBrand').addClass('active');
	
	// manage brand table
	manageBrandTable = $("#manageBrandTable").DataTable({
		'ajax': 'php_action/fetchBrand.php',
		'order': []		
	});

	// submit brand form function
	$("#submitBrandForm").unbind('submit').bind('submit', function() {
		// remove the error text
		$(".text-danger").remove();
		// remove the form error
		$('.form-group').removeClass('has-error').removeClass('has-success');			

		var brandName = $("#brandName").val(); 
		var wucFname = $("#wucFname").val();
		var wucLname = $("#wucLname").val();
		var wucEmail = $("#wucEmail").val();
		var wucPhone = $("#wucPhone").val();
		var waterpoint = $("#waterpoint").val();
		var brandStatus = $("#brandStatus").val();

		if(brandName == "") {
			$("#brandName").after('<p class="text-danger">NID field is required</p>');
			$('#brandName').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#brandName").find('.text-danger').remove();
			// success out for form 
			$("#brandName").closest('.form-group').addClass('has-success');	  	
		}
		
		if(wucFname == "") {
			$("#wucFname").after('<p class="text-danger">Fname field is required</p>');
			$('#wucFname').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#wucFname").find('.text-danger').remove();
			// success out for form 
			$("#wucFname").closest('.form-group').addClass('has-success');	  	
		}
		
		if(wucLname == "") {
			$("#wucLname").after('<p class="text-danger">Lname field is required</p>');
			$('#wucLname').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#wucLname").find('.text-danger').remove();
			// success out for form 
			$("#wucLname").closest('.form-group').addClass('has-success');	  	
		}
		
		if(wucEmail == "") {
			$("#wucEmail").after('<p class="text-danger">Email field is required</p>');
			$('#wucEmail').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#wucEmail").find('.text-danger').remove();
			// success out for form 
			$("#wucEmail").closest('.form-group').addClass('has-success');	  	
		}
		
		if(wucPhone == "") {
			$("#wucPhone").after('<p class="text-danger">Phone field is required</p>');
			$('#wucPhone').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#wucPhone").find('.text-danger').remove();
			// success out for form 
			$("#wucPhone").closest('.form-group').addClass('has-success');	  	
		}
		
		if(waterpoint == "") {
			$("#waterpoint").after('<p class="text-danger">WP field is required</p>');
			$('#waterpoint').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#waterpoint").find('.text-danger').remove();
			// success out for form 
			$("#waterpoint").closest('.form-group').addClass('has-success');	  	
		}

		if(brandStatus == "") {
			$("#brandStatus").after('<p class="text-danger">Brand Name field is required</p>');

			$('#brandStatus').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#brandStatus").find('.text-danger').remove();
			// success out for form 
			$("#brandStatus").closest('.form-group').addClass('has-success');	  	
		}

		if(brandName && wucFname && wucLname && wucPhone && waterpoint && brandStatus) {
			var form = $(this);
			// button loading
			$("#createBrandBtn").button('loading');

			$.ajax({
				url : form.attr('action'),
				type: form.attr('method'),
				data: form.serialize(),
				dataType: 'json',
				success:function(response) {
					// button loading
					$("#createBrandBtn").button('reset');

					if(response.success == true) {
						// reload the manage member table 
						manageBrandTable.ajax.reload(null, false);						

  	  			// reset the form text
						$("#submitBrandForm")[0].reset();
						// remove the error text
						$(".text-danger").remove();
						// remove the form error
						$('.form-group').removeClass('has-error').removeClass('has-success');
  	  			
  	  			$('#add-brand-messages').html('<div class="alert alert-success">'+
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
	}); // /submit brand form function

});

function editBrands(brandId = null) {
	if(brandId) { 
		// remove hidden brand id text
		$('#brandId').remove();

		// remove the error 
		$('.text-danger').remove();
		// remove the form-error
		$('.form-group').removeClass('has-error').removeClass('has-success');

		// modal loading
		$('.modal-loading').removeClass('div-hide');
		// modal result
		$('.edit-brand-result').addClass('div-hide');
		// modal footer
		$('.editBrandFooter').addClass('div-hide');

		$.ajax({
			url: 'php_action/fetchSelectedBrand.php',
			type: 'post',
			data: {brandId : brandId},
			dataType: 'json',
			success:function(response) {
				// modal loading
				$('.modal-loading').addClass('div-hide');
				// modal result
				$('.edit-brand-result').removeClass('div-hide');
				// modal footer
				$('.editBrandFooter').removeClass('div-hide');

				// setting the brand name value 
				$('#editBrandName').val(response.brand_name);
				// setting the brand name value 
				$('#editWucFname').val(response.wuc_fname);
				// setting the brand name value 
				$('#editWucLname').val(response.wuc_lname);
				// setting the brand name value 
				$('#editWUCEmail').val(response.wuc_email);
				// setting the brand name value 
				$('#editWUCPhone').val(response.wuc_phone);
				// setting the brand name value 
				//$('#editWUCPhone').val(response.brand_name);
				// setting the brand status value
				$('#editBrandStatus').val(response.brand_active);
				// brand id 
				$(".editBrandFooter").after('<input type="hidden" name="brandId" id="brandId" value="'+response.brand_id+'" />');

				// update brand form 
				$('#editBrandForm').unbind('submit').bind('submit', function() {

					// remove the error text
					$(".text-danger").remove();
					// remove the form error
					$('.form-group').removeClass('has-error').removeClass('has-success');			

					var brandName = $('#editBrandName').val();
					var wucFname = $('#editWucFname').val();
					var wucLname = $('#editWucLname').val();
					var WUCEmail = $('#editWUCEmail').val();
					var WUCPhone = $('#editWUCPhone').val();
					// var WP = $('#editWP').val();
					var brandStatus = $('#editBrandStatus').val();

					if(brandName == "") {
						$("#editBrandName").after('<p class="text-danger">NID field is required</p>');
						$('#editBrandName').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editBrandName").find('.text-danger').remove();
						// success out for form 
						$("#editBrandName").closest('.form-group').addClass('has-success');	  	
					}
                    if(wucFname == "") {
						$("#editWucFname").after('<p class="text-danger">First name field is required</p>');
						$('#editWucFname').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editWucFname").find('.text-danger').remove();
						// success out for form 
						$("#editWucFname").closest('.form-group').addClass('has-success');	  	
					}
					if(wucLname == "") {
						$("#editWucLname").after('<p class="text-danger">Last name field is required</p>');
						$('#editWucLname').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editWucLname").find('.text-danger').remove();
						// success out for form 
						$("#editWucLname").closest('.form-group').addClass('has-success');	  	
					}
					if(WUCEmail == "") {
						$("#editWUCEmail").after('<p class="text-danger">Email field is required</p>');
						$('#editWUCEmail').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editWUCEmail").find('.text-danger').remove();
						// success out for form 
						$("#editWUCEmail").closest('.form-group').addClass('has-success');	  	
					}
					if(WUCPhone == "") {
						$("#editWUCPhone").after('<p class="text-danger">Phone field is required</p>');
						$('#editWUCPhone').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editWUCPhone").find('.text-danger').remove();
						// success out for form 
						$("#editWUCPhone").closest('.form-group').addClass('has-success');	  	
					}
					// if(WP == "") {
						// $("#editWP").after('<p class="text-danger">Water Point field is required</p>');
						// $('#editWP').closest('.form-group').addClass('has-error');
					// } else {
						//remov error text field
						// $("#editWP").find('.text-danger').remove();
						//success out for form 
						// $("#editWP").closest('.form-group').addClass('has-success');	  	
					// }
					if(brandStatus == "") {
						$("#editBrandStatus").after('<p class="text-danger">WUC status field is required</p>');

						$('#editBrandStatus').closest('.form-group').addClass('has-error');
					} else {
						// remove error text field
						$("#editBrandStatus").find('.text-danger').remove();
						// success out for form 
						$("#editBrandStatus").closest('.form-group').addClass('has-success');	  	
					}

					if(brandName && wucLname && wucFname && WUCPhone && brandStatus) {
						var form = $(this);

						// submit btn
						$('#editBrandBtn').button('loading');

						$.ajax({
							url: form.attr('action'),
							type: form.attr('method'),
							data: form.serialize(),
							dataType: 'json',
							success:function(response) {

								if(response.success == true) {
									console.log(response);
									// submit btn
									$('#editBrandBtn').button('reset');

									// reload the manage member table 
									manageBrandTable.ajax.reload(null, false);								  	  										
									// remove the error text
									$(".text-danger").remove();
									// remove the form error
									$('.form-group').removeClass('has-error').removeClass('has-success');
			  	  			
			  	  			$('#edit-brand-messages').html('<div class="alert alert-success">'+
			            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
			            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
			          '</div>');

			  	  			$(".alert-success").delay(500).show(10, function() {
										$(this).delay(3000).hide(10, function() {
											$(this).remove();
										});
									}); // /.alert
								} // /if
									
							}// /success
						});	 // /ajax												
					} // /if

					return false;
				}); // /update brand form

			} // /success
		}); // ajax function

	} else {
		alert('error!! Refresh the page again');
	}
} // /edit brands function

function removeBrands(brandId = null) {
	if(brandId) {
		$('#removeBrandId').remove();
		$.ajax({
			url: 'php_action/fetchSelectedBrand.php',
			type: 'post',
			data: {brandId : brandId},
			dataType: 'json',
			success:function(response) {
				$('.removeBrandFooter').after('<input type="hidden" name="removeBrandId" id="removeBrandId" value="'+response.brand_id+'" /> ');

				// click on remove button to remove the brand
				$("#removeBrandBtn").unbind('click').bind('click', function() {
					// button loading
					$("#removeBrandBtn").button('loading');

					$.ajax({
						url: 'php_action/removeBrand.php',
						type: 'post',
						data: {brandId : brandId},
						dataType: 'json',
						success:function(response) {
							console.log(response);
							// button loading
							$("#removeBrandBtn").button('reset');
							if(response.success == true) {

								// hide the remove modal 
								$('#removeMemberModal').modal('hide');

								// reload the brand table 
								manageBrandTable.ajax.reload(null, false);
								
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

							} // /else
						} // /response messages
					}); // /ajax function to remove the brand

				}); // /click on remove button to remove the brand

			} // /success
		}); // /ajax

		$('.removeBrandFooter').after();
	} else {
		alert('error!! Refresh the page again');
	}
} // /remove brands function