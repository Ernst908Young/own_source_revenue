
    	

        <section class="loginsection">
            <div class="container">
                <div class="row justify-content-end">
                    <div class="col-lg-8">
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
					
					
						<!--div class="alert alert-primary alert-dismissible fade show" id="success-register-alert" role="alert" style="display:none;">
						  Your are successfully registered in CAIPO Portal. Please check your email for Login details.
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						  </button>
						</div-->
						
						<?php if(Yii::app()->user->hasFlash('success')):?>
							
							<div class="alert alert-primary alert-dismissible fade show" id="success-register-alert" role="alert">
								<?php echo Yii::app()->user->getFlash('success'); ?>
								
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
                                <?php $this->renderPartial('_registration') ?>             
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
   