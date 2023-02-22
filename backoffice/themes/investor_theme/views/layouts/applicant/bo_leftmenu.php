<?php   
    if(isset($_GET['otd'])){        
        $dashboard_active = '';   
       $pa =  $_GET['otd']==1 ? 'active' : '' ; 
       $ra =  $_GET['otd']==2 ? 'active' : '' ; 
       $reports =  $_GET['otd']=='reports' ? 'active' : '' ;  
       $tck =  $_GET['otd']=='tck' ? 'active' : '' ; 
       $grv =  $_GET['otd']=='grv' ? 'active' : '' ; 
       $vm =  $_GET['otd']=='vm' ? 'active' : '' ; 
       $ct =  $_GET['otd']=='ct' ? 'active' : '' ;  
       $dss =$_GET['otd']=='dss' ? 'active' : '' ;  
    }else{
        $dashboard_active = 'active';
         $pa =   '' ; 
         $ra =   '' ;  
          $reports = '';
          $tck = '';
          $grv='';
          $vm = $ct = $dss ='';
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
	<?php if($_SESSION['role_id']!=86){ ?>
      <li class="<?php echo $dashboard_active; ?>">
          <a href="/panchayatiraj/backoffice/admin">
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
	<?php } ?>
  <?php 
         if($_SESSION['role_id']==95){
        require_once('left/_left_cashier.php');
       }
       
  ?>
  <!-- <li class="<?php echo $ct ; ?>">
        <a href="/panchayatiraj/backoffice/investor/services/boticket/otd/ct">
           <div class="row">
            <div class="col-xs-2 col-lg-2 col-md-2 col-sm-2"> 
            <span class="list-icon">
                <img src="<?php echo $basePath; ?>/assets/applicant/images/dash-8.png">
                 <img src="<?php echo $basePath; ?>/assets/applicant/images/ticket-white.png" class="whiteicon">
            </span>
             </div>                
             <div class="col-xs-10 col-lg-10 col-md-10 col-sm-10">
            Raise Ticket 
             </div>            
          </div>
        </a>
        </li> -->
       <?php 
       if($_SESSION['role_id']==83){
        require_once('left/_left_verifier.php');
       } 

       if($_SESSION['role_id']==84){
        require_once('left/_left_approver.php');
       } 

        if($_SESSION['role_id']==85){
        require_once('left/_left_support.php');
       }

        if($_SESSION['role_id']==86){
        require_once('left/_left_admin.php');
       }

     

       ?>

      <!-- <li class="<?php echo $tck; ?>">
          <a href="/panchayatiraj/backoffice/ticketing/default/highsupportindex/otd/tck">
             <div class="row">
                <div class="col-xs-2 col-lg-2 col-md-2 col-sm-2"> 
              <span class="list-icon">
                  <img src="<?php echo $basePath; ?>/assets/applicant/images/dash-8.png">
                     <img src="<?php echo $basePath; ?>/assets/applicant/images/ticket-white.png" class="whiteicon">
              </span>
               </div>                
                 <div class="col-xs-10 col-lg-10 col-md-10 col-sm-10">
              Tickets Assigned
               </div>            
              </div>
          </a>
      </li> -->
      <!-- <li class="<?php echo $grv; ?>">
          <a href="/panchayatiraj/backoffice/grievance/default/highsupportindex/otd/grv">
             <div class="row">
                <div class="col-xs-2 col-lg-2 col-md-2 col-sm-2"> 
              <span class="list-icon">
                  <img src="<?php echo $basePath; ?>/assets/applicant/images/grievance-o.png">
                     <img src="<?php echo $basePath; ?>/assets/applicant/images/grievance-white.png" class="whiteicon">
              </span>
               </div>                
                 <div class="col-xs-10 col-lg-10 col-md-10 col-sm-10">
              Grievance Assigned
               </div>            
              </div>
          </a>
      </li> -->
     <!-- <li class="<?php echo $dss; ?>">
          <a href="/panchayatiraj/backoffice/dss/default/dashboard/otd/dss">
             <div class="row">
                <div class="col-xs-2 col-lg-2 col-md-2 col-sm-2"> 
              <span class="list-icon">
                  <img src="<?php echo $basePath; ?>/assets/applicant/images/dss_icons/DSS-icon.png">
                     <img src="<?php echo $basePath; ?>/assets/applicant/images/dss_icons/DSS-white.png" class="whiteicon">
              </span>
               </div>                
                 <div class="col-xs-10 col-lg-10 col-md-10 col-sm-10">
                    Decision Support System
               </div>            
              </div>
          </a>
      </li>-->

      
       
        <!-- <li class="<?php echo $reports; ?>">
          <a href="javascript:void(0);" class="submenu">
             <div class="row">
                <div class="col-xs-2 col-lg-2 col-md-2 col-sm-2"> 
            <span class="list-icon">
              <img src="<?php echo $basePath; ?>/assets/applicant/images/dash-9.png" class="defaulticon">
              <img src="<?php echo $basePath; ?>/assets/applicant/images/report-white.png" class="whiteicon">
            </span>
             </div>                
                 <div class="col-xs-10 col-lg-10 col-md-10 col-sm-10">
                  MIS Reports
                   </div>            
              </div>
          </a>
           <div class="submenulist">
              <ul>
                  <li><a href="/panchayatiraj/backoffice/misreports/revenue/srs/otd/reports">Service Revenue Summary</a></li>
                  <li><a href="/panchayatiraj/backoffice/misreports/revenue/level1/type/service/otd/reports">Service Wise Revenue Report</a></li>
                  <li><a href="/panchayatiraj/backoffice/misreports/revenue/officiallevel1/type/official/otd/reports">Official Wise Revenue Report</a></li>
                  <li><a href="/panchayatiraj/backoffice/misreports/entity/level1/otd/reports">Entity Summary Report</a></li>
                  <li><a href="/panchayatiraj/backoffice/misreports/timeline/level1/otd/reports">Timeline Report</a></li>
                  <li><a href="/panchayatiraj/backoffice/misreports/officerproductivity/level1/otd/reports">Officer Productivity Report</a></li>
                  <li><a href="/panchayatiraj/backoffice/misreports/sp/spreport/otd/reports">Representative Report</a></li>
                  <li><a href="/panchayatiraj/backoffice/misreports/sp/spsummaryreportlevel1/otd/reports">Representative Summary Report</a></li>
                  <li><a href="/panchayatiraj/backoffice/misreports/ticketing/level1/otd/reports">Ticketing Report</a></li>
                  <li><a href="/panchayatiraj/backoffice/misreports/query/level1/otd/reports"> Query Report</a></li>
                  <li><a href="/panchayatiraj/backoffice/misreports/grievance/level1/otd/reports">Grievance Redressal Report</a></li>
                   <li><a href="/panchayatiraj/backoffice/misreports/users/fo/otd/reports">Registered Users Applicants</a></li>
                   <li><a href="/panchayatiraj/backoffice/misreports/closeentity/ceased/otd/reports">Ceased Business Names</a></li>
                   <li><a href="/panchayatiraj/backoffice/misreports/closeentity/dissolved/otd/reports">Dissolved Business Names</a></li>
                    <li><a href="/panchayatiraj/backoffice/misreports/users/director/otd/reports">Directors Report</a></li> 
                    <li><a href="/panchayatiraj/backoffice/misreports/users/directorl1/otd/reports">Director’s Cross Reference</a></li>  
                     <li><a href="/panchayatiraj/backoffice/misreports/services/inaslevel1/otd/reports">Incorporation Analysis</a></li>  
                      <li><a href="/panchayatiraj/backoffice/misreports/entity/ens/otd/reports">Entity Name Summary</a></li>  
                     <li><a href="/panchayatiraj/backoffice/misreports/revenue/tcslevel1/otd/reports">Transaction Code Summary</a></li>                 
                 
              </ul>
          </div>
        </li> -->
        <!--<li class="<?php echo $vm; ?>">
          <a href="/panchayatiraj/backoffice/profile/default/vm/otd/vm">
             <div class="row">
                <div class="col-xs-2 col-lg-2 col-md-2 col-sm-2"> 
              <span class="list-icon">
                <img src="<?php echo $basePath; ?>/assets/applicant/images/i_icono.png">
                   <img src="<?php echo $basePath; ?>/assets/applicant/images/i_iconw.png" class="whiteicon">
              </span>
               </div>                
                 <div class="col-xs-10 col-lg-10 col-md-10 col-sm-10">
                  User Guide
               </div>            
              </div>
          </a>
      </li>-->
    </ul>
</div>


