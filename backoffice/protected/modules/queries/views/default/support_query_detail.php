<style>
.msg {
  text-align: justify;
  text-justify: inter-word;
}
</style>
<div class="dashboard-home">
    <div class="applied-status" >
        <ul class="breadcrumb">
          <li><a href="/backoffice/admin">Home</a></li>
          <li><a href="/backoffice/queries/default/supportindex">Query</a></li>
          <li>Query Details</li>
          </ul>
     
</div>
</div>


        
		<div class="reservation-form">   
<div class="form-part bussiness-det">   
        <h4 class="form-heading">Query Details</h4>
        <div class="form-row row">       
				<table class="table table-striped table-bordered table-hover">						<tr>
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
						<td class="a_cent" style="font-size: 16px;"><strong  style='color: #333; font-size: 16px;'>Created On: </strong> <?php echo date("d M Y h:i a",strtotime($qmain['created_on'])) ?>   </td>
						<td class="a_cent" style="font-size: 16px;"><strong  style='color: #333; font-size: 16px;'>Priority: </strong> <?php echo $qmain['querypriority'] ?>   </td>
					</tr>	
			</table>

<?php if($qmain['status']==1){ ?>
				<form id="spquery_form" method="post" action="<?php echo Yii::app()->createAbsoluteUrl("/queries/default/statuspriority"); ?>" enctype="multipart/form-data">
					<input type="hidden" name="id" value="<?php echo  $qmain['id'] ?>">
				<div class="row">
					<div class="form-group col-md-4">
						<label>Set Priority</label>
							<?php
								$pri = array('Normal'=>'Normal','Medium'=>'Medium','High'=>'High','Low'=>'Low');
							?>

							<select name="tktpri" placeholder="Select $qmain Priority" class="form-control select2-me" id="tktpri">
							
								<?php foreach ($pri as $key => $val) { 
									$pri_selected = $val== $qmain['querypriority'] ? 'selected': '';
									?>
								<option value="<?php echo $key; ?>" <?php echo $pri_selected?>><?php echo $val; ?></option>
							<?php } ?>
						</select>  
						<span id="tktpri-error" style="color: red;"></span>	   		
	   				</div>
	   				<div class="form-group col-md-4">
						<label>Status</label>
							<?php
								$status = array(1=>'Open',0=>'Closed');
							?>

							<select name="status" placeholder="Select status" class="form-control select2-me" id="status">
							
								<?php foreach ($status as $key => $val) { 
									$status_selected = $key== $qmain['status'] ? 'selected': '';
									?>
								<option value="<?php echo $key; ?>" <?php echo $status_selected?>><?php echo $val; ?></option>
							<?php } ?>
						</select>  
						<span id="status-error" style="color: red;"></span>	   		
	   				</div>
	   				<div class="form-group col-md-4" style="margin-top: 25px;">
			   	      <span onclick="ajaxsubmit()" id="stfs" class="btn btn-primary" style="font-size: 18px; width: 120px;">Update</span>
			   	    </div>
				</div>
			</form>

		
			
<?php } ?>
<hr style="color: #36c6d3;" />	
	<strong style="color: #000;">Replies Received</strong>
					
				<?php


				foreach($messages as $mk=>$mv){ 
				$name="";
				if($qmain['name']=="" && $mv['user_type']=='URU'){
					$name="Un-Register User";
				}
				else if($qmain['name']=="" && $mv['user_type']=='AU'){
					$name="Applicant User";
				}
				else{
					$name=$qmain['name'];
				}
				?><br><br>
				
					<div class="row">
						<div class="col-md-8">
							<strong>By: </strong> 
								<?php echo $mv['user_type']=='URU' ? $name : ($mv['user_type']=='AU' ? $name : "Support Team User")?>
						</div>
						<div class="col-md-4">
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<strong>On: </strong> <?php echo date("d M Y h:i a",strtotime($mv['msgdatetime'])) ; ?>
						</div>
						
					</div>
				
				
					<div class="row msg" >
						<div class="col-md-12 msg" >
							<?php echo $mv['message']; ?>
						</div>
						
						
					</div><br><hr style="color: #36c6d3;" />
				
					

				<?php } ?>

<?php if($qmain['status']==1){ ?>
	
				<form id="query_msg_form" method="post" action="<?php echo Yii::app()->createAbsoluteUrl("/queries/default/supportquerydetail/q_id/$q_id"); ?>" enctype="multipart/form-data">
				<div class="row">
					<div class="form-group col-md-12">						
						<label><strong style="color: #000;">Reply Message</strong>&nbsp;<span style="color:red">*</span></label>
						<textarea name="message" id="message" placeholder="Enter your Message here" rows='12' maxlength="1000" class="form-control" required></textarea>
						<!-- <small><span id="char_world">1000</span>/1000 characters remaining</small> -->
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
<!--?php Yii::app()->clientScript->registerScript('myjquery','$("#stfs").submit(function(e) {
	ajaxsubmit(e);
}'); ?-->

<script type="text/javascript">
	function ajaxsubmit(){
		//alert('hi');
		 //e.preventDefault(); // avoid to execute the actual submit of the form.
	    var form = $("#spquery_form");
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
        			$("#tktpri-error").text("");		         
        		    alert("query has been updated");	
        		   }
		        });
	}
	
	$( document ).ready(function() {
		var maxLength = 1000;
		$('textarea').keyup(function() {
			var length = $(this).val().length;
			var length = maxLength-length;
			$('#char_world').text(length);
		});
	});
</script>