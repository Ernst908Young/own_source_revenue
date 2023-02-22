<link href="<?=Yii::app()->theme->baseUrl?>/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
<link href="<?=Yii::app()->theme->baseUrl?>/assets/pages/css/profile-2.min.css" rel="stylesheet" type="text/css" />
<style type="text/css">
    @media (min-width: 750px){
        .pic-bordered {
        width: 278px;
        height: 263px;
        }
    }
</style>

    <small>&nbsp;</small>
</h1>
<div class="profile">
    <div class="row">
        
        <div class="col-md-12">            
           <div class="portlet box green">
               <div class="portlet-title">
                   <div class="caption">
                       <i class="fa fa-user-secret" style="font-size: 27px;"></i>Switch Account</div>
                   <div class="tools">
                       <a href="javascript:;" class="collapse"> </a>
                       <a href="javascript:;" class="remove"> </a>
                   </div>
               </div>
               <div class="portlet-body form">
                   <!-- BEGIN FORM-->
                      <div class="form-body">                          
                           <div class="row">						   
							<table class="table table-bordered table-hover movetoDashboardold">
								<thead>
									<tr>
										<th style="width: 25%;">Role</th>
										<th class="text-center">Email</th>
										<th class="text-center">Phone Number</th>
										<th class="text-center">Switch Account</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach($roleData as $key => $role){ ?>
									<tr class="QUERIES">
										<td> <?php echo $role['role_name'] ;?></td>
										<td class="text-left"><?php echo $role['email'] ;?></td>
										<td class="text-left"><?php echo ($role['mobile']=='')?$role['mobile_old']:$role['mobile'] ;?></td>
										<td class="text-left">
											<?php 
												$emailcode = base64_encode($role['email']) ;
												echo CHtml::link('Login',"../../site/login/logincode/$emailcode", array('target'=>'_blank')); 
											?>
										</td>
									</tr>
									<?php } ?>
								</tbody>
							</table>						   
							</div>
					   </div>                       
                   
                   <!-- END FORM-->
               </div>
           </div>
		   
            
			
			
        </div>
    </div>
</div>
<script src="<?=Yii::app()->theme->baseUrl?>/assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="<?=Yii::app()->theme->baseUrl?>/assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
<script type="text/javascript">
  $('document').ready(function(){
    var e = $("#profile"),
        f=$("#passwordUpdate"),
         r = $(".alert-danger", e),
         i = $(".alert-success", e);
     e.validate({
         doNotHideMessage: !0,
         errorElement: "span",
         errorClass: "help-block help-block-error",
         focusInvalid: !1,
         rules: {
          "Profile[first_name]": {
              minlength: 5,
              required: !0,
              maxlength: 50,
              lettersWithSpaceOnly: !0
          },"Profile[last_name]": {
              minlength: 5,
              required: !0,
              maxlength: 50,
              lettersWithSpaceOnly: !0
          },"Profile[address]": {
               minlength: 10,
               maxlength: 200,
              required: !0,
              validAddress: !0
          },"Profile[pin_code]":{
              required: !0,
              digits: !0,
              minlength: 6,
              maxlength: 6

          },
          "Profile[mob_number]": {
              required: !0,
              digits: !0,
              minlength: 10,
              maxlength: 10
          },
          "Profile[city]":{
            minlength: 5,
              required: !0,
              maxlength: 50,
              lettersWithSpaceOnly: !0
          },
             "Profile[pan_card]": {
                 minlength: 10,
                 maxlength:10,
                 required: !0,
                 alphanumeric:!0,
                 nowhitespace:!0
             },
             "Profile[email]": {
                 required: !0,
                 email: !0
             },
             "Profile[aadhar_card]": {
                 required: !0,
                 number: !0,
                 minlength:12,
                 maxlength:12,
             },
             "Password[new_pwd]": {
                 minlength: 8,
                 required: !0
             },

             "Password[rep_pwd]": {
                 minlength: 5,
                 required: !0,
                 equalTo: "#new_pwd"
             },
             digits: {
                 required: !0,
                 digits: !0
             },
             creditcard: {
                 required: !0,
                 creditcard: !0
             }
         },
         invalidHandler: function(e, t) {
             i.hide(), r.show(), App.scrollTo(r, -200)
         },
         errorPlacement: function(e, r) {
             var i = $(r).parent(".input-icon").children("i");
             i.removeClass("fa-check").addClass("fa-warning"), i.attr("data-original-title", e.text()).tooltip({
                 container: "body"
             })
         },
         highlight: function(e) {
             $(e).closest(".form-group").removeClass("has-success").addClass("has-error")
         },
         unhighlight: function(e) {},
         success: function(e, r) {
             var i = $(r).parent(".input-icon").children("i");
             $(r).closest(".form-group").removeClass("has-error").addClass("has-success"), i.removeClass("fa-warning").addClass("fa-check")
         },
         submitHandler: function(e) {
             i.show(), r.hide(), e[0].submit()
         }
     }),
     f.validate({
         doNotHideMessage: !0,
         errorElement: "span",
         errorClass: "help-block help-block-error",
         focusInvalid: !1,
         rules: {
             "Password[new_pwd]": {
                 minlength: 8,
                 required: !0
             },

             "Password[rep_pwd]": {
                 minlength: 5,
                 required: !0,
                 equalTo: "#new_pwd"
             },
             digits: {
                 required: !0,
                 digits: !0
             },
             creditcard: {
                 required: !0,
                 creditcard: !0
             }
         },
         invalidHandler: function(e, t) {
             i.hide(), r.show(), App.scrollTo(r, -200)
         },
         errorPlacement: function(e, r) {
             var i = $(r).parent(".input-icon").children("i");
             i.removeClass("fa-check").addClass("fa-warning"), i.attr("data-original-title", e.text()).tooltip({
                 container: "body"
             })
         },
         highlight: function(e) {
             $(e).closest(".form-group").removeClass("has-success").addClass("has-error")
         },
         unhighlight: function(e) {},
         success: function(e, r) {
             var i = $(r).parent(".input-icon").children("i");
             $(r).closest(".form-group").removeClass("has-error").addClass("has-success"), i.removeClass("fa-warning").addClass("fa-check")
         },
         submitHandler: function(e) {
             i.show(), r.hide(), e[0].submit()
         }
     })

  })
</script>