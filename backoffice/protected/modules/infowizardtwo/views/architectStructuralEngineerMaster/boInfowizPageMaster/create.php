<link href="<?=Yii::app()->theme->baseUrl?>/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />

<?php $baseUrl=Yii::app()->theme->baseUrl;  ?>

<div class="page-content">
  
      <div class="portlet light ">
         <div class="portlet-body">
		 
		
              
              <h1 class="page-title"> Page Master </h1>
			  
             
                 <form  role="form" action="<?php echo Yii::app()->createAbsoluteUrl('infowiz/BoInfowizPageMaster/Create');?>"  method="post" id="submit_form">
              
                 <div class="row">			  
                        
                        <div class="form-group  col-lg-6 col-xs-12">
                           <label class="control-label">Department<sup>*</sup></label>
                           <div class="input-group col-lg-12 col-xs-12">
                                 <select required name="department" class="form-control m-bot15 " id="department">
                                    <option value="">Please Select Department</option>
                                 </select>
                           </div>
                        </div>
						
						<div class="form-group col-lg-6 col-xs-12">
                           <label class="control-label">Service<sup>*</sup></label>
                           <div class="input-group col-lg-12 col-xs-12">
                                 <select required name="service_id" class="form-control m-bot15" >
                                    <option value="">Please Select Service</option>
                                    
                                 </select>
                           </div>
                        </div>
						
					</div>	
                       
                        
                    <div class="row">	
								<div class="form-group col-lg-6 col-xs-12">
								   <label class="control-label">Page Name<sup>*</sup></label>
								   <div class="col-lg-12 col-xs-12">
									  <div class="iconic-input">
									  <input type="text" required name="page_name" maxlength="200" class="form-control" value="" placeholder="Page Name">
										 <span style="color:red;font-size: 14px" class="responseError"></span>
										</div>
								   </div>
								</div>
								
								<div class="form-group  col-lg-6 col-xs-12">
								   <label class="control-label">Status<sup>*</sup></label>
								   <div class="input-group col-lg-12 col-xs-12">
										 <select required name="is_active" class="form-control m-bot15 " >
											<option value="Y">Activate</option>
											<option value="N">Inactivate</option>
										 </select>
								   </div>
								</div>
					</div>
					
					 <div class="row">	
								<div class="form-group col-lg-6 col-xs-12">
								        <label class="control-label">Select Page Preference<sup>*</sup></label>
									   <div class="input-group col-lg-12 col-xs-12">
											 <select required name="is_active" class="form-control m-bot15 " >
												<option value="1">1</option>
												<option value="2">2</option>
												<option value="3">3</option>
												<option value="4">4</option>
												<option value="5">5</option>
												<option value="6">6</option>
												<option value="7">7</option>
												<option value="8">8</option>
												<option value="9">9</option>
												<option value="10">10</option>
											 </select>
									   </div>
								</div>
								
								<div class="form-group  col-lg-6 col-xs-12">&nbsp;</div>
					</div>
					
					
					<div class="row">
					        <div class="modal-footer">
								<button type="reset" class="btn btn-primary" data-dismiss="modal">Cancel</button>
								<input type="submit" class="btn btn-success submit" disabled="disabled" value="submit" name="Submit">
							</div>
					</div>		
			  
			  </form>
			  
		  
			  
         </div>
      </div>
</div>
<script src="<?=Yii::app()->theme->baseUrl?>/assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
<script src="<?=Yii::app()->theme->baseUrl?>/assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="<?=Yii::app()->theme->baseUrl?>/assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
<script src="<?=Yii::app()->theme->baseUrl?>/assets/global/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?=Yii::app()->theme->baseUrl?>/assets/pages/scripts/form-wizard.min.js" type="text/javascript"></script>
<script src="<?=Yii::app()->theme->baseUrl?>/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>

<style>
.page-title{ margin-bottom:20px !important; }

.portlet.light {
    padding: 2px 20px 15px;
    background-color: #fff;
    margin-left: -250px;
    margin-top: -28px;
}

.page-content-white .page-title {
    margin: 2px 0;
    font-size: 24px;

    }
</style>



<script type="text/javascript">
  function ajaxCall(url,data){
     jQuery.ajax({
        url: url,
        type: 'POST',
        dataType: 'json',
        data: data,
        success: function (isTicketReq) {
          // console.log(data.STATUS);
           if(isTicketReq!=''){
              if(isTicketReq.STATUS==200){
                  if(isTicketReq.ticket=='R'){
                    $('.tokenNum').removeAttr("disabled");
                    $('.tokenNum').attr("required", "required");
                  }
                  else if(isTicketReq.ticket=='N'){
                   $('.submit').removeAttr("disabled");
                  }
              }
             else
               $('.responseError').html(isTicketReq.RESPONSE);
           }
        },
        error: function (data) {
           $('.responseError').html("Couldn't get the response. Please try again later");
        }
    });
  }
  function getDepartmentByDistrict(district_id){
  	jQuery.ajax({
        url: '<?=Yii::app()->createAbsoluteUrl('Grievance/grievanceDetail/getDepartmentsForGREV');?>',
        type: 'POST',
        dataType: 'text',
        data: {'district_id':district_id},
        success: function (data) {
          $('#Grievance_department').html(data);
        },
        error: function (data) {
           // $('.responseError').html("Couldn't get the response. Please try again later");
        }
    });
  }
  function isValidTicket(url,data){
     jQuery.ajax({
        url: url,
        type: 'POST',
        dataType: 'json',
        data: data,
        success: function (isValidTicket) {
          console.log(isValidTicket);
          if(isValidTicket!=''){
            if(isValidTicket.STATUS==200){
               hasAlreadySubmitted();
            }
            else{
               $('.responseError').html("Entered Ticket number is not a valid ticket. Please enter again");
               $(".tokenNum").val('');
               $(".tokenNum").focus();
            }
          }
        },
        error: function (data) {
           $('.responseError').html("Couldn't get the response. Please try again later");
        }
     });
  }
  function checkHasAlreadySubmitted(url,data){
    jQuery.ajax({
       url: url,
       type: 'POST',
       dataType: 'json',
       data: data,
       success: function (isAlreadyExist) {
         console.log(isAlreadyExist);
         if(isAlreadyExist!=''){
           if(isAlreadyExist.STATUS==200){
              $('.responseError').html("Grievance already exist in our database.");
             $('.tokenNum').attr("required", "required");
             $('.tokenNum').val("");
              $('.submit').attr("disabled", "disabled");
           }
           else{
              $('.submit').removeAttr("disabled");
              return true;
           }
         }
       },
       error: function (data) {
          $('.responseError').html("Couldn't get the response. Please try again later");
       }
    });
  }
  function hasAlreadySubmitted(){
    var topicId=$(".grv_topic").val();
    var ticket=$(".tokenNum").val();
    var url="<?=Yii::app()->createAbsoluteUrl('Grievance/grievanceDetail/hasAlreadySubmitted');?>";
    var data={"ticket":ticket,"topicId":topicId};
    checkHasAlreadySubmitted(url,data);
  }
  $(".grv_topic").change(function(){
    $('.submit').attr("disabled", "disabled");
    $('.tokenNum').attr("disabled", "disabled");
    $('.responseError').empty();
    var topicId=$(".grv_topic").val();
    if(topicId==1){
      $('.other_subject').show();
      $('.other_subject_input').attr("required", "required");
    }
    else{
      $('.other_subject').hide();
      $('.other_subject_input').removeAttr("required");
    }
    var url="<?=Yii::app()->createAbsoluteUrl('Grievance/grievanceDetail/isTicketRequired');?>";
    var data={"topicId":topicId};
    ajaxCall(url,data);
  })
  $(".tokenNum").blur(function(){
    var ticket=$(".tokenNum").val();
    if(ticket.length==0){
       $('.responseError').html("Please Enter Ticket Number.");
       return false;
    }
    var url="<?=Yii::app()->createAbsoluteUrl('Grievance/grievanceDetail/isValidTicket');?>";
    var data={"ticket":ticket};
    isValidTicket(url,data);
  })
  var FormWizard = function() {
      return {
          init: function() {
              function e(e) {
                  return e.id ? "<img class='flag' src='../../assets/global/img/flags/" + e.id.toLowerCase() + ".png'/>&nbsp;&nbsp;" + e.text : e.text
              }
              if (jQuery().bootstrapWizard) {
                  var r = $("#submit_form"),
                      t = $(".alert-danger", r),
                      i = $(".alert-success", r);
                  r.validate({
                      doNotHideMessage: !0,
                      errorElement: "span",
                      errorClass: "help-block help-block-error",
                      focusInvalid: !1,
                      rules: {
                          'GrievanceRegister[name]':{
                            minlength: 5,
                            required: !0,
                            maxlength: 100,
                            validCompanyName: !0
                          },
                          'GrievanceRegister[token_id]':{
                            digits: !0,
                          },
                          'GrievanceRegister[comapany_name]':{
                            minlength: 5,
                            required: !0,
                            maxlength: 100,
                            validCompanyName: !0
                          },
                          'GrievanceRegister[email_address]':{
                             required: !0,
                              email: !0
                          },
                          'GrievanceRegister[mobile_number]':{
                              required: !0,
                              digits: !0,
                              minlength: 10,
                              maxlength: 10
                          },
                          'GrievanceRegister[address]':{
                             minlength: 10,
                               maxlength: 200,
                              required: !0,
                              validAddress: !0
                          },
                           'GrievanceRegister[zip_code]':{
                              required: !0,
                              digits: !0,
                              minlength: 6,
                              maxlength: 6
                          },
                           'GrievanceRegister[distt]':{
                              required: !0,
                          },
                           'GrievanceRegister[department]':{
                              required: !0,
                            
                          },
                           'GrievanceRegister[subject]':{
                              required: !0,
							  maxlength: 200,
                            
                          },
                           'GrievanceRegister[message]':{
                              required: !0,
                              lettersWithSpaceOnly:!0
                            
                          },
                      },
                      messages: {
                          "payment[]": {
                              required: "Please select at least one option",
                              minlength: jQuery.validator.format("Please select at least one option")
                          }
                      },
                      errorPlacement: function(e, r) {
                          "gender" == r.attr("name") ? e.insertAfter("#form_gender_error") : "payment[]" == r.attr("name") ? e.insertAfter("#form_payment_error") : e.insertAfter(r)
                      },
                      invalidHandler: function(e, r) {
                          i.hide(), t.show(), App.scrollTo(t, -200)
                      },
                      highlight: function(e) {
                          $(e).closest(".form-group").removeClass("has-success").addClass("has-error")
                      },
                      unhighlight: function(e) {
                          $(e).closest(".form-group").removeClass("has-error")
                      },
                      success: function(e) {
                          "gender" == e.attr("for") || "payment[]" == e.attr("for") ? (e.closest(".form-group").removeClass("has-error").addClass("has-success"), e.remove()) : e.addClass("valid").closest(".form-group").removeClass("has-error").addClass("has-success")
                      },
                      submitHandler: function(e) {
                          i.show(), t.hide(), e[0].submit()
                      }
                  });
                  var a = function() {
                          $("#tab4 .form-control-static", r).each(function() {
                              var e = $('[name="' + $(this).attr("data-display") + '"]', r);
                              if (e.is(":radio") && (e = $('[name="' + $(this).attr("data-display") + '"]:checked', r)), e.is(":text") || e.is("textarea")) $(this).html(e.val());
                              else if (e.is("select")) $(this).html(e.find("option:selected").text());
                              else if (e.is(":radio") && e.is(":checked")) $(this).html(e.attr("data-title"));
                              else if ("payment[]" == $(this).attr("data-display")) {
                                  var t = [];
                                  $('[name="payment[]"]:checked', r).each(function() {
                                      t.push($(this).attr("data-title"))
                                  }), $(this).html(t.join("<br>"))
                              }
                          })
                      },
                      o = function(e, r, t) {
                          var i = r.find("li").length,
                              o = t + 1;
                          $(".step-title", $("#form_wizard_1")).text("Step " + (t + 1) + " of " + i), jQuery("li", $("#form_wizard_1")).removeClass("done");
                          for (var n = r.find("li"), s = 0; t > s; s++) jQuery(n[s]).addClass("done");
                          1 == o ? $("#form_wizard_1").find(".button-previous").hide() : $("#form_wizard_1").find(".button-previous").show(), o >= i ? ($("#form_wizard_1").find(".button-next").hide(), $("#form_wizard_1").find(".button-submit").show(), a()) : ($("#form_wizard_1").find(".button-next").show(), $("#form_wizard_1").find(".button-submit").hide()), App.scrollTo($(".page-title"))
                      };
                  $("#form_wizard_1").bootstrapWizard({
                      nextSelector: ".button-next",
                      previousSelector: ".button-previous",
                      onTabClick: function(e, r, t, i) {
                          return !1
                      },
                      onNext: function(e, a, n) {
                          var form_data = $('.caf_form_submission_wizard').serialize();
                          var post_url = $('#caf_form_url').val();

                          var postResult=ajaxPost(post_url,form_data);
                          if(!postResult){
                            $('alert-message-error').html("Couldn't save your data. Please refresh your page before proceed.");
                          }
                          return i.hide(), t.hide(), 0 == r.valid() ? !1 : void o(e, a, n)
                      },
                      onPrevious: function(e, r, a) {
                          i.hide(), t.hide(), o(e, r, a)
                      },
                      onTabShow: function(e, r, t) {
                          var i = r.find("li").length,
                              a = t + 1,
                              o = a / i * 100;
                          $("#form_wizard_1").find(".progress-bar").css({
                              width: o + "%"
                          })
                      }
                  }), $("#form_wizard_1").find(".button-previous").hide(), $("#form_wizard_1 .button-submit").click(function() {
                      // start preloader
                      $( "#finalCAFSubmit" ).submit();
                      // alert("hope you like it :)");
                      
                  }).hide(), $("#country_list", r).change(function() {
                      r.validate().element($(this))
                  })
              }
          }
      }
  }();
  jQuery(document).ready(function() {
      FormWizard.init()
  });
</script>