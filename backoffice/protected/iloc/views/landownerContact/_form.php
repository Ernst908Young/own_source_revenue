<style>
    /* Page Level CSS : Rahul Kumar */
    .errorMessage { color:red }
    .control-label{text-align: left !important;}
    #content{margin-top: -38px; }
    <?php
    // WITHOUT LOGIN [CHANGE 1]- EXTRA CODE
    if (empty($_SESSION['RESPONSE']['user_id'])) {
        ?>
        .page-sidebar.navbar-collapse.collapse {display: none !important;}   
        .page-content{margin-left:0px !important;}
        .col-md-1{width:12.50% !important;}
        .uppercase { font-size: 16px !important;}
<?php } ?>

</style>
        <?php
        $requestedProperty = LandownerConnectEXT::isLandContactAvailable($_GET['landID']);
        $urlPostFix = "create/landID/$_GET[landID]";
        if (!empty($requestedProperty)) {
            $urlPostFix = "update/id/$_GET[landID]";
        }
        ?>
        <?php
        // WITHOUT LOGIN [CHANGE 2]- EXTRA CODE
        if (empty($_SESSION['RESPONSE']['user_id'])) {
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
                                    <a href="<?php echo Yii::app()->createUrl("/iloc/landownerConnect/update/id/$_GET[landID]"); ?>">
                                        <div class="mt-step-number">1</div>
                                        <div class="mt-step-title uppercase font-grey-cascade ">Land</div>
                                        <div class="mt-step-content font-grey-cascade">Fill your land details</div>
                                    </a>
                                </div>
                                <div class="col-md-4 bg-grey-steel mt-step-col active">
                                    <a href="<?php echo Yii::app()->createUrl("/iloc/landownerContact/$urlPostFix"); ?>">
                                        <div class="mt-step-number">2</div>
                                        <div class="mt-step-title uppercase font-grey-cascade">Contact</div> 
                                        <div class="mt-step-content font-grey-cascade">Fill Contact Person Details</div>
                                    </a>
                                </div>
                                <div class="col-md-4 bg-grey-steel mt-step-col ">
                                    <a href="<?php echo Yii::app()->createUrl("/iloc/landownerConnect/pinLocation/landID/$_GET[landID]"); ?>">
                                        <div class="mt-step-number">3</div>
                                        <div class="mt-step-title uppercase font-grey-cascade">Map</div>
                                        <div class="mt-step-content font-grey-cascade">Fill Map Details</div>
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
                                <label class="col-md-12 control-label" for="contact_type">You are publishing this land advertisement</label>
                                <div class="col-md-12">
                                    <?php echo $form->dropDownList($model, 'contact_type', array('Self' => 'Self', 'On behalf Of' => 'On behalf Of'), array('class' => 'form-control')); ?>
<?php echo $form->error($model, 'contact_type'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="col-md-12 control-label" for="owner_name">Owner Name</label>
                                <div class="col-md-12">
                                    <?php echo $form->textField($model, 'owner_name', array('size' => 60, 'maxlength' => 255, 'class' => 'form-control', 'required')); ?>
<?php echo $form->error($model, 'owner_name'); ?>
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label class="col-md-12 control-label" for="owner_contact_no">Owner Contact No.</label>
                                <div class="col-md-12">
                                    <?php echo $form->numberField($model, 'owner_contact_no', array('size' => 10, 'maxlength' => 10, 'class' => 'form-control', 'required')); ?>
<?php echo $form->error($model, 'owner_contact_no'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="row" >
                            <div class="form-group col-md-6">
                                <label class="col-md-12 control-label" for="owner_alternate_no">Owner Alternate No</label>
                                <div class="col-md-12">
                                    <?php echo $form->numberField($model, 'owner_alternate_no', array('size' => 10, 'maxlength' => 10, 'class' => 'form-control')); ?>
<?php echo $form->error($model, 'owner_alternate_no'); ?>
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label class="col-md-12 control-label" for="owner_email">Owner Email</label>
                                <div class="col-md-12">
                                    <?php echo $form->emailField($model, 'owner_email', array('size' => 60, 'maxlength' => 255, 'class' => 'form-control')); ?>
<?php echo $form->error($model, 'owner_email'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="row agent">
                            <div class="form-group col-md-6">
                                <label class="col-md-12 control-label" for="agent_name">Agent Name</label>
                                <div class="col-md-12">
                                    <?php echo $form->textField($model, 'agent_name', array('size' => 60, 'maxlength' => 255, 'class' => 'form-control')); ?>
<?php echo $form->error($model, 'agent_name'); ?>
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label class="col-md-12 control-label" for="agent_contact_no">Agent Contact no</label>
                                <div class="col-md-12">
                                    <?php echo $form->numberField($model, 'agent_contact_no', array('size' => 10, 'maxlength' => 10, 'class' => 'form-control')); ?>
<?php echo $form->error($model, 'agent_contact_no'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="row agent">
                            <div class="form-group col-md-6">
                                <label class="col-md-12 control-label" for="agent_alternate_no">Agent Alternate No</label>
                                <div class="col-md-12">
                                    <?php echo $form->numberField($model, 'agent_alternate_no', array('size' => 10, 'maxlength' => 10, 'class' => 'form-control')); ?>
<?php echo $form->error($model, 'agent_alternate_no'); ?>
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label class="col-md-12 control-label" for="agent_contact_no">Agent Email</label>
                                <div class="col-md-12">
                                    <?php echo $form->emailField($model, 'agent_email', array('size' => 60, 'maxlength' => 255, 'class' => 'form-control')); ?>
<?php echo $form->error($model, 'agent_email'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="row buttons" align="center">
<?php echo CHtml::submitButton($model->isNewRecord ? 'Save and Proceed' : 'Update and Proceed', array('class' => 'btn btn-primary')); ?>
                        </div>
<?php $this->endWidget(); ?>
                    </div><!-- form -->


                </div>
            </div>
        </div>

        <?php
        // WITHOUT LOGIN [CHANGE 3]- EXTRA CODE - STARTS HERE
        if (empty($_SESSION['RESPONSE']['user_id'])) {
            ?>
        </div><div class="col-md-1" style="padding: 0px;">&nbsp;</div></div>
<?php } // WITHOUT LOGIN [CHANGE 3]- EXTRA CODE-  ENDS HERE   ?>
<script>
    $(document).ready(function () {
        if ($("#BoLandownerContact_contact_type").val() == "Self") {
            $(".agent").css('display', 'none');
        }
        $("#BoLandownerContact_contact_type").change(function () {
            if ($(this).val() == "On behalf Of") {
                $(".agent").css('display', 'block');
            } else {
                $(".agent").css('display', 'none');
            }
        });
    });
</script>