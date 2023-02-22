<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Login / Register - SSO :: SWCS DEMO</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
       <link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/font-awesome.min.css" rel="stylesheet">
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery-1.10.2.min.js"></script>
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/login.css" type="text/css" />
        <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/login-form.css" type="text/css" />

    </head>
    <body class="bg-cyan">
        <div class="body body-s">
            <form id="login-form" action="<?= $this->createUrl('/signup') ?>" method="post" role="form" class="sky-form">
                <input type="hidden" name="CALL_BACK_URL" value="<?= $CALL_BACK_URL ?>" />
                <input type="hidden" name="callback_failure_url" value="<?= $callback_failure_url ?>" />
                <input type="hidden" name="callback_success_url" value="<?= $callback_success_url ?>" />
                <header>Login form</header>
                <fieldset>                  
                    <section>
                        <div class="row">
                            <label class="label col col-4">IUUID/E-mail</label>
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
                                <div class="note"><a href="#">Forgot password?</a></div>
                            </div>
                        </div>
                    </section>
                    
                    <section>
                        <div class="row">
                            <div class="col col-4"></div>
                            <div class="col col-8">
                                <label class="checkbox"><input type="checkbox" name="checkbox-inline" checked><i></i>Keep me logged in</label>
                            </div>
                        </div>
                    </section>
                </fieldset>
                <footer>
                   <input type="submit" name="login-submit" id="login-submit" tabindex="4" class="button" value="Log In">
                    <a href="#" class="button button-secondary">Register</a>
                </footer>

        </div>
    </body>
</html>
