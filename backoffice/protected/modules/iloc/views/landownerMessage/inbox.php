<?php  include('link_header.php');   ?>

<div class='portlet box'>
<div class="col-md-12" style="padding: 0px;">
                                
								
	<nav class="navbar navbar-inverse navbar_inverse">
		  <ul class="nav navbar-nav">
			<li class="active"><a href="/backoffice/iloc/landownerMessage/inbox">
															Inbox
														   </a></li>
			<li><a href="/backoffice/iloc/landownerMessage/sent">Sent</a></li>
		  </ul>
    </nav>
	
</div>




<hr>

<div class="portlet-body">
    <div class="portlet-title" style="">
                                        <div class="caption">
                                          <i class="fa fa-comment-o" aria-hidden="true"></i>
                                            <span class="caption-subject font-purple-soft bold uppercase">Recieved Messages
                                       
                                    </div>
    <hr>
<div class="tab-pane active" id="tab1" style="background-color:#fff;">
	
	
	    <div class="table-scrollable">
		
		
		<table id="sample_31" class="table table-striped borderless dataTable no-footer" width="100%" role="grid" aria-describedby="sample_31_info" style="width: 100%;">
                            <thead>
                              <tr role="row">
								  <th style="30%" class="sorting" tabindex="0" aria-controls="sample_31" rowspan="1" colspan="1" aria-sort="descending" aria-label="S.N.: activate to sort column ascending">User </th>
								  <th style="50%" class="sorting" tabindex="0" aria-controls="sample_31" rowspan="1" colspan="1" aria-label="Code: activate to sort column ascending">Message</th>
								  <th style="20%" class="sorting" tabindex="0" aria-controls="sample_31" rowspan="1" colspan="1" aria-label="Uploaded Date: activate to sort column ascending">Date</th>
							   </tr>
							</thead>
                            <tbody>
														
							

                           <?php if($recieved_messages){
							     foreach($recieved_messages as $message){  //echo '<pre/>'; print_r($message); exit();
								 ?>
												
								<tr class="even" role="row">
									<td><a  class="msglink" style="cursor: pointer" href="<?php echo Yii::app()->request->baseUrl; ?>/iloc/landownerMessage/conversation?message_id=<?php echo base64_encode($message['id']);  ?>">
								Me, <?php echo $message['to_user_name'];    ?> ( <?php echo $message['total'];    ?>  ) </a> 
								  <?php if($message['new_total']>0){ ?>
								  <span class="notifycircle new fnormal abs nowrap br3 cfff lheight16"><?php echo $message['new_total'];    ?></span>
								  <?php } ?>
								</td>
									<td><a class="msglink" style="cursor: pointer"  href="<?php echo Yii::app()->request->baseUrl; ?>/iloc/landownerMessage/conversation?message_id=<?php echo base64_encode($message['id']);  ?>">
								<b><?php  echo $message['land_title']?$message['land_title']:'';   ?></b> <br/> <br/> <?php  echo $message['message']?$message['message']:'';   ?></a></td>
									<td>
									<a class="msglink" style="cursor: pointer" href="<?php echo Yii::app()->request->baseUrl; ?>/iloc/landownerMessage/conversation?message_id=<?php echo base64_encode($message['id']);  ?>">
								    <?php  echo $message['created_date']?date("d M Y, h:i:s a", strtotime($message['created_date'])):'';   ?></a></td>
								
								</tr>
							 
						   <?php }}else{ ?> 
						   
						       <tr class="even" role="row">
									<td>No Message Found. </td>
									<td></td>
									<td>
									</td>
								
								</tr>
						   
						   <?php } ?>
							
							 
						</tbody>
	    </table>
	
	</div>
	
	
	
	
	

    </div>
    </div>
