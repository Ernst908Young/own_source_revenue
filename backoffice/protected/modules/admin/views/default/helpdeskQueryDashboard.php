<div class="row">
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <a class="dashboard-stat dashboard-stat-v2 green" href="<?php echo FRONT_BASEURL; ?>query/scp/autologin.php?luser=<?php echo $_SESSION['email']; ?>&flag=open" target="_blank">
                 <div class="visual">
                    <i class="fa fa-comments"></i>
                </div>
                <div class="details">
                    <div class="number">
                        <span data-counter="counterup" data-value="<?php echo $total_open_queries?$total_open_queries:0;  ?>"></span> 
                    </div>
                    <div class="desc"> Open Query <small>( Team )</small></div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <a class="dashboard-stat dashboard-stat-v2 green" href="<?php echo FRONT_BASEURL; ?>query/scp/autologin.php?luser=<?php echo $_SESSION['email']; ?>&flag=closed" target="_blank">
               <div class="visual">
                    <i class="fa fa-bar-chart-o"></i>
                </div>
                <div class="details">
                    <div class="number">
                       
                        <span data-counter="counterup" data-value="<?php echo $total_closed_queries?$total_closed_queries:0;  ?>"></span></div>
                    <div class="desc"> Closed Query <small>( Team )</small></div>
                </div>
            </a>
        </div>
		 <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <a class="dashboard-stat dashboard-stat-v2 green" href="<?php echo FRONT_BASEURL; ?>query/scp/autologin.php?luser=<?php echo $_SESSION['email']; ?>&flag=assigned" target="_blank">
                <div class="visual">
                    <i class="fa fa-shopping-cart"></i>
                </div>
                <div class="details">
                    <div class="number">
                        <span data-counter="counterup" data-value="<?php echo $total_transfered_queries?$total_transfered_queries:0;  ?>"></span>
                    </div>
                    <div class="desc"> Claimed Query <small>( Self )</small></div>
                </div>
            </a>
        </div> 
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <a class="dashboard-stat dashboard-stat-v2 green" href="<?php echo FRONT_BASEURL; ?>query/scp/autologin.php?luser=<?php echo $_SESSION['email']; ?>&flag=answered" target="_blank">
                <div class="visual">
                    <i class="fa fa-shopping-cart"></i>
                </div>
                <div class="details">
                    <div class="number">
					    <?php   //$total_tickets=$total_ticket+$total_transfered_ticket;  ?>
                        <span data-counter="counterup" data-value="<?php echo $total_answered_queries?$total_answered_queries:0;  ?>"></span>
                    </div>
                    <div class="desc"> Responded Query <small>( Self )</small></div>
                </div>
            </a>
        </div>
        
    </div>

<div class="site-min-height">

<div class="row">
            <div class="col-md-12">
               <!-- BEGIN EXAMPLE TABLE PORTLET-->
               <div class="portlet box green">
                  <div class="portlet-title">
                     <div class="caption">
                        <i style="font-size:24px" class="icon-list"></i>
                        <span class="caption-subject bold uppercase">Query List</span>
                     </div>
                     <div class="tools">
						<div class="dt-buttons">
							 <a class="buttons-print btn btn-primary hide_me" href="<?php echo FRONT_BASEURL."query/scp/autologin.php?luser=".$_SESSION['email']."&flag=view" ?>" target="_blank" ><span>Process Query</span></a>
					 
						</div>
					</div>
                  </div>
                  <div class="portlet-body">
                     <?php 
                     $pendingCount=0; 
                      if (!empty($queries)) {
                                echo "<table class='table table-striped table-bordered table-hover order-column' id='sample_2'>
                                   <thead>
                                   <tr>
                                   <th>Number</th>
                                   <th>Last Updated</th>
                                   <th>Subject</th>
                                   <th>Status</th>
                                   <th>From</th>
                                   <th>Priority</th>
                                   <th>Assigned To</th>
                                   </tr>
                                   </thead>";
                          
                                  $count = 1;
								  
								 //echo '<pre/>';  print_r($queries);   exit();
								  
                                   foreach ($queries as $ticket) {
                                      $pendingCount++; 
                                       echo "<td><a href='".FRONT_BASEURL."query/scp/autologin.php?luser=".$_SESSION['email']."&flag=view&id=".$ticket['ticket_id']."' target='_blank' class='nav-link nav-toggle'>" . $ticket['number'] . "</a></td>
                                                <td align='center'>" . date("d M Y H:i:s a", strtotime($ticket['lastupdate'])) . "</td>
                                                <td>" . $ticket['subject'] . "</td>
                                                <td align='center'>" . $ticket['tstatus'] . "</td>
                                                <td align='center'>". $ticket['name']. "</td>
                                                <td align='center'>". ucwords($ticket['priority_title']) ."</td>
                                                <td>".$ticket['firstname']."</td> 
                                               </tr>";
                                  } 
                                echo "</table>";
                      } else
                        echo "No Query Found.";
                      ?>
                       
                  </div>
               </div>
            </div>
			
			 <?php
				$this->widget('CLinkPager',array(
					'header'=>'',
					'firstPageLabel' => ' << ',
					'lastPageLabel' => ' >> ',
					'prevPageLabel' => ' < ',
					'nextPageLabel' => ' > ',
					'pages' => $pages,
					'pageSize'=>10,
					'maxButtonCount'=>10,
					'cssFile'=>false,
					'htmlOptions' =>array("class"=>"pagination right_pagination"),
					'selectedPageCssClass'=>"active"
				  )
				); 
				?>
			
			
        </div>
	
	
    
       

<?php
   $base=Yii::app()->theme->baseUrl;
?>


<style>

a:hover {
    color: #333;
}
.right_pagination{
	float:right;
}


</style>

<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?=$base?>/assets/global/scripts/datatable.js" type="text/javascript"></script>
<script src="<?=$base?>/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
<script src="<?=$base?>/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
<script src="<?=$base?>/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<link href="<?=$base?>/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
<link href="<?=$base?>/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
