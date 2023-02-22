<?php
// @SANTOSH FOR Offline/Online
// Date - 24-10-2017

@extract($_GET);
$invData = ApplyServiceExt::getInvestorDetails();
?>
<style>
.mt-element-step .step-thin .mt-step-title a{font-size:14px; font-weight:bold;}
.mt-step-number .bg-white .font-grey{font-size:16px;}
.col-md-2{width:20%;}
a:hover{ color:#000;}
</style>
<div class="portlet-body">
<div class="mt-element-step">
	
	<div class="row step-thin">
	   
		<div class="col-md-2 bg-grey  mt-step-col ">
			<div class="mt-step-number bg-white font-grey">1</div>
			<div class="mt-step-title uppercase font-grey-cascade"><a href="#" >Documents</a></div>
			<div class="mt-step-content font-grey-cascade"> Listing</div>
		</div>
		<div class="col-md-2 bg-green  mt-step-col ">
			<div class="mt-step-number bg-white font-grey">2</div>
			<div class="mt-step-title uppercase font-grey-cascade"><a href="#" >Statutory</a></div>
			<div class="mt-step-content font-grey-cascade"> Form</div>
		</div>
		 <div class="col-md-2 bg-grey  mt-step-col ">
			<div class="mt-step-number bg-white font-grey">3</div>
			<div class="mt-step-title uppercase font-grey-cascade"><a href="#" >Payment</a></div>
			<div class="mt-step-content font-grey-cascade"> Form</div>
		</div>
		 <div class="col-md-2 bg-grey  mt-step-col ">
			<div class="mt-step-number bg-white font-grey">4</div>
			<div class="mt-step-title uppercase font-grey-cascade"><a href="#" >Application</a></div>
			
			<div class="mt-step-content font-grey-cascade"> Preview</div>
		</div>
		 <div class="col-md-2 bg-grey  mt-step-col ">
			<div class="mt-step-number bg-white font-grey">5</div>
			<div class="mt-step-title uppercase font-grey-cascade">
<a href="#" >Mode of</a></div>
			<div class="mt-step-content font-grey-cascade"> Submission</div>
		</div>
		 <!--<div class="col-md-2 bg-grey  mt-step-col ">
			<div class="mt-step-number bg-white font-grey">6</div>
			<div class="mt-step-title uppercase font-grey-cascade"><a href="" >Others</a></div>
			<div class="mt-step-content font-grey-cascade"> Form</div>
		</div> -->
		
	</div>
	
   
</div>
</div>
<form name="form" action="" method="POST" enctype="multipart/form-data">
	<input type="hidden" name="service_id" value='<?php echo $service_id; ?>' />
	<input type="hidden" name="sub_service_id" value='<?php echo $sub_service_id; ?>' />
	<input type="hidden" name="appID" value='<?php echo $appID; ?>' />
	<input type="hidden" name="caf_id" value='<?php echo $caf_id; ?>' />
<section class="panel site-min-height">
 
  
    <div class="panel-body">
	<div class="table">
		
		<table class="table table-scrollable table-lg mt-lg mb-0" width="100%">
			<tr>
				<td><b>Name</b></td>
				<td><?php echo $invData['first_name']." ".$invData['last_name']; ?></td>
				<td><b>IUID</b></td>
				<td><?php echo $invData['iuid']; ?></td>
			</tr>
			<tr>
				<td><b>CAF ID</b></td>
				<td><?php echo $caf_id; ?></td>
				<td><b>Phone number</b></td>
				<td><?php echo $invData['mobile_number']; ?></td>
			</tr>
			<tr>
				<td><b>Email ID</b></td>
				<td><?php echo $invData['email']; ?></td>
				<td></td>
				<td></td>
			</tr>
		</table>
		<br>
	
<div class="row">
	<div class="form-group col-md-12">
	<label class="col-lg-4 col-sm-4 control-label" for="mode_of_submission" >Download format of Statutory form :</label>
                        <div class="col-md-6" style="padding-top:8px;">
<?php if (!empty($subservivcesData['statutory_form_upload'])) { ?>
		<a href="<?php echo $subservivcesData['statutory_form_upload']; ?>" target="_blank">Download</a>
		<?php  } ?>
		</div></div></div>
		
	
	
	 <div class="row">                   
	<div class="form-group col-md-12">
			<label class="col-lg-4 col-sm-4 control-label" for="submitted_to" >Upload filled Statutory form<span class="required" aria-required="true"> * </span></label>
                        <div class="col-md-6" style="padding-top:8px;" >
						<input type="file" id="statutory_form" name="statutory_form"  required/>
						
		</div>
		</div></div>
	
	
	<div class="row">                   
	<div class="form-group col-md-12">
			<label class="col-lg-4 col-sm-4 control-label" for="submitted_to" >Any Other documents <span class="required" aria-required="true"> </span></label>
                        <div class="col-md-8" style="padding-top:8px;" >
						<div class="row" style="padding-left:20px;">
						<div id="acilpprAdd" countadd="0" style="float:left;">
						<input type="text" name="document_name[]"   /> &nbsp;&nbsp;&nbsp;&nbsp;
						<input type="file" name="other_doc[]"   />&nbsp;&nbsp;&nbsp;&nbsp;</div>
							<button style="float:left;" class="add_button btn btn-success" type="button" rel="acilpprAdd">Add</button></div>
							<p class="acilpprAdd"></p>
			
						
		</div>
		</div></div>
                             


	
	</div>
	<div class="row buttons" align="center">
	<input type="submit" value="Save & Continue" class="btn btn-primary">
	</div>
	</div>
  
</section>
</form>
<script>
    
    $(document).ready(function () {
	$(".add_button").click(function(){
	var gh=$(this).attr("rel");

		var kl=$("#"+gh).attr("countadd");
	if(kl==5){return false;}
	    var ty=	$("#"+gh).html();
	$("."+gh).append('<div class="row"  style="padding-left:20px;">'+ty+"<a href='javascript:void(0)' class='btn btn-danger rmv'>Remove</a><div>");

	$("#"+gh).attr("countadd",parseInt(kl)+1);
		$(".rmv").click(function(){
	$(this).parent('div').remove();
	});
	});

	
      });
   

</script>