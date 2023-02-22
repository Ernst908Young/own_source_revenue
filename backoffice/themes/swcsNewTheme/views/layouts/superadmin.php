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
      <a href="<?=Yii::app()->createAbsoluteUrl('/admin');?>" class="nav-link nav-toggle">
      <i class="icon-home"></i>
      <span class="title">Dashboard</span>
      <span class="selected"></span>
      </a>
   </li>
   <li class="nav-item  ">
      <a href="<?=FRONT_BASEURL?>/sso/admin" class="nav-link nav-toggle">
      <i class="icon-diamond"></i>
      <span class="title">SSO Integration</span>
      </a>
   </li>
   <li class="nav-item  ">
      <a href="javascript:;" class="nav-link nav-toggle">
      <i class="icon-briefcase"></i>
      <span class="title">Applications</span>
      <span class="arrow"></span>
      </a>
      <ul class="sub-menu">
         <li class="nav-item  ">
            <a href="<?=$this->createUrl('/admin/applications/admin')?>" class="nav-link ">
            <span class="title">Manage</span>
            </a>
         </li>
         <li class="nav-item  ">
            <a href="<?=$this->createUrl('/admin/applications/create')?>" class="nav-link ">
            <span class="title">Create</span>
            </a>
         </li>
      </ul>
   </li>
   <li class="nav-item  ">
      <a href="javascript:;" class="nav-link nav-toggle">
      <i class="<?=$iconArray[1]?>"></i>
      <span class="title">Departments</span>
      <span class="arrow"></span>
      </a>
      <ul class="sub-menu">
         <li class="nav-item  ">
            <a href="<?=$this->createUrl('/admin/departments/admin')?>" class="nav-link ">
            <span class="title">Manage</span>
            </a>
         </li>
         <li class="nav-item  ">
            <a href="<?=$this->createUrl('/admin/departments/create')?>" class="nav-link ">
            <span class="title">Create</span>
            </a>
         </li>
      </ul>
   </li>
   <li class="nav-item  ">
      <a href="javascript:;" class="nav-link nav-toggle">
      <i class="<?=$iconArray[2]?>"></i>
      <span class="title">Users</span>
      <span class="arrow"></span>
      </a>
      <ul class="sub-menu">
         <li class="nav-item  ">
            <a href="<?=$this->createUrl('/admin/user/admin')?>" class="nav-link ">
            <span class="title">Manage</span>
            </a>
         </li>
         <li class="nav-item  ">
            <a href="<?=$this->createUrl('/admin/user/create')?>" class="nav-link ">
            <span class="title">Create</span>
            </a>
         </li>
      </ul>
   </li>
   <li class="nav-item  ">
      <a href="javascript:;" class="nav-link nav-toggle">
      <i class="<?=$iconArray[3]?>"></i>
      <span class="title">Roles</span>
      <span class="arrow"></span>
      </a>
      <ul class="sub-menu">
         <li class="nav-item  ">
            <a href="<?=$this->createUrl('/admin/roles/admin')?>" class="nav-link ">
            <span class="title">Manage</span>
            </a>
         </li>
         <li class="nav-item  ">
            <a href="<?=$this->createUrl('/admin/roles/create')?>" class="nav-link ">
            <span class="title">Create</span>
            </a>
         </li>
      </ul>
   </li>
   <li class="nav-item  ">
      <a href="javascript:;" class="nav-link nav-toggle">
      <i class="<?=$iconArray[4]?>"></i>
      <span class="title">User Role Mapping</span>
      <span class="arrow"></span>
      </a>
      <ul class="sub-menu">
         <li class="nav-item  ">
            <a href="<?=$this->createUrl('/admin/userRoleMapping/admin')?>" class="nav-link ">
            <span class="title">Manage</span>
            </a>
         </li>
         <li class="nav-item  ">
            <a href="<?=$this->createUrl('/admin/userRoleMapping/create')?>" class="nav-link ">
            <span class="title">Create</span>
            </a>
         </li>
         <li class="nav-item  ">
            <a href="<?=$this->createUrl('/admin/userRoleModuleMapping/admin')?>" class="nav-link ">
            <span class="title">Manage Incentive Mapping</span>
            </a>
         </li>
         <li class="nav-item  ">
            <a href="<?=$this->createUrl('/admin/userRoleModuleMapping/create')?>" class="nav-link ">
            <span class="title">Create Incentive Mapping</span>
            </a>
         </li>
      </ul>
   </li>
   <li class="nav-item  ">
      <a href="javascript:;" class="nav-link nav-toggle">
      <i class="<?=$iconArray[14]?>"></i>
      <span class="title">Manage Access</span>
      <span class="arrow"></span>
      </a>
      <ul class="sub-menu">
         <li class="nav-item  ">
            <a href="<?=$this->createUrl('/admin/roleAccess/admin')?>" class="nav-link ">
            <span class="title">Manage</span>
            </a>
         </li>
         <li class="nav-item  ">
            <a href="<?=$this->createUrl('/admin/roleAccess/create')?>" class="nav-link ">
            <span class="title">Create</span>
            </a>
         </li>
      </ul>
   </li>
   <li class="nav-item  ">
      <a href="javascript:;" class="nav-link nav-toggle">
      <i class="<?=$iconArray[6]?>"></i>
      <span class="title">Role Access Mapping</span>
      <span class="arrow"></span>
      </a>
      <ul class="sub-menu">
         <li class="nav-item  ">
            <a href="<?=$this->createUrl('/admin/roleAccessMapping/admin')?>" class="nav-link ">
            <span class="title">Manage</span>
            </a>
         </li>
         <li class="nav-item  ">
            <a href="<?=$this->createUrl('/admin/roleAccessMapping/create')?>" class="nav-link ">
            <span class="title">Create</span>
            </a>
         </li>
      </ul>
   </li>
   <li class="nav-item  ">
      <a href="javascript:;" class="nav-link nav-toggle">
      <i class="<?=$iconArray[7]?>"></i>
      <span class="title">Documents</span>
      <span class="arrow"></span>
      </a>
      <ul class="sub-menu">
         <li class="nav-item  ">
            <a href="<?=$this->createUrl('/admin/cdnMaster/admin')?>" class="nav-link ">
            <span class="title">Manage</span>
            </a>
         </li>
         <li class="nav-item  ">
            <a href="<?=$this->createUrl('/admin/cdnMaster/create')?>" class="nav-link ">
            <span class="title">Create</span>
            </a>
         </li>
      </ul>
   </li>
   <li class="nav-item  ">
      <a href="javascript:;" class="nav-link nav-toggle">
      <i class="<?=$iconArray[8]?>"></i>
      <span class="title">Application Fields</span>
      <span class="arrow"></span>
      </a>
      <ul class="sub-menu">
         <li class="nav-item  ">
            <a href="<?=$this->createUrl('/admin/filelds/admin')?>" class="nav-link ">
            <span class="title">Manage</span>
            </a>
         </li>
         <li class="nav-item  ">
            <a href="<?=$this->createUrl('/admin/filelds/create')?>" class="nav-link ">
            <span class="title">Create</span>
            </a>
         </li>
      </ul>
   </li>
   <li class="nav-item  ">
      <a href="javascript:;" class="nav-link nav-toggle">
      <i class="<?=$iconArray[9]?>"></i>
      <span class="title">App Fields Mapping</span>
      <span class="arrow"></span>
      </a>
      <ul class="sub-menu">
         <li class="nav-item  ">
            <a href="<?=$this->createUrl('/admin/applicationsFieldsMapping/admin')?>" class="nav-link ">
            <span class="title">Manage</span>
            </a>
         </li>
         <li class="nav-item  ">
            <a href="<?=$this->createUrl('/admin/applicationsFieldsMapping/create')?>" class="nav-link ">
            <span class="title">Create</span>
            </a>
         </li>
      </ul>
   </li>
   <li class="nav-item  ">
      <a href="javascript:;" class="nav-link nav-toggle">
      <i class="<?=$iconArray[10]?>"></i>
      <span class="title">App Doc Mapping</span>
      <span class="arrow"></span>
      </a>
      <ul class="sub-menu">
         <li class="nav-item  ">
            <a href="<?=$this->createUrl('/admin/applicationCdnMapping/admin')?>" class="nav-link ">
            <span class="title">Manage</span>
            </a>
         </li>
         <li class="nav-item  ">
            <a href="<?=$this->createUrl('/admin/applicationCdnMapping/create')?>" class="nav-link ">
            <span class="title">Create</span>
            </a>
         </li>
      </ul>
   </li>
   <li class="nav-item  ">
      <a href="javascript:;" class="nav-link nav-toggle">
      <i class="<?=$iconArray[11]?>"></i>
      <span class="title">Application Submission</span>
      <span class="arrow"></span>
      </a>
      <ul class="sub-menu">
         <li class="nav-item  ">
            <a href="<?=$this->createUrl('/admin/applicationsSubmittions/admin')?>" class="nav-link ">
            <span class="title">Manage</span>
            </a>
         </li>
         <li class="nav-item  ">
            <a href="<?=$this->createUrl('/admin/applicationsSubmittions/create')?>" class="nav-link ">
            <span class="title">Create</span>
            </a>
         </li>
      </ul>
   </li>
   <li class="nav-item  ">
      <a href="javascript:;" class="nav-link nav-toggle">
      <i class="<?=$iconArray[12]?>"></i>
      <span class="title">Other Applications</span>
      <span class="arrow"></span>
      </a>
      <ul class="sub-menu">
         <li class="nav-item  ">
            <a href="<?=$this->createUrl('/admin/spAllApplications/admin')?>" class="nav-link ">
            <span class="title">Manage</span>
            </a>
         </li>
         <li class="nav-item  ">
            <a href="<?=$this->createUrl('/admin/spAllApplications/create')?>" class="nav-link ">
            <span class="title">Create</span>
            </a>
         </li>
         <li class="nav-item  ">
            <a href="<?=$this->createUrl('/admin/spApplcationsDetail/admin')?>" class="nav-link ">
            <span class="title">Manage App Detail</span>
            </a>
         </li>
         <li class="nav-item  ">
            <a href="<?=$this->createUrl('/admin/spApplcationsDetail/create')?>" class="nav-link ">
            <span class="title">Create App Detail</span>
            </a>
         </li>
      </ul>
   </li>
   <li class="nav-item  ">
      <a href="javascript:;" class="nav-link nav-toggle">
      <i class="<?=$iconArray[13]?>"></i>
      <span class="title">Step To Dept Msg</span>
      <span class="arrow"></span>
      </a>
      <ul class="sub-menu">
         <li class="nav-item  ">
            <a href="<?=$this->createUrl('/admin/predefinedDepartmentMessage/admin')?>" class="nav-link ">
            <span class="title">Manage</span>
            </a>
         </li>
         <li class="nav-item  ">
            <a href="<?=$this->createUrl('/admin/predefinedDepartmentMessage/create')?>" class="nav-link ">
            <span class="title">Create</span>
            </a>
         </li>
      </ul>
   </li>
</ul>