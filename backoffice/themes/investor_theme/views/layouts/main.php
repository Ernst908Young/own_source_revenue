<!DOCTYPE html>
<?php  $basePath="/panchayatiraj/themes/investuk"; ?> 
<html dir="ltr" lang="en-US">

<?php 
    if(isset(Yii::app()->session['uid']) || @$_SESSION['RESPONSE']['user_id'] || @$_SESSION['RESPONSE']['agent_user_id'] || @$_SESSION['RESPONSE']['subuser_user_id'])
        {
            
        }else{
          $this->redirect(Yii::app()->createAbsoluteUrl("../sso/account/signin"));
        }
?>

<head>
    
    <meta charset="UTF-8" />
    <meta name="HandheldFriendly" content="true">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="<?php echo $basePath; ?>/assets/applicant/css/all.css" rel="stylesheet" type="text/css">  
   <link href="<?php echo $basePath; ?>/assets/applicant/css/bootstrap.min.css" rel="stylesheet" type="text/css">
   <link href="<?php echo $basePath; ?>/assets/applicant/css/main-style.css" rel="stylesheet" type="text/css">
   <link href="<?php echo $basePath; ?>/assets/applicant/css/responsive.css" rel="stylesheet" type="text/css">
   
   

   <!--old js and css add in this theme-->
  
   
   <!--  <link href="<1?php echo $basePath;?>/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"> -->
 
    <!-- END GLOBAL MANDATORY STYLES -->  
   
</head>

  
<body>

       <script type="text/javascript" src="<?php echo $basePath; ?>/assets/applicant/js/jquery.min.js"></script> 
    <!--    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
 -->
    <div class="Dashboard-wrapper">
        <div class="dashborad-inner">
            <div class="row m-0">
                <?php if(isset($_SESSION['role_id'])){ ?>
                        <?php if($_SESSION['role_id']==63){?>
                            <div class="col-lg-3 p-0 col-left position-relative">
                                <?php  require_once('applicant/infowiz_leftmenu.php'); ?>
                            </div>
                        <?php }else{ ?>
                        <div class="col-lg-3 p-0 col-left position-relative">
                                <?php  require_once('applicant/bo_leftmenu.php'); ?>
                            </div>
                <?php } ?>
                            <div class="col-lg-7 p-0 col-right">
                                <div class="dashboard-conetnt">
                                    <?php  require_once('applicant/bo_header.php'); ?> 
                                     <?php echo $content; ?>
                                     <!--?php print_r($_SESSION) ?-->
                                </div>
                            </div>
              <?php  }else{ ?>
                <div class="col-lg-3 p-0 col-left position-relative">
                    <?php  
                    if(@$_SESSION['RESPONSE']['user_type']=='2' || @$_SESSION['RESPONSE']['user_type']=='3'){
                         require_once('applicant/agent_leftmenu.php'); 
                    }else{
                         require_once('applicant/leftmenu.php'); 
                    }
                   ?>
                </div>
                <div class="col-lg-7 p-0 col-right">
                    <div class="dashboard-conetnt">
                    <?php 
                    if(@$_SESSION['RESPONSE']['user_type']=='2' || @$_SESSION['RESPONSE']['user_type']=='3'){ 

                         require_once('applicant/agent_header.php');

                         if(@$_SESSION['individualuser_id']){
                            $induserdetail = Yii::app()->db->createCommand("SELECT * FROM sso_profiles WHERE user_id=".$_SESSION['individualuser_id'])->queryRow();
                            if(@$_SESSION['individualuser_company_id']){
                                if($_SESSION['individualuser_company_id']>0)
                             $ind_company = Yii::app()->db->createCommand("SELECT * FROM bo_company_details WHERE id=".$_SESSION['individualuser_company_id'])->queryRow();
                            }

                        ?>
                         <script type="text/javascript">
                             window.onscroll = function() {scrollfunction(); };
                            </script>
                            <div id="indi_user_btn" style="display: block;
                                        position: fixed;
                                        top: 90px;
                                        left: 360px;
                                        z-index: 99;
                                        border: none;
                                        outline: none;
                                        background-color: #ef7b20;
                                        color: white;
                                        cursor: pointer;
                                        padding: 7px;                                 
                                        font-size: 14px;">
                      
                                <i class="fa fa-industry"></i>
                                <!--?=  $induserdetail['first_name'].' '. $induserdetail['last_name'].' '. $induserdetail['surname']  ?--> 
                                <?= isset($ind_company) ? ($ind_company['company_name']) : ""?>
                            </div>
                            <?php  } ?>
                       
                   <?php }else{
                         require_once('applicant/header.php');
                    }
               ?> 
                       

                        <?php echo $content; ?>
                    </div>
                </div>
                 <?php } ?>
            </div>
        </div>
    </div>
    
</body>    


    <script type="text/javascript" src="<?php echo $basePath; ?>/assets/applicant/js/all.js"></script>
    <script type="text/javascript" src="<?php echo $basePath; ?>/assets/applicant/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo $basePath; ?>/assets/applicant/js/jquery-ui.js"></script>
 <!--   <script type="text/javascript" src="<1?php echo $basePath; ?>/assets/applicant/js/custome.js"></script>
     -->

     <div id="loading" style="display:none">
       <img id="loading_img" src="/backoffice/themes/investor_theme/img/loader.svg" alt="altername name">
     </div>

<!-- <script src="../../Scripts/jquery-1.5.1.min.js" type="text/javascript"></script> -->
<script>
    $(function () {
        var loading = $("#loading");
        $(document).ajaxStart(function () {
            loading.show();
        });

        $(document).ajaxStop(function () {
            loading.hide();
        });

        /*$("#startAjaxRequest").click(function () {
            $.ajax({
                url: "http://www.google.com",
                // ... 
            });
        });*/
    });
</script>

<!-- <button id="startAjaxRequest">Start</button> -->

 <script>  
        $(document).ready(function(){  
           /* $(".user-name").click(function(){  
                $(".dropbox").toggleClass("dropshow");
            }); */ 
             $(".user-name1").click(function(){  
                $(".dropbox").toggleClass("dropshow");
            });  
                $(".submenu").click(function(){  
                $(".submenulist").toggleClass("dropshow");
            });  
        });  
        </script>  
    <script type="text/javascript">


        
        $(document).ready(function(){         

            $('.toggle-click').click(function(){

                $(this).parent().toggleClass('active');
                $(this).parent().next().slideToggle(300);

            });

            $('.toggle-icon').click(function(){
                $('body').addClass('open-sidebar');
                $('.col-left').addClass('active-sidebar');
                $(this).addClass('active');
            });

            $('.close-toggle').click(function(){
                $('body').removeClass('open-sidebar');
                $('.col-left').removeClass('active-sidebar');
                $(this).removeClass('active');
            });



        });

       
function scrollfunction(){
 if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
       document.getElementById("indi_user_btn").style.top = "10px";
 }else{ 
     document.getElementById("indi_user_btn").style.top = "90px";
 }
}
    </script>


</html>