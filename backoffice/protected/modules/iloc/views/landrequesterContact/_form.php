<style>
    /* Page Level CSS : Rahul Kumar */
    .errorMessage { color:red }
    /* Page Level CSS : Rahul Kumar*/
    .red { color:red }
    .control-label{text-align: left !important;}
    #content{margin-top: -38px; }
    <?php
    // WITHOUT LOGIN [CHANGE 1]- EXTRA CODE
    if (empty($_SESSION['RESPONSE']['user_id']) && empty($_SESSION['uid'])){
        ?>
        .page-sidebar.navbar-collapse.collapse {display: none !important;}
        .page-content{margin-left:0px !important;}
        .col-md-1{width:12.50% !important;}
        .uppercase { font-size: 16px !important;}
<?php } ?>
.step2_btn{
   margin: 0px 0px 0px 460px;
}

</style>
        <?php
       //setting Land Id as null in case of add form
       if (empty($_GET['landID'])) {
           $_GET['landID'] = "";
       }
       //setting Land Id as null in case of edit form
       if (!empty($_GET['id'])) {
           $_GET['landID'] = $_GET['id'];
       }
           //In Case of Edit Land Detail

       if ($_GET['landID'] != "") {
           $requestedProperty = LandownerConnectEXT::isLandRequesterContactAvailable($_GET['landID']);
          // echo "<pre/>";
           //print_r($requestedProperty);die;

           $urlPostFix = "create/landID/$_GET[landID]";
           if (!empty($requestedProperty)) {
               $urlPostFix = "update/id/$_GET[landID]/landID/$_GET[landID]";

           }
       } else {
           $urlPostFix = "create";
       }
       ?>
        <?php
        // WITHOUT LOGIN [CHANGE 2]- EXTRA CODE
        if (empty($_SESSION['RESPONSE']['user_id']) && empty($_SESSION['uid'])){
            ?>
            <div class="row">
                <div class="col-md-1" style="padding: 0px;">&nbsp;</div>
                <div class="col-md-10" style="padding: 0px;margin-left: -50px;">
        <?php } // WITHOUT LOGIN [CHANGE 2] - EXTRA CODE - ENDS HERE  ?>
        <div class='portlet box'>
            <div class="col-md-12" style="padding: 0px;">
                <div class="portlet light portlet-fit">

                    <div class="portlet-body" style="padding:10px">
                        <div class="mt-element-step">

                            <div class="row step-background-thin">
                                <div class="col-md-4 bg-grey-steel mt-step-col ">
                                    <a href="<?php echo Yii::app()->createUrl("/iloc/landrequesterConnect/$urlPostFix"); ?>">
                                        <div class="mt-step-number">1</div>
                                        <div class="mt-step-title uppercase font-grey-cascade ">Land</div>
                                        <div class="mt-step-content font-grey-cascade">Fill your land details</div>
                                    </a>
                                </div>
                                <div class="col-md-4 bg-grey-steel mt-step-col active">
                                    <a href="<?php echo Yii::app()->createUrl("/iloc/landrequesterContact/$urlPostFix"); ?>">
                                        <div class="mt-step-number">2</div>
                                        <div class="mt-step-title uppercase font-grey-cascade">Contact </div>
                                        <div class="mt-step-content font-grey-cascade">Fill Contact Person Details</div>
                                    </a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>

            <div class="portlet-body">
                <div class="portlet-title" style="">
                    <div class="caption">
                        <i class="icon-user font-purple-soft"></i>
                        <span class="caption-subject font-purple-soft bold uppercase">Contact Detail Form

                    </div>
                    <hr>

                    <div class="form">

                        <?php
                        $landID = $_GET['landID'];
                        $form = $this->beginWidget('CActiveForm', array(
                            'id' => 'bo-landowner-contact-form',
                            // Please note: When you enable ajax validation, make sure the corresponding
                            // controller action is handling ajax validation correctly.
                            // There is a call to performAjaxValidation() commented in generated controller code.
                            // See class documentation of CActiveForm for details on this.
                            'enableAjaxValidation' => true,
                        ));

                        ?>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="col-md-12 control-label" for="contact_type">You are requesting this information</label>
                                <div class="col-md-12">
                                    <?php echo $form->dropDownList($model, 'contact_type', array('Self' => 'Self', 'On behalf Of' => 'On behalf Of'), array('class' => 'form-control','value'=>(isset($_SESSION['BoLandrequesterContact']['contact_type']) && !empty($_SESSION['BoLandrequesterContact']['contact_type']))?$_SESSION['BoLandrequesterContact']['contact_type']:$model->contact_type)); ?>
                                    <?php echo $form->error($model, 'contact_type'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="col-md-12 control-label" for="owner_name">Requester Name <span class="red"> *</span></label>
                                <div class="col-md-12">
                                    <?php echo $form->textField($model, 'requester_name', array('size' => 60, 'maxlength' => 255, 'class' => 'form-control', 'required','value'=>(isset($_SESSION['BoLandrequesterContact']['requester_name']) && !empty($_SESSION['BoLandrequesterContact']['requester_name']))?$_SESSION['BoLandrequesterContact']['requester_name']:$model->requester_name)); ?>
                                    <?php echo $form->error($model, 'requester_name'); ?>
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label class="col-md-12 control-label" for="requester_contact_no">Requester Contact No. <span class="red"> *</span></label>
                                <div class="col-md-12">
                                    <?php echo $form->numberField($model, 'requester_contact_no', array('size' => 10, 'maxlength' => 10, 'class' => 'form-control', 'required','value'=>(isset($_SESSION['BoLandrequesterContact']['requester_contact_no']) && !empty($_SESSION['BoLandrequesterContact']['requester_contact_no']))?$_SESSION['BoLandrequesterContact']['requester_contact_no']:$model->requester_contact_no)); ?>
                                    <?php echo $form->error($model, 'requester_contact_no'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="row" >
                            <div class="form-group col-md-6">
                                <label class="col-md-12 control-label" for="owner_alternate_no">Requester Alternate No</label>
                                <div class="col-md-12">
                                    <?php echo $form->numberField($model, 'requester_alternate_no', array('size' => 10, 'maxlength' => 10, 'class' => 'form-control','value'=>(isset($_SESSION['BoLandrequesterContact']['requester_alternate_no']) && !empty($_SESSION['BoLandrequesterContact']['requester_alternate_no']))?$_SESSION['BoLandrequesterContact']['requester_alternate_no']:$model->requester_alternate_no)); ?>
                                    <?php echo $form->error($model, 'requester_alternate_no'); ?>
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label class="col-md-12 control-label" for="owner_email">Requester Email</label>
                                <div class="col-md-12">
                                    <?php echo $form->emailField($model, 'requester_email', array('size' => 60, 'maxlength' => 255, 'class' => 'form-control','value'=>(isset($_SESSION['BoLandrequesterContact']['requester_email']) && !empty($_SESSION['BoLandrequesterContact']['requester_email']))?$_SESSION['BoLandrequesterContact']['requester_email']:$model->requester_email)); ?>
                                    <?php echo $form->error($model, 'requester_email'); ?>
                                </div>
                            </div>
                        </div>

                        <div class="row agent">
                            <div class="form-group col-md-6">
                                <label class="col-md-12 control-label" for="agent_name">Facilitator Name</label>
                                <div class="col-md-12">
                                    <?php echo $form->textField($model, 'agent_name', array('size' => 60, 'maxlength' => 255, 'class' => 'form-control')); ?>
<?php echo $form->error($model, 'agent_name'); ?>
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label class="col-md-12 control-label" for="agent_contact_no">Facilitator Contact no</label>
                                <div class="col-md-12">
                                    <?php echo $form->numberField($model, 'agent_contact_no', array('size' => 10, 'maxlength' => 10, 'class' => 'form-control')); ?>
<?php echo $form->error($model, 'agent_contact_no'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="row agent">
                            <div class="form-group col-md-6">
                                <label class="col-md-12 control-label" for="agent_alternate_no">Facilitator Alternate No</label>
                                <div class="col-md-12">
                                    <?php echo $form->numberField($model, 'agent_alternate_no', array('size' => 10, 'maxlength' => 10, 'class' => 'form-control')); ?>
                                    <?php echo $form->error($model, 'agent_alternate_no'); ?>
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label class="col-md-12 control-label" for="agent_contact_no">Facilitator Email</label>
                                <div class="col-md-12">
                                    <?php echo $form->emailField($model, 'agent_email', array('size' => 60, 'maxlength' => 255, 'class' => 'form-control')); ?>
                                    <?php echo $form->error($model, 'agent_email'); ?>
                                </div>
                            </div>
                        </div>


                        <div class="row buttons">
                          <div class="col-md-6  buttons" align="center">
                                 <a href="<?php echo Yii::app()->createUrl("/iloc/landrequesterConnect/update/id/$_GET[landID]/landID/$_GET[landID]"); ?>" class="btn btn-primary step2_btn"> <i class="m-icon-swapleft"></i> Back </a>

                          </div>
                          <?php  if(!empty($_SESSION['RESPONSE']['user_id']) || !empty($_SESSION['land_user_id'])){ ?>
                            <div class="col-md-6 buttons" align="center">
                                <input type="submit" class="btn btn-primary pull-left" value="Submit">
                            </div>
                          <?php }else{ ?>
                         <?php  if(!empty($_SESSION['uid'])){ ?>
                           <div class="col-md-6 buttons">
                            <input type="submit" class="btn btn-primary pull-left" value="Submit">
                          </div>
                        <?php }else{ ?>
                         <div class="col-md-6 buttons">
                          <!--<input type="submit" class="btn btn-success pull-right" value="Submit">-->
                          <input type="button" class="btn btn-primary guestLogin pull-left" id="guestLogin1" value="Submit" data-toggle="modal" data-target="#guestLogin">
                        </div>
                          <?php } }?>


                        </div>

                     <?php $this->endWidget(); ?>
                    </div><!-- form -->

                </div>
            </div>
        </div>

        <?php
        // WITHOUT LOGIN [CHANGE 3]- EXTRA CODE - STARTS HERE
        if (empty($_SESSION['RESPONSE']['user_id']) && empty($_SESSION['uid'])){
            ?>
        </div><div class="col-md-1" style="padding: 0px;">&nbsp;</div></div>
<?php } // WITHOUT LOGIN [CHANGE 3]- EXTRA CODE-  ENDS HERE   ?>
<script>
    $(document).ready(function () {
        if ($("#BoLandrequesterContact_contact_type").val() == "Self") {
            $(".agent").css('display', 'none');
        }
        $("#BoLandrequesterContact_contact_type").change(function () {
            if ($(this).val() == "On behalf Of") {
                $(".agent").css('display', 'block');
            } else {
                $(".agent").css('display', 'none');
            }
        });
    });
</script>

<script>
// Added by Rahul Kumar : 29012018
$(document).ready(function(){
//  alert("h");

  $('#guestLogin1').click(function(){

       var mobileNumber = ("#BoLandrequesterContact_requester_contact_no").val();

        $("#mobileNumber").val(mobileNumber);
  });


 $('.verifymobilenumber').click(function(){
    // alert("hi");
     var hideit=$(this).attr('hideit');
     var showit=$(this).attr('showit');
     $("#"+hideit).css('display','none');
     $("#"+showit).css('display','block');

     $.ajax({
     type: "POST",
     url: "<?php echo Yii::app()->request->baseUrl; ?>/iloc/property/sentOtp/mobileNumber/"+$("#mobileNumber").val() ,
     success: function (result) {
         if(result==true){
          } else{

             }
     }
 });

 });

 $('.verifyOtp').click(function(){
     $.ajax({
     type: "POST",
     url: "<?php echo Yii::app()->request->baseUrl; ?>/iloc/property/verifyOtp/otp/"+$("#OTP").val()+"/mobileNumber/"+$("#mobileNumber").val(),
     success: function (result) {
         if(result=="Otp Verified"){
            //location.reload();
            $("#landAdSetting").submit();
           }else{
              alert(result);
           }
     }
 });

 });


});
</script>`

<script>
// Added by Rahul Kumar : 06022018
$(document).ready(function(){
//  alert("h");
 $('.verifymobilenumber').click(function(){
    // alert("hi");
     var hideit=$(this).attr('hideit');
     var showit=$(this).attr('showit');
     $("#"+hideit).css('display','none');
     $("#"+showit).css('display','block');


     $.ajax({
     type: "POST",
     url: "<?php echo Yii::app()->request->baseUrl; ?>/iloc/property/sentOtp/mobileNumber/"+$("#mobileNumber").val() ,
     success: function (result) {
         if(result==true){
          } else{

             }
     }
 });

 });



 $('.verifyOtp').click(function(){
     $.ajax({
     type: "POST",
     url: "<?php echo Yii::app()->request->baseUrl; ?>/iloc/property/verifyOtp/otp/"+$("#OTP").val()+"/mobileNumber/"+$("#mobileNumber").val(),
     success: function (result) {
         if(result=="Otp Verified"){
            //location.reload();
               $("#bo-landowner-contact-form").submit();
           }else{
              alert(result);
           }
     }
 });

 });


});
</script>

<!-- Added By Jitendra Kumar singh  -->
<!-- Modal -->
<div id="guestLogin" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" style="color:red"><i class="fa fa-desktop"></i> Verify Your Mobile Number</h4>
            </div>
            <form method="POST" id="mobilenumberform" >
                <div class="modal-body">
                    <div class="content">
                            <!-- BEGIN VERIFY MOBILE FORM // 27012018-->
                            <p>
                                Verify your mobile number to view land owner's Contact Info / Express Interest Or Report
                            </p>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <div class="input-icon">
                                        <i class="fa fa-mobile"></i>
                                        <input name="lID" type="hidden" value="<?php echo $_GET['landID'] ?>" >
                                        <input class="form-control placeholder-no-fix" autocomplete="off" placeholder="Enter Mobile Number" name="mobile_number" id="mobileNumber" type="number">
                                    </div>
                                </div>
                            </div>
                            <!-- END Verify Mobile Number FORM // 27012018 -->
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="form-actions">
                        <button type="button" id="back-btn" class="btn" data-dismiss="modal">
                            <i class="m-icon-swapleft"></i> Back </button>
                        <button type="button" class="btn green-haze pull-right verifymobilenumber" hideit="mobilenumberform" showit="otpform">
                            Send OTP <i class="m-icon-swapright m-icon-white"></i>
                        </button>
                    </div>
                </div>
            </form>
                        <!-- OTP FORM STARTS HERE -->
                        <form  id="otpform"  method="POST" style="display:none;">
                <div class="modal-body">
                    <div class="content">

                        <!-- BEGIN VERIFY MOBILE FORM // 27012018-->

                            <p>
                                Please enter otp sent on your mobile number
                            </p>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <div class="input-icon">
                                        <i class="fa fa-mobile"></i>
                                        <input name="lID" type="hidden" value="<?php echo $_GET['landID'] ?>" >
                                        <input class="form-control placeholder-no-fix" autocomplete="off" placeholder="Enter OTP" name="mobile_number" id="OTP" type="number">
                                    </div>
                                </div>
                            </div>
                            <!-- END Verify Mobile Number FORM // 27012018 -->
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="form-actions">
                        <button type="button" id="back-btn" class="btn verifymobilenumber" hideit="otpform" showit="mobilenumberform">
                            <i class="m-icon-swapleft"></i> Resend OTP </button>
                        <button type="button"  class="btn green-haze pull-right verifyOtp">
                            Verify OTP <i class="m-icon-swapright m-icon-white"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>
