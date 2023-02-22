<?php
// @SANTOSH FOR Offline/Online
// Date - 24-10-2017

@extract($_GET);
//$service_id = $service_id;
//$sub_service_id = $sub_service_id;
//$caf_id = $caf_id;
?>
<style>
.mt-element-step .step-thin .mt-step-title a{font-size:14px; font-weight:bold;}
.mt-step-number .bg-white .font-grey{font-size:16px;}
.col-md-2{width:20%;}
</style>

<section class="panel site-min-height">
 
  
    <div class="panel-body">
	
		
<div class="form form-horizontal" role="form">
	<div class="row" style="margin-left:20px;">
	<div class="form-group col-md-12">
		<h1>Thank You</h1>
	</div>
	<br><br>
	<br><br>
	<p>
	  Your Application submitted successfully. Your Offline application reference number is : <b><?php echo $datas['offline_application_reference_number']; ?></b>
	</p>
	</div>

		
	</div>
  
</section>


