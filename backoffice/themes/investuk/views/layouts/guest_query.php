<!Doctype html>
<?php  $basePath="/themes/investuk/assets/login"; ?> 
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
</head>

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
</style>

<body>

    <header>
        <div class="top_bar">
            <div class="container">
                <div class="row py-2">
                    <div class="col-md-9 col-sm-12">
                        <div class="marquee">
                            <marquee dir="ltr">
                                <ul class="marquee-content-items">
                                    <li>Removal of Companies from the Register, pursuant to the Compani</li>
                                    <li>Removal of Companies from the Register, pursuant to the Compani</li>
                                </ul>
                            </marquee>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-12">
                        <div class="d-flex float-right">
                            <a href="<?php echo  Yii::app()->createUrl('/account/signin'); ?>" class="btn btn-primary mx-1">Login</a>
                            <a href="<?php echo  Yii::app()->createUrl('/account/registration'); ?>" class="btn btn-secondary mx-1">Register</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row pt-4">
                <div class="col-md-9 colsm-12 col-xs-12">
                    <a href="#" class="logo">
                        <img src="<?php echo $basePath; ?>/assests/images/footerlogo.png">
                        CORPORATE AFFAIRS AND INTELLECTUAL PROPERTY OFFICE
                        <p style=" font-size: 13px; font-weight: 400; text-transform: capitalize;">A division of the Ministry of International Business and Industry, BARBADOS</p>
                    </a>
                </div>
                <div class="col-md-3 colsm-12 col-xs-12 align-item-end">
                    <form class="search">
                        <input type="text" placeholder="search in website">
                        <button>
                            <img src="<?php echo $basePath; ?>/assests/images/search-icon.png">
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample07"
                    aria-controls="navbarsExample07" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarsExample07">
                    <ul class="navbar-nav mr-auto">
                    	<?php 
                    		$curl_handle=curl_init();
							  curl_setopt($curl_handle,CURLOPT_URL,WEB_BASE_URL.'/wp-json/wp/v2/menu/primary-menu');
							  curl_setopt($curl_handle,CURLOPT_CONNECTTIMEOUT,2);
							  curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER,1);
							  $buffer = curl_exec($curl_handle);
							  curl_close($curl_handle);
							  $web_base_url = WEB_BASE_URL;
							  if (empty($buffer)){
							     $menus = json_decode("[{'id':1829,'title':'Home<\/span>','url':'$web_base_url'}]");
							  }
							  else{
							  	 $menus = json_decode($buffer);      
							  }

						  foreach ($menus as $key => $value) { 
						  		if(isset($value->submenu)){ ?>
						  			<li class="nav-item dropdown">
			                            <a class="nav-link dropdown-toggle" href="#" id="dropdown07" data-toggle="dropdown"
			                                aria-haspopup="true" aria-expanded="false"><?= $value->title ?>
			                            </a>
			                            <div class="dropdown-menu" aria-labelledby="dropdown07">
			                            	<?php foreach ($value->submenu as $k => $v) { ?>
				                                <a class="dropdown-item" href="<?= $v->url ?>"><?= $v->title ?></a>
				                               
			                                <?php	} ?>
			                            </div>
			                        </li>
						  		<?php }else{ ?>
						  				<li class="nav-item">
				                            <a class="nav-link"href="<?= $value->url ?>">
				                                <?= $value->title ?>
				                            </a>
				                        </li>
						  	<?php	} ?>
						  	
						  <!-- <li class="nav-item active">
                            <a class="nav-link" href="#">
                                <img src="<1?php echo $basePath; ?>/assests/images/home_icon.png">
                            </a>
                        </li> -->
						 
                      
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main>
	<section class="loginsection">
            <div class="container">

	<?php echo $content; ?>
		</div>
	</section>
    </main>

    <footer class="pt-4">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-12 col-xs-12">
                    <img src="<?php echo $basePath; ?>/assests/images/footerlogo.png" class="footerlogo img-fluid">
                    <div class="py-4">
                        <div class="contact">
                            <img src="<?php echo $basePath; ?>/assests/images/location_icon.png">
                            <p>Ground Floor, Baobab Towers, Warrens, St. Michael</p>
                        </div>
                        <div class="contact">
                            <img src="<?php echo $basePath; ?>/assests/images/phone_icon.png">
                            <p> +1 (246) 535-2401</p>
                        </div>
                        <div class="contact">
                            <img src="<?php echo $basePath; ?>/assests/images/mail_icon.png">
                            <p>caipo.general@barbados.gov.bb <br />caipo.general@barbados.gov.bb </p>
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
                            <li><a href="#"><img src="<?php echo $basePath; ?>/assests/images/fb_icon.png"></a></li>
                            <li><a href="#"><img src="<?php echo $basePath; ?>/assests/images/insta_icon.png"></a></li>
                            <li><a href="#"><img src="<?php echo $basePath; ?>/assests/images/twitter_icon.png"></a></li>
                            <li><a href="#"><img src="<?php echo $basePath; ?>/assests/images/youtube_icon.png"></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright d-flex justify-content-center">
            <p>copyright © 2021 Corporate Affairs and Intellectual Property Office.All Right Reserved</p>
        </div>
    </footer>
	
	



    <script src="<?php echo $basePath; ?>/assests/js/jquery-3.2.1.slim.min.js"></script>
    <script src="<?php echo $basePath; ?>/assests/js/popper.min.js"></script>
    <script src="<?php echo $basePath; ?>/assests/js/bootstrap.min.js"></script>

    <script src="<?php echo $basePath; ?>/assests/js/jquery-1.10.2.js"></script>
    <script src="<?php echo $basePath; ?>/assests/js/slick.js"></script>
    <script src="<?php echo $basePath; ?>/assests/js/jquery-ui.js"></script>
    <script src="<?php echo $basePath; ?>/assests/js/custom.js"></script>


    <script>
        $(function () {
            $("#logintab").tabs();
        });
		
		
    </script>

</body>

</html>