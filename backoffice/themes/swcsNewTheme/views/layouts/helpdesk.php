<style type="text/css">
	.page-sidebar .page-sidebar-menu li>a>.badge, .page-sidebar-closed.page-sidebar-fixed .page-sidebar:hover .page-sidebar-menu li>a>.badge{
		right: 41px;
		top: 9px;
	}
</style>
<?php
$iconArray=array("icon-diamond","icon-wallet","icon-settings","icon-puzzle","icon-bulb","icon-briefcase","icon-fire","icon-bar-chart","icon-layers","icon-feed","icon-docs","icon-folder","icon-social-dribbble","icon-note","icon-graph","icon-notebook","icon-grid");

?>
<ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
   <li class="sidebar-toggler-wrapper hide">
      <div class="sidebar-toggler">
         <span></span>
      </div>
   </li>
   <li class="nav-item start active open">
      <a href="<?=Yii::app()->createAbsoluteUrl('/helpdesk');?>" class="nav-link nav-toggle">
      <i class="icon-home"></i>
      <span class="title">Dashboard</span>
      <span class="selected"></span>
      </a>
   </li>
   <li class="nav-item start">
      <a href="<?php echo FRONT_BASEURL."ticket/autologin.php?luser=".$_SESSION['email']; ?>&flag=open" class="nav-link nav-toggle">
      <i class="icon-home"></i>
      <span class="title">Open New Tickets</span>
      </a>
   </li>
    <li class="nav-item start open">
      <a href="javascript:;" class="nav-link nav-toggle">
	      <i class="icon-layers"></i>
	      <span class="title">Reports</span>
	      <span class="arrow"></span>
      </a>
	  <ul class="sub-menu">
      	<li class="nav-item ">
      		<a href="<?php echo FRONT_BASEURL."ticket/autologin.php?luser=".$_SESSION['email']; ?>&flag=view" class="nav-link ">
      			<span class="title"> View My Tickets</span>
      		</a>
      	</li>
		<li class="nav-item ">
      		<a href="<?php echo FRONT_BASEURL."ticket/autologin.php?luser=".$_SESSION['email']; ?>&flag=all" class="nav-link ">
      			<span class="title"> View All Tickets</span>
      		</a>
      	</li>
		
      </ul>
      
   </li>
   <li class="nav-item  ">
      <a href="javascript:;" class="nav-link nav-toggle">
      <i class="icon-bulb"></i>
      <span class="title">Survey Managment</span>
      <span class="arrow"></span>
      </a>
      <ul class="sub-menu">
         <!--<li class="nav-item">
            <a href="<?=$this->createUrl('/survey/surveyQuestionMaster/')?>" class="nav-link">
            <span class="title">Manage Question Master</span>
            </a>
         </li>-->
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
   </li>
   
   
   
</ul>


      	

   

