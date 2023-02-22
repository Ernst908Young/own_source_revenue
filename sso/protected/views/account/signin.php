<?php $basePath="/panchayatiraj/themes/investuk/assets/login"; ?>
   

        <section class="loginsection">
            <div class="container">
                <div class="row justify-content-end">
                    <div class="col-lg-6">
        	           <p class='error text-center' style='color:red;font-size:14px;'> <?php if(isset($SSO_MESSAGE))  echo $SSO_MESSAGE;?></p>
                          <p> 

                        <?php if(Yii::app()->user->hasFlash('Error')): ?>
                        <p class='error text-center' style='color:red;font-size:14px;'> 
                            <?php  echo Yii::app()->user->getFlash('Error'); ?>       
                            </p>
                        <?php endif; ?> 
                    <?php if(isset($_SESSION['loginerrormsg'])){?>
                        <strong><?= $_SESSION['loginerrormsg'] ?></strong>
                    <?php $_SESSION['loginerrormsg']= NULL; } ?>
					
					
						<div class="alert alert-primary alert-dismissible fade show" id="success-register-alert" role="alert" style="display:none;">
						  Your are successfully registered in Panchayati System. Please check your email for Login details.
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

                        <div class="card my-5">
							
							<div id="logintab" class="p-4">
                                <ul>                                  

                                    <li><a href="#tabs-2">
                                            <img src="<?php echo $basePath; ?>/images/applicantpng.png">
                                            &nbsp;&nbsp;&nbsp;&nbsp;Applicant Login
                                        </a></li>
                                    <li><a href="#tabs-3">
                                            <img src="<?php echo $basePath; ?>/images/departmentpng.png">
                                            Department login
                                        </a></li>
                                        <!--  <li><a href="#tabs-1">
                                            <img src="<1?php echo $basePath; ?>/images/registrationpng.png">
                                            Registration
                                        </a></li> -->
                                    <!-- <li><a href="#tabs-4">
                                            <img src="<1?php echo $basePath; ?>/images/departmentpng.png">
                                            Administrator login
                                        </a></li> -->
                                </ul>
                               <!--  <div id="tabs-1">
                                    <1?php $this->renderPartial('_registration') ?>
                                </div> -->
                                <div id="tabs-2">
								<?php 
								$callback_success_url=Yii::app()->params['applicant_dashboard']; 
								$callback_failure_url=Yii::app()->params['applicant_dashboard']; 
								//$CALL_BACK_URL="/backoffice/frontuser/home/investorWalkthrough"; 
								$CALL_BACK_URL=Yii::app()->params['applicant_dashboard']; 
								?> 

			
                                    <form id="login-form" action="<?php echo  Yii::app()->createUrl('/account/validate'); ?>" method="post" role="form">
                                    	<input type="hidden" name="CALL_BACK_URL" value="<?php echo $CALL_BACK_URL ;?>" />
										<input type="hidden" name="callback_failure_url" value="<?php echo $callback_failure_url; ?>" />
										<input type="hidden" name="callback_success_url" value="<?php echo $callback_success_url ?>" />
										<input type="hidden" name="dept_id" value="<?php echo (isset($dept_id) && !empty($dept_id))?$dept_id:''; ?>" />
										<input type="hidden" name="YII_CSRF_TOKEN" value="<?php echo Yii::app()->request->csrfToken; ?>"/>

                                        <div class="form-group">
                                            <label class="small mb-1">Email</label>
                                            <input class="form-control" id="exampleInputEmail12" type="text"
                                            required="required" name="username"
                                                placeholder="Enter email address" value="<?= ($_GET['email']!='' ? $_GET['email'] : '' )?>">
                                        </div>
                                        <div class="form-group">
                                            <label class="small mb-1">Password</label>
                                            <input class="form-control" id="exampleInputPassword1" type="password" autocomplete="off" 
                                                placeholder="Enter password" required="required" name="passwd">
                                        </div>
                                       <div class="row">
										<!--
                                                <div class="col-lg-4">
                                            <input type="radio" name="uty" value="1" required /><span style="font-size: 15px;"> Individual </span>
                                        </div>
                                             <div class="col-lg-8">
                                            <input type="radio" name="uty" value="2" required / > <span style="font-size: 15px;">Corporate Trust Service Provider (CTSP) <br> &nbsp; &nbsp; or Corporate Representative (CR)</span>
                                        </div>
                                         -->
										
										<div class="col-lg-12">
											<div class="uty_div">                                       
											     <input type="radio" name="uty" value="1" required="" checked><p> Applicant </p>
											</div>
											<div class="uty_div">                                  
										          <input type="radio" name="uty" value="2" required=""> <p>GP Assistance</p>
											</div>
                                            <!-- <div class="uty_div">                               
                                                 <input type="radio" name="uty" value="3" required=""> <p>Sub User</p>
                                            </div> -->
                                            <!--  <div class="uty_div">                              
                                                 <input type="radio" name="uty" value="4" required=""> <p>Other</p>
                                            </div> -->
										</div>
										</div>
										
											  
                                        <div class="row mt-4 mb-0" style="display: flex; justify-content: center;">
                                        	<button type="submit" class="btn btn-secondary mx-2" name="login-submit" id="login-submit">Login</button>
                                            <a href="<?php echo  Yii::app()->createUrl('/account/registration'); ?>" class="btn btn-secondary mx-2">Sign Up</a>
								        </div>
										<div style="margin-top: 5%;">
												<a href="<?php echo  Yii::app()->createUrl('/account/accountactivationlink'); ?>" style="float:left;">Activate Account?</a>
												<a href="<?php echo  Yii::app()->createUrl('/account/passwordresetrequest'); ?>" style="float:right;">Forgot Password?</a>
											</div>
                                    </form>
                                </div>
                                <div id="tabs-3">
                                   <form action="/panchayatiraj/backoffice/site/login" method="post" id="deprt-login">
                                    <input type="hidden" name="YII_CSRF_TOKEN" value="<?php echo Yii::app()->request->csrfToken; ?>"/>
                                        <div class="form-group">
                                            <label class="small mb-1">Email</label>
                                            <input class="form-control" id="dinputEmailAddress" type="text" name="LoginForm[username]" required
                                                placeholder="Enter email address" value="<?php echo ($logincode=='')?'':$logincode ; ?>" autofocus>
                                        </div>
                                        <div class="form-group">
                                            <label class="small mb-1">Password</label>
                                            <input class="form-control" id="dinputPassword" type="password" name="LoginForm[password]" required autocomplete="off" 
                                                placeholder="Enter password">
                                        </div>
                                        <div
                                            class="form-group d-flex align-items-center justify-content-center mt-4 mb-0">
                                             <button type="submit" class="btn btn-secondary" name="dlogin-submit" id="dlogin-submit">Login</button>
                                            
                                        </div>
                                    </form>
                                </div>
                             </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
   