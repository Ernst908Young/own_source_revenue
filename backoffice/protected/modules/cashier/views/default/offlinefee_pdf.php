<?php // print_r($model);die;?>
<table>
    <tr>
    <td style="text-align:center;">     
        <span style="font-size: 14;"><strong>Fee Submission Form</strong></span>   <br><br>
     
    </td>
     </tr>
</table>

<table style="padding-top: 10px; font-size: 12; border-collapse: collapse; padding: 5px;">
    
	<tr>
		<td width="5%"></td>
		<td width="95%"><b>Service Name: </b> <?= $model['fees_item'] ?></td>
	</tr>
	<tr>
		<td width="5%"></td>
		<td width="95%"><b>SRN No.: </b> <?= $model['submission_id'] ?></td>
	</tr>
	<tr >
		<td width="5%"></td>
		<td width="95%"><b>Applicant Name: </b> <?= $model['reference_name'] ?></td>
	</tr>
	<tr>
		<td width="5%"></td>
		<td width="95%"><b>Applicant Email: </b> <?= $model['reference_email'] ?></td>
	</tr>
	<tr>
		<td width="5%"></td>
		<td width="95%"><b>Applicant Contact No: </b> <?= $model['reference_number'] ?> </td>
	</tr>
	<tr>
		<td width="5%"></td>
		<td width="95%"><b>Service Fee: </b> <?= $model['total_amount'] ?> </td>
	</tr>
	<tr>
		<td width="5%"></td>
		<td width="95%"><b>Late Fee: </b> 0 </td>
	</tr>
	<tr>
		<td width="5%"></td>
		<td width="95%"><b>Total Fee: </b> <?= $model['total_amount'] ?> </td>
	</tr>
	<tr>
		<td width="5%"></td>
		<td width="95%"><b>Receipt Number: </b> <?= $model['chalan_no'] ?> </td>
	</tr>
	<tr>
		<td width="5%"></td>
		<td width="95%"><b>Cashier Code </b> <?= isset($service_fee['cashier_code'])?$service_fee['cashier_code']:'' ?> </td>
	</tr>

	<tr>
		<td width="5%"></td>
		<td width="95%"><b>Date: </b><?= date('d-m-Y',strtotime($model['created_at'])) ?> </td>
	</tr>

</table>