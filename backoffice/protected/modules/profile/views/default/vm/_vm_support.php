<style type="text/css">
 a:hover {
  cursor:pointer;
 }
</style>
<?php 
$basePath="/themes/investuk";
?>
<br>
 <strong style="margin-bottom: 5px;">Dashboard</strong>
 <p>By using this functionality, the user will be able to use different functions and filters within the dashboard for different services. </p>
<div class="row">
    <div class="col-md-6">
        <a onclick="showvideo('/videos_manuals/Dashboard/BO/BO_dashboard.mp4')" style="color:blue;">
            <img src="<?php echo $basePath; ?>/assets/applicant/images/video_icon.png">
             Dashboard
        </a>    
    </div>    
</div>

<br>
 <strong style="margin-bottom: 5px;">Ticket & Query</strong>
 <p>By using this service, the user will be able to raise Tickets and Queries for different services. </p>
<div class="row">
    <div class="col-md-6">
        <a onclick="showvideo('/videos_manuals/Ticket & query/BO/BO_ticketQuery.mp4')" style="color:blue;">
            <img src="<?php echo $basePath; ?>/assets/applicant/images/video_icon.png">
             Manage Ticket Query
        </a>    
    </div> 
    <div class="col-md-6" >
        <a target="_blank" href="/videos_manuals/Ticket & query/BO/Query and Ticket management system BO.pdf"style="color:blue;">
            <img src="<?php echo $basePath; ?>/assets/applicant/images/pdf_icon.png">
            Query and Ticket Management System
        </a>    
    </div>     
</div>
<br>
 <strong style="margin-bottom: 5px;">Grievance</strong>
 <p>By using this service, the user will be able to raise grievances for the exisiting Ticket and Queries.  </p>
<div class="row">
    <div class="col-md-6">
        <a onclick="showvideo('/videos_manuals/Grievance/bo/Grievance Redressal Management- Support user.mp4')" style="color:blue;">
            <img src="<?php echo $basePath; ?>/assets/applicant/images/video_icon.png">
             Grievance Redressal Management
        </a>    
    </div> 
    <div class="col-md-6" >
        <a target="_blank" href="/videos_manuals/Grievance/bo/Grievance Redressal management system (BO) (2).pdf"style="color:blue;">
            <img src="<?php echo $basePath; ?>/assets/applicant/images/pdf_icon.png">
            Grievance Redressal Management Manual
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