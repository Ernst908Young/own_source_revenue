<style type="text/css">
.comment_section{
	display: inline;
	background: #ddd;
	color:red;
	resize: none;
	padding: 5px 15px 5px 15px;
}
.apprvr_comments{
	display: inline;
	background: #F7F7F7;
	color:#222;
	resize: none;
	padding: 5px 15px 5px 15px;  
}
td.heading{
	font-family: verdana,arial,sans-serif;
	padding: 8px;
	background-color: #dedede;
	text-align: center;
	font-weight: bold;
	font-size: 1.0em;
}
.cblue{
	color:#0000ff;
}
div.heading{
	border-width: 1px solid;
	padding: 8px;
	border-style: solid;
	border-color: #000000;
	background-color: #dedede;
	text-align: center;
	font-size: 1.1em;
}
table.gridtable {
	font-family: verdana,arial,sans-serif;
	font-size: 1.4em;
	color:#333333;
	width: 100%;
	border-width: 0.5px solid;
	border-color: #000000;
}
table.gridtable th {
	border-width: .5px solid;
	padding: 8px;
	border-style: solid;
	border-color: #000000;
	background-color: #dedede;
	text-align: center;
	font-size: 0.9em;
}
table.gridtable td {
	font-size: 0.9em;
}
.brtd, th, td{
	border: 0.5px solid black;
	border-collapse: collapse;
}
.control-label{
	font-size: 0.9em;
	font-weight: 800;
	height: 20px;
	text-align: left;
}
::-webkit-input-placeholder { font-size:.9em;font-weight: bold }
::-moz-placeholder { font-size:.9em; font-weight: bold}
:-ms-input-placeholder { font-size:.9em; font-weight: bold}
input:-moz-placeholder { font-size:.9em; font-weight: bold}
</style>

<div class="site-min-height">    
<?php
$app_name=ApplicationExt::getAppNameViaId($data['application_id']);
$fields = json_decode($data['field_value']);

/* echo "<pre>"; 
print_r($fields);
 
echo $service_id;
die();  */
?>

<table cellpadding="2" cellspacing="0" border="0" class="gridtable">
	<tr>
		<td>Application Name</td>
		<td colspan="2"><?php echo 'Existing Enterprise'; ?></td>
		<td>Application Id</td>
		<td colspan="2"><?php echo @$data['submission_id']; ?></td>
	</tr>	
</table>

<table cellpadding="2" cellspacing="0" border="0" class="gridtable">
	<tr>
		<th colspan="6" style="text-align:center;font-weight:bold;font:16px;">Single Window Registration Details</th>
	</tr>
	<tr>
		 <td>IUID</td>
         <td colspan="2"><?=@$fields->IUID?></td>
         <td>Name of Registered User</td>
         <td colspan="2"><?=@$fields->auth_name?></td>
	</tr>
	<tr>
		 <td>Email of Registered User</td>
         <td colspan="2"><?=@$fields->auth_email?></td>
         <td>Mobile no Registered User</td>
         <td colspan="2"><?=@$fields->auth_mob?></td>
	</tr>
	<tr>
		 <td>Fax No. (with STD Code) of Registered User</td>
         <td colspan="2"><?=@$fields->auth_fax?></td>
         <td>Land line number (with STD Code) of Registered User</td>
         <td colspan="2"><?=@$fields->auth_tel?></td>
	</tr>		
	<tr>
		<th colspan="6" style="text-align:center;font-weight:bold;font:14px;">Organisation Details</th>
	</tr>
	<tr>
		 <td>Name of the Organization</td>
         <td colspan="2"><?=@$fields->company_name?></td>
         <td>Nature of Organization</td>
		 <?php $natureOfOrganisation = ApplicationExt::getNatureOfOrganisationById(@$fields->nature_of_organization);?>
         <td colspan="2"><?=@$natureOfOrganisation;?></td>
	</tr>	
	<?php	
	if($fields->nature_of_organization=='1'){ ?>
	<tr class="sole_proprietorship">		
		<td colspan="6">
			<table>
				<tr>
					<td>Name of Proprietor</td>
					<td>Proprietor Category</td>
					<td>Proprietor's PAN Number</td>					
				</tr>
				<tr>
					<td><?=@$fields->name_of_proprietor; ?></td>
					<td><?=@$fields->proprietor_category; ?></td>
					<td><?=@$fields->proprietor_pan_number; ?></td>
				</tr>			
			</table>		
		</td>
	</tr>
	<?php } ?>
	<?php if($fields->nature_of_organization=='2'){ ?>
	<tr class="limited_liability_partnership">		
		<td colspan="6">
			<table>
				<tr>
					<td>LLP Id. No.</td>
					<td>Partner Name</td>
					<td>Partner Category</td>					
					<td>Share Holding</td>					
					<td>Designated Partner Id</td>					
				</tr>
				<?php
				if(isset($fields->limited_liability_partnership->llp_id_no))
				{
					foreach($fields->limited_liability_partnership->llp_id_no as $kl=>$vl){ 

						 echo "<tr>

									<td>".@$fields->limited_liability_partnership->llp_id_no[$kl]."</td>

									<td>".@$fields->limited_liability_partnership->partner_name[$kl]."</td>

									<td>".@$fields->limited_liability_partnership->partnercategory[$kl]."</td>
									
									<td>".@$fields->limited_liability_partnership->share_holding[$kl]."</td>
									
									<td>".@$fields->limited_liability_partnership->partner_id[$kl]."</td>

								  </tr>";

					}
				}
				?>	
			</table>		
		</td>
	</tr>
	<?php } ?>
	<?php if($fields->nature_of_organization=='3'){ ?>
	<tr class="partnership_firm">		
		<td colspan="6">
			<table>
				<tr>
					<td>Partner Name</td>
					<td>Partner Category</td>
					<td>Partner Share Holding</td>					
					<td>Partnership PAN Number</td>	
				</tr>
				<?php
				if(isset($fields->partnership_firm->firm_partner_name))
				{
					foreach($fields->partnership_firm->firm_partner_name as $kp=>$vp){

						 echo "<tr>
									<td>".@$fields->partnership_firm->firm_partner_name[$kp]."</td>

									<td>".@$fields->partnership_firm->firm_partner_category[$kp]."</td>

									<td>".@$fields->partnership_firm->firm_share_holding[$kp]."</td>
									
									<td>".@$fields->partnership_firm->partnership_pan_number[$kp]."</td>

								  </tr>";

					}
				}
				?>	
			</table>		
		</td>
	</tr>
	<?php } ?>
	<?php if($fields->nature_of_organization=='4'){ ?>
	<tr class="opc">		
		<td colspan="6">
			<table>
				<tr>
					<td>OPC Member Name</td>
					<td>OPC Member Category</td>
					<td>OPC Nominee Name</td>					
					<td>OPC PAN Number</td>					
				</tr>
				<tr>
					<td><?=@$fields->opc_member_name; ?></td>
					<td><?=@$fields->opc_member_category; ?></td>
					<td><?= @$fields->opc_nominee_name; ?></td>
					<td><?= @$fields->opc_pan_number; ?></td>
				</tr>			
			</table>		
		</td>
	</tr>
	<?php }?>
	<?php if($fields->nature_of_organization=='5'){ ?>
	<tr class="private_limited_company">		
		<td colspan="6">
			<table>
				<tr>
					<td>CIN-Company Identification Number</td>
					<td>MD/CEO/Lead Promoter Name</td>
					<td>MD/CEO/Lead Promoter Category</td>		
				</tr>
				<tr>
					<td><?=@$fields->cin; ?></td>
					<td><?=@$fields->promoter_name; ?></td>
					<td><?=@$fields->promoter_category; ?></td>
				</tr>			
			</table>		
		</td>
	</tr>
	<?php }?>
	<?php if($fields->nature_of_organization=='6'){ ?>
	<tr class="public_limited_company">		
		<td colspan="6">
			<table>
				<tr>
					<td>CIN-Company Identification Number</td>						
				</tr>
				<tr>
					<td><?=@$fields->cin_public; ?></td>
				</tr>			
			</table>		
		</td>
	</tr>
	<?php }?>
	<?php if($fields->nature_of_organization=='8'){ ?>
	<tr class="operative_society">		
		<td colspan="6">
			<table>
				<tr>
					<td>Society Registration Number - Uttarakhand</td>						
				</tr>
				<tr>
					<td><?=@$fields->society_registration; ?></td>
				</tr>			
			</table>		
		</td>
	</tr>
	<?php }?>	
	<tr>
		 <td>PAN Number</td>
         <td colspan="2"><?=@$fields->company_pan?></td> 
		 <td>GSTIN Number</td>
         <td colspan="2"><?=@$fields->company_gst?></td>		 
	</tr>
	<tr>
		 <td>Website of the Company</td>
         <td colspan="2"><?=@$fields->website?></td> 
		 <td>Registered Headquarter's Address</td>
         <td colspan="2"><?=@$fields->registered_headquarters?></td>		 
	</tr>
	<tr>
		 <td>State</td>
         <td colspan="2"><?php echo @$state_name = ApplicationExt::getStateNameById(@$fields->state);?></td> 
		 <td>District</td>
         <td colspan="2"><?php echo @$company_district = ApplicationExt::getDistrictNameById(@$fields->company_district);?></td>	 
	</tr>	
	<tr>		
		<td>City</td>
		<td colspan="2"><?php echo @$city = ApplicationExt::getSubDistrictNameCodeById(@$fields->company_sub_district_id);?></td>
		<td>Pin Code</td>
        <td colspan="2"><?php echo @$pin_code;?></td>	
	</tr>
	<tr>		
		<td>Email of Head Quarters</td>
		<td colspan="2"><?=@$fields->email_of_head_quarters?></td>
		<td>Phone no of Head Quarters</td>
		<td colspan="2"><?=@$fields->phone_no_of_head_quarters?></td>
	</tr>
	<tr>		
		<td>Extension</td>
		<td colspan="2"><?=@$fields->extension?></td>
		<td>Fax No of Head Quarters</td>
		<td colspan="2"><?=@$fields->fax_no_of_head_quarters?></td>
	</tr>
	<tr>
		<td>Are You A Startup ?</td>
		<td colspan="2"><?php if(isset($fields->start_up) && $fields->start_up == 'Yes'){ echo "Yes";}else if(isset($fields->start_up) && $fields->start_up == 'No'){ echo "No";}?></td>
		<td>Startup India Registration No.</td>
		<td colspan="2"><?=@$fields->SUI_registration_number?></td>		
	</tr>
	<tr>
		<td>START-UP UTTARAKHAND Registration No.</td>
		<td colspan="5"><?=@$fields->SUU_registration_number?></td>				
	</tr>
	<tr>
		<th colspan="6" style="text-align:center;font-weight:bold;font:14px;">Industrial Association Membership Details</th>
	</tr>
	<tr>
		<td colspan="6">Are you a member of any Industrial Association?.</td>						
	</tr>
	<tr>		
		<td colspan="6" >
		<?php
			if(isset($fields->miscallenous_details))
			{
			$miscellArr = ((array)$fields->miscallenous_details);					  
			foreach($miscellArr as $key=>$val)
			{
				if(isset($val) && $val==1){	$mCd1[] ="Confederation of Indian Industry";}
				if(isset($val) && $val==2){$mCd1[] ="PHD Chamber of Commerce";}
				if(isset($val) && $val==3){$mCd1[] ="Industries Association of Uttarakhand";}
				if(isset($val) && $val==4){$mCd1[] ="Kumaon Garhwal Chamber Of Commerce and Industry";}
				if(isset($val) && $val==5){$mCd1[] ="Himalayan Chamber of Commerce & Industry";}
				if(isset($val) && $val==6){$mCd1[] ="SIIDCUL Manufacturers Association";}
				if(isset($val) && $val==7){$mCd1[] ="Bhagwanpur Industries Association";}
				if(isset($val) && $val==8){$mCd1[] ="Uttarakhand Industrial Welfare Association";}
				if(isset($val) && $val==9){$mCd1[] ="Drug Manufacturing Association Uttarakhand";}
				if(isset($val) && $val==10){$mCd1[] ="Bahadrabad Industries Development Welfare Association";}
				if(isset($val) && $val==11){$mCd1[] ="SIIDCUL Industrial Association";}
				if(isset($val) && $val==12){$mCd1[] ="Prantiya Industries Association";}
				if(isset($val) && $val==13){$mCd1[] ="Roorkee Small Scale Industries Association";}
				if(isset($val) && $val==14){$mCd1[] ="SIIDCUL Industries Association";}
				if(isset($val) && $val==15){$mCd1[] ="Hotels & Restaurants Association of Uttarakhand";}
				if(isset($val) && $val==15){$mCd1[] ="Others";}
			}			
			//$mCD = implode(", ",);		
		  ?>
			<table class="table table-striped table-bordered table-hover responsive-table">
				<?php 
				$i =1;
				foreach($mCd1 as $k=>$v)
				{		
				?>
				<tr>				
					<td colspan="2"><?php echo $v;?></td>
				</tr>
				<?php $i++;
				} ?>
			</table>
		<?php }?>	
		</td>		
	</tr>
	<tr>
		<th colspan="6" style="text-align:center;font-weight:bold;font:14px;">Details of Authorized Person / Coordinator <br/>Same as SWCS registration <?php if(isset($fields->details_of_authorized_person)){ echo "(Yes)";}else{ echo "(No)";}?></th>
	</tr>
	<tr>
		<td>Name of the Authorized Person / Coordinator</td>
		<td colspan="2"><?=@$fields->name_of_the_authorized_person_cordinator?></td>
		<td>Designation of the Authorized Person / Coordinator</td>
		<td colspan="2"><?=@$fields->designation_of_the_authorized_person_coordinator?></td>		
	</tr>
	<tr>
		<td>Email of the Authorized Person / Coordinators</td>
		<td colspan="2"><?=@$fields->auth_email?></td>
		<td>Phone Number of the Authorized Person / Coordinator</td>
		<td colspan="2"><?=@$fields->phone_number_of_the_authorized_person_coordinator?></td>		
	</tr>
	<tr>
		<td>Fax Number of the Authorized Person / Coordinator</td>
		<td colspan="5"><?=@$fields->fax_number_of_the_authorized_person_coordinator?></td>		
	</tr>	
	<tr>
		<th colspan="6" style="text-align:center;font-weight:bold;font:14px;">Unit Details Address</th>
	</tr>
	<tr>
		<td>Name Of Unit</td>
		<td colspan="2"><?=@$fields->unit_name?></td>
		<td>Location of the unit</td>
		<td colspan="2"><?=@$fields->location_of_the_unit?></td>		
	</tr>
	<tr>
		<td>Industrial Area</td>
		<td colspan="2"><?php echo $indarea = ApplicationExt::getIndustrialAreaNameById(@$fields->industrial_area);?></td>
		<td>Unit Address</td>
		<td colspan="2"><?=@$fields->Address?></td>		
	</tr>	
	<tr>
		<td>Plot Area</td>
		<td colspan="2"><?=@$fields->Land_in_Hectares;?></td>
		<td>Area Type</td>
		<td colspan="2"><?=@$fields->area_type?></td>		
	</tr>
	<tr>
		<td>Plot/Khasra No</td>
		<td colspan="2"><?=@$fields->Khasra_no;?></td>
		<td>District</td>
		<td colspan="2"><?php echo @$unit_district = ApplicationExt::getDistrictNameById(@$fields->unit_district);?></td>		
	</tr>
	<tr>
		<td>Tehsils</td>
		<td colspan="2"><?php echo @$thesil = ApplicationExt::getSubDistrictNameCodeById(@$fields->unit_sub_district_id);?></td>
		<td>Village</td>
		<td colspan="2"><?php echo @$unit_village = ApplicationExt::getVillageNameById(@$fields->unit_village);?></td>		
	</tr>
	<tr>
		<td>Block</td>
		<td colspan="2"><?=@$fields->unit_block_id?></td>
		<td>Pin Code</td>
		<td colspan="2"><?=@$fields->pin_code?></td>		
	</tr>
	<tr>
		<td>Email of Unit</td>
		<td colspan="2"><?=@$fields->email?></td>
		<td>Phone no of Unit</td>
		<td colspan="2"><?=@$fields->tel_phone?></td>		
	</tr>
	<tr>
		<td>Extension</td>
		<td colspan="2"><?=@$fields->unit_extension?></td>
		<td>Nature of unit</td>
		<td colspan="2"><?php if (isset($fields->ntrofunit) && $fields->ntrofunit == 'Manufacturing'){ echo "Manufacturing"; }else{ echo "Services";} ?></td>		
	</tr>	
	<?php 
	$Flag=0;	
	if (isset($fields->ntrofunit) && $fields->ntrofunit == 'Manufacturing')
	{
		$Flag=1;
	}
	?>
	<?php if($Flag==1){ ?>
	<tr>
		<th colspan="6" style="text-align:center;font-weight:bold;font:14px;">Raw Material Detail</th>
	</tr>
	<tr>		
		<td colspan="6">
			<table>
				<tr>
					<td>Name of the Raw Material:</td>
					<td>Quantity</td>
					<td>Units of Comsumption</td>
					<td>Source Location</td>
				</tr>
				
					<?php
						if(isset($fields->Name_of_the_Raw_Material)){

							foreach ($fields->Name_of_the_Raw_Material as $k => $v) {								
								if(isset($fields->Annual_Requirement_Unit[$k]) && $fields->Annual_Requirement_Unit[$k]==1){$units='Numbers';}	
								if(isset($fields->Annual_Requirement_Unit[$k]) && $fields->Annual_Requirement_Unit[$k]==2){$units='Metric Tones';}	
								if(isset($fields->Annual_Requirement_Unit[$k]) && $fields->Annual_Requirement_Unit[$k]==3){$units='Liters';}
								if(isset($fields->Annual_Requirement_Unit[$k]) && $fields->Annual_Requirement_Unit[$k]==4){$units='Others';}
								
								if(isset($fields->source_location[$k]) && $fields->source_location[$k]!=37)
								$state_name = ApplicationExt::getStateNameById(@$fields->source_location[$k]);
								else
								$state_name = "Imported";
								
								 echo "<tr>

									<td>".@$fields->Name_of_the_Raw_Material[$k]."</td>

									<td>".@$fields->material_quantity[$k]."</td>

									<td>".@$units."</td>
									<td>".@$state_name."</td>

								  </tr>";
								
							}

						}	
					?>
				
			</table>		
		</td>
	</tr>
	<tr>
		<th colspan="6" style="text-align:center;font-weight:bold;font:14px;">Products Manufacturing / Service Details</th>
	</tr>
	<tr>		
		<td colspan="6">
			<table>
				<tr>
					<td>Product / Service Description</td>
					<td>Annual Install Capacity</td>
					<td>Unit</td>			
				</tr>				
					<?php
						if(isset($fields->Product_Description)){

							foreach($fields->Product_Description as $k1 => $v1) {								
								
								 echo "<tr>
								 
									<td style='text-align:center'>".@$fields->Product_Description[$k1]."</td>
									
									<td style='text-align:center'>".@$fields->Annual_Install_Capacity[$k1]."</td>
									
									<td style='text-align:center'>".@$fields->product_manufactured_Quantity[$k1]."</td>
									
								  </tr>";
								
							}

						}	
					?>
				
			</table>		
		</td>
	</tr>
	<?php } ?>
	<tr>
		<td>NIC 5 Digit Code [comma seprated]</td>
		<td colspan="2"><?=@$fields->nic_digit?></td>
		<td>HSN Code(s) [comma seprated]</td>
		<td colspan="2"><?=@$fields->hsn_code; ?></td>		
	</tr>	
	<tr>
		<td>SAC Code(s) [comma seprated]</td>
		<td colspan="2"><?=@$fields->sac_code?></td>
		<td>Category of Unit as per MSMED Act</td>
		<td colspan="2"><?=@$fields->ntrofunittype; ?></td>	
	</tr>
	<tr>
		<td>Pollution Control Board Categorization</td>
		<td colspan="2"><?=@$fields->type_of_industry?></td>
		<td>Are you an Ancillary Unit?</td>
		<td colspan="2"><?=@$fields->is_unit_ancillary; ?></td>	
	</tr>
	<tr>
		<td>Has the Unit Commenced Operations?</td>
		<td colspan="2"><?=@$fields->has_the_unit_commenced_business?></td>
		<td>Date of Commercial Production</td>
		<td colspan="2"><?=@$fields->expected_date_of_commercial_production; ?></td>	
	</tr>
	<tr>
		<td>Unit Falls under Doon Valley Notification</td>
		<td colspan="5"><?=@$fields->unit_falls_under_doon?></td>		
	</tr>
	<tr>
		<th colspan="6" style="text-align:center;font-weight:bold;font:14px;">Unit Employment Details</th>
	</tr>
	<tr>
		<td colspan="6">
		<?php if (isset($fields->no_of_emp_mtotal)) {
		$incmplt_fields = $fields;
		?>
		<table id="<?php echo $domicile = 'diu'; ?>" class="diu" >       
			<tr class="diu">
				<td style="text-align:center;">Employment</td><td style="text-align:center;"> Skilled </td>
				<td style="text-align:center;">	Unskilled </td><td style="text-align:center;">	Supervisory </td>
				<td style="text-align:center;">Engineer </td><td style="text-align:center;">IT/ ITES Professional</td>
				<td style="text-align:center;">Management </td><td style="text-align:center;"> Total Employees </td>
			</tr>     
			<?php if(isset($incmplt_fields->diu_male_gen_skilled)){ ?>
				<?php if($incmplt_fields->diu_male_gen_total>0){ ?>
				<tr class="diu_m_gen emporg">
					<td>Domiciled In Uttarakhand <br> Male - General</td>
					<td style="text-align:center;"><?php  $fieldName=$domicile."_male_gen_skilled"; ?><?php echo @$incmplt_fields->$fieldName; ?></td>
					<td style="text-align:center;"><?php  $fieldName=$domicile."_male_gen_unskilled"; ?><?php echo @$incmplt_fields->$fieldName; ?></td>
					<td style="text-align:center;"><?php  $fieldName=$domicile."_male_gen_supervisory"; ?><?php echo @$incmplt_fields->$fieldName; ?></td>  
					<td style="text-align:center;"><?php  $fieldName=$domicile."_male_gen_engineer"; ?><?php echo @$incmplt_fields->$fieldName; ?></td> 
					<td style="text-align:center;"><?php  $fieldName=$domicile."_male_gen_it_professional"; ?><?php echo @$incmplt_fields->$fieldName; ?></td> 
					<td style="text-align:center;"><?php  $fieldName=$domicile."_male_gen_management"; ?><?php echo @$incmplt_fields->$fieldName; ?></td> 
					<td style="text-align:center;"><?php  $fieldName=$domicile."_male_gen_total" ; ?><?php echo @$incmplt_fields->$fieldName; ?></td> 
				</tr>
				<?php } ?>
				 <?php if($incmplt_fields->diu_male_sc_total>0){ ?>
				<tr class="diu_m_sc emporg">
					<td>Domiciled In Uttarakhand <br> Male - Scheduled Caste</td>
				   <td style="text-align:center;"><?php  $fieldName=$domicile."_male_sc_skilled"; ?><?php echo @$incmplt_fields->$fieldName; ?></td>
					<td style="text-align:center;"> <?php  $fieldName=$domicile."_male_sc_unskilled"; ?><?php echo @$incmplt_fields->$fieldName; ?></td>
					<td style="text-align:center;"><?php  $fieldName=$domicile."_male_sc_supervisory"; ?><?php echo @$incmplt_fields->$fieldName; ?></td>  
					<td style="text-align:center;"><?php  $fieldName=$domicile."_male_sc_engineer"; ?><?php echo @$incmplt_fields->$fieldName; ?></td> 
					<td style="text-align:center;"><?php  $fieldName=$domicile."_male_sc_it_professional"; ?><?php echo @$incmplt_fields->$fieldName; ?></td> 
				   <td style="text-align:center;"><?php  $fieldName=$domicile."_male_sc_management"; ?><?php echo @$incmplt_fields->$fieldName; ?></td> 
				   <td style="text-align:center;"><?php  $fieldName=$domicile."_male_sc_total" ; ?><?php echo @$incmplt_fields->$fieldName; ?></td>  
				</tr>
				 <?php } ?>
				  <?php if($incmplt_fields->diu_male_st_total>0){ ?>
				<tr class="diu_m_st emporg">
				   <td>Domiciled In Uttarakhand <br> Male - Scheduled Tribe</td>
				   <td style="text-align:center;"><?php  $fieldName=$domicile."_male_st_skilled"; ?><?php echo @$incmplt_fields->$fieldName; ?></td>
				   <td style="text-align:center;"> <?php  $fieldName=$domicile."_male_st_unskilled"; ?><?php echo @$incmplt_fields->$fieldName; ?></td>
				   <td style="text-align:center;"><?php  $fieldName=$domicile."_male_st_supervisory"; ?><?php echo @$incmplt_fields->$fieldName; ?></td>  
				   <td style="text-align:center;"><?php  $fieldName=$domicile."_male_st_engineer"; ?><?php echo @$incmplt_fields->$fieldName; ?></td> 
				   <td style="text-align:center;"><?php  $fieldName=$domicile."_male_st_it_professional"; ?><?php echo @$incmplt_fields->$fieldName; ?></td> 
				   <td style="text-align:center;"><?php  $fieldName=$domicile."_male_st_management"; ?><?php echo @$incmplt_fields->$fieldName; ?></td> 
				   <td style="text-align:center;"><?php  $fieldName=$domicile."_male_st_total" ; ?><?php echo @$incmplt_fields->$fieldName; ?></td>  
				</tr> 
				  <?php } ?>
				  <?php if($incmplt_fields->diu_male_obc_total>0){ ?>
				<tr class="diu_m_obc emporg">
				   <td>Domiciled In Uttarakhand <br> Male - Other Backward Caste</td>
				   <td style="text-align:center;"><?php  $fieldName=$domicile."_male_obc_skilled"; ?><?php echo @$incmplt_fields->$fieldName; ?></td>
				   <td style="text-align:center;"><?php  $fieldName=$domicile."_male_obc_unskilled"; ?><?php echo @$incmplt_fields->$fieldName; ?></td>
				   <td style="text-align:center;"><?php  $fieldName=$domicile."_male_obc_supervisory"; ?><?php echo @$incmplt_fields->$fieldName; ?></td>  
				   <td style="text-align:center;"><?php  $fieldName=$domicile."_male_obc_engineer"; ?><?php echo @$incmplt_fields->$fieldName; ?></td> 
				   <td style="text-align:center;"><?php  $fieldName=$domicile."_male_obc_it_professional"; ?><?php echo @$incmplt_fields->$fieldName; ?></td> 
				   <td style="text-align:center;"><?php  $fieldName=$domicile."_male_obc_management"; ?><?php echo @$incmplt_fields->$fieldName; ?></td> 
				   <td style="text-align:center;"> <?php  $fieldName=$domicile."_male_obc_total" ; ?><?php echo @$incmplt_fields->$fieldName; ?></td>  
				</tr>
				<?php } ?>
				<?php if($incmplt_fields->diu_female_gen_total>0){ ?>
				<tr class="diu_f_gen emporg">
				   <td>Domiciled In Uttarakhand <br> Female - General</td>
				   <td style="text-align:center;"><?php  $fieldName=$domicile."_female_gen_skilled"; ?><?php echo @$incmplt_fields->$fieldName; ?></td>
					<td style="text-align:center;"><?php  $fieldName=$domicile."_female_gen_unskilled"; ?><?php echo @$incmplt_fields->$fieldName; ?></td>
				   <td style="text-align:center;"><?php  $fieldName=$domicile."_female_gen_supervisory"; ?><?php echo @$incmplt_fields->$fieldName; ?></td>  
				   <td style="text-align:center;"><?php  $fieldName=$domicile."_female_gen_engineer"; ?><?php echo @$incmplt_fields->$fieldName; ?></td> 
				   <td style="text-align:center;"><?php  $fieldName=$domicile."_female_gen_it_professional"; ?><?php echo @$incmplt_fields->$fieldName; ?></td> 
				   <td style="text-align:center;"><?php  $fieldName=$domicile."_female_gen_management"; ?><?php echo @$incmplt_fields->$fieldName; ?></td> 
				   <td style="text-align:center;"><?php  $fieldName=$domicile."_female_gen_total" ; ?><?php echo @$incmplt_fields->$fieldName; ?></td>  
				</tr>
				 <?php } ?>
				 <?php if($incmplt_fields->diu_female_sc_total>0){ ?>
				<tr class="diu_f_sc emporg">
				   <td>Domiciled In Uttarakhand <br> Female - Scheduled Caste</td>
				   <td style="text-align:center;"><?php  $fieldName=$domicile."_female_sc_skilled"; ?><?php echo @$incmplt_fields->$fieldName; ?></td>
				   <td style="text-align:center;"><?php  $fieldName=$domicile."_female_sc_unskilled"; ?><?php echo @$incmplt_fields->$fieldName; ?></td>
				   <td style="text-align:center;"><?php  $fieldName=$domicile."_female_sc_supervisory"; ?><?php echo @$incmplt_fields->$fieldName; ?></td>  
				   <td style="text-align:center;"><?php  $fieldName=$domicile."_female_sc_engineer"; ?><?php echo @$incmplt_fields->$fieldName; ?></td> 
				   <td style="text-align:center;"><?php  $fieldName=$domicile."_female_sc_it_professional"; ?><?php echo @$incmplt_fields->$fieldName; ?></td> 
				   <td style="text-align:center;"><?php  $fieldName=$domicile."_female_sc_management"; ?><?php echo @$incmplt_fields->$fieldName; ?></td> 
				   <td style="text-align:center;"><?php  $fieldName=$domicile."_female_sc_total" ; ?><?php echo @$incmplt_fields->$fieldName; ?></td>  
				</tr>
				 <?php } ?>
				 <?php if($incmplt_fields->diu_female_st_total>0){ ?>
				<tr class="diu_f_st emporg">
				   <td>Domiciled In Uttarakhand <br> Female - Scheduled Tribe</td>
				   <td style="text-align:center;"><?php  $fieldName=$domicile."_female_st_skilled"; ?><?php echo @$incmplt_fields->$fieldName; ?></td>
				   <td style="text-align:center;"><?php  $fieldName=$domicile."_female_st_unskilled"; ?><?php echo @$incmplt_fields->$fieldName; ?></td>
				   <td style="text-align:center;"><?php  $fieldName=$domicile."_female_st_supervisory"; ?><?php echo @$incmplt_fields->$fieldName; ?></td>  
				   <td style="text-align:center;"><?php  $fieldName=$domicile."_female_st_engineer"; ?><?php echo @$incmplt_fields->$fieldName; ?></td> 
				   <td style="text-align:center;"><?php  $fieldName=$domicile."_female_st_it_professional"; ?><?php echo @$incmplt_fields->$fieldName; ?></td> 
				   <td style="text-align:center;"><?php  $fieldName=$domicile."_female_st_management"; ?><?php echo @$incmplt_fields->$fieldName; ?></td> 
				   <td style="text-align:center;"><?php  $fieldName=$domicile."_female_st_total" ; ?><?php echo @$incmplt_fields->$fieldName; ?></td>  
				</tr>
				 <?php } ?>
				 <?php if($incmplt_fields->diu_female_st_total>0){ ?>
				<tr class="diu_f_obc emporg">
				   <td>Domiciled In Uttarakhand <br> Female - Other Backward Caste</td>
				   <td style="text-align:center;"><?php  $fieldName=$domicile."_female_obc_skilled"; ?><?php echo @$incmplt_fields->$fieldName; ?></td>
				   <td style="text-align:center;"><?php  $fieldName=$domicile."_female_obc_unskilled"; ?><?php echo @$incmplt_fields->$fieldName; ?></td>
				   <td style="text-align:center;"><?php  $fieldName=$domicile."_female_obc_supervisory"; ?><?php echo @$incmplt_fields->$fieldName; ?></td>  
				   <td style="text-align:center;"><?php  $fieldName=$domicile."_female_obc_engineer"; ?><?php echo @$incmplt_fields->$fieldName; ?></td> 
				   <td style="text-align:center;"><?php  $fieldName=$domicile."_female_obc_it_professional"; ?><?php echo @$incmplt_fields->$fieldName; ?></td> 
				   <td style="text-align:center;"><?php  $fieldName=$domicile."_female_obc_management"; ?><?php echo @$incmplt_fields->$fieldName; ?></td> 
				   <td style="text-align:center;"><?php  $fieldName=$domicile."_female_obc_total" ; ?><?php echo @$incmplt_fields->$fieldName; ?></td>  
				</tr>  
				 <?php } ?>
				<?php $domicile = 'dios'; ?>  
				 <?php if($incmplt_fields->dios_male_gen_total>0){ ?>
				<tr class="dios_m_gen emporg">
				   <td>Domiciled In Other State <br> Male - General</td>
				   <td style="text-align:center;"><?php  $fieldName=$domicile."_male_gen_skilled"; ?><?php echo @$incmplt_fields->$fieldName; ?></td>
				   <td style="text-align:center;"><?php  $fieldName=$domicile."_male_gen_unskilled"; ?><?php echo @$incmplt_fields->$fieldName; ?></td>
				   <td style="text-align:center;"><?php  $fieldName=$domicile."_male_gen_supervisory"; ?><?php echo @$incmplt_fields->$fieldName; ?></td>  
				   <td style="text-align:center;"><?php  $fieldName=$domicile."_male_gen_engineer"; ?><?php echo @$incmplt_fields->$fieldName; ?></td> 
				   <td style="text-align:center;"><?php  $fieldName=$domicile."_male_gen_it_professional"; ?><?php echo @$incmplt_fields->$fieldName; ?></td> 
				   <td style="text-align:center;"><?php  $fieldName=$domicile."_male_gen_management"; ?><?php echo @$incmplt_fields->$fieldName; ?></td> 
				   <td style="text-align:center;"><?php  $fieldName=$domicile."_male_gen_total" ; ?><?php echo @$incmplt_fields->$fieldName; ?></td> 
				</tr>
				 <?php } ?>
				  <?php if($incmplt_fields->dios_male_sc_total>0){ ?>
				<tr  class="dios_m_sc emporg">
				   <td>Domiciled In Other State <br> Male - Scheduled Caste</td>
				   <td style="text-align:center;"><?php  $fieldName=$domicile."_male_sc_skilled"; ?><?php echo @$incmplt_fields->$fieldName; ?></td>
				   <td style="text-align:center;"><?php  $fieldName=$domicile."_male_sc_unskilled"; ?><?php echo @$incmplt_fields->$fieldName; ?></td>
				   <td style="text-align:center;"><?php  $fieldName=$domicile."_male_sc_supervisory"; ?><?php echo @$incmplt_fields->$fieldName; ?></td>  
				   <td style="text-align:center;"><?php  $fieldName=$domicile."_male_sc_engineer"; ?><?php echo @$incmplt_fields->$fieldName; ?></td> 
				   <td style="text-align:center;"><?php  $fieldName=$domicile."_male_sc_it_professional"; ?><?php echo @$incmplt_fields->$fieldName; ?></td> 
				   <td style="text-align:center;"><?php  $fieldName=$domicile."_male_sc_management"; ?><?php echo @$incmplt_fields->$fieldName; ?></td> 
				   <td style="text-align:center;"><?php  $fieldName=$domicile."_male_sc_total" ; ?><?php echo @$incmplt_fields->$fieldName; ?></td> 
				</tr>
				  <?php } ?>
				 <?php if($incmplt_fields->dios_male_st_total>0){ ?>
				<tr class="dios_m_st emporg">
				   <td>Domiciled In Other State <br> Male - Scheduled Tribe</td>
				   <td style="text-align:center;"><?php  $fieldName=$domicile."_male_st_skilled"; ?><?php echo @$incmplt_fields->$fieldName; ?></td>
				   <td style="text-align:center;"><?php  $fieldName=$domicile."_male_st_unskilled"; ?><?php echo @$incmplt_fields->$fieldName; ?></td>
				   <td style="text-align:center;"><?php  $fieldName=$domicile."_male_st_supervisory"; ?><?php echo @$incmplt_fields->$fieldName; ?></td>  
				   <td style="text-align:center;"><?php  $fieldName=$domicile."_male_st_engineer"; ?><?php echo @$incmplt_fields->$fieldName; ?></td> 
				   <td style="text-align:center;"><?php  $fieldName=$domicile."_male_st_it_professional"; ?><?php echo @$incmplt_fields->$fieldName; ?></td> 
				   <td style="text-align:center;"><?php  $fieldName=$domicile."_male_st_management"; ?><?php echo @$incmplt_fields->$fieldName; ?></td> 
				   <td style="text-align:center;"><?php  $fieldName=$domicile."_male_st_total" ; ?><?php echo @$incmplt_fields->$fieldName; ?></td> 
				</tr>
				 <?php } ?>
				<?php if($incmplt_fields->dios_male_obc_total>0){ ?>
				<tr class="dios_m_obc emporg">
				   <td>Domiciled In Other State <br>Male - Other Backward Caste</td>
				   <td style="text-align:center;"><?php  $fieldName=$domicile."_male_obc_skilled"; ?><?php echo @$incmplt_fields->$fieldName; ?></td>
				   <td style="text-align:center;"><?php  $fieldName=$domicile."_male_obc_unskilled"; ?><?php echo @$incmplt_fields->$fieldName; ?></td>
				   <td style="text-align:center;"><?php  $fieldName=$domicile."_male_obc_supervisory"; ?><?php echo @$incmplt_fields->$fieldName; ?></td>  
				   <td style="text-align:center;"><?php  $fieldName=$domicile."_male_obc_engineer"; ?><?php echo @$incmplt_fields->$fieldName; ?></td> 
				   <td style="text-align:center;"><?php  $fieldName=$domicile."_male_obc_it_professional"; ?><?php echo @$incmplt_fields->$fieldName; ?></td> 
				   <td style="text-align:center;"><?php  $fieldName=$domicile."_male_obc_management"; ?><?php echo @$incmplt_fields->$fieldName; ?></td> 
				   <td style="text-align:center;"><?php  $fieldName=$domicile."_male_obc_total" ; ?><?php echo @$incmplt_fields->$fieldName; ?></td> 
				</tr>
				<?php } ?>
				<?php if($incmplt_fields->dios_female_gen_total>0){ ?>
				<tr class="dios_f_gen emporg">	
				   <td>Domiciled In Other State <br>Female - General</td>
				   <td style="text-align:center;"><?php  $fieldName=$domicile."_female_gen_skilled"; ?><?php echo @$incmplt_fields->$fieldName; ?></td>
				   <td style="text-align:center;"><?php  $fieldName=$domicile."_female_gen_unskilled"; ?><?php echo @$incmplt_fields->$fieldName; ?></td>
				   <td style="text-align:center;"><?php  $fieldName=$domicile."_female_gen_supervisory"; ?><?php echo @$incmplt_fields->$fieldName; ?></td>  
				   <td style="text-align:center;"><?php  $fieldName=$domicile."_female_gen_engineer"; ?><?php echo @$incmplt_fields->$fieldName; ?></td> 
				   <td style="text-align:center;"><?php  $fieldName=$domicile."_female_gen_it_professional"; ?><?php echo @$incmplt_fields->$fieldName; ?></td> 
				   <td style="text-align:center;"><?php  $fieldName=$domicile."_female_gen_management"; ?><?php echo @$incmplt_fields->$fieldName; ?></td> 
				   <td style="text-align:center;"><?php  $fieldName=$domicile."_female_gen_total" ; ?><?php echo @$incmplt_fields->$fieldName; ?></td> 
				</tr>
				 <?php } ?>
				<?php if($incmplt_fields->dios_female_sc_total>0){ ?>
				<tr class="dios_f_sc emporg">
				   <td>Domiciled In Other State <br>Female - Scheduled Caste</td>
				   <td style="text-align:center;"><?php  $fieldName=$domicile."_female_sc_skilled"; ?><?php echo @$incmplt_fields->$fieldName; ?></td>
				   <td style="text-align:center;"><?php  $fieldName=$domicile."_female_sc_unskilled"; ?><?php echo @$incmplt_fields->$fieldName; ?></td>
				   <td style="text-align:center;"><?php  $fieldName=$domicile."_female_sc_supervisory"; ?><?php echo @$incmplt_fields->$fieldName; ?></td>  
				   <td style="text-align:center;"><?php  $fieldName=$domicile."_female_sc_engineer"; ?><?php echo @$incmplt_fields->$fieldName; ?></td> 
				   <td style="text-align:center;"><?php  $fieldName=$domicile."_female_sc_it_professional"; ?><?php echo @$incmplt_fields->$fieldName; ?></td> 
				   <td style="text-align:center;"><?php  $fieldName=$domicile."_female_sc_management" ; ?><?php echo @$incmplt_fields->$fieldName; ?></td> 
				   <td style="text-align:center;"><?php  $fieldName=$domicile."_female_sc_total" ; ?><?php echo @$incmplt_fields->$fieldName; ?></td>  
				</tr>
				<?php } ?>
				 <?php if($incmplt_fields->dios_female_st_total>0){ ?>
				<tr  class="dios_f_st emporg">
				   <td>Domiciled In Other State <br>Female - Scheduled Tribe</td>
				   <td style="text-align:center;"><?php  $fieldName=$domicile."_female_st_skilled"; ?><?php echo @$incmplt_fields->$fieldName; ?></td>
				   <td style="text-align:center;"><?php  $fieldName=$domicile."_female_st_unskilled"; ?><?php echo @$incmplt_fields->$fieldName; ?></td>
				   <td style="text-align:center;"><?php  $fieldName=$domicile."_female_st_supervisory"; ?><?php echo @$incmplt_fields->$fieldName; ?></td>  
				   <td style="text-align:center;"><?php  $fieldName=$domicile."_female_st_engineer"; ?><?php echo @$incmplt_fields->$fieldName; ?></td> 
				   <td style="text-align:center;"><?php  $fieldName=$domicile."_female_st_it_professional"; ?><?php echo @$incmplt_fields->$fieldName; ?></td> 
				   <td style="text-align:center;"><?php  $fieldName=$domicile."_female_st_management"; ?><?php echo @$incmplt_fields->$fieldName; ?></td> 
				   <td style="text-align:center;"><?php  $fieldName=$domicile."_female_st_total" ; ?><?php echo @$incmplt_fields->$fieldName; ?></td>  
				</tr>
				 <?php } ?>
				 <?php if($incmplt_fields->dios_female_obc_total>0){ ?>
				<tr class="dios_f_obc emporg">
				   <td>Domiciled In Other State <br>Female - Other Backward Caste</td>
				   <td style="text-align:center;"><?php  $fieldName=$domicile."_female_obc_skilled"; ?><?php echo @$incmplt_fields->$fieldName; ?></td>
				   <td style="text-align:center;"><?php  $fieldName=$domicile."_female_obc_unskilled"; ?><?php echo @$incmplt_fields->$fieldName; ?></td>
				   <td style="text-align:center;"><?php  $fieldName=$domicile."_female_obc_supervisory"; ?><?php echo @$incmplt_fields->$fieldName; ?></td>  
				   <td style="text-align:center;"><?php  $fieldName=$domicile."_female_obc_engineer"; ?><?php echo @$incmplt_fields->$fieldName; ?></td> 
					<td style="text-align:center;"><?php  $fieldName=$domicile."_female_obc_it_professional"; ?><?php echo @$incmplt_fields->$fieldName; ?></td> 
					<td style="text-align:center;"><?php  $fieldName=$domicile."_female_obc_management"; ?><?php echo @$incmplt_fields->$fieldName; ?></td> 
					<td style="text-align:center;"><?php  $fieldName=$domicile."_female_obc_total" ; ?><?php echo @$incmplt_fields->$fieldName; ?></td>  
				</tr> 
				 <?php } ?>    
				
				<?php $domicile = 'difn'; ?>
				 <?php if($incmplt_fields->difn_male_gen_total>0){ ?>
				<tr class="difn_m_gen emporg">
				   <td>Domiciled in Foreign Nationals<br>Male - General</td>
					<td style="text-align:center;"><?php  $fieldName=$domicile."_male_gen_skilled"; ?><?php echo @$incmplt_fields->$fieldName; ?></td>
					<td style="text-align:center;"><?php  $fieldName=$domicile."_male_gen_unskilled"; ?><?php echo @$incmplt_fields->$fieldName; ?></td>
					<td style="text-align:center;"><?php  $fieldName=$domicile."_male_gen_supervisory"; ?><?php echo @$incmplt_fields->$fieldName; ?></td>  
					<td style="text-align:center;"><?php  $fieldName=$domicile."_male_gen_engineer"; ?><?php echo @$incmplt_fields->$fieldName; ?></td> 
					<td style="text-align:center;"><?php  $fieldName=$domicile."_male_gen_it_professional"; ?><?php echo @$incmplt_fields->$fieldName; ?></td> 
					<td style="text-align:center;"><?php  $fieldName=$domicile."_male_gen_management"; ?><?php echo @$incmplt_fields->$fieldName; ?></td> 
					<td style="text-align:center;"><?php  $fieldName=$domicile."_male_gen_total" ; ?><?php echo @$incmplt_fields->$fieldName; ?></td> 
				</tr>
				 <?php } ?>
				  <?php if($incmplt_fields->difn_male_sc_total>0){ ?>
				<tr class="difn_m_sc emporg">
				   <td>Domiciled in Foreign Nationals<br>Male - Scheduled Caste</td>
				   <td style="text-align:center;"><?php  $fieldName=$domicile."_male_sc_skilled"; ?><?php echo @$incmplt_fields->$fieldName; ?></td>
				   <td style="text-align:center;"><?php  $fieldName=$domicile."_male_sc_unskilled"; ?><?php echo @$incmplt_fields->$fieldName; ?></td>
				   <td style="text-align:center;"><?php  $fieldName=$domicile."_male_sc_supervisory"; ?><?php echo @$incmplt_fields->$fieldName; ?></td>  
				   <td style="text-align:center;"><?php  $fieldName=$domicile."_male_sc_engineer"; ?><?php echo @$incmplt_fields->$fieldName; ?></td> 
				   <td style="text-align:center;"><?php  $fieldName=$domicile."_male_sc_it_professional"; ?><?php echo @$incmplt_fields->$fieldName; ?></td> 
				   <td style="text-align:center;"><?php  $fieldName=$domicile."_male_sc_management"; ?><?php echo @$incmplt_fields->$fieldName; ?></td> 
				   <td style="text-align:center;"><?php  $fieldName=$domicile."_male_sc_total" ; ?><?php echo @$incmplt_fields->$fieldName; ?></td> 
				</tr>
				  <?php } ?>
				<?php if($incmplt_fields->difn_male_st_total>0){ ?>
				<tr class="difn_m_st emporg">
				   <td>Domiciled in Foreign Nationals<br>Male - Scheduled Tribe</td>
					<td style="text-align:center;"><?php  $fieldName=$domicile."_male_st_skilled"; ?><?php echo @$incmplt_fields->$fieldName; ?></td>
					<td style="text-align:center;"><?php  $fieldName=$domicile."_male_st_unskilled"; ?><?php echo @$incmplt_fields->$fieldName; ?></td>
					<td style="text-align:center;"><?php  $fieldName=$domicile."_male_st_supervisory"; ?><?php echo @$incmplt_fields->$fieldName; ?></td>  
					<td style="text-align:center;"><?php  $fieldName=$domicile."_male_st_engineer"; ?><?php echo @$incmplt_fields->$fieldName; ?></td> 
					<td style="text-align:center;"><?php  $fieldName=$domicile."_male_st_it_professional"; ?><?php echo @$incmplt_fields->$fieldName; ?></td> 
					<td style="text-align:center;"><?php  $fieldName=$domicile."_male_st_management"; ?><?php echo @$incmplt_fields->$fieldName; ?></td> 
					<td style="text-align:center;"><?php  $fieldName=$domicile."_male_st_total"; ?><?php echo @$incmplt_fields->$fieldName; ?></td>
				</tr>
				<?php } ?>
				 <?php if($incmplt_fields->difn_male_obc_total>0){ ?>
				<tr class="difn_m_obc emporg">
				   <td>Domiciled in Foreign Nationals<br>Male - Other Backward Caste</td>
					<td style="text-align:center;"><?php  $fieldName=$domicile."_male_obc_skilled"; ?><?php echo @$incmplt_fields->$fieldName; ?></td>
					<td style="text-align:center;"><?php  $fieldName=$domicile."_male_obc_unskilled"; ?><?php echo @$incmplt_fields->$fieldName; ?></td>
					<td style="text-align:center;"><?php  $fieldName=$domicile."_male_obc_supervisory"; ?><?php echo @$incmplt_fields->$fieldName; ?></td>  
					<td style="text-align:center;"><?php  $fieldName=$domicile."_male_obc_engineer"; ?><?php echo @$incmplt_fields->$fieldName; ?></td> 
					<td style="text-align:center;"><?php  $fieldName=$domicile."_male_obc_it_professional"; ?><?php echo @$incmplt_fields->$fieldName; ?></td> 
					<td style="text-align:center;"><?php  $fieldName=$domicile."_male_obc_management"; ?><?php echo @$incmplt_fields->$fieldName; ?></td> 
					<td style="text-align:center;"><?php  $fieldName=$domicile."_male_obc_total"; ?><?php echo @$incmplt_fields->$fieldName; ?></td> 
				</tr> 	
				 <?php } ?>
				 <?php if($incmplt_fields->difn_female_gen_total>0){ ?>
				<tr class="difn_f_gen emporg">
				   <td>Domiciled in Foreign Nationals<br>Female - General</td>
					<td style="text-align:center;"><?php  $fieldName=$domicile."_female_gen_skilled"; ?><?php echo @$incmplt_fields->$fieldName; ?></td>
					<td style="text-align:center;"><?php  $fieldName=$domicile."_female_gen_unskilled"; ?><?php echo @$incmplt_fields->$fieldName; ?></td>
					<td style="text-align:center;"><?php  $fieldName=$domicile."_female_gen_supervisory"; ?><?php echo @$incmplt_fields->$fieldName; ?></td>  
					<td style="text-align:center;"><?php  $fieldName=$domicile."_female_gen_engineer"; ?><?php echo @$incmplt_fields->$fieldName; ?></td> 
					<td style="text-align:center;"><?php  $fieldName=$domicile."_female_gen_it_professional"; ?><?php echo @$incmplt_fields->$fieldName; ?></td> 
					<td style="text-align:center;"><?php  $fieldName=$domicile."_female_gen_management"; ?><?php echo @$incmplt_fields->$fieldName; ?></td> 
					<td style="text-align:center;"><?php  $fieldName=$domicile."_female_gen_total"; ?><?php echo @$incmplt_fields->$fieldName; ?></td> 
				</tr>
				 <?php } ?>
				<?php if($incmplt_fields->difn_female_sc_total>0){ ?>
				<tr class="difn_f_sc emporg">
				   <td>Domiciled in Foreign Nationals<br>Female - Scheduled Caste</td>
					<td style="text-align:center;"><?php  $fieldName=$domicile."_female_sc_skilled"; ?><?php echo @$incmplt_fields->$fieldName; ?></td>
					<td style="text-align:center;"><?php  $fieldName=$domicile."_female_sc_unskilled"; ?><?php echo @$incmplt_fields->$fieldName; ?></td>
					<td style="text-align:center;"><?php  $fieldName=$domicile."_female_sc_supervisory"; ?><?php echo @$incmplt_fields->$fieldName; ?></td>  
					<td style="text-align:center;"><?php  $fieldName=$domicile."_female_sc_engineer"; ?><?php echo @$incmplt_fields->$fieldName; ?></td> 
					<td style="text-align:center;"><?php  $fieldName=$domicile."_female_sc_it_professional"; ?><?php echo @$incmplt_fields->$fieldName; ?></td> 
					<td style="text-align:center;"><?php  $fieldName=$domicile."_female_sc_management"; ?><?php echo @$incmplt_fields->$fieldName; ?></td> 
					<td style="text-align:center;"><?php  $fieldName=$domicile."_female_sc_total"; ?><?php echo @$incmplt_fields->$fieldName; ?></td> 
				</tr>
				<?php } ?>
				  <?php if(@$incmplt_fields->difn_female_st_total>0){ ?>
				<tr class="difn_f_st emporg">
				   <td>Domiciled in Foreign Nationals<br>Female - Scheduled Tribe</td>
					<td style="text-align:center;"><?php  $fieldName=$domicile."_female_st_skilled"; ?><?php echo @$incmplt_fields->$fieldName; ?></td>
					<td style="text-align:center;"><?php  $fieldName=$domicile."_female_st_unskilled"; ?><?php echo @$incmplt_fields->$fieldName; ?></td>
					<td style="text-align:center;"><?php  $fieldName=$domicile."_female_st_supervisory"; ?><?php echo @$incmplt_fields->$fieldName; ?></td>  
					<td style="text-align:center;"><?php  $fieldName=$domicile."_female_st_engineer"; ?><?php echo @$incmplt_fields->$fieldName; ?></td> 
					<td style="text-align:center;"><?php  $fieldName=$domicile."_female_st_it_professional"; ?><?php echo @$incmplt_fields->$fieldName; ?></td> 
					<td style="text-align:center;"><?php  $fieldName=$domicile."_female_st_management"; ?><?php echo @$incmplt_fields->$fieldName; ?></td> 
					<td style="text-align:center;"><?php  $fieldName=$domicile."_female_st_total"; ?><?php echo @$incmplt_fields->$fieldName; ?></td> 
				</tr>
				  <?php } ?>
				<?php if($incmplt_fields->difn_female_st_total>0){ ?>
				<tr class="difn_f_obc emporg">
				   <td>Domiciled in Foreign Nationals<br>Female - Other Backward Caste</td>
				   <td style="text-align:center;"><?php  $fieldName=$domicile."_female_obc_skilled"; ?><?php echo @$incmplt_fields->$fieldName; ?></td>
					<td style="text-align:center;"><?php  $fieldName=$domicile."_female_obc_unskilled"; ?><?php echo @$incmplt_fields->$fieldName; ?></td>
					<td style="text-align:center;"><?php  $fieldName=$domicile."_female_obc_supervisory"; ?><?php echo @$incmplt_fields->$fieldName; ?></td>  
				   <td style="text-align:center;"><?php  $fieldName=$domicile."_female_obc_engineer"; ?><?php echo @$incmplt_fields->$fieldName; ?></td> 
					<td style="text-align:center;"><?php  $fieldName=$domicile."_female_obc_it_professional"; ?><?php echo @$incmplt_fields->$fieldName; ?></td> 
					<td style="text-align:center;"><?php  $fieldName=$domicile."_female_obc_management"; ?><?php echo @$incmplt_fields->$fieldName; ?></td> 
					<td style="text-align:center;"><?php  $fieldName=$domicile."_female_obc_total";?><?php echo @$incmplt_fields->$fieldName; ?></td> 
				</tr> 
				<?php } ?>
																
			 <?php } ?>
				<tr>
					<td style="text-align:left;"><b>Total Male Employment</b></td>
					<td style="text-align:center;"><?= @$incmplt_fields->no_of_emp_mskilled[0] ?></td>
					<td style="text-align:center;"><?= @$incmplt_fields->no_of_emp_munskilled[0] ?></td>
					<td style="text-align:center;"><?= @$incmplt_fields->no_of_emp_msupervisory[0] ?></td>
					<td style="text-align:center;"><?= @$incmplt_fields->no_of_emp_mengineer[0] ?></td>
					<td style="text-align:center;"><?= @$incmplt_fields->no_of_emp_it_mprofessional[0] ?></td>
					<td style="text-align:center;"><?= @$incmplt_fields->no_of_emp_mmanagement[0] ?></td>
					<td style="text-align:center;"><?= @$incmplt_fields->no_of_emp_mtotal[0] ?></td>
				</tr>
				<tr>
					<td style="text-align:left;"><b>Total Female Employment</b></td>
					<td style="text-align:center;"><?= @$incmplt_fields->no_of_emp_fskilled[0] ?></td>
					<td style="text-align:center;"><?= @$incmplt_fields->no_of_emp_funskilled[0] ?></td>
					<td style="text-align:center;"><?= @$incmplt_fields->no_of_emp_fsupervisory[0] ?></td>
					<td style="text-align:center;"><?= @$incmplt_fields->no_of_emp_fengineer[0] ?></td>
					<td style="text-align:center;"><?= @$incmplt_fields->no_of_emp_it_fprofessional[0] ?></td>
					<td style="text-align:center;"><?= @$incmplt_fields->no_of_emp_fmanagement[0] ?></td>
					<td style="text-align:center"><?= @$incmplt_fields->no_of_emp_ftotal[0] ?></td>
				</tr>
			</tbody>
		</table>
		  <?php } ?>
		</td>
	</tr>	
	<tr>
		<th colspan="6" style="text-align:center;font-weight:bold;font:14px;">Utility Details:</th>
	</tr>	
	<?php 
	$displayElec=0;		
	$displayWater=0;		
	$displayGas=0;	
	if (isset($fields->utility) && $fields->utility == '1')
	{
		$displayElec=1;
	}
	if (isset($fields->utility) && $fields->utility == '2')
	{
		$displayWater=1;
	}	
	if (isset($fields->utility) && $fields->utility == '3')
	{
		$displayGas=1;
	}
	?>
	<?php if($displayElec==1){ ?>
	<tr>		
		<td colspan="6">
			<table width="100%">
				<tr>
					<td style='text-align:center;'>Source of Electricity</td>
					<td style='text-align:center;'>Electricity Consumption</td>
					<td style='text-align:center;'>Sanctioned Electiricty Load</td>			
					<td style='text-align:center;'>Unit</td>			
				</tr>				
					<?php
						if(isset($fields->electricity_consumption)){
								foreach($fields->electricity_consumption as $k2 => $v2) {	
									if(isset($fields->source_of_electricity[$k2]) && $fields->source_of_electricity[$k2]==1){$source_of_elec='UPCL';}	
									if(isset($fields->source_of_electricity[$k2]) && $fields->source_of_electricity[$k2]==2){$source_of_elec='PTCUL';}	
									if(isset($fields->source_of_electricity[$k2]) && $fields->source_of_electricity[$k2]==3){$source_of_elec='Solar Power';}
									if(isset($fields->source_of_electricity[$k2]) && $fields->source_of_electricity[$k2]==4){$source_of_elec='DG Set';}
									if(isset($fields->source_of_electricity[$k2]) && $fields->source_of_electricity[$k2]==5){$source_of_elec='Captive Power Unit';}
									
									if(isset($fields->unit[$k2]) && $fields->unit[$k2]==1){$ele_unit='KVA';}	
									if(isset($fields->unit[$k2]) && $fields->unit[$k2]==2){$ele_unit='KW';}
								
								 echo "<tr>
								 
									<td style='text-align:center;'>".@$source_of_elec."</td>
									
									<td style='text-align:center'>".@$fields->electricity_consumption[$k2]."</td>
									
									<td style='text-align:center'>".@$fields->sactioned_electricity_load[$k2]."</td>
									
									<td style='text-align:center'>".@$ele_unit."</td>
									
								  </tr>";
								
							}

						}	
					?>
				
			</table>		
		</td>
	</tr>
	<?php }?>
	<?php if($displayWater==1){ ?>
	<tr>		
		<td colspan="6">
			<table>
				<tr>
					<td>Source of Water</td>
					<td>Water Consumption/Industrial</td>
					<td>Domestic</td>			
					<td>Total</td>			
					<td>Unit</td>			
				</tr>
				<?php 							
				if(isset($fields->source_of_water)){
					foreach($fields->source_of_water as $key => $value) {								
						if($fields->source_of_water[$key]==1){$source_of_water='SIIDCUL Water Connection';}	
						if($fields->source_of_water[$key]==2){$source_of_water='UJS Water Connection';}	
						if($fields->source_of_water[$key]==3){$source_of_water='Drawing from Borewell';}
						if($fields->source_of_water[$key]==4){$source_of_water='Drawing from River/ Canal';}
						
						if($fields->water_unit[$key]==1){$water_unit='Liters/Year';}
						
						echo "<tr>
								 
									<td style='text-align:center'>".@$source_of_water."</td>
									
									<td style='text-align:center'>".@$fields->industrial[$key]."</td>
									
									<td style='text-align:center'>".@$fields->domestic[$key]."</td>
									
									<td style='text-align:center'>".@$fields->total[$key]."</td>
									
									<td style='text-align:center'>".@$water_unit."</td>
									
								  </tr>";

					}

				}
				?>				
			</table>
		</td>
	</tr>	
	<?php }?>	
	<?php if($displayGas==1){ ?>
	<tr>		
		<td colspan="6">
			<table>
				<tr>
					<td>Name of Gas</td>
					<td>Service Provider of Gas</td>
					<td>Annual Consumption</td>	
					<td>Unit</td>			
				</tr>
				<?php 							
				if(isset($fields->name_of_gas)){
						foreach ($fields->name_of_gas as $key => $value) {								
						
						if($fields->gas_unit[$key]==1){$gas_unit='BTU';}
						
						echo "<tr>
								 
									<td style='text-align:center'>".@$fields->name_of_gas[$key]."</td>
									
									<td style='text-align:center'>".@$fields->service_provider_gas[$key]."</td>
									
									<td style='text-align:center'>".@$fields->annual_consumption[$key]."</td>
									
									<td style='text-align:center'>".@$fields->total[$key]."</td>
									
									<td style='text-align:center'>".@$gas_unit."</td>
									
								  </tr>";

					}

				}
				?>				
			</table>
		</td>
	</tr>	
	<?php } ?>
	<tr>
		<th colspan="6" style="text-align:center;font-weight:bold;font:14px;">Investment Details <?=@$fields->investment_detail?></th>
	</tr>	
	<tr>
		<td colspan="6">
			<table>
				<tr>
					<td>Land</td>
					<td>Building</td>		
					<td>Machinery/Equipment</td>		
					<td>Capital Margin</td>		
					<td>Other</td>		
					<td>Total</td>	
				</tr>
				<?php 
				if(isset($fields->invstmnt_in_total))
				{
					foreach ($fields->invstmnt_in_total as $k5 => $v5) 
					{
						 echo "<tr>
								 
									<td style='text-align:center'>".@$fields->invstmnt_in_land[$k5]."</td>
									
									<td style='text-align:center'>".@$fields->invstmnt_in_building[$k5]."</td>
									
									<td style='text-align:center'>".@$fields->invstmnt_in_plant[$k5]."</td>
									
									<td style='text-align:center'>".@$fields->invstmnt_in_wrkingcapital[$k5]."</td>
									
									<td style='text-align:center'>".@$fields->invstmnt_in_other[$k5]."</td>
									
									<td style='text-align:center'>".@$fields->invstmnt_in_total[$k5]."</td>
									
								  </tr>";
				    }		
				} 
				?>		  
			</table>
		</td>		
	</tr>
	<tr>
		<td colspan="6" style="text-align:center;font-weight:bold;font:14px;">Is Unit Registered Under Factory Act: <?=@$fields->is_unit_ancillary_user_factory_act?></td>
	</tr>
	<tr>
		<th colspan="6" style="text-align:center;font-weight:bold;font:14px;">Financial Indicators of the Enterprise / Firm for Last 3 Financial Years in INR Lakhs (if any)</th>
	</tr>
	<tr>
		<td colspan="6">
			<table>
				<tr>
					<td>Year</td>
					<td>Turn Over</td>		
					<td>Profit Before Tax</td>		
					<td>Net Worth</td>		
					<td>Reserves & Surplus</td>		
					<td>Share Capital</td>	
				</tr>
				<?php
				if(isset($fields->fnc_year)){
					foreach ($fields->fnc_year as $k6=>$v6)
					{ 
						echo "<tr>
								 
									<td style='text-align:center'>".@$fields->fnc_year[$k6]."</td>
									
									<td style='text-align:center'>".@$fields->fnc_turnover[$key]."</td>
									
									<td style='text-align:center'>".@$fields->fnc_prftBfrTax[$k6]."</td>
									
									<td style='text-align:center'>".@$fields->fnc_netWrth[$k6]."</td>
									
									<td style='text-align:center'>".@$fields->fnc_rsrvSrpls[$k6]."</td>
									
									<td style='text-align:center'>".@$fields->fnc_sharCaps[$k6]."</td>
									
								  </tr>";
					}
				}
				?>	
			</table>
		</td>
	</tr>
	<tr>
		<th colspan="6" style="text-align:center;font-weight:bold;font:14px;">Unit output is exported : <?=@$fields->unit_output_is_exported?></th>
	</tr>
	<tr>
		<td colspan="6">
			<table>
				<tr>
					<td>Financial Year</td>
					<td>Export Turn Over</td>		
					<td>Financial Year</td>		
					<td>Export Turn Over</td>		
					<td>Financial Year</td>		
					<td>Export Turn Over</td>	
				</tr>
				<tr>
					<td><?= @$fields->export_fnc_year1 ?></td>
					<td><?= @$fields->export_turnover1 ?></td>		
					<td><?= @$fields->export_fnc_year2 ?></td>		
					<td><?= @$fields->export_turnover2 ?></td>		
					<td><?= @$fields->export_fnc_year3 ?></td>		
					<td><?= @$fields->export_turnover3 ?></td>	
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<th colspan="6" style="text-align:center;font-weight:bold;font:14px;">Statutory Registration Details</th>
	</tr>
	<tr>
		<td>EM Part-2 Details</td>
		<td colspan="2"><?=@$fields->em_detail?></td>
		<td>IEM Data</td>
		<td colspan="2"><?=@$fields->iem_data; ?></td>	
	</tr>
	<tr>
		<td>Udyog Aadhar Memorandum</td>
		<td colspan="2"><?=@$fields->uam?></td>
		<td>Uttarakhand Pollution Control Board Registration Id</td>
		<td colspan="2"><?=@$fields->pcb_id; ?></td>	
	</tr>
	<tr>
		<td>Uttarakhand Power Coorporation Ltd. Consumer Id</td>
		<td colspan="5"><?=@$fields->uttarakhand_power_coorporation_ltd_consumer_id?></td>	
	</tr>	
	<tr>
		<th colspan="6" style="text-align:center;font-weight:bold;font:14px;">Details of State Government Issued Certificates/ Approvals/ Clearances Licenses</th>
	</tr>	
	<tr>
		<td colspan="6">
			<table>
				<tr>
					<td>Name of the Department</td>
					<td>Name of the Approval</td>		
					<td>Approval Certificate</td>		
					<td>Valid Upto</td>	
				</tr>			
				<?php 
				if(isset($fields->department_id)){
					foreach($fields->department_id as $k8 => $v8) {
						$dpName = ApplicationExt::getDepartMentNameById(@$fields->department_id[$k8]);
						$approvalName = ApplicationExt::getApprovalNameById(@$fields->service_id[$k8]);
						echo "<tr>
								 
								<td style='text-align:center'>".@$dpName."</td>
								
								<td style='text-align:center'>".@$approvalName."</td>
								
								<td style='text-align:center'>".@$fields->certificate_number[$k8]."</td>
								
								<td style='text-align:center'>".@$fields->valid_upto[$k8]."</td>								
								
							  </tr>";	 

					}
				}
				?>	
			</table>
		</td>
	</tr>
	<tr>
	<th colspan="6" style="text-align:center;font-weight:bold;font:14px;">Timeline:Registration of Existing Enterprise Service Id:<?php echo @$service_id;?></th>
	</tr>
	<tr>
		<td colspan="6">
			<table>
				<tr>
					<td>S.No.</td>
					<td>Action Taken On</td>		
					<td>Status</td>		
					<td>Remarks on service application displayed in chronological order</td>	
					<td>Time taken by Applicant</td>	
					<td>Time taken by Department</td>	
				</tr>	
				
					<?php							
					if (empty($applicationsList)) {
						echo "<tr><td colspan='6' style='text-align:center'>No Detail Found</td></tr>";
					} else {
						$i=1;
						foreach($applicationsList as $k10 => $v10) {
							
							if($v10['application_status'] != "I") {
							
								$create = date('d-m-Y H:i', strtotime($v10['added_date_time']));
								
								switch ($v10['application_status']) {
                                    case "A":
                                        $status = "Approved";
                                        break;
                                    case "B":
										$status = "Payment";                                       
                                        break;
                                    case "P":
                                        $status = "Pending"; 
                                        break;
                                    case "F":
                                        $status = "Forward"; 
                                        break;
                                    case "V":
                                        $status = "Verified"; 
                                        break;
                                    case "RBI":
                                        $status = "Reverted"; 
                                        break;
                                    case "R":
                                        $status = "Rejected"; 
                                        break;
                                    default:
                                        $status = "No Status"; 
                                }
								
								
								if(isset($status) && $status == "RBI") {
									$keyval = $key - 1;
									if ($keyval >= 0) {
										$date = $applicationsList[$k10]['added_date_time'];
									} else {
										$date = date('Y-m-d H:i:s');
									}



									$diff = abs(strtotime($v10['added_date_time']) - strtotime($date));
									$diffapplicant = $diffapplicant + $diff;
									$years = floor($diff / (365 * 60 * 60 * 24));
									$months = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
									$days = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));
									$hours = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24) / (60 * 60));
									$minuts = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60) / 60);
									$seconds = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60 - $minuts * 60));
									$allDays = ($months * 30) + $days;
									if($years!=0){ $year1 = "$years years,";}
									$date1 = printf("%d days, %d hrs, %d min\n", $allDays, $hours, $minuts);
								}
								
								
								if (isset($status) && $status != "RBI") {
									if ($key == 0) {
										if ($status == "A" || $status == "R") {
											$date = $v10['added_date_time'];
										} else {
											$date = date('Y-m-d H:i:s');
										}
									} else {
										$keyval = $key - 1;
										$date = $applicationsList[$k10]['added_date_time'];
									}

									$diff1 = abs(strtotime($v10['added_date_time']) - strtotime($date));

									$diffdept = @$diffdept + @$diff1;
									$years = floor($diff1 / (365 * 60 * 60 * 24));
									$months = floor(($diff1 - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
									$days = floor(($diff1 - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));
									$hours = floor(($diff1 - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24) / (60 * 60));
									$minuts = floor(($diff1 - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60) / 60);
									$seconds = floor(($diff1 - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60 - $minuts * 60));
									$allDays = ($months * 30) + $days;
									if(@$years!=0){
										$year2 = "$years years,";										
									}
									$date2 = printf("%d days, %d hrs, %d min\n", @$allDays, @$hours, @$minuts);
                                }
								
								echo "<tr>
								 
										<td style='text-align:center'>".$i."</td>
										
										<td style='text-align:center'>".@$create."</td>	

										<td style='text-align:center'>".@$status."</td>	
										
										<td style='text-align:center'>".@$v10['comments']."</td>

										<td style='text-align:center'>".$year1." ".$date1."</td>
											
										<td style='text-align:center'>".@$year2." ".@$date2."</td>
									</tr>";	 
							}
						$i++;
						}
					}	 	 
					?>
									
			</table>
		</td>
	</tr>	
</table>
