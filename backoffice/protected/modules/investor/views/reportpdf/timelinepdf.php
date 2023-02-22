

<table style="padding-top: 10px; border-collapse: collapse; padding: 5px;">                 
   <tr style="font-size: 10;">
       <th width="7%" style="border: 1px solid black; text-align: center;">SR. No.
       </th>
       <th width="45%" style="border: 1px solid black; text-align: center;">Service Description 
       </th>
      <th width="12%" style="border: 1px solid black; text-align: center;">Average Application Submission Time
       </th>                              
       <th width="12%" style="border: 1px solid black; text-align: center;">Average Application Submission to Payment Approval Time
       </th>                               
       <th width="12%" style="border: 1px solid black; text-align: center;">Average Payment Approval to Application Closing Time
       </th>
       <th width="12%" style="border: 1px solid black; text-align: center;">Average Application Processing Time</th>     
   </tr>
                    
                           <?php
                        if($records){
                            foreach($records as $key => $value) 
                        {
                        
$ast = Yii::app()->db->createCommand("SELECT app_id, COUNT(app_id) as srn_count FROM bo_sp_application_history  where service_id=".$value['s_id']." GROUP BY app_id")->queryAll();

$total_draft_date = $total_drafttopd_date = $total_app_approve_date = $srn_count = 0 ;
foreach ($ast as $k => $v) {
  $drafts = Yii::app()->db->createCommand("SELECT MIN(history_id), MAX(history_id), MIN(added_date_time) as min_date, MAX(added_date_time) as max_date,  app_id FROM bo_sp_application_history where app_id=".$v['app_id']." AND application_status IN ('I','DP','PD') AND service_id=".$value['s_id']." GROUP BY app_id")->queryRow();

          $draftd1 = date_create(date('Y-m-d',strtotime($drafts['max_date'])));
          $draftd2 = date_create(date('Y-m-d',strtotime($drafts['min_date'])));
          $diff  = date_diff($draftd1,$draftd2);
          $total_draft_date+= $diff->format("%a");

  $ay_approve = Yii::app()->db->createCommand("SELECT MIN(history_id), MAX(history_id), MIN(added_date_time) as min_date, MAX(added_date_time) as max_date,  app_id FROM bo_sp_application_history where app_id=".$v['app_id']." AND application_status IN ('PD','P') AND service_id=".$value['s_id']." GROUP BY app_id")->queryRow();

          $draftd_topd1 = date_create(date('Y-m-d',strtotime($ay_approve['max_date'])));
          $draftd_topd2 = date_create(date('Y-m-d',strtotime($ay_approve['min_date'])));
          $diff  = date_diff($draftd_topd1,$draftd_topd2);
          $total_drafttopd_date+= $diff->format("%a");


   $app_approve = Yii::app()->db->createCommand("SELECT MIN(history_id), MAX(history_id), MIN(added_date_time) as min_date, MAX(added_date_time) as max_date,  app_id FROM bo_sp_application_history where app_id=".$v['app_id']." AND application_status IN ('P','A') AND service_id=".$value['s_id']." GROUP BY app_id")->queryRow();

          $app_approve1 = date_create(date('Y-m-d',strtotime($app_approve['max_date'])));
          $app_approve2 = date_create(date('Y-m-d',strtotime($app_approve['min_date'])));
          $diff  = date_diff($app_approve1,$app_approve2);
          $total_app_approve_date+= $diff->format("%a");

          $srn_count = $k+1;        
}
                        ?>    
<tr>
   <td style="border: 1px solid black;"><?= $key+1 ?></td>
   <td style="border: 1px solid black;"><?php echo $value['core_service_name'] ?>
   </td>
  <td style="border: 1px solid black;"><?php $dasrse = $total_draft_date/$srn_count;
         echo round($dasrse,0).' days';
      ?>
   </td>

   <td style="border: 1px solid black;"><?php 
         echo round($total_drafttopd_date/$srn_count,0).' days';
      ?>
   </td>

   <td style="border: 1px solid black;"><?php 
         echo round($total_app_approve_date/$srn_count,0).' days';
      ?>
   </td>
      <td style="border: 1px solid black;"><?php 
        $apptotaltime =round($dasrse,0) +round($total_drafttopd_date/$srn_count,0) + round($total_app_approve_date/$srn_count,0);
        echo $apptotaltime.' days';
      ?>
   </td>

</tr>                                    
                            <?php   }
                                }
                            ?>
                    
                
</table>