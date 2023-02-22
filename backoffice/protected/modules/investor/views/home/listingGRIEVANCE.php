<div class='portlet box green'>
<div class='portlet-title'>
    <div class='caption' style="padding-top: 14px;">
        <i style=" font-size:14px;" class='fa fa-file'></i>Grievance</div>
    <div class='tools'> </div>
	
</div>

 <div class="portlet-body">
 <table class="table table-striped table-bordered table-hover" id="sample_2" >
           
        <thead>
        <tr>
            <th  width="3%">S. No.</th>
			<th  width="20%">Grievance No <br> & Title</th>
            <th  width="10%">Company Contact <br> & Reported By</th>
			<!--<th  width="10%">Assigned To</th>-->
			<th  width="5%">Status</th>
            <th  width="10%">District</th>          
            <th  width="10%">Department</th>
			<th  width="10%">Topic</th>
			<th  width="7%">CAF/Service</th>
			<th  width="10%">Aging</th>
			<th  width="5%">Action</th>
        </tr>
        </thead>	  
	  <?php
	
	    if(!empty(@$_SESSION['RESPONSE']['user_id'])){
          $user_id=@$_SESSION['RESPONSE']['user_id'];
		  $name =  $_SESSION['RESPONSE']['first_name'].' '. $_SESSION['RESPONSE']['last_name'];
	      $email =  $_SESSION['RESPONSE']['email'];
	      $phone = $_SESSION['RESPONSE']['mobile_number'];
        }else if($_SESSION && ($_GET['uid']) && ($_GET['uid'] != '') && ($_GET['iuid']) && ($_GET['iuid'] != '')){           
          $user_id= base64_decode($_GET['uid']);          
	  	  $result=Yii::app()->db->createCommand("select * from sso_users LEFT JOIN sso_profiles on sso_users.user_id=sso_profiles.user_id where sso_users.user_id=$user_id")->queryRow();
		  $name =  $result['first_name'].' '. $result['last_name'];
	      $email =  $result['email'];
	      $phone = $result['mobile_number'];									
		}else{
          $user_id=0;
		}




		 	$fromToDateCondition = '';
			if(!isset($financial_year)) {
			$financial_year='ALL';
			}
			if($financial_year=="ALL"){ $startdate=date('Y-m-d', strtotime("2015-04-01")); $enddate=date('Y-m-d'); }
			else if($financial_year!="ALL"){
			$data=explode("-",$financial_year); $startdate=$data[0]."-04-01"; $enddate=$data[1]."-03-31";
			}
			
			else {
			$fDate = date('Y-m-d');

			$keyy=explode("-",$fDate);
			$todayDate=date('Y-m-d', strtotime($fDate));
			$sdate=$keyy[0]."-04-01";
			$DateBegin = date('Y-m-d', strtotime($sdate));
			$yy=$keyy[0]; $yy1=$keyy[0]+1; $yy2=$keyy[0]-1;

			if (($todayDate >= $DateBegin)) { $financial_year=$yy."-".$yy1; }
			else if (($todayDate < $DateBegin)) { $financial_year=$yy2."-".$yy; }
			$data=explode("-",$financial_year);
			$startdate=$data[0]."-04-01";
			$enddate=date('Y-m-d'); }

			$enddate=date('Y-m-d',strtotime($enddate. '+1 day'));
             // From Date
            if(isset($startdate)){
             $fromToDateCondition .= " AND DATE(bg.grievence_created_on)>='".$startdate."'";
            }
            // To Date
            if(isset($enddate)){
             $fromToDateCondition .= " AND DATE(bg.grievence_created_on)<='".$enddate."'";
            }
	  $sql = "SELECT  bg.grievence_no,bg.grievance_status,bg.grievence_title,comapany_name,created_date,distric_name,department_name,grievence_topic,bgfd.caf_id as caf_id,
				ref_number,bsa.app_id,status_change_date,bgd.user_name ,bd.district_id , bsa.app_name as appname, bgd.dept_id from bo_grievance bg 
				inner join bo_grievance_detail bgd on bg.grievence_no = bgd.grievence_no 
				left join bo_district bd on bgd.district_id = bd.district_id 
				left join bo_departments bgdpt on bgd.dept_id = bgdpt.dept_id
				left join bo_grievance_for_detail bgfd on bg.grievence_no = bgfd.grievance_id 
				left join bo_sp_applications bsa on bsa.app_id = bgfd.ref_number 
				left join bo_grievance_status_detail bgsd on bgsd.grievence_no = bgd.grievence_no
				WHERE bg.grievence_created_by = '".$email."' $fromToDateCondition";
	  $connection=Yii::app()->db;
	  $command=$connection->createCommand($sql);	  
	  $griev=$command->queryAll();
	  //echo '<pre>';print_r($griev);die;	  
	  $count = 1;
	  foreach($griev as $key=>$grv){
	  //echo '<pre>';print_r($griev);die;
	   $disid = $grv['district_id'];
	   $deparId=$grv['dept_id']; if($deparId==1){ 
			$sql="SELECT * FROM bo_user usr INNER JOIN bo_user_role_mapping rm ON rm.user_id=usr.uid WHERE usr.dept_id=$deparId and usr.disctrict_id=$disid  and rm.role_id=7";
			} else {
			$sql="SELECT * FROM bo_user usr INNER JOIN bo_user_role_mapping rm ON rm.user_id=usr.uid WHERE usr.dept_id=$deparId and usr.disctrict_id=$disid  and rm.role_id=3";
			} 
			$connection=Yii::app()->db; 
			$command=$connection->createCommand($sql);
			$Fields=$command->queryRow();	
	 ?>

					<tr>
						<td><?php echo $count; ?></td>
						<td><?php echo "<i class='fa fa-building-o'></i>&nbsp;Grievance No : <b>" . $grv['grievence_no']. '</b><br>';
								  echo "<i class='fa fa-file-o'></i>&nbsp;".$grv['grievence_title'];?>
						</td>
						<td><?php echo "<i class='fa fa-file-o'></i>&nbsp;".$grv['comapany_name']."<br>";
								  echo "<i class='fa fa-user'></i>&nbsp;".$grv['user_name']; ?></td>
						<!--<td align="left"><?php //echo $Fields['full_name']; ?><br /><i class='fa fa-mobile'></i> <?php //echo $Fields['mobile']; ?></td>-->
						<td><?php $status=$grv['grievance_status']; if($status=='O'){echo "Open";} 
							if($status=='C'){echo "Closed";;} 
							if($status==''){echo "NA";} ?></td>
						<td><?php echo $grv['distric_name']; ?></td>
						<td><?php echo $grv['department_name']; ?></td>
						<td><?php echo $grv['grievence_topic']; ?></td>
						<td><?php if($grv['caf_id'] != '') echo 'CAF - '.$grv['caf_id']; 
									else if($grv['ref_number'] != '') echo $grv['ref_number'].' | '. $grv['department_name'] .' | '.$grv['appname']; 
									else echo '';?>
						</td>
						
						<td>
						
						<?php 
						if(isset($grv['grievence_no']) && $grv['grievence_no']!= ''){
							$grv_no = $grv['grievence_no'];
							$sql="SELECT status_change_date from bo_grievance_status_detail where grievence_no=$grv_no ORDER BY status_change_date DESC limit 1 ";
							$connection=Yii::app()->db;
							$command=$connection->createCommand($sql);
							$datefirst=$command->queryRow();
							if(empty($datefirst)){$datefirst['status_change_date']=date('Y-m-d H:i:s');} 
                           				
				$diffapplicant=0;
                                
		$diff = abs(strtotime($datefirst['status_change_date']) - strtotime($grv['created_date'])); 
		$diffapplicant = $diffapplicant + $diff;
		$years = floor($diff / (365 * 60 * 60 * 24));
		$months = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
		$days = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));
		$hours = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24) / (60 * 60));
		$minuts = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60) / 60);
		$seconds = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60 - $minuts * 60));
        $allDays = ($months * 30) + $days;
						echo $allDays." days, "; echo $hours." hrs, "; echo $minuts." min";}?>
						</td>
						<td>
						
						<?php echo  "<a href='".Yii::app()->createAbsoluteUrl("mis/GrievanceReport/greviencedetail/gid/".$grv["grievence_no"]."/d1/".$startdate."/d2/".$enddate."/panel/investor/financial_year/".$financial_year."/type/GRIEVANCE")."'>View Detail</a>";?>
						
						 </td>
						

					</tr>
					<?php
					
					$count = $count+1;
	  }	
	
	?>
	
	    </table>


	  
	  
	  
	  
	  
	       <!--<div class="col-md-6">
        <div class="todo-content">
            <div class="portlet light ">

                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-bar-chart font-green-sharp hide"></i>
                        <span class="caption-helper">Explored:</span> &nbsp;
                        <span class="caption-subject font-green-sharp bold uppercase">
                            <?php /*
				if(isset($_GET['grevience_id']) && $_GET['grevience_id'] != '')	{			
				 $grevienceId =$_GET['grevience_id'];
				 $creteria=new CDbCriteria();
                 $creteria->condition="grievance_id=:grievance_id";
                 $creteria->params=array(":grievance_id"=>$grevienceId);
                 $creteria->order="reply_id ASC";
                 $reply=GrievanceReply::model()->findAll($creteria);
                 if(empty($reply))
                    echo ' <div class="room-box">
                             <p>No Reply</p>
                          </div>';
                 else{
                    foreach ($reply as $key => $repl) {
                       echo ' <div class="room-box">
                    <h5 class="text-primary"><a href="#">';
                    if($repl->is_bo_reply=='Y'){
                       $role_name=RolesExt::getUserRoleViaId($repl->replied_by);
                       echo $role_name['role_name'] . "'s reply";

                    }
                    else
                       echo "Your Message";
                    $dateTime=explode(" ", $repl->created_date_time);
                    echo '</a></h5>
                    <p>'.$repl->reply_text.'</p>
                    <p><span class="text-muted">User :</span> ';
                     if($repl->is_bo_reply=='Y')
                      echo UserExt::getUNameviaIdMap($repl->replied_by);
                    else
                       echo @$user_name;
                    echo ' | <span class="text-muted">Creation Date :</span>'.@$dateTime[0].' | <span class="text-muted">Creation Time :</span> '. @$dateTime[1].'</p>
                 </div>';
                    }
                 } }*/?>
                              
                          </div>
                      </div>
                    </div>
                </div>
            </div>-->
        </div>
    </div>

	  
	  