<?php
 // echo "<pre>"; print_r($_SESSION['RESPONSE']) die("edit"); 
 ?>
<!-- page start-->
<div class="row">
  <aside class="profile-nav col-lg-3">
      <section class="panel">
          <div class="user-heading round">
              <a href="#">
                  <img src="<?php echo Yii::app()->theme->baseUrl;?>/img/person image.jpg" alt="">
              </a>
              <h1><?php echo $_SESSION['RESPONSE']['first_name']." ".$_SESSION['RESPONSE']['last_name'];?></h1>
              <p><?php echo $_SESSION['RESPONSE']['email'];?></p>
          </div>

          <ul class="nav nav-pills nav-stacked">
              <li><a href="<?php echo Yii::app()->createAbsoluteUrl('site/profile');?>"> <i class="fa fa-user"></i> Profile</a></li>
              <li class="active"><a href="<?php echo Yii::app()->createAbsoluteUrl('site/editprofile');?>"> <i class="fa fa-edit"></i> Edit</a></li>
          </ul>

      </section>
  </aside>
    <aside class="profile-info col-lg-9">
        <section class="panel">
            <div class="panel-heading" style="background:#41CAC0;color:#FFF">
                <h3 class="text-left"><strong><?php echo $_SESSION['RESPONSE']['first_name']." ".$_SESSION['RESPONSE']['last_name'];?>'<sup>s</sup> Profile &hellip;</strong></h3>
            </div>
            <div class="panel-body bio-graph-info">
                <h1> Profile Info</h1>
                <form id="edit_profile" class="form-horizontal" role="form">
                    <!--div class="form-group">
                        <label  class="col-lg-2 control-label">About Me</label>
                        <div class="col-lg-10">
                            <textarea name="" id="" class="form-control" cols="30" rows="10"></textarea>
                        </div>
                    </div--><!--?php $_SESSION['RESPONSE']=""; ?-->
                    <div class="form-group">
                        <label  class="col-lg-2 control-label">First Name</label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" id="first_name" placeholder="First Name" name="first_name" value="<?php if(isset($_SESSION['RESPONSE'])) echo ""; else echo "";?>" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label  class="col-lg-2 control-label">Last Name</label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" id="last-name" placeholder="Last Name" name="last_name" value="<?php if(isset($_SESSION['RESPONSE'])) echo ""; else echo "";?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label  class="col-lg-2 control-label">Mobile</label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" id="mobile" placeholder="Mobile Number" name="mob_number" value="<?php if(isset($_SESSION['RESPONSE'])) echo ""; else echo "";?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label  class="col-lg-2 control-label">PAN Card</label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" id="c-name" placeholder="PAN Card" name="pan_card" value="<?php if(isset($_SESSION['RESPONSE'])) echo ""; else echo "";?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label  class="col-lg-2 control-label">AADHAR Card</label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" id="c-name" placeholder="AADHAR Card" name="aadhar_card" value="<?php if(isset($_SESSION['RESPONSE'])) echo ""; else echo "";?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label  class="col-lg-2 control-label">City</label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" id="mobile" placeholder="City" name="city" value="<?php if(isset($_SESSION['RESPONSE'])) echo ""; else echo "";?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label  class="col-lg-2 control-label">Pin Code</label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" id="mobile" placeholder="Pin Code" name="pin_code" value="<?php if(isset($_SESSION['RESPONSE'])) echo ""; else echo "";?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-offset-2 col-lg-10">
                            <button type="submit" class="btn btn-success">Save</button>
                            <button type="button" class="btn btn-default">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </section>
        <section>
            <div class="panel panel-primary">
                <div class="panel-heading"> Sets New Password & Avatar</div>
                <div class="panel-body">
                    <form id="change_pass" class="form-horizontal" role="form">
                        <div class="form-group">
                            <label  class="col-lg-2 control-label">Current Password</label>
                            <div class="col-lg-6">
                                <input type="password" class="form-control" id="current_pwd" name="current_pwd" placeholder="Current Password">
                            </div>
                        </div>
                        <div class="form-group">
                            <label  class="col-lg-2 control-label">New Password</label>
                            <div class="col-lg-6">
                                <input type="password" class="form-control" id="new_pwd" name="new_pwd" placeholder="New Password">
                            </div>
                        </div>
                        <div class="form-group">
                            <label  class="col-lg-2 control-label">Re-type New Password</label>
                            <div class="col-lg-6">
                                <input type="password" class="form-control" id="rep_pwd" name="rep_pwd" placeholder="Repeat Password">
                            </div>
                        </div>

                        <!--div class="form-group">
                            <label  class="col-lg-2 control-label">Change Avatar</label>
                            <div class="col-lg-6">
                                <input type="file" class="file-pos" id="exampleInputFile">
                            </div>
                        </div-->

                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-10">
                                <button type="submit" class="btn btn-info">Save</button>
                                <button type="button" class="btn btn-default">Cancel</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </aside>
</div>
<!-- page end-->
<script type="text/javascript">
$(document).ready(function(){
    $("#edit_profile").validate({
            rules: {     
                "first_name": {required: true,lettersonly:true,nowhitespace:true},
                "last_name": {required: true,lettersonly:true,nowhitespace:true},
                "mob_number": {required: true,digits: true,nowhitespace:true},
                "pan_card": {required: true,alphanumeric:true,nowhitespace:true},
                "aadhar_card": {required: true,alphanumeric:true,nowhitespace:true},
                "city": {required: true,lettersonly:true,},
                "pin_code": {required: true,digits: true},
                "current_pwd": {required: true},
                "new_pwd": {required: true,minlength: 8,stronpassword:true},
                "rep_pwd": {required: true,minlength: 8,equalTo: "#new_pwd"},                
            },
            messages: {
                example5: "Just check the box<h5 class='text-error'>You aren't going to read the EULA</h5>"
            },
            tooltip_options: {
                fname: {trigger:'focus'},
                '_all_': {placement:'top',html:true}
            },
            invalidHandler: function(form, validator) {
                $("#validity_label").html('<div class="row"><div class="alert alert-error">There be '+validator.numberOfInvalids()+' error'+(validator.numberOfInvalids()>1?'s':'')+' here.  OH NOES!!!!!</div></div>');
            }
        });
    $("#change_pass").validate({
            rules: {     
                "current_pwd": {required: true},
                "new_pwd": {required: true,minlength: 8,stronpassword:true},
                "rep_pwd": {required: true,minlength: 8,equalTo: "#new_pwd"},                
            },
            messages: {
                example5: "Just check the box<h5 class='text-error'>You aren't going to read the EULA</h5>"
            },
            tooltip_options: {
                fname: {trigger:'focus'},
                '_all_': {placement:'top',html:true}
            },
            invalidHandler: function(form, validator) {
                $("#validity_label").html('<div class="row"><div class="alert alert-error">There be '+validator.numberOfInvalids()+' error'+(validator.numberOfInvalids()>1?'s':'')+' here.  OH NOES!!!!!</div></div>');
            }
        });

});
</script>