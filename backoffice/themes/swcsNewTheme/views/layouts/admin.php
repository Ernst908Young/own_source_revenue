<ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
   <li class="sidebar-toggler-wrapper hide">
      <div class="sidebar-toggler">
         <span></span>
      </div>
   </li>
   <li class="nav-item start active open">
      <a href="<?=Yii::app()->createAbsoluteUrl('/admin');?>" class="nav-link nav-toggle">
      <i class="icon-home"></i>
      <span class="title">Dashboard</span>
      <span class="selected"></span>
      </a>
   </li>
   <li class="nav-item  ">
      <a href="<?=$this->createUrl('/admin/adminTasks/viewAllApplicationsComments')?>" class="nav-link nav-toggle">
      <i class="icon-diamond"></i>
      <span class="title">CAF Tracker</span>
      </a>
   </li>
   <li class="nav-item  ">
      <a href="<?=$this->createUrl('/admin/adminTasks/viewAllUsers')?>" class="nav-link nav-toggle">
	  <i class="icon-puzzle"></i>
      <span class="title">Investors</span>
      </a>
   </li>
   <li class="nav-item  ">
      <a href="<?=$this->createUrl('/mis/integratedDepartmentServices')?>" class="nav-link nav-toggle">
      <i class="icon-settings"></i>
      <span class="title">Integrated Department</span>
      </a>
   </li>
   <li class="nav-item  ">
      <a href="javascript:;" class="nav-link nav-toggle">
      <i class="icon-bulb"></i>
      <span class="title">SECTORIAL</span>
      <span class="arrow"></span>
      </a>
      <ul class="sub-menu">
         <li class="nav-item  ">
            <a href="<?=$this->createUrl('/mis/boApplicationSubmission/NICCodeReport')?>" class="nav-link ">
            <span class="title">Manufacturing-2 Digit</span>
            </a>
         </li>
         <li class="nav-item  ">
            <a href="<?=$this->createUrl('/mis/boApplicationSubmission/NICCodeServiceReport')?>" class="nav-link ">
            <span class="title">Service-2 Digit</span>
            </a>
         </li>
      </ul>
   </li>
   <li class="nav-item  ">
      <a href="javascript:;" class="nav-link nav-toggle">
      <i class="icon-briefcase"></i>
      <span class="title">CAF</span>
      <span class="arrow"></span>
      </a>
      <ul class="sub-menu">
         <li class="nav-item  ">
             <?php $newReportUrl="/site/CafProposalReport?from_date=2015-01-01&to_date=".date('Y-m-d')."&reportType=admin"; ?>
            <a href="<?php echo $newReportUrl?>" class="nav-link ">
            <span class="title">Overall CAF</span>
            </a>
         </li>
         <li class="nav-item  ">
            <a href="<?=$this->createUrl('/mis/pendency-report')?>" class="nav-link ">
            <span class="title">Pending CAF</span>
            </a>
         </li>
         <li class="nav-item  ">
            <a href="<?=$this->createUrl('/admin/adminTasks/getDistrictApplications')?>" class="nav-link nav-toggle">
            <span class="title">District Wise</span>
            </a>
         </li>
      </ul>
   </li>
   <li class="nav-item  ">
      <a href="javascript:;" class="nav-link nav-toggle">
      <i class="icon-bar-chart"></i>
      <span class="title">Land Detail</span>
      <span class="arrow"></span>
      </a>
      <ul class="sub-menu">
           <li class="nav-item  ">
            <a href="<?=$this->createUrl('/mis/LandAllotmentApplication/landtotaldistrictwisedetail')?>" class="nav-link "> 
            <span class="title">Land Report</span>
            </a>
         </li>
           <li class="nav-item  ">
            <a href="<?=$this->createUrl('/mis/LandAllotmentApplication/landinvestmentdetail')?>" class="nav-link "> 
            <span class="title">Land Investment</span>
            </a>
         </li>
           <li class="nav-item  ">
            <a href="<?=$this->createUrl('/mis/LandAllotmentApplication/landemploymentdetail')?>" class="nav-link "> 
            <span class="title">Land Employment</span>
            </a>
         </li>
           <li class="nav-item  ">
            <a href="<?=$this->createUrl('/mis/LandAllotmentApplication/incompletelandtotaldetail')?>" class="nav-link "> 
            <span class="title"> Incomplete Applications</span>
            </a>
         </li>
       <!--  <li class="nav-item  ">
            <a href="<?=$this->createUrl('/mis/boApplicationSubmission/landDetailReport')?>" class="nav-link ">
            <span class="title">Land Detail No</span>
            </a>
         </li>
         <li class="nav-item  ">
            <a href="<?=$this->createUrl('/mis/boApplicationSubmission/landDetailReportYes')?>" class="nav-link ">
            <span class="title">Land Detail Yes</span>
            </a>
         </li>-->
      </ul>
   </li>
   <li class="nav-item  ">
      <a href="<?=$this->createUrl('/mis/boApplicationSubmission/CategoryWiseInvestment')?>" class="nav-link nav-toggle">
      <i class="icon-settings"></i>
      <span class="title">Category Wise</span>
      </a>
   </li>
   <li class="nav-item  ">
      <a href="<?=$this->createUrl('/mis/boApplicationSubmission/IndustryWiseReport')?>" class="nav-link nav-toggle">
      <i class="icon-settings"></i>
      <span class="title">Industries Wise</span>
      </a>
   </li>
   <li class="nav-item  ">
      <a href="javascript:;" class="nav-link nav-toggle">
      <i class="icon-bulb"></i>
      <span class="title">Nodal Officers List</span>
      <span class="arrow"></span>
      </a>
      <ul class="sub-menu">
          <li class="nav-item  ">
            <a href="<?=$this->createUrl('/mis/boApplicationSubmission/GMList')?>" class="nav-link ">
            <span class="title">DIC GM</span>
            </a>
         </li>
         <li class="nav-item  ">
            <a href="<?=$this->createUrl('/mis/boApplicationSubmission/StateNodalList')?>" class="nav-link ">
            <span class="title">SWA State Nodal</span>
            </a>
         </li>
         <li class="nav-item  ">
            <a href="<?=$this->createUrl('/mis/boApplicationSubmission/DistrictNodalList')?>" class="nav-link ">
            <span class="title">SWA District Nodal</span>
            </a>
         </li>
           <li class="nav-item  ">
              <a href="<?php $role= base64_encode(64); echo $this->createUrl("/mis/boApplicationSubmission/userlist/ut/$role/title/EoDB District Level Nodal Officer")?>" class="nav-link ">
            <span class="title">EODB Nodal</span>
            </a>
         </li>
          <li class="nav-item  ">
            <a href="<?php $role= base64_encode(62); echo $this->createUrl("/mis/boApplicationSubmission/userlist/ut/$role/title/Head Of Department - User List"); ?>" class="nav-link ">
            <span class="title">Panel - Department</span>
            </a>
         </li>
          <li class="nav-item  ">
            <a href="<?php $role= base64_encode(71); echo $this->createUrl("/mis/boApplicationSubmission/userlist/ut/$role/title/Secretary Panel - User List"); ?>" class="nav-link ">
            <span class="title">Panel - Secretary</span>
            </a>
         </li>
      </ul>
   </li>
      <li class="nav-item start open">
       <a href="javascript:void(0)" title="View Application" class="nav-link policybenchmark">
           <span class="title"><i class="fa-gavel fa"></i> Policy Benchmark Report</span>        			    	    </a>
    <form action="http://uksubsidy.in/production/department-dashboard" class="nav-link " method="POST" target="_blank" id="policybenchmark">
        <input type="hidden" name="token" value="<?php echo strtotime(date('Y-m-d H:i:s'))."-".($_SESSION['uid']+date('Y')); ?>" >
        <input type="hidden" name="department_user_id" value="<?php echo base64_encode($_SESSION['uid']);?>">
    </form>         
   </li>
   <li class="nav-item  ">
      <a href="https://www.doiuk.org/easeofdoingbusiness.php" target="_blank" class="nav-link nav-toggle">
      <i class="icon-settings"></i>
      <span class="title">Existing Units List</span>
      </a>
   </li>
   <!--<li class="nav-item">
      <a href="javascript:;" class="nav-link nav-toggle">
      <i class="icon-bulb"></i>
      <span class="title">Survey Managment</span>
      <span class="arrow"></span>
      </a>
      <ul class="sub-menu">
         <li class="nav-item">
            <a href="<?=$this->createUrl('/survey/surveyCategory/')?>" class="nav-link">
            <span class="title">Manage Category Master</span>
            </a>
         </li>
         <li class="nav-item">
            <a href="<?=$this->createUrl('/survey/surveyQuestionAnswerMapping/')?>" class="nav-link">
            <span class="title">Manage Question Answer</span>
            </a>
         </li>
         <li class="nav-item">
            <a href="<?=$this->createUrl('/survey/Survey/')?>" class="nav-link">
            <span class="title">View/Create Survey</span>
            </a>
         </li>
         
		 
      </ul>
   </li> -->
</ul>
<script>
    $(document).ready(function(){
        $(".policybenchmark").click(function(){
                   $("#policybenchmark").submit();                    
                }); 
        
    });
    </script>