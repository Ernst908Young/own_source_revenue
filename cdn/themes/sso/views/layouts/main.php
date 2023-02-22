<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Login / Register - SSO :: SWCS DEMO</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
                <!-- custom css -->
         <link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/font-awesome.min.css" rel="stylesheet">
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery-1.10.2.min.js"></script>
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/login.css" type="text/css" />
        <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/login-form.css" type="text/css" />
        <!-- custom css end -->
      
        <!-- header and footer -->
         <!-- Google Fonts -->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Raleway:100,200,300,700,800,900' rel='stylesheet' type='text/css'>
        <!-- Library CSS -->
        <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/SWCS/css/bootstrap.css">
        <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/SWCS/css/bootstrap-theme.css">
        <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/SWCS/css/fonts/font-awesome/css/font-awesome.css">
        <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/SWCS/css/animations.css" media="screen">
        <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/SWCS/css/superfish.css" media="screen">
        <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/SWCS/css/revolution-slider/css/settings.css" media="screen">
        <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/SWCS/css/revolution-slider/css/extralayers.css" media="screen">
        <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/SWCS/css/prettyPhoto.css" media="screen">
        <!-- Theme CSS -->
        <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/SWCS/css/style.css">
        <!-- Skin -->
        <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/SWCS/css/colors/green.css" class="colors">
        <!-- Responsive CSS -->
        <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/SWCS/css/theme-responsive.css">
        <!-- Switcher CSS -->
        <link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/switcher.css" rel="stylesheet">
        <link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/spectrum.css" rel="stylesheet">
        <!-- Favicons -->
      
        <!-- fancybox js and css-->
         <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/fancybox/jquery.fancybox.css" type="text/css" media="screen" />
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/fancybox/jquery.fancybox.pack.js"></script>

        <!-- Optional, Add fancyBox for media, buttons, thumbs -->
        <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/fancybox/jquery.fancybox-buttons.css" type="text/css" media="screen" />
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/fancybox/jquery.fancybox-buttons.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/fancybox/jquery.fancybox-media.js"></script>
        <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/fancybox/jquery.fancybox-thumbs.css" type="text/css" media="screen" />
        <script type="text/javascript" src="/SWCS/frontoffice/themes/SWCS/fancybox/source/helpers/jquery.fancybox-thumbs.js"></script>

        <!-- Optional, Add mousewheel effect -->
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/fancybox/jquery.mousewheel-3.0.6.pack.js"></script>  

        <!-- /fancy box css and js -->
        <!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
        <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <script src="js/respond.min.js"></script>
        <![endif]-->
        <!--[if IE]>
        <link rel="stylesheet" href="css/ie.css">
        <![endif]-->
        
<style type="text/css">
    .body-s {
        max-width: 50%;
    }
</style>
        
    </head>
    <body class="bg-cyan">
        <div class="page-mask">
            <div class="page-loader">
                <div class="spinner"></div>
                Loading...
            </div>
        </div>
        <div class="wrap">
            <!-- Header -->
            <header id="header">
                <!-- Header Top Bar -->
                <div class="top-bar">
                    <div class="slidedown collapse">
                        <div class="container">
                            <div class="pull-left">
                                <ul class="social pull-left">
                                    <li class="facebook"><a href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li class="twitter"><a href="#"><i class="fa fa-twitter"></i></a></li>
                                    <li class="linkedin"><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                </ul>
                            </div>
                            
                            <div class="phone-login pull-right">
                                <a><i class="fa fa-phone"></i> Call Us : +880 -111-111</a>
                                <?php if(Utility::isLoggedIn()) echo " <a href='".Yii::app()->createUrl("/site/logout")."'><i class='fa fa-sign-in'></i> Logout</a>";?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Header Top Bar -->
                <!-- Main Header -->
                <div class="main-header">
                    <div class="container">
                        <!-- TopNav -->
                        <div class="topnav navbar-header">
                            <a class="navbar-toggle down-button" data-toggle="collapse" data-target=".slidedown">
                                <i class="fa fa-angle-down icon-current"></i>
                            </a> 
                        </div>
                        <!-- /TopNav-->
                        <!-- Logo -->
                        <div class="logo pull-left">
                            <h3>
                                <a href="<?php echo FRONT_BASEURL; ?>">
                                <img class="logo-color" src="<?php echo Yii::app()->theme->baseUrl; ?>/img/logos/logo_green.jpg" alt="gallaxy" width="100" height="85">
                                    Single Window Clearance System
                                </a>
                            </h3>
                        </div>
                        <!-- /Logo -->
                        <!-- Mobile Menu -->
                        <div class="mobile navbar-header">
                            <a class="navbar-toggle" data-toggle="collapse" href=".html">
                                <i class="fa fa-bars fa-2x"></i>
                            </a> 
                        </div>
                        <!-- /Mobile Menu -->
                        <!-- Menu Start -->
                        <nav class="collapse navbar-collapse menu">
                            <ul class="nav navbar-nav sf-menu">
                                <?php
                                    $REDIRECT_URL=$_SERVER['REDIRECT_URL'];
                                    $REDIRECT_URL=trim($REDIRECT_URL);
                                    $REDIRECT_URL=str_replace("/","",$REDIRECT_URL);
                                    if(empty($REDIRECT_URL)){
                                        echo '<li id="current"><a href="'.FRONT_BASEURL.'">Home</a></li>';                                            
                                    }
                                    else{
                                        echo '<li><a href="'.FRONT_BASEURL.'">Home</a></li>';
                                    }  
                                    
                                    $links = Utility::getPageTree(1);
                                    foreach ($links as $link) {
                                        $tstub=$link['page_stub'];
                                        $tstub_id=md5($tstub); 
                                        $tstub=str_replace("/", "", $tstub);
                                        $url = FRONT_BASEURL."/".$tstub;
                                        $children=$link['children'];
                                        $pageName = $link['page_name'.$langId];
                                        if(empty($pageName)) {
                                            $pageName = $link['page_name'];
                                        }
                                        $aclass="";
                                        $aid = "";
                                        if($REDIRECT_URL==$tstub){
                                            $aclass="class=''";
                                            $aid="id='current'";
                                        }
                                        else{
                                            if(count($children)>0) {
                                                echo "<li  class='sf-with-ul'>";
                                                echo "<a $aid href='$url' class='sf-with-ul'>$pageName";
                                                echo '<span class="sf-sub-indicator">
                                                    <i class="fa fa-angle-down "></i>
                                                    </span></a>';
                                                echo "<ul>";
                                                foreach ($children as $child) {

                                                    $cstub=$child['page_stub'];
                                                    $cstub=str_replace("/", "", $cstub);
                                                    $childLink = FRONT_BASEURL."/".$cstub;
                                                    $childLabel = $child['page_name'.$langId];
                                                    if(empty($childLabel)){
                                                        $childLabel = $child['page_name'];
                                                    }
                                                    if($child['is_direct_link']==='Y')
                                                        echo "<li><a href='".$child['link_address']."' class='fancybox' data-fancybox-type='iframe'>$childLabel</a></li>";
                                                    else{
                                                        $subchild=$child['children'];
                                                        if(count($subchild)>0){
                                                            echo "<li class='sf-with-ul'>";
                                                            echo "<a href='$childLink' class='sf-with-ul'>$childLabel";
                                                            echo '<span class="sf-sub-indicator">
                                                            <i class="fa fa-angle-right "></i>
                                                            </span></a>';
                                                            echo "<ul>";
                                                            foreach ($subchild as $sub) {
                                                                $sstub=$sub['page_stub'];
                                                                $sstub=str_replace("/", "", $sstub);
                                                                $schildLink = FRONT_BASEURL."/".$sstub;
                                                                $schildLabel = $sub['page_name'.$langId];
                                                                if(empty($schildLabel)){
                                                                    $schildLabel = $sub['page_name'];
                                                                }
                                                                if($sub['is_direct_link']==='Y')
                                                                     echo "<li><a href='".$sub['link_address']."' class='fancybox' data-fancybox-type='iframe'>$schildLabel</a></li>";
                                                               else
                                                                     echo "<li><a href='$schildLink' class='sf-with-ul'>$schildLabel</a></li>";
                                                            }
                                                            echo "</ul></li>";
                                                        }
                                                        else{
                                                            if($child['is_direct_link']==='Y')
                                                                echo "<li><a href='".$child['link_address']."' class='fancybox' data-fancybox-type='iframe'>$childLabel</a></li>";
                                                            else
                                                                echo "<li><a href='$childLink' class='sf-with-ul'>$childLabel</a></li>";
                                                        }
                                                    }
                                                }
                                                echo "</ul></li>";                                                      
                                            }
                                            else{
                                                if($link['is_direct_link']==='Y')
                                                    echo "<li><a href='". $link['link_address']."' class='fancybox' data-fancybox-type='iframe'>$pageName</a></li>";
                                                else
                                                    echo "<li $aclass><a href='$url'>$pageName</a></li>";
                                            }   
                                        }
                                    }
                                ?>  
                                
                            </ul>
                        </nav>
                        <!-- /Menu --> 
                    </div>
                </div>
                <!-- /Main Header -->
            </header>
            <div class="body body-s">
            
            <?php echo $content; ?>


                  </div>

            <!-- Footer Start -->
               <footer id="footer">
                <div class="pattern-overlay">
                    <!-- Footer Top -->
                    <div class="footer-top">
                        <div class="container">
                            <div class="row">
                                <section class="col-lg-3 col-md-3 col-xs-12 col-sm-3 footer-one wow fadeIn">
                                    <h3 class="light">About</h3>
                                    <p> 
                                    <?php
                                            $contact_info = Utility::getContactInfo(); 
                                            echo $contact_info['homepage_footer_aboutus'];
                                   ?>
                                    </p>
                                </section>
                                <section class="col-lg-3 col-md-3 col-xs-12 col-sm-3 footer-two wow fadeIn">
                                    <h3 class="light">Twitter Stream</h3>
                                    <ul id="tweets">
                                    
                                    </ul>
                                </section>
                                <section class="col-lg-3 col-md-3 col-xs-12 col-sm-3 footer-three wow fadeIn">
                                    <h3 class="light">Contact Us</h3>
                                    <ul class="contact-us">
                                        <?php
                                            echo "<li>
                                            <i class='fa fa-map-marker'></i>
                                            <p> 
                                                <strong class='contact-pad'>".$contact_info['contact_us_address']."</strong>
                                        </li>
                                        <li>
                                            <i class='fa fa-phone'></i>
                                            <p><strong>Phone:</strong>".$contact_info['contact_us_phone']."</p>
                                        </li>
                                        <li>
                                            <i class='fa fa-envelope'></i>
                                            <p><strong>Email:</strong>".$contact_info['contact_us_email']."</a></p>
                                        </li>

                                            ";
                                        ?>

                                        
                                    </ul>
                                </section>
                                <section class="col-lg-3 col-md-3 col-xs-12 col-sm-3 footer-four wow fadeIn">
                                    <h3 class="light">Subscribe</h3>
                                    <p>
                                        Subscribe to our email newsletter to receive our news, updates.
                                    </p>
                                    <form method="get" action="#">
                                        <div class="input-group">
                                            <input type="text" value="mail@example.com" onfocus="if(this.value=='mail@example.com')this.value='';" onblur="if(this.value=='')this.value='mail@example.com';" class="subscribe form-control">
                                            <span class="input-group-btn">
                                            <button class="btn subscribe-btn" type="button">Join</button>
                                            </span>
                                        </div>
                                        <!-- /input-group -->
                                    </form>
                                </section>
                            </div>
                        </div>
                    </div>
                    <!-- /Footer Top --> 
                    <!-- Footer Bottom -->
                    <div class="footer-bottom">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6 ">
                                    <p class="credits">&copy; Copyright 2014 by <a href="#">CHiPS</a>. All Rights Reserved. </p>
                                </div>
                                <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6 ">
                                    <ul class="social social-icons-footer-bottom">
                                        <li class="facebook"><a href="#" data-toggle="tooltip" title="Facebook"><i class="fa fa-facebook"></i></a></li>
                                        <li class="twitter"><a href="#" data-toggle="tooltip" title="Twitter"><i class="fa fa-twitter"></i></a></li>
                                     
                                        <li class="linkedin"><a href="#" data-toggle="tooltip" title="LinkedIn"><i class="fa fa-linkedin"></i></a></li>
                            
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Footer Bottom --> 
                    <!-- /Footer Bottom --> 
                </div>
            </footer>
            <!-- Scroll To Top --> 
            <a href="#" class="scrollup"><i class="fa fa-angle-up"></i></a>
        </section> <!-- Closing the #page section -->
    </body>
    <script src="<?php echo Yii::app()->theme->baseUrl; ?>/SWCS/js/jquery-migrate-1.0.0.js"></script>
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/SWCS/js/jquery-ui.js"></script>
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/SWCS/js/bootstrap.js"></script>
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/SWCS/js/revolution-slider/js/jquery.themepunch.plugins.min.js"></script> 
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/SWCS/js/revolution-slider/js/jquery.themepunch.revolution.min.js"></script>
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/SWCS/js/jquery.parallax.js"></script>
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/SWCS/js/jquery.wait.js"></script>
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/SWCS/js/fappear.js"></script> 
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/SWCS/js/modernizr-2.6.2.min.js"></script>
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/SWCS/js/jquery.bxslider.min.js"></script>
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/SWCS/js/jquery.prettyPhoto.js"></script>
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/SWCS/js/superfish.js"></script>
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/SWCS/js/tweetMachine.js"></script>
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/SWCS/js/tytabs.js"></script>
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/SWCS/js/jquery.gmap.min.js"></script>
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/SWCS/js/jquery.sticky.js"></script>
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/SWCS/js/jquery.countTo.js"></script>
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/SWCS/js/jflickrfeed.js"></script>
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/SWCS/js/imagesloaded.pkgd.min.js"></script>
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/SWCS/js/waypoints.min.js"></script>
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/SWCS/js/wow.js"></script>
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/SWCS/js/jquery.fitvids.js"></script>
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/SWCS/js/spectrum.js"></script>
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/SWCS/js/switcher.js"></script>
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/SWCS/js/custom.js"></script>
<script type="text/javascript">
$(document).ready(function(){
                                
    $(".fancybox").fancybox({
        openEffect  : 'none',
        closeEffect : 'none',
        iframe : {
                        preload: false
        }
    });
    $(".various").fancybox({
        maxWidth           : 800,
        maxHeight          : 600,
        fitToView            : false,
        width                    : '70%',
        height                   : '70%',
        autoSize               : false,
        closeClick             : false,
        openEffect         : 'none',
        closeEffect          : 'none'
    });
    $('.fancybox-media').fancybox({
        openEffect  : 'none',
        closeEffect : 'none',
        helpers : {
            media : {}
        }
    });
});
</script>
</html>
