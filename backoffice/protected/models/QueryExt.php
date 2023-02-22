<?php 
class QueryExt extends Roles{
	
	/* Verify Departmental User record on qry_ost_staff, If user is not found then 
	 * Insert user data and return staff_id 
	 * @author : Pankaj Kumar Tiwari 
	 * @Date: 14March 2018
	*/
	public static function getUserStaffId($email_id){
		        $queryModel = new QueryExt;
                $isUserExists=$queryModel->isUserExistsInStaff($email_id);
				
				$connection=Yii::app()->db;
				if($isUserExists!=FALSE){
					
					    // get Staff Id if Staff User Already Exists
					   $user = $connection->createCommand(array(
									'select' => 'staff_id',
									'from' => 'qry_ost_staff',
									'where' => 'email=:email',
									'params' => array(':email'=>$email_id),
								))->queryRow();	
								
						return !empty($user['staff_id'])?$user['staff_id']:false;
					
				}else{
					
					   // get User Details
					   $userInfo=$queryModel->getDepartmentalUserInfo($email_id);
					   
					   $email_id=$userInfo['email'];
					   list($username,$email_ext) = explode("@",$email_id);
					   
					   $full_name=(!empty($userInfo['full_name'])?$userInfo['full_name']:'');
				       $name = trim($full_name);
					   $parts = explode(' ', $name);

					   $firstname = trim($parts[0]);
						
					   array_shift($parts);
					   $last_name='';
					   $lastname=((!empty($parts) && isset($parts))?implode(' ', $parts):''); 
					   
					   $mobile_number=$userInfo['mobile'];
					   $dept_id=$userInfo['dept_id'];
					   $role_id=$userInfo['role_id'];
					   $is_admin=((($role_id==75)  || ($role_id==77))?1:0);
				       $assigned_only=((($role_id==75)  || ($role_id==77))?0:1);
					   $date=date("Y-m-d H:i:s");
					   
					    // Insert User
				
						$ins_qry1 = "INSERT INTO qry_ost_staff SET dept_id='".$dept_id."', role_id='1', username='".$username."', firstname='".$firstname."', lastname='".$lastname."', email='$email_id', phone='', mobile='$mobile_number', isactive=1, isadmin='".$is_admin."', assigned_only='".$assigned_only."', show_assigned_tickets=1, max_page_size=25, auto_refresh_rate=1, default_paper_size='Letter', created='$date',updated='$date'";
						$user = $connection->createCommand($ins_qry1)->execute();
						$staff_id = $connection->getLastInsertID();
						
						// Role Mapping
						
						$ins_role_qry = "INSERT INTO qry_ost_staff_role_mapping SET role_id='$role_id', staff_id='$staff_id', created_at='$date', updated_at='$date'";
						$connection->createCommand($ins_role_qry)->execute();
						 
					    return !empty($staff_id)?$staff_id:false;
					
				}	
				
	}
	
	
	/*  Get User Info from bo_user record by email_id  */
	
	    public static function getDepartmentalUserInfo($email_id){
					$connection=Yii::app()->db;
					
					$sql="SELECT b.full_name, b.email, b.mobile, b.dept_id, br.role_id FROM bo_user as b JOIN bo_user_role_mapping br ON br.user_id=b.uid WHERE b.email='".$email_id."'";
					$user = $connection->createCommand($sql)->queryRow();
					
					return !empty($user)?$user:array();
					
		}
		
	/*  Is email_id is in qry_ost_staff or not ?  */
	
	    public static function isUserExistsInStaff($email_id){
			
					$connection=Yii::app()->db;
					$user = $connection->createCommand(array(
								'select' => 'staff_id',
								'from'   => 'qry_ost_staff',
								'where'  => 'email=:email',
								'params' => array(':email'=>$email_id),
							))->queryRow();	
					
					return !empty($user['staff_id'])?true:false;
					
					
		}
	
	/* Get Staff User Primary Department Id
	* @author : Pankaj Kumar Tiwari 
	* @Date: 20March 2018
	*/
	public static function getUserDepartmentId($staff_id){
		        $connection=Yii::app()->db;
				$user = $connection->createCommand(array(
							'select' => 'dept_id',
							'from' => 'qry_ost_staff',
							'where' => 'staff_id=:staff_id',
							'params' => array(':staff_id'=>$staff_id),
						))->queryRow();	
				
				
				return !empty($user['dept_id'])?$user['dept_id']:0;
				
	}
	
	
	/* Get Total Query By User Staff Id & Role Id
	* @author : Pankaj Kumar Tiwari 
	* @Date: 14March 2018
	*/
	public static function getTotalQuery($role_id, $staff_id, $dept_id){
		        $connection=Yii::app()->db;
				$sql_sub_total_qry='';
				if($role_id==77){
					$sql_sub_total_qry="WHERE dept_id='$dept_id'";
				}
				
				$sql_total_qry="SELECT ticket_id  FROM qry_ost_ticket $sql_sub_total_qry";
				$command_total_qry = $connection->createCommand($sql_total_qry)->queryAll();
				$total_qry=count($command_total_qry);
				
				return ($total_qry>0)?$total_qry:0;
				
	}
	
	
	/* Get Total Query By User Staff Id & Role Id
	* @author : Pankaj Kumar Tiwari 
	* @Date: 14March 2018
	*/
	public static function getTotalOpenQuery($role_id, $staff_id, $dept_id){
		        $connection=Yii::app()->db;
				$sql_sub_open_qry='';
				if($role_id==77){
					$sql_sub_open_qry="AND dept_id='$dept_id'";
				}
				
				$sql_open_qry="SELECT ticket_id  FROM qry_ost_ticket WHERE status_id=1 $sql_sub_open_qry";
				$command_open_qry = $connection->createCommand($sql_open_qry)->queryAll();
				$total_open_qry=count($command_open_qry);
				
				return ($total_open_qry>0)?$total_open_qry:0;
				
	}
	
	
	/* Get Total Closed Query By User Staff Id & Role Id
	* @author : Pankaj Kumar Tiwari 
	* @Date: 14March 2018
	*/
	public static function getTotalClosedQuery($role_id, $staff_id, $dept_id){
		        $connection=Yii::app()->db;
				$sql_sub_closed_qry='';
				if($role_id==77){
					$sql_sub_closed_qry="AND dept_id='$dept_id'";
				}
				
				$sql_total_closed_qry="SELECT ticket_id  FROM qry_ost_ticket WHERE status_id=3 $sql_sub_closed_qry";
				$command_total_closed_qry = $connection->createCommand($sql_total_closed_qry)->queryAll();
				$total_closed_qry=count($command_total_closed_qry);
				
				return ($total_closed_qry>0)?$total_closed_qry:0;
				
	}
	
	
	/* Get Total Answered/Responded Query By Department
	* @author : Pankaj Kumar Tiwari 
	* @Date: 20March 2018
	*/
	public static function getTotalAnsweredQuery($role_id, $staff_id, $dept_id){
		
		        $connection=Yii::app()->db;
				
				$sql_sub_answered_ticket='';
				if($role_id==77){
					$sql_sub_answered_ticket="AND dept_id='$dept_id'";
				}
				
				$sql_total_answrd_ticket="SELECT ticket_id  FROM qry_ost_ticket WHERE isanswered=1 AND staff_id='$staff_id' $sql_sub_answered_ticket";
				$command_total_answrd_qry = $connection->createCommand($sql_total_answrd_ticket)->queryAll();
				$total_answrd_qry=count($command_total_answrd_qry); 
				
				return ($total_answrd_qry>0)?$total_answrd_qry:0;
				
	}
	
	
	/* Get Total Transfered Query To Me Staff Id & Role Id
	* @author : Pankaj Kumar Tiwari 
	* @Date: 14March 2018
	*/
	public static function getTotalTransferedQuery($role_id, $staff_id){
		        $connection=Yii::app()->db;
				$sql_total_transfered_qry="SELECT ticket_id  FROM qry_ost_ticket WHERE staff_id=$staff_id";
				$command_total_transfered_qry = $connection->createCommand($sql_total_transfered_qry)->queryAll();
				$total_transfered_qry=count($command_total_transfered_qry); 
				
				return ($total_transfered_qry>0)?$total_transfered_qry:0;
				
	}
	
	
	/* Get Query Listing By User Staff Id & Role Id
	* @author : Pankaj Kumar Tiwari 
	* @Date: 14March 2018
	*/
	public static function getAllQuery($role_id, $staff_id, $page, $dept_id){ 
		        $connection=Yii::app()->db;
				$sql_get_qry='';
				if($role_id==77){
					$sql_get_qry="WHERE t.dept_id='$dept_id'";
				}
				
				$sql="SELECT t.*,  u.name, otc.subject, otc.priority, ots.name as tstatus, otp.priority as priority_title FROM qry_ost_ticket as t JOIN qry_ost_ticket_status as ots ON
				ots.id=t.status_id JOIN qry_ost_ticket__cdata as otc ON otc.ticket_id=t.ticket_id JOIN qry_ost_ticket_priority as
				otp ON otp.priority_id=otc.priority JOIN qry_ost_user as u ON u.id=t.user_id $sql_get_qry ORDER BY t.ticket_id DESC";
				
				$offset=(($page>0)?(($page-1)*10):0);
			    $queries = $connection->createCommand($sql." limit 10 offset ".$offset)->queryAll();
			   
			    $all_qry=array();
			   
			    if(!empty($queries)){
				   foreach($queries as $key=>$qry){
					   
					        $staff_user = $connection->createCommand(array(
								'select' => 'firstname',
								'from' => 'qry_ost_staff',
								'where' => 'staff_id=:staff_id',
								'params' => array(':staff_id'=>$qry['staff_id']),
							))->queryRow();
					   
				   
				            $qry['firstname']=$staff_user['firstname'];
							$all_qry[]=$qry;
				   
				   
				   }
			    } 
				
				return !empty($all_qry)?$all_qry:array();
				
	}
	
	
	/* Get Query Listing By User Id and Ticket No.
	* @author : Pankaj Kumar Tiwari 
	* @Date: 14March 2018
	*/
	
	public static function getQueryByTicketNo($user_id, $ticket_no){ 
	
		        $connection=Yii::app()->db;
				
				$sql="SELECT t.*,  u.name, otc.subject, otc.priority, ots.name as tstatus, otp.priority as priority_title, qe.address FROM qry_ost_ticket as t JOIN qry_ost_user_email as qe ON qe.user_id=t.user_id JOIN qry_ost_ticket_status as ots ON
				ots.id=t.status_id JOIN qry_ost_ticket__cdata as otc ON otc.ticket_id=t.ticket_id JOIN qry_ost_ticket_priority as
				otp ON otp.priority_id=otc.priority JOIN qry_ost_user as u ON u.id=t.user_id WHERE t.user_id='".$user_id."' AND t.number='".$ticket_no."'";
				
				$query = $connection->createCommand($sql)->queryRow(); 
				
				if(!empty($query)){
					$staff_id=$query['staff_id'];
				    $user_info = $connection->createCommand(array(
								'select' => 'firstname',
								'from' => 'qry_ost_staff',
								'where' => 'staff_id=:staff_id',
								'params' => array(':staff_id'=>$staff_id),
							))->queryRow();
					   
				   
				            $first_name=!empty($user_info)?$user_info['firstname']:'';
							$query['first_name']=$first_name;
				}			
							
				return !empty($query)?$query:array(); 
				
	}
	
	

	
}
	

?>