/**
this function is used to close the ticket 
*@author hemant 
*/
function closeTicket(url,ticket_id){
    var postData={"ticket_id":ticket_id};
    jQuery.ajax({
        url:url,
        data:postData,
        dataType:'json',
        type:'POST',
        success:function(data){
            if(data!=''){
                if(data.STATUS==200){
                     $(".show_errors").text("Ticket has been successfully closed");
                     $('.ticket_status').hide();
                     var ticketCount='.ticketCount'+ticket_id;
                     $(ticketCount).removeClass( "fa-rocket" );
                     $(ticketCount).removeClass("fa-circle");
                     $(ticketCount).removeClass( "text-danger" );
                     $(ticketCount).addClass( "text-success" );
                     $(ticketCount).addClass("fa-circle");
                     $('.main_footer').hide();
                     return true;
                }
                else if(data.STATUS==503){
                    $(".show_errors").empty();
                    $(".show_errors").text("Could not update the status please refresh your page.");
                    $('.close_ticket').show();
                }
                else{
                    $(".show_errors").empty();
                    $(".show_errors").text(data.RESPONSE);
                    $('.ticket_status').hide();
                }
            }
        },
         error: function (data) {
                console.log(data);
        }
    });
}
/*function used to get Last six applications
* author: Hemant Thakur
*@Param: string
*/
function getLastSixApplications(url){
    
        //startPreloader();
        jQuery.ajax({
            url: url,
            type: 'POST',
            dataType: 'json',
            success: function (data) {
               //stopPreloader();
               $('.dept-applications').empty();
                if (data != '') {
                    if(data.STATUS==200){
                         var dataString='<tbody>';
                         var count=1;
                         $(data.applications).each(function (key,object) { 
                            dataString+="<tr><td>"+count+"</td><td class='dept_name_td"+count+"'>"+object.department_name+"<td><span class='badge bg-important app_count_td"+count+"'>"+object.app_cnt+"</span><td><div id='work-progress1'></div></td></tr>";
                            count=count+1;
                         });
                         dataString+="</tbody>";
                         $('.dept-applications').append(dataString);
                          var morData=[];
                          var count=1;
                          $('.dept-applications tr').each(function () {
                            var dept_name=$('.dept_name_td'+count).html();
                            var app_count_td=$('.app_count_td'+count).html();
                            app_count_td=parseInt(app_count_td);
                            count=count+1;
                            item = {}
                            item ["label"] = dept_name.trim();
                            item ["value"] = app_count_td;
                            morData.push(item);
                          })
                          
                           Morris.Donut({
                           element: 'hero-donut',
                           data: morData,
                             colors: ['#41cac0', '#49e2d7', '#34a39b'],
                           formatter: function (y) { return y }
                         });
                          
                    }
                    else if(data.STATUS==204){
                         $('.dept-applications').append("<div class='task-progress'>No applications Founds</div>");
                    }
                    else
                        $('.dept-applications').append("<div class='task-progress'>"+data.message);              
                    
                } else {
                    $('.dept-applications').append("<div class='task-progress'>No applications Founds</div>");
                }
            },
            error: function (data) {
                console.log(data);
            }
        });
}
/*function used to get all the dept list
* author: Hemant Thakur
*@Param: string
*/
function getAllDept(url){
    
        //startPreloader();
        jQuery.ajax({
            url: url,
            type: 'POST',
            dataType: 'json',
            // data: "country_id=" + countryId,
            success: function (data) {
               //stopPreloader();
                if (data != '') {
                    var sel = "";
                    $('#Applications_dept_id').empty();
                    $('#Applications_dept_id').append('<option  value="">Please Select Department</option>');
                    data.forEach(function (object) { 
                        $('#Applications_dept_id').append('<option  value="' + object.dept_id + '" ' + sel + '>' + object.department_name + '</option>');

                    });                    
                    
                } else {
                    $('#Applications_dept_id').empty();
                    $('#Applications_dept_id').append('<option value="">Please select Department</option>');
                }
            },
            error: function (data) {
                console.log(data);
            }
        });
}
/*function used to get all the Roles
* author: Hemant Thakur
*@Param: string
*/
function getAllRoles(url,formid){
    
        //startPreloader();
        jQuery.ajax({
            url: url,
            type: 'POST',
            dataType: 'json',
            // data: "country_id=" + countryId,
            success: function (data) {
               //stopPreloader();
                if (data != '') {
                    var sel = "";
                    $(formid).empty();
                    $(formid).append('<option  value="">Please Select Roles</option>');
                    data.forEach(function (object) { 
                        $(formid).append('<option  value="' + object.role_id + '" ' + sel + '>' + object.role_name + '</option>');

                    });                    
                    
                } else {
                    $(formid).empty();
                    $(formid).append('<option value="">Please select Roles</option>');
                }
            },
            error: function (data) {
                console.log(data);
            }
        });
}
/*function used to get Role Name from ID 
* author: Hemant Thakur
*@Param: string
*/
function getApprvrNameviaId(url,roleid){
    
        //startPreloader();
        jQuery.ajax({
            url: url,
            type: 'POST',
            dataType: 'json',
            data: "roleid=" + roleid,
            success: function (data) {
               //stopPreloader();
                if (data != '') {
                        var prevroles=$(".roleView").text();
                        if(prevroles==='')
                            $(".roleView").append("<span class='roleViewbox'>"+data.role_name+"</span>");
                        else
                            $(".roleView").append("&nbsp;&nbsp;>>&nbsp;&nbsp; <span class='roleViewbox'>"+data.role_name+"</span>");
                    
                } else {
                    console.log("Blank");
                }
            },
            error: function (data) {
                console.log(data);
            }
        });
}
/*function used to get all the Dept's Users
* author: Hemant Thakur
*@Param: string
*/
function getAllDeptUsers(url,dept_id){
        //startPreloader();
        jQuery.ajax({
            url: url,
            type: 'POST',
            dataType: 'json',
            data: "dept_id=" + dept_id,
            success: function (data) {
               //stopPreloader();
                if (data != '') {
                    var sel = "";
                    $('#UserRoleMapping_user_id').empty();
                    $('#UserRoleMapping_user_id').append('<option  value="">Please Select User</option>');
                    data.forEach(function (object) { 
                        $('#UserRoleMapping_user_id').append('<option  value="' + object.uid + '" ' + sel + '>' + object.full_name + '</option>');

                    });                    
                    
                } else {
                    $('#UserRoleMapping_user_id').empty();
                    $('#UserRoleMapping_user_id').append('<option value="">Please select User</option>');
                }
            },
            error: function (data) {
                console.log(data);
            }
        });
}
function getAllDeptUsersModule(url,dept_id){
        //startPreloader();
        jQuery.ajax({
            url: url,
            type: 'POST',
            dataType: 'json',
            data: "dept_id=" + dept_id,
            success: function (data) {
               //stopPreloader();
                if (data != '') {
                    var sel = "";
                    $('#UserRoleModuleMapping_user_id').empty();
                    $('#UserRoleModuleMapping_user_id').append('<option  value="">Please Select User</option>');
                    data.forEach(function (object) { 
                        $('#UserRoleModuleMapping_user_id').append('<option  value="' + object.uid + '" ' + sel + '>' + object.full_name + '</option>');

                    });                    
                    
                } else {
                    $('#UserRoleModuleMapping_user_id').empty();
                    $('#UserRoleModuleMapping_user_id').append('<option value="">Please select User</option>');
                }
            },
            error: function (data) {
                console.log(data);
            }
        });
}
/*function used to get all the Dept's Users roles for approver
* author: Hemant Thakur
*@Param: string
*/
function getDeptRoles(url,dept_id){
        //startPreloader();
        jQuery.ajax({
            url: url,
            type: 'POST',
            dataType: 'json',
            data: "dept_id=" + dept_id,
            success: function (data) {
               //stopPreloader();
                if (data != '') {
                    var sel = "";
                    $('#Applications_approver_id').empty();
                    $('#Applications_approver_id').append('<option  value="">Please Select Approver</option>');
                    data.forEach(function (object) { 
                        $('#Applications_approver_id').append('<option  value="' + object.role_id + '" ' + sel + '>' + object.role_name + '</option>');

                    });                    
                    
                } else {
                    $('#Applications_approver_id').empty();
                    $('#Applications_approver_id').append('<option value="">Please select Approver</option>');
                }
            },
            error: function (data) {
                console.log(data);
            }
        });
}
/*function used to get all the dept list for application later it will replace with api
* author: Hemant Thakur
*@Param: string
*/
function getAllDeptAPI(url,formid){
    
        //startPreloader();
        jQuery.ajax({
            url: url,
            type: 'POST',
            dataType: 'json',
            // data: "country_id=" + countryId,
            success: function (data) {
               //stopPreloader();
                if (data != '') {
                    var sel = "";
                    $(formid).empty();
                    $(formid).append('<option  value="">Please Select Department</option>');
                    data.forEach(function (object) { 
                        $(formid).append('<option  value="' + object.dept_id + '" ' + sel + '>' + object.department_name + '</option>');

                    });                    
                    
                } else {
                    $(formid).empty();
                    $(formid).append('<option value="">Please select Department</option>');
                }
            },
            error: function (data) {
                console.log(data);
            }
        });
}


function getApplicationRecords(dept_id,app_id,url){
      var data={"app_id":app_id,"dept_id":dept_id,};
    jQuery.ajax({
            url: url,
            type: 'POST',
            dataType: 'json',
            data: data,
            success: function (data) {
                if (data != '') {
                    $('.table_data').empty();
                    var data_string='';
                    if(data.STATUS==200){
                       $(data.applications).each(function (key,object) { 
                            data_string+='<tr><td>'+object.department_name+'</td><td>'+object.user_id+'</td><td>'+object.application_name+'</td><td>'+object.application_status+'</td><td>'+object.application_created_date+'</td></tr>';
                       })
                       $('.table_data').append(data_string);
                    }
                      if(data.STATUS==400){
                        $('.error').text("Invalid Request");                      }
                }
            },
            error: function (data) {
                console.log(data);
            }
        });
}


/*function used to get all the application list of particular dept
* author: Hemant Thakur
*@Param: string
*/
function getApplications(url){
    var dept_id=$('#ApplicationsFieldsMapping_dept_id').val();
    jQuery.ajax({
            url: url,
            type: 'POST',
            dataType: 'json',
            data: "dept_id=" + dept_id,
            success: function (data) {
               //stopPreloader();
                if (data != '') {
                    var sel = "";
                    $('#ApplicationsFieldsMapping_application_id').empty();
                    $('#ApplicationsFieldsMapping_application_id').append('<option  value="">Please Select Application</option>');
                    data.forEach(function (object) { 
                        $('#ApplicationsFieldsMapping_application_id').append('<option  value="' + object.application_id + '" ' + sel + '>' + object.application_name + '</option>');

                    });                    
                    
                } else {
                    $('#ApplicationsFieldsMapping_application_id').empty();
                    $('#ApplicationsFieldsMapping_application_id').append('<option value="">Please select Application</option>');
                }
        },
            error: function (data) {
                console.log(data);
            }
        });
}
/*function used to check whether field exist or not
* author: Hemant Thakur
*@Param: string,string
*/
function checkFieldName(url,fname){
    jQuery.ajax({
            url: url+'/checkfieldname',
            type: 'POST',
            dataType: 'json',
            data: "field_name=" + fname,
            success: function (data) {
                if(data!=''){
                    if(data==='NONE')
                        return false;
                    else{
                      
                             $('.check_status').show();
                            $('.check_status').text(data.field_name+' Already in Databse').fadeOut(7000);;
                             document.getElementById("filelds-form").reset();
                             $('#Filelds_field_name').focus();
                    }
                }
         },
            error: function (data) {
                console.log(data);
            }
        });
   
}

function btnaction(vall){
    console.log("add");
        var val=$('.btn_action_section').val();
     var append_data='';
    if(val=='addTextBoxes'){
     append_data="<div class='col-md-6'>" +
        "<input type='text' name='ApplicationsFieldsMapping[field_onclick_add_no_fields]["+vall+"]' id='ApplicationsFieldsMapping[field_onclick_add_no_fields]' class='form-control' placeholder='No. of created Fields' />"+
     "</div>"+    
     "<div class='col-md-6'>" +
        "<input type='text' name='ApplicationsFieldsMapping[field_onclick_field_name]["+vall+"]' id='ApplicationsFieldsMapping[field_onclick_field_name]' class='form-control' placeholder='Created Field Name' />"+
     "</div>"+
      "<div class='col-md-6'>" +
        "<input type='text' name='ApplicationsFieldsMapping[field_onclick_field_placeholder]["+vall+"]' id='ApplicationsFieldsMapping[field_onclick_field_placeholder]' class='form-control' placeholder='Created Field Placeholder' />"+
     "</div>";
    }
    $('.options_select').append(append_data);
}

/*function used to get all the field info
* author: Hemant Thakur
*@Param: string string
*/
function getFieldsInfo(url,f_id){
    $('.modal-body').empty();
     $('.select_error').text('Please wait....');
     $('.select_error').css('color','green');
    var i=1;
    $(f_id).each(function(index,val){
        if(val!=''){
          jQuery.ajax({
                 url: url+'/getfielddetail',
                 type: 'POST',
                 dataType: 'json',
                 data: "f_id=" + val,
                 success: function (data) {
                     if(data!=''){
                         if(data==='NONE'){
                             $('.select_error').text('Unknown Error. Please try again Later');
                             return false;
                         }
                         else{
                                 $('.select_error').remove();
                                 var append_data='';
                                 $('#ApplicationsFieldsMapping_field_name').val(data.field_name);
                                 $('.custom-wrapper').empty();
                                 if(data.filed_type==='text'){
                                      append_data="<div class='row'><fieldset><legend>Properties for "+data.field_name+"</legend>" +
                                    "<div class='col-md-6'>" +
                                    "<input type='text' name='ApplicationsFieldsMapping[field_placeholder]["+val+"]' id='ApplicationsFieldsMapping[field_placeholder]' class='form-control' placeholder='Placeholder for the field' />"+
                                    "</div>"+
                                    "<div class='col-md-6'>" +
                                    "<input type='text' name='ApplicationsFieldsMapping[field_name]["+val+"]' min='1' id='ApplicationsFieldsMapping[field_max_length]' readonly class='form-control' value='"+data.field_name+"' />"+
                                    "</div>"+
                                    "<div class='col-md-6'>" +
                                    "<input type='number' name='ApplicationsFieldsMapping[field_max_length]["+val+"]' min='1' id='ApplicationsFieldsMapping[field_max_length]' class='form-control' placeholder='Max length of the field' />"+
                                    "</div>"+
                                    "<div class='col-md-6'>" +
                                    "<input type='number' name='ApplicationsFieldsMapping[field_min_length]["+val+"]' min='1' id='ApplicationsFieldsMapping[field_min_length]' class='form-control' placeholder='Min Length of the field' />"+
                                    "</div>"+
                                    "<div class='col-md-6'>" +
                                    "<input type='text' name='ApplicationsFieldsMapping[field_class]["+val+"]' id='ApplicationsFieldsMapping[field_class]' class='form-control' placeholder='class for the Field' />"+
                                    "</div>"+
                                    "<div class='col-md-6'>" +
                                    "<select name='ApplicationsFieldsMapping[field_autocomplete]["+val+"]' class='form-control' id='ApplicationsFieldsMapping[field_autocomplete]'><option value=''>Auto Complete</option><option value='1'>Yes</option><option value='0'>No</option></select>"+
                                    "</div>"+
                                    "<div class='col-md-6'>" +
                                    "<select name='ApplicationsFieldsMapping[field_autofocus]["+val+"]' class='form-control' id='ApplicationsFieldsMapping[field_autofocus]'><option value=''>Auto Focus</option><option value='1'>Yes</option><option value='0'>No</option></select>"+
                                    "</div>"+
                                    "<div class='col-md-6'>" +
                                    "<select name='ApplicationsFieldsMapping[field_validation]["+val+"]' class='form-control' id='ApplicationsFieldsMapping[field_validation]' multiple><option value='required'>Required</option><option value='email'>email</option><option value='numberonly'>Number Only</option><option value='Alphanumric'>Alphanumric</option></select>"+
                                    "</div>"+
                                    "</fieldset></div>";   
                                                                         
                                 }
                                else if(data.filed_type==='button'){
                                      append_data="<div class='row'><fieldset><legend>Properties for "+data.field_name+"</legend>" +
                                    "<div class='col-md-6'>" +
                                    "<input type='text' name='ApplicationsFieldsMapping[field_placeholder]["+val+"]' id='ApplicationsFieldsMapping[field_placeholder]' class='form-control' placeholder='Placeholder for the field' />"+
                                    "</div>"+
                                    "<div class='col-md-6'>" +
                                    "<input type='text' name='ApplicationsFieldsMapping[field_name]["+val+"]' min='1' id='ApplicationsFieldsMapping[field_max_length]' readonly class='form-control' value='"+data.field_name+"' />"+
                                    "</div>"+
                                    "<div class='col-md-6'>" +
                                    "<input type='text' name='ApplicationsFieldsMapping[field_class]["+val+"]' id='ApplicationsFieldsMapping[field_class]' class='form-control' placeholder='class for the Field' />"+
                                    "</div>"+
                                     "<div class='col-md-6'>" +
                                    "<select name='ApplicationsFieldsMapping[field_onclick]["+val+"]' class='form-control btn_action_section' onchange='btnaction("+val+");' id='ApplicationsFieldsMapping[field_onclick]'><option value=''>OnClick</option><option value='addTextBoxes'>addTextBoxes</option></select>"+
                                    "</div>"+
                                     "<div class='options_select'> <div>"+
                                    "</fieldset></div>";   
                                                                         
                                 }
                                 else if(data.filed_type==='file'){
                                      append_data="<div class='row'><fieldset><legend>Properties for "+data.field_name+"</legend>" +
                                    "<div class='col-md-6'>" +
                                    "<input type='text' name='ApplicationsFieldsMapping[field_placeholder]["+val+"]' id='ApplicationsFieldsMapping[field_placeholder]' class='form-control' placeholder='Placeholder for the field' />"+
                                    "</div>"+
                                    "<div class='col-md-6'>" +
                                    "<input type='text' name='ApplicationsFieldsMapping[field_name]["+val+"]' min='1' id='ApplicationsFieldsMapping[field_max_length]' readonly class='form-control' value='"+data.field_name+"' />"+
                                    "</div>"+
                                    "<div class='col-md-6'>" +
                                    "<input type='number' name='ApplicationsFieldsMapping[field_max_length]["+val+"]' min='1' id='ApplicationsFieldsMapping[field_max_length]' class='form-control' placeholder='Max Size of file in KB' />"+
                                    "</div>"+
                                    "<div class='col-md-6'>" +
                                    "<input type='number' name='ApplicationsFieldsMapping[field_min_length]["+val+"]' min='1' id='ApplicationsFieldsMapping[field_min_length]' class='form-control' placeholder='Min Min Size of file in KB' />"+
                                    "</div>"+
                                    "<div class='col-md-6'>" +
                                    "<select name='ApplicationsFieldsMapping[field_file_type]["+val+"]' class='form-control' id='ApplicationsFieldsMapping[field_autofocus]'><option value=''>File Type</option><option value='pdf'>Pdf</option><option value='jpg'>jpg</option><option value='doc'>doc</option><option value='other'>other</option></select>"+
                                    "</div>"+
                                    "<div class='col-md-6'>" +
                                    "<input type='text' name='ApplicationsFieldsMapping[field_class]["+val+"]' id='ApplicationsFieldsMapping[field_class]' class='form-control' placeholder='class for the Field' />"+
                                    "</div>"+
                                    "<div class='col-md-6'>" +
                                    "<select name='ApplicationsFieldsMapping[field_autocomplete]["+val+"]' class='form-control' id='ApplicationsFieldsMapping[field_autocomplete]'><option value=''>Auto Complete</option><option value='1'>Yes</option><option value='0'>No</option></select>"+
                                    "</div>"+
                                    "<div class='col-md-6'>" +
                                    "<select name='ApplicationsFieldsMapping[field_autofocus]["+val+"]' class='form-control' id='ApplicationsFieldsMapping[field_autofocus]'><option value=''>Auto Focus</option><option value='1'>Yes</option><option value='0'>No</option></select>"+
                                    "</div>"+
                                    "<div class='col-md-6'>" +
                                    "<select name='ApplicationsFieldsMapping[field_validation]["+val+"]' class='form-control' id='ApplicationsFieldsMapping[field_validation]' multiple><option value='required'>Required</option><option value='email'>email</option><option value='numberonly'>Number Only</option><option value='Alphanumric'>Alphanumric</option></select>"+
                                    "</div>"+
                                    "</fieldset></div>";   
                                                                         
                                 }
              
                                else if(data.filed_type==='radio' || data.filed_type==='select'){
                                    append_data="<div class='row'><fieldset><legend>Properties for "+data.field_name+"</legend>" +
                                    "<div class='col-md-6'>" +
                                    "<textarea name='ApplicationsFieldsMapping[each_field_placeholder]["+val+"]' id='ApplicationsFieldsMapping[field_placeholder]' class='form-control' placeholder='Placeholders for the field' /></textarea>"+
                                    "<span style='color:red'>(separated by \',\')</span>"+
                                    "</div>"+
                                     "<div class='col-md-6'>" +
                                    "<textarea name='ApplicationsFieldsMapping[each_field_value]["+val+"]' id='ApplicationsFieldsMapping[field_placeholder]' class='form-control' placeholder='values for the field' /></textarea>"+
                                    "<span style='color:red'>(separated by \',\')</span>"+
                                    "</div>"+
                                     "<div class='col-md-6'>" +
                                    "<input type='text' name='ApplicationsFieldsMapping[field_name]["+val+"]' min='1' id='ApplicationsFieldsMapping[field_max_length]' readonly class='form-control' value='"+data.field_name+"' />"+
                                    "</div>"+
                                    "<div class='col-md-6'>" +
                                    "<input type='text' name='ApplicationsFieldsMapping[field_class]["+val+"]' id='ApplicationsFieldsMapping[field_class]' class='form-control' placeholder='class for the Field' />"+
                                    "</div>"+
                                    "<div class='col-md-6'>" +
                                    "<select name='ApplicationsFieldsMapping[field_validation]["+val+"]' class='form-control' id='ApplicationsFieldsMapping[field_validation]' multiple><option value='required'>Required</option><option value='email'>email</option><option value='numberonly'>Number Only</option><option value='Alphanumric'>Alphanumric</option></select>"+
                                    "</div>"+
                                    "</fieldset></div>";

                                 }
                                else {
                                        append_data="<div class='row'><fieldset><legend>Properties for "+data.field_name+"</legend>" +
                                    "<div class='col-md-6'>" +
                                    "<input type='text' name='ApplicationsFieldsMapping[field_placeholder]["+val+"]' id='ApplicationsFieldsMapping[field_placeholder]' class='form-control' placeholder='Placeholder for the field' />"+
                                    "</div>"+
                                     "<div class='col-md-6'>" +
                                    "<input type='text' name='ApplicationsFieldsMapping[field_name]["+val+"]' min='1' id='ApplicationsFieldsMapping[field_max_length]' readonly class='form-control' value='"+data.field_name+"' />"+
                                    "</div>"+
                                    "<div class='col-md-6'>" +
                                    "<input type='number' name='ApplicationsFieldsMapping[field_max_length]["+val+"]' min='1' id='ApplicationsFieldsMapping[field_max_length]' class='form-control' placeholder='Max length of the field' />"+
                                    "</div>"+
                                    "<div class='col-md-6'>" +
                                    "<input type='number' name='ApplicationsFieldsMapping[field_min_length]["+val+"]' min='1' id='ApplicationsFieldsMapping[field_min_length]' class='form-control' placeholder='Min Length of the field' />"+
                                    "</div>"+
                                    "<div class='col-md-6'>" +
                                    "<input type='text' name='ApplicationsFieldsMapping[field_class]["+val+"]' id='ApplicationsFieldsMapping[field_class]' class='form-control' placeholder='class for the Field' />"+
                                    "</div>"+
                                    "<div class='col-md-6'>" +
                                    "<select name='ApplicationsFieldsMapping[field_autocomplete]["+val+"]' class='form-control' id='ApplicationsFieldsMapping[field_autocomplete]'><option value=''>Auto Complete</option><option value='1'>Yes</option><option value='0'>No</option></select>"+
                                    "</div>"+
                                    "<div class='col-md-6'>" +
                                    "<select name='ApplicationsFieldsMapping[field_autofocus]["+val+"]' class='form-control' id='ApplicationsFieldsMapping[field_autofocus]'><option value=''>Auto Focus</option><option value='1'>Yes</option><option value='0'>No</option></select>"+
                                    "</div>"+
                                    "<div class='col-md-6'>" +
                                    "<select name='ApplicationsFieldsMapping[field_validation]["+val+"] ' class='form-control' id='ApplicationsFieldsMapping[field_validation]' multiple><option value='required'>Required</option><option value='email'>email</option><option value='numberonly'>Number Only</option><option value='Alphanumric'>Alphanumric</option></select>"+
                                    "</div>"+
                                    "</fieldset></div>"; 
                                 }
                                 $('.modal-body').append(append_data);

                                 $('#ApplicationsFieldsMapping_field_value').val(data.field_desc);
                         }
                     }
              },
                 error: function (data) {
                     console.log(data);
                 }
             });  
        }

    })
}
/*$(formid).on('change', function(){
    console.log('aag yaa main');
    var dept_id=$(formid).val();
    console.log(dept_id);
    jQuery.ajax({
            url: url,
            type: 'POST',
            dataType: 'json',
            data: "dept_id=" + dept_id,
            success: function (data) {
               //stopPreloader();
                if (data != '') {
                    var sel = "";
                    console.log(data);
            },
            error: function (data) {
                console.log(data);
            }
        });

})*/


/*function to get user details
* author: Santosh Kumar
*@Param: string
*/
function getUserDetails(url,dept_id,dist_id){
    jQuery.ajax({
            url: url,
            type: 'POST',
            dataType: 'json',
            data: {'dept_id':dept_id,'disctrict_id':dist_id} ,
            success: function (data) {
                if(data!=''){
                    if(data==='NONE')
                        return false;
                    else{
                       //console.log(data);
                      $('#User_full_name').val(data.full_name);
                      $('#User_email').val(data.email);
                      //$('#User_password').val(data.password);
                      $('#User_mobile').val(data.mobile);
                      $('#User_uid').val(data.uid);
                    }
                }
         },
            error: function (data) {
                console.log(data);
            }
        });
   
}
