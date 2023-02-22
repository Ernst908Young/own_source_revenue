<!Doctype html>
<?php  $basePath="/panchayatiraj/themes/investuk/assets/login";
$web_base_url =WEB_BASE_URL;
if(stristr(WEB_BASE_URL,"http://52.172.145.30/panchayatiraj")){
	$portal_url="";
}
else{
	$portal_url="";
} ?>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="Panchayatiraj" />
    <meta name="description" content="Panchayatiraj" />
    <meta name="author" content="Panchayatiraj" />

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>:: Panchayatiraj ::</title>
   <!--  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> -->
    <link rel="stylesheet" href="<?php echo $basePath; ?>/assests/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo $basePath; ?>/assests/css/style.css">
    <link rel="stylesheet" href="<?php echo $basePath; ?>/assests/css/responsive.css">
    <link rel="stylesheet" href="<?php echo $basePath; ?>/assests/css/slick.css">
    <link rel="stylesheet" href="<?php echo $basePath; ?>/assests/css/slick-theme.css">
</head>

<style>
    .loginsection {
        /*background: url(<?php echo $basePath; ?>/images/login-bg.png);*/
         background: url('/panchayatiraj/themes/investuk/assets/login/images/judges.jpg');

        background-position:top center;
				background-size: cover;
    		background-repeat: no-repeat;
    }

    #logintab ul {
        list-style: none;
        padding-inline-start: 0;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid rgba(0,0,0,.125);
    padding-bottom: 25px;
    }

    #logintab ul li {
        float: left;
        width: 33%;
    text-align: center;
    }

    #logintab ul li a {
        text-align: center;
        font-size: 11px;
        color: #525252;
        text-decoration: none;
    }

    #logintab ul li a img {
        display: block;
        margin: 0 auto;
        background: #f7f7f7;
        padding: 10px;
        border-radius: 50px;
        width: 50px;
        height: 50px;
    }

    #logintab ul .ui-tabs-active a{
        color:#000000;
        font-size: 13px;
        font-weight: 600;
    }
    #logintab ul .ui-tabs-active a img {
        background: #D16002;
    }
	.modalclass{
        height: 125px;
        display: flex;
        justify-content: center;
        align-items: center;
    }
</style>

<body>



    <header>
    <div class="top_bar">
        <div class="container-fluid">
            <div class="row pt-3">
                <div class="col-md-9 colsm-12 col-xs-12">
                    <a href="<?php echo WEB_BASE_URL;?>" class="logo" >
                        <!-- <img src="<?php echo $basePath; ?>/assests/images/Uttar_Pradesh.svg"> -->
                       Own Source Of Revenue

                    </a>
                    <!-- <p class="logosubheading">Government Of UTTAR PRADESH</p> -->
                </div>
                <div class="col-md-3 colsm-12 col-xs-12 align-item-end">
                    <div class="d-flex float-right">
                        <a href="<?php echo  Yii::app()->createUrl('/account/signin'); ?>" class="btn btn-login mx-1">Login</a>
                        <a href="<?php echo  Yii::app()->createUrl('/account/registration'); ?>" class="btn btn-signup mx-1">Register</a>
                    </div>
                </div>
            </div>
        </div>
        <nav class="navbar navbar-expand-lg bg-dark py-0">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample07"
                aria-controls="navbarsExample07" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarsExample07">
                <ul class="navbar-nav mr-auto">
                    <?php
                            /*$curl_handle=curl_init();
                              curl_setopt($curl_handle,CURLOPT_URL,WEB_CURL_URL.'/wp-json/wp/v2/menu/primary-menu');
                              curl_setopt($curl_handle,CURLOPT_CONNECTTIMEOUT,2);
                              curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER,1);
                              $buffer = curl_exec($curl_handle);
                              curl_close($curl_handle);
                              $web_base_url = WEB_BASE_URL;
                              if (empty($buffer)){
                                 $menus = json_decode("[{'id':1829,'title':'Home<\/span>','url':$web_base_url}]");
                              }
                              else{
                                 $menus = json_decode($buffer);
                              }*/


                                $menus = [
                                       'Home'=>['id'=>'1829'],
                                       'About Us'=>['title'=>'About Us'],
                                       /* 'Cause_list'=>['title'=>'Cause List'],
                                       'Cause_status'=>['title'=>'Cause Status'],
                                       'Judgements'=>['title'=>'Judgements<span>&#9660;</span>'],
                                       'orders'=>['title'=>'Orders<span>&#9660;</span>'],
                                       'court_notice'=>['title'=>'Court Notice'],
                                       'circulars'=>['title'=>'Circulars/Orders'],
                                       'act_rule'=>['title'=>'Act & rules<span>&#9660;</span>'],
                                       'opportunites'=>['title'=>'Opportunites<span>&#9660;</span>'],
                                        'services'=>['title'=>'Services<span>&#9660;</span>'], */
                                        'contact'=>['title'=>'Contact Us']
                                         ];

                          foreach ($menus as $key => $value) {
                                if(isset($value['submenu'])){ ?>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" id="dropdown07" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false"><?= $value->title ?>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="dropdown07">
                                            <?php foreach ($value->submenu as $k => $v) { ?>
                                                <a class="dropdown-item" href="<?= $portal_url.$v->url ?>">
                                                    <?= $v->title ?></a>

                                            <?php   } ?>
                                        </div>
                                    </li>
                                <?php }else{ ?>
                                        <li class="nav-item">
                                               <?php if($value['id']==1829){ ?>
                                            <a class="nav-link"href="<?= $portal_url.$value->url ?>">
                                             <img src="<?php echo $basePath; ?>/assests/images/home_icon.png">
                                         </a>
                                        <?php }else{ ?>
                                             <a class="nav-link"href="<?= $portal_url.$value->url ?>">
                                            <?= $value['title'] ?>
                                        </a>
                                        <?php } ?>
                                        </li>
                            <?php   } ?>


                        <?php } ?>
                </ul>
                <form class="form-inline my-1 my-md-0 mr-1">
                    <input class="badge-pill my-1" type="text" placeholder="Search" style="height: 34px; width: 180px;">
                </form>
            </div>
        </nav>
    </div>
</header>

    <main>
	<?php echo $content; ?>
 </main>

    <footer>
        <div class='d-flex justify-content-start'>
            <div class="position-relative footerbox footerbg1 br-right">
                    <!-- <img src="<?php echo $basePath; ?>/assests/images/Uttar_Pradesh.png" class="footerlogo img-fluid"> -->
                    <h2 style=" margin-top: 30px;">Own Source Of Revenue</h2>
            </div>
             <div class="position-relative footerbox footerbg2 br-right">
                    <img src="<?php echo $basePath; ?>/assests/images/location.png" class="footericon img-fluid">
                    <h2><span>OUR </span>Address</h2>
                    Address
            </div>
             <div class="position-relative footerbox footerbg1 br-right">
                    <img src="<?php echo $basePath; ?>/assests/images/phone.png" class="footericon img-fluid">
                    <h2><span>OUR </span>Phone</h2>
                   Phone: +1 0000000000
            </div>
             <div class="position-relative footerbox footerbg2">
                    <img src="<?php echo $basePath; ?>/assests/images/hour.png" class="footericon img-fluid">
                    <h2><span>OUR </span>Hours</h2>
                    <p>Monday - Friday: 08:30 – 16:30
                   </p>
            </div>
        </div>


       <!--  <iframe style="width: 100%; height: 600px; border: 0;" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15541.019524393396!2d-59.606943622826925!3d13.146316197572835!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8c43f121938f97ad%3A0x6a63a589940ae634!2sBaobab%20Tower%2C%20Highway%202%2C%20Barbados!5e0!3m2!1sen!2sin!4v1623700411252!5m2!1sen!2sin" width="1380" height="600" allowfullscreen=""></iframe> -->

        <div class="copyright">
            <div class="container">
            <div class="row py-2">
                    <div class="col-md-9 col-sm-12">
                        <p >Copyright © 2023. All Rights Reserved.</p>
                    </div>
                     <div class="col-md-3 col-sm-12">
                       <ul class="list-unstyled social-share m-0 d-flex align-items-center">
                    <li><a href="#" target="_blank" rel="noopener" title="Share with Facebook"><img src="<?php echo WEB_BASE_URL;?>/wp-content/themes/zakra-child/assets/images/ic_facebook_logo.svg" alt=""></a></li>
                    <li><a href="#" target="_blank" rel="noopener" title="Share with Twitter"><img src="<?php echo WEB_BASE_URL;?>/wp-content/themes/zakra-child/assets/images/ic_twitter_logo.svg" alt=""></a></li>
                    <li><a href="#" target="_blank" rel="noopener" title="Share with Youtube"><img src="<?php echo WEB_BASE_URL;?>/wp-content/themes/zakra-child/assets/images/ic_youtube_logo.svg" alt=""></a></li>
                    <li><a href="#" target="_blank" rel="noopener" title="Share with Instagram"><img src="<?php echo WEB_BASE_URL;?>/wp-content/themes/zakra-child/assets/images/ic_instagram_logo.svg" alt=""></a></li>

                </ul>
                </div>
            </div>
          </div>
        </div>
    </footer>

     <!-- <footer>
        <div class='d-flex justify-content-start'>
            <div class="position-relative footerbox footerbg1 br-right">
                    <img src="<1?php echo $basePath; ?>/assests/images/footerlogo.png" class="footerlogo img-fluid">
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.Lorem Ipsum has been</p>
            </div>
             <div class="position-relative footerbox footerbg2 br-right">
                 <img src="<1?php echo $basePath; ?>/assests/images/location.png" class="footerlogo img-fluid">

                    <h2><span>OUR </span>Address</h2>
                    <p>908 New Hampshire Avenue <br>Northwest #100 <br>Washington,DC,20037,<br>United States</p>
            </div>
             <div class="position-relative footerbox footerbg1 br-right">
                <img src="<1?php echo $basePath; ?>/assests/images/phone.png" class="footerlogo img-fluid">

                    <h2><span>OUR </span>Phone</h2>
                    <p>Phone: +1 916-875-2235
                    <br>Mobile: +1 916-875-2235</p>
            </div>
             <div class="position-relative footerbox footerbg2">
                <img src="<1?php echo $basePath; ?>/assests/images/hour.png" class="footerlogo img-fluid">

                    <h2><span>OUR </span>Hours</h2>
                    <p>Monday-Friday: 9:00-18:00
                    <br>Saturday: 11:00-17:00</p>
            </div>
        </div>
        <div class="map">
            <iframe style="width: 100%; height: 600px; border: 0;" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15541.019524393396!2d-59.606943622826925!3d13.146316197572835!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8c43f121938f97ad%3A0x6a63a589940ae634!2sBaobab%20Tower%2C%20Highway%202%2C%20Barbados!5e0!3m2!1sen!2sin!4v1623700411252!5m2!1sen!2sin" width="1380" height="600" allowfullscreen=""></iframe>
        </div>

        <div class="copyright d-flex justify-content-center">
            <p>copyright © 2021 Corporate Affairs and Intellectual Property Office.All Right Reserved</p>
        </div>
    </footer>
     -->






    <script src="<?php echo $basePath; ?>/assests/js/jquery-3.2.1.slim.min.js"></script>
    <script src="<?php echo $basePath; ?>/assests/js/popper.min.js"></script>
    <script src="<?php echo $basePath; ?>/assests/js/bootstrap.min.js"></script>
    <script src="<?php echo $basePath; ?>/assests/js/jquery-1.10.2.js"></script>
    <script src="<?php echo $basePath; ?>/assests/js/slick.js"></script>
    <script src="<?php echo $basePath; ?>/assests/js/jquery-ui.js"></script>
    <script src="<?php echo $basePath; ?>/assests/js/custom.js"></script>
	<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <script>
        $(function () {
            $("#logintab").tabs();
        });

		$("#activation_link").click(function () {
			var username = $("#username").val();

			if(username==''){
				$("#username_error").html('Please enter username/email id.');
				return false;
			}
			else{
				$("#username_error").html('');
			}

			var posturl = window.location.href.split("account");
			var posturl = posturl[0] + "account/accountActivationLink";
			var postdata = "username=" + username+"&YII_CSRF_TOKEN=" +$("#csrf_token").val();

			//alert(posturl);
		    $.ajax({
				type: 'POST',
				url: posturl,
				data: postdata,
				//dataType: 'json',
				beforeSend: function() {
					$("#activation_link").prop('disabled',true);
				},
				success: function(response) {
					if(response=='success'){
						$("#username").val("");
						$("#success-register-alert").show();
						$("#danger-register-alert").hide();


						$("#success_alert_msg").html("Account Activation link has been sent on your registered email id. Please check your email");
					}
					/*else if(response=='notfound'){
						$("#danger-register-alert").show();
						$("#danger_alert_msg").text("This email id or IUID does not exist.");
					}*/
					else if(response=='already activated'){
						$("#danger-register-alert").show();
						$("#danger_alert_msg").html("This email id or IUID is already activated.");
					}
					else if(response=='error'){
						$("#danger-register-alert").show();
						$("#danger_alert_msg").html("Sorry!! Request can't be complete right now. Please try again later.");
					}

				}
			});
		});

		$("#forgot_password").click(function () {
			var username = $("#username").val();

			if(username==''){
				$("#username_error").html('Please enter username/email id.');
				return false;
			}
			else{
				$("#username_error").html('');
			}

			var posturl = window.location.href.split("account");
			var posturl = posturl[0] + "account/passwordresetrequest";
			var postdata = "username=" + username+"&YII_CSRF_TOKEN=" +$("#csrf_token").val();

			//alert(posturl);
		    $.ajax({
				type: 'POST',
				url: posturl,
				data: postdata,
				//dataType: 'json',
				beforeSend: function() {
					$("#msg").html('Please wait...');
				},

				success: function(response) {
					$("#msg").html("");
					if(response=='success'){
						$("#danger-register-alert").hide();
						$("#success-register-alert").show();
						$("#success_alert_msg").html("Password Reset link has been sent on your registered email id. Please check your email.");
					}
					/*else if(response=='notfound'){
						$("#success-register-alert").hide();
						$("#danger-register-alert").show();
						$("#danger_alert_msg").text("This email id or IUID does not exist.");
					}*/
					else if(response=='inactiveaccount'){
						$("#success-register-alert").hide();
						$("#danger-register-alert").show();
						$("#danger_alert_msg").html("Your account is inactive.");
					}
					else if(response=='error'){
						$("#success-register-alert").hide();
						$("#danger-register-alert").show();
						$("#danger_alert_msg").html("Sorry!! Request can't be complete right now. Please try again later.");
					}

				}
			});
		});

		// update password function
		$("#up-submit").click(function(){
		//alert('ok');
		var password1 = $("#password1").val();
		var password2 = $("#password2").val();
		var pattern = /^.*(?=.{8,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%&]).*$/;

		if(password1==''){
			$("#password1_error").text('Please enter new password');
			return false;
		}
		if(!pattern.test(password1)){
			$("#password1_error").text('Password must contain 1 Capital Letter, 1 Lower Letter, 1 Number and 1 Special Character.');
			return false;
		}
		else if(password2==''){
			$("#password1_error").text('');
			$("#password2_error").text('Please enter confirm password.');
			return false;
		}
		else if($("#password1").val()!=$("#password2").val()){
			$("#password2_error").text( "Confirm password not match with new password.");
			return false;
		}

		else{
			$("#password2_error").text( "");
			//window.location.href.split("/account/changePassworddd");
			return true;

		}
	});
    </script>

</body>

</html>
