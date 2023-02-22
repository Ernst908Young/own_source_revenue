<?php //print_r($_SESSION['RESPONSE']['iuid']) ?>

<div class="dashboard-home">
    <div class="applied-status" >
        <ul class="breadcrumb">
          <li><a href="/backoffice/investor/home/investorWalkthrough">Home</a></li>
          <li><a href="/backoffice/investor/services/grievance/grv">Grievance</a></li>
          <li>Your Grievance Details</li>
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
        <h4 class="form-heading">Your Grievance Details</h4>
        <div class="form-row row">         
	<table class="table table-striped table-bordered table-hover">					
	<tr>
		<td class="a_cent" style="font-size: 16px;"><strong style="color: #333; font-size: 16px;">Grievance ID: </strong> <?php echo $grievance['id']; ?></td>
		<td class="a_cent" style="font-size: 16px;"><strong style="color: #333; font-size: 16px;">Category: </strong> <?php echo ($grievance['category']=="Ticket" || $grievance['category']=="Query") ? 'Existing '.$grievance['category'] : $grievance['category']; ?></td>
		<?php switch ($grievance['category']) {
			case 'Ticket':
				$code_label = 'Ticket ID';
			$q = Yii::app()->db->createCommand("SELECT * from supportmain  where supportmaincode=$grievance[existing_id]")->queryRow();
				$code_no = $q['supporttypecode'];
				break;
			case 'Query':
				$code_label = 'Query ID';
				$q = Yii::app()->db->createCommand("SELECT * from querymain  where id=$grievance[existing_id]")->queryRow();
				$code_no = $q['querycode'];
				break;
			
			default:
				$code_label = '';
				$code_no = '';
				break;
		} ?>
		<?php if($code_label){ ?>
		<td class="a_cent" style="font-size: 16px;"><strong style="color: #333; font-size: 16px;"><?= $code_label ?>: </strong> <?php echo $code_no; ?></td>
		<?php } ?>
		
	</tr>
	<tr>
		
		<td class="a_cent" style="font-size: 16px;"><strong  style='color: #333; font-size: 16px;'>Status: </strong>
			<?php  $status_arr = ['O'=>'Open','W'=>'Withdrawn','RV'=>'Reverted','RS'=>'Resolved','RO'=>'Reopened','C'=>'Closed','ESC'=>'Escalated'];
               echo $status_arr[$grievance['status']]; ?> 
		</td>
		<td class="a_cent" style="font-size: 16px;" colspan="2"><strong  style='color: #333; font-size: 16px;'>Created On: </strong> <?php echo date("d M Y h:i a",strtotime($grievance['created_on'])) ?>   </td>
	</tr>	
			<tr>
				<td colspan="3"><strong  style='color: #333; font-size: 16px;'>Documents: </strong>
					<?php 
					$files_arr = [];
					foreach($messages as $mk=>$mv){
					$filesdoc = Yii::app()->db->createCommand("SELECT * FROM grievancefiles WHERE gm_id=".$mv['id'])->queryAll(); 
					foreach ($filesdoc as $key => $value) {
						$files_arr[] = $value;
					}
				}
				$count  = count($files_arr);
				$i=1;
				foreach ($files_arr as $f => $d) { 
					$sep = ($i==$count) ? '': ',';
					
					?>

					<a target="_blank" href="/backoffice/doc/mydoc?view=<?php echo DefaultUtility::getDockey($d['msgfilepath']); ?>&from=grievance"style="color:blue;">
                       Document <?= ($f+1)?><?php echo $sep; ?>
                    </a>
					

					<!-- echo  '<a target="_blank" href="'.$d['msgfilepath'].'" style="color:blue;">Documnet '.($f+1).', </a>'; -->
				<?php
				$i++; 
			}
					?>
				</td>
			</tr>
			<tr>
				<td class="a_cent" style="font-size: 16px;" colspan="3"><strong  style='color: #333; font-size: 16px;'>Currently Assigned To BO User: </strong>
					<?php  
					$assign_to = Yii::app()->db->createCommand("
					SELECT s.*,p.full_name,p.middle_name,p.last_name FROM grievance s
					LEFT JOIN bo_user p ON s.currently_assign_to = p.uid
					WHERE s.id='".$grievance['id']."' ")->queryRow();

					echo $assign_to['full_name'].' '.$assign_to['middle_name'].' '.$assign_to['last_name']; ?> 
				</td>
			</tr>
</table>

<strong  style='color: #333;'>Subject: </strong> 
<div class="row">
						<div class="col-md-12">
<?php echo  $grievance['subject']; ?>
</div>
</div>


<br><br>


				<form id="sgrievance_form" method="post" action="<?php echo Yii::app()->createAbsoluteUrl("/grievance/default/indi_status"); ?>">
					<input type="hidden" name="id" value="<?php echo  $grievance['id'] ?>">
				<div class="row">
					<div class="form-group col-md-4">
						<label>Update Grievance Status</label>
							<select name="status" placeholder="Select status" class="form-control select2-me" id="status">	
								<option>Select Status</option>						
								<?php 
									($grievance['status']=='O' || $grievance['status']=='ESC')? $access_status = ['W'=>'Withdrawn']: $access_status = ['RO'=>'Reopened','W'=>'Withdrawn'];
									foreach ($access_status as $key => $val) {
									?>
										<option value="<?php echo $key; ?>" <?= ($key==$grievance['status'])?'selected':'' ?>>
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


<br><br>
<hr style="color: #36c6d3;" />	
	<strong style="color: #000;">Replies Received</strong>
				<?php foreach($messages as $mk=>$mv){ ?><br><br>
				
					<div class="row">
						<div class="col-md-8">
				<strong>By: </strong> 
					<?php echo $mv['user_type']=='AU' ? "Applicant User" : "Support Team User" ?> 
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

			<?php if($grievance['status']=='O' || $grievance['status']=='RV' || $grievance['status']=='RO'){ ?> 
					
			<form id="grievance_msg_form" method="post" action="<?php echo Yii::app()->createAbsoluteUrl("/grievance/default/grievancedetail/sm_id/$sm_id"); ?>" enctype="multipart/form-data">
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
		if(confirm('Do you want to change the grievance status?')){
		//alert('hi');
		//e.preventDefault(); // avoid to execute the actual submit of the form.
	    var form = $("#sgrievance_form");
	    var url = form.attr('action');
		$.ajax({
	            type: "POST",
	            dataType:'json',
	            data: form.serialize(), // serializes the form's elements.
	            url: url,
	            beforeSend:function(){		           
					$("#grvpri-error").text("Please Wait...");        	        	
	            },
	            success: function(result) {	   
	            gid = result.gid;      		            		
        			 window.location.href = "/backoffice/grievance/default/grievancedetail/sm_id/"+gid+"/grv";
        		   }
		        });
		}else{
			return false;
		}
	}
</script>