         <link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/font-awesome.min.css" rel="stylesheet">
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery-1.10.2.min.js"></script>
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/login.css" type="text/css" />
        <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/login-form.css" type="text/css" />
        <!-- custom css end -->
        
<style type="text/css">
    .body-s {
        max-width: 50%;
    }
    .label{
        color:#000;
        font-size: 1.1em;
    }
    .trans_buton {
    background-color: Transparent;
    background-repeat:no-repeat;
    border: none;
    cursor:pointer;
    overflow: hidden;
    outline:none;
}
form
{
background-color:#58ACFA;
}
</style>
 <?php 
$callback_success_url="/backoffice/frontuser/home/investorWalkthrough"; 
$callback_failure_url="/backoffice/frontuser/home/investorWalkthrough"; 
$CALL_BACK_URL="/backoffice/frontuser/home/investorWalkthrough"; 
?>       
        <div class="body body-s">
            <form id="login-form" action="<?php echo  Yii::app()->createUrl('/account/validate'); ?>" method="post" role="form" class="sky-form">
                <input type="hidden" name="CALL_BACK_URL" value="<?php echo $CALL_BACK_URL ;?>" />
                <input type="hidden" name="callback_failure_url" value="<?php echo $callback_failure_url; ?>" />
                <input type="hidden" name="callback_success_url" value="<?php echo $callback_success_url ?>" />
				
				<!-- @Created: 10 April 2018
					  @Author: Pankaj
				     @Description: dept_id Hidden Field Added For Redirect To Ticket After Login -->
				 
				  <input type="hidden" name="dept_id" value="<?php echo (isset($dept_id) && !empty($dept_id))?$dept_id:''; ?>" />
				  
				  <!-- --------------------------------------------------------- -->
                <header><b>Investor Login </b>
                <div class="row">
                    <p class='error text-center' style='color:red;font-size:0.7em'><?php if(isset($SSO_MESSAGE))  echo $SSO_MESSAGE;?></p>
                </div>
                </header>
                <fieldset>                  
                    <section>
                    <div class="row">
                        <?php
                          foreach(Yii::app()->user->getFlashes() as $key => $message)
                              { echo '<div style="color:red;" class="flash-' . $key . '">' . $message . "</div><br />"; } 
                        ?>
                    </div>
                        <div class="row">
                            <label class="label col col-4">IUID/E-mail</label>
                            <div class="col col-8">
                                <label class="input">
                                    <i class="icon-append icon-user"></i>
                                   <input type="text" required="required" name="username" class="form-control" id="exampleInputEmail1" placeholder="IUID / Email-ID">
                                </label>
                            </div>
                        </div>
                    </section>
                    
                    <section>
                        <div class="row">
                            <label class="label col col-4">Password</label>
                            <div class="col col-8">
                                <label class="input">
                                    <i class="icon-append icon-lock"></i>
                                            <input type="password" required="required" name="passwd" class="form-control" id="exampleInputPassword1" placeholder="Password">
                                </label>
                                <div class="note">
                               
                                    <a style='font-size:1.1em;' href="<?php echo Yii::app()->createUrl('/account/PasswordResetRequest');?>">Forgot password?</a>
                                </div>
                            </div>
                        </div>
                    </section>
                    
                    <section>
                        <div class="row" style="-webkit-box-sizing: none;-moz-box-sizing:none;box-sizing:none;">
                            <div class="col col-4" style="-webkit-box-sizing: none;-moz-box-sizing:none;box-sizing:none;"></div>
                            <div class="col col-8" style="-webkit-box-sizing: none;-moz-box-sizing:none;box-sizing:none;">
                            </div>
                        </div>
                    </section>
                </fieldset>
                <footer>
                   <input type="submit" name="login-submit" id="login-submit" tabindex="4" class="button" value="Log In">
            </form>
            <form id="login-form" action="<?php echo Yii::app()->createUrl('/account/register') ?>" method="post" role="form" class="sky-form">
                    <input type="hidden" name="CALL_BACK_URL" value="<?php echo $CALL_BACK_URL; ?>" />
                <input type="hidden" name="callback_failure_url" value="<?php echo $callback_failure_url; ?>" />
                <input type="hidden" name="callback_success_url" value="<?php echo $callback_success_url; ?>" />
                    <input type="submit" name="login-submit" id="login-submit" tabindex="4" class="button button-secondary" value="Register">
                    </footer>
        </div>
        <script type="text/javascript">
        $('#login-submit').click(function(){
            $('#preloader').show();
        })
        </script>
         
</html>
