<?php
/* @var $this HomeController */
//$this->breadcrumbs = array('Home',);
$baseUrl = Yii::app()->theme->baseUrl;
$basePath="/themes/investuk";
$userID = $_SESSION['RESPONSE']['user_id'];
//echo $userID;
$sc_id = isset($_GET['sc_id']) ? $_GET['sc_id'] : NULL;
 $sta = isset($_GET['sta']) ? $_GET['sta'] : NULL;     
?>
<div class="dashboard-home">
 
    <div class="applied-status" >
        <ul class="breadcrumb">
          <li><a href="/backoffice/investor/home/investorWalkthrough">Home</a></li>
          <li>Ticket & Query</li>
          </ul>
<?php if(Yii::app()->user->hasFlash('success')): ?>
<h5 style="text-align: center; color:green;">
  <?php echo Yii::app()->user->getFlash('success'); ?>
</h5>
<?php endif; ?> 
      <div class="status-title d-flex flex-wrap align-items-center justify-content-between">
         <h4>Applicant Monitoring Panel</h4>
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
<!-- <div class="form-part bussiness-det">  
           <h4 class="form-heading">Applicant Monitoring Panel</h4> -->
        <div class="form-row row">    
  <?php $this->renderPartial('/services/all_appsub',['sc_id'=>$sc_id,'userID'=>$userID,'basePath'=>$basePath,'baseUrl'=>$baseUrl]) ?>
<!-- </div> -->
</div>
</div>