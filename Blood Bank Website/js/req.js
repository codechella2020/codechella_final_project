$(document).ready(function(){
	$('.request').click(function(){
		if($('div').hasClass('alert')){
			
			$('div.alert').remove();
		}

		// $('.request').attr("disabled", true);
		// $('.request').removeClass("btn-primary");
		// $('.request').addClass("btn-secondary");
		var uid = "1";
		var hid = $('#hosid').val();
		var name = $('#Form-name').val();
		var email = $('#Form-email').val();
		var blood = $('#Form-select3').val();
		var amount = $('#Form-num').val();
		if(name==""){
			var out = '<div class="alert alert-danger alert-dismissible fade show"><strong>Error!</strong> Please enter Patients\'s name<button type="button" class="close" data-dismiss="alert">&times;</button></div>';
			$('.errorName').html(out);
			
		}
		else if(email== ""|| !validateEmail(email)){
			var out = '<div class="alert alert-danger alert-dismissible fade show"><strong>Error!</strong> Please enter valid email id<button type="button" class="close" data-dismiss="alert">&times;</button></div>';
			$('.errorEmail').html(out);
			
		}
		else if(blood==""){
			var out = '<div class="alert alert-danger alert-dismissible fade show"><strong>Error!</strong> Please enter valid Blood Type<button type="button" class="close" data-dismiss="alert">&times;</button></div>';
			$('.errorBlood').html(out);
		}
		
		else if(amount<=0){
			var out = '<div class="alert alert-danger alert-dismissible fade show"><strong>Error!</strong> Please enter valid number of samples<button type="button" class="close" data-dismiss="alert">&times;</button></div>';
			$('.errorNumber').html(out);
		}else{
			$('.request').attr("disabled", true);
		$('.request').removeClass("blue-bg");
		$('.request').addClass("btn-secondary");
		$('.request i').addClass('fa-spinner fa-spin');

		$.ajax({
			url: 'php_modules/requestSample.php',
			method: "POST",
			data: {hid:hid,uid:uid,name:name,email:email,blood:blood,amount:amount},
			success: function(data){

				if(data.indexOf("successful")!=-1){
					Swal.fire({
						  icon: 'success',
						  title: 'Requested Successfully',
						  text: 'An email will be sent to your registered email address on acceptance!',
						  
						  confirmButtonText: 'Okay!',
						  
					});
				}
				else if(data.indexOf("reject")!=-1){
					Swal.fire({
						  icon: 'error',
						  title: 'Limit Exceeded',
						  text: 'Number of sample request limit exceeded, please request lesser value',
						  
						  confirmButtonText: 'Okay!',
						  
					});

				}
				else if(data.indexOf("requested")!=-1){
					Swal.fire({
						  icon: 'warning',
						  title: 'Already Requested',
						  text: 'You have already requested in this hospital, and your request is under review',
						  
						  confirmButtonText: 'Okay!',
						  
					});
				}
				else{
					Swal.fire({
						  icon: 'error',
						  title: 'Error',
						  // text: 'Unexpected error occured, try sometimes later!',
						  text: data,
						  
						  confirmButtonText: 'Okay!',
						  
					});
				}
				
				$('.request i').removeClass('fa-spinner fa-spin');
				$('.request').attr("disabled", false);
				$('.request').removeClass("btn-secondary");
				$('.request').addClass("blue-bg");
			}
		});
	}

	});

	function validateEmail($email) {
	  var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
	  
	  return emailReg.test( $email );
	}
});