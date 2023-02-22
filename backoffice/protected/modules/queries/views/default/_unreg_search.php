<style type="text/css">
.form-control{
  height: 36px;
}
  .form-control, output{
    font-size: 16px;
    color: #000;
  }
  #captcharesult{
    display: none;
  }
</style>


<div class="portlet box green">
    <div class="portlet-title">
        <div class="caption">
            <!-- <i style=" font-size:20px;" class="fa fa-question-circle"></i> -->
            <span style="font-size: 18px; color:#19649b;">Search Your Existing Query</span></div>
        <div class="tools"> </div> 
    </div>
    <div class="portlet-body">
        <div class="panel-body">
        	<?php if(Yii::app()->user->hasFlash('error')):?>

    <h5 style="text-align: center; color: red;">

        <?php echo Yii::app()->user->getFlash('error'); ?>

    </h5>

<?php endif; ?>
				<form id="unregsearchform" method="post" action="<?php echo Yii::app()->createAbsoluteUrl("/queries/default/unregsearch"); ?>">
<?php
$q_code=$email='';
if(Yii::app()->user->hasFlash('q_code'))$q_code=Yii::app()->user->getFlash('q_code');
if(Yii::app()->user->hasFlash('email'))$email=Yii::app()->user->getFlash('email');
?>
<input type="hidden" name="YII_CSRF_TOKEN" value="<?php echo Yii::app()->request->csrfToken; ?>"/>
	<div class="row">
	   	<div class="form-group col-md-3">
	   		<label style="font-size: 18px;">Query ID <span style="color: red;">*</span></label>
	   		<input type="text" name="q_code" id="q_code" class="form-control" placeholder="Enter Query ID" value="<?php echo $q_code;?>">
	   		<span id='qiderror'></span>
	   	</div>
	   	<div class="form-group col-md-5">
	   		<label style="font-size: 18px;">Email<span style="color: red;">*</span></label>
	   		<input type="text" name="email" class="form-control" id='email' placeholder="Enter your Email" value="<?php echo $email;?>">
	   		<span id='result'></span>
	   	</div>
  <div class="form-group col-md-4">
      <p><b>Solve this captcha</b></p>
    <div class="d-flex justify-content-start">
       <div class="d-flex justify-content-start">
      <span class="captchainput" id="capnum1" name="capnum1"></span>
      <span class="captchainput" id="capsign" name="capsign" style="width:35px !important;">+</span>
      <span class="captchainput" id="capnum2"  name="capnum2"></span>
      <span class=""id="captcharesult"  name="captcharesult"></span>
      <!--input class="captchainput" id="capnum1" name="capnum1" type="text" value="" readonly >
      <input class="captchainput" type="text" id="capsign" name="capsign" value="+" readonly style="width:35px !important;">
      <input class="captchainput" type="text" value="" id="capnum2"  name="capnum2" readonly >
      <input class="" type="hidden" value="" id="captcharesult"  name="captcharesult" readonly -->
      </div>
      <div class="d-flex justify-content-start">
        <p class="mt-3">=</p>
        <input class="form-control" type="text" value="" id="capnum3" name="capnum3" style="width:50px;margin-left:15px;">
        <a  class="mt-3 ml-3" href="javascript:void(0);" onclick="getCaptcha()">Refresh Captcha</a>
      </div>
         
    </div> <br>
    <span id="captchaerror" style="color:red"></span>
    <span id="captchasuccess" style="color:green"></span>  
  </div>

	   	<div class="form-group col-md-3">
	   		<span id='validate' onclick="validate()" class="btn btn-primary" style="font-size: 18px; text-align: center; width: 120px;">Search</span>
	   	    
	   	    </div>
	</div>

   </form>
		</div>		
	</div>
</div>

<script type="text/javascript">
function validateQueryId(query_id){
	var regex=  new RegExp("^[0-9]*$"); 
	
	//var maxLength = $(this).attr('maxlength');
	var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
	return regex.test(query_id);
}
	function validateEmail(email) {
  const re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return re.test(email);
}

function validate() {
 const $result = $("#result");
  const email = $("#email").val();
 var qid = $("#q_code").val();
   var error=0;
 if(!qid){
 	$("#qiderror").text("This field is required");
 	$("#qiderror").css("color", "red");
 	error=1;
 }
 else if (!validateQueryId(qid)) { 
		error=1;
    	$("#qiderror").text("Invalid Query ID");
    	$("#qiderror").css("color", "red");
	}
	else{
		$("#qiderror").text("");
	}
 if(!email){
 	
 	$("#result").text("This field is required");
 	$("#result").css("color", "red");
	error=1;
 	
 } else  if (!validateEmail(email)) {
   error=1;
    $result.text("Invalid Email ID");
    $result.css("color", "red");
  } else{
	 $result.text(""); 
  } if($("#capnum3").val() == ""){
    $("#captchaerror").html( "Please Verify Captcha");
    $("#capnum3").focus();
    error=1;
  } else {
       var num1 = $("#capnum1").html();
        var num2 = $("#capnum2").html();
        var total = parseInt(num1) + parseInt(num2);
        var input = $("#capnum3").val();
        if (input == total) {
          error=0;
        }else{
         error=1;
        }
  }
 
  if(error==0){
   $result.text("");  
   document.getElementById("unregsearchform").submit();  
  }
  return false;
}


function getCaptcha(){
    var num1 = Math.floor((Math.random() * 30));
    var num2 = Math.floor((Math.random() * 10));
    var total = parseInt(num1) + parseInt(num2);
    $("#capnum1").html(num1);
    $("#capnum2").html(num2);
    $("#captcharesult").html(total);
    $("#capnum3").val("");  
 }

$(window).on( "load", function() {
        getCaptcha();   
    });

$("#capnum3").keyup(function() {
  var num1 = $("#capnum1").html();
  var num2 = $("#capnum2").html();
  var total = parseInt(num1) + parseInt(num2);
  var input = $(this).val();
  if (input == total) {
    $("#captchaerror").html("");
    $("#captchasuccess").html("Captcha verified successfully");
  }else{
    $("#captchaerror").html("Invalid Captcha");
    $("#captchasuccess").html("");
  }

});

//$("#validate").on("click", validate);
</script>