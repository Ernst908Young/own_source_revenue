<link href="/backoffice/themes/swcsNewTheme/fb/vendors/base/vendors.bundle.css" rel="stylesheet" type="text/css" />

<?php
   @extract($_GET);
   
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
   .required-document-div:after {
      content:" * ";
      color:red;
   }
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
   /* .pull-left{display:none;}  */
   <?php if (@$_GET['dmsCheck'] == 'N') { ?>
   .dmsSkip{display:none;}
   <?php }
      ?>
</style>
<div class="reservation-form">
   <div class="dmsSkip">
      <?php
         $cls = @$_GET['type'];
         if (isset($_GET['is']) && $_GET['is'] != '')
             $is = $_GET['is'];
         else
             $is = "no";
         ?>
      <?php
         if (isset($type) && $type == 'Offline') {
             $actionUrl = "saveOfflineApplication";
             $btn_txt = "Save & Continue";
         } else {
         
             $actionUrl = "RedirectToDeprtmentURLNew";
             $btn_txt = "Continue & Apply";
         }
         ?>
      <section class="panel site-min-height dmsSkip">
         <div class="panel-body" >
            <div style="text-align:justify;padding:20px;color:red;font-size:16px;font-weight:bold;">
               <?php $phase2_service_id = [19,20,21,22]; 
                  if(in_array($swcs_service_id, $phase2_service_id)){
                      echo "Note*: Please provide supporting documents such as any schedule referred in the form, or any other document stated under the applicable acts, rules and regulations; and attach the same under this section.";
                  }else{
                      echo "Note*: In case you want to provide any supporting documents for the application such as identification and proof of address of the Applicant, consent for reserving similar names, approvals for using restricted words in the proposed names, etc then please attach the same under this section.";
                  }
                  
                  ?>
            </div>
            <div class="table">
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
               <table class="table table-bordered table-scrollable table-lg mt-lg mb-0" width="100%" style="background: #ebf3f961;">
                  <thead style="background: #1683c6;
                     color: #ffffff;
                     font-weight: 500;">
                     <tr>
                        <th class="cent vln" width="5%">S.No</th>
                        <th class="cent vln" width="35%">Document Name</th>
                        <th class="cent vln" width="35%">Description of Document</th>
                        <th class="cent vln"  width="25%">Upload Document</th>
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
                        
                        /* if (count($document_type_mapping_array) > 0) {
                            foreach ($document_type_mapping_array as $key => $document_type_mapping_array_data) {
                                $new_mapped_doc_type_arr[$document_type_mapping_array_data['doc_id']] = $document_type_mapping_array_data['is_required'];
                            }
                        }*/
                        /* if (count($mapped_documents_array) > 0) {
                            foreach ($mapped_documents_array as $key => $mapped_documents_array_data) {
                                $new_mapped_doc_arr[$mapped_documents_array_data['doc_id']] = $mapped_documents_array_data['is_required'];
                                $doc_datas = ApplyServiceExt::getDocumentsDataByID($mapped_documents_array_data['doc_id']);
                                if (!isset($new_mapped_doc_type_arr[$doc_datas['doc_id']])) {
                                    $new_mapped_doc_type_arr[$doc_datas['doc_id']] = 'NA';
                                }
                                $new_mapped_doc_type_with_doc_arr[$doc_datas['doc_id']][$doc_datas['docchk_id']] = $mapped_documents_array_data['is_required'];
                            }
                        }*/
                        // echo "<pre>";print_r($mapped_documents_array);die;
                        if (count($mapped_documents_array) > 0) {
                            foreach ($mapped_documents_array as $key => $val) {      
                                $doc_datas = ApplyServiceExt::getDocumentsDataByID($val['doc_id']);
                                $dms_datas = ApplyServiceExt::getUploadedDocumentsDataByID($caf_id,$val['doc_id']);
                               /* $doc_ids = getMainDocumentType($val['doc_id'], $new_mapped_doc_type_arr);*/
                                ?>
                                     <tr>
                                        <div class="form form-horizontal" role="form">
                                           <form role="form" action =""  enctype="multipart/form-data" method="post" id="submit_form1" name="submit_form">
                                              <input type='hidden' name='FileUpload[YII_CSRF_TOKEN]' value="<?php echo Yii::app()->getRequest()->getCsrfToken(); ?>" />
                                              <div class="form form-horizontal" role="form">
                                                 <td class="cent vln" width="5%">
                                                    <?php echo ++$sno; ?>
                                                 </td>
                                                 <td class="cent vln <?=($val['is_required']=='Y' ? 'required-document-div' : '')?>" width="35%" style=" text-align: left !important;">
                                                    <?php echo $doc_datas['document_name']; ?>
                                                 </td>
                                                 <td class="cent vln" width="35%"> 
                                                    <input type="hidden" name="FileUpload[doc_id]" id="doc_id" value="<?php echo @$val['doc_id']; ?>">
                                                    <input type="hidden" name="FileUpload[issuer_id]" id="issuer_id" value="<?php echo @$doc_datas['issuer_id']; ?>">
                                                    <input type="hidden"  name="FileUpload[issued_by]" id="issued_by" value="<?php echo @$doc_datas['issuerby_id']; ?>" >
                                                    <input type="hidden"  name="FileUpload[doc_code]" id="doc_code" value="<?php echo @$doc_datas['docchk_id']; ?>" >
                                                    <input type="hidden" name="FileUpload[mydoc_status]" value="active">
                                                    <input type="hidden" name="FileUpload[doc_version_type]" value="V" checked id="new_copy">
                                                    <input type="hidden"  name="FileUpload[document_reference_number]" id="document_reference_number" value="">
                                                    <input type="hidden" name="FileUpload[valid_from]" id="valid_from" value="">
                                                    <input type="hidden" name="FileUpload[valid_to]" id="valid_to" value="" >
                                                    <input type="hidden" name="FileUpload[doc_date_of_issuance]" id="doc_date_of_issuance"  value="">
                                                    <input type="hidden" name="department_id" value='<?php echo $department_id; ?>' />
                                                    <input type="hidden" name="srn_no" value='<?php echo $caf_id; ?>' />
                                                    <textarea name="FileUpload[comments]" required rows = "3" id="comments" maxlength="255" ><?php  if (!empty($dms_datas)) {  echo  $dms_datas['usercomment'];} ?></textarea> 
                                                 </td>
                                              </div>
                                              <td class="vln" width="25%" style="padding-left: 25px;">
                                                 <div class="row">
                                                    <div class="col-lg-12">
                                                       <input type="file"  required="required" name="dms_doc_uploads" class="inputfile inputfile-1 <?=(($val['is_required']=='Y' && empty($dms_datas))=='Y' ? 'required-document' : '')?>" id="doc_uploads" style="padding-top: 10px;">
                                                       <small>(Please upload PDF, JPG, PNG only.) <br> <span style="color:red;">Maximum file size allowed 5 MB</span></small>
                                                    </div>
                                                    <div class="col-lg-12 text-left">
                                                       <input value="Upload" id="submit_btn" type="submit" class="btn btn-primary" style="float: left; margin-top: 20px;"> 
                                                       <?php  if (!empty($dms_datas)) {    ?>
                                                       <!--<a href="/themes/backend/mydoc/<?php// echo $iuid; ?>/<?php //echo $dms_datas['document_file_name']; ?>" target="_blank"  title="Click to see or download uploaded document" style="float: left;  margin-top: 25px; margin-left: 10px;">
                                                          <img src="/themes/investuk/assets/applicant/images/print-icon.png">-->
                                                       <a href="/backoffice/doc/mydoc?view=<?php echo DefaultUtility::getDockey($dms_datas['document_file_name']); ?>" target="_blank"  title="Click to see or download uploaded document" style="float: left;  margin-top: 25px; margin-left: 10px;"><img src="/themes/investuk/assets/applicant/images/print-icon.png"></a>
                                                       <?php  } ?>
                                                    </div>
                                                    <div id="error_div1" style="display:none; color:red;" class="alert alert-error alert-dismissable">
                                                       <strong>ERROR</strong> <label id="label_text"></label>
                                                    </div>
                                                    <div class="col-lg-1" style="margin-top:20px;text-align:center;">
                                                       <label id="plz_wait" style="display:none;">Please wait...</label>
                                                    </div>
                                                 </div>
                                              </td>
                                           </form>
                                        </div>
                                     </tr>
                     <?php  }
                        } ?>                            
                  </tbody>
               </table>
            </div>
            <form action="/backoffice/investor/ApplyService/<?php echo $actionUrl; ?>" method="POST" id="skipDms">
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
            <?php 
               } 
               
               $cm = Yii::app()->db->createCommand("SELECT * FROM bo_declaration_master WHERE is_active=1 AND service_id=$service_id")->queryRow(); 
                           if($cm){ ?>
            <div class="row">
               <div class="col-lg-12">
                  <strong>Declaration:</strong>
                  <?php 
                     if($service_id=='2.0'){
                        
                        $dataArr = Yii::app()->db->createCommand("SELECT SUBSTRING_INDEX(SUBSTRING_INDEX(bo_new_application_submission.field_value,'\"UK-FCL-00044_0\":\"',-1),'\",',1) as application_for FROM bo_new_application_submission WHERE submission_id=$_GET[caf_id]")->queryRow(); 
                        
                        if($dataArr['application_for']==3){
                            $cm = Yii::app()->db->createCommand("SELECT * FROM bo_declaration_master WHERE is_active='1' AND service_id='$service_id' and form_id='1'")->queryRow(); 
                            echo "<p>".nl2br($cm['declaration_label']);"</p>";
                        }else if($dataArr['application_for']==2 || $dataArr['application_for']==1)
                        {
                            $cm = Yii::app()->db->createCommand("SELECT * FROM bo_declaration_master WHERE is_active='1' AND service_id='$service_id' and form_id IN('15','33')")->queryRow(); 
                            echo "<p>".nl2br($cm['declaration_label']);"</p>";
                        }
                     }else{ 
                     ?>
                  <p><?php echo nl2br($cm['declaration_label']); ?></p>
                  <br>
                  <?php 
                     }
                     ?>
                  <?php $cbnid = 'CP-DCHK-'.$service_id; ?>
                  <input type="checkbox" id="<?php echo $cbnid; ?>" name="<?php echo $cbnid; ?>">
                  <label style="margin-left: 10px;" for="<?php echo $cbnid; ?>"><?php echo $cm['option']; ?></label><br>
                  <span id='dcbox-error' style="color: red;"></span>
               </div>
            </div>
            <?php } ?>
            <?php 
               $flag = 1;
               
               if($service_id=='2.0'){                              
                $dataArr = Yii::app()->db->createCommand("SELECT SUBSTRING_INDEX(SUBSTRING_INDEX(bo_new_application_submission.field_value,'\"UK-FCL-00044_0\":\"',-1),'\",',1) as application_for FROM bo_new_application_submission WHERE submission_id=$_GET[caf_id]")->queryRow();  
                if($dataArr['application_for']==3)
                {
                    $flag = 1;
                }
                
                if($dataArr['application_for']==2 || $dataArr['application_for']==1)
                {
                    $flag = 0;
                }
               }    
               
               if($flag==1){
               ?>
            <input type="hidden" id="issig" value="1">
            <br>
            <!--div class="row">                        
               <div class="col-lg-12">
                <strong>Signature:</strong><br>
                  <span> By clicking "Sign and Submit" I declare that:</span>
                <ul style="List-style:disc; margin-left: 25px; margin-top: 10px;">
                    <li>I am the person identified in this submission;</li>
                    <li>I am authorised by law to sign and submit this form; and </li>
                    <li>I have read and understood the questions required by this form and my responses/answers herein are true and correct to the best of my knowledge and belief. </li>
                </ul>
                <p style="margin-top: 10px; text-align: justify;">Pursuant to Section 432 of the Companies Act, the submission of any report, return, notice or document that contains an untrue statement of a material fact or omits to state a material fact required is guilty of an offence and  an liable on summary conviction to a fine of BDS$20,000.00 or to imprisonment to a term of two years, or to both.</p>
                <input type="checkbox" id="elcto_sign" name="elcto_sign">
                <label style="margin-left: 10px;" >Sign and Submit</label><br>
                <span id='esbox-error' style="color: red;"></span>
               </div>
               </div-->
            <?php 
               }else{
                      echo '<input type="hidden" id="issig" value="0">';
                  } 
               ?>
            <div class="d-flex justify-content-center my-4" align="center">
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
                      if ($doc_show_fist_or_last_allowed['document_show_last'] != 'Y') { ?>
               <input <?php echo $disable_btn_text; ?> type="submit" value="<?php echo $btn_txt; ?>" class="btn btn-primary">
               <?php
                  } else {
                      $sqlsp = "SELECT bo_new_application_submission.submission_id,bo_new_application_submission.sp_tag,bo_new_application_submission.dept_id,bo_new_application_submission.user_id,bo_new_application_submission.processing_level,
                           bo_new_application_submission.application_status
                      from bo_new_application_submission
                  INNER JOIN bo_infowizard_issuerby_master ON bo_infowizard_issuerby_master.    issuerby_id=bo_new_application_submission.dept_id       
                  where bo_new_application_submission.submission_id='$_GET[caf_id]'";
                  $connection = Yii::app()->db;
                  $command = $connection->createCommand($sqlsp);
                  $spData = $command->queryRow();
                  
                  
                  /*    if(isset($_GET['service_id']) && in_array($_GET['service_id'],array('2.0')))
                  {*/
                  $serviceID = $_GET['service_id'].'.'.$_GET['sub_service_id'];
                  $sqlsp = "SELECT form_action_controller FROM bo_infowiz_form_builder_configuration WHERE service_id='$serviceID'";
                  $connection = Yii::app()->db;
                  $command = $connection->createCommand($sqlsp);
                  $spArr = $command->queryRow();
                  
                  ?>            
               <a class="btn btn-primary" href="/backoffice/infowizardtwo/<?php echo $spArr['form_action_controller'];?>/updateSubForm/service_id/<?php echo $serviceID;?>/pageID/1/subID/<?php echo $_GET['caf_id'];?>/formCodeID/1/stype/old">Back</a>&nbsp;&nbsp;&nbsp;&nbsp;
               <input type="button" value="Continue & Apply" name="Continue & Apply"  rel="<?php echo $spData['submission_id'] ?>" service-id="<?php echo $_GET['service_id'] . '.' . $_GET['sub_service_id']; ?>" dept-id="<?php echo $department_id; ?>" app-id="<?php echo $spData['submission_id'] ?>" flag-data="<?php echo $flag;?>" class="btn btn-primary continueApply">  
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
   <script src="/backoffice/themes/swcsNewTheme/fb/vendors/base/vendors.bundle.js" type="text/javascript"></script>
<script type="text/javascript">
   $(document).ready(function () {
       $(".continueApply").on('click', function () {

           var inputs = $(".required-document");
           if(inputs.length > 0){
            swal({
                    // "title": "Please provide supporting documents such as any schedule referred in the form, or any other document stated under the applicable acts, rules and regulations; and attach the same under this section.", 
                    "text": "Please provide supporting documents such as any schedule referred in the form, or any other document stated under the applicable acts, rules and regulations; and attach the same under this section.", 
                    "type": "error",
                    // "icon":"error",
                    "confirmButtonClass": "btn btn-secondary m-btn m-btn--wide"
            });
            return false;
           }
           var sno = $(this).attr('rel');
           var service_id = $(this).attr('service-id');
           var dept_id = $(this).attr('dept-id');
           var app_id = $(this).attr('app-id');
           var dcbox_id = 'CP-DCHK-'+$("#pk_serid").val();
           const cb = document.getElementById(dcbox_id);           
           const es = document.getElementById("elcto_sign");
           var flag_data = document.getElementById("flag-data");
   
          if(cb.checked){       
            var issig = $("#issig").val();      
   if(issig==0){                
    $.ajax({
        type: "POST",
        url: "/backoffice/investor/services/SaveAllDocuments/sno/" + sno + "/service_id/" + service_id + "/dept_id/" + dept_id + "/app_id/" + app_id,
        success: function (data) {  
            window.location.href = "/backoffice/investor/services/signatory/srn_no/"+sno+"/dept_id/"+dept_id;
        }
    });
   }
               else{
    // if(es.checked){
        $.ajax({
            type: "POST",
            url: "/backoffice/investor/services/SaveAllDocuments/sno/" + sno + "/service_id/" + service_id + "/dept_id/" + dept_id + "/app_id/" + app_id,
            success: function (data) {                                                  
                window.location.href = "/backoffice/investor/services/signatory/srn_no/"+sno+"/dept_id/"+dept_id;
            }
        });
    // }else{
    //   $("#esbox-error").text('This field is required');
    //      return false;
    // }
   }    
              
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