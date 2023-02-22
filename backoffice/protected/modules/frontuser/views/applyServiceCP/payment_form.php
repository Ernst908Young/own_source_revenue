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
		<div class="col-md-2 bg-grey  mt-step-col ">
			<div class="mt-step-number bg-white font-grey">2</div>
			<div class="mt-step-title uppercase font-grey-cascade"><a href="#" >Statutory</a></div>
			<div class="mt-step-content font-grey-cascade"> Form</div>
		</div>
		 <div class="col-md-2 bg-green  mt-step-col ">
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
		 <!-- <div class="col-md-2 bg-grey  mt-step-col ">
			<div class="mt-step-number bg-white font-grey">6</div>
			<div class="mt-step-title uppercase font-grey-cascade"><a href="" >Others</a></div>
			<div class="mt-step-content font-grey-cascade"> Form</div>
		</div> -->
		
	</div>
	
   
</div>
</div>

<form name="form" action="" method="POST" enctype="multipart/form-data" >
	<input type="hidden" name="service_id" value='<?php echo $service_id; ?>' />
	<input type="hidden" name="sub_service_id" value='<?php echo $sub_service_id; ?>' />
	<input type="hidden" name="appID" value='<?php echo $appID; ?>' />
	<input type="hidden" name="caf_id" value="<?php echo $caf_id;?>" />
<section class="panel site-min-height">
 
  
<div class="panel-body">
<table class="table table-scrollable table-lg mt-lg mb-0" width="100%">
			<tr>
				<td><b>Name</b></td>
				<td><?php echo $invData['first_name']." ".$invData['last_name']; ?></td>
				<td><b>IUID</b></td>
				<td><?php echo $invData['iuid']; ?></td>
			</tr>
			<tr>
				<td><b>Phone number</b></td>
				<td><?php echo $invData['mobile_number']; ?></td>
				<td><b>CAF ID</b></td>
				<td><?php echo $caf_id; ?></td>
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
			<label class="col-lg-4 col-sm-4 control-label" for="application_name" >Fees to be submitted for Application :</label>
                        <div class="col-md-6" style="padding-top:8px;"><b><?php if (!empty($paymentData['is_fee_submitted'])) { $ee=$paymentData['is_fee_submitted']; if($ee=='Y') { echo "YES"; } }?> </b>
                            
		</div>
		
                        <div class=" col-md-12" style="padding-top:20px;">
                           <p> <?php echo "Please click on fees structure to view the required fees for the application.";?> </p>
		</div>
	
	
	
		
	
	<div class="form-group col-md-12">
			<label class="col-lg-4 col-sm-4 control-label" for="application_name" >Fee Structure</label>
                        <div class="col-md-6" style="padding-top:8px;">
						<?php if (!empty($paymentData['upload_fee_structure'])) {  
		echo CHtml::link('View Uploaded',$paymentData['upload_fee_structure'], array('target'=>'_blank')); } ?>
                            
                          
		</div>
		</div>
	
	
	<div class="form-group col-md-12">
			<label class="col-lg-4 col-sm-4 control-label" for="application_name" >Allowed Mode of Payments</label>
                        <div class="col-md-6" style="padding-top:8px;">
                        <?php if (!empty($paymentData['paymeny_mode'])) {  $paymeny_modedata=$paymentData['paymeny_mode']; }else{$paymeny_modedata='4,1,2';}  ?>
                           <select name="payment_mode" class="form-control cri acilppr" id="payment_mode">
<?php  
$sql = "SELECT id,payment_mode_name FROM  bo_information_wizard_payment_mode where is_active='Y' and id IN ($paymeny_modedata) ";
  //$sql = "SELECT id,payment_mode_name FROM  bo_information_wizard_payment_mode where is_active='Y' ";
$connection = Yii::app()->db;
$command = $connection->createCommand($sql);
$AllIssuer = $command->queryAll();
echo "<option value=''><-----Select-----></option>";
if (isset($AllIssuer)) {
foreach ($AllIssuer as $v) {
echo "<option value='$v[id]'>$v[payment_mode_name]</option>";
}
}
?>
</select>


		</div>
		</div>
                     
	
	<div class="form-group col-md-12 treasury allhide">
			<label class="col-lg-4 col-sm-4 control-label" for="application_name" > Treasury Head Details :</label>
                        <div class="col-md-6" style="padding-top:8px;"><b><?php if (!empty($paymentData['upload_fee_structure'])) { 
						echo $paymentData['treasury_head_detail']; }?></b>
                            
                          
		</div>
		</div>
                           
                      
		
                        
                           <div class="form-group col-md-12 bankDetail allhide">
			<label class="col-lg-4 col-sm-4 control-label" for="application_name" >Bank Details [Account Holder Name]</label>
                        <div class="col-md-6" style="padding-top:8px;">
                            <b><?php if (!empty($paymentData['bank_account_holder_name'])) { echo $paymentData['bank_account_holder_name']; }?></b>
                          
		</div>
		</div>  
                           <div class="form-group col-md-12 bankDetail allhide">
			<label class="col-lg-4 col-sm-4 control-label" for="application_name" >Bank Account Number</label>
                        <div class="col-md-6" style="padding-top:8px;">
                            <b><?php if (!empty($paymentData['bank_account_number'])) { echo $paymentData['bank_account_number']; }?></b>
                          
		</div>
		</div>  
                           <div class="form-group col-md-12 bankDetail  allhide">
			<label class="col-lg-4 col-sm-4 control-label" for="application_name" >Bank Name </label>
                        <div class="col-md-6" style="padding-top:8px;">
                           <b><?php if (!empty($paymentData['bank_name'])) { echo $paymentData['bank_name']; }?></b>
                          
		</div>
		</div>  
                           <div class="form-group col-md-12 bankDetail allhide">
			<label class="col-lg-4 col-sm-4 control-label" for="application_name" >Bank IFSC Code</label>
                        <div class="col-md-6" style="padding-top:8px;">
                           <b><?php if (!empty($paymentData['bank_ifsc_code'])) { echo $paymentData['bank_ifsc_code']; }?></b>
                          
		</div>
		</div>  
                            
                        
                           <div class="form-group col-md-12">
			<label class="col-lg-4 col-sm-4 control-label" for="application_name" >Reference No.</label>
                        <div class="col-md-6" style="padding-top:8px;">
                            <input type="text" name="reference_no" id="reference_no" class="form-control" required />
                          
		</div>
                        
                        
		</div>  
		
		<div class="form-group col-md-12">
			<label class="col-lg-4 col-sm-4 control-label" for="application_name" >Fee Details in INR :</label>
                        <div class="col-md-6" style="padding-top:8px;"><?php $amt =0; if (!empty($paymentData['fee_detail'])) { 
						$amt =  $paymentData['fee_detail']; } ?>
						<input type="text" name="fee_amount" value="<?php echo $amt; ?>" class="form-control">
                            
		</div>
		</div>
		
		<div class="form-group col-md-12">
			<label class="col-lg-4 col-sm-4 control-label" for="application_name" >Upload Fee receipt:</label>
				<div class="col-md-6" style="padding-top:8px;">
					<input type="file" name="fee_receipt" required>
				</div>
		</div>
                           <!--<div class="form-group col-md-12">
			<label class="col-lg-4 col-sm-4 control-label" for="application_name" >Note *</label>
                        <div class="col-md-6" style="padding-top:8px;">
                           <p> <?php echo "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five ";?> </p>
                          
		</div>
                        
                        
                        
	</div> -->

	<div class="col-md-12" align="center">
	<input type="submit" value="Save" class="btn btn-primary" >
	</div>    

</div></div>

</div>
</section>
</form>


<script>
    
    $(document).ready(function(){
             $(".allhide").hide(); 
            $("#payment_mode").change(function(){ 
                  $(".allhide").hide(); 
                 $(".treasury").hide(); 
                if($(this).val()=="1"){
              $(".treasury").show();  
          }
		  if($(this).val()=="2"){
              $(".treasury").show();  
          }
                if($(this).val()=="4"){
              $(".bankDetail").show();  
          }
                
            });
        })

</script>