<title>Manage Users</title>
<style>
.form-part .form-group > div.services {
    max-width: 100%;
    margin-bottom: 44px;
}
#div_error{text-align:center;}
.flash-Error{color:red;}
.active-lnk{color:blue;}
ul.dashboard-menu > li a {
    padding: 0 15px 0 60px;
}
input:disabled, input[readonly] {
    background-color: #e9ecef;
    opacity: 1;
}
.modal-header{
	display:block;
}
@media (min-width: 768px) {
.modal-content{
	width:700px;
	
}
}
.blue-lnk{
	border: none;
    color: blue;
    background: transparent;
}
ul.pagination li {
    float: left;
}
</style>
<div class="dashboard-home">
	<div class="applied-status">
		<div class="status-title d-flex flex-wrap align-items-center justify-content-between">
		    
		</div>
	</div>
</div>
	<div style="text-align:center;font-size:16px;color:green;">
<?php
	foreach(Yii::app()->user->getFlashes() as $key => $message) {
		echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
	}
?>
</div>
<div id="div_error"></div>
<div class="m-wizard__form reservation-form" style="padding: 17px 33px 0px;">
<div class="m-wizard__form-step m-wizard__form-step--current" id="m_wizard_form_step_1">
<form id="adduser-form" method="post" data-toggle="validator" action="<?php echo Yii::app()->createAbsoluteUrl('admin/default/adduser')?>" enctype="multipart/form-data" >
<div class="form-part bussiness-det">
<?php

		
	
		
	/*	$sql1="SELECT 
		tbl_user_service_role.id,tbl_user_service_role.Approver,tbl_user_service_role.Verifier,bo_information_wizard_service_parameters.core_service_name,bo_user.full_name from tbl_user_service_role left join bo_user on tbl_user_service_role.user_id=bo_user.uid left join bo_information_wizard_service_parameters on tbl_user_service_role.service_id=bo_information_wizard_service_parameters.service_id
		where  
		bo_information_wizard_service_parameters.is_active='Y'";
		$connection=Yii::app()->db; 
		$command1=$connection->createCommand($sql1);
		$res = $command1->queryAll();*/
		?>

				 	<div>								<h4 class="form-heading">
							Add User						</h4>
					</div>
					<hr id="hr_UK-FCL-00150_0" style="height: 0px; margin: 0px;">
					<div class="form-row row">
			

				<div class="form-group col-md-6" >
					
					<label class="col-md-12 control-label text-left" >
						 First Name	<span style="color:red;">* </span>	</label>

					<div class="col-md-12">
					<input type="text" name="full_name" id="full_name" value="">
					</div>
				</div>
				
				<div class="form-group col-md-6" >
					
					<label class="col-md-12 control-label text-left" >
						 Middle Name <span style="color:red;">* </span>	</label>

					<div class="col-md-12">
					<input type="text" name="middle_name" id="middle_name" value="">
					<input type="checkbox" id="mnamechekbox" name="middlenamecheckbox">
					<label for="middlenamecheckbox"> I don't have middle name</label><br>
						<span style="color:red" id="middlenameerror"></span>
					</div>
				</div>
			
	
	
				

				
				<div class="form-group col-md-6" >
					
					<label class="col-md-12 control-label text-left" >
						 Last Name	<span style="color:red;">* </span>	</label>

					<div class="col-md-12">
					<input type="text" name="last_name" id="last_name" value="">
					</div>
				</div>
				<div class="form-group col-md-6" >
					
					<label class="col-md-12 control-label text-left" >
						 Email<span style="color:red;">* </span></label>

					<div class="col-md-12">
					<input type="text" name="email" id="email" value="">
					</div>
				</div>
				<div class="form-group col-md-6" >
					
					<label class="col-md-12 control-label text-left" >
						 Password <span style="color:red;">* </span>	</label>

					<div class="col-md-12">
					<input type="password" name="password" id="password1" value="">
					</div>
				</div>
				<div class="form-group col-md-6" >
					
					<label class="col-md-12 control-label text-left" >
						 Confirm Password <span style="color:red;">* </span>	</label>

					<div class="col-md-12">
					<input type="password" name="cpassword" id="cpassword" value="">
					</div>
				</div>
				<div class="form-group col-md-6" >
					
					<label class="col-md-12 control-label text-left" >
						 Mobile </label>

					<div class="col-md-12">
					<input type="text" name="mobile" id="mobile" value="">
					</div>
				</div>
				
				<div class="form-group col-md-6" >
					
					<label class="col-md-12 control-label text-left" >
						 Fax </label>

					<div class="col-md-12">
					<input type="text" name="fax" id="fax" value="">
					</div>
				</div>
				<div class="form-group col-md-6" >
					
					<label class="col-md-12 control-label text-left" >
						 Delegate Officer No	</label>

					<div class="col-md-12">
					<input type="text" name="delegate_officer_number" id="delegate_officer_number" value="">
					</div>
				</div>
				<div class="form-group col-md-6" >
					
					<label class="col-md-12 control-label text-left" >
						 Delegate Officer Name	</label>

					<div class="col-md-12">
					<input type="text" name="delegate_officer_name" id="delegate_officer_name" value="">
					</div>
				</div>
					<div class="form-group col-md-6" >
					
					<label class="col-md-12 control-label text-left" >
						 Delegate Officer Email	</label>

					<div class="col-md-12">
					<input type="text" name="delegate_officer_email" id="delegate_officer_email" value="">
					</div>
				</div>
				<div class="form-group col-md-6" >
					
					<label class="col-md-12 control-label text-left" >
						 Office Number	</label>

					<div class="col-md-12">
					<input type="text" name="office_no" id="office_no" value="">
					</div>
				</div>
				

				<div class="form-group col-md-6">
					
					<label class="col-md-12 control-label text-left" >
						 Active<span style="color:red;">* </span>	</label>

					<div class="col-md-12">
						<input type="radio" name="is_active" value="1" checked> <span>Yes</span> &nbsp; <input type="radio" name="is_active" value="0"> <span>No</span>
					</div>
				</div>
				
				<!--<div class="form-group col-md-6">
					
					<label class="col-md-12 control-label text-left" >
						 System User<span style="color:red;">* </span>	</label>

					<div class="col-md-12">
						<input type="radio" name="system_user" id="system_user" value="Y" > <span>Yes</span> &nbsp; <input type="radio" name="system_user" id="system_user" 
						value="N" checked> <span>No</span>
					</div>
				</div>
-->
			

				
			
				<div class="col-md-12 mb-3">
					  <input type="button" class="btn btn-primary " value="Add User" name="add_user" id="add_user_btn">
					
				</div>
			</div>
</div>
</form>




              </div>
			  
			  
<?php
$sql = "select * from bo_user where system_user<>'Y'";
		$res = Yii::app()->db->createCommand($sql)->queryAll();?>
<div class="row">
		<div class="col-md-12">
		   <!-- BEGIN EXAMPLE TABLE PORTLET-->
		   <div class="portlet box green">
			  <div class="portlet-title">
				 <div class="caption">
					<i style="font-size:24px" class="icon-list"></i>
					<span class="caption-subject bold uppercase">Users List </span>
				 </div>
				 <div class="tools"> 
					<a href="javascript:;" class="collapse"> </a>
				 </div>
			  </div>
			  <div class="portlet-body">
				<table class='table table-striped table-bordered table-hover order-column' id='sample_1'>
				   <thead>
					   <tr>
						   <th>ID</th>
						   <th>First Name</th>
						   <th>Middle Name</th>
						   <th>Last Name</th>
						   <th>Email</th>
						   <th>Mobile</th>
						   <th>Status</th>
						   <th>Action</th>
					   </tr>
				   </thead>
				   <tbody>
				 <?php 				
				if(empty($res)) {
					echo "<hr><h4>No Users Found!</hr></h4>";	
				}
				if(count($res)>0){
					for($i=0;$i<count($res);$i++){
						?>
						<tr>
						   <td><?php echo $res[$i]['uid'];?></td>
						   <td><?php echo $res[$i]['full_name'];?></td>
						   <td><?php echo $res[$i]['middle_name'];?></td>
						   <td><?php echo $res[$i]['last_name'];?></td>
						   <td><?php echo $res[$i]['email'];?></td>
						   <td><?php echo $res[$i]['mobile'];?></td>
						   <td><?php  if($res[$i]['system_user']=='N'){ if($res[$i]['is_active']==1) echo "<a href='/backoffice/admin/default/userstatus/?status=deactive&uid=".$res[$i]['uid']."'  class='active-lnk'>Active</a>"; else echo "<a href='/backoffice/admin/default/userstatus/?status=active&uid=".$res[$i]['uid']."' class='active-lnk'>Deactive</a>";} else echo 'Active';?></td>
						  <td>
						 <?php  if($res[$i]['system_user']=='N'){?> <a href='/backoffice/admin/default/edituser/?uid=<?php echo base64_encode($res[$i]['uid']);?>' class='active-lnk'><button type="button" data-toggle="modal" onclick="show_user_info('<?php echo $res[$i]['uid'];?>');" class='blue-lnk'>Edit</button></a>
						  &nbsp; |<?php }?>
						   <button type="button" data-toggle="modal" data-target="#myModal" onclick="show_user_info('<?php echo $res[$i]['uid'];?>');" class='blue-lnk'>View Profile</button>
						  </td>
					   </tr>
						<?php
					}
					
				}
				?>
				
				   </tbody>
				</table> 
			  </div>
		   </div>
		</div>
	</div>	
</div>

 <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">User Detail</h4>
        </div>
        <div class="modal-body">
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>	
<?php

   $base=Yii::app()->theme->baseUrl;

?>

<!-- BEGIN PAGE LEVEL PLUGINS -->
<link rel="stylesheet" href="<?=$base?>/assets/frontend/dashboard/css/plugins/select2/select2.css">

<script src="<?=$base?>/assets/frontend/dashboard/js/plugins/select2/select2.min.js"></script>
<script src="<?=$base?>/assets/global/scripts/datatable.js" type="text/javascript"></script>

<script src="<?=$base?>/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>

<script src="<?=$base?>/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>


  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  
<!--<link href="<?=$base?>/css/main-style.css" rel="stylesheet">	

-->		  
			  <script>
			  function show_user_info(uid){
				  
				//$('.modal-body').html('hi')
				 $.ajax({
						type: "post",
						cache: false,
						
						url: "/backoffice/admin/default/userdata",
						data: {uid:uid},		
						success: function (data) {
							
							//$(".errors").remove();
								$('.modal-body').html(data);
							
								
						}
					});
			  }
			  $(document).ready(function(){
			   TableDatatablesButtons.init();
		
			  });
			  $("#middle_name").blur(function(){
				if($(this).val().trim()){
					$("input[name=middlenamecheckbox]").prop('checked', false);	
					$("#middlenameerror").html("");
				}
			});

			$("input[name=middlenamecheckbox]").change(function(){
				var errors = false;
				if($(this).is(':checked')){
					$("#middle_name").attr('readonly',true);
					$("#middle_name").val("");
					$("#middlenameerror").html("");
				}
				else{
					$("#middle_name").attr('readonly',false);
				}
			});
			  $("#add_user_btn").click(function(){
				  
				  if(checkValidation()){
					
					  $.ajax({
						type: "post",
						cache: false,
						
						url: "/backoffice/admin/default/emailExist",
						data: {email:$("#email").val()},		
						success: function (data) {
							
							//$(".errors").remove();
								$("#email").next("span.errors").remove();
							if (data=='dup') 
							{
								$("#email").after( "<span class='errors' style='color:red;'>This Email ID is already registered. Use a different Email ID.</span>");
								$("#email").focus();
								errors=true;
								
							}
							else{
								$('#adduser-form').hide();
								$('#adduser-form').submit();
								/*$.ajax({
									type: "post",
									cache: false,
									
									 url: "/backoffice/admin/default/mobileExists",
									data:{mobile:$("#mobile").val()},		
									success: function (data) {
											
										//$(".errors").remove();
										$("#mobile").next("span.errors").remove();
											
										if (data=='dup') 
										{
											$("#mobile").after( "<span class='errors' style='color:red;'>This Mobile Number is already registered. Use a different Mobile Number.</span>");
											$("#mobile").focus();
											
										}
										else{*/
											
										/*}   
											
									}
								});*/
							}  
								
						}
					});
					}
				  
			  });
	function checkValidation() {

	var errors = false;
	$(".errors").remove();
	var re = /[0-9]/;
    var relower = /[a-z]/;
    var reupper = /[A-Z]/;
    var respecial = /[!@#$%^&*()]+/;
	var phoneno = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;
	//first name
	
	if(($("#full_name").val()).trim() == ""){
		$("#full_name").after( "<span class='errors' style='color:red;'>First Name is required.</span>");
		//$("#full_name").focus();
		errors = true;
	}
   if (!$("#mnamechekbox").is(":checked") && $("#middle_name").val().trim()=="") {
	  console.log($("#middle_name").val());
		$("#mnamechekbox").focus();
		$("#middlenameerror").html( "Please enter the required information or select the check box");
		errors = true;
	}
	if(($("#last_name").val()).trim() == ""){
		$("#last_name").after( "<span class='errors' style='color:red;'>Last Name is required.</span>");
		//$("#full_name").focus();
		errors = true;
	}
	
	 if(($("#email").val()).trim() == ""){
		$("#email").after( "<span class='errors' style='color:red;'>Email is required.</span>");
		//$("#email").focus();
		errors = true;
	}
	else if(checkEmail()){
		
		//$("#email").after( "<span class='errors' style='color:red;'>Please enter valid email address.</span>");
		//$("#email").focus();
		errors = true;
	}
	
	 if(($("#password1").val()).trim()==""){
		
		$("#password1").after( "<span class='errors' style='color:red;'>Password must contain 1 Capital Letter, 1 Lower Letter, 1 Number and 1 Special Character.</span>");
		//	$("#password1").focus();
		errors = true;
	}
	else if(checkPassword()){
		//$("#password1").after( "<span class='errors' style='color:red;'>Please enter valid password.</span>");
		//$("#password1").focus();
		errors = true;
		
	}
	 if($("#cpassword").val() == ""){
		$("#cpassword").after( "<span class='errors' style='color:red;'>The password confirmation does not match.</span>");
		//$("#cpassword").focus();
		errors = true;
	}
	else if(checkConfirmPassword()){
		//$("#cpassword").after( "<span class='errors' style='color:red;'>Confirm password not match with password.</span>");
		errors = true;
	}
	 /*if($("#mobile").val()==""){
		$("#mobile").after( "<span class='errors' style='color:red;'>Mobile is required.</span>");
		//$("#mobile").focus();
		errors = true;
	}*/
	
	
	
	return !errors;
}
		  
$("#full_name").bind("keypress",function(){
		var regex=  new RegExp("^[ A-Za-z]*$"); //;
		var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    		if (!regex.test(key)) {
        		return false;
    		}
})
$("#middle_name").bind("keypress",function(){
		var regex=  new RegExp("^[ A-Za-z]*$"); //;
		var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    		if (!regex.test(key)) {
        		return false;
    		}
});
$("#last_name").bind("keypress",function(){
		var regex=  new RegExp("^[ A-Za-z]*$"); //;
		var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    		if (!regex.test(key)) {
        		return false;
    		}
});


$("#mobile").bind("keypress",function(){
	var regex=  new RegExp("^[0-9]*$"); 
	
	var maxLength = $(this).attr('maxlength');
	var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
	if (!regex.test(key)) {
		event.preventDefault();
		return false;
	}
	
	/*if(maxLength == $(this).val().length){
		event.preventDefault();
		return false;
	}*/
});
$("#email").on("blur", function(){
	checkEmail();
});
function checkEmail(){
	var eerrors = false;
	//$(".errors").remove();
	$("#email").next("span.errors").remove();
	if(!validateEmail($("#email").val())){
		
		$("#email").after( "<span class='errors' style='color:red;'>Valid Email Id e.g mail@email.com</span>");
		eerrors = true;
		
	}
	/*else{
		errors = checkEmailExist();
	}*/
	return eerrors;
}
function ValidateChar(data) {
	var expr =/^[a-z]+$/;	
	return expr.test(data);
};
function ValidateAlphaNumeric(data) {
	var expr =/^[(a-z)(A-Z)(0-9)]+$/;	
	return expr.test(data);
};
function validateEmail(Email) {
    var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
    if (filter.test(Email)) {
        return true;
    }
    else {
        return false;
    }
}
function checkEmailExist() {
	
    //var postdata = "email=" + $("#email").val();	
	$.ajax({
        type: "post",
        cache: false,
		async:true,
        url: "/backoffice/admin/default/emailExist",
        data: {email:$("#email").val()},		
        success: function (data) {
			var errors = false;
			//$(".errors").remove();
			$("#email").next("span.errors").remove();
				
			if (data=='dup') 
			{
				$("#email").after( "<span class='errors' style='color:red;'>This Email ID is already registered. Use a different Email ID.</span>");
				$("#email").focus();
				errors=true;
				
			}
            else{
			
				
			}  
				
		}
	});


}
$("#password1").on("blur",function(){
	checkPassword();
	
});$("#cpassword").on("blur",function(){
	checkConfirmPassword();
	
});
/*$("#mobile").on("blur",function(){
	checkMobile();
	
});*/
function checkPassword(){
	var re = /[0-9]/;
    var relower = /[a-z]/;
    var reupper = /[A-Z]/;
    var respecial = /[!@#$%^&*()]+/;
	var errors = false;
	//$(".errors").remove();
	$("#password1").next("span.errors").remove();
	if(!re.test($("#password1").val())){
		$("#password1").after( "<span class='errors' style='color:red;'>Password must contain 1 Capital Letter, 1 Lower Letter, 1 Number and 1 Special Character.</span>");
		errors = true;
	}else
	if(!relower.test($("#password1").val())){
		$("#password1").after( "<span class='errors' style='color:red;'>Password must contain 1 Capital Letter, 1 Lower Letter, 1 Number and 1 Special Character.</span>");
		errors = true;
	}else
	if(!reupper.test($("#password1").val())){
		$("#password1").after( "<span class='errors' style='color:red;'>Password must contain 1 Capital Letter, 1 Lower Letter, 1 Number and 1 Special Character.</span>");
		errors = true;
	}else
	if(!respecial.test($("#password1").val())){
		$("#password1").after( "<span class='errors' style='color:red;'>Password must contain 1 Capital Letter, 1 Lower Letter, 1 Number and 1 Special Character.</span>");
		errors = true;
	}
	return errors;
}

function checkConfirmPassword(){
	
	var errors = false;
	//$(".errors").remove();
	$("#password1").next("span.errors").remove();
	$("#cpassword").next("span.errors").remove();
	var password1 = $("#password1").val();
	var password2 = $("#cpassword").val();
	if(password1 != password2){	
		$("#cpassword").after( "<span class='errors' style='color:red;'>The password confirmation does not match.</span>");
		errors = true;
	}
	return errors;
}
function checkMobile(){
	var errors = false;
	//$(".errors").remove();
	$("#mobile").next("span.errors").remove();
	if($("#mobile").val().length !== 10){
		$("#mobile").after( "<span class='errors' style='color:red;'>Mobile no. Must be 10 Digits.</span>");
		errors = true;
	}
	/*else{
		checkMobileExist();
	}*/
	return errors;
  }

function checkMobileExist() {

    //var postdata = "mobile=" + $("#mobile").val();	
	$.ajax({
        type: "post",
        cache: false,
         url: "/backoffice/admin/default/mobileExists",
        data:{mobile:$("#mobile").val()},		
		dataType:"json",
        success: function (data) {
				var errors = false;
		//	$(".errors").remove();
		$("#mobile").next("span.errors").remove();
				
			if (data.dup ==1) 
			{
				$("#mobile").after( "<span class='errors' style='color:red;'>This Mobile Number is already registered. Use a different Mobile Number.</span>");
				$("#mobile").focus();
				errors=true;
				//$("#mobspanerror").html( "This Mobile Number is already registered. Use a different Mobile Number.");
			}
            else{
				
			}   
				
		}
	});
		
}
			
			
  var TableDatatablesButtons = function() {
   
        t = function() {
            var e = $("#sample_1");
            e.dataTable({
                language: {
                    aria: {
                        sortAscending: ": activate to sort column ascending",
                        sortDescending: ": activate to sort column descending"
                    },
                    emptyTable: "No data available in table",
                    info: "<span style='font-size:15px'>Showing _START_ to _END_ of _TOTAL_ entries</span>",
                    infoEmpty: "<span style='font-size:15px'>No entries found</span>",
                    infoFiltered: "<span style='font-size:15px'>(filtered1 from _MAX_ total entries)</span>",
                    lengthMenu: "<span style='font-size:15px; font-weight:100; margin-top:5px;'>Entries:</span>  <span style='margin-left:5px;'>_MENU_ </span>",
                    search: "<span style='font-size:15px; font-weight:100; margin-top:5px;'>Search:</span>",
                    zeroRecords: "No matching records found"
                },
                buttons: [],
                order: [
                    [0, "desc"]
                ],
                lengthMenu: [
                    [5, 10, 15, 20, -1],
                    [5, 10, 15, 20, "All"]
                ],
                pageLength: 20,

 


                dom: "<'row'<'col-md-6 col-sm-12 form-group'l><'col-md-6 col-sm-12 form-group'f>r><'mb-3't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>"
            })
        },
        n = function() {
           /*  $(".date-picker").datepicker({
               rtl: App.isRTL(),
                autoclose: !0
            }); */
            var e = new Datatable;
            e.init({
                src: $("#datatable_ajax"),
                onSuccess: function(e, t) {},
                onError: function(e) {},
                onDataLoad: function(e) {
				$("#sample_1_filter").find("input").attr("placeholder",'Search by keywords');
   
  
                },
                loadingMessage: "Loading...",
                dataTable: {
                    bStateSave: !0,
                    lengthMenu: [
                        [10, 20, 50, 100, 150, -1],
                        [10, 20, 50, 100, 150, "All"]
                    ],
                    pageLength: 20,
                    ajax: {
                        url: "../demo/table_ajax.php"
                    },
                    order: [
                        [1, "asc"]
                    ],
                    buttons: []
                }
            }), e.getTableWrapper().on("click", ".table-group-action-submit", function(t) {
                t.preventDefault();
                var a = $(".table-group-action-input", e.getTableWrapper());
                "" != a.val() && e.getSelectedRowsCount() > 0 ? (e.setAjaxParam("customActionType", "group_action"), e.setAjaxParam("customActionName", a.val()), e.setAjaxParam("id", e.getSelectedRows()), e.getDataTable().ajax.reload(), e.clearAjaxParams()) : "" == a.val() ? App.alert({
                    type: "danger",
                    icon: "warning",
                    message: "Please select an action",
                    container: e.getTableWrapper(),
                    place: "prepend"
                }) : 0 === e.getSelectedRowsCount() && App.alert({
                    type: "danger",
                    icon: "warning",
                    message: "No record selected",
                    container: e.getTableWrapper(),
                    place: "prepend"
                })
            }), $("#datatable_ajax_tools > li > a.tool-action").on("click", function() {
                var t = $(this).attr("data-action");
                e.getDataTable().button(t).trigger()
            })
        };
    return {
        init: function() {
            jQuery().dataTable && (t(),n())
        }
    }
}();
 
			  </script>