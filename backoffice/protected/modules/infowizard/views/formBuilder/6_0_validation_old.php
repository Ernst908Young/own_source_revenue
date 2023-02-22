<style>
.mycolor{
   background-color:burlywood
}
 #div_UK-FCL-00168_0,#div_UK-FCL-00386_0{
	margin-bottom: 30px;
}

</style>

<script>
let status=0;
let trustemiddlename=1

$(document).ready(function(){
	$("#div_UK-FCL-00158_0").append("<div class='col-md-12' style='margin-top:10px;'><input type='checkbox'  name='middlenamecheckbox'> I do not have a middle name or middle initial</div>");
	$("#UK-FCL-00158_0").blur(function(){
	if($(this).val()){
		$("input[name=middlenamecheckbox]").prop('checked', false);	
	}
});

$("input[name=middlenamecheckbox]").change(function(){
	if($(this).is(':checked')){
		$("#UK-FCL-00158_0").val("");
		$("#UK-FCL-00158_0").attr('readonly',true);		
	}else{
		$("#UK-FCL-00158_0").attr('readonly',false);
	}
});

$("#div_UK-FCL-00163_0").append("<div class='col-md-12' style='margin-top:10px;'><input type='checkbox'  name='middlenamecheckbox'> I do not have a middle name or middle initial</div>");
	$("#UK-FCL-00163_0").blur(function(){
	if($(this).val()){
		$("input[name=middlenamecheckbox]").prop('checked', false);	
	}
});

$("input[name=middlenamecheckbox]").change(function(){
	if($(this).is(':checked')){
		$("#UK-FCL-00163_0").val("");
		$("#UK-FCL-00163_0").attr('readonly',true);		
	}else{
		$("#UK-FCL-00163_0").attr('readonly',false);
	}
});
$("#div_UK-FCL-00154_0").append("<div class='col-md-12' style='margin-top:10px;'><input type='checkbox'  name='middlenamecheckbox'> I do not have a middle name or middle initial</div>");

$("#UK-FCL-00154_0").blur(function(){
							if($(this).val()){
								$("input[name=middlenamecheckbox]").prop('checked', false);	
							}
						});

						$("input[name=middlenamecheckbox]").change(function(){
							if($(this).is(':checked')){
								$("#UK-FCL-00154_0").val("");
								trustemiddlename=0
								$("#UK-FCL-00154_0").attr('readonly',true);		
							}else{
								$("#UK-FCL-00154_0").attr('readonly',false);
								trustemiddlename=1
							}
						});
	
         var latestdate =function()
         {
         
          $("#" +this.id).attr("data-date-format","dd/mm/yyyy")
               var today = new Date();
              var dd = today.getDate();
              var mm = today.getMonth()+1; //January is 0!
              var yyyy = today.getFullYear();
              if(dd<10){
                      dd='0'+dd
                  } 
                  if(mm<10){
                      mm='0'+mm
                  } 

              today = dd+'/'+mm+'/'+yyyy;
              $("#" +this.id).attr("max", today);
         }
         latestdate.call({"id":"UK-FCL-00117_0"})
         
     
     
		
    
    
    // $("#UK-FCL-00111_0").setAttribute("placeholder", "");



    //  $("#UK-FCL-00184_0").prop( "disabled", true)
    $("#UK-FCL-00111_0").attr("placeholder", "Enter Proposed Name of Charity")
     
	$("#UK-FCL-00111_0").keypress(function(e){
	
		var keyCode = e.which;	 
		console.log(keyCode);
		$(".proposedName").remove();
		if((keyCode == 33) || (keyCode == 64) || (keyCode == 35) || (keyCode == 36) || (keyCode == 37) || (keyCode == 94) || (keyCode== 42) || (keyCode== 126) || (keyCode== 96))
		{
			var id = $(this).attr('id');
			$("#div_"+id).append("<div id="+id+"'-error' style='color:red; margin-left:1em;' class='form-control-feedback-error proposedName'>Please enter the permitted special characters only i.e (),.&:;-</div>");			
			e.preventDefault();		
		}		
	});


   $("#input_UK-FCL-00111_0").append("<p> HEREBY APPLY to have the said charity registered under the above mentioned Act.</p>")
  
  
   $("#UK-FCL-00096_0").val("Barbados")
   $("#UK-FCL-00170_0").val("Barbados")
   $("#UK-FCL-00096_0").attr("disabled","disabled")
   $("#UK-FCL-00170_0").attr("disabled","disabled")
   var msg=`Please give details of any applicant, trustee, officer or beneficiary who holds or has held
a) a prominent public office, for example, a Head of State, any Judicial Officer, a Permanent Secretary, a Minister or a Chief Executive Officer or director of a state owned enterprise; or
b) a prominent public office in an international organization, for example, director, deputy director, member of the board or an equivalent function.`
  
    
	    $("#div_UK-FCL-00184_0").hide()
	    $("#div_UK-FCL-00180_0").parent().append("<p style='text-align: justify'>"+msg+"</p>")
		$("#div_UK-FCL-00180_0").hide()
		$("#div_UK-FCL-00185_0").hide()
		$("#div_UK-FCL-00181_0").hide()
		$("#div_UK-FCL-00182_0").hide()
		$("#div_UK-FCL-00183_0").hide()
		$("#div_UK-FCL-00207_0").hide()
		$("#div_UK-FCL-00207_0").hide()
		$("#div_UK-FCL-00261_0").hide()
		
		$("#UK-FCL-00146_0").attr("min",3)
		$("#UK-FCL-00167_0").attr("min",1)
		$("#UK-FCL-00176_0").attr("min",1)
//secratery push intrest	

//truserer  add to intrest
var addTrusrer=function()
{
	$("#"+this.id).on("click",function(){
	
	var d=$("#UK-FCL-00162_0").val()+" "+$("#UK-FCL-00163_0").val()+" "+$("#UK-FCL-00164_0").val()
	var k=$("#UK-FCL-00157_0").val()+" "+$("#UK-FCL-00158_0").val()+" "+$("#UK-FCL-00159_0").val()
	   d=d.trim()
	if(status==0)
	{
	if(d.length >0 && d!==" ")
	{
		if($("#add_more_654").find("tbody").find('.sec').length>0)
		{
             $("#add_more_654").find("tbody").find('.sec').remove()
		s=`
			<tr class="add_more_654 sec">
			<td><input class="form-control" name="UK-FCL-00184_0[]" readonly="readonly"  type="text" value="`+d+`" aria-invalid="false" /></td>
			<td><select name="UK-FCL-00180_0[]"><option value="yes">yes</option><option value="no">no</option></select></td>
			<td><input class="form-control input1"  required="required" name="UK-FCL-00181_0[]"  type="text" value="" /></td>
			<td><input class="form-control input1"  required="required" name="UK-FCL-00185_0[]"  type="text" value="" /></td>
			<td><input class="form-control input1"  required="required" name="UK-FCL-00182_0[]"  type="date" value="" /></td>
			<td><input class="form-control input1"  required="required" name="UK-FCL-00183_0[]"  type="date" value="" /></td>
			<td><input class="form-control input1"  required="required" name="UK-FCL-00261_0[]"  type="text" value="" /></td>
			</tr>`
		$("#add_more_654").find("tbody").append(s)

		}
		
	

		
	}
	
	   k=k.trim()
	if(k.length!== 0 && k!==" ")
	{
		obj.push(k)
				
	}
	status==1
    }
	$("#add_more_654").show()
	// genrateTable()
})

}
 //addTrusrer.call({"id":"div_UK-FCL-00178_0"})




let obj=[];
//postalcode
$("body").find("#UK-FCL-00228_0").on("change",function(){
	 
	if($(this).val()){
		$("#UK-FCL-00094_0").html();
	console.log($(this).val())
				$.ajax({
		            type: "POST",
		            dataType:'html',
		            url: "/backoffice/infowizard/subFormRegistrationCharity/getpostalcode?id=" + $(this).val(),
		            beforeSend:function(){
		            /*	if ($("#UK-FCL-00129_0-error").length) {
					$("#UK-FCL-00129_0-error").text("Please enter the correct postal code");
    			}else{*/
    				$("#UK-FCL-00228_0-error").text("Please Wait...");
    				//$("#div_UK-FCL-00129_0").find('div').append('<div id="UK-FCL-00129_0-error" class="form-control-feedback">Please Wait...</div>');
    			//}	
		        	        	
		            },
		            success: function(result) {	  
						console.log(result)       		            		
            			$("#UK-FCL-00094_0-error").text("Please Wait...");		         
            		    $("#UK-FCL-00094_0").html(result);	
            		   // alert(result);	
					   console.log(result)            	
		            			              
		            }
		        });
		}	
});


$("body").find("#UK-FCL-00387_0").on("change",function(){
	 
	 if($(this).val()){
		 
		$("#UK-FCL-00407_0").html(); 
				 $.ajax({
					 type: "POST",
					 dataType:'html',
					 url: "/backoffice/infowizard/subFormRegistrationCharity/getstate?id=" + $(this).val(),
					 beforeSend:function(){
					 /*	if ($("#UK-FCL-00129_0-error").length) {
					 $("#UK-FCL-00129_0-error").text("Please enter the correct postal code");
				 }else{*/
					 $("#UK-FCL-00329_0-error").text("Please Wait...");
					 //$("#div_UK-FCL-00129_0").find('div').append('<div id="UK-FCL-00129_0-error" class="form-control-feedback">Please Wait...</div>');
				 //}	
								 
					 },
					 success: function(result) {	  
						     		            		
						 $("#UK-FCL-00129_0-error").text("");		         
						 $("#UK-FCL-00407_0").html(result);	
						// alert(result);	
						console.log(result)            	
											   
					 }
				 });
		 }	
 });
 $("body").find("#UK-FCL-00388_0").on("change",function(){
	
	 if($(this).val()){
		$("#UK-FCL-00408_0").html();
	 console.log($(this).val())
				 $.ajax({
					 type: "POST",
					 dataType:'html',
					 url: "/backoffice/infowizard/subFormRegistrationCharity/getstate?id=" + $(this).val(),
					 beforeSend:function(){
					 /*	if ($("#UK-FCL-00129_0-error").length) {
					 $("#UK-FCL-00129_0-error").text("Please enter the correct postal code");
				 }else{*/
					 $("#UK-FCL-00329_0-error").text("Please Wait...");
					 //$("#div_UK-FCL-00129_0").find('div').append('<div id="UK-FCL-00129_0-error" class="form-control-feedback">Please Wait...</div>');
				 //}	
								 
					 },
					 success: function(result) {	  
							      		            		
						 $("#UK-FCL-00129_0-error").text("");		         
						 $("#UK-FCL-00408_0").html(result);	
						// alert(result);	
						           	
											   
					 }
				 });
		 }	
 });
 $("body").find("#UK-FCL-00389_0").on("change",function(){
	$("#UK-FCL-00410_0").html(); 
	 if($(this).val()){
		 
	 console.log($(this).val())
				 $.ajax({
					 type: "POST",
					 dataType:'html',
					 url: "/backoffice/infowizard/subFormRegistrationCharity/getstate?id=" + $(this).val(),
					 beforeSend:function(){
					 /*	if ($("#UK-FCL-00129_0-error").length) {
					 $("#UK-FCL-00129_0-error").text("Please enter the correct postal code");
				 }else{*/
					 $("#UK-FCL-00329_0-error").text("Please Wait...");
					 //$("#div_UK-FCL-00129_0").find('div').append('<div id="UK-FCL-00129_0-error" class="form-control-feedback">Please Wait...</div>');
				 //}	
								 
					 },
					 success: function(result) {	  
						     		            		
						 $("#UK-FCL-00129_0-error").text("");		         
						 $("#UK-FCL-00410_0").html(result);	
						// alert(result);	
						console.log(result)            	
											   
					 }
				 });
		 }	
 });
 $("body").find("#UK-FCL-00392_0").on("change",function(){
	 
	 if($(this).val()){
		$("#UK-FCL-00393_0").html();
		 
	 console.log($(this).val())
				 $.ajax({
					 type: "POST",
					 dataType:'html',
					 url: "/backoffice/infowizard/subFormRegistrationCharity/getstate?id=" + $(this).val(),
					 beforeSend:function(){
					 /*	if ($("#UK-FCL-00129_0-error").length) {
					 $("#UK-FCL-00129_0-error").text("Please enter the correct postal code");
				 }else{*/
					 $("#UK-FCL-00329_0-error").text("Please Wait...");
					 //$("#div_UK-FCL-00129_0").find('div').append('<div id="UK-FCL-00129_0-error" class="form-control-feedback">Please Wait...</div>');
				 //}	
								 
					 },
					 success: function(result) {	  
							   		            		
						 $("#UK-FCL-00129_0-error").text("");		         
						 $("#UK-FCL-00393_0").html(result);	
						// alert(result);	           	
											   
					 }
				 });
		 }	
 });

                    
 

var maxCharAlowed= function() 
     {
      $("#" +this.id).attr("maxlength",this.max)
     
      // $("#"+this.id).parent('div').append("<div style='color:red;'>only " +this.max+ " char allowed </div>")
     }

     maxCharAlowed.call({"id":"UK-FCL-00136_0","max":4000})
     maxCharAlowed.call({"id":"UK-FCL-00111_0","max":200})
     maxCharAlowed.call({"id":"UK-FCL-00130_0","max":500})
     maxCharAlowed.call({"id":"UK-FCL-00156_0","max":500})
     maxCharAlowed.call({"id":"UK-FCL-00148_0","max":1000})
     maxCharAlowed.call({"id":"UK-FCL-00160_0","max":100})
     maxCharAlowed.call({"id":"UK-FCL-00161_0","max":100})
     maxCharAlowed.call({"id":"UK-FCL-00152_0","max":1000})
     maxCharAlowed.call({"id":"UK-FCL-00225_0","max":500})
     maxCharAlowed.call({"id":"UK-FCL-00165_0","max":100})
     maxCharAlowed.call({"id":"UK-FCL-00166_0","max":1000})
     maxCharAlowed.call({"id":"UK-FCL-00226_0","max":500})
     maxCharAlowed.call({"id":"UK-FCL-00168_0","max":100})
     maxCharAlowed.call({"id":"UK-FCL-00169_0","max":500})
     maxCharAlowed.call({"id":"UK-FCL-00173_0","max":500})
     maxCharAlowed.call({"id":"UK-FCL-00174_0","max":500})
     maxCharAlowed.call({"id":"UK-FCL-00175_0","max":500})


	 $("#div_UK-FCL-00153_0").find("label").append('<span style="color:red;"> *</span>')
	 $("#div_UK-FCL-00154_0").find("label").append('<span style="color:red;"> *</span>')
	 $("#div_UK-FCL-00155_0").find("label").append('<span style="color:red;"> *</span>')
	 $("#div_UK-FCL-00156_0").find("label").append('<span style="color:red;"> *</span>')
	 $("#div_UK-FCL-00380_0").find("label").append('<span style="color:red;"> *</span>')
	 $("#div_UK-FCL-00387_0").find("label").append('<span style="color:red;"> *</span>')
	 $("#div_UK-FCL-00160_0").find("label").append('<span style="color:red;"> *</span>')
	 $("#div_UK-FCL-00407_0").find("label").append('<span style="color:red;"> *</span>')
	 $("#div_UK-FCL-00386_0").find("label").append('<span style="color:red;"> *</span>')
	 $("#div_UK-FCL-00168_0").find("label").append('<span style="color:red;"> *</span>')
	 $("#div_UK-FCL-00169_0").find("label").append('<span style="color:red;"> *</span>')
	 $("#div_UK-FCL-00390_0").find("label").append('<span style="color:red;"> *</span>')
	 $("#div_UK-FCL-00129_0").find("label").append('<span style="color:red;"> *</span>')
	 $("#div_UK-FCL-00170_0").find("label").append('<span style="color:red;"> *</span>')
     $("#div_UK-FCL-00177_0").find("label").append('<span style="color:red;"> *</span>')

	
	


     
})
let obj=[];

var  genrateTable= function()
	{
		var s="";

		

		for(var i=0;i<obj.length;i++)
		{

		
		s+=`
			<tr class="add_more_654">
			<td><input class="form-control" name="UK-FCL-00184_0[]" readonly="readonly"  type="text" value="`+obj[i]+`" aria-invalid="false" /></td>
			<td><select name="UK-FCL-00180_0[]"><option value="yes">Yes</option><option value="no">No</option></select></td>
			<td><input class="form-control input1"  required="required" name="UK-FCL-00181_0[]"  type="text" value="" /></td>
			<td><input class="form-control input1"  required="required" name="UK-FCL-00185_0[]"  type="text" value="" /></td>
			<td><input type="date" autocomplete="off"  name="UK-FCL-00182_0[]" class="datepicker cuurent input1 form-control "></td>
			<td><input type="date" autocomplete="off"  name="UK-FCL-00183_0[]" class="datepicker cuurent input1 form-control "></td>
			<td><input class="form-control input1"  required="required" name="UK-FCL-00261_0[]"  type="text" value="" /></td>
			</tr>`
		}
		s+=`
			<tr class="add_more_654">
			<td><input class="form-control" name="UK-FCL-00184_0[]"   type="text" value="" aria-invalid="false" /></td>
			<td><select name="UK-FCL-00180_0[]"><option value="yes">Yes</option><option value="no">No</option></select></td>
			<td><input class="form-control input1" required="required" name="UK-FCL-00181_0[]"  type="text" value="" /></td>
			<td><input class="form-control input1" required="required" name="UK-FCL-00185_0[]"  type="text" value="" /></td>
			<td><input type="date" autocomplete="off"  name="UK-FCL-00182_0[]" class="datepicker cuurent input1 form-control "></td>
			<td><input type="date" autocomplete="off"  name="UK-FCL-00183_0[]" class="datepicker cuurent input1 form-control "></td>
			<td><input class="form-control input1" required="required" name="UK-FCL-00261_0[]"  type="text" value="" /></td>
			</tr>`

		// $("#title_UK-FCL-00001_0").hide()
	
		// $("#title_UK-FCL-00001_0").parent().hide()

		// var t=$("#tbl_533").parent()
		// $("#tbl_533").remove()
		// t.html(s)
		// console.log(t)
		
		$("#add_more_654").find("tbody").html(s)
		 $("#add_more_654").find('th:last, td:last').remove()
		$("#add_more_654").show()
        $("[name='UK-FCL-00180_0[]']").on("change",function(){
	       console.log($(this).parent().parent())
		   if($(this).val() =="no")
		   {
			 $(this).parent().parent().find(".input1").attr("disabled","disabled")
			 $(this).parent().parent().find(".input1").removeAttr("required","required")
			 
			
			
		    }
			else{
				
				$(this).parent().parent().find(".input1").removeAttr("disabled","disabled")
				$(this).parent().parent().find(".input1").attr("required","required")
			}
		 
     })
		

	}	 


function addmoreaction(id,service_id,div_id){
 	if(div_id==1594){
		
		if(parseInt($("#UK-FCL-00146_0").val()) == parseInt($("[name='UK-FCL-00153_0[]']").length))
						{
							$(".errorDetail").remove()
							$(".trustee").remove()
	                 	   $(".banker").remove()
							$("#UK-FCL-00146_0").parent().parent().append("<p class='trustee' style='color:red'>No more of trustee allowed  </p>")
							
							e.stop();
							e.preventDefault();
							return false
						}else{
							var d=  $("#UK-FCL-00153_0").val()
                                +" "+$("#UK-FCL-00154_0").val()+
                                " "+$("#UK-FCL-00155_0").val()
                        d=d.trim()
							if(d.length!== 0 && d!==" "){
                                  if(obj.length==0)
                                  {
                                    obj.push(d)
                                  console.log(obj)

                                  }else{
                                    obj=[]
                                    var input1=$("[name='UK-FCL-00153_0[]']")
                                    var input2=$("[name='UK-FCL-00154_0[]']")
                                    var input3=$("[name='UK-FCL-00155_0[]']")
                                   
                                    for(var i=0;i<input1.length;i++){
                                      var a=input1[i]
                                      var b=input2[i]
                                      var c=input3[i]
                                      var q=a.value+" "+
                                      b.value+" "+ 
                                      c.value
                                    obj.push(q)

                                  }
                                   obj.push(d)
                                   console.log(obj)
                                  }
                                  }
								  genrateTable()
								  
				
						}
						
	}else{
		if(div_id==560){

			if(parseInt($("#UK-FCL-00167_0").val()) == parseInt($("[name='UK-FCL-00168_0[]']").length))
						{
							$(".errorDetail").remove()
							$(".trustee").remove()
		                    $(".banker").remove()
							$("#UK-FCL-00167_0").parent().parent().append("<p class='banker' style='color:red'>No more of bannker allowed  </p>")
							$(".trustee").hide()
							e.stop();
							e.preventDefault();
							return false
						}
		}
		else{
			if(div_id==382){
			if(parseInt($("#UK-FCL-00176_0").val()) == parseInt($("[name='UK-FCL-00177_0[]']").length))
						{
							
							$(".errorDetail").remove()
							$(".trustee").remove()
	                     	$(".banker").remove()
							$("#UK-FCL-00176_0").parent().parent().append("<p style='color:red'>No more  properties  allowed </p>")
							
							
							e.stop();
							e.preventDefault();
							return false
						}
		}
			
		}
		$(".trustee").remove()
		$(".banker").remove()
	}
	
						
 	$.ajax({
			type: "GET",
			dataType: 'json',
			data: {"button_id": id, "service_id": service_id, "add_more_button_di": div_id},
			 url: "<?php echo Yii::app()->request->baseUrl; ?>/infowizard/formFieldMaster/getAddmoreData",
			success: function (data) {
				console.log(data);
				var tr_ = "<tr class='add_more_"+div_id+"'>";
				var td_ = '';
				var err = 0;
				var fieldsIDArr = new Array();
				$.each(data, function (key, item) {
					var id = item.id;
					var vall;
					var typeVal;
					var name = item.full_name;
					var formchk_id = item.formchk_id;
					var selector = $('[name="' + formchk_id + '"]');
					var cls = '';
				
					if ($(selector).is("input")) {
						if ($("input:radio[name='" + formchk_id + "']").attr('type') == 'radio') {
							vall = $("input:radio[name='" + formchk_id + "']:checked").val();
							typeVal = 'radio';
							$("input:radio[name='" + formchk_id + "']").addClass('val');
							if ($("input:radio[name='" + formchk_id + "']").hasClass('val')) {
								cls = 'val';
							}
						}else if ($("input[name='" + formchk_id + "']").attr('type') == 'number') {
							vall = $("input[name='" + formchk_id + "']").val();
							typeVal = 'number';
							$("input[name='" + formchk_id + "']").addClass('val');
							if ($("input[name='" + formchk_id + "']").hasClass('val')) {
								cls = 'val';
							}							
						}
						else {
							vall = $("input[name='" + formchk_id + "']").val();
							typeVal = 'text';
							$("input:text[name='" + formchk_id + "']").addClass('val');
							if ($("input[name*='" + formchk_id + "']").hasClass('val')) {
								cls = 'val';
							}
							
						}
					}

					else if ($(selector).is("select") || $('#' + formchk_id).is("select")) {						
						if ($('#' + formchk_id).prop('multiple')) {
							typeVal = 'multiple';
							var selMulti = $.map($("#" + formchk_id + " option:selected"), function (el, i) {
								return $(el).text();
							});
							vall = selMulti.join(", ");
							$('#' + formchk_id).addClass('val');
							if ($('#' + formchk_id).hasClass('val')) {
								cls = 'val';
							}
							$("#" + formchk_id + " option").removeAttr("selected");
						}
						else {	
							typeVal = 'dropdown';
							vall = $("select[name='" + formchk_id + "'] option:selected").text();
							$("select[name='" + formchk_id + "']").addClass('val');	
							if ($("select[name='" + formchk_id + "']").hasClass('val')) {
								cls = 'val';
							}
							$("#" + formchk_id + " option").removeAttr("selected");
						}
					}
					else if ($(selector).is("textarea")) {	
						typeVal = 'textarea';
						vall = $("textarea[name='" + formchk_id + "']").val();
						$("textarea[name='" + formchk_id + "']").addClass('val');
						if ($("textarea[name='" + formchk_id + "']").hasClass('val')) {
							cls = 'val';
						}
					}
					else if ($('.chk_' + formchk_id).is(':checkbox')) {
						typeVal = 'checkbox';
						vall = $('.chk_' + formchk_id + ':checked').map(function () {
							return this.value;
						}).get().join(',');
						$('.chk_' + formchk_id).addClass('val');
						if ($('.chk_' + formchk_id).hasClass('val')) {
							cls = 'val';
						}	
					}

					if (cls == 'val' && (vall == '' || vall == 'undefined' || vall == 'Please Select ')) {
						if(div_id==1594){
				               
							if(trustemiddlename==1)
									{
										
										if(formchk_id=='UK-FCL-00153_0' ||formchk_id=='UK-FCL-00154_0'|| formchk_id=='UK-FCL-00155_0' || formchk_id=='UK-FCL-00156_0' ||formchk_id=='UK-FCL-00380_0' ||formchk_id=='UK-FCL-00387_0'|| formchk_id=='UK-FCL-00148_0 '||  formchk_id=='UK-FCL-00160_0'||formchk_id=='UK-FCL-00387_0'||formchk_id=='UK-FCL-00407_0'||formchk_id=='UK-FCL-00163_0'){
									
									var labelData = $("#label_" + formchk_id).text();
								labelData=labelData.replace('('+formchk_id+')',"");
								//alert(formchk_id);
								$(".errorDetail").remove()
								$("#div_"+formchk_id).append("<span style='color:red;padding-left:16px;' class='errorDetail'>Please fill the required field: "+$.trim(labelData)+"</span>");						
								err = err + 1;
								return false;
								}else{
									$(".errorDetail").remove();
									td_ += "<td><input type='text' name='" + formchk_id + "[]' value='" + vall + "' class='form-control' readonly/></td>";
												fieldsIDArr.push(formchk_id);		
								}	
									}
									else{
										
										if(formchk_id=='UK-FCL-00153_0' || formchk_id=='UK-FCL-00155_0' || formchk_id=='UK-FCL-00156_0' ||formchk_id=='UK-FCL-00380_0' ||formchk_id=='UK-FCL-00387_0'|| formchk_id=='UK-FCL-00148_0 '||  formchk_id=='UK-FCL-00160_0'||formchk_id=='UK-FCL-00387_0'||formchk_id=='UK-FCL-00407_0'||formchk_id=='UK-FCL-00163_0'){
									
										var labelData = $("#label_" + formchk_id).text();
									labelData=labelData.replace('('+formchk_id+')',"");
									//alert(formchk_id);
									$(".errorDetail").remove()
									$("#div_"+formchk_id).append("<span style='color:red;padding-left:16px;' class='errorDetail'>Please fill the required field: "+$.trim(labelData)+"</span>");						
									err = err + 1;
									return false;
									}else{
										$(".errorDetail").remove();
										td_ += "<td><input type='text' name='" + formchk_id + "[]' value='" + vall + "' class='form-control' readonly/></td>";
													fieldsIDArr.push(formchk_id);		
									}	
								}
						}	
						if(div_id==560){
                          $("#UK-FCL-00170_0").val("Barbados")
								if(formchk_id=='UK-FCL-00168_0' || formchk_id=='UK-FCL-00169_0' || formchk_id=='UK-FCL-00170_0'|| formchk_id=='UK-FCL-00390_0'|| formchk_id=='UK-FCL-00129_0'){
										var labelData = $("#label_" + formchk_id).text();
									labelData=labelData.replace('('+formchk_id+')',"");
									//alert(formchk_id);
									$(".errorDetail").remove()
									$("#div_"+formchk_id).append("<span style='color:red;padding-left:16px;' class='errorDetail'>Please fill the required field: "+$.trim(labelData)+"</span>");						
									err = err + 1;
									return false;
									}else{
										$(".errorDetail").remove();
										td_ += "<td><input type='text' name='" + formchk_id + "[]' value='" + vall + "' class='form-control' readonly/></td>";
													fieldsIDArr.push(formchk_id);		
									}	
						}			
            if(div_id==382){
								if(formchk_id=='UK-FCL-00177_0' ){
										var labelData = $("#label_" + formchk_id).text();
									labelData=labelData.replace('('+formchk_id+')',"");
									//alert(formchk_id);
									$(".errorDetail").remove()
									$("#div_"+formchk_id).append("<span style='color:red;padding-left:16px;' class='errorDetail'>Please fill the required field: "+$.trim(labelData)+"</span>");						
									err = err + 1;
									return false;
									}else{
										$(".errorDetail").remove();
										td_ += "<td><input type='text' name='" + formchk_id + "[]' value='" + vall + "' class='form-control' readonly/></td>";
													fieldsIDArr.push(formchk_id);		
									}	
						}					
					}
					else {
						$(".errorDetail").remove();
						//console.log(typeVal);
						td_ += "<td><input type='text' name='" + formchk_id + "[]' value='" + vall + "' class='form-control' readonly/></td>";
						fieldsIDArr.push(formchk_id);						
					}

				}); 
				if (err == 0) {
					//alert(JSON.stringify(fieldsIDArr));
					$('#add_more_' + div_id).show();
					$('#tbl_' + div_id).show();
					td_ += "<td style='text-align:center;'><a class='btn btn-danger del_1' pi='add_more_"+div_id+"'><i class='fa fa-trash' aria-hidden='true'></i></a></td>";
					tr_ += td_ + "</tr>";
					$(tr_).appendTo($('#tbl_' + div_id));
					//alert(fieldsIDArr);
					fieldsIDArr.forEach(myFunction);
					function myFunction(value, index, array) {	
						$("input:radio[name='" + value + "']").prop('checked', false);
						$('#' + value).val("");
						$("#" + value + "").select2("val", "");
						$('.chk_' + value + ':checked').removeAttr('checked');
					}
			
				} else
					return false;
                                    
				$('.del_1').on('click', function () {					
					$(this).closest('tr').remove();
					var uio= $(this).attr('pi');
					if($("."+uio).length<2){
						$("#"+uio).css('display','none');
					}
                                        
				});
			} // success function close here
		}); //ajax end here
 }


</script>