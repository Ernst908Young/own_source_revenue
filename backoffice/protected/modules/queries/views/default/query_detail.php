
<div class="dashboard-home">
    <div class="applied-status" >
        <ul class="breadcrumb">
          <li><a href="/backoffice/investor/home/investorWalkthrough">Home</a></li>
          <li><a href="/backoffice/investor/services/ticketquery/tq">Ticket & Query</a></li>
          <li>Your Query Details</li>
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

<?php if(Yii::app()->user->hasFlash('success')):?>

    <h2 style="text-align: center; color: green;">

        <?php echo Yii::app()->user->getFlash('success'); ?>

    </h2>

<?php endif; ?>

<div class="reservation-form">   
<div class="form-part bussiness-det"> 
	<h4 class="form-heading">Your Query Details</h4>
        <div class="form-row row">  
        <table class="table table-striped table-bordered table-hover" >					
				<tr>
					<td class="a_cent" style="font-size: 16px;"><strong style="color: #333;">Query ID: </strong> <?php echo $qmain['querycode']; ?></td>

					<td class="a_cent" style="font-size: 16px;"><strong style="color: #333; font-size: 16px;">Mobile: </strong> <?php echo $qmain['mobile_no']; ?></td>	
					<td class="a_cent" style="font-size: 16px;"><strong style="color: #333; font-size: 16px;">Email: </strong> <?php echo $qmain['email']; ?></td>	

					

						
					
					
				</tr>
				<tr>
					<td class="a_cent" style="font-size: 16px;"><strong style="color: #333; font-size: 16px;">Query Type: </strong> <?php echo $qmain['query_type']; ?></td>	

					<td class="a_cent" style="font-size: 16px;"><strong style="color: #333; font-size: 16px;">Service Category: </strong>
  <?php 
                                                   
 echo $qmain['category_name'] 
                                                ?>	
					 </td>	
					<td class="a_cent" style="font-size: 16px;"><strong style="color: #333; font-size: 16px;">Service Name: </strong> <?php echo $qmain['service_name']; ?></td>	
					
					
					
					
				</tr>	
					<tr>
						<td class="a_cent" style="font-size: 16px;"><strong  style='color: #333; font-size: 16px;'>Status: </strong><?php echo  $qmain['status']==1?'<span class="label label-success">Open</span>':'<span class="label label-danger">Closed</span>' ?> 
					</td>
						<td class="a_cent" style="font-size: 16px;"><strong  style='color: #333; font-size: 16px;'>Created On: </strong> <?php echo date("d M Y h:i a",strtotime($qmain['created_on'])) ?>   </td>
						<td class="a_cent" style="font-size: 16px;"><strong  style='color: #333; font-size: 16px;'>Priority: </strong> <?php echo $qmain['querypriority'] ?>   </td>
					</tr>	
			</table>

<strong  style='color: #333;'>Subject: </strong> 
<div class="row">
<div class="col-md-12">
<?php echo  $qmain['subject']; ?>
</div>
</div>



<!-- <table class="table table-striped table-bordered table-hover"> -->
	<hr style="color: #36c6d3;" />	
	<strong style="color: #000;">Replies Received</strong>
				<?php foreach($messages as $mk=>$mv){ ?><br><br>
				
					<div class="row">
						<div class="col-md-8">
							<strong>By: </strong> 
								<?php echo $mv['user_type']=='URU' ? "Un-Register User" : ($mv['user_type']=='AU' ? "Applicant User" : "Support Team User")?>
						</div>
						<div class="col-md-4">
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<strong>On: </strong><?php echo date("d M Y h:i a",strtotime($mv['msgdatetime'])) ; ?>
						</div>
					</div>
				
				<div class="row">
				<div class="col-md-12">
						<?php echo $mv['message']; ?>
				</div>
				</div>
				<?php } ?>
			<!-- </table> -->

			<?php if($qmain['status']==1){ ?>
			<hr style="color: #36c6d3;" />			
			<form id="ticket_msg_form" method="post" action="<?php echo Yii::app()->createAbsoluteUrl("/queries/default/querydetail/q_id/$q_id"); ?>" enctype="multipart/form-data">
				<div class="row">
					<div class="form-group col-md-12">						
						<strong style="color: #000;">Reply Message<span style="color: red;">*</span></strong>
						<textarea name="message" id="message" placeholder="Enter your Message here" rows='12' class="form-control" required style="margin-top: 11px;" ></textarea>
						<!-- <small><span id="char_world">1000</span>/1000 characters remaining</small> -->
						<!--  <small><span id="messageword">1000</span> Characters </small> -->
					</div>
					<div class="form-group col-md-12"  style="text-align: center;">				
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