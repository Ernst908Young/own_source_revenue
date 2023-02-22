<?php //print_r($_SESSION['uid']);  die;?>

<style>
    /* Page Level CSS : Rahul Kumar*/
    .errorMessage { color:red }
    .control-label{text-align: left !important;}
    #content{margin-top: -18px; }
    .red{color:red;}
    .step1_btn{
        margin: 10px !important;
      }
	  .mt-step-col{
		  
	  }

    <?php
    // WITHOUT LOGIN [CHANGE 1]- EXTRA CODE
    if (empty($_SESSION['RESPONSE']['user_id']) && empty($_SESSION['uid'])) {
        ?>
        .page-sidebar.navbar-collapse.collapse {display: none !important;}
        .page-content{margin-left:0px !important;}
        .col-md-1{width:12.50% !important;}
        .uppercase { font-size: 16px !important;
        }
    <?php } // WITHOUT LOGIN [CHANGE 1] - EXTRA CODE - ENDS HERE  ?>


</style>
<br><br><?php if (!empty($_SESSION['RESPONSE']['user_id'])) {  ?>
			            <div class="page-bar">
			                <div class="col-md-8">
                    <ul class="page-breadcrumb">
                        <li>
                            <span class="pull-left"><a href="/backoffice/frontuser/home/investorWalkthrough" title="Go to Dashboard : Level 1" class="fa fa-home homeredirect" ></a><b> <?php 
																if(!empty(@$_SESSION['RESPONSE']['user_id']) || (isset($_GET['panel']) && $_GET['panel'] = 'investor')) {
																	echo "Add Land Details";
																}
																elseif(isset($iuid) && $iuid != ''){																	
																	echo " Details of IUID - ".$iuid ;
																}else{
																	echo "Add Land Details";
																}?> 
                                </b></span> 
                        </li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <span class="pull-right" style="margin-top:5px;"><a href="/backoffice/frontuser/home/investorWalkthroughLevel2/type/<?php echo @$_GET['type']; ?>/financial_year/<?php echo @$_GET['financial_year'] ?>" class="btn btn-success"><i class="fa fa-arrow-left"></i>&nbsp; Back</a></span>
                    </div>
				
		</div>	
<?php } ?>
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

   if (!empty($requestedProperty)) {
       $urlPostFix = "update/id/$_GET[landID]";
   }else{
       $urlPostFix = "create/landID/$_GET[landID]";
   }

} else {
   $urlPostFix = "create";
}
//echo $urlPostFix ;die;
// $urlPostFix = "create/landID/$_GET[landID]";
?>
    <?php
    // WITHOUT LOGIN [CHANGE 2]- EXTRA CODE
    if (empty($_SESSION['RESPONSE']['user_id']) && empty($_SESSION['uid'])) {
        ?>
    <div class="row">
        <div class="col-md-1" style="padding: 0px;">&nbsp;</div>
        <div class="col-md-10" style="padding: 0px;margin-left: -50px;">
    <?php } // WITHOUT LOGIN [CHANGE 2] - EXTRA CODE - ENDS HERE?>
       
	   <?php
	          /* Author:Pankaj Kumar Tiwari
			     Date:16Feb2018  */  
	   
		
		
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
             }
        } else {
            $urlPostFix = "create";
        }
		
		/*------------------------------*/
		
        ?>
		
		
		
		
        <div class='portlet box'>
            <div class="col-md-12" style="padding: 0px;">
                <div class="portlet light portlet-fit">
                    <div class="portlet-body" style="padding:10px">
                        <div class="mt-element-step">

                            <div class="row step-background-thin">
                                <div class="col-md-6 bg-grey-steel mt-step-col active">
                                    <a href="<?php echo Yii::app()->createUrl("/iloc/landrequesterConnect/$urlPostFix"); ?>">
                                        <div class="mt-step-number">1</div>
                                        <div class="mt-step-title uppercase font-grey-cascade ">Land</div>
                                        <div class="mt-step-content font-grey-cascade">Fill your land details</div>
                                    </a>
                                </div>
                                <div class="col-md-6 bg-grey-steel mt-step-col ">
                                    <a href="<?php echo Yii::app()->createUrl("/iloc/landrequesterContact/$urlPostFix"); ?>">
                                        <div class="mt-step-number">2</div>
                                        <div class="mt-step-title uppercase font-grey-cascade">Contact</div>
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
                                    <label class="control-label">Property Type</label></div>
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
                                    <label class="col-md-12 control-label" for="">District<span class="red"> *</span></label>
                                    <div class="col-md-12">
                                        <select name="LandrequesterConnect[district_id]" class="form-control district" required>
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
                                    <div class="form-group col-md-6">
                                        <label class="col-md-12 control-label" for="">Tehsil (Sub District) </label>
                                        <div class="col-md-12">
                                            <select name="LandrequesterConnect[sub_district_id]" class="form-control tehsil">
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

                            </div>

                            <div class="row">

                                <div class="form-group col-md-6">
                                    <label class="col-md-12 control-label" for="">Village </label>
                                    <div class="col-md-12">
                                        <select name="LandrequesterConnect[village]" class="form-control villages">
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
                                <div class="form-group col-md-6">
                                    <label class="col-md-12 control-label" for="">Type of Land<span class="red"> *</span></label>

                                    <div class="col-md-12">
                                        <?php echo $form->dropDownList($model, 'type_of_land', array('' => 'Select Type of Land', 'Agricultural' => 'Agricultural', 'Industrial' => 'Industrial', 'Commercial' => 'Commercial', 'Residential' => 'Residential', 'Transportation' => 'Transportation', 'Institutional & Public Building' => 'Institutional & Public Building','Government'=>'Government'), array('class' => 'form-control','required'=>'required')); ?>
                                        <?php echo $form->error($model, 'type_of_land'); ?>
                                    </div>
                                </div>
                            </div>



                            <div class="row">

                                <div class="form-group col-md-6">
                                    <label class="col-md-6 control-label" for="">Area </label>
                                    <label class="col-md-6 control-label" for="">Area Type </label>
                                    <div class="col-md-6">
                                        <?php echo $form->numberField($model, 'area_sqmt', array('class' => 'form-control', 'required', 'placeholder' => 'eg: 1050')); ?>
                                        <?php echo $form->error($model, 'area_sqmt'); ?>
                                    </div>
                                     <div class="col-md-6">
                                    <?php echo $form->dropDownList($model, 'area_type', array('Nala' => 'Nala', 'Sq Mtr' => 'Sq Mtr','Acres'=>'Acres','Hectare'=>'Hectare','Sq Ft'=>'Sq Ft'), array('class' => 'form-control')); ?>
                                    <?php echo $form->error($model, 'area_type'); ?>
                                    </div>

                                </div>

                                <div class="form-group col-md-6">

                                    <label class="col-md-12 control-label" for="land_title">Brief Description Of Required  Property <span class="red"> *</span></label>
                                    <div class="col-md-12">
                                        <?php echo $form->textField($model, 'land_title', array('class' => 'form-control','required'=>'required','maxlength'=>'250','placeholder'=>'eg: Land Description Maximum 250')); ?>
                                        <?php echo $form->error($model, 'land_title'); ?>
                                    </div>

                                </div>
                            </div>


                            <div class="row">
                                  <label class="col-md-12 control-label"  for="">Required Land Description </label>

                                  <div class="col-md-12">
                                      <?php echo $form->textArea($model, 'comment', array('class' => 'form-control','id'=>'for_details','maxlength'=>'2500','placeholder'=>'eg: Required Land Description')); ?>
                                      <?php echo $form->error($model, 'comment'); ?>
                                  </div>



                              </div>
                              <div class="row">

                              </div>

                              <div class="row">
                                <div class="col-md-12 buttons" align="center">
                                        <?php echo CHtml::submitButton($model->isNewRecord ? 'Save and Proceed' : 'Update and Proceed', array('class' => 'btn btn-primary step1_btn')); ?>
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
    if (empty($_SESSION['RESPONSE']['user_id']) && empty($_SESSION['uid'])) {
        ?>
            </div><div class="col-md-1" style="padding: 0px;">&nbsp;</div></div>
    <?php } // WITHOUT LOGIN [CHANGE 3]- EXTRA CODE-  ENDS HERE  ?>
    <?php Yii::app()->getClientScript()->registerCoreScript('jquery'); ?>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC3VOcg0P61BSjOsA95rVHFFV_VbMLeS4w&callback=myMap"></script>

<script>
//for_details
function maxLength(el) {
	if (!('maxLength' in el)) {
		var max = el.attributes.maxLength.value;
		el.onkeypress = function () {
			if (this.value.length >= max) return false;
		};
	}
}

maxLength(document.getElementById("for_details"));

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
