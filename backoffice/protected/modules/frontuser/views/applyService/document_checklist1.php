<?php
@extract($_GET);

$status_array = array("U" => 'Unverified', "V" => 'Verified');
$invData = ApplyServiceExt::getInvestorDetails();

$old_service_name = '';
if (isset($swcs_service_id)) {
    $sqlSa = "SELECT * FROM bo_sp_all_applications WHERE app_id='$swcs_service_id' ORDER BY app_id ASC LIMIT 1";
    $connection = Yii::app()->db;
    $command = $connection->createCommand($sqlSa);
    $res_sa = $command->queryRow();
    if (!empty($res_sa)) {
        $old_service_name = $res_sa['app_name'];
        $app_url = $res_sa['app_url'];
    }
}

$appData = "SELECT * FROM bo_new_application_submission WHERE submission_id='$_GET[caf_id]'";
$connection = Yii::app()->db;
$command = $connection->createCommand($appData);
$resAppData = $command->queryRow();
?>
<style>
    textarea
{
  width:90%;
}
    .font-black{
		color:#000;
	}
    .mt-step-title.font-grey-cascade {
        font-size: 16px !important;
    }
	.mt-step-title.font-white-cascade a{
        font-size: 16px !important;
        color:#fff;
		font-weight:bold;
    }
	.font-white-cascade{
		color:#fff;
		font-weight:bold;
	}
    a:hover{ color:#000;}
    .cent{text-align:center !important;}
    .vln{vertical-align:middle !important;}
    .urlcheckmsg{
        font-size: 14px !important;
        color:#F00;
    }
    /* .pull-left{display:none;}	 */
    <?php if (@$_GET['dmsCheck'] == 'N') { ?>

        .dmsSkip{display:none;}

    <?php }
    ?>
</style>

<div class="portlet-box green">
    <div class="portlet-body dmsSkip">

        <?php
        $cls = @$_GET['type'];
        if (isset($_GET['is']) && $_GET['is'] != '')
            $is = $_GET['is'];
        else
            $is = "no";
        ?>

        <div class="mt-element-step">
				
            <div class="row step-thin">
				
                <div style="text-align:center;" class="col-md-12 bg-green font-white-cascade mt-step-col ">
                   <!-- <div class="mt-step-number bg-white font-black">1</div>-->Documents Listing
                   <!-- <div class="mt-step-title font-white-cascade"><a href="" >Documents Listing</a></div>-->
                </div>				
                <?php
                if (isset($type) && $type == 'Offline') {
                    $actionUrl = "saveOfflineApplication";
                    $btn_txt = "Save & Continue";
                } else {

                    $actionUrl = "RedirectToDeprtmentURLNew";
                    $btn_txt = "Continue & Apply";
                }
                ?>
            </div>
        </div>
        <section class="panel site-min-height dmsSkip">			
            <div class="panel-body" >               		
				<div style="text-align:justify;padding:20px;color:red;font-size:16px;font-weight:bold;">
					<?php
					if($_GET['service_id'].'.'.$_GET['sub_service_id']=='2.0'){
						echo "Note*: In case you want to provide any supporting documents for the application such as Identity and Address proof of Applicant, Consent for reserving similar names, Approvals for using Restricted words in the proposed names, etc., then please attach the same under this section.";
					}
					?>
				</div>
                <div class="table">
                   <!-- <table class="table table-scrollable table-lg mt-lg mb-0" width="100%">
                        <tr>
                            <td><b>Name</b></td>
                            <td><?php echo $invData['first_name'] . " " . $invData['last_name']; ?></td>
                            <td><b>UID</b></td>
                            <td><?php echo $invData['iuid']; ?></td>
                        </tr>
                        <tr>
                            <td><b>Phone number</b></td>
                            <td><?php echo $invData['mobile_number']; ?></td>
                            <td><b>Email ID</b></td>
                            <td><?php echo $invData['email']; ?></td>
                        </tr>
                        <tr>
                            <td><b>Print Application</b></td>
                            <td><a target="_blank" href="<?php echo $resAppData['print_app_call_back_url']; ?>" target="_blank">Click Here</a></td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                    </table>
                    <br>-->
                    <div style="text-align:center;">
					<?php
						foreach(Yii::app()->user->getFlashes() as $key => $message) {
							$color = 'green';
							if($key=="error")
							{
								$color = 'red';
							}
							echo '<div class="flash-' . $key . '" style="font-size:22px;color:'.$color.';">' . $message . "</div>\n";
						}
					?>
					</div>
                    <table class="table table-bordered table-scrollable table-lg mt-lg mb-0" width="100%">
                        <thead>
                            <tr>
                                <th class="cent vln" width="5%">S.No</th>
                                <th class="cent vln" width="10%">Document Name</th>
                                <th class="cent vln" width="45%">Description of Document</th>
                                <!--<th class="vln">Is Document Mandatory</th>
                                <th class="vln">Comment</th>
                                <th class="cent vln">Version</th>-->
                             
                                <th class="cent vln"  width="40%">Upload</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            <?php
                            $disable_btn_text = false;
                            $disable_btn_help_text = false;
                            $documents_id = '';
                            $documents_id_name = '';
                            $appDmsArr = array();
                            $new_mapped_doc_type_arr = array();
                            $sno = 0;

                            if (count($document_type_mapping_array) > 0) {
                                foreach ($document_type_mapping_array as $key => $document_type_mapping_array_data) {
                                    $new_mapped_doc_type_arr[$document_type_mapping_array_data['doc_id']] = $document_type_mapping_array_data['is_required'];
                                }
                            }
                            if (count($mapped_documents_array) > 0) {
                                foreach ($mapped_documents_array as $key => $mapped_documents_array_data) {
                                    $new_mapped_doc_arr[$mapped_documents_array_data['doc_id']] = $mapped_documents_array_data['is_required'];
                                    $doc_datas = ApplyServiceExt::getDocumentsDataByID($mapped_documents_array_data['doc_id']);
                                    if (!isset($new_mapped_doc_type_arr[$doc_datas['doc_id']])) {
                                        $new_mapped_doc_type_arr[$doc_datas['doc_id']] = 'NA';
                                    }
                                    $new_mapped_doc_type_with_doc_arr[$doc_datas['doc_id']][$doc_datas['docchk_id']] = $mapped_documents_array_data['is_required'];
                                }
                            }
                            if (count($mapped_documents_array) > 0) {
                                foreach ($mapped_documents_array as $key => $mapped_documents_array_data) {      // echo "<pre>";print_r($mapped_documents_array_data);
                                    $doc_datas = ApplyServiceExt::getDocumentsDataByID($mapped_documents_array_data['doc_id']);
                                    $dms_datas = ApplyServiceExt::getUploadedDocumentsDataByID($mapped_documents_array_data['doc_id']);
                                    $doc_ids = getMainDocumentType($mapped_documents_array_data['doc_id'], $new_mapped_doc_type_arr);
                                    ?>
                                    <tr>
                                        <div class="form form-horizontal" role="form"><?php //echo Yii::app()->createAbsoluteUrl('frontuser/DocumentManagement/'); ?>
                                                <form role="form" action =""  enctype="multipart/form-data" method="post" id="submit_form1" name="submit_form">
                                                    <input type='hidden' name='FileUpload[YII_CSRF_TOKEN]' value="<?php echo Yii::app()->getRequest()->getCsrfToken(); ?>" />
                                                    <div class="form form-horizontal" role="form">
                                        <td class="cent vln"><?php echo ++$sno; ?></td>
                                        <td class="cent vln"><?php echo $doc_datas['document_name']; ?></td>
                                        <td class="cent vln" width="40%"> 
                                        <!--<td class="cent vln">
                                            <?php
                                            if ($mapped_documents_array_data['is_required'] == 'Y') {
                                                echo "Yes";
                                            } else {
                                                echo "No";
                                            }
                                            ?>
                                        </td>
                                        <td class="cent vln"><?php echo $mapped_documents_array_data['doc_comment']; ?>
                                        <td class="cent vln" width="10%">
                                            <?php
                                            $flg = 0;
                                            if (!empty($dms_datas)) {
                                                echo $dms_datas['document_version_type'] . $dms_datas['document_version'];
                                                $documents_id .= $dms_datas['documents_id'] . ",";
                                                $documents_id_name .= $dms_datas['document_name'] . ",";
                                                //echo '<!-- <pre>'; print_r($dms_datas); echo ' </pre> -->';
                                                $appDmsArr[] = $doc_datas['chklist_id'] . "~" . $dms_datas['document_name'];
                                             $flg = 0; 
                                            if (!empty($dms_datas)) {
                                                $flg = 0;
                                                ?>
                                                <a href="/themes/backend/mydoc/<?php echo $iuid; ?>/<?php echo $dms_datas['document_name']; ?>" target="_blank" class="btn btn-icon-only red" title="Download Me"><i class="fa fa-download"></i></a>
                                                <?php
                                            } else {
                                                $flg = 1;
                                            }
                                       
                                            } else {
                                                echo 'N.A';
                                                if ($mapped_documents_array_data['is_required'] == 'Y') {
                                                    $disable_btn_text = "disabled";
                                                    $disable_btn_help_text = "Please upload mandatory document(s) as well as non-mandatory document(s) which might be required for the application processing as per your specific criteria. You can only continue once you have at least uploaded mandatory document(s).";
                                                } else if ($mapped_documents_array_data['is_required'] == 'N' && $new_mapped_doc_type_arr[$doc_datas['doc_id']] == 'Y') {
                                                    $r_flag = validateAllUploaded($doc_datas['doc_id'], $new_mapped_doc_type_with_doc_arr[$doc_datas['doc_id']]);
                                                    if ($r_flag == false) {
                                                        $disable_btn_text = "disabled";
                                                        $disable_btn_help_text = "Please upload mandatory document(s) as well as non-mandatory document(s) which might be required for the application processing as per your specific criteria. You can only continue once you have at least uploaded mandatory document(s).";
                                                    }
                                                }
                                            }
                                            ?>
                                        </td>-->
                                       
                                           <?php $sql = "select * from bo_infowizard_documentchklist where docchk_id='$doc_datas[doc_id]'";
                                                 $connection = Yii::app()->db;
                                                $command = $connection->createCommand($sql);
                                                $docDetail = $command->queryRow(); 
                                                $dataToSend['docDetail'] = $docDetail;
                                                ?>

						<!--<a href="javascript::void(0)" doc_id="<?php //echo @$doc_datas['doc_id'];  ?>" issuer_id="<?php //echo @$doc_datas['issuer_id'];  ?>"
						issued_by="<?php //echo $doc_datas['issuerby_id'];  ?>" doc_code="<?php //echo $doc_datas['docchk_id'];  ?>" 
						mydoc_status="active" class="newdmsuploadwithmappingofreferencenvalidity"  data-toggle="modal" 
						data-target="#DocumentManagementNew">Upload New </a>
						<b id="up_b" style="margin-right:10px;"></b>-->

						
									<input type="hidden" name="FileUpload[doc_id]" id="doc_id" value="<?php echo @$doc_datas['doc_id']; ?>">
									<input type="hidden" name="FileUpload[issuer_id]" id="issuer_id" value="<?php echo @$doc_datas['issuer_id']; ?>">
									<input type="hidden"  name="FileUpload[issued_by]" id="issued_by" value="<?php echo @$doc_datas['issuerby_id']; ?>" >
									<input type="hidden"  name="FileUpload[doc_code]" id="doc_code" value="<?php echo @$doc_datas['docchk_id']; ?>" >
									<input type="hidden" name="FileUpload[mydoc_status]" value="active">
									<input type="hidden" name="FileUpload[doc_version_type]" value="V" checked id="new_copy">
									<input type="hidden"  name="FileUpload[document_reference_number]" id="document_reference_number" value="">
									<input type="hidden" name="FileUpload[valid_from]" id="valid_from" value="">
									<input type="hidden" name="FileUpload[valid_to]" id="valid_to" value="" >
									<input type="hidden" name="FileUpload[doc_date_of_issuance]" id="doc_date_of_issuance"  value="">
								   

																					   
									 
										<textarea name="FileUpload[comments]" required rows = "2" id="comments" maxlength="255" ><?php /* if (!empty($dms_datas)) {  echo  $dms_datas['comments'];} */?></textarea> </div></td>
									   <td class="cent vln" width="30%">
										   <div class="row">
											   <div class="col-lg-5">
											<input type="file"  required="required" name="dms_doc_uploads" class="inputfile inputfile-1" id="doc_uploads">
										</div>
										<div class="col-lg-5">
											<input value="Upload" id="submit_btn" type="submit" class="btn btn-primary"> <!--onclick="submitDMSForm();-->  
										<?php  if (!empty($dms_datas)) {    ?>
							<a href="/themes/backend/mydoc/<?php echo $iuid; ?>/<?php echo $dms_datas['document_name']; ?>" target="_blank" class="btn btn-icon-only red" title="Download"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>
							<?php  } ?>
										
										</div>
										<div id="error_div1" style="display:none; color:red;" class="alert alert-error alert-dismissable">
											<strong>ERROR</strong> <label id="label_text"></label>
										</div>

										
										<div class="col-lg-1" style="margin-top:20px;text-align:center;">
											<label id="plz_wait" style="display:none;">Please wait...</label>

										</div></div>

								</div>
							</form>
						</div>


						<?php
						if ($flg == 0) {
							$sqlSa = "SELECT * FROM bo_infowizard_documentchklist WHERE docchk_id='$doc_datas[docchk_id]' AND is_multi_version_allowed='Y' ORDER BY doc_id DESC LIMIT 1";
							$connection = Yii::app()->db;
							$command = $connection->createCommand($sqlSa);
							$multipleversionallowed = $command->queryRow();
							if (!empty($multipleversionallowed)) {
								?>
											   <!-- <a href="javascript::void(0)" doc_id="<?php //echo $doc_datas['doc_id'];  ?>" issuer_id="<?php //echo $doc_datas['issuer_id'];  ?>"
											   issued_by="<?php //echo $doc_datas['issuerby_id'];  ?>" doc_code="<?php //echo $doc_datas['docchk_id'];  ?>" 
											   mydoc_status="active" class="newdmsuploadwithmappingofreferencenvalidity"  data-toggle="modal" 
											   data-target="#DocumentManagementNew">Upload New </a>-->

								<?php
							}
						}
						?>
					</td>
				</tr>
				<?php
				}
				}
				?>							
				</tbody>
				</table>
				</div>

                <form action="/backoffice/frontuser/ApplyService/<?php echo $actionUrl; ?>" method="POST" id="skipDms">
                    <input type="hidden" name="service_id" id="pk_serid" value='<?php echo $service_id; ?>' />
                    <input type="hidden" name="sub_service_id" value='<?php echo $sub_service_id; ?>' />
                    <input type="hidden" name="caf_id" value='<?php echo $caf_id; ?>' />
                    <input type="hidden" name="documents_id" value='<?php echo trim($documents_id, ","); ?>' />
                    <input type="hidden" name="documents_id_name" value='<?php echo trim($documents_id_name, ","); ?>' />
                    <input type="hidden" name="department_id" value='<?php echo $department_id; ?>' />
                    <input type="hidden" name="swcs_department_id" value='<?php echo $swcs_department_id; ?>' />
                    <input type="hidden" name="swcs_service_id" value='<?php echo $swcs_service_id; ?>' />
                    <input type="hidden" name="stype" value='<?php echo @$_GET['stype']; ?>' />		
                    <?php if (count($appDmsArr) > 0) { ?>
                        <input type="hidden" name="dms_string" value='<?php echo implode("::", $appDmsArr) ?>' />
                    <?php } else { ?>
                        <input type="hidden" name="dms_string" value='' />
<?php } ?>
                    
				<?php $cm = Yii::app()->db->createCommand("SELECT * FROM bo_declaration_master WHERE is_active=1 AND service_id=$service_id")->queryRow(); 
                 if($cm){ ?>
                    <div class="row">
                        
                        <div class="col-lg-12">
                            <strong>Declaration</strong>
                            <p><?php echo nl2br($cm['declaration_label']); ?></p>
                         
                            <?php $cbnid = 'CP-DCHK-'.$service_id; ?>
                            <input type="checkbox" id="<?php echo $cbnid; ?>" name="<?php echo $cbnid; ?>">
                            <label for="<?php echo $cbnid; ?>"><?php echo $cm['option']; ?></label><br>
                            <span id='dcbox-error' style="color: red;"></span>
                          
                        </div>
                    </div>    
<?php } ?>
                    <div class="row buttons" align="center">
                       
                        <?php echo '<strong style="color:red;">' . $disable_btn_help_text . '</strong>'; ?>
                    
                        <?php
                        if ($disable_btn_help_text == false) {
                            $url_status = 'up';
                            $url_status = DefaultUtility::checkUrltatus($app_url);
                            if ($url_status == 'downs') {
                                $disable_btn_text = 'disabled';
                            }
                            $serviceIdArr = $_GET['service_id'] . '.' . $_GET['sub_service_id'];
                            $sqlConf = "SELECT * FROM bo_infowiz_form_builder_configuration WHERE service_id='$serviceIdArr' AND current_role_id=0";
                            $connection = Yii::app()->db;
                            $command = $connection->createCommand($sqlConf);
                            $doc_show_fist_or_last_allowed = $command->queryRow();
                            ?>

                                        <!--<input <?php //echo $disable_btn_text;  ?> type="submit" value="<?php //echo $btn_txt;  ?>" class="btn btn-primary">-->

                            <?php if ($doc_show_fist_or_last_allowed['document_show_last'] != 'Y') { ?>
                                <input <?php echo $disable_btn_text; ?> type="submit" value="<?php echo $btn_txt; ?>" class="btn btn-primary">
                                <?php
                            } else {
                                $sqlsp = "Select bo_new_application_submission.submission_id,bo_new_application_submission.sp_tag,bo_new_application_submission.dept_id,bo_new_application_submission.user_id,bo_new_application_submission.processing_level from bo_new_application_submission
					INNER JOIN bo_infowizard_issuerby_master ON bo_infowizard_issuerby_master.	issuerby_id=bo_new_application_submission.dept_id 		
					where bo_new_application_submission.submission_id='$_GET[caf_id]'";
                                $connection = Yii::app()->db;
                                $command = $connection->createCommand($sqlsp);
                                $spData = $command->queryRow();
                                ?>		
								
								<a class="btn btn-primary" href="">Back</a>&nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="button" value="Continue & Apply" name="Continue & Apply"  rel="<?php echo $spData['submission_id'] ?>" service-id="<?php echo $_GET['service_id'] . '.' . $_GET['sub_service_id']; ?>" dept-id="<?php echo $department_id; ?>" app-id="<?php echo $spData['submission_id'] ?>"  class="btn btn-primary continueApply">		
								
								
                                <?php
                            }
                            if ($url_status == 'downs') {
                                echo "<span class='urlcheckmsg'><i><b>(Departmental Portal seems to be down at this time,please try after some time.)</i></b></span>";
                            }
                            ?>
<?php } ?>
                    </div>


            </div>
            <!--</form>-->

        </section>
    </div>
</div>
<?php

function validateAllUploaded($doc_type_id, $mapped_doc_with_type) {
    //echo count(array_unique($mapped_doc_with_type)); return;
    $return_flag = true;
    if (count(array_unique($mapped_doc_with_type)) == 1) {
        $return_flag = false;
        foreach ($mapped_doc_with_type as $key => $val) {
            $dms_datas = ApplyServiceExt::getUploadedDocumentsDataByID($key);
            if (!empty($dms_datas)) {
                $return_flag = true;
            }
        }
    }
    return $return_flag;
}

function getMainDocumentType($doc_id, $doc_type_arr) {
    $doc_idss = false;

    if (count($doc_type_arr) > 0) {
        foreach ($doc_type_arr as $doc_type_id => $mand) {
            if ($mand != 'NA')
                $new_mapped_doc_type_arr[$doc_type_id] = $mand;
        }
    }
    $sqlSa = "SELECT * FROM bo_infowizard_documentchklist WHERE docchk_id='$doc_id' AND is_docchklist_active='Y' ORDER BY doc_id DESC LIMIT 1";
    $connection = Yii::app()->db;
    $command = $connection->createCommand($sqlSa);
    $res_sa = $command->queryRow();
    if (!empty($res_sa)) {
        $doc_ids = $res_sa['doc_id'];
        $doc_ids_arr = explode(",", $doc_ids);
        if (count($doc_ids_arr) > 0) {
            foreach ($doc_ids_arr as $key => $val) {
                if (isset($new_mapped_doc_type_arr[$val])) {
                    // $doc_type_name[$val] = getMainDocumentTypeName($val);
                    return $val;
                }
            }
        }
    }
    return $doc_idss;
}

function getMainDocumentTypeName($doc_id) {
    $doc_type_name = false;
    $sqlSa = "SELECT * FROM bo_infowizard_docunenttype_master WHERE doc_id='$doc_id' AND is_doc_active='Y' ORDER BY doc_id DESC LIMIT 1";
    $connection = Yii::app()->db;
    $command = $connection->createCommand($sqlSa);
    $res_sa = $command->queryRow();
    if (!empty($res_sa)) {
        $doc_type_name = $res_sa['name'];
    }
    return $doc_type_name;
}
?>
<script type="text/javascript">
    $(document).ready(function () {
        $(".continueApply").on('click', function () {
            var sno = $(this).attr('rel');
            var service_id = $(this).attr('service-id');
            var dept_id = $(this).attr('dept-id');
            var app_id = $(this).attr('app-id');
            var dcbox_id = 'CP-DCHK-'+$("#pk_serid").val();
           const cb = document.getElementById(dcbox_id);
           if(cb.checked){
                $.ajax({
                    type: "POST",
                    url: "/backoffice/infowizard/subFormCompanyNameReservation/SaveAllDocuments/sno/" + sno + "/service_id/" + service_id + "/dept_id/" + dept_id + "/app_id/" + app_id,
                    success: function (data) {
                        if (data == 1) {
                            window.location.href = "/backoffice/frontuser/home/investorWalkthroughLevel2/type/SERVICES/financial_year/ALL";
                        } else {
                            window.location.href = "/backoffice/infowizard/otherServicePayment/UnifiedPayment/service_id/" + service_id + "/app_id/" + app_id;
                        }
                    }
              });
           }else{
                $("#dcbox-error").text('This field is required');
            return false;
           }
           
            
        });

        $(".newdmsuploadwithmappingofreferencenvalidity").click(function () {
            $.ajax({
                type: "POST",
                url: "/backoffice/frontuser/DocumentManagement/index/doc_id/" + $(this).attr('doc_id') + "/issuer_id/" + $(this).attr('issuer_id') + "/issued_by/" + $(this).attr('issued_by') + "/doc_code/" + $(this).attr('doc_code') + "/mydoc_status/active",
                success: function (data) {
                    $('.dms-body').html(data);
                }
            });
        });
    });
</script>
<!-- Modal -->
<div id="DocumentManagementNew" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Document Management</h4>
            </div>
            <div class="modal-body dms-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
<script type="text/javascript">
<?php if (@$_GET['dmsCheck'] == 'N') { ?>
        $(window).load(function () {

            $("#skipDms").submit();
        });
<?php } ?>
    function ShowLoader() {}
</script>


<script type="text/javascript">
    /*showHideDiv("<?php // echo $doc_code;   ?>");*/
    $("document").ready(function () {
        $(".date-picker").datepicker({
            //rtl: App.isRTL(),
            autoclose: !0,
            format: 'yyyy-mm-dd',
            useCurrent: false,
        });

        $(".rad").change(function () {
            $('.dupl_row').hide();
            if ($(this).attr('value') == 'D') {
                $('.dupl_row').show();
            }
        });



    });
    var flag;
    function showHideDiv(val) {
        $('#new_row').hide();
        $('.validity_dddddddd').hide();
        $('.doc_dddddddd').hide();
        if (val == '') {
            $('#new_row').hide();
        } else {
            var $doc_code = $('#doc_code');
            var mv1 = 'Y';<?php // echo $docDetail['is_multi_version_allowed'];  ?>
            var mv2 = "<?php //echo $docDetail['is_validity_required'];  ?>";
            var mv3 = "<?php //echo $docDetail['is_document_reference_no_required'];  ?>";
            var mv4 = "<?php //echo @$docDetail['date_of_issuance'];  ?>";

            if (mv1 == 'Y') {
                $('#new_row').show();
            }
            if (mv2 == 'Y') {

                $('.validity_dddddddd').show();
            }

            if (mv3 == 'Y') {

                $('.doc_dddddddd').show();

            }
            if (mv4 == 'Y') {

                $('#issuance_dddddddd').show();
            }
            getAllDocumentCheckListNew(val);
        }
    }

    function getAllDocumentCheckListNew(val) {
        $.ajax({
            type: "get",
            url: "<?php echo Yii::app()->request->baseUrl; ?>/dms/DocumentManagement/GetAllDocumentCheckListHistory/chk_id/" + val,
            success: function (data) {
                $('#doc_code_old').html(data);
            }
        });
    }
    //alert('continue..');
    function validateAndSubmit()
    {

        $('.error_span').hide();
        var $doc_id = $('#doc_id');
        var $issuer_id = $('#issuer_id');
        var $issued_by = $('#issued_by');
        var $doc_code = $('#doc_code');
        var $doc_uploads = $('#doc_uploads');
        var error = 0;
        var mov;

        if ($doc_id.val() == '') {
            $doc_id.after('<span class="error_span">This is required field.</span>');
            error = 1;
        }

        if ($issuer_id.val() == '') {
            $issuer_id.after('<span class="error_span">This is required field.</span>');
            error = 1;
        }

        if ($issued_by.val() == '') {

            $issued_by.after('<span class="error_span">This is required field.</span>');

            error = 1;

        }

        if ($doc_code.val() == '') {

            $doc_code.after('<span class="error_span">This is required field.</span>');

            error = 1;

        }

        if ($doc_uploads.val() == '') {

            $('#up_b').after('<span class="error_span">This is required field.</span>');

            error = 1;

        }



        if (error == 0) {
            var mv1 = "Y";
            var mv2 = "<?php //echo $docDetail['is_validity_required'];  ?>";
            var mv3 = "<?php //echo $docDetail['is_document_reference_no_required'];  ?>";
            if (mv2 == 'Y' && $('#valid_from').val() == '') {

                $('#valid_from_b').after('<span class="error_span">This field is required.</span>');

                error = 1;

            }
            if (mv2 == 'Y' && $('#valid_to').val() == '') {

                $('#valid_to_b').after('<span class="error_span">This field is required.</span>');

                error = 1;

            }
            if (mv3 == 'Y' && $('#document_reference_number').val() == '') {

                $('#ref_b').after('<span class="error_span">This field is required.</span>');

                error = 1;

            }

            if (error == 0) {
                checkDuplicateDoc($doc_code.val(), mv1);
            }
            //checkDuplicateDoc($doc_code.val(), $('#op-'+$doc_code.val()).attr('data-mv'));

        }

    }


   function submitDMSForms(){	 
      //evt.preventDefault();
      var formData = new FormData($(this)[0]);
   $.ajax({
       url: "<?php echo Yii::app()->createAbsoluteUrl('frontuser/DocumentManagement/'); ?>",
       type: 'POST',
       data: formData,
       async: false,
       cache: false,
       enctype: 'multipart/form-data',
       processData: false,
       success: function (response) {
         alert(response);
       }
   });
   return false;
 }
 function submitDMSForm(flag) {
        var formData = new FormData($('form')[1]);

        $.ajax({

            type: "POST",

            async: false,

            cache: false,
enctype: 'multipart/form-data',
            contentType: false,

            processData: false,

            url: "<?php echo Yii::app()->createAbsoluteUrl('frontuser/DocumentManagement/'); ?>",

            data: formData,

            success: function (data) {

                //$('#issued_by_div').html(data);

                if (data == 'success') {
                    $('#error_div1').show();
                    window.location.reload();
                    

                } else {

                    //alert(data);

                    $('#error_div1').show();

                    $('#error_div1').focus();

                    $('#label_text').html(data);

                    $('#plz_wait').hide();

                }

            },

            error: function (jqXHR, textStatus, errorThrown) {

                alert('Error::' + errorThrown);

            }

        });

    }

    function getAllIssuerBy(val, doc_id) {

        $.ajax({

            type: "POST",

            url: "<?php echo Yii::app()->request->baseUrl; ?>/dms/DocumentManagement/getAllIssuerBy",

            data:
                    {

                        issuerid: val, doc_id: doc_id

                    },

            success: function (data) { //alert(data);

                $('#issued_by_div').html(data);

                resetDropdown('one');

            },

            error: function (jqXHR, textStatus, errorThrown) {

                alert('Error::' + errorThrown);

            }

        });

    }



    function getAllDocumentCheckList(val) {

        $.ajax({

            type: "POST",

            url: "<?php echo Yii::app()->request->baseUrl; ?>/dms/DocumentManagement/getAllDocumentCheckList",

            data:
                    {

                        doc_id: $('#doc_id').val(), issuer_id: $('#issuer_id').val(), issued_by: val

                    },

            success: function (data) { //alert(data);

                $('#document_div').html(data);

            },

            error: function (jqXHR, textStatus, errorThrown) {

                alert('Error::' + errorThrown);

            }

        });

    }



    function checkDocCheckListID() {

        $.ajax({

            type: "POST",

            url: "<?php echo Yii::app()->request->baseUrl; ?>/dms/DocumentManagement/getAllIssuerBy",

            data:
                    {

                        issuer_id: $('#issuer_id').val(), doc_id: $('#doc_id').val(), issued_by: $('#issued_by').val(),

                    },

            success: function (data) { //alert(data);

                if (data == false) {

                    alert("Not mapped");

                    return false;

                }

                return true;

            },

            error: function (jqXHR, textStatus, errorThrown) {

                alert('Error::' + errorThrown);

            }

        });

    }



    function deleteMyDocument(ref_no, doc_status) {

        var cnf = confirm("Are you sure you want to delete this document?");

        if (cnf) {

            $.ajax({

                type: "POST",

                url: "<?php echo Yii::app()->request->baseUrl; ?>/dms/DocumentManagement/deleteMyDocument/",

                data:
                        {

                            ref_no: ref_no, doc_status: doc_status

                        },

                success: function (data) { //alert(data);

                    if (data == 'success') {

                        window.location.reload();

                        return;

                    }

                    alert(data);

                },

                error: function (jqXHR, textStatus, errorThrown) {

                    alert('Error::' + errorThrown);

                }

            });

        }

    }



    function checkDuplicateDoc(dms_doc_id, mv1) {

        $('#plz_wait').show();

        $.ajax({

            type: "POST",

            dataType: "json",

            url: "<?php echo Yii::app()->request->baseUrl; ?>/dms/DocumentManagement/checkDuplicateDoc",

            data:
                    {

                        dms_doc_id: dms_doc_id, mv: mv1,

                    },

            success: function (data) {



                var obj = data;

                if (obj.response == 'SUCCESS') {

                    submitDMSForm(data);

                } else if (obj.response == 'FAILED') {

                    $('#plz_wait').hide();
                    var msg_new = 'Document already uploaded in your documents list.';
                    alert(obj.response_msg);

                }

                //submitDMSForm(data);

            },

            error: function (jqXHR, textStatus, errorThrown) {

                alert('Error::' + errorThrown);

            }

        });

    }

    function activateAllDocuments() {

        $.ajax({

            type: "POST",

            url: "<?php echo Yii::app()->request->baseUrl; ?>/dms/DocumentManagement/activateAllDocuments",

            data:
                    {

                        flag: 'activate',

                    },

            success: function (data) {

                if (data == 'success') {

                    window.location.href = '<?php echo Yii::app()->request->baseUrl; ?>/dms/DocumentManagement/myDocuments';

                }

            },

            error: function (jqXHR, textStatus, errorThrown) {

                alert('Error::' + errorThrown);

            }

        });

    }



    function resetDropdown(flag) {

        if (flag == 'all') {

            $('#issued_by_div').html('<select class="form-control" autocomplete="off" name="FileUpload[issued_by]" id="issued_by" required="required"><option value="" selected="selected">--Select Issued By--</option></select>');

            $('#document_div').html('<select class="form-control" autocomplete="off" required="required" name="FileUpload[doc_code]" id="doc_code"><option value="" selected="selected">--Select Document--</option></select>');

            $('#issuer_id').val('');

        } else if (flag == 'one') {

            $('#document_div').html('<select class="form-control" autocomplete="off" required="required" name="FileUpload[doc_code]" id="doc_code"><option value="" selected="selected">--Select Document--</option></select>');

        }

    }
</script>