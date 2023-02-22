<?php //print_r($_SESSION['uid']);  die;?>
<link href="<?=Yii::app()->theme->baseUrl?>/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />

<style>
    /* Page Level CSS : Rahul Kumar*/
    .errorMessage { color:red }
    .control-label{text-align: left !important;}
    #content{margin-top: -18px; }
    .red{color:red;}

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
    <?php
    // WITHOUT LOGIN [CHANGE 2]- EXTRA CODE
    if (empty($_SESSION['RESPONSE']['user_id']) && empty($_SESSION['uid'])) {
        ?>
		
		<link href="https://caipotesturl.com/themes/investuk/assets/global/css/components.min.css" rel="stylesheet">
		<link href="https://caipotesturl.com/themes/investuk/css/dashboard_style.css" rel="stylesheet">
		<div class="inner-header"  style="margin-top: 18px;">
			<div class="container">
				<div class="row">
					<div class="col-xs-12">
						<h2 class="pageTitle"></h2>
						<ul class="inner-header-breadcrum">
							<li><a href="#">You are now on</a></li>
							<li class="pageTitle">Land Details</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
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
          $locationTab = "pinLocation";
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
		<div class="page-content-wrapper" style="float:none;">
			<div class="page-content">
				<?php if (isset($_SESSION['RESPONSE']['user_id']) && !empty($_SESSION['RESPONSE']['user_id'])) {  ?>
				<div class="dashboard-welcome">
					<h2 class="full-width">
						<div class="dashboard-inner-hd-left">
							<p class="dashbrd-inner-hd">Welcome to Investor Panel - Uttarakhand</p>
						</div>
						<div class="dashboard-inner-hd-right"><a href="/backoffice/frontuser/home/investorWalkthrough" class="blue-btn-new"><i class="fa fa-angle-left"></i>Back</a></div>
						<div class="clearfix"></div>
					</h2>
                    <!--<div class="welcome-date hidden-xs"><i class="icon-calendar"></i>&nbsp;<?php echo date('d-M-Y'); ?></div>-->
					<div class="clearfix"></div>
				</div>
				<?php }?>
				<div class="white-bg-block content-blocks" style="height: 147px; !important;">
                    <div class="col-xs-12 col-sm-3 col-md-3"></div>
					<div class="col-xs-12 col-sm-3 col-md-2">
						<a class="top-number-bts" href="<?php echo Yii::app()->createUrl('/iloc/landownerConnect/create'); ?>">
							<span>1</span>
							<p class="connnect-land">Land</p>
							<p>Fill your land details</p>
						</a>
					</div>
					<div class="col-xs-12 col-sm-3 col-md-2">
						<a class="top-number-bts" href="<?php echo Yii::app()->createUrl("/iloc/landownerContact/$urlPostFix"); ?>">
							<span>2</span>
							<p class="connnect-land">Contact</p>
							<p>Fill Contact Person Details</p>
						</a>
					</div>
					<div class="col-xs-12 col-sm-3 col-md-2">
						<a class="top-number-bts" href="<?php echo Yii::app()->createUrl("iloc/landownerConnect/$locationTab"); ?>">
							<span>3</span>
							<p class="connnect-land">Map</p>
							<p>Fill Map Details</p>
						</a>
					</div>
				</div>
				<div class="content-blocks">
					<div class="portlet box green">
						<div class="portlet-title">
							<div class="caption">
								<i class="icon-map"></i> Land Detail Form
							</div>
							<div class="tools" id="tabletoggle">
								<a href="javascript:;" class="collapse" data-original-title="" title=""> 
								</a>
							</div>
						</div>
						<div class="portlet-body">
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
                                'htmlOptions'=>array('enctype'=>'multipart/form-data'),
                            ));
                            ?>
							<input type="hidden" name="LandownerConnect[YII_CSRF_TOKEN]" value="<?php echo Yii::app()->getRequest()->getCsrfToken(); ?>" />
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

                                    <label class="col-md-12 control-label" for="land_title">This land advertisement is of<span class="red"> *</span></label>
                                    <div class="col-md-12">
<!--                                      <select name="LandownerConnect[la_type]" class="form-control la_type" >
                                            <option value="Pvt">Private Land</option>
                                            <option value="Gov">Govt. Land</option>                                           
                                       
                                        </select>-->
                                        
                                          <?php echo $form->dropDownList($model, 'la_type', array('Pvt' => 'Private Land', 'Gov' => 'Govt. Land'), array('class' => 'form-control la_type')); ?>
                                        <?php echo $form->error($model, 'la_type'); ?>
                                    </div>

                                </div>

                                <div class="form-group col-md-6 dept" style="<?php if (empty($model->department_id)){ ?>display:none;<?php } ?>">
                                    <label class="col-md-12 control-label" for="">Department<span class="red"> *</span></label>
                                    <div class="col-md-12">
                                        <select name="LandownerConnect[department_id]" class="form-control department" >
                                            <option value="">Select Department</option>
                                            <?php $allList = LandownerConnectEXT::getMasterList('bo_departments', 'dept_id', 'department_name','is_department_active','1'); ?>
                                            <?php foreach ($allList as $k => $v) { ?>
                                                <option value="<?php echo $k; ?>" <?php
                                                        if (!empty($model->department_id) && $model->department_id == $k) {
                                                            echo " selected";
                                                        }
                                                        ?>><?php echo $v; ?>
                                                </option>
                                        <?php } ?>
                                        </select>
                                        <?php echo $form->error($model, 'department_id'); ?>
                                    </div>
                                </div>
                            </div>
                            
                            
                            
                            <div class="row">
                                <!--Add here land title-->
                                <div class="form-group col-md-6">

                                    <label class="col-md-12 control-label" for="land_title">Brief Description Of Property<span class="red"> *</span></label>
                                    <div class="col-md-12">
                                        <?php echo $form->textField($model, 'land_title', array('class' => 'form-control','placeholder'=>'eg: Land for agricultulral purpose')); ?>
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
                                    <label class="col-md-12 control-label" for="">Village</label>
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
                                     <label class="col-md-6 control-label" for="">Area<span class="red"> *</span></label>
                                    <label class="col-md-6 control-label" for="">Area Type<span class="red"> *</span></label>
                                    <div class="col-md-6">
                                        <?php echo $form->numberField($model, 'area_sqmt', array('class' => 'form-control', 'required', 'placeholder' => 'eg: 1050')); ?>
                                        <?php echo $form->error($model, 'area_sqmt'); ?>
                                    </div>
                                     <div class="col-md-6">
                                    <?php echo $form->dropDownList($model, 'area_type', array('Nala' => 'Nala', 'Sq. m' => 'Sq. m','Acres'=>'Acres','Hectare'=>'Hectare','Sq. ft'=>'Sq. ft.','Bigha'=>'Bigha'), array('class' => 'form-control')); ?>
                                    <?php echo $form->error($model, 'area_type'); ?>
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
                                </div>
                                                   <div class="row">
       
            <div class="form-group col-md-6"> 
          <label class="col-sm-12 control-label col-lg-12">Upload Additional Information (If any) <i style="color: blue;">[Only pdf, max 25Mb]</i></label>

           <div class="col-lg-12">
           <div class="fileinput fileinput-new" data-provides="fileinput">
            <div class="input-group input-large">
             <div class="form-control uneditable-input input-fixed input-medium" data-trigger="fileinput">
              <i class="fa fa-file fileinput-exists"></i>&nbsp;
              <span class="fileinput-filename" id="pdf-fileinput-filename"> </span>
             </div>
             <span class="input-group-addon btn default btn-file">
              <span class="fileinput-new"> Select file </span>
              <span class="fileinput-exists"> Change </span>
              <input type="file" name="document" id="pfd_document"> </span>
             <a href="javascript:;" class="input-group-addon btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
            </div>
           </div> 
             </div>
         
          <?php   if(isset($_GET['id']) && !empty($_GET['id'])){
                if($pdfInfo=$this->getLandDocument(base64_decode($_GET['id']),'pdf')){?>
              <div class="col-lg-12">
            
           <div class="col-md-6 fn13"> <i class="fa fa-file-pdf-o" aria-hidden="true"></i>  
              <?php                
                echo '<a href="'.Yii::app()->createAbsoluteUrl('iloc/property/DownloadDocuments/document/'.base64_encode($pdfInfo->document_name)).'">View Additional </a>';
             
            ?>
           </div>
           </div>
          <?php } } ?>
         
          
          
         </div>
         
        <div class="form-group col-md-6">

          <label class="col-sm-12 control-label col-lg-12">Upload Promotional / Project Video (If any) <i style="color: blue;">[Only mp4, max 50Mb]</i></label>

          <div class="col-lg-12">
           <div class="fileinput fileinput-new" data-provides="fileinput">
            <div class="input-group input-large">
             <div class="form-control uneditable-input input-fixed input-medium" data-trigger="fileinput">
              <i class="fa fa-file fileinput-exists"></i>&nbsp;
              <span class="fileinput-filename" id="video_fileinput-filename"> </span>
             </div>
             <span class="input-group-addon btn default btn-file">
              <span class="fileinput-new"> Select file </span>
              <span class="fileinput-exists"> Change </span>
              <input type="file" name="video" id="video_document"> </span>
             <a href="javascript:;" class="input-group-addon btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
            </div>
           </div>
          </div>
          <?php    if(isset($_GET['id']) && !empty($_GET['id'])){
               if($videoInfo=$this->getLandDocument(base64_decode($_GET['id']),'mp4')){?>
             <div class="col-lg-12">

          <div class="col-md-6 fn13"> <i class="fa fa-file-video-o" aria-hidden="true"></i>  
            <?php                
           echo '<a href="'.Yii::app()->createAbsoluteUrl('iloc/property/DownloadDocuments/document/'.base64_encode($videoInfo->document_name)).'">View Video </a>';

            ?> 
          </div>
          </div>
          
          <?php }} ?>
        </div>

      </div>
                              </div>
                        <div class="row">
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
    if (empty($_SESSION['RESPONSE']['user_id']) && empty($_SESSION['uid'])) {
        ?>
            </div><div class="col-md-1" style="padding: 0px;">&nbsp;</div></div></div>
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
                                $(".la_type").change(function(){
                                    if($(this).val()=='Gov'){
                                        $(".dept").show();
                                    }else{
                                         $(".dept").hide();
                                    }
                                    
                                   
                                });
                              
    });
    $(window).load(function(){
        
         <?php  if(DefaultUtility::isHODNodal()){  ?>  
                                  //  alert("here");
                                     $('.department').val("<?php echo $_SESSION['dept_id']; ?>");  
                                     $('.department') .attr('disabled', true)
                                <?php } ?> 
                                     <?php  if(RolesExt::isDMUser()){  
                                        // Getting District Id Of DM
                                       $data=Yii::app()->db->createCommand("Select disctrict_id from bo_user where uid=".$_SESSION['uid'])->queryRow();
                                         ?>  
                                  $('.district').val("<?php echo @$data['disctrict_id']; ?>");  
                                    $('.district') .attr('disabled', true)
                                <?php } ?>
                                    
                                    $('#pfd_document').on('change',function(){
   //get the file name
   var fileName = $(this).val();
   //replace the "Choose a file" label
   $('#pdf-fileinput-filename').html(fileName);
  });
        
   $('#video_document').on('change',function(){
                //get the file name
                var fileName = $(this).val();
                //replace the "Choose a file" label
                $('#video_fileinput-filename').html(fileName);
            });

    });
</script>
<?php //print_r($_SESSION); ?>