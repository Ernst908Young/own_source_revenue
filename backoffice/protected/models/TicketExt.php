<?php 
class TicketExt extends Roles{
	
	/*  Verify Departmental User record on ost_staff, If user is not found then 
	 *  insert user data in ost_staff and ost_staff_role_mapping, return staff_id 
	 *  @author : Pankaj Kumar Tiwari 
	 *  @Date: 14March 2018
	 */
	 
	public static function getUserStaffId($email_id){
		
		        $ticketModel = new TicketExt;
                $isUserExists=$ticketModel->isUserExistsInStaff($email_id);
				
				$connection=Yii::app()->db;
						
			    
				if($isUserExists!=FALSE){
					
					    // get Staff Id if Staff User Already Exists
					   $user = $connection->createCommand(array(
									'select' => 'staff_id',
									'from'   => 'ost_staff',
									'where'  => 'email=:email',
									'params' => array(':email' => $email_id),
								))->queryRow();	
						
						return !empty($user['staff_id'])?$user['staff_id']:false;
					
				}else{
					
					   // get User Details
					   $userInfo=$ticketModel->getDepartmentalUserInfo($email_id);
					   
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
				
						$ins_qry1 = "INSERT INTO ost_staff SET dept_id='".$dept_id."', role_id='1', username='".$username."', firstname='".$firstname."', lastname='".$lastname."', email='$email_id', phone='', mobile='$mobile_number', isactive=1, isadmin='".$is_admin."', assigned_only='".$assigned_only."', show_assigned_tickets=1, max_page_size=25, auto_refresh_rate=1, default_paper_size='Letter', created='$date',updated='$date'";
						$user = $connection->createCommand($ins_qry1)->execute();
						$staff_id = $connection->getLastInsertID();
						
						// Role Mapping
						
						$ins_role_qry = "INSERT INTO ost_staff_role_mapping SET role_id='$role_id', staff_id='$staff_id', created_at='$date', updated_at='$date'";
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
		
	/*  Is email_id is in ost_staff or not ?  */
	
	    public static function isUserExistsInStaff($email_id){
			
					$connection=Yii::app()->db;
					$user = $connection->createCommand(array(
								'select' => 'staff_id',
								'from'   => 'ost_staff',
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
							'from' => 'ost_staff',
							'where' => 'staff_id=:staff_id',
							'params' => array(':staff_id'=>$staff_id),
						))->queryRow();	
				
				
				return !empty($user['dept_id'])?$user['dept_id']:0;
				
	}
	
	
	/* Get Total ticket By User Staff Id & Role Id
	*  @author : Pankaj Kumar Tiwari 
	*  @Date: 14March 2018
	*/
	public static function getTotalTickets($role_id, $staff_id, $dept_id){
		        $connection=Yii::app()->db;
				$sql_sub_total_ticket='';
				if($role_id==77){
					$sql_sub_total_ticket="WHERE dept_id='$dept_id'";
				}
				
				$sql_total_ticket="SELECT ticket_id  FROM ost_ticket $sql_sub_total_ticket";
				
				$command_total_ticket = $connection->createCommand($sql_total_ticket)->queryAll();
				$total_ticket=count($command_total_ticket);
				
				return ($total_ticket>0)?$total_ticket:0;
				
	}
	
	
	/* Get Total Open Ticket By User Staff Id & Role Id
	* @author : Pankaj Kumar Tiwari 
	* @Date: 14March 2018
	*/
	public static function getTotalOpenTickets($role_id, $staff_id, $dept_id){
		        $connection=Yii::app()->db;
				$sql_sub_open_ticket='';
				
				if($role_id==77){
					$sql_sub_open_ticket="AND  dept_id='$dept_id'";
				}
				
				$sql_open_ticket="SELECT ticket_id  FROM ost_ticket WHERE status_id=1 $sql_sub_open_ticket";
				$command_open_ticket = $connection->createCommand($sql_open_ticket)->queryAll();
				$total_open_ticket=count($command_open_ticket);
				
				return ($total_open_ticket>0)?$total_open_ticket:0;
				
	}
	
	
	/* Get Total Closed Ticket By User Staff Id & Role Id
	* @author : Pankaj Kumar Tiwari 
	* @Date: 14March 2018
	*/
	public static function getTotalClosedTickets($role_id, $staff_id, $dept_id){
		        $connection=Yii::app()->db;
				$sql_sub_closed_ticket='';
				if($role_id==77){
					$sql_sub_closed_ticket="AND  dept_id='$dept_id'";
				}
				
				$sql_total_closed_ticket="SELECT ticket_id  FROM ost_ticket WHERE status_id=3 $sql_sub_closed_ticket";
				$command_total_closed_ticket = $connection->createCommand($sql_total_closed_ticket)->queryAll();
				$total_closed_ticket=count($command_total_closed_ticket);
				
				return ($total_closed_ticket>0)?$total_closed_ticket:0;
				
	}
	
	
	/* Get Total Answered/Responded Ticket By Department
	* @author : Pankaj Kumar Tiwari 
	* @Date: 20March 2018
	*/
	public static function getTotalAnsweredTickets($role_id, $staff_id, $dept_id){
		
		        $connection=Yii::app()->db;
				
				$sql_sub_answered_ticket='';
				if($role_id==77){
					$sql_sub_answered_ticket="AND dept_id='$dept_id'";
				}
				
				$sql_total_answrd_ticket="SELECT ticket_id  FROM ost_ticket WHERE isanswered=1 AND staff_id='$staff_id' $sql_sub_answered_ticket";
				$command_total_answrd_ticket = $connection->createCommand($sql_total_answrd_ticket)->queryAll();
				$total_answrd_ticket=count($command_total_answrd_ticket); 
				
				return ($total_answrd_ticket>0)?$total_answrd_ticket:0;
				
	}
	
	
	/* Get Total Transfered Ticket To Me Staff Id & Role Id
	* @author : Pankaj Kumar Tiwari 
	* @Date: 14March 2018
	*/
	
	public static function getTotalTransferedTickets($role_id, $staff_id){
		        $connection=Yii::app()->db;
				$sql_sub_transfered_ticket='';
				
				$sql_total_transfered_ticket="SELECT ticket_id  FROM ost_ticket WHERE staff_id=$staff_id";
				$command_total_transfered_ticket = $connection->createCommand($sql_total_transfered_ticket)->queryAll();
				$total_transfered_ticket=count($command_total_transfered_ticket); 
				
				return ($total_transfered_ticket>0)?$total_transfered_ticket:0;
				
	}
	
	
	/* Get Ticket Listing By User Staff Id & Role Id
	* @author : Pankaj Kumar Tiwari 
	* @Date: 14March 2018
	*/
	public static function getTickets($role_id, $staff_id, $page, $dept_id){
		        $connection=Yii::app()->db;
				$sql_get_ticket='';
				if($role_id==77){
					$sql_get_ticket="WHERE t.dept_id='$dept_id'";
				}
				
				
				$sql="SELECT t.*,  u.name, otc.subject, otc.priority, ots.name as tstatus, otp.priority as priority_title FROM ost_ticket as t JOIN ost_ticket_status as ots ON
				ots.id=t.status_id JOIN ost_ticket__cdata as otc ON otc.ticket_id=t.ticket_id JOIN ost_ticket_priority as
				otp ON otp.priority_id=otc.priority JOIN ost_user as u ON u.id=t.user_id $sql_get_ticket ORDER BY t.ticket_id DESC";
				
				$offset=(($page>0)?(($page-1)*10):0);
			    $tickets = $connection->createCommand($sql." limit 10 offset ".$offset)->queryAll();
			   
			    $all_tickets=array();
			   
			    if(!empty($tickets)){
				   foreach($tickets as $key=>$ticket){
					   
					        $staff_user = $connection->createCommand(array(
								'select' => 'firstname',
								'from' => 'ost_staff',
								'where' => 'staff_id=:staff_id',
								'params' => array(':staff_id'=>$ticket['staff_id']),
							))->queryRow();
					   
				   
				            $ticket['firstname']=$staff_user['firstname'];
							$all_tickets[]=$ticket;
				   
				   
				   }
			    } 
				
				return !empty($all_tickets)?$all_tickets:array();
				
	}  
	
	
	
	
	
	

	
}
	

?>