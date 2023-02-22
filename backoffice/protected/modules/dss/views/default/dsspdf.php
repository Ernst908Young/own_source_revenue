<style>
	table, td {
  border: .5px solid black;
     border-collapse: collapse;
  padding: 5px;
}
</style>
<?php if($category=='entities'){ ?>
	<table>
		<tr>
			<td>Total no. of registered entities</td>
			<td>Total No. of Active Entities</td>
			<td>Total No. of Dissolved Entities</td>
			<td>Total No. of Amalgamated Entities</td>
			<td>Total No. of Closed Entities</td>
			
		</tr>
		<tr>
			<td><strong><?php $total =  $data_array['active_entity']+$data_array['dissolved_entity']+$data_array['amalgamated_entity']+$data_array['closed_entity'];
                         echo $total
                          ?></strong></td>
			<td><strong><?= $data_array['active_entity'] ?></strong></td>
			<td><strong><?= $data_array['dissolved_entity'] ?></strong></td>
			<td><strong><?= $data_array['amalgamated_entity'] ?></strong></td>
			<td><strong><?= $data_array['closed_entity'] ?></strong></td>
			
		</tr>
	</table>
<?php } ?>

<?php if($category=='filings'){ ?>
	<table>
		<tr>
			<td>Total number of forms filed</td>
			<td>Total number of forms reverted</td>
			<td>Total number of forms rejected</td>
			<td>Total number of forms approved</td>
			
			
		</tr>
		<tr>
			<td><strong><?php $total = $data_array['app_count']['reverted']+$data_array['app_count']['rejected']+$data_array['app_count']['approved'];
                         echo $total; ?></strong></td>
			<td><strong><?= $data_array['app_count']['reverted'] ?></strong></td>
			<td><strong><?= $data_array['app_count']['rejected'] ?></strong></td>
			<td><strong><?= $data_array['app_count']['approved'] ?></strong></td>
			
			
		</tr>
	</table>
<?php } ?>

<?php if($category=='helpdesk'){ ?>
	<table>
		<tr>
			<td>Total No. tickets</td>
			<td>Total No. of Grievances</td>
			<td>Total No. of Queries</td>
			
		</tr>
		<tr>
			<td><strong><?= $data_array['t_count'] ?></strong></td>
			<td><strong><?= $data_array['g_count'] ?></strong></td>
			<td><strong><?= $data_array['q_count'] ?></strong></td>
			
		</tr>
	</table>

<?php } ?>

<?php if($category=='revenue'){ ?>
	<table>
		<tr>
			<td>Total revenue collected</td>
			<td>Revenue collected as service fee for forms/services</td>
			<td>Revenue collected as penalty/Additional Fee</td>
			
		</tr>
		<tr>
			<td><strong><?php $total = $data_array['service_fee']['service_total_fee']+$data_array['service_fee']['late_fee']+$data_array['service_provider_late_fee']['total_fee']+$data_array['vpd_fee']['total_fee'];
                            echo $total;
                          ?></strong></td>
			<td><strong><?= $data_array['service_fee']['service_total_fee'] ? $data_array['service_fee']['service_total_fee'] : 0; ?></strong></td>
			<td><strong><?php $a_total = $data_array['service_fee']['late_fee']+$data_array['service_provider_late_fee']['total_fee']+$data_array['vpd_fee']['total_fee'];
                            echo $a_total;
                          ?></strong></td>
			
		</tr>
	</table>
<?php } ?>
<?php if($category=='service provider'){ ?>
	<table>
		<tr>
			<td>Total number of registered service providers</td>
			<td>Total number of active CTSP</td>
			<td>Total number of active CR</td>
			<td>Total number of de-registered CTSP</td>
			<td>Total number of de-registered CR</td>

			
		</tr>
		<tr>
			<td><strong><?php $total = $data_array['sp_user_count']['ctsp_active']+$data_array['sp_user_count']['cr_active']+$data_array['sp_user_count']['ctsp_deactive']+$data_array['sp_user_count']['cr_deactive'];
                            echo $total;
                          ?></strong></td>
			<td><strong><?= $data_array['sp_user_count']['ctsp_active'] ? $data_array['sp_user_count']['ctsp_active'] : 0 ?></strong></td>
			<td><strong><?= $data_array['sp_user_count']['cr_active'] ? $data_array['sp_user_count']['cr_active'] : 0 ?></strong></td>
			<td><strong><?= $data_array['sp_user_count']['ctsp_deactive'] ? $data_array['sp_user_count']['ctsp_deactive'] : 0 ?></strong></td>
			<td><strong><?= $data_array['sp_user_count']['cr_deactive'] ? $data_array['sp_user_count']['cr_deactive'] : 0 ?></strong></td>
		</tr>
	</table>
<?php } ?>
<?php if($category=='BO user analysis'){ ?>
	<table>
		<tr>
			<td>Total number of forms filed by users</td>
			<td>Total number of forms processed by a BO user</td>
			<td>No. of forms forwarded to approver</td>
			<td>No. of forms approved by a BO user</td>
			<td>No. of forms rejected by a BO user</td>
			<td>No. of forms reverted by a BO user</td>
		</tr>
		<tr>
			<td><strong><?= $data_array['res']['submission_id'] ? $data_array['res']['submission_id'] : 0 ?></strong></td>
			<td><strong><?php  $total_process = $data_array['res']['fa_app']+$data_array['res']['approved_app']+$data_array['res']['rejected_app']+$data_array['res']['reverted_app'];
                            echo $total_process;
                          ?></strong></td>
			<td><strong><?= $data_array['res']['fa_app'] ? $data_array['res']['fa_app'] : 0 ?></strong></td>
			<td><strong><?= $data_array['res']['approved_app'] ? $data_array['res']['approved_app'] : 0 ?></strong></td>
			<td><strong><?= $data_array['res']['rejected_app'] ? $data_array['res']['rejected_app'] : 0 ?></strong></td>
			<td><strong><?= $data_array['res']['reverted_app'] ? $data_array['res']['reverted_app'] : 0 ?></strong></td>
		</tr>
	</table>
<?php } ?>
