<div class="dashboard-conetnt">
   <div class="dashboard-home">
      <div class="applied-status">
         <ul class="breadcrumb">
            <li><a href="/backoffice/investor/home/investorWalkthrough">Home</a></li>
            <li>Signatory Details</li>
         </ul>
      </div>
        <?php

        if(in_array($sid, ['30.0','26.0','32.0','40.0','41.0','42.0','43.0','44.0','39.0','19.0','29.0','20.0','25.0','45.0','28.0','27.0']) ) {
           $file = '_signaory_filled_detail';
        } 
        else {
           $file = '_signaory_detail';
        }
      ?>
      <?=$this->renderPartial('signatory/'.$file,array(
           'srn_no' => $srn_no,
           'service_srn' => $service_srn,
           'service' => $service,
           'dept_id'=>$dept_id,
           'sid'=>$sid
      ));
      ?> 
      
   </div>
</div>
<script type = "text/javascript" >
   $(document).ready(function () {
      $("input[name=middlenamecheckbox]").change(function () {
         if ($(this).val()) {
            $("#middle_name").val("");
         }
      });
      $('#first_name,#middle_name,#last_name').keyup(function () {
         $(this).val($(this).val().toUpperCase());
      });
      $('#middlenamecheckbox').change(function () {

         if ($("#middlenamecheckbox").prop('checked') == true) {
            $("#middle_name").prop('readonly', true);
         } else {
            $("#middle_name").prop('readonly', false);
         }
      });
   });



function detelerow(id) {
   if (confirm('Are you sure to delete this record?')) {
      var dept_id = "<?= $dept_id ?>";
      var srn_no = $("#srn_no").val();
      $.ajax({
         type: "POST",
         dataType: 'json',
         url: "/backoffice/investor/services/deleteSignature",
         data: {
            id: id
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

function contipay(srn_no) {
   var totalRowCount = $("#tbl_sig td").closest("tr").length;
   if (totalRowCount > 0) {
      var noofsig = $("#nosig").val();
      if (noofsig == totalRowCount) {
         var service_id = $("#service_id").val();
         var dept_id = "<?= $dept_id ?>";
         $.ajax({
            type: "POST",
            dataType: 'json',
            url: "/backoffice/investor/services/submitsignature",
            data: {
               srn_no: $("#srn_no").val(),
               service_id: service_id,
               dept_id: dept_id
            },

            success: function (result) {
               var srn_no = "<?= base64_encode($srn_no) ?>";
               window.location.href = "/backoffice/investor/services/payment/srn_no/" + srn_no;
            }
         });
      } else {
         $("#rr_error").text("Please add details of the Signatory Details as per the number entered in this field 'No. of signatory'");
      }
   } else {
      $("#rr_error").text("Please insert atleast one signatory detail");
   }

}

function contiapply(srn_no) {
   var totalRowCount = $("#tbl_sig td").closest("tr").length;
   if (totalRowCount > 0) {
      var noofsig = $("#nosig").val();
      if (noofsig == totalRowCount) {
         var service_id = $("#service_id").val();
         var dept_id = "<?= $dept_id ?>";
         $.ajax({
            type: "POST",
            dataType: 'json',
            url: "/backoffice/investor/services/submitsignaturewp",
            data: {
               srn_no: $("#srn_no").val(),
               service_id: service_id,
               dept_id: dept_id
            },

            success: function (result) {
               window.location.href = "/backoffice/investor/home/investorWalkthrough";
            }
         });
      } else {
         $("#rr_error").text("Please add details of the Signatory Details as per the number entered in this field 'No. of signatory'");
      }
   } else {
      $("#rr_error").text("Please insert atleast one signatory detail");
   }

}


</script>
<script src="/backoffice/themes/swcsNewTheme/fb/vendors/base/vendors.bundle.js" type="text/javascript"></script>
<script src="/backoffice/themes/swcsNewTheme/fb/demo/default/base/scripts.bundle.js" type="text/javascript"></script>
<script src="/backoffice/themes/swcsNewTheme/fb/demo/default/custom/components/forms/wizard/onboard_serviceprovider.js" type="text/javascript"></script>
<script src="<?= Yii::app()->theme->baseUrl ?>/assets/global/plugins/jquery-repeater/jquery.repeater.js" type="text/javascript"></script>
<script src="<?= Yii::app()->theme->baseUrl ?>/assets/pages/scripts/form-repeater.min.js" type="text/javascript"></script>
<!-- form repeater js -->
<link rel="stylesheet" href="<?= Yii::app()->theme->baseUrl ?>/assets/frontend/dashboard/css/plugins/select2/select2.css">
<!-- select2 -->
<script src="<?= Yii::app()->theme->baseUrl ?>/assets/frontend/dashboard/js/plugins/select2/select2.min.js"></script>
<!-- Theme framework -->
<script src="<?= Yii::app()->theme->baseUrl ?>/assets/frontend/dashboard/js/eakroko.min.js"></script>