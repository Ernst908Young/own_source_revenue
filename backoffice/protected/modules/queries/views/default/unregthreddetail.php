
<style type="text/css">
.form-control{
  height: 36px;
}
.form-control, output{
font-size: 16px;
color: #000;
}
#content{
	padding: 3%;
}
.msg {
  text-align: justify;
  text-justify: inter-word;
}
.portlet-body{
	word-break: break-word;
}
</style>
<div class="row">
<div class="site-min-height">
        <div class="dashboard-welcome">
            <h2 class="full-width">
                <div class="dashboard-inner-hd-left">
                    <p class="dashbrd-inner-hd">
                        <!--<a href="/backoffice/frontuser/home/investorWalkthrough" title="Go to Dashboard : Level 1" class="fa fa-home homeredirect" ></a>-->
                       Welcome To Digital Corporate Registry System</p>
                </div>
               
               <!-- <div class="dashboard-inner-hd-right"><a href="/backoffice/queries/default/index" class="btn btn-primary" style="font-size: 18px; text-align: center; width: 120px;"> Dashboard</a></div> -->
                 
                <div class="clearfix"></div>
            </h2>
            <!--<div class="welcome-date hidden-xs"><i class="icon-calendar"></i>&nbsp;28-Jun-2021</div>-->
            <div class="clearfix"></div>
        </div>
    </div>

<?php if(Yii::app()->user->hasFlash('success')):?>

    <h2 style="text-align: center; color: green;">

        <?php echo Yii::app()->user->getFlash('success'); ?>

    </h2>

<?php endif; ?>

<div class='portlet box green'>
    <div class='portlet-title'>
        <div class='caption'>
            <!-- <i style=" font-size:20px;" class='fa fa-list'></i> -->
            <strong style=" color:#000; font-size: 16px;"> Your Query Details</strong>
        </div>
        <div class='tools'> </div>
    </div>
    <div class="portlet-body" style="font-size: 16px;">
        <table class="table table-striped table-bordered table-hover" >					
				<tr>
					<td class="a_cent" style="font-size: 16px;"><strong style="color: #333;">Query ID: </strong> <?php echo $qmain['querycode']; ?></td>

					<td class="a_cent" style="font-size: 16px;"><strong style="color: #333; font-size: 16px;">Mobile: </strong> <?php echo $qmain['mobile_no']; ?></td>	
					<td class="a_cent" style="font-size: 16px;"><strong style="color: #333; font-size: 16px;">Email: </strong> <?php echo $qmain['email']; ?></td>	

					

						
					
					
				</tr>
				<tr>
					<td class="a_cent" style="font-size: 16px;"><strong style="color: #333; font-size: 16px;">Query Type: </strong> <?php echo $qmain['query_type']; ?></td>	

					<td class="a_cent" style="font-size: 16px;"><strong style="color: #333; font-size: 16px;">Service Category: </strong>
   <?php echo $qmain['category_name'] ?> 
					</td>	
					<td class="a_cent" style="font-size: 16px;"><strong style="color: #333; font-size: 16px;">Service Name: </strong> <?php echo $qmain['service_name']; ?></td>	
					
					
					
					
				</tr>	
					<tr>
						<td class="a_cent" style="font-size: 16px;"><strong  style='color: #333; font-size: 16px;'>Status: </strong><?php echo  $qmain['status']==1?'<span class="label label-success">Open</span>':'<span class="label label-danger">Closed</span>' ?> 
					</td>
						<td class="a_cent" style="font-size: 16px;"><strong  style='color: #333; font-size: 16px;'>Created On: </strong> <?php echo date("d, M Y h:i a",strtotime($qmain['created_on'])) ?>   </td>
						<td class="a_cent" style="font-size: 16px;"><strong  style='color: #333; font-size: 16px;'>Priority: </strong> <?php echo $qmain['querypriority']; ?>   </td>
					</tr>	
			</table>

<strong  style='color: #333;'>Subject: </strong> <?php echo  $qmain['subject']; ?>



<!-- <table class="table table-striped table-bordered table-hover"> -->
	<hr style="color: #36c6d3;" />	
	<strong style="color: #000;">Replies Received</strong>
				<?php 
				if($qmain['name']=="")
					$qmain['name']="Un-Register User";
				foreach($messages as $mk=>$mv){ ?><br>
					
					<div class="row">
						<div class="col-md-8">
							<strong>By: </strong> 
								<?php echo $mv['user_type']=='URU' ? $qmain['name'] : ($mv['user_type']=='AU' ? "Applicant User" : "Support Team User")?>
						</div>
						<div class="col-md-4">
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<strong>On: </strong> <?php echo date("d, M Y h:i a",strtotime($mv['msgdatetime'])) ; ?>
						</div>
						
					</div>
					<div class="row msg" >
						<div class="col-md-12 msg" >
							<?php echo $mv['message']; ?>
						</div>
						
						
					</div>
						<br><hr style="color: #36c6d3;" />
				<?php } ?>
			<!-- </table> -->

			<?php if($qmain['status']==1){ ?>
				
			<form id="ticket_msg_form" method="post" action="<?php echo Yii::app()->createAbsoluteUrl("/queries/default/unregthreddetail/q_id/$q_id"); ?>" enctype="multipart/form-data">
				<div class="row">
					<input type="hidden" name="YII_CSRF_TOKEN" value="<?php echo Yii::app()->request->csrfToken; ?>"/>
					<div class="form-group col-md-12">						
						<label><strong style="color: #000;">Reply Message</strong>&nbsp;<span style="color:red">*</span></label>
						<textarea name="message" id="message" placeholder="Enter your Message here" rows='12' class="form-control" maxlength="1000" required></textarea>
						<!--small><span id="char_world">1000</span>/1000 characters remaining</small-->
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

<script type="text/javascript">
	// $(document).ready(function(){
		
		// $("#message").keypress(function(){
			// var count=$(this).val().length;
			// $("#messageword").text(1000-count);
			// //var messageword = $("#messageword").text();
			// if(count>1000){
				// var str=$(this).val().substring(0,1000) 
				// $(this).val(str);
				
				// return false;
			// }
				
				
				
			

		// });
		// $("#message").blur(function(){
			// var count=$(this).val().length;
				// $("#messageword").text(1000-count);
			// //var messageword = $("#messageword").text();
			// if(count>1000){
				// var str=$(this).val().substring(0,1000) 
				// $(this).val(str);
				// return false;
			// }else{
				
				
				// $("#messageword").text(1000-count);
			// }
		// });
	// });
	$( document ).ready(function() {
    var maxLength = 1000;
    $('textarea').keyup(function() {
        var length = $(this).val().length;
        var length = maxLength-length;
        $('#char_world').text(length);
    });
});
</script>