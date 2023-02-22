<table>
    <tr>
    <td style="text-align:center;">     
        <span style="font-size: 14;"><strong>CTSP Late Fee Submission Form</strong></span>   <br><br>
     
    </td>
     </tr>
</table>

<table style="padding-top: 10px; font-size: 12; border-collapse: collapse; padding: 5px;">
    
	<tr>
		<td width="5%"></td>
		<td width="95%"><b>Entity Name: </b> <?= $company['company_name'] ?></td>
	</tr>
	<tr>
		<td width="5%"></td>
		<td width="95%"><b>Entity Reg. No.: </b> <?= $company['reg_no'] ?></td>
	</tr>
	<tr >
		<td width="5%"></td>
		<td width="95%"><b>Applicant Name: </b> <?= $app_details['app_name'] ?></td>
	</tr>
	<tr>
		<td width="5%"></td>
		<td width="95%"><b>Applicant Email: </b> <?= $app_details['email'] ?></td>
	</tr>
	<tr>
		<td width="5%"></td>
		<td width="95%"><b>Applicant Contact No: </b> <?= $app_details['mobile_no'] ?> </td>
	</tr>

	<tr>
		<td width="5%"></td>
		<td width="95%"><b>Late Fee (BBD $): </b> <?= $model['late_fee'] ?></td>
	</tr>
	
	<tr>
		<td width="5%"></td>
		<td width="95%"><b>Receipt Number: </b> <?= $payment_detail['recipet_no'] ?> </td>
	</tr>


	<tr>
		<td width="5%"></td>
		<td width="95%"><b>Date: </b><?= date('d-m-Y',strtotime($payment_detail['created_on'])) ?> </td>
	</tr>

</table>