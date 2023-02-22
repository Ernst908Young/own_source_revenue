<!Doctype html>
<?php   


$basePath="/themes/investuk/assets/login"; 
   $basePath2="/themes/investuk/assets/applicant"; 
//$web_base_url ="http://52.172.209.7/caipo/";

 $web_base_url =WEB_BASE_URL;

if(stristr(WEB_BASE_URL,"52.172.209.7/caipo")){
	$portal_url="";
}
else{
	$portal_url=WEB_BASE_URL;	
}

?> 
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="CAPIO" />
    <meta name="description" content="CAPIO" />
    <meta name="author" content="CAPIO" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>:: CAIPO ::</title>
   <!--  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> -->
    <link rel='stylesheet' id='zakra-googlefonts-css'  href='//fonts.googleapis.com/css?family=Nunito+Sans%3A400%7CNunito+Sans%3A400%7CNunito+Sans%3A400%7CNunito+Sans%3A400&#038;display=swap&#038;ver=5.8' type='text/css' media='all' />
    <link rel="stylesheet" href="<?php echo $basePath; ?>/assests/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo $basePath; ?>/assests/css/style.css">
    <link rel="stylesheet" href="<?php echo $basePath; ?>/assests/css/slick.css">
    <link rel="stylesheet" href="<?php echo $basePath; ?>/assests/css/slick-theme.css">
    <link rel="stylesheet" href="<?php echo $basePath2; ?>/css/query-style.css">
	<script type="text/javascript" src="<?php echo $basePath2; ?>/js/jquery.min.js"></script>
	<style>
    .loginsection {
        background: url(<?php echo $basePath; ?>/images/login-bg.png);
        background-position:top center;
        background-size: cover;
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
        background: #EF7B20;
    }
	.modalclass{
        height: 125px;
        display: flex;
        justify-content: center;
        align-items: center;
    }
	.portlet-title{
		padding-left:8px;
	}
	.status-title h4{
		padding-left:5px;
	}
	#unregsearchform{margin: 15px 8px;}
	.status-title h4{font-size:20px;}
	.custome-btn:hover{
		background-color:#0056b3;
		text-decoration:none;
	}
</style>
</head>



<body>

    
    <header>
    <div class="top_bar">
        <div class="container-fluid">
            <div class="row pt-3">
                <div class="col-md-9 colsm-12 col-xs-12">
                    <a href="#" class="logo">
                        <img src="<?php echo $basePath; ?>/assests/images/footerlogo.png">
                        CORPORATE AFFAIRS AND INTELLECTUAL PROPERTY OFFICE

                    </a>
                    <p class="logosubheading">A division of the Ministry of International Business and Industry, BARBADOS</p>
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


                           /* $curl_handle=curl_init();
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
                             // $menus = NULL;
                         /* foreach ($menus as $key => $value) { 
                                if(isset($value->submenu)){ ?>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" id="dropdown07" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false"><?= $value->title ?>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="dropdown07">
                                            <?php foreach ($value->submenu as $k => $v) { ?>
                                                <a class="dropdown-item" href="<?= $portal_url.$v->url ?>"><?= $v->title ?></a>
                                               
                                            <?php   } ?>
                                        </div>
                                    </li>
                                <?php }else{ ?>
                                        <li class="nav-item">
                                               <?php if($value->id==1829){ ?>
                                            <a class="nav-link"href="<?= $portal_url.$value->url ?>">
                                             <img src="<?php echo $basePath; ?>/assests/images/home_icon.png">
                                         </a>
                                        <?php }else{ ?>
                                             <a class="nav-link"href="<?= $portal_url.$value->url ?>">
                                            <?= $value->title ?>
                                        </a>
                                        <?php } ?>
                                        </li>
                            <?php   } ?>
                        
                      
                        <?php } 
*/
                        ?>
                </ul>
                <form class="form-inline my-1 my-md-0 mr-1">
                    <input class="badge-pill my-1" type="text" placeholder="Search" style="height: 34px; width: 180px;">
                </form>
            </div>
        </nav>
    </div>
</header>

    <main>
	<section class="">
            <div class="container">

	<?php echo $content; ?>
		</div>
	</section>
    </main>
  <footer>
        <div class='d-flex justify-content-start'>
            <div class="position-relative footerbox footerbg1 br-right">
                    <img src="<?php echo $basePath; ?>/assests/images/footerlogo.png" class="footerlogo img-fluid">
                    <h2 style=" margin-top: 60px;">CAIPO</h2>
                   CORPORATE AFFAIRS AND INTELLECTUAL PROPERTY OFFICE
            </div>
             <div class="position-relative footerbox footerbg2 br-right">
                    <img src="<?php echo $basePath; ?>/assests/images/location.png" class="footericon img-fluid">
                    <h2><span>OUR </span>Address</h2>
                    Ground Floor, Baobab Towers, Warrens, St. Michael
            </div>
              <div class="position-relative footerbox footerbg1 br-right">
                    <img src="<?php echo $basePath; ?>/assests/images/phone.png" class="footericon img-fluid">
                    <h2><span>OUR </span>Phone</h2>
                   Phone: +1 (246) 535 2410
            </div>
             <div class="position-relative footerbox footerbg2">
                    <img src="<?php echo $basePath; ?>/assests/images/hour.png" class="footericon img-fluid">
                    <h2><span>OUR </span>Hours</h2>
                    <p>Monday - Friday: 08:30 – 16:30
                   </p>
            </div>
        </div>

        <!-- <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-12 col-xs-12">
                    <img src="<1?php echo $basePath; ?>/assests/images/footerlogo.png" class="footerlogo img-fluid">
                    <div class="py-4">
                        <div class="contact">
                            <img src="<1?php echo $basePath; ?>/assests/images/location_icon.png">
                            <p>Ground Floor, Baobab Towers, Warrens, St. Michael</p>
                        </div>
                        <div class="contact">
                            <img src="<1?php echo $basePath; ?>/assests/images/phone_icon.png">
                            <p> +1 (246) 535-2401</p>
                        </div>
                        <div class="contact">
                            <img src="<1?php echo $basePath; ?>/assests/images/mail_icon.png">
                            <p>caipo.general@barbados.gov.bb </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 col-sm-12 col-xs-12">
                    <div class="pt-80">
                        <h2>Services</h2>
                        <ul class="linklist">
                            <li><a href="#">Service</a></li>
                            <li><a href="#">Service</a></li>
                            <li><a href="#">Service</a></li>
                            <li><a href="#">Service</a></li>
                            <li><a href="#">Service</a></li>
                            <li><a href="#">Service</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-3 col-sm-12 col-xs-12">
                    <div class="pt-80">
                        <h2>Useful Links</h2>
                        <ul class="linklist">
                            <li><a href="#">Forms & Documents</a></li>
                            <li><a href="#">Fee</a></li>
                            <li><a href="#">Archive</a></li>
                            <li><a href="#">Notices</a></li>
                            <li><a href="#">Webinars</a></li>
                            <li><a href="#">EZPay+</a></li>
                            <li><a href="#">FAQ'S</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12 col-xs-12">
                    <div class="pt-80">
                        <h2>Subscribe to our newsletter</h2>
                        <p>Stay upadted with the latest news, articles and resources, sent straight to your inbox.</p>

                        <form class="subscribeform">
                            <input type="text" class="inputfield" placeholder="Your Email">
                            <input type="button" class="inputbtn" value="Subscribe">
                        </form>

                        <ul class="sociallink">
                            <li><a href="#"><img src="<1?php echo $basePath; ?>/assests/images/fb_icon.png"></a></li>
                            <li><a href="#"><img src="<1?php echo $basePath; ?>/assests/images/insta_icon.png"></a></li>
                            <li><a href="#"><img src="<1?php echo $basePath; ?>/assests/images/twitter_icon.png"></a></li>
                            <li><a href="#"><img src="<1?php echo $basePath; ?>/assests/images/youtube_icon.png"></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div> -->
        <iframe style="width: 100%; height: 600px; border: 0;" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15541.019524393396!2d-59.606943622826925!3d13.146316197572835!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8c43f121938f97ad%3A0x6a63a589940ae634!2sBaobab%20Tower%2C%20Highway%202%2C%20Barbados!5e0!3m2!1sen!2sin!4v1623700411252!5m2!1sen!2sin" width="1380" height="600" allowfullscreen=""></iframe>
        
        <div class="copyright">
            <div class="container">
            <div class="row py-2">
                    <div class="col-md-9 col-sm-12">
                        <p >Copyright © 2021 Corporate Affairs and Intellectual Property Office. All Rights Reserved.</p>
                    </div>
                     <div class="col-md-3 col-sm-12">
                       <ul class="list-unstyled social-share m-0 d-flex align-items-center">
                    <li><a href="https://www.facebook.com/gisbarbados/" target="_blank" rel="noopener" title="Share with Facebook"><img src="<?php echo WEB_BASE_URL;?>/wp-content/themes/zakra-child/assets/images/ic_facebook_logo.svg" alt=""></a></li>
                    <li><a href="http://twitter.com/gisbarbados" target="_blank" rel="noopener" title="Share with Twitter"><img src="<?php echo WEB_BASE_URL;?>/wp-content/themes/zakra-child/assets/images/ic_twitter_logo.svg" alt=""></a></li>
                    <li><a href="https://www.youtube.com/user/thebgis" target="_blank" rel="noopener" title="Share with Youtube"><img src="<?php echo WEB_BASE_URL;?>/wp-content/themes/zakra-child/assets/images/ic_youtube_logo.svg" alt=""></a></li>
                    <li><a href="https://www.instagram.com/gisbarbados/" target="_blank" rel="noopener" title="Share with Instagram"><img src="<?php echo WEB_BASE_URL;?>/wp-content/themes/zakra-child/assets/images/ic_instagram_logo.svg" alt=""></a></li>
                    
                </ul>
                </div>
            </div>           
          </div>            
        </div>
    </footer>
	
    <script type="text/javascript" src="<?php echo $basePath2; ?>/js/all.js"></script>
    <script type="text/javascript" src="<?php echo $basePath2; ?>/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo $basePath2; ?>/js/jquery-ui.js"></script>


   <!-- <script src="<?php echo $basePath; ?>/assests/js/jquery-3.2.1.slim.min.js"></script>
    <script src="<?php echo $basePath; ?>/assests/js/popper.min.js"></script>
    <script src="<?php echo $basePath; ?>/assests/js/bootstrap.min.js"></script>

    <script src="<?php echo $basePath; ?>/assests/js/jquery-1.10.2.js"></script>
    <script src="<?php echo $basePath; ?>/assests/js/slick.js"></script>
    <script src="<?php echo $basePath; ?>/assests/js/jquery-ui.js"></script>
    <script src="<?php echo $basePath; ?>/assests/js/custom.js"></script>-->

<?php

   $base=Yii::app()->theme->baseUrl;

?>


    <script>
        $(function () {
            $("#logintab").tabs();
        });
		
		
    </script>
<!-- BEGIN PAGE LEVEL PLUGINS -->

</body>

</html>
<?php ?>