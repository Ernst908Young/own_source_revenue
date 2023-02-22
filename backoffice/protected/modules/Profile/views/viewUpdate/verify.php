<link href="<?= Yii::app()->theme->baseUrl ?>/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />

<link href="<?= Yii::app()->theme->baseUrl ?>/assets/pages/css/profile-2.min.css" rel="stylesheet" type="text/css" />

<style type="text/css">

    @media (min-width: 750px){

        .pic-bordered {

            width: 278px;

            height: 263px;

        }

    }

</style>

<div class="page-bar">

    <ul class="page-breadcrumb">

        <li>

            <a href="index.html">Home</a>

            <i class="fa fa-circle"></i>

        </li>

        <li>

            <span>User</span>

        </li>

    </ul>

</div>

<small>&nbsp;</small>

</h1>

<div class="profile">

    <div class="row">

        <div class="col-md-9">



            <!--end row-->

            <div class="portlet box green">

                <div class="portlet-title">

                    <div class="caption">

                        <i class="fa fa-user-secret" style="font-size: 27px;"></i>Confirm your OTP</div>

                    <div class="tools">

                        <a href="javascript:;" class="collapse"> </a>

                        <a href="javascript:;" class="remove"> </a>

                    </div>

                </div>

                <div class="portlet-body form">

                    <div class="alert alert-danger" id="errormsg">

                        <button class="close" data-close="alert"></button> <p id="error_msg"> </p>

                    </div>

                    <!-- BEGIN FORM-->

                    <form class="form-horizontal" role="form" method="POST" id="otpVerify" action="<?= Yii::app()->createAbsoluteUrl('Profile/ViewUpdate/verify'); ?>">

                        <div class="form-body">

                            <div class="alert alert-danger display-hide">

                                <button class="close" data-close="alert"></button> You have some form errors. Please check below. </div>

                            <div class="alert alert-success display-hide">

                                <button class="close" data-close="alert"></button> Your form validation is successful! </div>



                            <!--<h3 class="form-section">Verify your contacts</h3>-->

                            <div class="row">

                               <?php if((isset($_SESSION['mobile_otp'])) && $_SESSION['mobile_otp']!="Yes"){ ?>

                                <div class="col-md-12">

                                    <div class="form-group">

                                        <label class="control-label col-md-3">Mobile</label>

                                        <div class="col-md-6">

                                            <input type="number" class="form-control" id="mobile_otp" min="6" max="7" autocomplete="off" required name="Profile[mobile_otp]" placeholder="Enter Mobile OTP">

                                            <span class="help-block moberror" style="color:red;"></span>

                                        </div>

                                    </div>

                                </div>

                               <?php } ?>

                                <!--/span-->

                                    <?php if((isset($_SESSION['email_otp'])) && $_SESSION['email_otp']!="Yes"){ ?>                                

                                <div class="col-md-12">

                                    <div class="form-group">

                                        <label class="control-label col-md-3">Email</label>

                                        <div class="col-md-6">

                                            <input type="number" class="form-control" id="email_otp" min="6" max="7" required name="Profile[email_otp]" placeholder="Enter Email OTP"  >

                                            <span class="help-block emailerror" style="color:red;"></span>

                                        </div>

                                    </div>

                                </div>

                                <?php } ?>

                                <!--/span-->

                            </div>

                            <!--/row-->

                        </div>

                        <div class="form-actions">

                            <div class="row">

                                <div class="col-md-6">

                                    <div class="row">

                                        <div class="col-md-offset-3 col-md-9">

                                            <button type="button" id="otpSubmit" class="btn green">Verify Mobile Number / Email Id</button>

                                        </div>

                                    </div>

                                </div>

                                <div class="col-md-2"> <a href="<?= Yii::app()->createAbsoluteUrl('Profile/ViewUpdate/otp'); ?>" class="btn btn-primary">Resend OTP</a></div>

                                <div class="col-md-4"> <a href="<?= Yii::app()->createAbsoluteUrl('Profile/ViewUpdate/notRecived'); ?>" class="btn btn-warning">Not Recived OTP</a></div>

                            </div>

                        </div>

                    </form>

                    <!-- END FORM-->

                </div>

            </div>



        </div>

    </div>

</div>

<script src="<?= Yii::app()->theme->baseUrl ?>/assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>

<script src="<?= Yii::app()->theme->baseUrl ?>/assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>



<script>

    $(window).load(function(){



            $("#errormsg").hide();

            

            $("#otpSubmit").click(function(){

            checkOtp("Submit Form");

           

            });

           if($('#email_otp').length){  

            $("#email_otp").on("change keyup blur", function(){

                $(".help-block").html("");

            checkOtp("Just Check");

            return false;

            });

        }

         if($('#mobile_otp').length){

            $("#mobile_otp").on("change keyup blur", function(){

                $(".help-block").html("");

            checkOtp("Just Check");

            return false;

            });

        }

    });

    

    function checkOtp(v){



//alert("==");

    $("#errormsg").hide();

    var submitForm = 0;

    if($('#mobile_otp').length){

    if ($('#mobile_otp').val() != "" &&  $('#mobile_otp').val().length==6){

              $(".moberror").html("");   

    submitForm = 1;

    }else{

      

        if($('#mobile_otp').val()!=""){

        $(".moberror").html("Please enter 6 number");   

      //  return false;

    }

        

    }

    }

    if (submitForm == 0){

 if($('#email_otp').length){

    if ($('#email_otp').val() != "" && $('#email_otp').val().length==6){

    submitForm = 1;

    }else{

        if($('#email_otp').val() != ""){

              $(".emailerror").html("Please enter 6 number");   

    //   $("#error_msg").html("Please enter 6 number"); 

       //return false;

   }

    }

    }

    }

    if (submitForm == 1 && v== "Submit Form"){

    $("#otpVerify").submit();

    } else if(v="Just Check" && submitForm == 1){

         $("#errormsg").hide();

    $("#error_msg").html("Please enter Mobile OTP or Email OTP");

    }else{

    $("#errormsg").show();

    $("#error_msg").html("Please enter Mobile OTP or Email OTP");

    return false;

    }

    }





</script>