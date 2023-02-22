<!-- <link href="<?= Yii::app()->theme->baseUrl ?>/assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" /> -->
<link href="<?= Yii::app()->theme->baseUrl ?>/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
<link href="<?= Yii::app()->theme->baseUrl ?>/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />

<style type="text/css">
    .help-block.help-block-error {
        color: red;
        font-weight: 800;
    }
    .control-label
    {
        font-size: 14px;
    }
    .ms-container {
        width: 100% !important;
    }
    .mt-repeater .mt-repeater-delete {
        margin-top: 0 !important;
    }

    tr > th {
        text-align: center;
    }
    .form .form-section, .portlet-form .form-section
    {
        margin: 15px 0;
        font-weight: bold;
    }
    .portlet.light .form .form-body, .portlet.light .portlet-form .form-body{
        padding: 20px;
    }
    .input-group-btn > button {
        margin: 3px 0 0;
    }
    @media(min-width: 992px){
        .raw_material_body_class,.product_manufactured_body_class{
            margin-left: 60px;
        }
        label{
            text-align: left !important;
            font-size: 16px;
            font-weight: 400;
            padding: 5px 0;
        }

        /*.nature_label{
            margin-left: -26px;
            padding-right: 65px;
        }*/
    }
    @media(min-width: 700px){
        .description_detail{
            margin-left: -50px;
            width: 87.4%;   
        }
    }
    .mt-repeater .mt-repeater-item{
        margin-right: 30px;
    }
    a:hover{
        color: #337ab7;
        text-decoration: none;
    }
    a:visited{
        color: #337ab7;
        text-decoration: none; 
    }
    .form-horizontal .form-group.form-md-line-input{
        margin: 0px 0px 0px 0px;
    }
    .custom_mob{
        margin: 2px 10px -27px;
    }
</style>
<?php
// echo $sub_id."<pre>"; print_r($incmplt_fields); die;
$sql = "SELECT la_auction_detail.auc_id,la_auction_detail.district_id,bo_district.distric_name,bo_district.district_id
			FROM bo_district
			INNER JOIN la_auction_detail
			ON bo_district.district_id=la_auction_detail.district_id
			WHERE la_auction_detail.is_active='Y' AND la_auction_detail.auc_status='O' AND la_auction_detail.auc_end_date> NOW()- INTERVAL 1 DAY
			GROUP BY la_auction_detail.district_id";
$connection = Yii::app()->db;
$command = $connection->createCommand($sql);
$AustionDistricts = $command->queryAll();
// echo "<pre>"; print_r($AustionDistricts); die;
?>


<div class="row">
    <div class="col-md-12">
        <!-- <div class="m-heading-1  border-green m-bordered">
            <h3>Land Allotment Form</h3>
        </div> -->
        <div class="portlet light bordered" id="form_wizard_1">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-layers font-red"></i>
                    <span class="caption-subject font-red bold uppercase">Fields With * are Mandtory </span>
                </div>
            </div>
            <div class="tab-pane active" id="tab1">
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-gift"></i>Land Allotment Form - Step 1
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <form class="form-horizontal" action="<?= @Yii::app()->createAbsoluteUrl('/frontuser/landAllotment/stepTwo') ?>" method="POST" id="submit_form">
                            <input type="hidden" class="csrftoken" name="IUID" value="<?= @$_SESSION['RESPONSE']['iuid'] ?>" />
                            <input type="hidden" class="csrftoken" name="YII_CSRF_TOKEN" value="<?= Yii::app()->getRequest()->getCsrfToken() ?>" />
                            <input type="hidden" class="csrftoken" name="App_subbmission_id" value="<?= @$sub_id ?>" />
                            <div class="form-wizard">
                                <div class="form-body">
                                    <div class="portlet-body form">
                                        <div class="form-body">
                                            <ul class="nav nav-pills nav-justified steps">
                                                <li class="active">
                                                    <a href="#tab1" data-toggle="tab" class="step">
                                                        <span class="number"> 1 </span>
                                                        <span class="desc">
                                                            <i class="fa fa-check"></i> Applicant Detail </span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a data-toggle="tab" class="step">
                                                        <span class="number"> 2 </span>
                                                        <span class="desc">
                                                            <i class="fa fa-check"></i> Evaluation CheckList</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a data-toggle="tab" class="step">
                                                        <span class="number"> 3 </span>
                                                        <span class="desc">
                                                            <i class="fa fa-check"></i> Checklist of Documents </span>
                                                    </a>
                                                </li>
                                                <!-- <li>
                                                        <a data-toggle="tab" class="step">
                                                                <span class="number"> 4 </span>
                                                                <span class="desc">
                                                                <i class="fa fa-check"></i> Checklist </span>
                                                        </a>
                                                </li> -->
                                            </ul>
                                            <div id="bar" class="progress progress-striped" role="progressbar">
                                                <div class="progress-bar progress-bar-success"> </div>
                                            </div>
                                            <div class="alert alert-danger alert-message-error display-none">
                                                <button class="close" data-dismiss="alert"></button> Please correct the form errors check below.
                                            </div>
                                            <div class="alert alert-success alert-message-success display-none">
                                                <button class="close" data-dismiss="alert"></button> Your form validation is successful!
                                            </div>
                                            <?php
                                          //  echo "<pre>"; print_r(Yii::app()->user->getFlashes()); die;
                                            foreach (Yii::app()->user->getFlashes() as $key => $message) {
                                                echo '<div class="alert alert-' . @$key . '"><button class="close" data-dismiss="alert"></button> 
                	                                		<ul>
                	                                       ' . @$message .
                                                '</ul>
                	                                      	</div>';
                                            }
                                            ?>
                                            <div class="tab-pane active" id="tab1">
                                                <h4 class="form-section">Applicant Details</h4>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label col-md-12">Applicant Name<span class="required" aria-required="true"> * </span></label>
                                                            <div class="col-md-12">
                                                                <input type="text"  id="applicant_name" maxlength="100" required class="form-control lettersonly" value="<?= @$incmplt_fields->applicant_name ?>" name="applicant_name" placeholder="*  Applicant Name">                                                                   
                                                                <span class="help-block">  </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label col-md-12">Name of the Firm/Company<span class="required" aria-required="true"> * </span></label>
                                                            <div class="col-md-12">
                                                                <input type="text"  id="company_name" maxlength="100" required class="form-control lettersonly" value="<?= @$incmplt_fields->company_name ?>" name="company_name" placeholder="*  Name of the Company / Unit">
                                                                <span class="help-block"> </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--/span-->
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label col-md-12">Constitution of the Firm/Company<span class="required" aria-required="true"> * </span></label>
                                                            <div class="col-md-12">
                                                                <select class="form-control" required name="firm_company_constitution" >
                                                                    <option value="">---Please Select---</option>
                                                                    <option value="proprietorship_id_47" <?php if (isset($incmplt_fields->firm_company_constitution) && $incmplt_fields->firm_company_constitution == "proprietorship_id_47") echo "selected"; ?>>Proprietorship</option>
                                                                    <option value="partnership_firm_id_48" <?php if (isset($incmplt_fields->firm_company_constitution) && $incmplt_fields->firm_company_constitution == "partnership_firm_id_48") echo "selected"; ?>>Partnership Firm</option>
                                                                    <option value="limited_liability_partnership_id_49" <?php if (isset($incmplt_fields->firm_company_constitution) && $incmplt_fields->firm_company_constitution == "limited_liability_partnership_id_49") echo "selected"; ?>>Limited Liability Partnership</option>
                                                                    <option value="private_limited_company_id_50" <?php if (isset($incmplt_fields->firm_company_constitution) && $incmplt_fields->firm_company_constitution == "private_limited_company_id_50") echo "selected"; ?>>Private Limited Company</option>
                                                                    <option value="public_limited_company_id_51" <?php if (isset($incmplt_fields->firm_company_constitution) && $incmplt_fields->firm_company_constitution == "public_limited_company_id_51") echo "selected"; ?>>Public Limited Company</option>
                                                                    <option value="cooperative_society_id_52" <?php if (isset($incmplt_fields->firm_company_constitution) && $incmplt_fields->firm_company_constitution == "cooperative_society_id_52") echo "selected"; ?>>Cooperative Society</option>
                                                                    <option value="self_help_group_id_53" <?php if (isset($incmplt_fields->firm_company_constitution) && $incmplt_fields->firm_company_constitution == "self_help_group_id_53") echo "selected"; ?>>Self Help Group</option>
                                                                    <option value="section_25_company_id_54" <?php if (isset($incmplt_fields->firm_company_constitution) && $incmplt_fields->firm_company_constitution == "section_25_company_id_54") echo "selected"; ?>>Section 25 Company</option>
                                                                    <option value="one_man_company_id_55" <?php if (isset($incmplt_fields->firm_company_constitution) && $incmplt_fields->firm_company_constitution == "one_man_company_id_55") echo "selected"; ?>>One Man Company</option>
                                                                </select>
                                                                <span class="help-block"> </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--/span-->
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label col-md-12">Gender<span class="required" aria-required="true"> * </span></label>
                                                            <div class="col-md-12">
                                                                <select class="form-control" required name="gender" >
                                                                    <option value="">---Please Select Gender---</option>
                                                                    <option value="M" <?php if (isset($incmplt_fields->gender) && $incmplt_fields->gender == "M") echo "selected"; ?>>Male</option>
                                                                    <option value="F" <?php if (isset($incmplt_fields->gender) && $incmplt_fields->gender == "F") echo "selected"; ?>>Female</option>
                                                                    <option value="O" <?php if (isset($incmplt_fields->gender) && $incmplt_fields->gender == "O") echo "selected"; ?>>Other</option>
                                                                </select>
                                                                <span class="help-block"> </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--/span-->
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label col-md-12">Mobile<span class="required" aria-required="true"> * </span></label>
                                                            <div class="col-md-12">
                                                                <div class="custom_mob">+91</div>
                                                                <input type="text"  id="mob_number" style="padding: 0 40px;" class="form-control" required value="<?= @$incmplt_fields->mob_number ?>"  name="mob_number" placeholder="Mobile Number">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--/span-->
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label col-md-12">Telephone</label>
                                                            <div class="col-md-4">
                                                                <input type="text"  id="std_code_tel_phone" class="form-control telephone_numbers" value="<?= @$incmplt_fields->std_code_tel_phone ?>" name="std_code_tel_phone" placeholder="STD Code">
                                                            </div>
                                                            <div class="col-md-8">
                                                                <input type="text" id="tel_phone" class="form-control telephone_numbers" value="<?= @$incmplt_fields->tel_phone ?>" name="tel_phone" placeholder="Telephone Number">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--/span-->
                                                </div>

                                                <div class="row">    
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label col-md-12">Email<span class="required" aria-required="true"> * </span></label>
                                                            <div class="col-md-12">
                                                                <input type="text"  id="email" class="form-control email" maxlength="250" value="<?= @$incmplt_fields->email ?>" required name="email" placeholder="*  Email">

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--/span-->
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label col-md-12">Fax</label>
                                                            <div class="col-md-4">
                                                                <input type="text"  id="std_code_tel_phone" class="form-control telephone_numbers" value="<?= @$incmplt_fields->std_code_tel_phone ?>" name="std_code_fax" placeholder="STD Code">
                                                            </div>
                                                            <div class="col-md-8">
                                                                <input type="text"  id="fax" class="form-control telephone_numbers" value="<?= @$incmplt_fields->fax ?>" name="fax" placeholder="Fax Number">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label col-md-12">Physically Handicapped<span class="required" aria-required="true"> * </span></label>
                                                            <div class="col-md-12">

                                                                <select class="form-control" name="handicapped" id="handicapped" required >
                                                                    <option value="">---Please Select ---</option>
                                                                  
                                                                    <?php if(!empty($incmplt_fields->handicapped)){ ?>
                                                                     <option value="Yes" <?php if (isset($incmplt_fields->handicapped) && $incmplt_fields->handicapped == "Yes") echo "selected"; ?>>Yes</option>
                                                                          <option value="No" <?php if (isset($incmplt_fields->handicapped) && $incmplt_fields->handicapped == "No") echo "selected"; ?>>No</option>
                                                                    <?php } else { ?>
                                                                          <option value="Yes">Yes</option>
                                                                           <option value="No">No</option>
                                                                        <?php } ?>
                                                                </select>
                                                                <span class="help-block"></span>
                                                            </div>
                                                        </div>

</div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label col-md-12">Category<span class="required" aria-required="true"> * </span></label>
                                                                <div class="col-md-12">

                                                                    <select class="form-control" name="category" id="category" required>
                                                                        <option value="">---Please Select Category---</option>
                                                                      
                                                                          <?php if(!empty($incmplt_fields->category)){ ?>
                                                                        <option value="General" <?php if (isset($incmplt_fields->category) && $incmplt_fields->category == "General") echo "selected"; ?>>General</option>
                                                                          
                                                                            <option value="SC" <?php if (isset($incmplt_fields->category) && $incmplt_fields->category == "SC") echo "selected"; ?>>SC</option>
                                                                              <option value="ST" <?php if (isset($incmplt_fields->category) && $incmplt_fields->category == "ST") echo "selected"; ?>>ST</option>
                                                                       <?php } else { ?>
                                                                          <option value="General">General</option>
                                                                          
                                                                            <option value="SC">SC</option>
                                                                             <option value="ST">ST</option>
                                                                        <?php } ?>
                                                                    </select>
                                                                    <span class="help-block"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--/span-->
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label col-md-12">Correspondence Address<span class="required" aria-required="true"> * </span></label>
                                                                <div class="col-md-12">
                                                                    <textarea  id="Address" rows="3" class="form-control address_field_with_space" required maxlength="100" name="Address"  placeholder="*  Correspondence Address"><?= @$incmplt_fields->Address ?></textarea>
                                                                    <span class="help-block"> </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <h4 class="form-section">Particulars of Area</h4>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label col-md-12">District<span class="required" aria-required="true"> * </span></label>
                                                            <div class="col-md-12">
                                                                <?php
                                                                $model = new DistrictExt;
                                                                ?>
                                                                <select class="form-control" name="district" id="district" required onchange="getDisEstates();">
                                                                    <option value="">---Please Select District---</option>
                                                                    <?php
                                                                    if (isset($AustionDistricts)) {
                                                                        foreach ($AustionDistricts as $k => $v) {
                                                                            if (isset($incmplt_fields->district) && $incmplt_fields->district == $v['district_id'])
                                                                                $select = " selected ";
                                                                            else
                                                                                $select = "";
                                                                            echo "<option $select value='$v[district_id]'>$v[distric_name]</option>";
                                                                        }
                                                                    }
                                                                    ?>
                                                                </select>
                                                                <span class="help-block"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php
                                                    if (isset($incmplt_fields->district)) {
                                                        $sql = "SELECT la_auction_detail.auc_id,la_estates.land_estate_id,la_estates.land_estate_name,la_estates.estate_area
																FROM la_estates
																INNER JOIN la_auction_detail
																ON la_estates.land_estate_id=la_auction_detail.estate_id
																WHERE la_auction_detail.is_active='Y' 
																AND la_auction_detail.auc_status='O'
																AND la_auction_detail.auc_end_date> NOW()
																AND la_auction_detail.district_id=$incmplt_fields->district
																GROUP BY la_auction_detail.estate_id";
                                                        $connection = Yii::app()->db;
                                                        $command = $connection->createCommand($sql);
                                                        $Plots = $command->queryAll();
                                                        if (!empty($Plots))
                                                            foreach ($Plots as $k => $v)
                                                                $estates[] = array("land_estate_id" => $v['land_estate_id'], 'land_estate_name' => $v['land_estate_name']);
                                                    }
                                                    ?>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label col-md-12">Estates<span class="required" aria-required="true"> * </span></label>
                                                            <div class="col-md-12">
                                                                <select class="form-control" name="estate" id="estate" required onchange="getDisEstateArea(this.id);getDisEstate(this.id);">
                                                                    <?php
                                                                    if (isset($estates)) {
                                                                        echo '<option value="">---Please Select Estate---</option>';
                                                                        foreach ($estates as $k => $v) {
                                                                            if ($incmplt_fields->estate == $v['land_estate_id'])
                                                                                $select = " selected ";
                                                                            else
                                                                                $select = "";
                                                                            echo "<option $select value='$v[land_estate_id]'>$v[land_estate_name]</option>";
                                                                        }
                                                                    } else
                                                                        echo '<option value="">---Please Select District---</option>';
                                                                    ?>
                                                                </select>
                                                                <span class="help-block">
                                                                    <a href="" class="help-block col-md-12 badge badge-primary" style="padding: 4px 85px; margin: 5px 0px;color:#fff;font-weight:800" id="estate_linkk" target="_blank" >Estate Link View</a>
                                                                    <input type="hidden" value="" id="estate_link">
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--/span-->
                                                    <!--/span-->
                                                    <?php
                                                    if (isset($incmplt_fields->estate)) {
                                                        // $criteria=new CDbCriteria;
                                                        // $criteria->condition="estate_id=:estate_id AND is_active=:status";
                                                        // $criteria->params=array(":estate_id"=>$incmplt_fields->estate,":status"=>"Y");
                                                        // $Plots=LaAuctionPlots::model()->findAll($criteria);
                                                        $sql = "SELECT *
																	FROM la_auction_plots
																	INNER JOIN la_auction_detail
																	ON la_auction_plots.auc_plot_id=la_auction_detail.plot_id
																	WHERE la_auction_detail.is_active='Y' 
																	AND la_auction_detail.auc_status='O'
																	AND la_auction_detail.estate_id=$incmplt_fields->estate  order by la_auction_plots.auc_plot_id ";
                                                        $connection = Yii::app()->db;
                                                        $command = $connection->createCommand($sql);
                                                        $PlotsData = $command->queryAll();
                                                        if (!empty($PlotsData))
                                                            $PlotsArray = array();
                                                        foreach ($PlotsData as $k => $v) {
                                                            $now = strtotime(date("Y-m-d"));
                                                            $StartDate = strtotime($v['auc_start_date']);
                                                            $EndDate = strtotime($v['auc_end_date']);

                                                            if ($now >= $StartDate && $now <= $EndDate)
                                                                $PlotsArray[] = array("plot_id" => $v['auc_plot_id'], 'area_name' => $v['area_name'], 'plot_area' => $v['plot_area']);
                                                        }
                                                    }
                                                    // echo "<pre>"; print_r($incmplt_fields->area_square_meter); die;
                                                    // echo "<pre>"; print_r($PlotsArray); die;
                                                    ?>
                                                    </div>
                                                    <div class="row">
                                                    <div class="col-md-6">
			                                            <div class="form-group">
			                                                <label class="control-label col-md-12">Available Plots Area in Sq. Meters<span class="required" aria-required="true"> * </span></label>
			                                                <!-- <div class="col-md-5">
			                                                	<select class='form-control MasterSelectBox txt' multiple>
			                                                    	<?php 
			                                                    		// if(isset($PlotsArray)){
			                                                    		// 	$areaArray=array();
			                                                    		// 	foreach ($incmplt_fields->area_square_meter as $k => $v)
			                                                    		// 		$areaArray[]=$v;
			                                                    		// 	$select = "";
			                                                    		// 	foreach ($PlotsArray as $k => $v){
			                                                    		// 		if (in_array($v['plot_id'], $areaArray))
	                                                    				// 			$select = " selected ";
	                                                    				// 		else 
	                                                    				// 			$select = "";
	                                                    				// 		if($select == "")
				                                                    	// 			echo "<option $select value='$v[plot_id]'>$v[area_name] ( $v[plot_area] )</option>";
				                                                    	// 	}
				                                                    	// }
				                                                    ?>
			                                                	</select>
			                                            	</div>
			                                                <div class='col-md-2'>
			                                                   	<a href='#' class='btn btn-default btn_select' id='btnAdd'>></a><br>
			                                                    <a href='#' class='btn btn-default btn_select' id='btnRemove'><</a>
			                                                </div>
															<div class='col-md-5'>
														<select class='PairedSelectBox form-control' required multiple  name='area_square_meter[]'></select>
																<select class='PairedSelectBox form-control' id="" required multiple  name='area_square_meter[]'>
			                                                    	
																</select>
															</div> -->
			                                                    <select id="area_square_meter" class="form-control multi-select" required multiple name="area_square_meter[]">
			                                                    	<?php 
			                                                    		if(isset($PlotsArray)){
			                                                    			$areaArray=array();
			                                                    			foreach ($incmplt_fields->area_square_meter as $k => $v)
			                                                    				$areaArray[]=$v;
			                                                    			$select = "";
			                                                    			foreach ($PlotsArray as $k => $v){
			                                                    				if (in_array($v['plot_id'], $areaArray))
	                                                    							$select = " selected ";
	                                                    						else 
	                                                    							$select = "";
				                                                    			echo "<option $select value='$v[plot_id]'>$v[area_name] ( $v[plot_area] )</option>";
				                                                    		}
				                                                    	}
				                                                    ?>
			                                                    </select>

		                                                    <div class="col-md-12 badge badge-primary" style="padding: 4px 85px; margin: 5px 0px;">
		                                                      <b><sup>*</sup>Please press 'Ctrl' key to select multiple plots</b>
		                                                    </div>
			                                            </div>
			                                        </div>                     <!-- <label class="control-label col-md-12">&nbsp;</label>
			                                                <div class="col-md-12">
			                                                    <input type="text" id="optional_specific_plot_size" class="form-control digits" maxlength="250" value="<?=@$incmplt_fields->optional_specific_plot_size?>"  name="optional_specific_plot_size" placeholder="Area in Square Meters (If/Any)">
			                                                </div> -->
                                                            <div class="col-md-6">
			                                                <div class="form-group">
                                                            <label class="control-label col-md-12">Type of Industry<span class="required" aria-required="true"> * </span></label>
                                                            <div class="col-md-12">
                                                                <select class="form-control" name="nature_of_area" required id="nature_of_area" >
                                                                    <option value="">---Please Select Nature of Area---</option>
                                                                    <option value="new_unit" <?php if (isset($incmplt_fields->nature_of_area) && $incmplt_fields->nature_of_area == "new_unit") echo "selected"; ?>>New Unit</option>
                                                                    <option value="expansion" <?php if (isset($incmplt_fields->nature_of_area) && $incmplt_fields->nature_of_area == "expansion") echo "selected"; ?>>Expansion</option>
                                                                    <option value="modernization" <?php if (isset($incmplt_fields->nature_of_area) && $incmplt_fields->nature_of_area == "modernization") echo "selected"; ?>>Modernization</option>
                                                                </select>
                                                                <span class="help-block">  </span>
                                                            </div>
                                                        </div>
                                                        </div>
			                                            </div>
			                                        </div>
                                                     <div class="col-md-6">
                                                        <!--  <div class="form-group">
                                                              <label class="control-label col-md-12">Area Requirement in Sq. Meters <span class="required" aria-required="true"> * </span></label>
                                                              <div class="col-md-12">
                                                               <input type="text" id="optional_specific_plot_size" required class="form-control digits" maxlength="250" value="<?= @$incmplt_fields->optional_specific_plot_size ?>"  name="optional_specific_plot_size" placeholder="Specific Area in Square Meters (If/Any)">
                                                                <span class="help-block">  </span>
                                                              </div>
                                                          </div>-->

                                                      </div>

                                                    <!--/span-->
                                                    
                                                    <!--/span-->

                                                    <!--/span-->
                                                </div>

                                                <h4 class="form-section">Unit Details</h4>
                                                <div class="row">
                                                    <div class="col-md-12 frm-group mt-repeater">
                                                        <a href="javascript:;" data-repeater-create class="btn btn-success mt-repeater-add">
                                                            <i class="fa fa-plus"></i> Add New Product
                                                        </a>
                                                        <div data-repeater-list="group-c" id="data_pro">
                                                            <?php
                                                            if (isset($incmplt_fields->proposed_product)) {
                                                                foreach ($incmplt_fields->proposed_product as $k => $v) {
                                                                    $proposed_product = $incmplt_fields->proposed_product;
                                                                    $proposed_installed_capacity = $incmplt_fields->proposed_installed_capacity;
                                                                    // $proposed_product_field_number = $incmplt_fields->proposed_product_field_number;
                                                                    $proposed_product_unit = $incmplt_fields->proposed_product_unit;
                                                                    echo "<div data-repeater-item class='mt-repeater-item product_manufactured_body_remove'>
																			    <div class='row mt-repeater-row'>
																			        <div class='col-md-4'>
																			            <label class='control-label'>Proposed Product</label>
																			            <input type='text' required placeholder='* Proposed Product' value='" . @$proposed_product[$k] . "' name='proposed_product[]' class='form-control lettersonly' />
																			        </div>
																			        <div class='col-md-4'>
																			            <label class='control-label'>Annual Proposed Installed Capacity</label>
																			            <input type='text' required placeholder='* Proposed Installed Capacity' value='" . @$proposed_installed_capacity[$k] . "' name='proposed_installed_capacity[]' class='form-control digits' />
																			        </div>
																			        <div class='col-md-3'>
																			            <label class='control-label'>Unit</label>
																			            <select required name='proposed_product_unit[]' class='form-control' >
																			            	<optgroup label='Units List'>
																			            		<option ";
                                                                    if (@$proposed_product_unit[$k] == 'Axles')
                                                                        echo 'selected';echo " value='Axles'>Axles</option>
																			            		<option ";
                                                                    if (@$proposed_product_unit[$k] == 'Bottles')
                                                                        echo 'selected';echo " value='Bottles'>Bottles</option>
																			            		<option ";
                                                                    if (@$proposed_product_unit[$k] == 'Boxes')
                                                                        echo 'selected';echo " value='Boxes'>Boxes</option>
																			            		<option ";
                                                                    if (@$proposed_product_unit[$k] == 'Capsules')
                                                                        echo 'selected';echo " value='Capsules'>Capsules</option>
																			            		<option ";
                                                                    if (@$proposed_product_unit[$k] == 'Cubic_Metres')
                                                                        echo 'selected';echo " value='Cubic_Metres'>Cubic Metres</option>
																			            		<option ";
                                                                    if (@$proposed_product_unit[$k] == 'Cylinders')
                                                                        echo 'selected';echo " value='Cylinders'>Cylinders</option>
																			            		<option ";
                                                                    if (@$proposed_product_unit[$k] == 'Dozens')
                                                                        echo 'selected';echo " value='Dozens'>Dozens</option>
																			            		<option ";
                                                                    if (@$proposed_product_unit[$k] == 'Feet')
                                                                        echo 'selected';echo " value='Feet'>Feet</option>
																			            		<option ";
                                                                    if (@$proposed_product_unit[$k] == 'Grams')
                                                                        echo 'selected';echo " value='Grams'>Grams</option>
																			            		<option ";
                                                                    if (@$proposed_product_unit[$k] == 'Gross')
                                                                        echo 'selected';echo " value='Gross'>Gross</option>
																			            		<option ";
                                                                    if (@$proposed_product_unit[$k] == 'Kilogram')
                                                                        echo 'selected';echo " value='Kilogram'>Kilogram</option>
																			            		<option ";
                                                                    if (@$proposed_product_unit[$k] == 'Kilometres')
                                                                        echo 'selected';echo " value='Kilometres'>Kilometres</option>
																			            		<option ";
                                                                    if (@$proposed_product_unit[$k] == 'Kilowatt_Hours')
                                                                        echo 'selected';echo " value='Kilowatt_Hours'>Kilowatt Hours</option>
																			            		<option ";
                                                                    if (@$proposed_product_unit[$k] == 'Litres')
                                                                        echo 'selected';echo " value='Litres'>Litres</option>
																			            		<option ";
                                                                    if (@$proposed_product_unit[$k] == 'Metres')
                                                                        echo 'selected';echo " value='Metres'>Metres</option>
																			            		<option ";
                                                                    if (@$proposed_product_unit[$k] == 'Metric_Tonnes')
                                                                        echo 'selected';echo " value='Metric_Tonnes'>Metric Tonnes</option>
																			            		<option ";
                                                                    if (@$proposed_product_unit[$k] == 'Number')
                                                                        echo 'selected';echo " value='Number'>Number</option>
																			            		<option ";
                                                                    if (@$proposed_product_unit[$k] == 'Pairs')
                                                                        echo 'selected';echo " value='Pairs'>Pairs</option>
																			            		<option ";
                                                                    if (@$proposed_product_unit[$k] == 'Pieces')
                                                                        echo 'selected';echo " value='Pieces'>Pieces</option>
																			            		<option ";
                                                                    if (@$proposed_product_unit[$k] == 'Quintals')
                                                                        echo 'selected';echo " value='Quintals'>Quintals</option>
																			            		<option ";
                                                                    if (@$proposed_product_unit[$k] == 'Reams')
                                                                        echo 'selected';echo " value='Reams'>Reams</option>
																			            		<option ";
                                                                    if (@$proposed_product_unit[$k] == 'Sets')
                                                                        echo 'selected';echo " value='Sets'>Sets</option>
																			            		<option ";
                                                                    if (@$proposed_product_unit[$k] == 'Spindles')
                                                                        echo 'selected';echo " value='Spindles'>Spindles</option>
																			            		<option ";
                                                                    if (@$proposed_product_unit[$k] == 'Square_Metres')
                                                                        echo 'selected';echo " value='Square_Metres'>Square Metres</option>
																			            		<option ";
                                                                    if (@$proposed_product_unit[$k] == 'Tablets')
                                                                        echo 'selected';echo " value='Tablets'>Tablets</option>
																			            	</optgroup>
																			            </select>
																			        </div>
																			        <div class='col-md-1'>
																			        	<label class='control-label'>Delete</label>
																			            <a href='javascript:;' data-repeater-delete class='btn btn-danger mt-repeater-delete'>
																			                <i class='fa fa-close'></i>
																			            </a>
																			        </div>
																			    </div>
																			</div>";
                                                                }
                                                            }
                                                            else {
                                                                ?>
                                                                <div data-repeater-item class="mt-repeater-item product_manufactured_body_remove">
                                                                    <div class="row mt-repeater-row">
                                                                        <div class="col-md-4">
                                                                            <label class="control-label">Proposed Product</label>
                                                                            <input type="text" required placeholder="* Proposed Product" name="proposed_product[]" class="form-control lettersonly" />
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <label class="control-label">Annual Proposed Installed Capacity</label>
                                                                            <input type="text" required placeholder="* Proposed Installed Capacity" name="proposed_installed_capacity[]" class="form-control digits" />
                                                                        </div>
                                                                        <div class="col-md-3">
                                                                            <label class="control-label">Unit</label>
                                                                            <select required name="proposed_product_unit[]" class="form-control" >
                                                                                <optgroup label="Units List">
                                                                                    <option value="Axles">Axles</option>
                                                                                    <option value="Bottles">Bottles</option>
                                                                                    <option value="Boxes">Boxes</option>
                                                                                    <option value="Capsules">Capsules</option>
                                                                                    <option value="Cubic_Metres">Cubic Metres</option>
                                                                                    <option value="Cylinders">Cylinders</option>
                                                                                    <option value="Dozens">Dozens</option>
                                                                                    <option value="Feet">Feet</option>
                                                                                    <option value="Grams">Grams</option>
                                                                                    <option value="Gross">Gross</option>
                                                                                    <option value="Kilogram">Kilogram</option>
                                                                                    <option value="Kilometres">Kilometres</option>
                                                                                    <option value="Kilowatt_Hours">Kilowatt Hours</option>
                                                                                    <option value="Litres">Litres</option>
                                                                                    <option value="Metres">Metres</option>
                                                                                    <option value="Metric_Tonnes">Metric Tonnes</option>
                                                                                    <option value="Number">Number</option>
                                                                                    <option value="Pairs">Pairs</option>
                                                                                    <option value="Pieces">Pieces</option>
                                                                                    <option value="Quintals">Quintals</option>
                                                                                    <option value="Reams">Reams</option>
                                                                                    <option value="Sets">Sets</option>
                                                                                    <option value="Spindles">Spindles</option>
                                                                                    <option value="Square_Metres">Square Metres</option>
                                                                                    <option value="Tablets">Tablets</option>
                                                                                </optgroup>
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-md-1">
                                                                            <label class="control-label">Delete</label>
                                                                            <a href="javascript:;" data-repeater-delete class="btn btn-danger mt-repeater-delete">
                                                                                <i class="fa fa-close"></i>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
    <?php
}
?>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <!--  <div class="col-md-6">
                                                         <div class="form-group">
                                                             <label class="control-label col-md-12">Pollution Category<span class="required" aria-required="true"> * </span></label>
                                                             <div class="col-md-12">
                                                                <select class="form-control" name="pollution_category" required id="pollution_category">
                                                                     <option value="">---Please Select---</option>
                                                                     <option value="red" <?php if (isset($incmplt_fields->pollution_category) && $incmplt_fields->pollution_category == "red") echo "selected"; ?>>Red</option>
                                                                     <option value="green" <?php if (isset($incmplt_fields->pollution_category) && $incmplt_fields->pollution_category == "green") echo "selected"; ?>>Green</option>
                                                                     <option value="orange" <?php if (isset($incmplt_fields->pollution_category) && $incmplt_fields->pollution_category == "orange") echo "selected"; ?>>Orange</option>
                                                                     <option value="white" <?php if (isset($incmplt_fields->pollution_category) && $incmplt_fields->pollution_category == "white") echo "selected"; ?>>White</option>
                                                                </select>
                                                             </div>
                                                         </div>
                                                     </div>-->
                                                    <!--/span-->

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label col-md-12">Nature of Project<span class="required" aria-required="true"> * </span></label>
                                                            <div class="col-md-12">
                                                                    <!-- <select class="form-control" required name="nature_project" > -->
                                                                <!--<option value="">---Please Select Nature---</option>-->
                                                                <!-- <option value="manufacturing" <?php if (isset($incmplt_fields->nature_project) && $incmplt_fields->nature_project == "manufacturing") echo "selected"; ?>>Manufacturing</option> -->
                                                                <!-- <option value="service" <?php if (isset($incmplt_fields->nature_project) && $incmplt_fields->nature_project == "service") echo "selected"; ?>>Service</option> -->
                                                                <!-- </select> -->
                                                                <input type="text" id="nature_project" class="form-control" value="Manufacturing" readonly name="nature_project">
                                                                <span class="help-block"> </span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label col-md-12">Projected Sales in First Year(INR) <span class="required" aria-required="true"> * </span></label>
                                                            <div class="col-md-12">
                                                                <input type="text" id="projected_sales_unit" class="form-control digits" value="<?= @$incmplt_fields->projected_sales_unit ?>" required name="projected_sales_unit" placeholder="*  Projected Sales Unit (1st year) ">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--/span-->
                                                </div>
                                                <div class="error"></div>

                                                <h4 class="form-section">Project Cost (INR)</h4>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <table class="table table-bordered">
                                                                <thead>
                                                                    <tr>
                                                                        <td  align="center">Plant and Machinery <span class="required" aria-required="true"> * </span></td>
                                                                        <td  align="center">Building <span class="required" aria-required="true"> * </span></td>
                                                                        <!--<td  align="center">Site Development <span class="required" aria-required="true"> * </span></td>-->
                                                                        <td  align="center">Others <span class="required" aria-required="true"> * </span></td>
                                                                        <td  align="center">Total Project Cost</td>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td><input class="form-control decimal" value="<?= @$incmplt_fields->plant_machinery_invst ?>" onblur="sumupInvst(this.id)" required onkeyup="sumupInvst(this.id)" id="plant_machinery_invst" name="plant_machinery_invst" type="text"></td>
                                                                        <td><input class="form-control decimal" value="<?= @$incmplt_fields->building_construction_invst ?>" onblur="sumupInvst(this.id)" required onkeyup="sumupInvst(this.id)" id="building_construction_invst" name="building_construction_invst" type="text"></td>
                                                                        <!--<td><input class="form-control decimal" value="<?= @$incmplt_fields->site_development_invst ?>" onblur="sumupInvst(this.id)" required onkeyup="sumupInvst(this.id)" id="site_development_invst" name="site_development_invst" type="text"></td>-->
                                                                        <td><input class="form-control decimal" value="<?= @$incmplt_fields->other_invst ?>" onblur="sumupInvst(this.id)" required onkeyup="sumupInvst(this.id)" id="other_invst" name="other_invst" type="text"></td>
                                                                        <td><input class="form-control decimal" value="<?= @$incmplt_fields->total_investment ?>" readonly id="total_investment" required name="total_investment" type="text"></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <!--/span-->
                                                </div>

                                                <h4 class="form-section">Means of Finance (INR)</h4>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <table class="table table-bordered">
                                                                <thead>
                                                                    <tr>
                                                                        <td align="center">Equity <span class="required" aria-required="true"> * </span></td>
                                                                        <td align="center">Term Loan <span class="required" aria-required="true"> * </span></td>
                                                                        <td align="center">Assistance From Other Sources <span class="required" aria-required="true"> * </span></td>
                                                                        <td align="center">Working Capital <span class="required" aria-required="true"> * </span></td>
                                                                        <td align="center">Total</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td><input class="form-control decimal" value="<?= @$incmplt_fields->mean_of_fin_equity ?>" id="mean_of_fin_equity" name="mean_of_fin_equity" onblur="sumupMeans(this.id)" required onkeyup="sumupMeans(this.id)" type="text"></td>
                                                                        <td><input class="form-control decimal" value="<?= @$incmplt_fields->mean_of_fin_term_loan ?>" id="mean_of_fin_term_loan" name="mean_of_fin_term_loan" onblur="sumupMeans(this.id)" required onkeyup="sumupMeans(this.id)" type="text"></td>
                                                                        <td><input class="form-control decimal" value="<?= @$incmplt_fields->mean_of_fin_assistance ?>" id="mean_of_fin_assistance" name="mean_of_fin_assistance" onblur="sumupMeans(this.id)" required onkeyup="sumupMeans(this.id)" type="text"></td>
                                                                        <td><input class="form-control decimal" value="<?= @$incmplt_fields->mean_of_fin_grant ?>" id="mean_of_fin_grant" name="mean_of_fin_grant" onblur="sumupMeans(this.id)" required onkeyup="sumupMeans(this.id)" type="text"></td>
                                                                        <td><input class="form-control decimal" value="<?= @$incmplt_fields->total_means ?>" readonly id="total_means" required name="total_means" type="text"></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <!--/span-->
                                                </div>


                                                <h4 class="form-section">Proposed Employment Details</h4>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <table class="table table-bordered">
                                                                <thead>
                                                                    <tr>
                                                                        <td colspan="2" align="center">Managerial</td>
                                                                        <td colspan="2" align="center">Supervisor</td>
                                                                        <td colspan="2" align="center">Skilled</td>
                                                                        <td colspan="2" align="center">Unskilled</td>
                                                                        <td colspan="2" align="center">Total Employment</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td align="center">Male <span class="required" aria-required="true"> * </span></td>
                                                                        <td align="center">Female <span class="required" aria-required="true"> * </span></td>
                                                                        <td align="center">Male <span class="required" aria-required="true"> * </span></td>
                                                                        <td align="center">Female <span class="required" aria-required="true"> * </span></td>
                                                                        <td align="center">Male <span class="required" aria-required="true"> * </span></td>
                                                                        <td align="center">Female <span class="required" aria-required="true"> * </span></td>
                                                                        <td align="center">Male <span class="required" aria-required="true"> * </span></td>
                                                                        <td align="center">Female <span class="required" aria-required="true"> * </span></td>
                                                                        <td align="center">Male <span class="required" aria-required="true"> * </span></td>
                                                                        <td align="center">Female <span class="required" aria-required="true"> * </span></td>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td><input class="form-control digits" onblur="sumupMaleEmp(this.id)" required onkeyup="sumupMaleEmp(this.id)" value="<?= @$incmplt_fields->manegerial_emp_male ?>" id="manegerial_emp_male" name="manegerial_emp_male" type="text"></td>
                                                                        <td><input class="form-control digits" onblur="sumupFemaleEmp(this.id)" required onkeyup="sumupFemaleEmp(this.id)" value="<?= @$incmplt_fields->manegerial_emp_female ?>" id="manegerial_emp_female" name="manegerial_emp_female" type="text"></td>

                                                                        <td><input class="form-control digits" onblur="sumupMaleEmp(this.id)" required onkeyup="sumupMaleEmp(this.id)" value="<?= @$incmplt_fields->supervisor_emp_male ?>" id="supervisor_emp_male" name="supervisor_emp_male" type="text"></td>
                                                                        <td><input class="form-control digits" onblur="sumupFemaleEmp(this.id)" required onkeyup="sumupFemaleEmp(this.id)" value="<?= @$incmplt_fields->supervisor_emp_female ?>" id="supervisor_emp_female" name="supervisor_emp_female" type="text"></td>

                                                                        <td><input class="form-control digits" onblur="sumupMaleEmp(this.id)" required onkeyup="sumupMaleEmp(this.id)" value="<?= @$incmplt_fields->skilled_emp_male ?>" id="skilled_emp_male" name="skilled_emp_male" type="text"></td>
                                                                        <td><input class="form-control digits" onblur="sumupFemaleEmp(this.id)" required onkeyup="sumupFemaleEmp(this.id)" value="<?= @$incmplt_fields->skilled_emp_female ?>" id="skilled_emp_female" name="skilled_emp_female" type="text"></td>

                                                                        <td><input class="form-control digits" onblur="sumupMaleEmp(this.id)" required onkeyup="sumupMaleEmp(this.id)" value="<?= @$incmplt_fields->unskilled_emp_male ?>" id="unskilled_emp_male" name="unskilled_emp_male" type="text"></td>
                                                                        <td><input class="form-control digits" onblur="sumupFemaleEmp(this.id)" required onkeyup="sumupFemaleEmp(this.id)" value="<?= @$incmplt_fields->unskilled_emp_female ?>" id="unskilled_emp_female" name="unskilled_emp_female" type="text"></td>

                                                                        <td><input class="form-control digits" readonly id="total_emp_male" required name="total_emp_male" value="<?= @$incmplt_fields->total_emp_male ?>" type="text"></td>
                                                                        <td><input class="form-control digits" readonly id="total_emp_female" required name="total_emp_female" value="<?= @$incmplt_fields->total_emp_female ?>" type="text"></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <!--/span-->
                                                </div>

                                                <h4 class="form-section">Effluent Details</h4>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="control-label col-md-12">Estimated Annual Solid Wastage in Kg<span class="required" aria-required="true"> * </span></label>
                                                            <div class="col-md-12">
                                                                <input type="text" id="solid_waste_per_kg" class="form-control digits" value="<?= @$incmplt_fields->solid_waste_per_kg ?>" required name="solid_waste_per_kg" placeholder="*  Solid Wastage (Kg per day)">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--/span-->
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="control-label col-md-12">Estimated Annual Liquid Wastage in Litres<span class="required" aria-required="true"> * </span></label>
                                                            <div class="col-md-12">
                                                                <input type="text" id="liquid_waste_per_kg" class="form-control digits" value="<?= @$incmplt_fields->liquid_waste_per_kg ?>" required name="liquid_waste_per_kg" placeholder="*  Liquid Wastage (Litres per day)">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--/span-->
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="control-label col-md-12">Estimated Annual Gas Wastage in Cubic Metres<span class="required" aria-required="true"> * </span></label>
                                                            <div class="col-md-12">
                                                                <input type="text" id="gases" class="form-control digits" value="<?= @$incmplt_fields->gases ?>" required name="gases" placeholder="*  Gases">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <h4 class="form-section">Implementation Schedule</h4>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <table class="table table-bordered">
                                                                <thead>
                                                                    <tr>
                                                                            <!--<td>Acquistion of Land within months from date of Land / Shed allotment <span class="required" aria-required="true"> * </span></td>-->
                                                                        <td>Start of construction within months from date of acquistion of Land <span class="required" aria-required="true"> * </span></td>
                                                                        <td>Installation / Erection of months within months from date of start of construction<span class="required" aria-required="true"> * </span></td>
                                                                        <td>Commercial production within months from date of Installation / Erection <span class="required" aria-required="true"> * </span></td>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                            <!--<td>
                                                                                    <input class="form-control digits" required value="<?= @$incmplt_fields->acquistion_month ?>" placeholder="* Month from Date of Land / Shed Allotment" id="acquistion_month" name="acquistion_month" type="text">
                                                                            </td>-->
                                                                        <td>
                                                                            <input class="form-control digits" required value="<?= @$incmplt_fields->construction_month ?>" placeholder="* Month from Date of Land / Shed Allotment" id="construction_month" name="construction_month" type="text">
                                                                        </td>
                                                                        <td>
                                                                            <input class="form-control digits" required value="<?= @$incmplt_fields->installation_month ?>" placeholder="* Month from Date of Land / Shed Allotment" id="installation_month" name="installation_month" type="text">
                                                                        </td>
                                                                        <td>
                                                                            <input class="form-control digits" required value="<?= @$incmplt_fields->commercial_month ?>" placeholder="* Month from Date of Land / Shed Allotment" id="commercial_month" name="commercial_month" type="text">
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <!--/span-->
                                                </div>

                                                <div class="form-actions">
                                                    <div class="row">
                                                        <div class="col-md-12 text-center">
                                                            <input value="<?= @$incmplt_fields->equityPtage ?>" id="equityPtage" name="equityPtage" type="hidden">
                                                            <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Save & Next</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>       
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?= Yii::app()->theme->baseUrl ?>/assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="<?= Yii::app()->theme->baseUrl ?>/assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
<script src="<?= Yii::app()->theme->baseUrl ?>/assets/global/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?= Yii::app()->theme->baseUrl ?>/assets/pages/scripts/form-wizard.min.js" type="text/javascript"></script>

<!-- form repeater js -->
<script src="<?= Yii::app()->theme->baseUrl ?>/assets/global/plugins/jquery-repeater/jquery.repeater.js" type="text/javascript"></script>
<script src="<?= Yii::app()->theme->baseUrl ?>/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
<script src="<?= Yii::app()->theme->baseUrl ?>/assets/pages/scripts/form-repeater.min.js" type="text/javascript"></script>
<script src="<?= Yii::app()->theme->baseUrl ?>/assets/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>
<script src="<?= Yii::app()->theme->baseUrl ?>/assets/global/plugins/bootstrap-datepicker/js/moment.min.js" type="text/javascript"></script>
<script src="<?= Yii::app()->theme->baseUrl ?>/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>

<script type="text/javascript">
                                                                                                    $(document).ready(function () {
                                                                                                        $('.MasterSelectBox').pairMaster();

                                                                                                        $('#btnAdd').click(function (event) {
                                                                                                            event.preventDefault();
                                                                                                            $('.MasterSelectBox').addSelected('.PairedSelectBox');
                                                                                                        });

                                                                                                        $('#btnRemove').click(function (event) {
                                                                                                            event.preventDefault();
                                                                                                            $('.PairedSelectBox').removeSelected('.MasterSelectBox');
                                                                                                        });



                                                                                                        $(".date-picker").datepicker({
                                                                                                            rtl: App.isRTL(),
                                                                                                            autoclose: !0,
                                                                                                            startDate: "dateToday",
                                                                                                            format: 'd-MM-yyyy',
                                                                                                            useCurrent: false,
                                                                                                        })

                                                                                                        $(".date-picker2").datepicker({
                                                                                                            rtl: App.isRTL(),
                                                                                                            autoclose: !0,
                                                                                                            endDate: "dateToday",
                                                                                                            format: 'd-MM-yyyy',
                                                                                                            useCurrent: false,
                                                                                                        })

                                                                                                        if ($("#is_currently_registered").val() == "N" || $("#is_currently_registered").val() == "") {
                                                                                                            $(".registered_detail").slideUp();
                                                                                                            $("#registration_number").attr('required', false);
                                                                                                            $("#registration_date").attr('required', false);
                                                                                                        } else {
                                                                                                            $(".registered_detail").slideDown();
                                                                                                            $("#registration_number").attr('required', true);
                                                                                                            $("#registration_date").attr('required', true);
                                                                                                        }
                                                                                                        sumupInvst();
                                                                                                        sumupMaleEmp();
                                                                                                        sumupFemaleEmp();
                                                                                                        sumupMeans();
                                                                                                        // getDisEstates();
                                                                                                        // getDisEstateArea();
                                                                                                    });

                                                                                                    function CalculateEquityPtage() {
                                                                                                        var mean_of_fin_equity = $("#mean_of_fin_equity").val();
                                                                                                        var total_investment = $("#total_investment").val();
                                                                                                        if ((typeof mean_of_fin_equity === "undefined" || mean_of_fin_equity === "") && typeof total_investment === "undefined" || total_investment === "")
                                                                                                            return false;
                                                                                                        var val = 0;
                                                                                                        if (isNaN(parseFloat(parseInt(mean_of_fin_equity))))
                                                                                                            mean_of_fin_equity = 0.0;
                                                                                                        if (isNaN(parseFloat(parseInt(total_investment))))
                                                                                                            total_investment = 0.0;
                                                                                                        val = 100 * parseFloat(parseInt(mean_of_fin_equity));
                                                                                                        val = val / parseFloat(parseInt(total_investment));
                                                                                                        $("#equityPtage").val(val);

                                                                                                    }

                                                                                                    $(".mt-repeater-add").on("click", function () {
                                                                                                        if ($("#data_pro").children('div').length >= 5) {
                                                                                                            $(".mt-repeater-add").hide();
                                                                                                        }
                                                                                                    });

                                                                                                    $(".btn-success").on("click", function () {
                                                                                                        if ($("#total_investment").val() != $('#total_means').val()) {
                                                                                                            $(".error").empty();
                                                                                                            $(".error").addClass("alert alert-danger");
                                                                                                            $(".error").html("Total of Project Cost not equal to Means of Finance Total !!!!");
                                                                                                            $('html, body').animate({scrollTop: $('.error').position().top}, 'slow');
                                                                                                            return false;
                                                                                                        }
                                                                                                    });

                                                                                                    $(".mt-repeater-delete").on("click", function () {
                                                                                                        if ($("#data_pro").children('div').length < 5) {
                                                                                                            $(".mt-repeater-add").show();
                                                                                                        }
                                                                                                    });

                                                                                                    function getDisEstates(id) {
                                                                                                        var html = "";
                                                                                                        $("#estate").empty();
                                                                                                        html += "<option value=''>---Please Select District---</option>";
                                                                                                        $("#estate").append(html);
                                                                                                        // var html = "";
                                                                                                        // $("#area_square_meter").empty();
                                                                                                        // html += "<optgroup label='---Please Select Available Area---'></optgroup>";
                                                                                                        // $("#area_square_meter").append(html);
                                                                                                        var dis_id = $("#district").val();
                                                                                                        var data = {"requestTO": "getEstatesByDistrictid", "dis_id": dis_id};
                                                                                                        var url = "<?= @Yii::app()->createAbsoluteUrl('/frontuser/ajax') ?>";
                                                                                                        $.ajax({
                                                                                                            type: "POST",
                                                                                                            url: url,
                                                                                                            data: data,
                                                                                                            success: function (data) {
                                                                                                                var html = "";
                                                                                                                if (data != "") {
                                                                                                                    data = JSON.parse(data);
                                                                                                                    if (data.auction == 1) {
                                                                                                                        $(".alert-message-error").empty();
                                                                                                                        $(".alert-message-error").html('Auction Closed for this District.');
                                                                                                                        $(".alert-message-error").focus();
                                                                                                                        $(".alert-message-error").removeClass('display-none');
                                                                                                                        $("html, body").animate({scrollTop: 0}, "slow");
                                                                                                                    } else {
                                                                                                                        $("#estate").empty();
                                                                                                                        html += "<option value=''>---Please Select Estate---</option>";
                                                                                                                        $.each(data.RESPONSE, function (k, v) {
                                                                                                                            html += "<option value='" + v.land_estate_id + "'>" + v.land_estate_name + "</option>";
                                                                                                                        });
                                                                                                                        $("#estate").append(html);
                                                                                                                    }
                                                                                                                }
                                                                                                            },
                                                                                                            error: function (data) {
                                                                                                                console.log(data);
                                                                                                            }
                                                                                                        })
                                                                                                    }

                                                                                                    function getDisEstate(id) {
                                                                                                        var html = "";
                                                                                                        $("#area_square_meter").empty();
                                                                                                        html += "<option value=''>---Please Select Available Area---</option>";
                                                                                                        $("#area_square_meter").append(html);
                                                                                                        var dis_id = $("#estate").val();
                                                                                                        var data = {"requestTO": "getEstateByDistrictid", "dis_id": dis_id};
                                                                                                        var url = "<?= @Yii::app()->createAbsoluteUrl('/frontuser/ajax') ?>";
                                                                                                        $.ajax({
                                                                                                            type: "POST",
                                                                                                            url: url,
                                                                                                            data: data,
                                                                                                            success: function (data) {
                                                                                                                var html = "";
                                                                                                                data = JSON.parse(data);
                                                                                                                if (data.length > 0) {
                                                                                                                    $("#area_square_meter").empty();
                                                                                                                    // $(".PairedSelectBox").empty();
                                                                                                                    // html += "<option value=''>---Please Select Available Area---</option>";
                                                                                                                    html += "<optgroup label='---Please Select Available Area---'>";
                                                                                                                    $.each(data, function (k, v) {
                                                                                                                        html += "<option value='" + v.plot_id + "'>" + v.area_name + " ( " + v.plot_area + " )</option>";
                                                                                                                    });
                                                                                                                    html += "</optgroup>";
                                                                                                                    console.log(html);
                                                                                                                    $("#area_square_meter").append(html);
                                                                                                                } else {
                                                                                                                    $("#area_square_meter").empty();
                                                                                                                    html += "<optgroup label='---No Available Plots Found For Allotment---'></optgroup>";
                                                                                                                    $("#area_square_meter").append(html);
                                                                                                                }
                                                                                                            },
                                                                                                            error: function (data) {
                                                                                                                console.log(data);
                                                                                                            }
                                                                                                        })
                                                                                                    }

                                                                                                    function getDisEstateArea(id) {
                                                                                                        console.log(id);
                                                                                                        var dis_id = $("#estate").val();
                                                                                                        var data = {"requestTO": "getEstateAreaByEstateid", "dis_id": dis_id};
                                                                                                        var url = "<?= @Yii::app()->createAbsoluteUrl('/frontuser/ajax') ?>";
                                                                                                        $.ajax({
                                                                                                            type: "POST",
                                                                                                            url: url,
                                                                                                            data: data,
                                                                                                            success: function (data) {
                                                                                                                // console.log();
                                                                                                                if (data != "") {
                                                                                                                    $("#estate_linkk").attr("href", "");
                                                                                                                    $("#estate_linkk").attr("href", data);
                                                                                                                    $("#estate_link").val("");
                                                                                                                    $("#estate_link").val(data);
                                                                                                                }
                                                                                                            },
                                                                                                            error: function (data) {
                                                                                                                console.log(data);
                                                                                                            }

                                                                                                        })
                                                                                                    }

                                                                                                    function sumupInvst(id) {
                                                                                                        var sum = 0;
                                                                                                        var plant_machinery_invst = $('#plant_machinery_invst').val();
                                                                                                        if (isNaN(parseFloat(plant_machinery_invst)))
                                                                                                            plant_machinery_invst = 0.0;

                                                                                                        var building_construction_invst = $('#building_construction_invst').val();
                                                                                                        if (isNaN(parseFloat(building_construction_invst)))
                                                                                                            building_construction_invst = 0.0;

//	    var site_development_invst=$('#site_development_invst').val();
//	    if(isNaN(parseFloat(site_development_invst)))
//	      site_development_invst=0.0;

                                                                                                        var other_invst = $('#other_invst').val();
                                                                                                        if (isNaN(parseFloat(other_invst)))
                                                                                                            other_invst = 0.0;

                                                                                                        sum = parseFloat(plant_machinery_invst) + parseFloat(building_construction_invst) + parseFloat(other_invst);//+ parseFloat(site_development_invst)
                                                                                                        $("#total_investment").val(sum.toFixed(2));
                                                                                                        CalculateEquityPtage();
                                                                                                    }

                                                                                                    function sumupMeans(id) {
                                                                                                        var sum = 0;
                                                                                                        var mean_of_fin_equity = $('#mean_of_fin_equity').val();
                                                                                                        if (isNaN(parseFloat(mean_of_fin_equity)))
                                                                                                            mean_of_fin_equity = 0.0;

                                                                                                        var mean_of_fin_term_loan = $('#mean_of_fin_term_loan').val();
                                                                                                        if (isNaN(parseFloat(mean_of_fin_term_loan)))
                                                                                                            mean_of_fin_term_loan = 0.0;

                                                                                                        var mean_of_fin_assistance = $('#mean_of_fin_assistance').val();
                                                                                                        if (isNaN(parseFloat(mean_of_fin_assistance)))
                                                                                                            mean_of_fin_assistance = 0.0;

                                                                                                        var mean_of_fin_grant = $('#mean_of_fin_grant').val();
                                                                                                        if (isNaN(parseFloat(mean_of_fin_grant)))
                                                                                                            mean_of_fin_grant = 0.0;

                                                                                                        sum = parseFloat(mean_of_fin_equity) + parseFloat(mean_of_fin_term_loan) + parseFloat(mean_of_fin_assistance) + parseFloat(mean_of_fin_grant);
                                                                                                        $("#total_means").val(sum.toFixed(2));
                                                                                                        CalculateEquityPtage();
                                                                                                    }

                                                                                                    function sumupMaleEmp(id) {
                                                                                                        var sum = 0;
                                                                                                        var manegerial_emp_male = $('#manegerial_emp_male').val();
                                                                                                        if (isNaN(parseFloat(manegerial_emp_male)))
                                                                                                            manegerial_emp_male = 0.0;

                                                                                                        var supervisor_emp_male = $('#supervisor_emp_male').val();
                                                                                                        if (isNaN(parseFloat(supervisor_emp_male)))
                                                                                                            supervisor_emp_male = 0.0;

                                                                                                        var skilled_emp_male = $('#skilled_emp_male').val();
                                                                                                        if (isNaN(parseFloat(skilled_emp_male)))
                                                                                                            skilled_emp_male = 0.0;

                                                                                                        var unskilled_emp_male = $('#unskilled_emp_male').val();
                                                                                                        if (isNaN(parseFloat(unskilled_emp_male)))
                                                                                                            unskilled_emp_male = 0.0;

                                                                                                        sum = parseFloat(manegerial_emp_male) + parseFloat(supervisor_emp_male) + parseFloat(skilled_emp_male) + parseFloat(unskilled_emp_male);
                                                                                                        $("#total_emp_male").val(sum);
                                                                                                    }

                                                                                                    function sumupFemaleEmp(id) {
                                                                                                        var sum = 0;
                                                                                                        var manegerial_emp_female = $('#manegerial_emp_female').val();
                                                                                                        if (isNaN(parseFloat(manegerial_emp_female)))
                                                                                                            manegerial_emp_female = 0.0;

                                                                                                        var supervisor_emp_female = $('#supervisor_emp_female').val();
                                                                                                        if (isNaN(parseFloat(supervisor_emp_female)))
                                                                                                            supervisor_emp_female = 0.0;

                                                                                                        var skilled_emp_female = $('#skilled_emp_female').val();
                                                                                                        if (isNaN(parseFloat(skilled_emp_female)))
                                                                                                            skilled_emp_female = 0.0;

                                                                                                        var unskilled_emp_female = $('#unskilled_emp_female').val();
                                                                                                        if (isNaN(parseFloat(unskilled_emp_female)))
                                                                                                            unskilled_emp_female = 0.0;

                                                                                                        sum = parseFloat(manegerial_emp_female) + parseFloat(supervisor_emp_female) + parseFloat(skilled_emp_female) + parseFloat(unskilled_emp_female);
                                                                                                        $("#total_emp_female").val(sum);
                                                                                                    }
</script>