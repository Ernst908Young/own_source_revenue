<?php 
$user_id = @$_SESSION['uid'];
$user =  Yii::app()->db->createCommand("SELECT * FROM bo_user WHERE uid = $user_id")->queryRow();
$cname =  $user['full_name'].' '.$user['last_name'].' '.$user['middle_name'];
// print_r($model);?>
<table>
    <tr>
    <td style="text-align:center;">     
        <span style="font-size: 14;"><strong>Refund Successful</strong></span>   <br><br>
     
    </td>
     </tr>
</table>

<table style="padding-top: 10px; font-size: 12; border-collapse: collapse; padding: 5px;">
    
	<tr>
		<td width="5%"></td>
		<td width="95%"><b>Service Name: </b> <?= str_replace('"','',$model['fees_item']); ?></td>
	</tr>
	<tr>
		<td width="5%"></td>
		<td width="95%"><b>SRN No: </b> <?=  $model['submission_id'] ?></td>
	</tr>
	<tr>
		<td width="5%"></td>
		<td width="95%"><b>National Registration: </b> <?=  !empty($refund_request['national_registration'])?$refund_request['national_registration']:'NA'?></td>
	</tr>
	<tr>
		<td width="5%"></td>
		<td width="95%"><b>NIS No: </b> <?=  !empty($refund_request['nis_number'])?$refund_request['nis_number']:'NA'?></td>
	</tr>
	<tr >
		<td width="5%"></td>
		<td width="95%"><b>Service Fee: </b>  $ <?= $model['service_total_fee'] ?> </td>
	</tr>
	
	<tr>
		<td width="5%"></td>
		<td width="95%"><b>Receipt Number: </b> <?= $model['chalan_no'] ?></td> 
	</tr>
	
	<tr>
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
		<td width="95%"><b>Cashier Name: </b><?= $cname ?> </td>
	</tr>
	<tr>
		<td width="5%"></td>
		<td width="95%"><b>Reason for Change (Refund): </b><?= !empty($refund_request['reason_for_change'])?$refund_request['reason_for_change']:'NA'?> </td>
	</tr>
	<tr>
		<td width="5%"></td>
		<td width="95%"><b>Payment Refrence No: </b><?= $model['payment_offline_detail_no']?></td>
	</tr>
	<tr>
		<td width="5%"></td>
		<td width="95%"><b>Date: </b><?= date('d-m-Y',strtotime($model['created_at'])) ?> </td>
	</tr>

</table>