
<style>
    .modalclass{
        height: 125px;
        display: flex;
        justify-content: center;
        align-items: center;
    }
</style>
<div class="dashboard-home">
    <div class="applied-status">
    	<ul class="breadcrumb">
          <li><a href="/backoffice/investor/home/investorWalkthrough">Home</a></li> 
           <li><a href="/backoffice/profile/default/agentaccount">My Account Detail</a></li>  
          <li>Change Password</li>
          </ul>
      
             </div>
        </div>
<div class="reservation-form">
	<div class="form-part bussiness-det">   
        <h4 class="form-heading">Change Password</h4>
		<div class="row p-4"><?php if(Yii::app()->user->hasFlash('error')):?>
							
							<div class="alert alert-primary alert-dismissible fade show" id="success-register-alert" role="alert"">
								<?php echo Yii::app()->user->getFlash('error'); ?>
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
						<?php endif; ?>
			<div class="col-md-6">
				
				<form id="changpass" method="post">
					<div class="form-group mb-3">
						  <label>Old Password</label>
						  <input type="password" name="old_pass" id="old_pass" class="form-control" placeholder="Old password" autocomplete="off">
						 <span id="old_error_message" style="color:red"></span>
					</div>
					
					<div class="form-group mb-3">
						  <label>New Password</label>
						  <input type="password" name="new_pass" id="new_pass" class="form-control" placeholder="New Password" autocomplete="off" onblur="checkPassword()">
							<span id="new_error_message" style="color:red"></span>
					</div>
					
					<div class="form-group mb-3">
							<label>Confirm Password</label>
							<input type="password" name="conf_pass" id="conf_pass" class="form-control" placeholder="Confirm Password" autocomplete="off">
							<span id="conf_error_message" style="color:red"></span>
					</div>
					<div class="d-flex justify-content-start">
						<!--<input type="button" class="btn btn-secondary">Change Password</button>-->
						<input type="button" class="btn btn-secondary" value="Change Password" onclick="changepas()">
						
					</div>
					
				</form>
			</div>
		</div>
    </div>
</div>


  <!-- Hero Banner -->
  <section class="sdbi-banner">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-12 ">
          <!-- Modal -->
          <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-body modalclass text-center">
                  <span id="modal_msg"></span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Hero Banner -->


  <!-- footer end  -->


<script>
	
	function changepas(){
		
		var oldPass = $("#old_pass").val();
		var newPass = $("#new_pass").val();
		var confPass = $("#conf_pass").val();
		
		if(oldPass==''){
			$("#old_error_message").text('Please enter old password');
			return false;
		}else if(newPass==''){
			$("#new_error_message").text('Please enter new password');
			$("#old_error_message").text('');
			return false;
		}
		// else if(!re.test($("#newPass").val())){
			// $("#new_error_message").text( "Password1 must contain 1 Capital Letter, 1 Lower Letter, 1 Number and 1 Special Character.");
			// return false;
		// }
		// else if(!relower.test($("#newPass").val())){
			// $("#new_error_message").text( "Password2 must contain 1 Capital Letter, 1 Lower Letter, 1 Number and 1 Special Character.");
			// return false;
		// }
		// else if(!reupper.test($("#newPass").val())){
			// $("#new_error_message").text( "Password3 must contain 1 Capital Letter, 1 Lower Letter, 1 Number and 1 Special Character.");
			// return false;
		// }
		// else if(!respecial.test($("#newPass").val())){
			// $("#new_error_message").text( "Password4 must contain 1 Capital Letter, 1 Lower Letter, 1 Number and 1 Special Character.");
			// return false;
		// }
		else if(confPass==''){
			console.log('dqwe');
			$("#old_error_message").text('');
			$("#new_error_message").text('');
			
			$("#conf_error_message").text('Please enter confirm password.');
			return false;
		}
		else if($("#new_pass").val()!=$("#conf_pass").val()){
			$("#conf_error_message").text( "Confirm password not match with password.");
			return false;
		}
		
		else{
			$("#conf_error_message").text( "");
		}
		
		var postStr = $('#changpass').serialize();
		var posturl1 = window.location.href.split("agentchangepassword");
		
		var posturl = posturl1[0] + "agentupdatePassword";
		   //alert(posturl);
		   $.ajax({  
                type: 'POST',  
                url: posturl, 
                data: { old_password: oldPass,new_password: newPass,confirm_password: confPass},
                //dataType: 'json',
                success: function(response) {
					if(response=='success'){
						$("#modal_msg").html("Password Updated Successfully.");
						$('#exampleModalCenter').modal('show');
					}
					else if(response=='error'){
						$("#modal_msg").html("Incorrect Old Password.");
						$('#exampleModalCenter').modal('show');
					}
					
                }
            });
	}
	
	function checkPassword(){
		var password = $("#new_pass").val();
		var pattern = /^.*(?=.{8,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%&]).*$/;
		if(pattern.test(password)){
			$("#new_error_message").text('');
			return true;
		}else{
			$("#new_error_message").text('Password must contain 1 Capital Letter, 1 Lower Letter, 1 Number and 1 Special Character.');
			return false;
		}
	}
			
		
	
	
</script>