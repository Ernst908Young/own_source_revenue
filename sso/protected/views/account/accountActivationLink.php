
        <section class="loginsection">
            <div class="container">
                <div class="row justify-content-end">
                    <div class="col-lg-6">
						
                        <div class="card my-5 p-4">
							<div class="alert alert-success alert-dismissible fade show" id="success-register-alert" role="alert" style="display:none;">
								<span id="success_alert_msg"></span>
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
						<div class="alert alert-danger alert-dismissible fade show" id="danger-register-alert" role="alert" style="display:none;">
							<span id="danger_alert_msg"></span>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div style="font-weight: bold;font-size: 20px;">Resend Account Activation Link</div>
						<span>Account activation link will be send on your registered email id.</span><br>
                            <form id="forgot-form" action="<?php echo  Yii::app()->createUrl('/account/AccountActivationLink'); ?>" method="post">
                                 <input type="hidden" id="csrf_token" name="YII_CSRF_TOKEN" value="<?php echo Yii::app()->request->csrfToken; ?>"/>
                                <div class="form-group">
                                    <label class="small mb-1" for="inputEmailAddress">Email<span style="color:red;font-size:13px"> *</span></label>
                                    <input class="form-control" type="email" aria-describedby="" placeholder="IUID/E-mail" required="required" name="username" id="username" autocomplete="off">
									<span style="color:red" id="username_error"></span>
								</div>
                                <div class="form-group text-center">
                                    <a id="activation_link" class="btn btn-secondary" href="javascript:void(0);">Send Link</a>
										<a style="width:auto;display: block;" class='mt-3' href="<?php echo  Yii::app()->createUrl('/account/signin'); ?>">Back to Login</a>
                                </div>
                                </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
   
	
  
