<div class='portlet box green'>
<div class='portlet-title'>
    <div class='caption' style="padding-top: 14px;">
        <i style=" font-size:14px;" class='fa fa-file'></i>View Asked Questions</div>
    <div class='tools'> </div>
	
</div>
 <div class="portlet-body">
 <table class="table table-striped table-bordered table-hover" id="sample_2" >
           
        <thead>
        <tr>
            <th style="padding:10px 18px; vertical-align:middle;" width="5%">S.No.</th >
            <th  style="padding:10px 18px; vertical-align:middle;" width="20%">Investor Details</th>
            <th  style="padding:10px 18px; vertical-align:middle;" width="5%">Query Reference Number</th>          
            <th  style="padding:10px 18px; vertical-align:middle;" width="28%">Query Topic / Sub Topic</th>
			<th  style="padding:10px 18px; vertical-align:middle;" width="23%">Summary</th>
			<th style="padding:10px 18px; vertical-align:middle;"  width="10%">Status</th>
			<th style="padding:10px 18px; vertical-align:middle;"  width="10%">View Details</th>
        </tr>
        </thead>

	  
	  <?php

	  //print_r($_SESSION['RESPONSE']);die;
	    if(!empty(@$_SESSION['RESPONSE']['user_id'])){
			$user_id=@$_SESSION['RESPONSE']['user_id'];
			$name =  $_SESSION['RESPONSE']['first_name'].' '. $_SESSION['RESPONSE']['last_name'];
			$email =  $_SESSION['RESPONSE']['email'];
			$phone = $_SESSION['RESPONSE']['mobile_number'];
		}
		else if($_SESSION && ($_GET['uid']) && ($_GET['uid'] != '') && ($_GET['iuid']) && ($_GET['iuid'] != ''))
		{			
			$user_id= base64_decode($_GET['uid']);			
			$result=Yii::app()->db->createCommand("select * from sso_users LEFT JOIN sso_profiles on sso_users.user_id=sso_profiles.user_id where sso_users.user_id=$user_id")->queryRow();
			$name =  $result['first_name'].' '. $result['last_name'];
			$email =  $result['email'];
			$phone = $result['mobile_number'];
			//$user_id= base64_encode($result['user_id']);								
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
             $fromToDateCondition .= " AND DATE(qot.created)>='".$startdate."'";
            }
            // To Date
            if(isset($enddate)){
             $fromToDateCondition .= " AND DATE(qot.created)<='".$enddate."'";
            }
	  //$user_id = $_SESSION['RESPONSE']['user_id'];
	
	  
	  
	  $sql2 = "select * from qry_ost_user_email oue 
					left join qry_ost_ticket qot on oue.user_id = qot.user_id
					left join qry_ost_help_topic qoht on qot.topic_id = qoht.topic_id  
					left join qry_ost_ticket_status qots on qot.status_id = qots.id 
					left join qry_ost_thread qoth on qot.ticket_id = qoth.object_id	
					left join qry_ost_ticket__cdata otc on qot.ticket_id = otc.ticket_id
						
					where oue.address = '".$email."' $fromToDateCondition";
	  $connection=Yii::app()->db;
	  $command=$connection->createCommand($sql2);	  
	  $qry = $command->queryAll();

	  
	  $count = 1;
	  foreach($qry as $key=>$qry){
		  if($qry['topic_pid'] >0){
				$sql3 = "select * from qry_ost_help_topic where topic_id ='".$qry['topic_pid']."'";
				$connection=Yii::app()->db;
				$command=$connection->createCommand($sql3);	  
				$qry3 = $command->queryAll();

		  }
	 
	  ?>

					<tr>
						<td style="padding:10px 18px; vertical-align:middle;"><?=$count ?>
						<td style="padding:10px 18px; vertical-align:middle;"><i class="fa fa-user"></i>  <?= $name ."<br><i class='fa fa-envelope-o'></i>  ".$email."<br><i class='fa fa-mobile'></i>  ".$phone ?></td>
						<td style="padding:10px 18px; vertical-align:middle;"><?= $qry['number'] ?></td>
						<td style="padding:10px 18px; vertical-align:middle;"><?php if (isset($qry3[0]['topic']) && $qry3[0]['topic'] != '' ) echo $qry3[0]['topic']; ?> <span> : </span><?= $qry['topic'] ?></td>
						<td style="padding:10px 18px; vertical-align:middle;"><?= $qry['subject'] ?></td>
						<td style="padding:10px 18px; vertical-align:middle;"><?= $qry['name'] ?></td>
						<?php $baseurl=$_SERVER['HTTP_HOST'];?> 
						<td style="padding:10px 18px; vertical-align:middle;"><a href =<?php echo 'http://'.$baseurl.'/query/autologin.php?luser='.$email.'&amp;financial_year='.$financial_year.'&amp;flag=query&amp;type=investor&amp;id='.$qry['ticket_id']; ?> >View Detail</td>
						
					</tr>
					<?php
					$count= $count+1;
					
					
	  }	
	
	?>
	
	    </table>
          </div>
      </div>
	  