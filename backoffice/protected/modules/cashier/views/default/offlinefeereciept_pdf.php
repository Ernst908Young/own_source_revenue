<?php 
$user_id = @$_SESSION['uid'];
$user =  Yii::app()->db->createCommand("SELECT * FROM bo_user WHERE uid = $user_id")->queryRow();
$cname =  $user['full_name'].' '.$user['last_name'].' '.$user['middle_name'];
// print_r($model);?>
<table>
    <tr>
    <td style="text-align:center;">     
        <span style="font-size: 14;"><strong>Payment Successful</strong></span>   <br><br>
     
    </td>
     </tr>
</table>

<table style="padding-top: 10px; font-size: 12; border-collapse: collapse; padding: 5px;">
    
	<tr>
		<td width="5%"></td>
		<td width="95%"><b>Service Name: </b>  <?= str_replace('"','',$model['fees_item']);  ?></td>
	</tr>
	<tr>
		<td width="5%"></td>
		<td width="95%"><b>SRN No.: </b> <?= $model['submission_id'] ?></td>
	</tr>
	<tr>
		<td width="5%"></td>
		<td width="95%"><b>Receipt Number: </b> <?= $model['chalan_no'] ?></td>
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
		<td width="95%"><b>Cashier Name: </b><?= $cname ?> </td>
	</tr>
	<tr>
		<td width="5%"></td>
		<td width="95%"><b>Payment Type: </b><?= $model['payment_type'] ?> </td>
	</tr>
	<?php if($model['payment_type'] != 'Cash'){?>
		<tr>
		<td width="5%"></td>
		<td width="95%"><b>Payment Refrence No: </b><?= $model['payment_offline_detail_no'] ?> </td>
	</tr>
	<tr>
		<td width="5%"></td>
		<td width="95%"><b>Bank Name: </b><?= $model['bank_name'] ?> </td>
	</tr>

	<?php } ?>
	<tr>
		<td width="5%"></td>
		<td width="95%"><b>Date: </b><?= date('d-m-Y',strtotime($model['created_at'])) ?> </td>
	</tr>

</table>