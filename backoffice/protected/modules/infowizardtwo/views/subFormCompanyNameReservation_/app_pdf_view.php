<style type="text/css">
table.gridtable th {
	border-width: 1px solid;
	padding: 8px;
	border-style: solid;
	border-color: #000000;
	background-color: #dedede;
	text-align: center;
	font-size: 0.9em;

}
table.gridtable td {
	font-size: 1.3em;
}

.br td, th, td{
	border: 1px solid black;
	border-collapse: collapse;
}
</style>	
<?php  $gti=0;?>
<h1>Status for <span class = "cblue">Application ID - <?=$_GET['subID']?> </span> <?php if(isset($app_status)){
	 if(($app_status) == 'F') echo " is Forwarded ";
	 if(($app_status) == 'A') echo " is Approved ";
	  if(($app_status) == 'P') echo " is Pending ";
	   if(($app_status) == 'I') echo " is Incomplete ";
		if(($app_status) == 'Z') echo " is Archived ";
		 if(($app_status) == 'R') echo " is Rejected ";
		 if(($app_status) == 'H') echo " is Reverted ";
		 if(($app_status) == 'RBI') echo " is Reverted ";
 }  ?>As On <?=date('d-m-Y H:i:s')  ?>
</h1> 
<br></br>
<div class="row">&nbsp;</div>

<table  cellspacing="0" width="100%" cellpadding="2" style="padding-top:10px;" class="gridtable">	
	<tbody>
		<tr>
			<td style="text-align:center;"><strong>Application ID</strong></td>
			<td style="text-align:center;"><?php echo $_GET['subID']; ?></td>
		</tr>	
		<tr>
			<td style="text-align:center;"><strong>Application Date</strong></td>
			<td style="text-align:center;"><?php echo $application_created_date; ?></td>
		</tr>
		
		<?php 
			$fieldValuestot = count($fieldValues['UK-FCL-00003_0']);
			if(isset($fieldValuestot) && !empty($fieldValuestot))
			{	
			for($i=0;$i<$fieldValuestot;$i++)
			{ 
		?>
			<tr>
				<td colspan="2" style="background-color:#EEF1F5;">
					<strong>
					Application Details <?Php echo $i+1; ?>
					</strong>
				</td>					
			</tr>
			<tr>
				<td style="text-align:left;"><strong>Salutation</strong></td>
				<td style="text-align:left;">Mr.</td>
			</tr>
			<tr>
				<td style="text-align:left;"><strong>First Name of Applicant</strong></td>
				<td style="text-align:left;"><?php echo @$fieldValues['UK-FCL-00003_0'][$i];?></td>
			</tr>
			<tr>
				<td style="text-align:left;"><strong>Middle Name of Applicant</strong></td>
				<td style="text-align:left;"><?php echo @$fieldValues['UK-FCL-00001_3'][$i];?></td>
			</tr>
			<tr>
				<td style="text-align:left;"><strong>Last Name of Applicant</strong></td>
				<td style="text-align:left;"><?php echo @$fieldValues['UK-FCL-00001_4'][$i];?></td>
			</tr><tr>
				<td style="text-align:left;"><strong>Any former Christian or Surname</strong></td>
				<td style="text-align:left;"><?php echo @$fieldValues['UK-FCL-00001_5'][$i];?></td>
			</tr>
			<tr>
				<td style="text-align:left;"><strong>Present Nationality of Applicant</strong></td>
				<td style="text-align:left;"><?php echo @$fieldValues['UK-FCL-00001_6'][$i];?></td>
			</tr>
			<tr>
				<td style="text-align:left;"><strong>Nationality of Origin</strong></td>
				<td style="text-align:left;"><?php echo @$fieldValues['UK-FCL-00001_7'][$i];?></td>
			</tr>
			<tr>
				<td style="text-align:left;"><strong>Other Business / Occupation of Applicant</strong></td>
				<td style="text-align:left;"><?php echo @$fieldValues['UK-FCL-00001_9'][$i];?></td>
			</tr>
			<tr>
				<td style="text-align:left;"><strong>Address of Applicant</strong></td>
				<td style="text-align:left;"><?php echo @$fieldValues['UK-FCL-00001_8'][$i];?></td>
			</tr>
		<?php }	
			}
		?>	
		<tr>
			<td colspan="2" style="background-color:#EEF1F5;">
				<strong>
				Business Details 
				</strong>
			</td>					
		</tr>
		<tr>
			<td style="text-align:left;"><strong>Name of Business</strong></td>
			<td style="text-align:left;"><?php echo @$fieldValues['UK-FCL-00003_1']; ?></td>
		</tr>
		<tr>
			<td style="text-align:left;"><strong>General Nature of Business</strong></td>
			<td style="text-align:left;"><?php echo @$fieldValues['UK-FCL-00003_2']; ?></td>
		</tr>
		<tr>
			<td style="text-align:left;"><strong>Principal Place of Business</strong></td>
			<td style="text-align:left;"><?php echo @$fieldValues['UK-FCL-00003_3']; ?></td>
		</tr>
		<tr>
			<td style="text-align:left;"><strong>Corporate Name of Corporation</strong></td>
			<td style="text-align:left;"><?php echo @$fieldValues['UK-FCL-00003_4']; ?></td>
		</tr>
		<tr>
			<td style="text-align:left;"><strong>Date of Commencement of Business (if after 15th June, 1940)</strong></td>
			<td style="text-align:left;"><?php echo @$fieldValues['UK-FCL-00003_5']; ?></td>
		</tr>
	</tbody>		
</table>
