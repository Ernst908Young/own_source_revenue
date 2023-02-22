<?php // print_r($model);?>
<table>
    <tr>
    <td style="text-align:center;">     
        <span style="font-size: 14;"><strong>Application For Refund</strong></span>   <br><br>
     
    </td>
     </tr>
</table>

<table style="padding-top: 10px; font-size: 12; border-collapse: collapse; padding: 5px;">
    <tr>
		<td width="5%"></td>
		<td width="95%"><b>Date: </b><?= date('d-m-Y',strtotime($model['created_at'])) ?> </td>
	</tr>
	<tr >
		<td width="5%"></td>
		<td width="95%"><b>Name of Applicant: </b> <?= $model['name'] ?></td>
	</tr>
	<tr>
		<td width="5%"></td>
		<td width="95%"><b>Signature of Applicant: </b></td>
	</tr>
	<tr>
		<td width="5%"></td>
		<td width="95%"><b>Address: </b> <?= $model['address'] ?> </td>
	</tr>
	<tr>
		<td width="5%"></td>
		<td width="95%"><b>National Registration: </b><?= !empty($model['national_registration'])?$model['national_registration']:'NA' ?> </td>
	</tr>
	<tr>
		<td width="5%"></td>
		<td width="95%"><b>NIS Number: </b><?= !empty($model['nis_number'])?$model['nis_number']:'NA' ?> </td>
	</tr>
	<tr>
		<td width="5%"></td>
		<td width="95%"><b>Comapny Name: </b><?= $model['company_name'] ?> </td>
	</tr>
	<tr>
		<td width="5%"></td>
		<td width="95%"><b>Company Address: </b><?= $model['company_address'] ?> </td>
	</tr>
	<tr>
		<td width="5%"></td>
		<td width="95%"><b>Reason for Change (Refund): </b> <?= $model['reason_for_change'] ?>  </td>
	</tr>
	<tr>
		<td width="5%"></td>
		<td width="95%"><b>Amount Requested for Refund: </b>$ <?= $model['amount'] ?> </td>
	</tr>
	<tr>
		<td width="5%"></td>
		<td width="95%"><b>Officer Submitting Request: </b><?= !empty($model['officer_submiting_req'])?$model['officer_submiting_req']:'NA'?>  </td>
	</tr>
	<tr>
		<td width="5%"></td>
		<td width="95%"><b>Date: </b><?= date('d-m-Y',strtotime($model['created_at'])) ?> </td>
	</tr>
	<tr>
		<td width="5%"></td>
		<td width="95%"><small>NB: Please attach the Original Receipt to assist with processing</small></td>
	</tr>
</table>