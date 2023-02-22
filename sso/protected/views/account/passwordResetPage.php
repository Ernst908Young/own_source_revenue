
        <section class="loginsection">
            <div class="container">
                <div  class="row justify-content-end">
                    <div class="col-lg-6">
						
                        <div class="card my-5 p-4">
							<?php if(Yii::app()->user->hasFlash('errors')):?>
								
								<div class="alert alert-danger alert-dismissible fade show" id="success-register-alert" role="alert" style="padding: 8%;">
									<?php echo Yii::app()->user->getFlash('errors'); ?>
									
								</div>
							<?php else: ?>
							<div class="alert alert-success alert-dismissible fade show" id="success-register-alert" role="alert" style="display:none;">
								<span id="success_alert_msg"></span>
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="alert alert-danger alert-dismissible fade show" id="success-register-alert" role="alert" style="display:none;">
								<span id="danger_alert_msg"></span>
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							
							<?php if(Yii::app()->user->hasFlash('success')):?>
							
								<div class="alert alert-primary alert-dismissible fade show" id="success-register-alert" role="alert"">
									<?php echo Yii::app()->user->getFlash('success'); ?>
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
							<?php endif; ?>
							<?php if(Yii::app()->user->hasFlash('error')):?>
								
								<div class="alert alert-primary alert-dismissible fade show" id="success-register-alert" role="alert"">
									<?php echo Yii::app()->user->getFlash('error'); ?>
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
							<?php endif; ?>
							
							
							<div style="font-weight: bold;font-size: 20px;">Create New Password</div>
							<span>Create your password by choosing a strong password to keep your account secure.</span><br>
                            <form id="reset-login-form" action="<?php echo Yii::app()->createUrl('/account/changePassword'); ?>" method="post">
                                <input type="hidden" name="reset_code" value="<?php echo $data['reset_code']; ?>" />
                                 <input type="hidden" id="csrf_token" name="YII_CSRF_TOKEN" value="<?php echo Yii::app()->request->csrfToken; ?>"/>
								<input type="hidden" name="uiuid" value="<?php echo $data['uiuid']; ?>" />
								<input type="hidden" name="rt" value="<?php echo $data['rt']; ?>" />
								<input type="hidden" name="email" value="<?php echo $data['email']; ?>" />
								<div class="row">
									<?php
									foreach (Yii::app()->user->getFlashes() as $key => $message) {
										echo '<div style="color:red;" class="flash-' . $key . '">' . $message . "</div><br />";
									}
									?>
								</div>
								<div class="form-group">
                                    <label class="small mb-1" for="">New Password<span style="color:red;font-size:13px"> *</span></label>
                                    <input class="form-control" type="password" aria-describedby="" placeholder="New Password" required="required" name="password1" id="password1" autocomplete="off">
									<span style="color:red" id="password1_error"></span>
								</div>
								<div class="form-group">
                                    <label class="small mb-1" for="">Confirm Password<span style="color:red;font-size:13px"> *</span></label>
                                    <input class="form-control" type="password" aria-describedby="" placeholder="Confirm Password" required="required" name="password2" id="password2" autocomplete="off">
									<span style="color:red" id="password2_error"></span>
								</div>
                                <div class="form-group text-center">
                                    <input type="submit" name="up-submit" id="up-submit" tabindex="4" class="btn btn-secondary" value="Update Password">
										<a style="width:auto;display: block;" class='mt-3' href="<?php echo  Yii::app()->createUrl('/account/signin'); ?>">Click to Login</a>
                                </div>
                                </form>
								<?php endif;?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
   

