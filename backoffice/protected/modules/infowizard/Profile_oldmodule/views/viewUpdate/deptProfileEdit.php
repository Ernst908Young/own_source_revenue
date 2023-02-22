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
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="index.html">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>User</span>
        </li>
    </ul>
</div>
    <small>&nbsp;</small>
</h1>
<div class="profile">
    <div class="row">
        <div class="col-md-3">
            <ul class="list-unstyled profile-nav">
                <li>
                    <img src="<?=Yii::app()->theme->baseUrl?>/assets/pages/media/profile/default-user.png" class="img-responsive pic-bordered" alt="" />
                </li>
                <li class="active">
                    <a href="<?=Yii::app()->createAbsoluteUrl('Profile/ViewUpdate')?>"> Profile </a>
                </li>
                <li>
                    <a href="<?=Yii::app()->createAbsoluteUrl('Profile/ViewUpdate/editProfile')?>"> Edit
                    </a>
                </li>
            </ul>
        </div>
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-8 profile-info">
                     <h1 class="font-green sbold uppercase"><?=@$model['full_name'];?></h1>
                    <p><i class="fa fa-envelope"></i> <?=@$model['email']?></p>
                </div>
                <!--end col-md-8-->
            </div>
            <!--end row-->
           <div class="portlet box green">
               <div class="portlet-title">
                   <div class="caption">
                       <i class="fa fa-user-secret" style="font-size: 27px;"></i>Profile</div>
                   <div class="tools">
                       <a href="javascript:;" class="collapse"> </a>
                       <a href="javascript:;" class="remove"> </a>
                   </div>
               </div>
               <div class="portlet-body form">
                   <!-- BEGIN FORM-->
                   <form class="form-horizontal" role="form" method="POST" id="profile" action="<?=Yii::app()->createAbsoluteUrl('Profile/ViewUpdate/editProfile');?>">
                       <div class="form-body">
                          <div class="alert alert-danger display-hide">
                              <button class="close" data-close="alert"></button> You have some form errors. Please check below. </div>
                          <div class="alert alert-success display-hide">
                              <button class="close" data-close="alert"></button> Your form validation is successful! </div>
                           <h2 class="margin-bottom-20"> View User Info </h2>
                           <h3 class="form-section">Person Info</h3>
                           <div class="row">
                               <div class="col-md-6">
                                   <div class="form-group">
                                       <label class="control-label col-md-3">Full Name:</label>
                                       <div class="col-md-9">
                                           <input type="hidden" class="form-control" id="user_id"  readonly name="Profile[uid]" placeholder="<?php echo $model['uid'];?>" value="<?php echo $model['uid'];?>" >
                                           <input type="text" class="form-control" id="first_name"  name="Profile[full_name]" placeholder="<?=$model['full_name'];?>" value="<?=$model['full_name'];?>" >
                                           <span class="help-block"></span>
                                       </div>
                                   </div>
                               </div>
                               <!--/span-->
                               <div class="col-md-6">
                                   <div class="form-group">
                                       <label class="control-label col-md-3">Mobile Number:</label>
                                       <div class="col-md-9">
                                          <input type="text" class="form-control" id="mobile"  name="Profile[mobile]" placeholder="<?php echo $model['mobile'];?>" value="<?php echo $model['mobile'];?>" >
                                          <span class="help-block"></span>
                                       </div>
                                   </div>
                               </div>
                               <!--/span-->
                           </div>
                           <div class = "row">
                               <div class="col-md-6">
                                   <div class="form-group">
                                       <label class="control-label col-md-3">Delegate Officer Name:</label>
                                       <div class="col-md-9">
                                          <input type="text" class="form-control" id="mobile"  name="Profile[delegate_officer_name]" placeholder="<?php echo $model['delegate_officer_name'];?>" value="<?php echo $model['delegate_officer_name'];?>" >
                                          <span class="help-block"></span>
                                       </div>
                                   </div>
                               </div>
 
                               <div class="col-md-6">
                                   <div class="form-group">
                                       <label class="control-label col-md-3">Delegate Officer Mobile Number:</label>
                                       <div class="col-md-9">
                                          <input type="text" class="form-control" id="mobile"  name="Profile[delegate_officer_number]" placeholder="<?php echo $model['delegate_officer_number'];?>" value="<?php echo $model['delegate_officer_number'];?>" >
                                          <span class="help-block"></span>
                                       </div>
                                   </div>
                               </div>
                           </div>
                           <div class = "row">
                               <div class="col-md-6">
                                   <div class="form-group">
                                       <label class="control-label col-md-3">Delegate Officer Email:</label>
                                       <div class="col-md-9">
                                          <input type="text" class="form-control" id="mobile"  name="Profile[delegate_officer_email]" placeholder="<?php echo $model['delegate_officer_email'];?>" value="<?php echo $model['delegate_officer_email'];?>" >
                                          <span class="help-block"></span>
                                       </div>
                                   </div>
                               </div>
                               </div>
                           
                           <!--/row-->
                       </div>
                       <div class="form-actions">
                         <div class="row">
                           <div class="col-md-6">
                             <div class="row">
                               <div class="col-md-offset-3 col-md-9">
                                 <button type="submit" class="btn green">Submit</button>
                                 <button type="button" class="btn default">Cancel</button>
                               </div>
                             </div>
                           </div>
                           <div class="col-md-6"> </div>
                         </div>
                       </div>
                   </form>
                   <!-- END FORM-->
               </div>
           </div>
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-user-secret" style="font-size: 27px;"></i>Change Password</div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse"> </a>
                        <a href="javascript:;" class="remove"> </a>
                    </div>
                </div>
                <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                    <form class="form-horizontal" role="form" method="POST" id="passwordUpdate" action="<?=Yii::app()->createAbsoluteUrl('Profile/ViewUpdate/updatePassword');?>">
                        <div class="form-body">
                           <div class="alert alert-danger display-hide">
                               <button class="close" data-close="alert"></button> You have some form errors. Please check below. </div>
                           <div class="alert alert-success display-hide">
                               <button class="close" data-close="alert"></button> Your form validation is successful! </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Current Password:</label>
                                        <div class="col-md-9">
                                           <input type="password" class="form-control" id="current_pwd" name="Password[current_pwd]" placeholder="Current Password">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                            <!--/row-->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">New Password:</label>
                                        <div class="col-md-9">
                                             <input type="hidden" class="form-control" id="uid"  readonly name="Password[uid]" placeholder="<?php echo $model['uid'];?>" value="<?php echo $model['uid'];?>" >
                                             <input type="password" class="form-control" id="new_pwd" name="Password[new_pwd]" placeholder="New Password">
                                              
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Confirm Password</label>
                                        <div class="col-md-9">
                                            <input type="password" class="form-control" id="rep_pwd" name="Password[rep_pwd]" placeholder="Repeat Password">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                            <!--/row-->
                        </div>
                        <div class="form-actions">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                  <button type="submit" class="btn green">Submit</button>
                                  <button type="button" class="btn default">Cancel</button>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-6"> </div>
                          </div>
                        </div>
                    </form>
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
          "Profile[full_name]": {
              minlength: 5,
              required: !0,
              maxlength: 50,
              lettersWithSpaceOnly: !0
          },
          "Profile[mobile]": {
              required: !0,
              digits: !0,
              minlength: 10,
              maxlength: 10
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