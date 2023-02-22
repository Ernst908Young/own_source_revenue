<style>
    /* Page Level CSS : Rahul Kumar*/
    .errorMessage { color:red }
    .control-label{text-align: left !important;}
    #content{margin-top: -18px; }
    .red{color:red;}
    
    <?php
    // WITHOUT LOGIN [CHANGE 1]- EXTRA CODE
    if (empty($_SESSION['RESPONSE']['user_id'])) {
        ?>
        .page-sidebar.navbar-collapse.collapse {display: none !important;}   
        .page-content{margin-left:0px !important;}
        .col-md-1{width:12.50% !important;}
        .uppercase { font-size: 16px !important;
        }
    <?php } // WITHOUT LOGIN [CHANGE 1] - EXTRA CODE - ENDS HERE  ?>


</style>
    <?php
    // WITHOUT LOGIN [CHANGE 2]- EXTRA CODE
    if (empty($_SESSION['RESPONSE']['user_id'])) {
        ?>
    <div class="row">
        <div class="col-md-1" style="padding: 0px;">&nbsp;</div>
        <div class="col-md-10" style="padding: 0px;margin-left: -50px;">
    <?php } // WITHOUT LOGIN [CHANGE 2] - EXTRA CODE - ENDS HERE?>
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
            $requestedProperty = LandownerConnectEXT::isLandContactAvailable($_GET['landID']);

            $urlPostFix = "create/landID/$_GET[landID]";
            if (!empty($requestedProperty)) {
                $urlPostFix = "update/id/$_GET[landID]/landID/$_GET[landID]";
                $locationTab = "pinLocation/landID/$_GET[landID]";
            }
        } else {
            $locationTab = "pinLocation";
            $urlPostFix = "create";
        }
        ?>
        <div class='portlet box'>
            <div class="col-md-12" style="padding: 0px;">
                <div class="portlet light portlet-fit">
                    <div class="portlet-body" style="padding:10px">
                        <div class="mt-element-step">

                            <div class="row step-background-thin">   
                                <div class="col-md-4 bg-grey-steel mt-step-col active">
                                    <a href="<?php echo Yii::app()->createUrl('/iloc/landownerConnect/create'); ?>">
                                        <div class="mt-step-number">1</div>
                                        <div class="mt-step-title uppercase font-grey-cascade ">Land</div>
                                        <div class="mt-step-content font-grey-cascade">Fill your land details</div>
                                    </a>
                                </div>
                                <div class="col-md-4 bg-grey-steel mt-step-col ">
                                    <a href="<?php echo Yii::app()->createUrl("/iloc/landownerContact/$urlPostFix"); ?>">
                                        <div class="mt-step-number">2</div>
                                        <div class="mt-step-title uppercase font-grey-cascade">Contact</div>
                                        <div class="mt-step-content font-grey-cascade">Fill Contact Person Details</div>
                                    </a>
                                </div>
                                <div class="col-md-4 bg-grey-steel mt-step-col ">
                                    <a href="<?php echo Yii::app()->createUrl("iloc/landownerConnect/$locationTab"); ?>">
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
                        <i class="icon-map font-purple-soft"></i>
                        <span class="caption-subject font-purple-soft bold uppercase"> Land Detail Form</span>
                    </div>
                </div>
                
                <hr>

                <div class="site-min-height">
                    <div class="form form-horizontal" role="form">
                        <div class="form">
                            <?php
                            $form = $this->beginWidget('CActiveForm', array(
                                'id' => 'landowner-connect-form',
                                // Please note: When you enable ajax validation, make sure the corresponding
                                // controller action is handling ajax validation correctly.
                                // There is a call to performAjaxValidation() commented in generated controller code.
                                // See class documentation of CActiveForm for details on this.
                                'enableAjaxValidation' => true,
                                'clientOptions' => array('validateOnSubmit' => true, 'validateOnChange' => true),
                            ));
                            ?>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <div class="col-md-12">
                                        <label class="control-label">Property Type<span class="red"> *</span></label></div>
                                    <div class="col-md-12" style="padding-top: 4px;margin-bottom: -22px;">
                                        <div class="mt-checkbox-inline">
                                            <label class="mt-checkbox">
                                                <?php echo $form->checkBox($model, 'is_sale'); ?> Available for Sale
                                                    <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                <?php echo $form->checkBox($model, 'is_lease'); ?> Available for Lease
                                                <span></span>

                                            </label>
                                        </div>
                                    </div>

                                    <?php echo $form->error($model, 'is_sale'); ?>
                                    <?php echo $form->error($model, 'is_lease'); ?>
                                </div>
                                <div class="form-group col-md-6"></div>
                            </div>
                            
                            <div class="row">
                                <!--Add here land title-->
                                <div class="form-group col-md-6">

                                    <label class="col-md-12 control-label" for="land_title">Property Title<span class="red"> *</span></label>
                                    <div class="col-md-12">
                                        <?php echo $form->textField($model, 'land_title', array('class' => 'form-control')); ?>
                                        <?php echo $form->error($model, 'land_title'); ?>
                                    </div>

                                </div>

                                <div class="form-group col-md-6">
                                    <label class="col-md-12 control-label" for="">District<span class="red"> *</span></label>
                                    <div class="col-md-12">
                                        <select name="LandownerConnect[district_id]" class="form-control district" >
                                            <option value="">Select District</option>
                                            <?php $allList = LandownerConnectEXT::getMasterList('bo_district', 'district_id', 'distric_name'); ?>
                                            <?php foreach ($allList as $k => $v) { ?>
                                                <option value="<?php echo $k; ?>" <?php
                                                        if (!empty($model->district_id) && $model->district_id == $k) {
                                                            echo " selected";
                                                        }
                                                        ?>><?php echo $v; ?>
                                                </option>
                                        <?php } ?>
                                        </select>
                                        <?php echo $form->error($model, 'district_id'); ?>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="col-md-12 control-label" for="">Tehsil (Sub District)<span class="red"> *</span></label>
                                    <div class="col-md-12">
                                        <select name="LandownerConnect[sub_district_id]" class="form-control tehsil" >
                                            <option value="">Select Tehsil</option>
                                            <?php $allList = LandownerConnectEXT::getMasterList('lg_code_blocks', 'block_code', 'block_name'); ?>
                                                    <?php foreach ($allList as $k => $v) { ?>
                                                <option value="<?php echo $k; ?>" <?php
                                                    if (!empty($model->sub_district_id) && $model->sub_district_id == $k) {
                                                        echo " selected";
                                                    }
                                                    ?>><?php echo $v; ?></option>
                                            <?php } ?>
                                        </select><?php echo $form->error($model, 'sub_district_id'); ?>
                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    <label class="col-md-12 control-label" for="">Village<span class="red"> *</span></label>
                                    <div class="col-md-12">
                                        <select name="LandownerConnect[village]" class="form-control villages" >
                                            <option value="">Select Village</option>
                                            <?php $allList = LandownerConnectEXT::getMasterList('lg_code_villages', 'village_code', 'village_name'); ?>
                                            <?php
                                            $ii = 0;
                                            foreach ($allList as $k => $v) {
                                                if ($ii < 30) {
                                                    ?>
                                                    <option value="<?php echo $k; ?>" <?php
                                                if (!empty($model->village) && $model->village == $k) {
                                                    echo " selected";
                                                }
                                                ?>><?php echo $v; ?></option>
                                          <?php } $ii += 1;
                                            }
                                            ?>
                                        </select>
                                        <?php echo $form->error($model, 'village'); ?>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="col-md-12 control-label" for="">Address<span class="red"> *</span></label>
                                    <div class="col-md-12">
                                        <?php echo $form->textField($model, 'address', array('class' => 'form-control')); ?>
                                        <?php echo $form->error($model, 'address'); ?>
                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    <label class="col-md-12 control-label" for="">Khasra/ Khatauni<span class="red"> *</span></label>
                                    <div class="col-md-12">
                                    <?php echo $form->textField($model, 'keshra_khatian', array('class' => 'form-control')); ?>
                                    <?php echo $form->error($model, 'keshra_khatian'); ?>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="col-md-12 control-label" for="">Type of Land<span class="red"> *</span></label>

                                    <div class="col-md-12">
                                        <?php echo $form->dropDownList($model, 'type_of_land', array('' => 'Select Type of Land', 'Agricultural' => 'Agricultural', 'Industrial' => 'Industrial', 'Commercial' => 'Commercial', 'Residential' => 'Residential', 'Transportation' => 'Transportation', 'Institutional & Public Building' => 'Institutional & Public Building'), array('class' => 'form-control')); ?>
                                        <?php echo $form->error($model, 'type_of_land'); ?>
                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    <label class="col-md-12 control-label" for="">Distance from nearest Highway (in KM)<span class="red"> *</span></label>
                                    <div class="col-md-12">
                                        <?php echo $form->numberField($model, 'distance_highway', array('class' => 'form-control', 'placeholder' => 'eg: 10')); ?>
                                        <?php echo $form->error($model, 'distance_highway'); ?>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="col-md-12 control-label" for="">Name of nearest Highway<span class="red"> *</span></label>
                                    <div class="col-md-12">
                                        <?php echo $form->textField($model, 'name_highway', array('class' => 'form-control')); ?>
                                        <?php echo $form->error($model, 'name_highway'); ?>
                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    <label class="col-md-12 control-label" for="">Distance from nearest Airport (in KM)<span class="red"> *</span></label>
                                    <div class="col-md-12">
                                        <?php echo $form->numberField($model, 'distance_airport', array('class' => 'form-control', 'placeholder' => 'eg: 10')); ?>
                                        <?php echo $form->error($model, 'distance_airport'); ?>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="col-md-12 control-label" for="">Name of nearest Airport<span class="red"> *</span></label>
                                    <div class="col-md-12">
                                        <?php echo $form->textField($model, 'name_airport', array('class' => 'form-control')); ?>
                                        <?php echo $form->error($model, 'name_airport'); ?>
                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    <label class="col-md-12 control-label" for="">Distance from nearest Railway Station (in KM)<span class="red"> *</span></label>
                                    <div class="col-md-12">
                                        <?php echo $form->numberField($model, 'distance_railway', array('class' => 'form-control', 'placeholder' => 'eg: 10')); ?>
                                        <?php echo $form->error($model, 'distance_railway'); ?>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="col-md-12 control-label" for="">Name of nearest Railway Station<span class="red"> *</span></label>
                                    <div class="col-md-12">
                                        <?php echo $form->textField($model, 'name_railway', array('class' => 'form-control')); ?>
                                        <?php echo $form->error($model, 'name_railway'); ?>
                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    <label class="col-md-12 control-label" for="">Area in Sq. Mt.<span class="red"> *</span></label>
                                    <div class="col-md-12">
                                        <?php echo $form->numberField($model, 'area_sqmt', array('class' => 'form-control', 'required', 'placeholder' => 'eg: 1050')); ?>
                                        <?php echo $form->error($model, 'area_sqmt'); ?>
                                    </div>
                                </div>
                            </div>



                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="col-md-12 control-label" for="">Land Description <span class="red"> *</span></label>
                                    <div class="col-md-12">
                                        <?php echo $form->textArea($model, 'comment', array('class' => 'form-control')); ?>
                                        <?php echo $form->error($model, 'comment'); ?>
                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    <label class="col-md-12 control-label" for="">If any existing loan on property<span class="red"> *</span></label>
                                    <div class="col-md-12">
                                    <?php echo $form->dropDownList($model, 'existing_loan', array('N' => 'NO', 'Y' => 'YES'), array('class' => 'form-control')); ?>
                                    <?php echo $form->error($model, 'existing_loan'); ?>
                                    </div>
                                </div>
                                <div class="col-md-12 buttons" align="center">
                                        <?php echo CHtml::submitButton($model->isNewRecord ? 'Save and Proceed' : 'Update and Proceed', array('class' => 'btn btn-primary')); ?>
                                </div>
                              </div>
                             <?php $this->endWidget(); ?><!-- form -->

                        </div>
                    </div>
                </div>
            </div> 
        </div>
    <?php
    // WITHOUT LOGIN [CHANGE 3]- EXTRA CODE - STARTS HERE
    if (empty($_SESSION['RESPONSE']['user_id'])) {
        ?>
            </div><div class="col-md-1" style="padding: 0px;">&nbsp;</div></div>
    <?php } // WITHOUT LOGIN [CHANGE 3]- EXTRA CODE-  ENDS HERE  ?>
    <?php Yii::app()->getClientScript()->registerCoreScript('jquery'); ?>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC3VOcg0P61BSjOsA95rVHFFV_VbMLeS4w&callback=myMap"></script>

<script>
    $(document).ready(function () {
        $(".tehsil").on('change', function () {
            var tehsilValue = $(this).val();
            //alert(tehsilValue);
            $.ajax({
                type: "POST",
                url: "<?php echo Yii::app()->request->baseUrl; ?>/iloc/property/getVilagesOfTehsil/subDistCode/" + tehsilValue,
                success: function (result) {
                    //  alert(result);
                    $(".villages").html(result);
                }
            });
        });

        $(".district").on('change', function () {
            //alert("hi");
            var districtValue = $(this).val();
            $.ajax({
                type: "POST",
                url: "<?php echo Yii::app()->request->baseUrl; ?>/iloc/property/getTehsil/districtID/" + districtValue,
                success: function (result) {
                    $(".tehsil").html(result);
                }
            });
        });
    });
    
    $(window).load(function(){
                                       <?php if (!empty($model->district_id)) { ?> $(".district").val("<?php echo $model->district_id; ?>");  
                                        // Getting all Tehseel of selected district - Rahul Kumar - 01022018
                                      $.ajax({
                                                type: "POST",
                                                url: "<?php echo Yii::app()->request->baseUrl; ?>/iloc/property/getTehsil/districtID/" + <?php echo $model->district_id; ?>,
                                                success: function (result) {
                                                    $(".tehsil").html(result);
                                                    // Setting searched Tehsil as sellected in drop down- Rahul Kumar - 01022018
                                                     <?php if (!empty($model->sub_district_id)) { ?>   $(".tehsil").val("<?php echo $model->sub_district_id; ?>");
                                                      // Getting all Villages of selected Tehsil 
                                                      $.ajax({
                                                          type: "POST",
                                                          url: "<?php echo Yii::app()->request->baseUrl; ?>/iloc/property/getVilagesOfTehsil/subDistCode/<?php echo $model->sub_district_id; ?>",
                                                          success: function (result) {
                                                              $(".vilages").html(result);
                                                              // Setting searched Village as sellected in drop down- Rahul Kumar - 01022018
                                                               <?php if (!empty($model->village)) { ?>  $(".vilages").val("<?php echo $model->village; ?>"); <?php } ?>
                                                          }
                                                      });                                         
                                                      <?php } ?>
                                                }
                                            });                                  
                                    <?php } ?>                             
    });
</script>