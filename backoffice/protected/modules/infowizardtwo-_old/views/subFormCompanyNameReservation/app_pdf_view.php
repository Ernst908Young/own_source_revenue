<style type="text/css">
table.gridtable th {
	padding: 8px;
	border-style: solid;
	border-color: #000000;
	background-color: #dedede;
	text-align: center;
	font-size: 9em;

}
table.gridtable td {
	font-size: 1.4em;
}

.br td, th, td{
	
	border-collapse: collapse;
}
.inner_td_right{
	align:left;
}
li{list-style: lower-alpha;}
</style>
<?php 

$m=0;
	if(@$fieldValues['UK-FCL-00044_0']==3)
	{
?>
	<table cellspacing="0" width="100%" cellpadding="2" cellpadding="5px" class="gridtable">	
		<tbody>
			<tr>
				<td width="5%">1.</td>
				<td width="95%">
					<table width="100%" border="0">
						<tr>
							<td>
							Proposed Name of Business:
							</td>
						</tr>
						<tr><td>&nbsp;</td></tr>
						<tr>
							<td>
							<table width="100%" border="0">
								<tr>
									<td><?php echo @$fieldValues['UK-FCL-00056_0'];?></td>
								</tr>
							</table>
							</td>
						</tr>	
					</table>
				</td>
			</tr>
			<tr>
			<td width="5%">2.</td>
			<td width="95%">
				<table width="100%" border="0">
					<tr>
						<td>
						Business Activity Code :
						</td>
					</tr>
					<tr><td>&nbsp;</td></tr>
					<tr>
						<td>
						<table width="100%" border="0">
							<tr>
							<td>
							<?php 
								$i=1;
								foreach(@$fieldValues['UK-FCL-00057_0'] as $k1=>$v1){
									$businessActCode2=InfowizardQuestionMasterExt::getBusinessIndustryName($v1);
									$busActCodeArr2=explode("-",$businessActCode2);
									echo "($i) ".$busActCodeArr2[1]."<br>";
									//echo "(".$i.") ".InfowizardQuestionMasterExt::getBusinessIndustryName($v1)."<br>";
								 $i++;
								} 
								
							?></td>
							</tr>
						</table>
						</td>
					</tr>	
				</table>
			</td>
			</tr>
			<tr>
				<td width="5%">3.</td>
				<td width="95%">
					<table width="100%" border="0">
						<tr>
							<td>
							General Nature of Business:
							</td>
						</tr>
						<tr><td>&nbsp;</td></tr>
						<tr>
							<td>
							<table width="100%" border="0">
								<tr>
									<td><?php echo @$fieldValues['UK-FCL-00058_0'];?></td>
								</tr>
							</table>
							</td>
						</tr>	
					</table>
				</td>
			</tr>
			<tr>
				<td width="5%">4.</td>
				<td width="95%">
					<table width="100%" border="0">
						<tr>
							<td>
							Principal Place of business:
							</td>
						</tr>
						<tr>
							<td>
							&nbsp;
							</td>
						</tr>
						<tr>
							<td>
							<table width="100%" border="0">
								<tr>
									<td><b>Address:</b><?php echo @$fieldValues['UK-FCL-00062_0'].', '.@$fieldValues['UK-FCL-00329_0'].', '.@$fieldValues['UK-FCL-00330_0']; ?></td>
								</tr>	
								<tr>
									<td><b>Postal Code:</b>  <?php echo @$fieldValues['UK-FCL-00061_0'];?></td>
								</tr>
								<tr>
									<td><b>Parish:</b><?php 
									if(isset($fieldValues['UK-FCL-00060_0']) && !empty($fieldValues['UK-FCL-00060_0'])){
									echo  InfowizardQuestionMasterExt::getCountryStateNameByID(@$fieldValues['UK-FCL-00060_0']);
									} ?></td>
								</tr>
								<tr>
									<td><b>Country:</b> Barbados</td>
								</tr>
							</table>
							</td>
						</tr>	
					</table>
				</td>
			</tr>
			<tr>
				<td width="5%">5.</td>
				<td width="95%">
					<table width="100%" border="0" >
						<tr>
							<td>
							Details of Individuals:
							</td>
						</tr>
						<tr><td>&nbsp;</td></tr>
						<tr>
							<td>							
							<table width="100%" border="1" cellpadding="5px" style="border-width:0.5px;">
								<?php 
								$t=1;
								foreach(@$fieldValues['UK-FCL-00064_0'] as $ke=>$ve){ ?>								
								<tr>
									<td><b>First Name of Individual:</b></td>
									<td><?php echo @$fieldValues['UK-FCL-00064_0'][$ke];?></td>
								</tr>
								<tr>
									<td><b>Middle Name of Individual:</b></td>
									<td><?php echo @$fieldValues['UK-FCL-00065_0'][$ke];?></td>
								</tr>
								<tr>
									<td><b>Surname Name of Individual:</b></td>
									<td><?php echo @$fieldValues['UK-FCL-00067_0'][$ke];?></td>
								</tr>
								<tr>
									<td><b>Former Christian name:</b></td>
									<td><?php echo @$fieldValues['UK-FCL-00068_0'][$ke];?></td>
								</tr>
								<tr>
									<td><b>Former Surname:</b></td>
									<td><?php echo @$fieldValues['UK-FCL-00069_0'][$ke];?></td>
								</tr>
								<tr>
									<td><b>Select Type of Identity Proof to be provided for applicant:</b></td>
									<td><?php echo @$fieldValues['UK-FCL-00074_0'][$ke];?></td>
								</tr>
								<tr>
									<td><b>Individual ID Number:</b></td>
									<td><?php echo @$fieldValues['UK-FCL-00073_0'][$ke];?></td>
								</tr>
								<tr>
									<td><b>Individual Mobile Number:</b></td>
									<td><?php echo @$fieldValues['UK-FCL-00075_0'][$ke];?></td>
								</tr>
								<tr>
									<td><b>Individual Email ID:</b></td>
									<td><?php echo @$fieldValues['UK-FCL-00076_0'][$ke];?></td>
								</tr>
								<tr>
									<td><b>Individual Present Nationality:</b></td>
									<td><?php echo @$fieldValues['UK-FCL-00077_0'][$ke];?></td>
								</tr>
								<tr>
									<td><b>Individual Nationality of Origin:</b></td>
									<td><?php echo @$fieldValues['UK-FCL-00078_0'][$ke];?></td>
								</tr>
								<tr>
									<td><b>Individual Address Line 1:</b></td>
									<td><?php echo @$fieldValues['UK-FCL-00082_0'][$ke];?></td>
								</tr>
								<tr>
									<td><b>Individual Address Line 2:</b></td>
									<td><?php echo @$fieldValues['UK-FCL-00376_0'][$ke];?></td>
								</tr>
								<tr>
									<td><b>Individual Address City:</b></td>
									<td><?php echo @$fieldValues['UK-FCL-00081_0'][$ke];?></td>
								</tr>
								<tr>
									<td><b>Individual Address State / Parish:</b></td>
									<td><?php echo @$fieldValues['UK-FCL-00080_0'][$ke];?></td>
								</tr>
								<tr>
									<td><b>Individual Address Pin / Area Code:</b></td>
									<td><?php echo @$fieldValues['UK-FCL-00086_0'][$ke];?></td>
								</tr>
								<tr>
									<td><b>Individual Address : Country:</b></td>
									<td><?php echo @$fieldValues['UK-FCL-00079_0'][$ke];?></td>
								</tr>
								<tr>
									<td><b>Other Business Occupation (if any) of Individual:</b></td>
									<td><?php echo @$fieldValues['UK-FCL-00083_0'][$ke];?></td>
								</tr>
								<?php }
								?>
							</table>							
							</td>
						</tr>	
					</table>
				</td>
			</tr>
			<?php 
			if(isset($fieldValues['UK-FCL-00246_0']) && !empty($fieldValues['UK-FCL-00246_0'])){
			?>
			<tr>
				<td width="5%">6.</td>
				<td width="95%">
					<table width="100%" border="0" >
						<tr>
							<td>
							Details of Corporate Partners: 
							</td>
						</tr>
						<tr><td>&nbsp;</td></tr>
						<tr>
							<td>
							<table width="100%" border="1" cellpadding="5px" style="border-width:0.5px;">
							<?php 
								if(isset($fieldValues['UK-FCL-00084_0']) && !empty($fieldValues['UK-FCL-00084_0']))
								{
									$m=1;
									foreach(@$fieldValues['UK-FCL-00084_0'] as $ke=>$ve)
									{ 
								?>	
									
									<tr>
										<td><b>Name of the Company:</b></td>
										<td><?php echo @$fieldValues['UK-FCL-00084_0'][$ke];?></td>
									</tr>
									<tr>
										<td><b>Registration Number of the Company:</b></td>
										<td><?php echo @$fieldValues['UK-FCL-00332_0'][$ke];?></td>
									</tr>
									<tr>
										<td><b>Address of the Company:</b></td>
										<td><?php echo @$fieldValues['UK-FCL-00333_0'][$ke];?></td>
									</tr>
									<tr>
										<td><b>Date of Commencement of Business(if after 15<sup>th</sup> June 1940):</b></td>
										<td><?php echo @$fieldValues['UK-FCL-00085_0'][$ke];?></td>
									</tr>
									
								<?php 
									$m++;
									}
								}
								?>
							</table>
							</td>
						</tr>	
					</table>
				</td>
			</tr>
			<?php }?>
			<tr>
				<td width="50%">&nbsp;</td>
				<td width="50%">&nbsp;</td>
			</tr>
			<tr>
				<td width="50%">&nbsp;</td>
				<td width="50%">&nbsp;</td>
			</tr>
			<tr>
				<td width="50%">&nbsp;</td>
				<td width="50%">&nbsp;</td>
			</tr>
			<tr>
				<td width="50%">Electronically Signed</td>
				<td width="50%" style="text-align:right;">Electronically Signed</td>
			</tr>
		</tbody>
	</table>
	
<?php }?>
<?php 
	if(@$fieldValues['UK-FCL-00044_0']==2)
	{
?>
	<table cellspacing="0" width="100%" cellpadding="2" cellpadding="5px" class="gridtable">	
	<tbody>
		<tr>
			<td width="5%">1.</td>
			<td width="95%">
				<table width="100%" border="0">
				<tr>
					<td>
					Name,&nbsp; Address,&nbsp; telephone number of person making request :
					</td>
				</tr>
				<tr>
					<td>
					&nbsp;
					</td>
				</tr>
				<tr>
					<td>
					<table width="100%" border="0">
						<tr>
							<td><b>Name:</b> <?php echo @$fieldValues['UK-FCL-00002_0'].' '.@$fieldValues['UK-FCL-00003_0'].' '.@$fieldValues['UK-FCL-00004_0'];?></td>
						</tr>	
						<tr>
							<td><b>Address :</b>  <?php echo @$fieldValues['UK-FCL-00011_0'];?>, <?php echo @$fieldValues['UK-FCL-00327_0'];?>, <?php echo @$fieldValues['UK-FCL-00010_0'];?>,<?php echo @$fieldValues['UK-FCL-00328_0'];?>,	<?php echo InfowizardQuestionMasterExt::getCountryStateNameByID(@$fieldValues['UK-FCL-00008_0']);?>, <?php echo InfowizardQuestionMasterExt::getCountryStateNameByID(@$fieldValues['UK-FCL-00007_0']);?></td>
						</tr>
						<tr>
							<td><b>Mobile Number:</b> <?php echo @$fieldValues['UK-FCL-00005_0'];?></td>
						</tr>
						
					</table>
					</td>
				</tr>	
				</table>
			</td>
		</tr>		
		<tr>
			<td width="5%">2.</td>
			<td width="95%">
				<table width="100%" border="0">
					<tr>
						<td>
						Proposed name or name in order of preferences :
						</td>
					</tr>
					<tr><td>&nbsp;</td></tr>
					<tr>
						<td>
						<table width="100%" border="0">
							<tr>
								<td><b>(a)</b> <?php echo @$fieldValues['UK-FCL-00015_0'];?>&nbsp;<?php 
								if(isset($fieldValues['UK-FCL-00014_0']) && !empty($fieldValues['UK-FCL-00014_0'])){
								echo InfowizardQuestionMasterExt::getLegalEndingName(@$fieldValues['UK-FCL-00014_0']);
								}
								?></td>
							</tr>	
							<tr>
								<td><b>(b)</b> <?php echo @$fieldValues['UK-FCL-00016_0'];?>&nbsp;<?php if(isset($fieldValues['UK-FCL-00484_0']) && !empty($fieldValues['UK-FCL-00484_0'])){
								echo InfowizardQuestionMasterExt::getLegalEndingName(@$fieldValues['UK-FCL-00484_0']);
								}?></td>
							</tr>
							<tr>
								<td><b>(c)</b> <?php echo @$fieldValues['UK-FCL-00017_0'];?>&nbsp;<?php if(isset($fieldValues['UK-FCL-00485_0']) && !empty($fieldValues['UK-FCL-00485_0'])){
								echo InfowizardQuestionMasterExt::getLegalEndingName(@$fieldValues['UK-FCL-00485_0']);
								}?></td>
							</tr>
						</table>
						</td>
					</tr>	
				</table>
			</td>
		</tr>
		<tr>
			<td width="5%">3.</td>
			<td width="95%">
				<table width="100%" border="0">
					<tr>
						<td>
						Main types of business the company carries on or proposes to carry on:
						</td>
					</tr>
					<tr><td>&nbsp;</td></tr>
					<tr>
						<td>
						<table width="100%" border="0">
							<tr>
							<td>
							<?php 
								$i=1;
								foreach(@$fieldValues['UK-FCL-00018_0'] as $k1=>$v1){
									$businessActCode2=InfowizardQuestionMasterExt::getBusinessIndustryName($v1);
									$busActCodeArr2=explode("-",$businessActCode2);
									echo "($i) ".$busActCodeArr2[1]."<br>";
								 $i++;
								} 
								
							?></td>
							</tr>
						</table>
						</td>
					</tr>	
				</table>
			</td>
		</tr>
		<tr> 
			<td width="5%">4</td>
			<td width="95%">
				<table width="100%" border="0">
					<tr>
						<td>
						Derivation of Name(s):
						</td>
					</tr>
					<tr><td>&nbsp;</td></tr>
					<tr>
						<td>
						<table width="100%" border="0">
							<tr>
								<td><?php echo InfowizardQuestionMasterExt::getDerivationName(@$fieldValues['UK-FCL-00027_0']);?></td>
							</tr>
						</table>
						</td>
					</tr>	
				</table>
			</td>
		</tr>
		<tr> 
			<td width="5%">5</td>
			<td width="95%">
				<table width="100%" border="0">
					<tr>
						<td>
						First name available to be reserved:
						</td>
					</tr>
					<tr><td>&nbsp;</td></tr>
					<tr>
						<td>
						<table width="100%" border="0">
							<tr>
								<td>Yes</td>
							</tr>
						</table>
						</td>
					</tr>	
				</table>
			</td>
		</tr>
		<tr> 
			<td width="5%">5</td>
			<td width="95%">
				<table width="100%" border="0">
					<tr>
						<td>
						Name is for:
						</td>
					</tr>
					<tr><td>&nbsp;</td></tr>
					<tr>
						<td>
						<table width="100%" border="0">
							<tr>
								<td>
								<?php  
								if(@$fieldValues['UK-FCL-00012_0']=='Name reservation for new Company')
								{ 
									echo @$fieldValues['UK-FCL-00012_0'];
									echo "<br/>";
									echo InfowizardQuestionMasterExt::getNameReservationNewCompany(@$fieldValues['UK-FCL-00031_0']); 
								}
								if(@$fieldValues['UK-FCL-00012_0']=='Name change of existing company'){
								
									echo @$fieldValues['UK-FCL-00012_0'];
									echo "<br/>";
									echo InfowizardQuestionMasterExt::getTypeofExistingCompany(@$fieldValues['UK-FCL-00492_0']);
									echo "<br/>";
									echo InfowizardQuestionMasterExt::getNameReservationExistingCompany(@$fieldValues['UK-FCL-00032_0']);
								}
								?>								
								</td>
							</tr>
						</table>
						</td>
					</tr>	
				</table>
			</td>
		</tr>
		<tr>
			<td width="5%">6</td>
			<td width="95%">
				<table width="100%" border="0">
					<tr>
						<td>
						If for a change of name, state present name of company 
						</td>
					</tr>
					<tr><td>&nbsp;</td></tr>
					<tr>
						<td>
						<table width="100%" border="0">
							<tr>
								<td>
								<?php 
								if(@$fieldValues['UK-FCL-00012_0']=='Name change of existing company')
								{
									echo @$fieldValues['UK-FCL-00019_0']; ?>
									&nbsp;&nbsp;
								<?php echo @$fieldValues['UK-FCL-00020_0']; 
								} 
								?>
								</td>
							</tr>
						</table>
						</td>
					</tr>	
				</table>
			</td>
		</tr>		
		<tr>
			<td width="5%">7</td>
			<td width="95%">
				<table width="100%" border="0">
					<tr>
						<td>
						If for an amalgamation, state names of amalgamating companies: 
						</td>
					</tr>
					<tr><td>&nbsp;</td></tr>
					<?php 
					if(isset($fieldValues['UK-FCL-00022_0']) && !empty($fieldValues['UK-FCL-00022_0'])){
					?>
					<tr>
						<td>
						<table width="100%" border="1" cellpadding="5px">
							<tr style="background-color:#ccc;">
								<th>
									<b>Amalgamating Company Registration Number</b>
								</th>
								<th>
									<b>Amalgamating Company Name</b>
								</th>
							</tr>
							<?php 							
							foreach(@$fieldValues['UK-FCL-00022_0'] as $ke=>$ve){ ?>					
							<tr>
								<td><?php echo $fieldValues['UK-FCL-00022_0'][$ke];?></td>
								<td><?php echo $fieldValues['UK-FCL-00023_0'][$ke];?></td>
							</tr>
							<?php 
							}
							?>
						</table>
						</td>
					</tr>
					<?php 
					}
					?>
				</table>
			</td>
		</tr>		
		<hr>
		<tr>
			<td colspan="2"><b>For Ministry Use Only</b></td>
		</tr>
		<tr>
			<td width="50%">
				Name Reserved Until (Specify Date)
				<ol>
					<li>&nbsp;&nbsp;<?php if(isset($getApprovedName['recomended_name']) && !empty($getApprovedName['recomended_name']=='UK-FCL-00015_0')) { echo date('d-m-Y',strtotime($getApprovedName['created'].' + 89 days')); }?></li>
					<li>&nbsp;&nbsp;<?php if(isset($getApprovedName['recomended_name']) && !empty($getApprovedName['recomended_name']=='UK-FCL-00016_0')) { echo date('d-m-Y',strtotime($getApprovedName['created'].' + 89 days')); }?></li>
					<li>&nbsp;&nbsp;<?php if(isset($getApprovedName['recomended_name']) && !empty($getApprovedName['recomended_name']=='UK-FCL-00017_0')) { echo date('d-m-Y',strtotime($getApprovedName['created'].' + 89 days')); }?></li>
				</ol>
				Date Received: &nbsp;&nbsp;<?php echo date('d-m-Y',strtotime($application_created_date));?>
			</td>
			<td width="50%">
				For Director<br/><br/>				
				See attached letter if name not reserved<br/>
				Request Received By:
			</td>
		</tr>
	</tbody>
	</table>	
<?php 
	}	
?>
<?php 
	if(@$fieldValues['UK-FCL-00044_0']==1)
	{ 
?>
<table cellspacing="0" width="100%" cellpadding="2" cellpadding="5px" class="gridtable">	
	<tbody>
		<tr>
			<td width="5%">1.</td>
			<td width="95%">
				<table width="100%" border="0">
				<tr>
					<td>
					Name, Address, telephone number and facsmile number of person making request :
					</td>
				</tr>
				<tr>
					<td>
					&nbsp;
					</td>
				</tr>
				<tr>
					<td>
					<table width="100%" border="0">
						<tr>
							<td><b>Name:</b> <?php echo @$fieldValues['UK-FCL-00002_0'].' '.@$fieldValues['UK-FCL-00003_0'].' '.@$fieldValues['UK-FCL-00004_0'];?></td>
						</tr>	
						<tr>
							<td><b>Address :</b>  <?php echo @$fieldValues['UK-FCL-00011_0'];?>, <?php echo @$fieldValues['UK-FCL-00327_0'];?>, <?php echo @$fieldValues['UK-FCL-00010_0'];?>,<?php echo @$fieldValues['UK-FCL-00328_0'];?>,	<?php echo InfowizardQuestionMasterExt::getCountryStateNameByID(@$fieldValues['UK-FCL-00008_0']);?>, <?php echo InfowizardQuestionMasterExt::getCountryStateNameByID(@$fieldValues['UK-FCL-00007_0']);?></td>
						</tr>
						<tr>
							<td><b>Mobile Number:</b> <?php echo @$fieldValues['UK-FCL-00005_0'];?></td>
						</tr>	
						<tr>
							<td><b>Facsimile Number:</b> <?php echo @$fieldValues['UK-FCL-00045_0'];?></td>
						</tr>
					</table>
					</td>
				</tr>	
				</table>
			</td>
		</tr>
		<tr>
			<td width="5%">2.</td>
			<td width="95%">
				<table width="100%" border="0">
					<tr>
						<td>
						Proposed name or name in order of preferences :
						</td>
					</tr>
					<tr><td>&nbsp;</td></tr>
					<tr>
						<td>
						<table width="100%" border="0">
							<tr>
								<td><b>(a)</b> <?php echo @$fieldValues['UK-FCL-00046_0'];?>&nbsp;<?php if(isset($fieldValues['UK-FCL-00475_0']) && !empty($fieldValues['UK-FCL-00475_0'])) { echo @$fieldValues['UK-FCL-00475_0'];}?></td>
							</tr>	
							<tr>
								<td><b>(b)</b> <?php echo @$fieldValues['UK-FCL-00047_0'];?>&nbsp;<?php if(isset($fieldValues['UK-FCL-00486_0']) && !empty($fieldValues['UK-FCL-00486_0'])) { echo @$fieldValues['UK-FCL-00486_0'];} ?></td>
							</tr>
							<tr>
								<td><b>(c)</b> <?php echo @$fieldValues['UK-FCL-00048_0'];?>&nbsp;<?php if(isset($fieldValues['UK-FCL-00487_0']) && !empty($fieldValues['UK-FCL-00487_0'])) { echo @$fieldValues['UK-FCL-00487_0']; }?></td>
							</tr>
						</table>
						</td>
					</tr>	
				</table>
			</td>
		</tr> 		
		<tr>
			<td width="5%">3.</td>
			<td width="95%">
				<table width="100%" border="0">
					<tr>
						<td>
						Main types of business the Society carries on or proposes to carry on :
						</td>
					</tr>
					<tr><td>&nbsp;</td></tr>
					<tr>
						<td>
						<table width="100%" border="0">
							<tr>
								<td><?php echo @$fieldValues['UK-FCL-00050_0'];?></td>
							</tr>
						</table>
						</td>
					</tr>	
				</table>
			</td>
		</tr>	
		<tr>
			<td width="5%">4.</td>
			<td width="95%">
				<table width="100%" border="0">
					<tr>
						<td>
						Derivation of Name(s):
						</td>
					</tr>
					<tr><td>&nbsp;</td></tr>
					<tr>
						<td>
						<table width="100%" border="0">
							<tr>
								<td><?php echo InfowizardQuestionMasterExt::getDerivationName(@$fieldValues['UK-FCL-00051_0']);?></td>
							</tr>
						</table>
						</td>
					</tr>	
				</table>
			</td>
		</tr>			
		<tr>
			<td width="5%">5.</td>
			<td width="95%">
				<table width="100%" border="0">
					<tr>
						<td>
						First name available to be reserved:
						</td>
					</tr>
					<tr><td>&nbsp;</td></tr>
					<tr>
						<td>
						<table width="100%" border="0">
							<tr>
								<td><?php echo @$fieldValues['UK-FCL-00052_0'];?></td>
							</tr>
						</table>
						</td>
					</tr>	
				</table>
			</td>
		</tr>	
		<tr>
			<td width="5%">6.</td>
			<td width="95%">
				<table width="100%" border="0">
					<tr>
						<td>
						Name is for:
						</td>
					</tr>
					<tr><td>&nbsp;</td></tr>
					<tr>
						<td>
						<table width="100%" border="0">
							<tr>
								<td><?php echo InfowizardQuestionMasterExt::getNameFor(@$fieldValues['UK-FCL-00053_0']);?></td>
							</tr>
						</table>
						</td>
					</tr>	
				</table>
			</td>
		</tr>		
		<tr>
			<td width="5%">7.</td>
			<td width="95%">
				<table width="100%" border="0">
					<tr>
						<td>
						If for a change of name, state present name of society:
						</td>
					</tr>
					<tr><td>&nbsp;</td></tr>
					<?php if(isset($fieldValues['UK-FCL-00053_0']) && $fieldValues['UK-FCL-00053_0']==2) 
					{ ?>
					<tr>
						<td>
						<table width="100%" border="0">
							<tr>
								<td><?php echo @$fieldValues['UK-FCL-00054_0'];?> &nbsp;&nbsp;<?php echo @$fieldValues['UK-FCL-00055_0'];?></td>
							</tr>
						</table>
						</td>
					</tr>
					<?php }?>
				</table>
			</td>
		</tr>	
		<hr>
		<tr>
			<td colspan="2"><b>For Ministry Use Only</b></td>
		</tr>
		<tr>
			<td width="50%">
				Name Reserved Until (Specify Date)
				<ol>
					<li>&nbsp;&nbsp;<?php if(isset($getApprovedName['recomended_name']) && !empty($getApprovedName['recomended_name']=='UK-FCL-00046_0')) { echo date('d-m-Y',strtotime($getApprovedName['created'].' + 89 days')); }?></li>
					<li>&nbsp;&nbsp;<?php if(isset($getApprovedName['recomended_name']) && !empty($getApprovedName['recomended_name']=='UK-FCL-00047_0')) { echo date('d-m-Y',strtotime($getApprovedName['created'].' + 89 days')); }?></li>
					<li>&nbsp;&nbsp;<?php if(isset($getApprovedName['recomended_name']) && !empty($getApprovedName['recomended_name']=='UK-FCL-00048_0')) { echo date('d-m-Y',strtotime($getApprovedName['created'].' + 89 days')); }?></li>
				</ol>			
				Date Received: &nbsp;&nbsp;<?php echo date('d-m-Y',strtotime($application_created_date));?>
			</td>
			<td width="50%">
				For Director<br/>
				See attached letter if name not reserved<br/>
				Request Received By:
			</td>
		</tr>
	</tbody>		
</table>
<?php
	}
?>
	