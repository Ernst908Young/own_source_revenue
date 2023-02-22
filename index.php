<!Doctype html>
<?php  $basePath="/panchayatiraj/themes/investuk/assets/login";
$web_base_url =WEB_BASE_URL;
if(stristr(WEB_BASE_URL,"http://52.172.145.30/panchayatiraj")){
  $portal_url="/panchayatiraj";
}
else{
  $portal_url="";
} ?>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="PanchayatiRaj" />
    <meta name="description" content="PanchayatiRaj" />
    <meta name="author" content="PanchayatiRaj" />

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>:: Panchayatiraj ::</title>
   <!--  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> -->
    <link rel="stylesheet" href="<?php echo $basePath; ?>/assests/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo $basePath; ?>/assests/css/style.css">
    <link rel="stylesheet" href="<?php echo $basePath; ?>/assests/css/responsive.css">
    <link rel="stylesheet" href="<?php echo $basePath; ?>/assests/css/slick.css">
    <link rel="stylesheet" href="<?php echo $basePath; ?>/assests/css/slick-theme.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
/*up css*/

  .content_sec1 {
    background-color: #fff;
    padding:0px 20px 40px 0px;

}



.content_sec2 {
  background: url(http://efilingreat.up.gov.in/images/new/images/bg_countersection.jpg);
    background-position-x: 0%;
    background-position-y: 0%;
    background-repeat: repeat;
    background-size: auto;
  background-repeat: no-repeat;
  background-size: cover;
  background-position: center;
  padding: 40px 0 40px 0;
}

.content_sec3 {
  background: url(http://efilingreat.up.gov.in/images/new/images/bg_shapes.jpg);
    background-position-x: 0%;
    background-position-y: 0%;
    background-repeat: repeat;
    background-size: auto;
  background-repeat: no-repeat;
  background-size: cover;
  background-position: center;
    padding: 40px 0;
}

.content_footer {
  background: url(../../../images/new/images/bg_footer.jpg);
    background-position-x: 0%;
    background-position-y: 0%;
    background-repeat: repeat;
    background-size: auto;
  background-repeat: no-repeat;
  background-size: cover;
  background-position: center;
  padding: 50px 20px;
    padding-bottom: 50px;
}

.headingWithLine {

 font-size: 36px;
 color: #2f2f2f;
 margin: 0;
 padding: 0;
 display: block;
 position: relative;
 text-align: center;
}
.headingWithLine span {

 display: inline-block;
 position: relative;
 z-index: 1;
 padding: 0 15px;
 color: #D16002;

 background-color: #fff;
}
.headingWithLine::after {
  display: block;
  content: '';
  position: absolute;
  top: 0;
  bottom: 0;
  left: 0;
  width: 100%;
  height: 3px;
  background: #D16002;
  margin: auto;
}

.counterbox {
  overflow: hidden;
  background: rgb(0 0 0/ 0.5);
  padding: 12px 0;
  border-radius: 10px;
  border: 1px solid rgb(255 255 255/ 0.3);
  margin: 0 6px;
  text-align: center;
}

.counterheading {
  color: rgba(255, 255, 255, 0.70);
  font-size: 18px;
  font-family: "latobold", Arial, Helvetica, sans-serif;
}
.counterblock .count {
  color: #e5c75e;
  font-size: 50px;
  font-family: "Lato-Light", Arial, Helvetica, sans-serif;
}

.counterblock .countercol {

 float: left;
 width: 50%;
}
.counterblock .counterlabel {

 color: rgba(255, 255, 255, 0.70)
 }
.boxsmall.orange {
  border: 3px solid #d28d43;
}
.boxsmall {
  background: #fff;
  border: 3px solid #fff;
  border-radius: 10px;
  overflow: hidden;
  box-shadow: 0px 10px 15px rgba(0, 0, 0, 0.25);
  text-decoration: none;
  display: block;
}

.boxsmall .boxlabel {
  background: #fff;
  color: #fff;
  font-size: 18px;
  font-family: "ubunturegular", Arial, serif;
  text-transform: uppercase;
  padding: 5px;
}
.boxsmall.orange .boxlabel {
  background: #d28d43;
}
.boxsmall.red {
  border: 3px solid #D16002;
}
.boxsmall.red .boxlabel {
  background: #D16002;
}

        .boxsmall img {
            display: block;
       margin: 10px auto;
      height: 75px;
        }

.membersboxwrap {
  width: 100%;
  max-width: 1170px;
  margin: 40px auto auto;
  justify-content: center;
}
.memberbox {
  text-align: center;
}

.memberbox img {
  border: 8px solid #fff;
  box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.3);
  border-radius: 5px;
  margin-bottom: 15px;
  transition: all 0.5s;
}
/*new site*/
.about_content p {
  text-align: justify;
}

.section-header {
  text-align: center;
}


.section.no-border-bottom {
  border-bottom: none;
    border-bottom-color: currentcolor;
    border-bottom-style: none;
    border-bottom-width: medium;
}

.overlay-black, .overlay-black h1, .overlay-black h2, .overlay-black h3, .overlay-black h4, .overlay-black h5, .overlay-black h6, .overlay-black p {
  color: #D16002;
}

.bg-white {
  background-color: #fff !important;
}

.overlay-black::before, .overlay-white::before {
  position: absolute;
  content: "";
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  z-index: -1;
}
.counter {
  text-align: center;
  padding-top: 24px;
  padding-bottom: 24px;
}
.counter p {
  font-size: 32px;

  font-family: Montserrat, sans-serif;
}

.section-header p {
  font-size: 16px;
}

p {
  line-height: 25px;
  margin-bottom: 10px;
}
p {
  margin: 0 0 10px;
}
.fa{
  padding-bottom:10px;
 font-size: 48px;
}

.slick-slider .element{
  height:100px;
  width:100px;
  background-color:#ffffff;
  color:#000000;
  border-radius:5px;
  display:inline-block;
  margin:0px 10px;
  display:-webkit-box;
  display:-ms-flexbox;
  text-align: center;
  display:flex;
  -webkit-box-pack:center;
      -ms-flex-pack:center;
          justify-content:center;
  -webkit-box-align:center;
      -ms-flex-align:center;
          align-items:center;
  font-size:20px;
}
.slick-slider .slick-disabled {
  opacity : 0;
  pointer-events:none;
}
.slick-slide img{
  display: unset;
}


</style>


<body>



    <header>
    <div class="top_bar">
        <div class="container-fluid">
            <div class="row pt-3">
                <div class="col-md-9 colsm-12 col-xs-12">
                   <!--  <a href="/" class="logo" >
                        <img src="<?php echo $basePath; ?>/assests/images/logo_nclt.png" style="width:300px;">


                    </a> -->
                    <!-- <p class="logosubheading">Government Of UTTAR PRADESH</p> -->
                    <a href="/panchayatiraj/" class="logo" >
                        <!-- <img src="<?php echo $basePath; ?>/assests/images/punjab_logo.png"> -->
                        Own Source Of Revenue

                    </a>
                    <!-- <p class="logosubheading">Government Of UTTAR PRADESH</p> -->
                </div>
                <div class="col-md-3 colsm-12 col-xs-12 align-item-end">
                    <div class="d-flex float-right">
                        <a href="/panchayatiraj/sso/account/signin" class="btn btn-login mx-1">Login</a>
                        <a href="/panchayatiraj/sso/account/registration" class="btn btn-signup mx-1">Register</a>
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
                            $curl_handle=curl_init();
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
                              }

                                $menus = [
                                       'Home'=>['id'=>'1829'],
                                       'About Us'=>['title'=>'About Us'],
                                       // 'Cause_list'=>['title'=>'Cause List'],
                                       // 'Cause_status'=>['title'=>'Cause Status'],
                                       // 'Judgements'=>['title'=>'Judgements<span>&#9660;</span>'],
                                       // 'orders'=>['title'=>'Orders<span>&#9660;</span>'],
                                       // 'court_notice'=>['title'=>'Court Notice'],
                                       // 'circulars'=>['title'=>'Circulars/Orders'],
                                       // 'act_rule'=>['title'=>'Act & rules<span>&#9660;</span>'],
                                       // 'opportunites'=>['title'=>'Opportunites<span>&#9660;</span>'],
                                       //  'services'=>['title'=>'Services<span>&#9660;</span>'],
                                        'contact'=>['title'=>'Contact Us']
                                         ];


                          foreach ($menus as $key => $value) {
                                if(isset($value["submenu"])){ ?>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" id="dropdown07" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false"><?= $value->title ?>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="dropdown07">
                                            <?php foreach ($value->submenu as $k => $v) { ?>
                                                <a class="dropdown-item" href="<?= $portal_url.$v->url ?>">
                                                    <?= $v["title"] ?></a>

                                            <?php   } ?>
                                        </div>
                                    </li>
                                <?php }else{ ?>
                                        <li class="nav-item">
                                               <?php if($value["id"]==1829){ ?>
                                            <a class="nav-link"href="<?= $portal_url.$value->url ?>">
                                             <img src="<?php echo $basePath; ?>/assests/images/home_icon.png">
                                         </a>
                                        <?php }else{ ?>
                                             <a class="nav-link"href="<?= $portal_url.$value->url ?>">
                                            <?= $value["title"] ?>
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
  <div class="clearfix"></div>


<div class="modal fade global-popup" id="hd-uttarakhand-state" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">×</button>
      </div>
      <div class="modal-body text-center">
        <iframe width="800" height="450" src="./E-Judiciary System_files/aADG8fI0S0o.html" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen=""></iframe>
      </div>
    </div>
  </div>
</div>

<script>
$(".hd-block").click(function() {
$("#hd-uttarakhand-state").modal();
});
</script>
<!-- Carousel items -->
<!-- <div id="carousel" class="carousel slide banner-slider" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#carousel" data-slide-to="0" class="active"></li>
        <li data-target="#carousel" data-slide-to="1" class=""></li>
        <!--<li data-target="#carousel" data-slide-to="2"></li>-->


   <!-- </ol> -->
    <!-- Carousel items -->
    <!-- <div class="carousel-inner">



      <div class="slider-items slider1 item active" style="background-image: url(&#39;/themes/investuk/images/judiciary_image1.jpg?3774892132&#39;);padding:10px;">
            <div class="ban-txt">
                <div class="container">

                </div>
            </div>
        </div>


    <div class="slider-items slider2 item" style="background-image: url(&#39;/themes/investuk/images/dizitaization.png?3774892232&#39;);padding:10px;">
            <div class="ban-txt">
                <div class="container">

                </div>
            </div>
        </div> -->

                <!--     <div class="slider-items slider3 item  img-responsive-" style="background-image: url('/themes/investuk/images/jk3.jpg?3774892232');padding:10px;">
            <div class="ban-txt">
                <div class="container">

                </div>
            </div>
        </div>-->



    <!-- </div> -->
    <!-- Carousel nav -->
  <!--   <a class="carousel-control left" href="http://52.172.145.30/#carousel" data-slide="prev">‹</a>
    <a class="carousel-control right" href="http://52.172.145.30/#carousel" data-slide="next">›</a>
</div> -->


<div id="carousel" class="carousel slide" data-ride="carousel" >
  <div class="carousel-inner">
    <div class="carousel-item active"  style="background-image: url(&#39;http://52.172.145.30/panchayatiraj/themes/investuk/assets/login/assests/images/pbbanner2.png?3774892232&#39;);height:360px; background-repeat: no-repeat;
    background-position: center;
    background-size: cover;">

    </div>
    <div class="carousel-item" style="background-image: url(&#39;http://52.172.145.30/panchayatiraj/themes/investuk/assets/login/assests/images/pbbanner2.png?3774892232&#39;);height:360px;background-repeat: no-repeat;
    background-position: center;
    background-size: cover;" >

    </div>

  </div>
  <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>




<div class="body_section"><br>

<!-- <div class="col-md-12" style="text-align: center">
<a href="/site/feedbackSurvey"><span style="color:#ff0000 !important;font-size:20px;text-align: center;padding:5px;">Please give your valuable feedback for improving our services on Single Window System !</span></a>
</div> -->
<!--</marquee>-->
<br><br>

</div><div class="clearfix"></div>

<!--
<div style="text-align: center;margin-top: 20px;font-size: 25px;font-weight: bold;color:#ff0000 !important;">
<img height = "40px" width = "40px" src = "/themes/investuk/images/link_new.gif"><a target = "_blank" href ="/site/ActsRulesNotificationsCovid19"><span style="color:#ff0000 !important;"><u>Consolidated Guidelines of MHA on Lockdown measures on containment of COVID-19</u></span></a>
</div>

<div style="text-align: center;margin-top: 20px;font-size: 25px;font-weight: bold;color:#0091d7">
<span>For Queries / Issues related to Permission for operation during COVID-19 Lockdown</span><a target="_blank" href="http://52.172.145.30/query/open.php?guest=1" style="padding: 14px;" > <span class="blinking"> => Please click here</span></a>
</div>

<div style="text-align: center;margin-top: 20px;font-size: 25px;font-weight: bold;color:#0091d7">
<span>Help Video for Investor Registration</span><a target="_blank" href="https://youtu.be/5RPdPfkZC0s" style="padding: 14px;" > <span class="blinking"> => Please click here</span></a>
</div>

<div style="text-align: center;margin-top: 20px;font-size: 25px;font-weight: bold;color:#0091d7">
<span>Help Video for Investors to Apply For Continuity of Production during COVID-19 Lockdown
</span><a target="_blank" href="https://youtu.be/DmYGyk7_WMw" style="padding: 14px;" > <span class="blinking"> => Please click here</span></a>
</div>

<div style="text-align: center;margin-top: 20px;font-size: 25px;font-weight: bold;color:#0091d7">
<span>Help Video to Apply for e-Pass to approved Employees / Vehicles</span><a target="_blank" href="https://youtu.be/YiFc1KwzeTM" style="padding: 14px;" > <span class="blinking"> => Please click here</span></a>
</div>
<div style="text-align: center;margin-top: 15px;font-size: 20px;font-weight: bold;color:#0091d7">
  <span>Survey of Industries For Ramping Up Production Post Lock-Down</span><a target="_blank" href="http://52.172.145.30/survey-covid19" style="padding: 14px;" > <p class="blinking"> => Please click here</p></a>
</div>-->
<div class="container" style="display: inline">
<!-- Main container -->
  <main>

    <!-- Features -->
    <section class="bg-white">
      <div class="container about_content">

        <span class="section-header">
          <h2>About Us</h2>
          <p >Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No sólo sobrevivió 500 años, <a href="javascript:void(0);" id="readmore" onclick="readmore();" style="display:none;">Read more..</a></p>
                <p id="moreContent" style="display:block;padding: 0 0 50px 0;">Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No sólo sobrevivió 500 años,</p>
        </span>

      </div>
    </section>
    <!-- END Features -->





  </main>
  <!-- END Main container -->




            </div>
        </section></div>

  <!--       <div class="mid-section">
            <div class="row">
                <div class="col-xs-12 col-sm-8">
                    <h2 class="section-main-hd why-invest-hd">Why Invest in Jammu Kashmir</h2>


                    <ul class="invest-list">
                        <li><p class="policy-approval">Transparent tax policies and swift approvals for the projects</p></li>
                        <li><p class="cost">Fractional cost of setting up of operations as compared to NCR or other cities</p></li>
                        <li><p class="institutes">Large number of engineering and management Institutes including IIT & IIM</p></li>
                        <li><p class="governance">Political stability, good governance and image as a peaceful state</p></li>
                        <li><p class="investment">Attractive investment policy of State Govt.</p></li>
                        <li><p class="industry">Availability of suitable industrial land to start business at a cheap rate</p></li>
                        <li><p class="employee">Good quality of life for employees due to healthy environment</p></li>
                        <li><p class="transport">Good connectivity by Rail, Road and Air with NCR</p></li>
                    </ul>
                </div>
                <div class="col-xs-12 col-sm-4">

                    <img class="img-responsive investor-lifecycle" src="http://52.172.145.30/themes/investuk/images/lifecycle_diagram.png" alt="Investor Lifecycle">
                </div>
            </div>


        </div> -->
    </div>



<!-- <div class="container p-t-10">
    <div class="row">--><!--slider-->
        <!--<div class="col-xs-12 flexslider">--><!--flexslider-->
           <!-- <ul class="bottom-logos slides">--><!--slides-->
            <!--    <li><a href="https://www.doiuk.org/" target="_blank"><img src="./E-Judiciary System_files/doiuk.jpg" alt="" title=""></a></li>
                <li><a href="http://www.startuputtarakhand.com/" target="_blank"><img src="./E-Judiciary System_files/startup-logo.png" alt="" title="" style="width:150px;"></a></li>
                <li><a href="http://dipp.nic.in/" target="_blank"><img src="./E-Judiciary System_files/dipp_logo.jpg" alt="" title=""></a></li>
                <li><a href="http://www.makeinindia.com/home" target="_blank"><img src="./E-Judiciary System_files/make_in_india_logo.jpg" alt="" title="" style="width:150px;"></a></li>
                <li><a href="http://www.digitalindia.gov.in/" target="_blank"><img src="./E-Judiciary System_files/digital_india_logo.png" alt="" title="" style="width:150px;"></a></li>
        <li><a href="http://tourism.gov.in/" target="_blank"><img src="./E-Judiciary System_files/incredible-india.png" alt="" title="" style="width:150px;"></a></li>
        <li><a href="https://www.siidcul.com/" target="_blank"><img src="./E-Judiciary System_files/siidcul_small.jpg" alt="" title="" style="width:68px;"></a></li>
        <li><a href="https://www.startupindia.gov.in/" target="_blank"><img src="./E-Judiciary System_files/start-up_india.jpg" alt="" title="" style="width:150px;"></a></li>
        <li><a href="http://www.mofpi.nic.in/" target="_blank"><img src="./E-Judiciary System_files/mofpi.png" alt="" title="" style="width:150px;"></a></li>
        <li><a href="http://dcmsme.gov.in/" target="_blank"><img src="./E-Judiciary System_files/dcmsme.png" alt="" title="" style="width:90px;"></a></li>
            </ul>
        </div>
    </div>
</div> -->
<!--<div class="container p-t-10">
    <div class="row">
        <div class="col-xs-12">
            <ul class="bottom-logos">
                <li><a href="https://www.doiuk.org/" target="_blank"><img src="http://52.172.145.30/themes/investuk/images/doiuk.jpg" alt="" title=""  /></a></li>
                <li><a href="http://www.startuputtarakhand.com/" target="_blank"><img src="http://52.172.145.30/themes/investuk/images/startup-logo.png" alt="" title="" /></a></li>
                <li><a href="http://dipp.nic.in/" target="_blank"><img src="http://52.172.145.30/themes/investuk/images/dipp_logo.jpg" alt="" title="" /></a></li>
                <li><a href="http://www.makeinindia.com/home" target="_blank"><img src="http://52.172.145.30/themes/investuk/images/make_in_india_logo.jpg" alt="" title="" /></a></li>
                <li><a href="http://www.digitalindia.gov.in/" target="_blank"><img src="http://52.172.145.30/themes/investuk/images/digital_india_logo.png" alt="" title="" /></a></li>
            </ul>
        </div>
    </div>
</div>-->
 <!-- Modal -->
<div class="modal fade global-popup" id="uttarakhand-state" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">×</button>
      </div>
      <div class="modal-body text-center">
        <iframe width="800" height="450" src="./E-Judiciary System_files/aADG8fI0S0o(1).html" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen=""></iframe>
    </div>
      <!--<div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>-->
    </div>
  </div>
</div>
 <div class="modal fade global-popup" id="uttarakhand-tourism" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">×</button>
      </div>
      <div class="modal-body text-center">
        <iframe width="800" height="450" src="./E-Judiciary System_files/nvt9hVAeOxo.html" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen=""></iframe>
    </div>
    </div>
  </div>
</div>
  <div class="modal fade global-popup" id="uttarakhand-ayush" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">×</button>
      </div>
      <div class="modal-body text-center">
        <iframe width="800" height="450" src="./E-Judiciary System_files/IkwJhodF6wQ.html" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen=""></iframe>
    </div>
    </div>
  </div>
</div>
 <div class="modal fade global-popup" id="uttarakhand-film" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">×</button>
      </div>
      <div class="modal-body text-center">
        <iframe width="800" height="450" src="./E-Judiciary System_files/l4P9HiUgZig.html" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen=""></iframe>
    </div>
    </div>
  </div>
</div>
 <div class="modal fade global-popup" id="uttarakhand-pharma" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">×</button>
      </div>
      <div class="modal-body text-center">
        <iframe width="800" height="450" src="./E-Judiciary System_files/tz5kKkkwYI0.html" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen=""></iframe>
    </div>
    </div>
  </div>
</div>

 <div class="modal fade global-popup" id="uttarakhand-renewable" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">×</button>
      </div>
      <div class="modal-body text-center">
        <iframe width="800" height="450" src="./E-Judiciary System_files/15ou5ddgCX8.html" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen=""></iframe>
      </div>
    </div>
  </div>
</div>
  <div class="modal fade global-popup" id="uttarakhand-technology" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">×</button>
      </div>
      <div class="modal-body text-center">
        <iframe width="800" height="450" src="./E-Judiciary System_files/UVrNaMr5Kj0.html" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen=""></iframe>
      </div>
    </div>
  </div>
</div>
  <div class="modal fade global-popup" id="uttarakhand-herbs" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">×</button>
      </div>
      <div class="modal-body text-center">
        <iframe width="800" height="450" src="./E-Judiciary System_files/Op4_JWakAyE.html" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen=""></iframe>
    </div>
    </div>
  </div>
</div>
 <div class="modal fade global-popup" id="uttarakhand-food" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">×</button>
      </div>
      <div class="modal-body text-center">
        <iframe width="800" height="450" src="./E-Judiciary System_files/7sx4tZtMOB0.html" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen=""></iframe>
    </div>
    </div>
  </div>
</div>
<div class="modal fade global-popup" id="registration-popup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-body" style="padding:0;">
    <button type="button" class="close" data-dismiss="modal">×</button>
    <img src="./E-Judiciary System_files/registration_popup.jpg" alt="Registrations are now open" border="0" usemap="#Map" class="img-responsive" title="Registrations are now open">
<map name="Map" id="Map">
  <area shape="rect" coords="358,518,539,566" href="https://register.destinationuttarakhand.in/" target="_blank" alt="Please Register">
<area shape="rect" coords="327,360,450,377" href="http://52.172.145.30/themes/backend/uploads/Destination_Uttarakhand_Summit%202018_Project_Information_Sheet_V1.xlsx" target="_blank" alt="PIS">
<area shape="rect" coords="736,361,855,377" href="http://52.172.145.30/themes/backend/uploads/Destination_Uttarakhand_Summit_2018%20_%20MOU_Format_V1.docx" target="_blank" alt="MOU">
<area shape="rect" coords="595,381,711,397" href="http://52.172.145.30/themes/backend/uploads/Destination%20U&#39;Khand%20Summit%202018_Intention%20to%20Invest%20Format%20V1.docx" target="_blank" alt="Bidding Process">
<area shape="rect" coords="626,400,809,418" href="mailto:ipfc@investuttarakhand.com">
</map>
   </div>
      <!--<div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>-->
    </div>
  </div>
</div>

<div class="modal fade " id="submit_industrial" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">×</button>
    </div>
    <div class="modal-body text-center">
      <div class="">
        <div class="col-md-12">
          <img height="337px" width="100%" src="./E-Judiciary System_files/home_slide6.jpg" alt="">
          <p class="pull-left" style="font-size:16px; font-weight:bold;"><a href="http://52.172.145.30/site/conferenceFuture" class="btn btn-primary" target="_blank">Proposed Programme</a></p>
          <p class="pull-Right" style="font-size:16px; font-weight:bold;"><a href="http://52.172.145.30/themes/backend/Uttarakhand_Industrial_Summit_2019_Brochure.pdf" class="btn btn-primary" target="_blank">Download Brochure</a></p>
        </div>
      </div>
      <div class="clearfix"></div>
    </div>
    <!--<div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
    </div>-->
    </div>
  </div>
</div>
 </main>

    <footer>
        <div class='d-flex justify-content-start'>
            <div class="position-relative footerbox footerbg1 br-right">
                    <!-- <img src="<?php echo $basePath; ?>/assests/images/punjab_logo.png" class="footerlogo img-fluid"> -->
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
            <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <p >Copyright © 2023 Government of Punjab. All Rights Reserved.</p>
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

  $(".slick-slider").slick({
 slidesToShow: 3,
 infinite:false,
 slidesToScroll: 1,
 autoplay: true,
 autoplaySpeed: 2000
   // dots: false, Boolean
  // arrows: false, Boolean
});


// Image Slider Demo:
// https://codepen.io/vone8/pen/gOajmOo
    </script>

</body>

</html>
