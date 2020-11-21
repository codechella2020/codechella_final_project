$(document).ready(function(){

	$('.refresh-btn').click(function(){
		location.reload(true);
	});

	$('.submit-btn').click(function(){
		if($('div').hasClass('alert')){
			
			$('div.alert').remove();
		}

		var aPositive = $('.apos').val();
		var aNegative = $('.aneg').val();
		var bPositive = $('.bpos').val();
		var bNegative = $('.bneg').val();
		var oPositive = $('.opos').val();
		var oNegative = $('.oneg').val();
		var abPositive = $('.abpos').val();
		var abNegative = $('.abneg').val();
		
		if(aPositive==0 && aNegative==0 && bPositive==0 && bNegative==0 && oPositive==0 && oNegative==0 && abPositive==0 && abNegative==0){
			Swal.fire({
				icon: 'warning',
				title: 'Nothing to update!',							  
				confirmButtonText: 'OK!',
							  
			});
		}else if(aPositive<0 || aNegative<0 || bPositive<0 || bNegative<0 || oPositive<0 || oNegative<0 || abPositive<0 || abNegative<0){
			Swal.fire({
				icon: 'warning',
				title: 'Number of Samples can\'t be negative!',							  
				confirmButtonText: 'OK!',
							  
			});
		}
		else{
			$('.submit-btn i').addClass('fa-spinner fa-spin');
			$('.submit-btn').attr("disabled", true);
			$('.submit-btn').removeClass("btn-primary");
			$('.submit-btn').addClass("btn-secondary");
			$.ajax({
				url: "php_modules/addBloodInfoBackend.php",
				method: "POST",
				data:{apos:aPositive,aneg:aNegative,bpos:bPositive,bneg:bNegative,opos:oPositive,oneg:oNegative,abpos:abPositive,abneg:abNegative},
				success: function(data){
					$('.submit-btn i').removeClass('fa-spinner fa-spin');
					$('.submit-btn').attr("disabled", false);
					$('.submit-btn').removeClass("btn-secondary");
					$('.submit-btn').addClass("btn-primary");
					if(data.indexOf("successful")!=-1){
						Swal.fire({
							icon: 'success',
							title: 'Added Successfully',
							text: 'Click on Refresh Button to see the changes!',
								  
							confirmButtonText: 'OK!',
								  
						});
					}else{
						Swal.fire({
							icon: 'error',
							title: 'Not Successful',
							text: 'Some error occurred!',
								  
							confirmButtonText: 'OK!',
								  
						});
					}

				}

			});
		}
		
	});


});