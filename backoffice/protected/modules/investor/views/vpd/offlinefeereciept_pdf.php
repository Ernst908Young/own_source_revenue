<?php 
$cname = NULL;
if(isset($model['received_by'])){
	if($model['received_by']){
		$user =  Yii::app()->db->createCommand("SELECT * FROM bo_user WHERE uid = ".$model['received_by'])->queryRow();
		$cname =  $user['full_name'].' '.$user['last_name'].' '.$user['middle_name'];
	}
}

// print_r($model);
?>
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
		<td width="95%"><b>Entity Name: </b> <?= $model['company_name'] ?></td>
	</tr>
	<tr>
		<td width="5%"></td>
		<td width="95%"><b>Document Name: </b> 

			<?php
				echo $model['ser_name_for_documentname'];
			 if($model['doc_name']='certificate'){
				echo ' Certificate';
			}else{
				echo ' Application Form';
			} ?>
		</td>
	</tr>
	<tr >
		<td width="5%"></td>
		<td width="95%"><b>Document Fee (BBD $): </b> <?= $model['total_fee'] ?></td>
	</tr>
	<tr>
		<td width="5%"></td>
		<td width="95%"><b>Receipt Number: </b> <?= $model['recipet_no'] ?></td>
	</tr>
	<tr >
		<td width="5%"></td>
		<td width="95%"><b>Applicant Name: </b> <?= $model['app_name'] ?></td>
	</tr>
	
	<tr>
		<td width="5%"></td>
		<td width="95%"><b>Applicant Email: </b><?= $model['email'] ?></td>
	</tr>
	<tr>
		<td width="5%"></td>
		<td width="95%"><b>Applicant Contact No: </b><?= $model['mobile_no'] ?> </td>
	</tr>
	<tr>
		<td width="5%"></td>
		<td width="95%"><b>Cashier Name: </b><?= $cname ?> </td>
	</tr>
	<tr>
		<td width="5%"></td>
		<td width="95%"><b>Payment Type: </b><?= $model['payment_type'] ?> </td>
	</tr>
	<?php if($model['payment_type'] != 'Cash'){ ?>
		<tr>
		<td width="5%"></td>
		<td width="95%"><b>Payment Refrence No: </b><?= $model['reference_no'] ?> </td>
	</tr>
	<tr>
		<td width="5%"></td>
		<td width="95%"><b>Bank Name: </b><?= $model['bank_name'] ?> </td>
	</tr>

	<?php } ?>
	<tr>
		<td width="5%"></td>
		<td width="95%"><b>Date: </b><?= date('d-m-Y',strtotime($model['created_on'])) ?> </td>
	</tr>

</table>