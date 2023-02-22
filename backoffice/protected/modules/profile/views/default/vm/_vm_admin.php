<style type="text/css">
 a:hover {
  cursor:pointer;
 }
</style>
<?php 
$basePath="/themes/investuk";
?>
<br>
 <strong>User Management</strong> 
<p>This functionality would allow the admin user to control user access and on-board and off-board users to and from IT resources. You must be logged in as a member of the Administrators group to add, delete, or modify a user, group, or role.</p>
<div class="row">
	<div class="col-md-6">
		<a onclick="showvideo('/videos_manuals/User Management/BO/Assign roles.mp4')" style="color:blue;">
            <img src="<?php echo $basePath; ?>/assets/applicant/images/video_icon.png">
             Assign Roles
        </a>	
	</div>
	<div class="col-md-6">
        <a target="_blank" href="/videos_manuals/User Management/BO/User Management.pdf"style="color:blue;">
            <img src="<?php echo $basePath; ?>/assets/applicant/images/pdf_icon.png">
            User Management
        </a>
			
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<a onclick="showvideo('/videos_manuals/User Management/BO/Manage priviledge.mp4')" style="color:blue;">
            <img src="<?php echo $basePath; ?>/assets/applicant/images/video_icon.png">
             Manage priviledge
        </a>	
	</div>
	<div class="col-md-12">
		<a onclick="showvideo('/videos_manuals/User Management/BO/Managing roles.mp4')" style="color:blue;">
            <img src="<?php echo $basePath; ?>/assets/applicant/images/video_icon.png">
             Managing roles
        </a>	
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<a onclick="showvideo('/videos_manuals/User Management/BO/Managing users.mp4')" style="color:blue;">
            <img src="<?php echo $basePath; ?>/assets/applicant/images/video_icon.png">
             Managing Users
        </a>	
	</div>
	<div class="col-md-12">
		<a onclick="showvideo('/videos_manuals/Name Related Services/BO/User Transfer.mp4')" style="color:blue;">
            <img src="<?php echo $basePath; ?>/assets/applicant/images/video_icon.png">
             User Transfer
        </a>	
	</div>	
</div>
<div class="row">
	<div class="col-md-6">
			<a onclick="showvideo('/videos_manuals/User Management/BO/Assign Services.mp4')" style="color:blue;">
            <img src="<?php echo $basePath; ?>/assets/applicant/images/video_icon.png">
             Assign Services
        </a>
	</div>	
</div>

<br>
 <strong>MIS Reports</strong>
  <p>By using this functionality, the management would be able to assess the performance of the organization and allow for faster decision-making. MIS reports would deliver a concise and comprehensive view of daily business activities at all levels. </p>
<div class="row">
    <div class="col-md-6">
        <a onclick="showvideo('/videos_manuals/MIS Reports/BO/MIS reports.mp4')" style="color:blue;">
            <img src="<?php echo $basePath; ?>/assets/applicant/images/video_icon.png">
             MIS Reports
        </a>    
    </div>  
     <div class="col-md-12">
        <a onclick="showvideo('/videos_manuals/MIS Reports/BO/CAIPO MIS Reports- Admin.mp4')" style="color:blue;">
            <img src="<?php echo $basePath; ?>/assets/applicant/images/video_icon.png">
             MIS Reports 2
        </a>    
    </div>     
</div>

<div class="modal" id="myModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-body">
      
        </div>
        <div class="modal-footer">         
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
        </div>
    </div>
  </div>

<script type="text/javascript">
function showvideo(path) {
    $(".modal-body").html("<video width='750' oncontextmenu='return false;' controlsList='nodownload' controls><source src='"+path+"' type='video/mp4'></video>");
		$('#myModal').modal('show');   
}
</script>