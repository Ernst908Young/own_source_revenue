<style type="text/css">
 a:hover {
  cursor:pointer;
 }
</style>
<?php 
$basePath="/themes/investuk";
?>
<br>
 <strong>Cashier</strong>
 <p>By using this functionality, the Cashier would be able to receive payments and issue receipts against the availed services. </p>
<div class="row">
    <div class="col-md-6">
        <a onclick="showvideo('/videos_manuals/Cashier/BO/Cashier.mp4')" style="color:blue;">
            <img src="<?php echo $basePath; ?>/assets/applicant/images/video_icon.png">
             Cashier
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