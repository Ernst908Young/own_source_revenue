<?php

class ReportsController extends Controller
{
	public function actionCafData(){
		$sql="SELECT * FROM bo_application_submission as s 
				INNER JOIN sso_users as u ON u.user_id=s.user_id
				INNER JOIN sso_profiles as up ON up.user_id=u.user_id
				WHERE s.application_status='A' AND s.user_id NOT IN (22,268)";
		$connection=Yii::app()->db; 
		$command=$connection->createCommand($sql);
		$users=$command->queryAll();
		echo '<table width="100%"> <tr><td>S.No</td><td>Department Name</td><td>Unit Name</td><td>Contact Person</td><td>Mob</td><td>Address</td><td>Email ID</td><td>Date</td><td>Status</td><td>CAF ID</td><td>IUID</td></tr>';
		foreach($users as $key=>$datas){
			$field_value_arr = json_decode($datas['field_value'],true);
			echo '<tr>';
			echo '<td>'.($key+1).'</td>';
			echo '<td>DOI</td>';
			echo '<td>'.$field_value_arr['company_name'].'</td>';
			echo '<td>'.$datas['first_name'].' '.$datas['last_name'].'</td>';
			echo '<td>'.$datas['mobile_number'].'</td>';
			echo '<td>'.$field_value_arr['Address'].'</td>';
			echo '<td>'.$datas['email'].'</td>';
			echo '<td>'.$datas['application_created_date'].'</td>';
			echo '<td>'.$datas['application_status'].'</td>';
			echo '<td>'.$datas['submission_id'].'</td>';
			echo '<td>'.$datas['iuid'].'</td>';
			echo '</tr>';
		}
		echo '</table>';
		die;
		//echo 'HELLO<pre>'; print_r($field_value_arr);
	}
}
