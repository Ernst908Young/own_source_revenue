<?php 
if(isset($_GET['sc_id'])){
     $dashboard_active = '';
     $sc_id =$_GET['sc_id'];
}else{
    if(isset($_GET['tq'])){
        $dashboard_active = '';
    }else{
        if(isset($_GET['obsp'])){
             $dashboard_active = '';
        }else{
            if(isset($_GET['reports'])){
             $dashboard_active = '';
            }else{
                if(isset($_GET['obsu'])){
               $dashboard_active = '';
              }else
                if(isset($_GET['avpd'])){
                      $dashboard_active = '';
                  }else{
                    if(isset($_GET['tq'])){
                      $dashboard_active = '';
                      }else{
                        if(isset($_GET['grv'])){
                              $dashboard_active = '';
                          }else{
                              $dashboard_active = 'active';
                          }
                          
                      }
                     
                  }
            }           
     }
    }
    $sc_id  = NULL;
} 
?>

<div class="dashborad-list">
    <div class="close-toggle">
        <i class="fa fa-angle-left" aria-hidden="true"></i>
    </div>
    <div class="logo" style="height: 70px;">
        <a href="http://52.172.145.30/panchayatiraj/sso/account/signin" class="logo">
            <!-- <img src="http://52.172.145.30/panchayatiraj/themes/investuk/assets/login/assests/images/punjab_logo.png" style="width: 70px;
    padding: 10px;"> -->
            <strong style="font-size: 18px;  font-weight: 700px; color: #565b5f;padding-top: 45px;padding-left: 45px;">Own Source of Revenue</strong>
        </a>
    </div>
    <ul class="dashboard-menu">
        <li class="<?php echo $dashboard_active; ?>">
            <a href="/panchayatiraj/backoffice/investor/home/investorWalkthrough">
               <div class="row">
                <div class="col-xs-2 col-lg-2 col-md-2 col-sm-2"> 
                <span class="list-icon">
                    <img src="<?php echo $basePath; ?>/assets/applicant/images/dash-1.png">
                     <img src="<?php echo $basePath; ?>/assets/applicant/images/dashboard-white.png" class="whiteicon">
                </span>
                 </div>                
                 <div class="col-xs-10 col-lg-10 col-md-10 col-sm-10">
                Dashboard
                 </div>            
              </div>
            </a>
        </li>

        <?php if($_SESSION['RESPONSE']['user_type']==2){ ?>
        <li class="<?php echo  isset($_GET['obsp']) ? 'active' : '' ?>">
            <a href="/panchayatiraj/backoffice/investor/serviceprovider/spdoc/obsp/1">
              <div class="row">
                <div class="col-xs-2 col-lg-2 col-md-2 col-sm-2"> 
                <span class="list-icon">
                    <img src="<?php echo $basePath; ?>/assets/applicant/images/dash-1.png">
                    <img src="<?php echo $basePath; ?>/assets/applicant/images/dashboard-white.png" class="whiteicon">
                </span>
                 </div>                
                 <div class="col-xs-10 col-lg-10 col-md-10 col-sm-10">
                    Documents
                 </div>            
              </div>
            </a>
        </li>
        
    <?php } ?>

     <?php $sc_arr = Yii::app()->db->createCommand("SELECT * FROM bo_information_wizard_services_category WHERE is_active=1")->queryAll(); ?>
      <?php $k=1; $i=1; foreach($sc_arr as $val){ $k++;?>
        <li class="<?php echo $sc_id==$i ? 'active' : '' ; ?>" >
            <a href="/panchayatiraj/backoffice/investor/services/dashboard?sc_id=<?php echo base64_encode($val['id']); ?>">
         

               <div class="row">
                <div class="col-xs-2 col-lg-2 col-md-2 col-sm-2">   
                  <span class="list-icon">             
                    <img src="<?php echo $basePath; ?>/assets/applicant/images/dash-<?php echo $k ?>.png">
                    <img src="<?php echo $basePath; ?>/assets/applicant/images/<?php echo $k ?>_white.png" class="whiteicon">
                  </span>
                </div>                
                 <div class="col-xs-10 col-lg-10 col-md-10 col-sm-10">   
                  <?php echo $val['category_name']; ?>
                 </div>            
              </div>

            </a>
        </li>
      <?php  $i++; } ?>

      <li class="<?= isset($_GET['tq']) ? 'active' : '' ?>">
            <a href="/panchayatiraj/backoffice/investor/services/ticketquery/tq">
               <div class="row">
                <div class="col-xs-2 col-lg-2 col-md-2 col-sm-2"> 
                <span class="list-icon">
                    <img src="<?php echo $basePath; ?>/assets/applicant/images/dash-8.png">
                     <img src="<?php echo $basePath; ?>/assets/applicant/images/ticket-white.png" class="whiteicon">
                </span>
                 </div>                
                 <div class="col-xs-10 col-lg-10 col-md-10 col-sm-10">
                Ticket / Query
                 </div>            
              </div>
            </a>
        </li>
        <li class="<?= isset($_GET['grv']) ? 'active' : '' ?>">
            <a href="/panchayatiraj/backoffice/investor/services/grievance/grv">
               <div class="row">
                <div class="col-xs-2 col-lg-2 col-md-2 col-sm-2"> 
                <span class="list-icon">
                    <img src="<?php echo $basePath; ?>/assets/applicant/images/grievance-o.png">
                     <img src="<?php echo $basePath; ?>/assets/applicant/images/grievance-white.png" class="whiteicon">
                </span>
                 </div>                
                 <div class="col-xs-10 col-lg-10 col-md-10 col-sm-10">
                 Grievance Redressal Management
                 </div>            
              </div>
            </a>
        </li>
   
       

         
       
   
    </ul>
</div>