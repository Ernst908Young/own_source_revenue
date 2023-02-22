
<script type="text/javascript">
$(document).ready(function(){
	    $("a.back_btn").css('visibility', 'hidden');
		$("#UK-FCL-00197_0,#UK-FCL-00621_0,#UK-FCL-00310_0,#UK-FCL-00096_0").attr('readonly',true);
		    $("#UK-FCL-00096_0").val("BARBADOS");


	
	$("#UK-FCL-00290_0").on("blur",function(){
	        var reg_no = $(this).val(); 
	                $.ajax({
	                    type: "POST",
	                    dataType:'json',
	                    url: "/backoffice/infowizardtwo/subFormArticlesOfDissolutionForm9/getcompanyNameByregno/reg_no/" + reg_no,
	                    beforeSend:function(){
	                        $("#UK-FCL-00290_0-error").text("Please wait...");                      
	                    },
	                    success: function(result) {                     
	                        if(result.status==true){                            
	                                $("#UK-FCL-00290_0-error").text("");                 
	                                $("#UK-FCL-00197_0").val(result.cname);     
	                                                                        
	                        }else{
	                            $("#UK-FCL-00290_0-error").text(result.msg);                            
	                            $("#UK-FCL-00197_0").val("");                       
	                        }
	                       console.log(result);
	                    }
	                });                 
	    });

	   $("#UK-FCL-00105_0").blur(function(){
        if($(this).val()){
            $("input[name=middlenamecheckbox00105_0]").prop('checked', false); 
        }
    });

	  $("#div_UK-FCL-00105_0").append("<div class='col-md-12' style='margin-top:10px;'><input type='checkbox' id='middlenamecheckbox00105_0' name='middlenamecheckbox00105_0'> I do not have a middle name or middle initial</div>");

     $("input[name=middlenamecheckbox00105_0]").change(function(){
        if($(this).is(':checked')){
            $("#UK-FCL-00105_0").val("");
            $("#UK-FCL-00105_0").attr('readonly',true);     
        }else{
            $("#UK-FCL-00105_0").attr('readonly',false);
        }
    });

      $("#UK-FCL-00129_0").on("change", function() {
            $("#UK-FCL-00129_0-error").empty();
            $("#div_UK-FCL-00129_0").removeClass("has-error");
       })

    $('#UK-FCL-00132_0, #UK-FCL-00105_0, #UK-FCL-00106_0, #UK-FCL-00093_0, #UK-FCL-00238_0, #UK-FCL-00129_0, #UK-FCL-00094_0').keyup(function(){
           $(this).val($(this).val().toUpperCase());
       });

    $("<div class='col-md-12' id='form2regisaddtitle' style='margin-top:10px;'><strong>The records and other documents of the Society shall be kept in Barbados for 6 years following the date of dissolution by:</strong></div>").insertBefore("#div_UK-FCL-00132_0");

    
    $("#input_UK-FCL-00622_0").find('span').after('<span style="color:red;"> * </span>');
     $("#div_UK-FCL-00622_0").find('span').first().remove();//('<span style="color:red;"> * </span>');
    

    $(".chk_UK-FCL-00622_0").on('click',function(){
        // console.log($("input[type='checkbox'][name='UK-FCL-00622_0[]']:checked"));
        if ($("input[type='checkbox'][name='UK-FCL-00622_0[]']:checked").length>0)
       {           
        $(".chk_UK-FCL-00622_0").attr("required",true);
        }
        else{           
            $(".chk_UK-FCL-00622_0").removeAttr("required");
        }
    })
    
     $("#UK-FCL-00620_0").on("blur",function(){
        var srn_no = $(this).val();
        getcomapnyname(srn_no);
             
    });

$("#UK-FCL-00620_0").bind("keypress",function(){
    var regex=  new RegExp("^[0-9]*$"); //;
    var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if (!regex.test(key)) {
        return false;
    }
});

     
    function getcomapnyname(srn_no){
        if(srn_no!=""){
                    $.ajax({
                        type: "POST",
                        dataType:'json',
                        url: "/backoffice/infowizardtwo/subFormArticlesOfDissolutionForm9/getCompanyNameBySrnNo/srn_no/" + srn_no +"/subID/<?= isset($_GET['subID']) ? $_GET['subID'] : NULL ?>",
                        beforeSend:function(){
                            $("#UK-FCL-00620_0-error").text("Please wait...");                      
                        },
                        success: function(result) {                     
                            if(result.status==true){
                                if(result.app_status=='valid'){
                                    $("#UK-FCL-00621_0").val(result.name);
                                    $("#UK-FCL-00620_0-error").html("");
                                    $("#UK-FCL-00621_0-error").html("");    
                                }else{
                                    $("#UK-FCL-00620_0-error").text(result.msg);            
                                    if ($("#UK-FCL-00621_0-error").length) {
                                        $("#UK-FCL-00621_0-error").text(errormessages.srn_msg001);
                                    }else{
                                        $("#div_UK-FCL-00621_0").find('div').append('<div  style="color:red;" id="UK-FCL-00621_0-error">'+errormessages.srn_msg001+'<br>'+errormessages.srn_msg002+'</div>');
                                    }    

                                    $("#UK-FCL-00621_0").val("");  
                                }                                           
                            }else{
                                if(result.user){
                                    $("#UK-FCL-00620_0-error").text(result.msg);
                                    $("#UK-FCL-00621_0").val("");   
                                    $("#UK-FCL-00621_0-error").text("");
                                }else{
                                    //alert(result.msg);
                                }                                               
                            }
                         //  console.log(result);
                        }
                    });
            }   
    }
});	



	</script>

