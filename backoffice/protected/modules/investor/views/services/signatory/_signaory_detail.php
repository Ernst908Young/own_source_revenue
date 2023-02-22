<div class="reservation-form p-0">
 <div class="m-wizard__form" style="padding: 17px 33px 0px;">
    <!-- <p style="color:red; font-size: 14px;">Fields marked with * are mandatory fields, however, in case any of these fields is (are) not applicable in your case, then please mention "Not Applicable" or "NA"</p> -->
    <div class="m-wizard__form-step m-wizard__form-step--current" id="m_wizard_form_step_1">
       <div class="form-part bussiness-det">
          <form id="s_form" method="post" action=<?php echo CURL_URL?>"/backoffice/investor/services/saveSignature">
             <input type="hidden" name="srn_no" id="srn_no" value="<?= $srn_no ?>">     
             <input type="hidden" name="service_id" id="service_id" value="<?= $service_srn['service_id'] ?>">              
             <div id="signature_form_div">
                <h4 class="form-heading">Signatory Details</h4>
             </div>
             <div class="form-row row">
                <div class="col-lg-6 form-group mb-3">
                   <label>
                   No. of Signatory <span style="color:red;"> *</span>                        
                   </label>
                   <div class="col-md-12" id="input_designation">
                      <select name="nosig" id="nosig" class="select2-me" required>
                         <option value="">Select </option>
                         <?php for($i=1; $i<=10; $i++) { 
                            $selected = $service_srn['no_of_signatory']==$i ? 'selected' : '';
                            ?>
                         <option value="<?= $i ?>" <?= $selected ?>><?= $i ?></option>
                         <?php } ?>
                      </select>
                      <span id="nosigerror" style="color: red;"></span>     
                   </div>
                </div>
                <div class="form-group col-md-6" id="div_first_name">
                   <label class="col-md-12 control-label text-left" for="" id="label_first_name">
                      First Name<span style="color:red;"> *</span> 
                      <svg class="svg-inline--fa fa-question-circle fa-w-16 text-info fa-lg" data-html="true" data-toggle="tooltip" title="" aria-labelledby="svg-inline--fa-title-TByvzM3cqs3b" data-prefix="fa" data-icon="question-circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="" data-bs-original-title="The form must be dated and e-signed by atleast one Signatory with the Name (full name) and designation of the Signatory. ">
                         <title id="svg-inline--fa-title-TByvzM3cqs3b">The form must be e-signed by atleast one existing officer on record with the Name (full name) and designation of officer. </title>
                         <path fill="currentColor" d="M504 256c0 136.997-111.043 248-248 248S8 392.997 8 256C8 119.083 119.043 8 256 8s248 111.083 248 248zM262.655 90c-54.497 0-89.255 22.957-116.549 63.758-3.536 5.286-2.353 12.415 2.715 16.258l34.699 26.31c5.205 3.947 12.621 3.008 16.665-2.122 17.864-22.658 30.113-35.797 57.303-35.797 20.429 0 45.698 13.148 45.698 32.958 0 14.976-12.363 22.667-32.534 33.976C247.128 238.528 216 254.941 216 296v4c0 6.627 5.373 12 12 12h56c6.627 0 12-5.373 12-12v-1.333c0-28.462 83.186-29.647 83.186-106.667 0-58.002-60.165-102-116.531-102zM256 338c-25.365 0-46 20.635-46 46 0 25.364 20.635 46 46 46s46-20.636 46-46c0-25.365-20.635-46-46-46z"></path>
                      </svg>
                   </label>
                   <div class="col-md-12" id="input_first_name">
                      <input type="text" name="first_name" placeholder="Enter First Name" class="form-control " required="" id="first_name" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter First Name'">
                      <span id="fne" style="color: red;"></span>
                   </div>
                </div>
                <div class="form-group col-md-6">
                   <label>Middle Name</label>
                   <div class="col-md-12" id="input_middle_name">
                      <input type="text" name="middle_name" placeholder="Middle Name" class="form-control "  id="middle_name" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Middle Name'">
                      <div style="margin-top:10px;"><input type="checkbox" id="middlenamecheckbox" name="middlenamecheckbox" class="group1"> I do not have a middle name or middle initial
                      </div>
                      <span id="mne" style="color: red;"></span>
                   </div>
                </div>
                <div class="col-lg-6 form-group mb-3">
                   <label>
                   Last Name<span style="color:red;"> *</span>                       
                   </label>
                   <div class="col-md-12" id="input_last_name">
                      <input type="text" name="last_name" placeholder="Last Name" class="form-control " required="" id="last_name" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Last Name'">
                      <span id="lne" style="color: red;"></span>
                   </div>
                </div>
                <div class="col-lg-6 form-group mb-3">
                    <?php 
                   $des_map = Yii::app()->db->createCommand("SELECT m.id as mapping_id, d.id as d_id, d.designation FROM signatory_services_designation_mapping as m INNER JOIN signatory_designation as d ON m.signatory_id=d.id  where m.is_active=1 AND m.service_id='".$sid."'")->queryAll();
                       if($des_map){
                        $des_arr = $des_map;
                       }else{
                          $des_arr = Yii::app()->db->createCommand("SELECT * FROM signatory_designation where is_active=1 ")->queryAll(); 
                       }
                   ?>    
                   <label>
                   Designation <span style="color:red;"> *</span>                       
                   </label>
                  <div class="col-md-12" id="input_designation">
                      <select name="designation" id="designation" class="select2-me" required>
                         <option value="">Select designation </option>
                         <?php 
                          foreach ($des_arr as $key => $value) { ?>
                         <option value="<?= $value['designation'] ?>">
                            <?= $value['designation'] ?> 
                         </option>
                         <?php } ?>
                      </select>
                      <span id="derror" style="color: red;"></span>   
                   </div>
                </div>
                <div class="col-lg-12 mb-3">
                   <strong>Signature:</strong><br>
                   <span> By clicking "Sign and Submit" I declare that:</span>
                   <ul style="List-style:disc; margin-left: 25px; margin-top: 10px;">
                      <li>I am the person identified in this submission;</li>
                      <li>I am authorised by law to sign and submit this form; and </li>
                      <li>I have read and understood the questions required by this form and my responses/answers herein are true and correct to the best of my knowledge and belief. </li>
                   </ul>
                   <p style="margin-top: 10px; text-align: justify;">Pursuant to Section 432 of the Companies Act, the submission of any report, return, notice or document that contains an untrue statement of a material fact or omits to state a material fact required is guilty of an offence and  is liable of summary conviction to a fine of BDS$20,000.00 or to imprisonment to a term of two years, or to both.</p>
                   <input type="checkbox" id="elcto_sign" name="elcto_sign">
                   <label style="margin-left: 10px;" >Sign and Submit</label><br>
                   <span id='esbox-error' style="color: red;"></span>
                </div>
                <div class="col-md-12 mb-3">
                   <a href="javascript:;" class="btn-primary mt-3 add-more-btn" relf="4.0" rel="6" relid="669" onclick="adddetail(<?= $srn_no ?>)">+Save Detail(S)
                   </a>&nbsp;&nbsp;
                   <br><br><span style="color:red;font-size:12px;">(Please click on the button "+Save Detail(s)" to capture details provided above in tabular form)</span>
                   <br>
                   <span id="rr_error" style="color: red;"></span>
                </div>
             </div>
          </form>
          <?php 
             $sql = "SELECT * FROM bo_signature_metadata WHERE is_active=1 AND submission_id=$srn_no";
                $connection = Yii::app()->db;
             $command = $connection->createCommand($sql);
             $command->bindParam(":sid",  $sid, PDO::PARAM_STR);
             $records=$command->queryAll();
             if($records){
             
             ?>
          <div class="form-row row">
             <table class="table table-bordered" id="tbl_sig">
                <tr>
                   <th>Sr. No.</th>
                   <th>Full Name</th>
                   <th>Designation</th>
                   <th>Signature</th>
                   <th>Date of signing</th>
                   <th>Delete</th>
                </tr>
                <?php $i=1; foreach ($records as $key => $value) { ?>
                <tr>
                   <td><?= $key+1 ?></td>
                   <td><?= $value['first_name'].' '.$value['middle_name'].' '.$value['last_name'] ?></td>
                   <td><?= $value['designation'] ?></td>
                   <td>Electronically signed</td>
                   <td><?= $value['date_of_signing'] ?></td>
                   <td>
                      <a onclick="detelerow(<?= $value['id'] ?>)" class="btn btn-danger" >
                      <i class="fa fa-trash"></i>
                      </a>
                   </td>
                </tr>
                <?php $i++; } ?>
             </table>
          </div>
          <?php } ?>
          <div class="form-row row">
             <div class="col-md-12 mb-3" style="text-align: center;">       
                <?php  
                   $status_not_appliend_for_payment = ['H']; 
                   
                            $already_paid = Yii::app()->db->createCommand("SELECT * FROM tbl_payment WHERE payment_status='success' AND submission_id=".$srn_no)->queryRow();
                   
                            if(empty($already_paid) && !in_array($service_srn['service_id'], array('6.0','7.0')) && !in_array($service_srn['application_status'], $status_not_appliend_for_payment )){ 
                        ?> 
                <a class="btn btn-primary" href="javascript:;" onclick="window.history.go(-1);">Back</a>&nbsp;&nbsp;&nbsp;&nbsp;
                <a href="javascript:;" class="btn-primary mt-3" onclick="contipay(<?= $srn_no ?>)">
                CONTINUE & PAY
                </a>&nbsp;&nbsp;
                <?php }else{ ?>
                <a class="btn btn-primary" href="javascript:;" onclick="window.history.go(-1);">Back</a>&nbsp;&nbsp;&nbsp;&nbsp;
                <a href="javascript:;" class="btn-primary mt-3" onclick="contiapply(<?= $srn_no ?>)">
                CONTINUE & APPLY
                </a>&nbsp;&nbsp;
                <?php } ?>
             </div>
          </div>
       </div>
    </div>
    <br><br>
 </div>
</div>
<script type="text/javascript">
	function adddetail(srn_no) {

	   var nosig = $("#nosig").val();
	   var fn = $("#first_name").val();
	   var mn = $("#middle_name").val();
	   var ln = $("#last_name").val();
	   var de = $("#designation").val();
	   var dept_id = "<?= $dept_id ?>";
	   const es = document.getElementById("elcto_sign");

	   if (mn) {
	      var checkfield = true;
	   } else {
	      var mncb = $('input[name=middlenamecheckbox]:checked').val();
	      if (mncb) {
	         var checkfield = true;
	      } else {
	         var checkfield = false;
	      }
	   }

	   if (nosig == '') {
	      $("#nosigerror").text('This field is required');
	   } else {
	      $("#nosigerror").text('');
	      if (fn == '') {
	         $("#fne").text('This field is required');
	      } else {
	         $("#fne").text('');
	         if (checkfield == false) {
	            $("#mne").text('Please enter the required information or select the check box');
	         } else {
	            $("#mne").text("");
	            if (ln == '') {
	               $("#lne").text('This field is required');
	            } else {
	               $("#lne").text("");
	               if (de == '') {
	                  $("#derror").text('This field is required');
	               } else {
	                  $("#derror").text('');
	                  if (es.checked) {
	                     $("#esbox-error").text('');

	                     var totalRowCount = $("#tbl_sig td").closest("tr").length;

	                     if (nosig <= totalRowCount) {
	                        $("#rr_error").text("Please add details of the Signatory Details as per the number entered in this field 'No. of signatory'");

	                     } else {
	                        if (confirm('Before adding, please check whether the details entered is correct.')) {

	                           $.ajax({
	                              type: "POST",
	                              dataType: 'json',
	                              url: "/backoffice/investor/services/saveSignature/srn_no/" + srn_no,
	                              data: {
	                                 noofsig: nosig,
	                                 srn_no: $("#srn_no").val(),
	                                 fn: fn,
	                                 mn: mn,
	                                 ln: ln,
	                                 de: de,
	                                 mactchSign:'N'
	                              },
	                              beforeSend: function () {
	                                 $("#rr_error").text("Please wait...");
	                              },
	                              success: function (result) {
	                                 if (result.status == false) {
	                                    $("#rr_error").text("Something went wrong");
	                                 } else {
	                                    window.location.href = "/backoffice/investor/services/signatory/srn_no/" + srn_no + "/dept_id/" + dept_id;
	                                 }
	                              }
	                           });


	                        }
	                     }

	                  } else {
	                     $("#esbox-error").text('This field is required');
	                     return false;
	                  }

	               }
	            }
	         }
	      }
	   }


	}
</script>
