<style type="text/css">
   .comment_section{
   display: inline;
   background: #ddd;
   color:red;
   resize: none;
   padding: 5px 15px 5px 15px;
   }
   .apprvr_comments{
   display: inline;
   background: #F7F7F7;
   color:#222;
   resize: none;
   padding: 5px 15px 5px 15px;  
   }
   div.heading{
   background-color: #006699;
   text-align: center;
   color:#fff;
   padding-top: 7px;
   padding-bottom: 7px;
   margin-bottom: 20px;
   font-weight: bold;
   }
   .control-label{
   font-size: 0.9em;
   font-weight: 800;
   height: 20px;
   text-align: left;
   }
   ::-webkit-input-placeholder { font-size:.9em;font-weight: bold }
   ::-moz-placeholder { font-size:.9em; font-weight: bold}
   :-ms-input-placeholder { font-size:.9em; font-weight: bold}
   input:-moz-placeholder { font-size:.9em; font-weight: bold}
</style>
<div class="panel-body">
   <div class="row">&nbsp;</div>
   <table cellpadding="1" border="1" cellspacing="1">
         <tr>
             <th><b>Approver Name</b></th>
             <th><b>Role</b></th>
             <th><b>Comments</b></th>
             <th><b>Date &amp; Time</b></th>
             <th><b>Dept Name</b></th>
             <th><b>Distt/State</b></th>
             <th><b>Application Status</b></th>
         </tr>
         <?php 
           if(!empty($applications))
             foreach ($applications as $apps) {
               $api_hash=hash_hmac('sha1', md5($apps->user_id), SSO_API_PUBLIC_KEY);
               $post_data=array('uid'=>$apps->user_id,'api_hash'=>$api_hash);
               $response=json_decode(DefaultUtility::postViaCurl(TOKE_API_BASEURL.'/apiv1/getUserNameFromUserId',$post_data));
               $uname='';
               if($response->STATUS===200)
                 $uname=$response->RESPONSE;
               $dist_name=DistrictExt::getDistricNameById($apps->landrigion_id);
               echo "<tr>";?>
                       <td style="background-color:#006699;color:#fff;"><b>Submission Id: </b><?=$apps->submission_id?></td>
                       <td style="background-color:#006699;color:#fff;"><b>Invest Name: </b><?=$uname?></td>
                       <td style="background-color:#006699;color:#fff;"> </td>
                       <td style="background-color:#006699;color:#fff;"><b>Sub Date/Time: </b><?=$apps->application_created_date?></td>
                       <td style="background-color:#006699;color:#fff;"></td>
                       <td style="background-color:#006699;color:#fff;"><b>Distt/State: </b><?=$dist_name?></td>
                       <td style="background-color:#006699;color:#fff;"><b>Status: </b>
                       <?php 
                       if($apps->application_status=='F')
                         echo "Forward";
                       if($apps->application_status=='P')
                         echo "Pending";
                       if($apps->application_status=='A')
                         echo "Approve";
                       if($apps->application_status=='H')
                         echo "Hold";
                       if($apps->application_status=='I')
                         echo "Incomplete";
                       if($apps->application_status=='R')
                         echo "Reject";
                       echo " </td>
                   </tr>";
               /*get the application comments*/
               $appComments=ApplicationFlowLogsExt::getSubAppsComments($apps->submission_id);
               if(!$appComments)
                 echo "<tr>
                         <td></td>
                         <td></td>
                         <td>No Comments yet for this Application.</td>
                         <td></td>
                         <td></td>
                         <td></td>
                         <td></td>
                 </tr>";
               else{
                 foreach ($appComments as $key => $comments) {
                   $uname=UserExt::getUNameviaIdMap($comments->approval_user_id);
                   $role_name=RolesExt::getRolesViaId($comments->approver_role_id);
                   $deptName=UserExt::getUserDept($comments->approval_user_id);
                   echo "<tr>
                         <td>".$uname."</td>
                         <td>".$role_name['role_name']."</td>
                         <td>".$comments->approver_comments."</td>
                         <td>".$comments->created_date_time."</td>
                         <td>".$deptName['department_name']."</td>
                         <td>".$dist_name."</td>
                         <td>";
                     if($comments->application_status=='P')
                        echo "Pending";
                      if($comments->application_status=='V')
                        echo "Verified";
                      if($comments->application_status=='IBD')
                        echo "Investor Reverted Back to Dept";
                      if($comments->application_status=='R')
                        echo "Reject";
                      if($comments->application_status=='RB')
                        echo "Reverted Back";
                      if($comments->application_status=='RBN')
                        echo "Reverted Back to Nodal";
                      if($comments->application_status=='RBI')
                        echo "Reverted Back to Investor";
                      if($comments->application_status=='F')
                        echo "Forwarded to Other Dept";
                      if($comments->application_status=='A')
                        echo "Approved";
                     echo "</td>
                         </tr>";
                 }
               }
             }
         ?>
   </table>
   </div>