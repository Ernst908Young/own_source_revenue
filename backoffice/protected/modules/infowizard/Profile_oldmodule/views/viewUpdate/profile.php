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
                    <h1 class="font-green sbold uppercase"><?=@$_SESSION['RESPONSE']['first_name']." ".@$_SESSION['RESPONSE']['last_name']?></h1>
                    <p><i class="fa fa-envelope"></i> <?=@$_SESSION['RESPONSE']['email']?></p>
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
                   <form class="form-horizontal" role="form">
                       <div class="form-body">
                           <h2 class="margin-bottom-20"> View User Info </h2>
                           <h3 class="form-section">Person Info</h3>
                           <div class="row">
                               <div class="col-md-6">
                                   <div class="form-group">
                                       <label class="control-label col-md-3">First Name:</label>
                                       <div class="col-md-9">
                                           <p class="form-control-static"> <?=@$_SESSION['RESPONSE']['first_name']?>  </p>
                                       </div>
                                   </div>
                               </div>
                               <!--/span-->
                               <div class="col-md-6">
                                   <div class="form-group">
                                       <label class="control-label col-md-3">Last Name:</label>
                                       <div class="col-md-9">
                                           <p class="form-control-static"> <?=@$_SESSION['RESPONSE']['last_name']?> </p>
                                       </div>
                                   </div>
                               </div>
                               <!--/span-->
                           </div>
                           <!--/row-->
                           <div class="row">
                               <div class="col-md-6">
                                   <div class="form-group">
                                       <label class="control-label col-md-3">IUID:</label>
                                       <div class="col-md-9">
                                           <p class="form-control-static"> <?=@$_SESSION['RESPONSE']['iuid']?> </p>
                                       </div>
                                   </div>
                               </div>
                               <!--/span-->
                               <div class="col-md-6">
                                   <div class="form-group">
                                       <label class="control-label col-md-3">Email</label>
                                       <div class="col-md-9">
                                           <p class="form-control-static"> <?=@$_SESSION['RESPONSE']['email']?> </p>
                                       </div>
                                   </div>
                               </div>
                               <!--/span-->
                           </div>
                           <!--/row-->
                           <div class="row">
                               <div class="col-md-6">
                                   <div class="form-group">
                                       <label class="control-label col-md-3">PAN Card:</label>
                                       <div class="col-md-9">
                                           <p class="form-control-static"> <?=@$_SESSION['RESPONSE']['pan_card']?> </p>
                                       </div>
                                   </div>
                               </div>
                               <!--/span-->
                               <div class="col-md-6">
                                   <div class="form-group">
                                       <label class="control-label col-md-3">Aadhar:</label>
                                       <div class="col-md-9">
                                           <p class="form-control-static"> <?=@$_SESSION['RESPONSE']['adhaar_number']?> </p>
                                       </div>
                                   </div>
                               </div>
                               <!--/span-->
                           </div>
                           <!--/row-->
                           <h3 class="form-section">Address</h3>
                           <div class="row">
                               <div class="col-md-6">
                                   <div class="form-group">
                                       <label class="control-label col-md-3">Address:</label>
                                       <div class="col-md-9">
                                           <p class="form-control-static"> <?=@$_SESSION['RESPONSE']['address']?> </p>
                                       </div>
                                   </div>
                               </div>
                               <!--/span-->
                               <div class="col-md-6">
                                   <div class="form-group">
                                       <label class="control-label col-md-3">City:</label>
                                       <div class="col-md-9">
                                           <p class="form-control-static"> <?=@$_SESSION['RESPONSE']['city_name']?>  </p>
                                       </div>
                                   </div>
                               </div>
                               <!--/span-->
                           </div>
                           <!--/row-->
                           <div class="row">
                               <div class="col-md-6">
                                   <div class="form-group">
                                       <label class="control-label col-md-3">Mobile:</label>
                                       <div class="col-md-9">
                                           <p class="form-control-static"> <?=@$_SESSION['RESPONSE']['mobile_number']?></p>
                                       </div>
                                   </div>
                               </div>
                               <!--/span-->
                               <div class="col-md-6">
                                   <div class="form-group">
                                       <label class="control-label col-md-3">Post Code:</label>
                                       <div class="col-md-9">
                                           <p class="form-control-static">  <?=@$_SESSION['RESPONSE']['pin_code']?> </p>
                                       </div>
                                   </div>
                               </div>
                               <!--/span-->
                           </div>
                       </div>
                   </form>
                   <!-- END FORM-->
               </div>
           </div>
        </div>
    </div>
</div>