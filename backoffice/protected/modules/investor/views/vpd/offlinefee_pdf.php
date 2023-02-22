<table>
    <tr>
    <td style="text-align:center;">     
        <span style="font-size: 14;"><strong>Document Payment Form</strong></span>   <br><br>
     
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
		<td width="95%"><b>Entity Reg. No.: </b> <?= $model['entity_reg_no'] ?></td>
	</tr>
	<tr>
		<td width="5%"></td>
		<td width="95%"><b>Document Category: </b> <?= $model['core_service_name'] ?></td>
	</tr>
	<tr>
		<td width="5%"></td>
		<td width="95%"><b>Document Name: </b> <?= $model['ser_name_for_documentname'] ?>
	    			<?php if($model['doc_name']=='certificate'){
			    				echo 'Certificate';
			    			}else{
			    				echo 'Application PDF';
			    			}
			    			?></td>
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
		<td width="95%"><b>Document Fee (BBD $): </b> <?= $payment_detail['total_fee'] ?></td>
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