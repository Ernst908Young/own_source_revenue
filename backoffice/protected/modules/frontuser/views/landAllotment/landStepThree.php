<link href="<?=Yii::app()->theme->baseUrl?>/assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
<link href="<?=Yii::app()->theme->baseUrl?>/assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="<?=Yii::app()->theme->baseUrl?>/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
<link href="<?=Yii::app()->theme->baseUrl?>/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />


<style type="text/css">
.custom_input {
    width: 30%;
}
.tdd
{
	font-size: 10px;
	font-weight: bold;
}

.psmall {
    text-align: justify;
    -webkit-margin-before: 1em;
    -webkit-margin-after: 1em;
    -webkit-margin-start: 0px;
    -webkit-margin-end: 0px;
}
	/*tr > th {
	    text-align: center;
	}*/
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


	@import "compass/css3";

@import url("http://fonts.googleapis.com/css?family=Lato");

$background: #e74c3c;
$file-upload-color: #c0392b;
$file-upload-size: 300px;

.custom-file-upload-hidden {
    display: none;
    visibility: hidden;
    position: absolute;
    left: -9999px;
}
.custom-file-upload {
    display: block;
    width: auto;
    font-size: 16px;
    margin-top: 30px;
   
    label {
        display: block;
        margin-bottom: 5px;
    }
}

.file-upload-wrapper {
    position: relative; 
    margin-bottom: 5px;

}
.file-upload-input {
    width: $file-upload-size;
	background: #f0f0f0 none repeat scroll 0 0;
	border: medium none;
	color: #2c3542;
	float: left;
	font-size: 16px;
	padding: 11px 17px;
}
.file-upload-button {
    cursor: pointer; 
    display: inline-block; 
    color: #fff;
    font-size: 16px;
    text-transform: uppercase;
    padding: 11px 20px; 
    border: none;
    margin-left: -1px;  
    float: left;
}
</style>
<?php 
// echo "<pre>"; print_r($docs); die;
$docModel=new ApplicationCdnMappingExt;
$uid = $uid = $_SESSION['RESPONSE']['user_id'];
$userAlreadyUploadedDocs=$docModel::isDocAlreadyUploadedByUser($uid);
$appDocs=$docModel::getApplicationDocuments($uid,8);
$labelArray = array("edu_cert_qual"=>"Document Certifying Educational Qualification",
					"edu_tech_qual"=>"Document Certifying Technical Qualification",
					"cert_prof_exp"=>"Self Certification for Professional Experience",
					"cert_equity"=>"Self Certification / CA's Certificate certifying the Equity Contribution made",
					"cert_unit_approv_sanct"=>"Sanction Letter from FI / NBFC",
					"cert_project_cost"=>"For Micro Units - Self Certification / CA's Certificate certifying the Project Cost with breakdown",
					"cert_debt_cover_ratio"=>"For Micro Units - Self Certification / CA's Certificate certifying the Debt Coverage Ratio",

					// "cert_poll_cat"=>"Pollution Category",

					"cert_adpt_water_system"=>"Self Certification detailing the water discharge, its treatment and conservation techniques",
					"cert_usage_local_materail"=>"Self Certifcation certifying the percentage of local raw materials of the total raw materials usage",
					"cert_regist_startup"=>"Document certifying whether the unit is registered as a Startup with the Ministry of MSME / DIPP, Government of India",
					"cert_land_acquistion"=>"Sale Deed of the concerned land",
					// "cert_enterprenure_type"=>"Type of Enterpreneur",
					// "cert_unit_type"=>"Type of unit",
					"cert_unit_benifited"=>"Notarised Affidavit on a Non Judicial Stamp Paper of Rs. 10 mentioning whether unit benefited through Central / State sponsored schemes with details"
				);

$QuesAns['edu_cert_qual']=array("intermediate"=>"Upto Class 12","graduation"=>"Graduation","post_grad_or_above"=>"Post-Graduation and Above");
$QuesAns['edu_tech_qual']=array("none"=>"None","iti"=>"ITI","diploma"=>"Diploma","BE_BTech_MCA_MBA_CA"=>"BE / B.Tech / MCA / MBA / CA");
$QuesAns['cert_prof_exp']=array("non_similar"=>"Experience in Non - Similar Line","similar"=>"Experience in Similar Line","none"=>"None");
// $QuesAns['cert_equity']=array("upto_10"=>"Upto 10% of the project cost","every_10"=>"For every 10% additional, two marks will be given");
$QuesAns['cert_equity']=array('less_then_19'=>'< 19.99%','greater_then_12_less_then_29_99'=>'>= 20.00% to < 29.99%','greater_then_30_less_then_39_99'=>'>= 30.00% to < 39.99%','greater_then_40'=>'>= 40.00%');
$QuesAns['cert_unit_approv_sanct']=array("Yes"=>"Yes","none"=>"No");
$QuesAns['cert_project_cost']=array("1cr"=>"Above 1 crore","50lcs"=>"Above 50 Lakhs","25lcs"=>"Above 25 Lakhs", "below25lcs"=>"Below 25 Lakhs");
$QuesAns['cert_debt_cover_ratio']=array("none"=>"More than 2.00 or Not applicable in case of No Loans","1.70-2.00"=>"1.70 to 2.00","1.50-1.75"=>"1.50 to 1.75","1.25-1.50"=>"1.25 to 1.50","1.00-1.25"=>"1.00 to 1.25");
// $QuesAns['cert_poll_cat']=array("white"=>"White","green"=>"Green","orange"=>"Orange","red"=>"Red");
$QuesAns['cert_adpt_water_system']=array("yes"=>"Yes","none"=>"No");
$QuesAns['cert_usage_local_materail']=array("30%"=>"For 30% of total raw material","10%"=>"For 10% additional, one mark will be given","none"=>"None");
$QuesAns['cert_regist_startup']=array("yes"=>"Yes","none"=>"No");
$QuesAns['cert_land_acquistion']=array("acquired"=>"yes","none"=>"no");
// $QuesAns['cert_enterprenure_type']=array("women"=>"Women","army_fighter"=>"Retired Army professional and / or Freedom fighters","none"=>"None of above");
// $QuesAns['cert_unit_type']=array("vender"=>"Export Oriented and Ancillary / Vendor units for Large and Medium Industries","none"=>"If not as above");
$QuesAns['cert_unit_benifited']=array("yes"=>"Yes","none"=>"No");

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
	                        <i class="fa fa-gift"></i>Land Allotment Form - Step 3
	                    </div>
	                </div>
		            <div class="portlet-body form">
	                    <div class="form-wizard">
	                        <div class="form-body">
	            	            <div class="portlet-body form">
	                         		<div class="form-body">
										<ul class="nav nav-pills nav-justified steps">
											<li class="done">
												<a data-toggle="tab" class="step">
													<span class="number"> 1 </span>
													<span class="desc">
													<i class="fa fa-check"></i> Land Detail </span>
												</a>
											</li>
											<li class="done">
												<a data-toggle="tab" class="step">
													<span class="number"> 2 </span>
													<span class="desc">
													<i class="fa fa-check"></i> Evaluation CheckList</span>
												</a>
											</li>
											<li class="active">
												<a href="#tab3" data-toggle="tab" class="step">
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
	        	                            <button class="close" data-dismiss="alert"></button> You have some form errors. Please check below.
	        	                        </div>
	        	                        <div class="alert alert-success alert-message-success display-none">
	        	                            <button class="close" data-dismiss="alert"></button> Your form validation is successful!
	        	                        </div>
	        	                        <?php 
	        	                          foreach(Yii::app()->user->getFlashes() as $key => $message) {
	        	                                echo '<div class="alert alert-'.$key.'"><button class="close" data-dismiss="alert"></button> 
	        	                                       ' . $message . 
	        	                                      '</div>';
	        	                                }
	        	                        ?>
	        	                        <div class="tab-pane active" id="tab3">
		                                    <div class="row">
		                                        <div class="col-md-12">
		                                            <div class="form-group">
		                                                <div class="col-md-12">
															<?php
								                               $docUploadPening=false;
								                               $count=1;
								                               $docModel=new ApplicationCdnMappingExt;
								                               $docs=$docModel::getApplicationDocumentOnly($app['application_id']);
								                               $userAlreadyUploadedDocs=$docModel::isDocAlreadyUploadedByUser($pre_field['user_id']);
								                               // echo $submission_id."<pre>====>";
								                               // // print_r($docs);
								                               // print_r($incmplt_fields);
								                               // // echo $pre_field['user_id'];
								                               // // print_r($userAlreadyUploadedDocs);
								                               // die;
								                               if($docs){
								                               		$cnt=1;
								                                   echo '<div class="table table-responsive" style="overflow-x:hidden">
								                                           <table class="table" width="100%">
								                                               <thead>
								                                               		<tr>
									                                                  <th colspan="6"> Certified Documents to be Submitted </th>
									                                                </tr>
								                                                   <tr>
								                                                   	   <td class="tdd"> S.No. </td>
								                                                       <td class="tdd" colspan="2"> Document Name </td>
								                                                       <td class="tdd"> File Type </td>
								                                                       <td class="tdd"> Document Size </td>
								                                                       <td class="tdd"> Document Status </td>
								                                                       <td class="tdd"> Action </td>
								                                                   </tr>
								                                               </thead>
								                                               <tbody>';
								                                                $RegularDocsId=array('44','45');
								                                                $ExpansionDoc=array('9');
								                                                $EvaluationDocId=array('10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','28','29','30','31','32','33','34','35','36','37','38','39','40','41','42','43','76','77','78');
								                                                $otherDOcs=array('56','57','58');
								                                                $proprietorship = array('79','80');
								                                                $partnership_firm = array('81','82','83','84','85');
								                                                $limited_liability_partnership = array('81','82','83','84','85');
								                                                $private_limited_company = array('86','87','88','89','90','84','85');
								                                                $public_limited_company = array('86','87','88','89','90','84','85');
								                                                $cooperative_society = array('91','92','93','84','85');
								                                                $self_help_group = array('91','94','95','84','85');
								                                                $section_25_company = array('86','87','88','89','90','84','85');
								                                                $one_man_company = array('86','87','88','96','97');

								                                                $consitutionID = explode("_id_", $incmplt_fields->firm_company_constitution);

								                                                foreach ($docs as $doc) {
								                                                    $docInfo=$docModel::isDocAlreadyUploadedByUser($pre_field['user_id'],$doc['doc_id']);
								                                                    $UserAppDocs = $this->GetUserApplicationDocuments($doc['doc_id'],$submission_id);
								                                                    // REGILAR DOCS
								                                                    if(in_array($doc['doc_id'], $userAlreadyUploadedDocs) && in_array($doc['doc_id'], $RegularDocsId) ) {
								                                                    	 echo "<!--<pre>!====>";print_r($docInfo); print_r($UserAppDocs);echo "-->";
								                                                        $docInfo=$docModel::isDocAlreadyUploadedByUser($pre_field['user_id'],$doc['doc_id']);
								                                                        if(empty($UserAppDocs) || ($doc['is_doc_req_everytime']=='Y' && $docInfo['doc_status']=='R')){
								                                                            $docUploadPening=true;
								                                                            echo "<tr>
								                                                            	<td>$cnt</td>
								                                                            	<td><form action='".Yii::app()->createAbsoluteUrl('frontuser/landAllotment/uploadInvestorDocs')."' onsubmit='ShowLoader()' method='POST' enctype='multipart/form-data'>";
								                                                                 if($doc['is_doc_mendatory']=='Y')
								                                                                    $docUploadPening=true;
								                                                                 $name=$doc['doc_name'];
								                                                                  $name=explode("_doc", $name);
								                                                                   if (preg_match('/_/',$doc['doc_name']))
								                                                                     $doc['doc_name']=str_replace('_', ' ', $name[0]);
								                                                                   if($doc['is_doc_mendatory'] && !in_array($doc['doc_id'], $otherDOcs)){
								                                                                     $doc["doc_name"] = str_replace("*","",$doc["doc_name"]);
								                                                                     echo "<span class='required'>*</span> ". ucwords($doc["doc_name"]);
								                                                                   }
								                                                                   else{
								                                                                     echo ucwords(strtolower($doc["doc_name"]));
								                                                                   }
								                                                                 echo "</td>";
										                                                         echo "<td>&nbsp;</td>";
								                                                                 echo "<td>";
								                                                                   if($doc['doc_type'] == "pdf")
								                                                                     echo "application/pdf <input type='hidden' name='selected_doc_type' value='application/pdf'>";
								                                                                   elseif($doc['doc_type'] == "image/jpeg")
								                                                                     echo "image/png <input type='hidden' name='selected_doc_type' value='image/jpeg'>";
								                                                                   echo "</td><td>".$doc["doc_min_size"]."-".$this->calculateFileSize($doc["doc_max_size"])."</td>
								                                                                <td>";
								                                                                 echo '<div class="fileinput fileinput-new" data-provides="fileinput">
								                                                                         <span class="btn btn-default btn-file">
								                                                                           <span class="fileinput-new">Select file</span>
								                                                                           <span class="fileinput-exists">Change</span>';
								                                                                     echo "<input type='file' name='caf_applications_uploads' class='upload ";
								                                                                             if($name == '*id_card')
								                                                                               echo " req' required ";
								                                                                             if($name == '*address_proof')
								                                                                               echo " req' required ";
								                                                                             if($name == '*brief_project_report')
								                                                                               echo " req' required ";
								                                                                             else
								                                                                               echo " '";
								                                                                            echo "/>
								                                                                           <input type='hidden' name='FileUpload[doc_id]' value='".$doc['doc_id']."'>
								                                                                           <input type='hidden' name='FileUpload[app_id]' value='".$app['application_id']."'>
								                                                                           <input type='hidden' name='FileUpload[YII_CSRF_TOKEN]' value='".Yii::app()->getRequest()->getCsrfToken()."' />";
								                                                                   echo '</span>
								                                                                         <span class="fileinput-filename"></span>
								                                                                         <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">&times;</a>
								                                                                       </div>';
								                                                                echo "</td>
								                                                                <td><input type='submit' value='Upload' class='btn btn-primary'></td></tr></form>";
								                                                                $cnt++;
								                                                        }
								                                                        else{
								                                                             echo "<tr>
								                                                            	<td>$cnt</td>
								                                                            	<td>";
								                                                                  $name=$doc['doc_name'];
								                                                                  $name=explode("_doc", $name);
								                                                                   if (preg_match('/_/',$doc['doc_name']))
								                                                                     $doc['doc_name']=str_replace('_', ' ', $name[0]);
								                                                                   if($doc['is_doc_mendatory'] && !in_array($doc['doc_id'], $otherDOcs)){
								                                                                     $doc["doc_name"] = str_replace("*","",$doc["doc_name"]);
								                                                                     echo "<span class='required'>*</span> ". ucwords($doc["doc_name"]);
								                                                                   }
								                                                                   else{
								                                                                     echo ucwords(strtolower($doc["doc_name"]));
								                                                                   }
								                                                                     echo "</td>
								                                                                   <td>".$docInfo['document_name']."</td><td>".$docInfo["document_mime_type"]."</td><td>".$doc["doc_min_size"]."-".$this->calculateFileSize($doc["doc_max_size"])."</td>
								                                                                <td>
								                                                                   ";
								                                                                       if($docInfo['doc_status']=='P')
								                                                                         echo "<span class='label label-primary'>Uploaded</span>";
								                                                                       elseif($docInfo['doc_status']=='V')
								                                                                         echo "<span class='label label-success'> Verified </span>";
								                                                                       elseif($docInfo['doc_status']=='R')
								                                                                         echo "<span class='label label-danger'> Rejected </span>";
								                                                                   echo "
								                                                                </td>
								                                                                <td>No Action Required</td>
								                                                             </tr>";
								                                                             $cnt++;
								                                                        }
								                                                    }
								                                                    // EXPANSION DOCS
								                                                    elseif( ($incmplt_fields->nature_of_area=="modernization" || $incmplt_fields->nature_of_area=="expansion" )&& in_array($doc['doc_id'], $userAlreadyUploadedDocs) && in_array($doc['doc_id'], $ExpansionDoc) ) {
								                                                    // elseif( ($incmplt_fields->nature_of_area=="expansion") && in_array($doc['doc_id'], $userAlreadyUploadedDocs) && in_array($doc['doc_id'], $ExpansionDoc) ) {
								                                                        $docInfo=$docModel::isDocAlreadyUploadedByUser($pre_field['user_id'],$doc['doc_id']);
								                                                        if(empty($UserAppDocs) || ($doc['is_doc_req_everytime']=='Y' && $docInfo['doc_status']=='R')){
								                                                            $docUploadPening=true;
								                                                            echo "<tr>
								                                                            	<td>$cnt</td>
								                                                            	<td><form action='".Yii::app()->createAbsoluteUrl('frontuser/landAllotment/uploadInvestorDocs')."' onsubmit='ShowLoader()' method='POST' enctype='multipart/form-data'>";
								                                                                 if($doc['is_doc_mendatory']=='Y')
								                                                                    $docUploadPening=true;
								                                                                 // $name=$doc['doc_name'];
								                                                                 //  $name=explode("_doc", $name);
								                                                                 //   if (preg_match('/_/',$doc['doc_name']))
								                                                                 //     $doc['doc_name']=str_replace('_', ' ', $name[0]);
								                                                                 //   if($doc['is_doc_mendatory'] && !in_array($doc['doc_id'], $otherDOcs)){
								                                                                 //     $doc["doc_name"] = str_replace("*","",$doc["doc_name"]);
								                                                                 //     echo "<span class='required'>*</span> ". ucwords($doc["doc_name"]);
								                                                                 //   }
								                                                                 //   else{
								                                                                 //     echo ucwords(strtolower($doc["doc_name"]));
								                                                                 //   }
								                                                                 echo "Copy of Registration Certificate for Existing Units";
								                                                                 echo "</td>";
										                                                         echo "<td>&nbsp;</td>";
								                                                                 echo "<td>";
								                                                                   if($doc['doc_type'] == "pdf")
								                                                                     echo "application/pdf <input type='hidden' name='selected_doc_type' value='application/pdf'>";
								                                                                   elseif($doc['doc_type'] == "image/jpeg")
								                                                                     echo "image/png <input type='hidden' name='selected_doc_type' value='image/jpeg'>";
								                                                                   echo "</td><td>".$doc["doc_min_size"]."-".$this->calculateFileSize($doc["doc_max_size"])."</td>
								                                                                <td>";
								                                                                 echo '<div class="fileinput fileinput-new" data-provides="fileinput">
								                                                                         <span class="btn btn-default btn-file">
								                                                                           <span class="fileinput-new">Select file</span>
								                                                                           <span class="fileinput-exists">Change</span>';
								                                                                     echo "<input type='file' name='caf_applications_uploads' class='upload ";
								                                                                             if($name == '*id_card')
								                                                                               echo " req' required ";
								                                                                             if($name == '*address_proof')
								                                                                               echo " req' required ";
								                                                                             if($name == '*brief_project_report')
								                                                                               echo " req' required ";
								                                                                             else
								                                                                               echo " '";
								                                                                            echo "/>
								                                                                           <input type='hidden' name='FileUpload[doc_id]' value='".$doc['doc_id']."'>
								                                                                           <input type='hidden' name='FileUpload[app_id]' value='".$app['application_id']."'>
								                                                                           <input type='hidden' name='FileUpload[YII_CSRF_TOKEN]' value='".Yii::app()->getRequest()->getCsrfToken()."' />";
								                                                                   echo '</span>
								                                                                         <span class="fileinput-filename"></span>
								                                                                         <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">&times;</a>
								                                                                       </div>';
								                                                                echo "</td>
								                                                                <td><input type='submit' value='Upload' class='btn btn-primary'></td></tr></form>";
								                                                                $cnt++;
								                                                        }
								                                                        else{
								                                                             echo "<tr>
								                                                            	<td>$cnt</td>
								                                                            	<td>";
								                                                                  $name=$doc['doc_name'];
								                                                                  $name=explode("_doc", $name);
								                                                                   if (preg_match('/_/',$doc['doc_name']))
								                                                                     $doc['doc_name']=str_replace('_', ' ', $name[0]);
								                                                                   if($doc['is_doc_mendatory'] && !in_array($doc['doc_id'], $otherDOcs)){
								                                                                     $doc["doc_name"] = str_replace("*","",$doc["doc_name"]);
								                                                                     echo "<span class='required'>*</span> ". ucwords($doc["doc_name"]);
								                                                                   }
								                                                                   else{
								                                                                     echo ucwords(strtolower($doc["doc_name"]));
								                                                                   }
								                                                                     echo "</td>
								                                                                   <td>".$docInfo['document_name']."</td><td>".$docInfo["document_mime_type"]."</td><td>".$doc["doc_min_size"]."-".$this->calculateFileSize($doc["doc_max_size"])."</td>
								                                                                <td>
								                                                                   ";
								                                                                       if($docInfo['doc_status']=='P')
								                                                                         echo "<span class='label label-primary'>Uploaded</span>";
								                                                                       elseif($docInfo['doc_status']=='V')
								                                                                         echo "<span class='label label-success'>Verified</span>";
								                                                                       elseif($docInfo['doc_status']=='R')
								                                                                         echo "<span class='label label-danger'>Rejected</span>";
								                                                                   echo "</span>
								                                                                </td>
								                                                                <td>No Action Required</td>
								                                                             </tr>";
								                                                             $cnt++;
								                                                        }
								                                                    }
								                                                    // CONSITUTION DOCS
								                                                    elseif( (in_array($doc['doc_id'], $userAlreadyUploadedDocs) && $consitutionID[0] == "proprietorship" && in_array($doc['doc_id'], $proprietorship)) ||
								                                                    	(in_array($doc['doc_id'], $userAlreadyUploadedDocs) && $consitutionID[0] == "partnership_firm" && in_array($doc['doc_id'], $partnership_firm)) || 
								                                                    	(in_array($doc['doc_id'], $userAlreadyUploadedDocs) && $consitutionID[0] == "limited_liability_partnership" && in_array($doc['doc_id'], $limited_liability_partnership)) || 
								                                                    	(in_array($doc['doc_id'], $userAlreadyUploadedDocs) && $consitutionID[0] == "private_limited_company" && in_array($doc['doc_id'], $private_limited_company)) || 
								                                                    	(in_array($doc['doc_id'], $userAlreadyUploadedDocs) && $consitutionID[0] == "public_limited_company" && in_array($doc['doc_id'], $public_limited_company)) || 
								                                                    	(in_array($doc['doc_id'], $userAlreadyUploadedDocs) && $consitutionID[0] == "cooperative_society" && in_array($doc['doc_id'], $cooperative_society)) || 
								                                                    	(in_array($doc['doc_id'], $userAlreadyUploadedDocs) && $consitutionID[0] == "self_help_group" && in_array($doc['doc_id'], $self_help_group)) || 
								                                                    	(in_array($doc['doc_id'], $userAlreadyUploadedDocs) && $consitutionID[0] == "section_25_company" && in_array($doc['doc_id'], $section_25_company)) || 
								                                                    	(in_array($doc['doc_id'], $userAlreadyUploadedDocs) && $consitutionID[0] == "one_man_company" && in_array($doc['doc_id'], $one_man_company))
								                                                      ) {
								                                                        $docInfo=$docModel::isDocAlreadyUploadedByUser($pre_field['user_id'],$doc['doc_id']);
								                                                        if(empty($UserAppDocs) || ($doc['is_doc_req_everytime']=='Y' && $docInfo['doc_status']=='R')){
								                                                            $docUploadPening=true;
								                                                            echo "<tr>
								                                                            	<td>$cnt</td>
								                                                            	<td><form action='".Yii::app()->createAbsoluteUrl('frontuser/landAllotment/uploadInvestorDocs')."' onsubmit='ShowLoader()' method='POST' enctype='multipart/form-data'>";
								                                                                 if($doc['is_doc_mendatory']=='Y')
								                                                                    $docUploadPening=true;
									                                                                 $name=$doc['doc_name'];
									                                                                  $name=explode("_doc", $name);
									                                                                   if (preg_match('/_/',$doc['doc_name']))
									                                                                     $doc['doc_name']=str_replace('_', ' ', $name[0]);
									                                                                   if($doc['is_doc_mendatory'] && !in_array($doc['doc_id'], $otherDOcs)){
									                                                                     $doc["doc_name"] = str_replace("*","",$doc["doc_name"]);
									                                                                     echo "<span class='required'>*</span> ". ucwords($doc["doc_name"]);
									                                                                   }
									                                                                   else{
									                                                                     echo ucwords(strtolower($doc["doc_name"]));
									                                                                   }
								                                                                 echo "</td>";
								                                                                 if(in_array($doc['doc_id'], $otherDOcs))
										                                                            echo "<td class='custom_input'><input type='text' name='custom_other_doc' class='form-control' placeholder='Please Enter File Name'></td>";
										                                                          else
										                                                            echo "<td>&nbsp;</td>";
								                                                                 echo "<td>";
								                                                                   if($doc['doc_type'] == "pdf")
								                                                                     echo "application/pdf <input type='hidden' name='selected_doc_type' value='application/pdf'>";
								                                                                   elseif($doc['doc_type'] == "image/jpeg")
								                                                                     echo "image/png <input type='hidden' name='selected_doc_type' value='image/jpeg'>";
								                                                                   echo "</td><td>".$doc["doc_min_size"]."-".$this->calculateFileSize($doc["doc_max_size"])."</td>
								                                                                <td>";
								                                                                 echo '<div class="fileinput fileinput-new" data-provides="fileinput">
								                                                                         <span class="btn btn-default btn-file">
								                                                                           <span class="fileinput-new">Select file</span>
								                                                                           <span class="fileinput-exists">Change</span>';
								                                                                     echo "<input type='file' name='caf_applications_uploads' class='upload ";
								                                                                             if($name == '*id_card')
								                                                                               echo " req' required ";
								                                                                             if($name == '*address_proof')
								                                                                               echo " req' required ";
								                                                                             if($name == '*brief_project_report')
								                                                                               echo " req' required ";
								                                                                             else
								                                                                               echo " '";
								                                                                            echo "/>
								                                                                           <input type='hidden' name='FileUpload[doc_id]' value='".$doc['doc_id']."'>
								                                                                           <input type='hidden' name='FileUpload[app_id]' value='".$app['application_id']."'>
								                                                                           <input type='hidden' name='FileUpload[YII_CSRF_TOKEN]' value='".Yii::app()->getRequest()->getCsrfToken()."' />";
								                                                                   echo '</span>
								                                                                         <span class="fileinput-filename"></span>
								                                                                         <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">&times;</a>
								                                                                       </div>';
								                                                                echo "</td>
								                                                                <td><input type='submit' value='Upload' class='btn btn-primary'></td></tr></form>";
								                                                                $cnt++;
								                                                        }
								                                                        else{
								                                                             echo "<tr>
								                                                            	<td>$cnt</td>
								                                                            	<td>";
								                                                                  $name=$doc['doc_name'];
								                                                                  $name=explode("_doc", $name);
								                                                                   if (preg_match('/_/',$doc['doc_name']))
								                                                                     $doc['doc_name']=str_replace('_', ' ', $name[0]);
								                                                                   if($doc['is_doc_mendatory'] && !in_array($doc['doc_id'], $otherDOcs)){
								                                                                     $doc["doc_name"] = str_replace("*","",$doc["doc_name"]);
								                                                                     echo "<span class='required'>*</span> ". ucwords($doc["doc_name"]);
								                                                                   }
								                                                                   else{
								                                                                     echo ucwords(strtolower($doc["doc_name"]));
								                                                                   }
								                                                                     echo "</td>
								                                                                   <td>".$docInfo['document_name']."</td><td>".$docInfo["document_mime_type"]."</td><td>".$doc["doc_min_size"]."-".$this->calculateFileSize($doc["doc_max_size"])."</td>
								                                                                <td>
								                                                                   ";
								                                                                       if($docInfo['doc_status']=='P')
								                                                                         echo "<span class='label label-primary'>Uploaded</span>";
								                                                                       elseif($docInfo['doc_status']=='V')
								                                                                         echo "<span class='label label-success'>Verified</span>";
								                                                                       elseif($docInfo['doc_status']=='R')
								                                                                         echo "<span class='label label-danger'>Rejected</span>";
								                                                                   echo "
								                                                                </td>
								                                                                <td>No Action Required</td>
								                                                             </tr>";
								                                                             $cnt++;
								                                                        }
								                                                    }	
								                                                    // OTHER DOCS 
								                                                    elseif(in_array($doc['doc_id'], $userAlreadyUploadedDocs) && in_array($doc['doc_id'], $otherDOcs) ) {
								                                                        $docInfo=$docModel::isDocAlreadyUploadedByUser($pre_field['user_id'],$doc['doc_id']);
                                                                                                                       // echo "<!--<pre>-====>";print_r($docInfo);echo "-->";
								                                                        if(empty($UserAppDocs) || ($doc['is_doc_req_everytime']=='Y' && $docInfo['doc_status']=='R')){
								                                                            $docUploadPening=true;
								                                                            echo "<tr>
								                                                            	<td>$cnt</td>
								                                                            	<td><form action='".Yii::app()->createAbsoluteUrl('frontuser/landAllotment/uploadInvestorDocs')."' onsubmit='ShowLoader()' method='POST' enctype='multipart/form-data'>";
								                                                                 if($doc['is_doc_mendatory']=='Y')
								                                                                    $docUploadPening=true;
								                                                                 $name=$doc['doc_name'];
								                                                                  $name=explode("_doc", $name);
								                                                                   if (preg_match('/_/',$doc['doc_name']))
								                                                                     $doc['doc_name']=str_replace('_', ' ', $name[0]);
								                                                                   if($doc['is_doc_mendatory'] && !in_array($doc['doc_id'], $otherDOcs)){
								                                                                     $doc["doc_name"] = str_replace("*","",$doc["doc_name"]);
								                                                                     echo "<span class='required'>*</span> ". ucwords($doc["doc_name"]."uired Document");
								                                                                   }
								                                                                   else{
								                                                                     echo ucwords(strtolower($doc["doc_name"]."uired Document"));
								                                                                   }
								                                                                 echo "</td>";
								                                                                 if(in_array($doc['doc_id'], $otherDOcs))
										                                                            echo "<td class='custom_input'><input type='text' name='custom_other_doc' class='form-control' placeholder='Please Enter File Name'></td>";
										                                                          else
										                                                            echo "<td>&nbsp;</td>";
								                                                                 echo "<td>";
								                                                                   if($doc['doc_type'] == "pdf")
								                                                                     echo "application/pdf <input type='hidden' name='selected_doc_type' value='application/pdf'>";
								                                                                   elseif($doc['doc_type'] == "image/jpeg")
								                                                                     echo "image/png <input type='hidden' name='selected_doc_type' value='image/jpeg'>";
								                                                                   echo "</td><td>".$doc["doc_min_size"]."-".$this->calculateFileSize($doc["doc_max_size"])."</td>
								                                                                <td>";
								                                                                 echo '<div class="fileinput fileinput-new" data-provides="fileinput">
								                                                                         <span class="btn btn-default btn-file">
								                                                                           <span class="fileinput-new">Select file</span>
								                                                                           <span class="fileinput-exists">Change</span>';
								                                                                     echo "<input type='file' name='caf_applications_uploads' class='upload ";
								                                                                             if($name == '*id_card')
								                                                                               echo " req' required ";
								                                                                             if($name == '*address_proof')
								                                                                               echo " req' required ";
								                                                                             if($name == '*brief_project_report')
								                                                                               echo " req' required ";
								                                                                             else
								                                                                               echo " '";
								                                                                            echo "/>
								                                                                           <input type='hidden' name='FileUpload[doc_id]' value='".$doc['doc_id']."'>
								                                                                           <input type='hidden' name='FileUpload[app_id]' value='".$app['application_id']."'>
								                                                                           <input type='hidden' name='FileUpload[YII_CSRF_TOKEN]' value='".Yii::app()->getRequest()->getCsrfToken()."' />";
								                                                                   echo '</span>
								                                                                         <span class="fileinput-filename"></span>
								                                                                         <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">&times;</a>
								                                                                       </div>';
								                                                                echo "</td>
								                                                                <td><input type='submit' value='Upload' class='btn btn-primary'></td></tr></form>";
								                                                                $cnt++;
								                                                        }
								                                                        else{
								                                                             echo "<tr>
								                                                            	<td>$cnt</td>
								                                                            	<td>";
								                                                                  $name=$doc['doc_name'];
								                                                                  $name=explode("_doc", $name);
								                                                                   if (preg_match('/_/',$doc['doc_name']))
								                                                                     $doc['doc_name']=str_replace('_', ' ', $name[0]);
								                                                                   if($doc['is_doc_mendatory'] && !in_array($doc['doc_id'], $otherDOcs)){
								                                                                     $doc["doc_name"] = str_replace("*","",$doc["doc_name"]);
								                                                                     echo "<span class='required'>*</span> ". ucwords($doc["doc_name"]."uired Document");
								                                                                   }
								                                                                   else{
								                                                                     echo ucwords(strtolower($doc["doc_name"]."uired Document"));
								                                                                   }
								                                                                     echo "</td>
								                                                                   <td>".$docInfo['document_name']."</td><td>".$docInfo["document_mime_type"]."</td><td>".$doc["doc_min_size"]."-".$this->calculateFileSize($doc["doc_max_size"])."</td>
								                                                                <td>
								                                                                   ";
								                                                                       if($docInfo['doc_status']=='P')
								                                                                         echo "<span class='label label-primary'>Uploaded</span>";
								                                                                       elseif($docInfo['doc_status']=='V')
								                                                                         echo "<span class='label label-success'>Verified</span>";
								                                                                       elseif($docInfo['doc_status']=='R')
								                                                                         echo "<span class='label label-danger'>Rejected</span>";
								                                                                   echo "
								                                                                </td>
								                                                                <td>No Action Required</td>
								                                                             </tr>";
								                                                             $cnt++;
								                                                        }
								                                                    }
								                                                    else{
									                                                    // REGILAR DOCS
									                                                    if(in_array($doc['doc_id'], $RegularDocsId) ) {
									                                                        echo "<tr>
									                                                            	<td>$cnt</td>
									                                                            	<td><form action='".Yii::app()->createAbsoluteUrl('frontuser/landAllotment/uploadInvestorDocs')."' onsubmit='ShowLoader()' method='POST' enctype='multipart/form-data'>";
									                                                                 if($doc['is_doc_mendatory']=='Y')
									                                                                    $docUploadPening=true;
									                                                                 $name=$doc['doc_name'];
									                                                                  $name=explode("_doc", $name);
									                                                                   if (preg_match('/_/',$doc['doc_name']))
									                                                                     $doc['doc_name']=str_replace('_', ' ', $name[0]);
									                                                                   if($doc['is_doc_mendatory'] && !in_array($doc['doc_id'], $otherDOcs)){
									                                                                     $doc["doc_name"] = str_replace("*","",$doc["doc_name"]);
									                                                                     echo "<span class='required'>*</span> ". ucwords($doc["doc_name"]);
									                                                                   }
									                                                                   else{
									                                                                     echo ucwords(strtolower($doc["doc_name"]));
									                                                                   }
									                                                                 echo "</td>";
											                                                         echo "<td>&nbsp;</td>";
									                                                                 echo "<td>";
									                                                                   if($doc['doc_type'] == "pdf")
									                                                                     echo "application/pdf <input type='hidden' name='selected_doc_type' value='application/pdf'>";
									                                                                   elseif($doc['doc_type'] == "image/jpeg")
									                                                                     echo "image/png <input type='hidden' name='selected_doc_type' value='image/jpeg'>";
									                                                                   echo "</td><td>".$doc["doc_min_size"]."-".$this->calculateFileSize($doc["doc_max_size"])."</td>
									                                                                <td>";
									                                                                 echo '<div class="fileinput fileinput-new" data-provides="fileinput">
									                                                                         <span class="btn btn-default btn-file">
									                                                                           <span class="fileinput-new">Select file</span>
									                                                                           <span class="fileinput-exists">Change</span>';
									                                                                     echo "<input type='file' name='caf_applications_uploads' class='upload ";
									                                                                             if($name == '*id_card')
									                                                                               echo " req' required ";
									                                                                             if($name == '*address_proof')
									                                                                               echo " req' required ";
									                                                                             if($name == '*brief_project_report')
									                                                                               echo " req' required ";
									                                                                             else
									                                                                               echo " '";
									                                                                            echo "/>
									                                                                           <input type='hidden' name='FileUpload[doc_id]' value='".$doc['doc_id']."'>
									                                                                           <input type='hidden' name='FileUpload[app_id]' value='".$app['application_id']."'>
									                                                                           <input type='hidden' name='FileUpload[YII_CSRF_TOKEN]' value='".Yii::app()->getRequest()->getCsrfToken()."' />";
									                                                                   echo '</span>
									                                                                         <span class="fileinput-filename"></span>
									                                                                         <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">&times;</a>
									                                                                       </div>';
									                                                                echo "</td>
									                                                                <td><input type='submit' value='Upload' class='btn btn-primary'></td></tr></form>";
									                                                                $cnt++;
									                                                    }
									                                                    // EXPANSION DOCS
									                                                   elseif (($incmplt_fields->nature_of_area=="modernization" || $incmplt_fields->nature_of_area=="expansion" ) && in_array($doc['doc_id'], $ExpansionDoc) ) {
									                                                        echo "<tr>
									                                                            	<td>$cnt</td>
									                                                            	<td><form action='".Yii::app()->createAbsoluteUrl('frontuser/landAllotment/uploadInvestorDocs')."' onsubmit='ShowLoader()' method='POST' enctype='multipart/form-data'>";
									                                                                 if($doc['is_doc_mendatory']=='Y')
									                                                                    $docUploadPening=true;
									                                                                 // $name=$doc['doc_name'];
									                                                                 //  $name=explode("_doc", $name);
									                                                                 //   if (preg_match('/_/',$doc['doc_name']))
									                                                                 //     $doc['doc_name']=str_replace('_', ' ', $name[0]);
									                                                                 //   if($doc['is_doc_mendatory'] && !in_array($doc['doc_id'], $otherDOcs)){
									                                                                 //     $doc["doc_name"] = str_replace("*","",$doc["doc_name"]);
									                                                                 //     echo "<span class='required'>*</span> ". ucwords($doc["doc_name"]);
									                                                                 //   }
									                                                                 //   else{
									                                                                 //     echo ucwords(strtolower($doc["doc_name"]));
									                                                                 //   }
									                                                                 echo "Copy of Registration Certificate for Existing Units";
									                                                                 echo "</td>";
											                                                         echo "<td>&nbsp;</td>";
									                                                                 echo "<td>";
									                                                                   if($doc['doc_type'] == "pdf")
									                                                                     echo "application/pdf <input type='hidden' name='selected_doc_type' value='application/pdf'>";
									                                                                   elseif($doc['doc_type'] == "image/jpeg")
									                                                                     echo "image/png <input type='hidden' name='selected_doc_type' value='image/jpeg'>";
									                                                                   echo "</td><td>".$doc["doc_min_size"]."-".$this->calculateFileSize($doc["doc_max_size"])."</td>
									                                                                <td>";
									                                                                 echo '<div class="fileinput fileinput-new" data-provides="fileinput">
									                                                                         <span class="btn btn-default btn-file">
									                                                                           <span class="fileinput-new">Select file</span>
									                                                                           <span class="fileinput-exists">Change</span>';
									                                                                     echo "<input type='file' name='caf_applications_uploads' class='upload ";
									                                                                             if($name == '*id_card')
									                                                                               echo " req' required ";
									                                                                             if($name == '*address_proof')
									                                                                               echo " req' required ";
									                                                                             if($name == '*brief_project_report')
									                                                                               echo " req' required ";
									                                                                             else
									                                                                               echo " '";
									                                                                            echo "/>
									                                                                           <input type='hidden' name='FileUpload[doc_id]' value='".$doc['doc_id']."'>
									                                                                           <input type='hidden' name='FileUpload[app_id]' value='".$app['application_id']."'>
									                                                                           <input type='hidden' name='FileUpload[YII_CSRF_TOKEN]' value='".Yii::app()->getRequest()->getCsrfToken()."' />";
									                                                                   echo '</span>
									                                                                         <span class="fileinput-filename"></span>
									                                                                         <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">&times;</a>
									                                                                       </div>';
									                                                                echo "</td>
									                                                                <td><input type='submit' value='Upload' class='btn btn-primary'></td></tr></form>";
									                                                                $cnt++;
									                                                    }
									                                                    // CONSITUTION DOCS
									                                                    elseif( $consitutionID[0] == "proprietorship" && in_array($doc['doc_id'], $proprietorship) || 
									                                                    	    $consitutionID[0] == "partnership_firm" && in_array($doc['doc_id'], $partnership_firm) || 
									                                                    	    $consitutionID[0] == "limited_liability_partnership" && in_array($doc['doc_id'], $limited_liability_partnership) ||
									                                                    		$consitutionID[0] == "private_limited_company" && in_array($doc['doc_id'], $private_limited_company) ||
									                                                    		$consitutionID[0] == "public_limited_company" && in_array($doc['doc_id'], $public_limited_company) ||
									                                                    		$consitutionID[0] == "cooperative_society" && in_array($doc['doc_id'], $cooperative_society) ||
									                                                    		$consitutionID[0] == "self_help_group" && in_array($doc['doc_id'], $self_help_group) ||
									                                                    		$consitutionID[0] == "section_25_company" && in_array($doc['doc_id'], $section_25_company) ||
									                                                    		$consitutionID[0] == "one_man_company" && in_array($doc['doc_id'], $one_man_company)
									                                                      	   ) {
									                                                         echo "<tr>
									                                                            	<td>$cnt</td>
									                                                            	<td><form action='".Yii::app()->createAbsoluteUrl('frontuser/landAllotment/uploadInvestorDocs')."' onsubmit='ShowLoader()' method='POST' enctype='multipart/form-data'>";
									                                                                 if($doc['is_doc_mendatory']=='Y')
									                                                                    $docUploadPening=true;
									                                                                 $name=$doc['doc_name'];
									                                                                  $name=explode("_doc", $name);
									                                                                   if (preg_match('/_/',$doc['doc_name']))
									                                                                     $doc['doc_name']=str_replace('_', ' ', $name[0]);
									                                                                   if($doc['is_doc_mendatory'] && !in_array($doc['doc_id'], $otherDOcs)){
									                                                                     $doc["doc_name"] = str_replace("*","",$doc["doc_name"]);
									                                                                     echo "<span class='required'>*</span> ". ucwords($doc["doc_name"]);
									                                                                   }
									                                                                   else{
									                                                                     echo ucwords(strtolower($doc["doc_name"]));
									                                                                   }
									                                                                 echo "</td>";
									                                                                 if(in_array($doc['doc_id'], $otherDOcs))
											                                                            echo "<td class='custom_input'><input type='text' name='custom_other_doc' class='form-control' placeholder='Please Enter File Name'></td>";
											                                                          else
											                                                            echo "<td>&nbsp;</td>";
									                                                                 echo "<td>";
									                                                                   if($doc['doc_type'] == "pdf")
									                                                                     echo "application/pdf <input type='hidden' name='selected_doc_type' value='application/pdf'>";
									                                                                   elseif($doc['doc_type'] == "image/jpeg")
									                                                                     echo "image/png <input type='hidden' name='selected_doc_type' value='image/jpeg'>";
									                                                                   echo "</td><td>".$doc["doc_min_size"]."-".$this->calculateFileSize($doc["doc_max_size"])."</td>
									                                                                <td>";
									                                                                 echo '<div class="fileinput fileinput-new" data-provides="fileinput">
									                                                                         <span class="btn btn-default btn-file">
									                                                                           <span class="fileinput-new">Select file</span>
									                                                                           <span class="fileinput-exists">Change</span>';
									                                                                     echo "<input type='file' name='caf_applications_uploads' class='upload ";
									                                                                             if($name == '*id_card')
									                                                                               echo " req' required ";
									                                                                             if($name == '*address_proof')
									                                                                               echo " req' required ";
									                                                                             if($name == '*brief_project_report')
									                                                                               echo " req' required ";
									                                                                             else
									                                                                               echo " '";
									                                                                            echo "/>
									                                                                           <input type='hidden' name='FileUpload[doc_id]' value='".$doc['doc_id']."'>
									                                                                           <input type='hidden' name='FileUpload[app_id]' value='".$app['application_id']."'>
									                                                                           <input type='hidden' name='FileUpload[YII_CSRF_TOKEN]' value='".Yii::app()->getRequest()->getCsrfToken()."' />";
									                                                                   echo '</span>
									                                                                         <span class="fileinput-filename"></span>
									                                                                         <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">&times;</a>
									                                                                       </div>';
									                                                                echo "</td>
									                                                                <td><input type='submit' value='Upload' class='btn btn-primary'></td></tr></form>";
									                                                                $cnt++;
									                                                    }	
									                                                    // OTHER DOCS 
									                                                    elseif(in_array($doc['doc_id'], $otherDOcs) ) {
									                                                        echo "<tr>
									                                                            	<td>$cnt</td>
									                                                            	<td><form action='".Yii::app()->createAbsoluteUrl('frontuser/landAllotment/uploadInvestorDocs')."' onsubmit='ShowLoader()' method='POST' enctype='multipart/form-data'>";
									                                                                 if($doc['is_doc_mendatory']=='Y')
									                                                                    $docUploadPening=true;
									                                                                 $name=$doc['doc_name'];
									                                                                  $name=explode("_doc", $name);
									                                                                   if (preg_match('/_/',$doc['doc_name']))
									                                                                     $doc['doc_name']=str_replace('_', ' ', $name[0]);
									                                                                   if($doc['is_doc_mendatory'] && !in_array($doc['doc_id'], $otherDOcs)){
									                                                                     $doc["doc_name"] = str_replace("*","",$doc["doc_name"]);
									                                                                     echo "<span class='required'>*</span> ". ucwords($doc["doc_name"]."uired Document");
									                                                                   }
									                                                                   else{
									                                                                     echo ucwords(strtolower($doc["doc_name"]."uired Document"));
									                                                                   }
									                                                                 echo "</td>";
									                                                                 if(in_array($doc['doc_id'], $otherDOcs))
											                                                            echo "<td class='custom_input'><input type='text' name='custom_other_doc' class='form-control' placeholder='Please Enter File Name'></td>";
											                                                          else
											                                                            echo "<td>&nbsp;</td>";
									                                                                 echo "<td>";
									                                                                   if($doc['doc_type'] == "pdf")
									                                                                     echo "application/pdf <input type='hidden' name='selected_doc_type' value='application/pdf'>";
									                                                                   elseif($doc['doc_type'] == "image/jpeg")
									                                                                     echo "image/png <input type='hidden' name='selected_doc_type' value='image/jpeg'>";
									                                                                   echo "</td><td>".$doc["doc_min_size"]."-".$this->calculateFileSize($doc["doc_max_size"])."</td>
									                                                                <td>";
									                                                                 echo '<div class="fileinput fileinput-new" data-provides="fileinput">
									                                                                         <span class="btn btn-default btn-file">
									                                                                           <span class="fileinput-new">Select file</span>
									                                                                           <span class="fileinput-exists">Change</span>';
									                                                                     echo "<input type='file' name='caf_applications_uploads' class='upload ";
									                                                                             if($name == '*id_card')
									                                                                               echo " req' required ";
									                                                                             if($name == '*address_proof')
									                                                                               echo " req' required ";
									                                                                             if($name == '*brief_project_report')
									                                                                               echo " req' required ";
									                                                                             else
									                                                                               echo " '";
									                                                                            echo "/>
									                                                                           <input type='hidden' name='FileUpload[doc_id]' value='".$doc['doc_id']."'>
									                                                                           <input type='hidden' name='FileUpload[app_id]' value='".$app['application_id']."'>
									                                                                           <input type='hidden' name='FileUpload[YII_CSRF_TOKEN]' value='".Yii::app()->getRequest()->getCsrfToken()."' />";
									                                                                   echo '</span>
									                                                                         <span class="fileinput-filename"></span>
									                                                                         <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">&times;</a>
									                                                                       </div>';
									                                                                echo "</td>
									                                                                <td><input type='submit' value='Upload' class='btn btn-primary'></td></tr></form>";
									                                                                $cnt++;
									                                                    }
								                                                    }
								                                                }
																				// echo "<pre>====>";
																				// print_r($incmplt_fields);
																				// die;

								                                                // QUESTION DOCS
										                                        foreach ($docs as $doc) {
								                                                    $docInfo=$docModel::isDocAlreadyUploadedByUser($pre_field['user_id'],$doc['doc_id']);
                                                                                                                     echo "<!--<pre>*====>";print_r($docInfo);echo "-->";
								                                                    $UserAppDocs = $this->GetUserApplicationDocuments($doc['doc_id'],$submission_id);
								                                                    $name = explode("_doc_", $doc['doc_name']);
								                                                    $label = @$labelArray[$name[0]];
								                                                    $labelANS = @$QuesAns[$name[0]][$incmplt_fields->$name[0]];
								                                                    // $labelFIn = "<span class='required'>*</span> Q : ".$label." ? <br>&nbsp;&nbsp;&nbsp;&nbsp;A : ".$labelANS;
								                                                    $labelFIn = "<span class='required psmall'>*</span> ".$label." <br>&nbsp;&nbsp; <b> ".$labelANS."</b>";
                                                                                                                
								                                                    if(in_array($doc['doc_id'], $userAlreadyUploadedDocs) && in_array($doc['doc_id'], $EvaluationDocId)){
								                                                         //echo "<!--<pre>";print_r($doc);echo "-->";   
                                                                                                                             $docInfo=$docModel::isDocAlreadyUploadedByUser($pre_field['user_id'],$doc['doc_id']);
                                                                                                                           
								                                                      //  if(isset($incmplt_fields->$name[0]) && $name[1]==$incmplt_fields->$name[0]){ // Comment due to open rejected files
                                                                                                                            //  if($docInfo['doc_status']=="R"){echo $name[1]==$incmplt_fields->$name[0]; echo $doc['is_doc_req_everytime'];die("HERE");}
                                                                                                                          //   if($docInfo['doc_status']=="R")
                                                                                                                                // echo $doc['is_doc_req_everytime'].'==='.$docInfo['doc_status'];die;
									                                                        if(empty($UserAppDocs) || ($doc['is_doc_req_everytime']=='Y' && $docInfo['doc_status']=='R')){
                                                                                                                                 //   echo "In";die;
									                                                            $docUploadPening=true;
									                                                            echo "<tr>
								                                                            	<td>$cnt</td>
												                                                          <td>
												                                                            <form onsubmit='ShowLoader()' action='".Yii::app()->createAbsoluteUrl('frontuser/landAllotment/uploadInvestorDocs')."' method='POST' enctype='multipart/form-data'>
												                                                               		$labelFIn";
												                                                     echo "</td><td>&nbsp;</td>";
									                                                                 echo "<td>";
									                                                                   if($doc['doc_type'] == "pdf")
									                                                                     echo "application/pdf <input type='hidden' name='selected_doc_type' value='application/pdf'>";
									                                                                   elseif($doc['doc_type'] == "image/jpeg")
									                                                                     echo "image/png <input type='hidden' name='selected_doc_type' value='image/jpeg'>";
									                                                                   echo "</td><td>".$doc["doc_min_size"]."-".$this->calculateFileSize($doc["doc_max_size"])."</td>
									                                                                <td>";
									                                                                 echo '<div class="fileinput fileinput-new" data-provides="fileinput">
									                                                                         <span class="btn btn-default btn-file">
									                                                                           <span class="fileinput-new">Select file</span>
									                                                                           <span class="fileinput-exists">Change</span>';
									                                                                     echo "<input type='file' name='caf_applications_uploads' class='upload req' required />
									                                                                           <input type='hidden' name='FileUpload[doc_id]' value='".$doc['doc_id']."'>
									                                                                           <input type='hidden' name='FileUpload[app_id]' value='".$app['application_id']."'>
									                                                                           <input type='hidden' name='FileUpload[YII_CSRF_TOKEN]' value='".Yii::app()->getRequest()->getCsrfToken()."' />";
									                                                                   echo '</span>
									                                                                         <span class="fileinput-filename"></span>
									                                                                         <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">&times;</a>
									                                                                       </div>';
									                                                                echo "</td>
									                                                                <td><input type='submit' value='Upload.' class='btn btn-primary'></td></tr></form>";
									                                                                $cnt++;
									                                                        }
									                                                        else{
									                                                             echo "<tr>
								                                                            		<td>$cnt</td><td>";
															                                               echo $labelFIn;
									                                                                     echo "</td>
									                                                                   <td>".$docInfo['document_name']."</td><td>".$docInfo["document_mime_type"]."</td><td>".$doc["doc_min_size"]."-".$this->calculateFileSize($doc["doc_max_size"])."</td>
									                                                                <td>
									                                                                   ";
									                                                                       if($docInfo['doc_status']=='P')
									                                                                         echo "<span class='label label-primary'>Uploaded</span>";
									                                                                       elseif($docInfo['doc_status']=='V')
									                                                                         echo "<span class='label label-success'>Verified</span>";
									                                                                       elseif($docInfo['doc_status']=='R')
									                                                                         echo "<span class='label label-danger'>Rejected</span>";
									                                                                   echo "</span>
									                                                                </td>
									                                                                <td>No Action Required</td>
									                                                             </tr>";
									                                                             $cnt++;
									                                                        }
									                                                 //   }
								                                                    }
								                                                    else{
									                                                    if(in_array($doc['doc_id'], $EvaluationDocId)){
										                                                    if(isset($incmplt_fields->$name[0]) && $incmplt_fields->$name[0] == $name[1]){
										                                                    	echo "<tr>
								                                                            	<td>$cnt</td>
											                                                            <td>
											                                                               	<form onsubmit='ShowLoader()' action='".Yii::app()->createAbsoluteUrl('frontuser/landAllotment/uploadInvestorDocs')."' method='POST' enctype='multipart/form-data'>
											                                                               		$labelFIn";
											                                                            echo "</td>";
											                                                            echo "<td>&nbsp;</td>";
											                                                            echo "<td>";
											                                                                  if($doc['doc_type'] == "pdf")
											                                                                    echo "application/pdf <input type='hidden' name='selected_doc_type' value='application/pdf'>";
											                                                                  elseif($doc['doc_type'] == "image/jpeg")
											                                                                    echo "image/png <input type='hidden' name='selected_doc_type' value='image/jpeg'>";
											                                                           	echo "</td>
											                                                           		  <td>".$doc["doc_min_size"]."-".$this->calculateFileSize($doc["doc_max_size"])."</td>
											                                                               	  <td>
											                                                               	  	<div class='fileinput fileinput-new' data-provides='fileinput'>
																                                                   <span class='btn btn-default btn-file'>
																                                                     <span class='fileinput-new'>Select file</span>
																                                                     <span class='fileinput-exists'>Change</span>
																                                                     <input type='file' name='caf_applications_uploads' class='upload req'/>
																                                                     <input type='hidden' name='FileUpload[doc_id]' value='".$doc['doc_id']."'>
																                                                     <input type='hidden' name='FileUpload[app_id]' value='".$app['application_id']."'>
																                                                     <input type='hidden' name='FileUpload[YII_CSRF_TOKEN]' value='".Yii::app()->getRequest()->getCsrfToken()."' />
																                                                   </span>
																                                                   <span class='fileinput-filename'></span>
																                                                   <a href='#' class='close fileinput-exists' data-dismiss='fileinput' style='float: none'>&times;</a>
											                                                                    </div>
											                                                                  </td>
											                                                               	  <td><button type='submit' class='btn btn-primary'>Upload</button></form></td>
										                                                              </tr>";
										                                                        $cnt++;      
									                                                        }
									                                                    }
									                                                }
								                                                }
								                                        echo '</tbody></table>';
								                               }
								                            ?>
		                                                </div>
		                                            </div>
		                                        </div>
		                                    </div>

			                                <div class="form-actions">
			                                    <div class="row">
			                                        <div class="col-md-12 text-center">
			                                        	<form class="form-horizontal" action="<?=@Yii::app()->createAbsoluteUrl('/frontuser/landAllotment/stepFour')?>" method="POST" id="submit_form" enctype="multipart/form-data">		
		                    								<input type="hidden" class="csrftoken" name="YII_CSRF_TOKEN" value="<?=Yii::app()->getRequest()->getCsrfToken()?>" />
		                    								<input type="hidden" class="csrftoken" name="App_subbmission_id" value="<?=@$sub_id?>" />
		                    								<input type="hidden" class="csrftoken" name="docs_upload" value="true" />
				                                            <a href="<?=@Yii::app()->createAbsoluteUrl('/frontuser/landAllotment/stepTwo')?>" class="btn btn-info"><i class="fa fa-reply"></i> Back</a>
				                                            <button type="submit" id="FinalCafButton" class="btn btn-success"><i class="fa fa-check"></i> Save & Next</button>
				                                        </form>
			                                        </div>
			                                    </div>
			                                </div>
		                            	</div>
	                            	</div>       
	                        	</div>
	                    	</div>
	                    </div>
		            </div>
            	</div>
            </div>
        </div>
    </div>
</div>

<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?=Yii::app()->theme->baseUrl?>/assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
<script src="<?=Yii::app()->theme->baseUrl?>/assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="<?=Yii::app()->theme->baseUrl?>/assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
<script src="<?=Yii::app()->theme->baseUrl?>/assets/global/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?=Yii::app()->theme->baseUrl?>/assets/pages/scripts/form-wizard.min.js" type="text/javascript"></script>
<!-- form repeater js -->
<script src="<?=Yii::app()->theme->baseUrl?>/assets/global/plugins/jquery-repeater/jquery.repeater.js" type="text/javascript"></script>
<script src="<?=Yii::app()->theme->baseUrl?>/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
<script src="<?=Yii::app()->theme->baseUrl?>/assets/pages/scripts/form-repeater.min.js" type="text/javascript"></script>
<script src="<?=Yii::app()->theme->baseUrl?>/assets/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>
<script src="<?=Yii::app()->theme->baseUrl?>/assets/global/plugins/bootstrap-datepicker/js/moment.min.js" type="text/javascript"></script>
<script src="<?=Yii::app()->theme->baseUrl?>/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>

<script type="text/javascript">
  $("#FinalCafButton").on("click", function(){
    $(".alert").remove();
    var inputs = $(".req");
    console.log(inputs);
    if(inputs.length > 0){
      $("#submit_form").before("<div class='alert alert-danger'>Please Upload Required Files<br></div>");
      return false;
    }
    else{
      $("#submit_form").submit();
      return true;
    }
  }) 
</script>