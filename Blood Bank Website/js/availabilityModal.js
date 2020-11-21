$(document).ready(function(){
	var hid = "";
	$('div').on('click','button.myself',function(){

		hid = $(this).children().val();
		
	});
	$('div').on('click','button.other',function(){
		hid = $(this).children().val();
		
	});
	$('.reqMyself').click(function(){
		var uid = $('#receiverId').val();
		var name = $('#receiverName').val();
		var email = $('#receiverEmail').val();
		var blood = $('#bloodType').val();
		var amount = $('#amount1').val();
		// console.log(hid+" "+uid+" "+name+" "+" "+email+" "+blood);
		if(amount<=0){
			var out = '<div class="alert alert-danger alert-dismissible fade show"><strong>Error!</strong> Please enter valid number of samples<button type="button" class="close" data-dismiss="alert">&times;</button></div>';
			$('.errorNumSum').html(out);
		}else{
			$('.reqMyself').attr("disabled", true);
		$('.reqMyself').removeClass("blue-bg");
		$('.reqMyself').addClass("btn-secondary");
		$('.reqMyself i').addClass('fa-spinner fa-spin');

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
						  text: 'Unexpected error occured, try sometimes later!',
						  
						  confirmButtonText: 'Okay!',
						  
					});
				}
				
				$('.reqMyself i').removeClass('fa-spinner fa-spin');
				$('.reqMyself').attr("disabled", false);
				$('.reqMyself').removeClass("btn-secondary");
				$('.reqMyself').addClass("blue-bg");
			}
		});

		}
		
	});


	$('.reqOther').click(function(){
		var uid = $('#receiverId').val();
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
		else if(amount <= 0){
			var out = '<div class="alert alert-danger alert-dismissible fade show"><strong>Error!</strong> Please enter number of samples<button type="button" class="close" data-dismiss="alert">&times;</button></div>';
			$('.errorNumber').html(out);
		}
		else{
			$('.reqOther').attr("disabled", true);
			$('.reqOther').removeClass("blue-bg");
			$('.reqOther').addClass("btn-secondary");
			$('.reqOther i').addClass('fa-spinner fa-spin');
	// console.log(hid+" "+uid+" "+name+" "+" "+email+" "+blood);
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
							  text: 'Unexpected error occured, try sometimes later!',
							  
							  confirmButtonText: 'Okay!',
							  
						});
					}
					
					$('.reqOther i').removeClass('fa-spinner fa-spin');
					$('.reqOther').attr("disabled", false);
					$('.reqOther').removeClass("btn-secondary");
					$('.reqOther').addClass("blue-bg");
					
				}
			});
		}
	});


	$('.search-hos').keyup(function(){
		var text = $(this).val();
		if(text.length===0){
			$('#hospitalId').val("");
		}
		if(text.length>1){
			$.ajax({
				url: 'php_modules/searchHospital.php',
				method: 'POST',
				data: {text:text},
				success: function(data){
					$("#searchList").fadeIn();
					$('#searchList').html(data);
					$("#searchList").css("overflow-y","scroll");
				}
			});
		}
		else{
			$("#searchList").fadeOut();
			$("#searchList").html("");
		}
	});

	$('.search-li').on('click','li',function(){
	
		var value = $(this).text();
		var searchAreaText = value.split("hid")[0];
		searchAreaText = searchAreaText.split("City")[0];
		$('.search-hos').val(searchAreaText);
		var hospitalId = value.split("hid")[1];
		$('#hospitalId').val(hospitalId);
		$("#searchList").fadeOut();
		$("#searchList").html("");

	});

	function validateEmail($email) {
	  var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
	  
	  return emailReg.test( $email );
	}
});