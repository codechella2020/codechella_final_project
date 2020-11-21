$(document).ready(function(){
	$('.main-container').on('click','button.decline',function(event){
	    event.stopImmediatePropagation();
		var rid = $(this).find('.requestId').val();
		var email = $(this).find('.emailId').val();

		$.ajax({
			url: 'php_modules/declineRequest.php',
			method: "POST",
			data:{rid:rid,email:email},
			success: function(data){
				if(data.indexOf("success")!=-1){
					Swal.fire({
						  icon: 'success',
						  title: 'Declined Successfully',
						  
						  confirmButtonText: '<span class="ok">Okay!</span>',
						  
					}).then((result)=>{
						location.reload(true);
					});
					
				}else{
					Swal.fire({
						  icon: 'error',
						  title: 'An error occurred',
						  
						  confirmButtonText: 'Please Try Again',
						  
					});
				}
			}
		});
	});

	$('.main-container').on('click','button.accept',function(event){
		event.stopImmediatePropagation();
		// $('.accept').click(function(){
		var rid = $(this).find('.requestId').val();
		var email = $(this).find('.emailId').val();
		var blood = $(this).find('.blood').val();
		var amount = $(this).find('.amount').val();
		// console.log(rid+" "+email+" "+blood+" "+amount);

		$.ajax({
			url: 'php_modules/acceptRequest.php',
			method: "POST",
			data:{rid:rid,email:email,blood:blood,amount:amount},
			success: function(data){
				
				if(data.indexOf("success")!=-1){
					Swal.fire({
						  icon: 'success',
						  title: 'Accepted Successfully',
						  text: 'Email sent to the receiver!',
						  
						  confirmButtonText: 'Okay!',
						  
					}).then((result)=>{
						location.reload(true);
					});
					// location.reload(true);
				}else{
					Swal.fire({
						  icon: 'error',
						  title: 'An error occurred',
						  
						  confirmButtonText: 'Please Try Again',
						  
					});
				}
			}
		});
	});
	
});