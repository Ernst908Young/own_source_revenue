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
<?php
if($_SESSION['mobile_otp'] != "Yes" || $_SESSION['email_otp'] != "Yes")
{
?>


<div class="profile">
    <div class="row">
        <div class="col-md-9">

            <!--end row-->

            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-user-secret" style="font-size: 27px;"></i>Not Recived OTP ?</div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse"> </a>
                        <a href="javascript:;" class="remove"> </a>
                    </div>
                </div>
                <div class="portlet-body form">

                    <!--  <div id="error_msg" class="alert alert-danger"></div>-->

                    <div class="alert alert-danger" id="errormsg">
                        <button class="close" data-close="alert"></button> <p id="error_msg"> </p>
                    </div>

                    <!-- BEGIN FORM-->
                    <form class="form-horizontal" role="form" method="POST" id="OtpData" name="BoUserOtp" action="<?= Yii::app()->createAbsoluteUrl('Profile/ViewUpdate/notRecived'); ?>">
                        <div class="form-body">
                            <div class="alert alert-danger display-hide">
                                <button class="close" data-close="alert"></button> You have some form errors. Please check below. </div>
                            <div class="alert alert-success display-hide">
                                <button class="close" data-close="alert"></button> Your form validation is successful! </div>

                            <!--<h3 class="form-section">Verify your contacts</h3>-->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                    <?php if($_SESSION['mobile_otp'] != "Yes")
                                    {
                                    ?>

                                        <div class="col-md-6">
                                            <label class="checkbox-inline"><input class="checkbox" type="checkbox" name="Profile[mobile_otp]" value="Not Recived">Not recived OTP on Mobile [<?= $model['mobile']; ?>]</label>

                                        </div>
                                        <?php }?>
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-12">
                                    <div class="form-group">
                                     <?php if($_SESSION['email_otp'] != "Yes")
                                    {
                                    ?>

                                        <div class="col-md-6">
                                            <label class="checkbox-inline"><input type="checkbox" class="checkbox" name="Profile[email_otp]" value="Not Recived">Not recievd OTP on Email [<?= $model['email']; ?>]</label>

                                            <span class="help-block"></span>
                                        </div>
                                        <?php }?>
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                            <!--/row-->
                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-offset-3 col-md-9">
                                            <button type="button" id="otpSubmit" class="btn green">Submit</button>
                                           
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2"> <a href="<?= Yii::app()->createAbsoluteUrl('Profile/ViewUpdate/otp'); ?>" class="btn btn-primary">Resend OTP</a></div>
                                <div class="col-md-4"> <a href="<?= Yii::app()->createAbsoluteUrl('Profile/ViewUpdate/verify'); ?>" class="btn btn-warning">Verify OTP</a></div>
                            </div>
                        </div>
                    </form>
                    <!-- END FORM-->
                </div>
            </div>

        </div>
    </div>
</div>

<?php }

else
{

    echo " Your Mobile Number & Email Addressed Already Verified !!!!";
}


    ?>

<script src="<?= Yii::app()->theme->baseUrl ?>/assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="<?= Yii::app()->theme->baseUrl ?>/assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
<script type="text/javascript">
    $('document').ready(function () {
        $("#errormsg").hide();
        $("#otpSubmit").click(function () {
            checkrequired("submit form");
        });
        $(".checkbox").click(function () {
            checkrequired("just check");
        });
        function checkrequired(v) {
            $("#errormsg").hide();
            var checked = 0;
            $(".checkbox").each(function () {
                if ($(this).is(':checked')) {
                    checked = 1;
                    $(".errormsg").show();
                }
            });
            if (checked == 0) {
                $("#errormsg").show();
                $("#error_msg").html("Please select at leaset one");
                return false;
            } else {
                if (v == "submit form") {
                    $("#OtpData").submit();
                }
            }
        }
    });
</script>