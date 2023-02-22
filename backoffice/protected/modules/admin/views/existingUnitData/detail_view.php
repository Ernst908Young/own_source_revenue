<div class="portlet-body" >
<div class="mt-element-step">
	
	<div class="row step-thin print_hide">
	   
		<div class="col-md-12 bg-grey  mt-step-col ">
			<h4> Details of Industrial Unit : <?php  echo !empty($data['swcs_id'])?$data['swcs_id']:'';   ?></h4>
			
		</div>
		
	</div>
	
   
</div>


<section class="panel site-min-height" id="div_print">
 
  
    <div class="panel-body">
	<h2>Main Particulars </h2>
	<table class="table table-scrollable table-lg mt-lg mb-0" width="100%">
			<tr>
				<td><b>Name of Enterprise</b></td> 
				<td><?php echo $data['alies_name']." ".$data['enterprise_name']; ?></td>
				<td><b>Name of Promoter/Propietor/Director</b></td>
				<td><?php echo $data['sub_name']." ".$data['proprietor_name']; ?></td>
			</tr>
			<tr>
				<td><b>Constitution of Enterprise</b></td>
				<td><?php //echo $data['sub_name']." ".$data['proprietor_name']; ?></td>
				<td><b>For the Financial Year</b></td>
				<td><?php //echo $data['sub_name']." ".$data['proprietor_name']; ?></td>
			</tr>
			<tr>
				<td><b>Location of the Enterprise</b></td>
				<td><?php echo $data['address']; ?></td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			
			
		</table>
		<br>
		
		<h2>Registration Details</h2>
	    <table class="table table-scrollable table-lg mt-lg mb-0" width="100%">
			<tr>
				<td><b>Registration Type</b></td> 
				<td><?php echo !empty($data['registration_type'])?$data['registration_type']:''; ?></td>
				<td><b>Registration No.</b></td>
				<td><?php echo !empty($data['registration_no'])?$data['registration_no']:''; ?></td>
			</tr>
			<tr>
				<td><b>Date of Registration</b></td>
				<td><?php echo !empty($data['registration_date'])?$data['registration_date']:''; ?></td>
				<td><b>Registration Certificate</b></td>
				<td><?php echo !empty($data['certificate_name'])?$data['certificate_name']:''; ?></td>
			</tr>
			<tr>
				<td><b>Date of Production</b></td>
				<td><?php echo !empty($data['date_of_production'])?$data['date_of_production']:''; ?></td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			
			
		</table>
		<br>
		<h2>Contact and Location Particulars</h2>
	    <table class="table table-scrollable table-lg mt-lg mb-0" width="100%">
			<tr>
				<td><b>District</b></td> 
				<td><?php echo !empty($data['districtid'])?$data['districtid']:''; ?></td>
				<td><b>Block</b></td>
				<td><?php echo !empty($data['blockid'])?$data['blockid']:''; ?></td>
			</tr>
			<tr>
				<td><b>Panchayat</b></td>
				<td><?php echo !empty($data['panchayat'])?$data['panchayat']:''; ?></td>
				<td><b>Village</b></td>
				<td><?php echo !empty($data['village'])?$data['village']:''; ?></td>
			</tr>
			<tr>
				<td><b>Address of Enterprise</b></td>
				<td><?php echo !empty($data['address'])?$data['address']:''; ?></td>
					<td><b>Mobile No.</b></td>
				<td><?php echo !empty($data['mobile_no'])?$data['mobile_no']:''; ?></td>
			
			</tr>
			
			<tr>
				<td><b>Email Address</b></td>
				<td><?php echo !empty($data['emailid'])?$data['emailid']:''; ?></td>
					<td><b>Land Line</b></td>
				<td><?php echo !empty($data['phone_no'])?$data['phone_no']:''; ?></td>
			
			</tr>
			<tr>
				<td><b>Working/Closed</b></td>
				<td><?php echo (!empty($data['enterprise_status']) && ($data['enterprise_status']==1))?'Working':'Closed'; ?></td>
					<td><b>Closed Since (Estimated)</b></td>
				<td>Month: <?php echo !empty($data['closing_month'])?$data['closing_month']:''; ?>   Year: <?php echo !empty($data['closing_year'])?$data['closing_year']:''; ?></td>
			
			</tr>
			<tr>
				<td><b>Plot No.</b></td>
				<td><?php echo !empty($data['plot_no'])?$data['plot_no']:''; ?></td>
					<td><b>Plot Status</b></td>
				<td><?php echo !empty($data['plot_status'])?$data['plot_status']:''; ?></td>
			
			</tr>
			<tr>
				<td><b>No. of Plots</b></td>
				<td><?php echo !empty($data['no_of_plot'])?$data['no_of_plot']:''; ?></td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			
			</tr>
			
			
		</table>
		
		
		<br>
		<h2>Other Details</h2>
	    <table class="table table-scrollable table-lg mt-lg mb-0" width="100%">
			<tr>
				<td><b>Social Category</b></td> 
				<td><?php echo !empty($data['districtid'])?$data['districtid']:''; ?></td>
				<td><b>Physically Handicapped</b></td>
				<td><?php echo (!empty($data['physical_handicapped']) && ($data['physical_handicapped']==2))?'No':'Yes'; ?></td>
			</tr>
			<tr>
				<td><b>Freedom Fighter/Ex. Serviceman</b></td>
				<td><?php echo (!empty($data['freedom_exserviceman']) && ($data['freedom_exserviceman']==2))?'No':'Yes'; ?></td>
				<td><b>Financial Status</b></td>
				<td><?php echo (!empty($data['financial_status']) && ($data['financial_status']==1))?'Self Financed':'Partially Financed By Bank/Institution'; ?></td>
			</tr>
			<tr>
				<td><b>Has The Enterprise benefited from any Subsidy FromState/Central government </b></td>
				<td><?php echo (!empty($data['govt_subsidy']) && ($data['govt_subsidy']==2))?'No':'Yes';  ?></td>
					<td><b>Amount ( In Lakh )</b></td>
				<td><?php echo !empty($data['subsidy_amt'])?$data['subsidy_amt']:'0.00'; ?></td>
			
			</tr>
			
			<tr>
				<td><b>Policy Under Enterprise is Established</b></td>
				<td><?php echo !empty($data['schemeids'])?$data['schemeids']:''; ?></td>
					<td>&nbsp;</td>
				<td>&nbsp;</td>
			
			</tr>
			
			
		</table>
		
		<br>
		<h2>Product Description</h2>
	    <table class="table table-scrollable table-lg mt-lg mb-0" width="100%">
			<tr>
				<td><b>Activity Description</b></td> 
				<td><?php echo !empty($data['product_description'])?$data['product_description']:''; ?></td>
				<td><b>2 Digits NIC Code</b></td>
				<td><?php echo !empty($data['digit_code_2'])?$data['digit_code_2']:''; ?></td>
			</tr>
			<tr>
				<td><b>5 Digits NIC Code</b></td>
				<td><?php echo !empty($data['digit_code_5'])?$data['digit_code_5']:''; ?></td>
				<td><b>Nature of Activity</b></td>
				<td><?php echo (!empty($data['enterprise_nature']) && ($data['enterprise_nature']==1))?'Manufacturing':'Service'; ?></td>
			</tr>
			<tr>
				<td><b>Category of Enterprise </b></td>
				<td><?php if(!empty($data['enterprise_category']) && ($data['enterprise_category']==1)){
					  echo 'Micro';
				}else if(!empty($data['enterprise_category']) && ($data['enterprise_category']==2)){
					  echo 'Small';
				}else if(!empty($data['enterprise_category']) && ($data['enterprise_category']==3)){
					echo 'Medium';
				}else{
					echo 'Large';
				}?>

				</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
		</table>
		<br>
		
		<h2>Investment Details <small>(In Lakh)</small></h2>
	    <table class="table table-scrollable table-lg mt-lg mb-0" width="100%">
			<tr>
				<td><b>Investment in Plant & Machinery</b></td> 
				<td><?php echo !empty($data['plant_mechanory'])?$data['plant_mechanory']:''; ?></td>
				<td><b>Investment in Equipments</b></td>
				<td><?php echo !empty($data['equipment'])?$data['equipment']:'0.00'; ?></td>
			</tr>
			<tr>
				<td><b>Investment in Land</b></td>
				<td><?php echo !empty($data['land'])?$data['land']:'0.00'; ?></td>
				<td><b>Investment in Building</b></td>
				<td><?php echo !empty($data['building'])?$data['building']:'0.00'; ?></td>
			</tr>
			<tr>
				<td><b>Other Investments</b></td>
				<td><?php  echo !empty($data['other_investment'])?$data['other_investment']:'0.00';?></td>
				<td><b>Total Investment</b></td>
				<td><?php echo !empty($data['total_investment'])?$data['total_investment']:'0.00'; ?></td>
			
			</tr>
			<tr>
				<td><b>Export Oriented ?</b></td>
				<td><?php echo (!empty($data['export_oriented']) && ($data['export_oriented']==1))?'Yes':'No'; ?></td>
				<td><b>Annual Capacity of Production</b></td>
				<td><?php echo !empty($data['annual_capacity'])?$data['annual_capacity']:''; ?></td>
			</tr>
			<tr>
				<td><b>Unit of Production</b></td>
				<td><?php echo !empty($data['unitid'])?$data['unitid']:''; ?></td>
				<td><b>Annual Sales Volume</b></td>
				<td><?php echo !empty($data['sale_volume'])?$data['sale_volume']:''; ?></td>
			</tr><tr>
				<td><b>Currency</b></td>
				<td><?php echo !empty($data['currencyid'])?$data['currencyid']:''; ?></td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
		</table>
		
		<br>
		
		<h2>Employment Details</h2>
	    <table class="table table-scrollable table-lg mt-lg mb-0" width="100%">
			<tr>
				<td><b>Local Employment ( From Uttarakhand )</b></td> 
				<td>Male: <?php echo !empty($data['uttarakhand_male'])?$data['uttarakhand_male']:'0'; ?> Female: <?php echo !empty($data['uttarakhand_female'])?$data['uttarakhand_female']:'0'; ?></td>
				<td><b>Outside Employment ( From Other States )</b></td>
				<td>Male: <?php echo !empty($data['other_male'])?$data['other_male']:'0'; ?> Female: <?php echo !empty($data['other_female'])?$data['other_female']:'0'; ?></td>
			</tr>
			<tr>
				<td><b>Total Employment <small>( Uttarakhand + Other States )</small></b></td>
				<td><?php echo !empty($data['total_employment'])?$data['total_employment']:'0'; ?></td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			
		</table>
 </div>
 
 <input type="button" value="Print" class="btn btn-primary hide_me" onclick="printMe();">
 <a class="dt-button buttons-print btn btn-primary hide_me" href="<?=Yii::app()->createAbsoluteUrl('admin/existingUnitData/index');?>"><span>View List</span></a>
 
 </section>
 
 
</div> 
       
   
	



