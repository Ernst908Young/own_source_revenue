<?php //print_r($_SESSION['RESPONSE']['iuid']) ?>

<div class="dashboard-home">
    <div class="applied-status" >
        <ul class="breadcrumb">
          <li><a href="/backoffice/admin">Home</a></li>
          <li><a href="/backoffice/investor/services/boticket/otd/ct">Ticket & Query</a></li>
          <li>Your Ticket Details</li>
          </ul>
      <div class="status-title d-flex flex-wrap align-items-center justify-content-between">
           <h4>Welcome to Digital Corporate Registry System</h4>
            <!-- <div class="serach-bar">
                <form>
                    <div class="search-field position-relative">
                        <input type="text" name="" placeholder="Search">
                    <button class="search-btn">
                        <i class="fa fa-search" aria-hidden="true"></i>
                    </button>
                    </div>
                </form>
            </div> -->
        </div>
</div>
</div>


<div class="reservation-form">   
<div class="form-part bussiness-det">   
        <h4 class="form-heading">Your Ticket Details</h4>
        <div class="form-row row">         
	<table class="table table-striped table-bordered table-hover">					
	<tr>
		<td class="a_cent" style="font-size: 16px;"><strong style="color: #333; font-size: 16px;">Ticket ID: </strong> <?php echo $ticket['supporttypecode']; ?></td>
		<td class="a_cent" style="font-size: 16px;"><strong style="color: #333; font-size: 16px;">SRN: </strong> <?php echo $ticket['srn_app_id']; ?></td>
		<td class="a_cent" style="font-size: 16px;"><strong style="color: #333; font-size: 16px;">Service Category: </strong> <?php echo $ticket['category_name']; ?></td>
	</tr>
	<tr>
		<td class="a_cent" style="font-size: 16px;"><strong style="color: #333; font-size: 16px;">Service Name: </strong> <?php echo $ticket['service_name']; ?></td>
		
		<td class="a_cent" style="font-size: 16px;"><strong  style='color: #333; font-size: 16px;'>Status: </strong>
			<?php  $status_arr = ['O'=>'Open','RV'=>'Reverted','RS'=>'Resolved','RO'=>'Reopened','C'=>'Closed','ESC'=>'Escalated'];
               echo $status_arr[$ticket['status']]; ?> 
		</td>
		<td class="a_cent" style="font-size: 16px;"><strong  style='color: #333; font-size: 16px;'>Created On: </strong> <?php echo date("d M Y h:i a",strtotime($ticket['created_on'])) ?>   </td>
	</tr>	
			<tr>
				<td colspan="3"><strong  style='color: #333; font-size: 16px;'>Documents: </strong>
					<?php 
					$files_arr = [];
					foreach($messages as $mk=>$mv){
					$filesdoc = Yii::app()->db->createCommand("SELECT * FROM supportmsgfiles WHERE supportmessagescode=".$mv['supportmessagescode'])->queryAll(); 
					foreach ($filesdoc as $key => $value) {
						$files_arr[] = $value;
					}
				}

				foreach ($files_arr as $f => $d) { 
					
					?>

					<a target="_blank" href="/backoffice/doc/mydoc?view=<?php echo DefaultUtility::getDockey($d['msgfilepath']); ?>&from=ticket"style="color:blue;">
                       Document <?= ($f+1)?>,
                    </a>

					<!-- echo  '<a target="_blank" href="'.$d['msgfilepath'].'" style="color:blue;">Documnet '.($f+1).', </a>'; -->
				<?php }
					?>
				</td>
			</tr>
</table>

<strong  style='color: #333;'>Subject: </strong> 
<div class="row">
						<div class="col-md-12">
<?php echo  $ticket['subject']; ?>
</div>
</div>


<br><br>


				<form id="sticket_form" method="post" action="<?php echo Yii::app()->createAbsoluteUrl("/ticketing/default/indi_status"); ?>">
					<input type="hidden" name="supportmaincode" value="<?php echo  $ticket['supportmaincode'] ?>">
				<div class="row">
					<div class="form-group col-md-4">
						<label>Update Ticket Status</label>
							<select name="status" placeholder="Select status" class="form-control select2-me" id="status">	
								<option>Select Status</option>						
								<?php 
									$access_status = ['RO'=>'Reopened','C'=>'Closed'];

									foreach ($access_status as $key => $val) { ?>
										<option value="<?php echo $key; ?>">
											<?php echo $val; ?>
										</option>
								<?php } ?>
						</select>  
						<span id="status-error" style="color: red;"></span>	   		
	   				</div>
	   				<div class="form-group col-md-4" style="margin-top: 30px;">
			   	      <span onclick="ajaxsubmit()" id="stfs" class="btn btn-primary" style="font-size: 18px; width: 120px;">Update</span>
			   	    </div>
				</div>
			</form>



<hr style="color: #36c6d3;" />	
	<strong style="color: #000;">Replies Received</strong>
				<?php foreach($messages as $mk=>$mv){ ?><br><br>
				
					<div class="row">
						<div class="col-md-8">
				<strong>By: </strong> 
					<?php echo $mv['usertype']=='AU' ? "Applicant User" : "Support Team User" ?> 
						</div>
						<div class="col-md-4">
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<strong>On: </strong> <?php echo date("d M Y h:i a",strtotime($mv['msgdatetime'])) ; ?><br>
						
					</div>
						
					</div>
			
				<div class="row">
						<div class="col-md-12">
				<?php echo $mv['message']; ?><br><hr style="color: #36c6d3;" />	
			</div></div>
				<?php } ?>
		
			<!-- </table> -->

			<?php if($ticket['status']=='O' || $ticket['status']=='ESC' || $ticket['status']=='RV' || $ticket['status']=='RO'){ ?> 
					
			<form id="ticket_msg_form" method="post" action="<?php echo Yii::app()->createAbsoluteUrl("/ticketing/default/ticketdetail/sm_id/$sm_id"); ?>" enctype="multipart/form-data">
				<div class="row">
					<div class="form-group col-md-12">
						<strong style="color: #000;">Reply Message<span style="color: red;">*</span></strong>
						<textarea name="message" id="message" placeholder="Enter your Message here" rows='12' maxlength="1000" class="form-control" required style="margin-top: 11px;" ></textarea>
						<!-- <small><span id="char_world">1000</span>/1000 characters remaining</small> -->
						<!--  <small><span id="messageword">1000</span> Characters </small> -->
					</div>
					<br>
					<div class="form-group col-md-12" style="text-align: center;">
						 <button type="submit" class="btn btn-primary" style="font-size: 18px; width: 120px; margin-top: 10px;">Send</button>
					</div>
				</div>
			</form>
<?php } ?>
		</div>
		</div>

</div>
<script>
$( document ).ready(function() {
		var maxLength = 1000;
		$('textarea').keyup(function() {
			var length = $(this).val().length;
			var length = maxLength-length;
			$('#char_world').text(length);
		});
	});
</script>
<script type="text/javascript">
	$(document).ready(function(){
		
		/*$("#message").keypress(function(){
			var messageword = $("#messageword").text();
			if(messageword<=0){
				return false;
			}else{
				$("#messageword").text(messageword-1);
			}
			

		});*/
	});



</script>

<script type="text/javascript">
	function ajaxsubmit(){
		//alert('hi');
		 //e.preventDefault(); // avoid to execute the actual submit of the form.
	    var form = $("#sticket_form");
	    var url = form.attr('action');
		$.ajax({
	            type: "POST",
	            dataType:'json',
	            data: form.serialize(), // serializes the form's elements.
	            url: url,
	            beforeSend:function(){		           
					$("#tktpri-error").text("Please Wait...");        	        	
	            },
	            success: function(result) {	   
	            tid = result.tid;      		            		
        			 window.location.href = "/backoffice/ticketing/default/ticketdetail/sm_id/"+tid+"/tq";
        		   }
		        });
	}
</script>