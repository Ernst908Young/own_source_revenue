 <li class="active">
            <a href="/backoffice/admin">
                  <div class="row">
                <div class="col-xs-2 col-lg-2 col-md-2 col-sm-2"> 
                <span class="list-icon">
                    <img src="<?php echo $basePath; ?>/assets/applicant/images/user-managment.png">
                     <img src="<?php echo $basePath; ?>/assets/applicant/images/user-managment-white.png" class="whiteicon">
                </span>
                </div>                
                 <div class="col-xs-10 col-lg-10 col-md-10 col-sm-10">
                User Management
                 </div>            
              </div>
            </a>
        </li>
  
		 <li <?php if(stristr($_SERVER['REQUEST_URI'],'rolesList')){ echo 'class="active"';}?>>
            <a href="/backoffice/admin/default/rolesList">
                  <div class="row">
                <div class="col-xs-2 col-lg-2 col-md-2 col-sm-2"> 
                <span class="list-icon">
                    <img src="<?php echo $basePath; ?>/assets/applicant/images/manage-roles.png">
                      <img src="<?php echo $basePath; ?>/assets/applicant/images/manage-roles-white.png" class="whiteicon">
                </span>
                </div>                
                 <div class="col-xs-10 col-lg-10 col-md-10 col-sm-10">
                Manage Roles
                 </div>            
              </div>
            </a>
        </li>
		
		<li <?php if(stristr($_SERVER['REQUEST_URI'],'userslist')){ echo 'class="active"';}?>>
            <a href="/backoffice/admin/default/userslist" >
                  <div class="row">
                <div class="col-xs-2 col-lg-2 col-md-2 col-sm-2"> 
                <span class="list-icon">
                    <img src="<?php echo $basePath; ?>/assets/applicant/images/dash-9.png">
                      <img src="<?php echo $basePath; ?>/assets/applicant/images/report-white.png" class="whiteicon">
                </span>
                </div>                
                 <div class="col-xs-10 col-lg-10 col-md-10 col-sm-10">
                Manage Users
                 </div>            
              </div>
            </a>
        </li>
		
			<li <?php if(stristr($_SERVER['REQUEST_URI'],'assignUserRole')){ echo 'class="active"';}?>>
            <a href="/backoffice/admin/default/assignUserRole" >
                  <div class="row">
                <div class="col-xs-2 col-lg-2 col-md-2 col-sm-2"> 
                <span class="list-icon">
                    <img src="<?php echo $basePath; ?>/assets/applicant/images/assign-roles.png">
                      <img src="<?php echo $basePath; ?>/assets/applicant/images/assign-roles-white.png" class="whiteicon">
                </span>
                </div>                
                 <div class="col-xs-10 col-lg-10 col-md-10 col-sm-10">
                Assign Roles
                 </div>            
              </div>
            </a>
        </li>
		
		<li <?php if(stristr($_SERVER['REQUEST_URI'],'managePrivileges')){ echo 'class="active"';}?>>
            <a href="/backoffice/admin/default/managePrivileges" >
                  <div class="row">
                <div class="col-xs-2 col-lg-2 col-md-2 col-sm-2"> 
                <span class="list-icon">
                    <img src="<?php echo $basePath; ?>/assets/applicant/images/manage-privileges.png">
                      <img src="<?php echo $basePath; ?>/assets/applicant/images/manage-privileges-white.png" class="whiteicon">
                </span>
                </div>                
                 <div class="col-xs-10 col-lg-10 col-md-10 col-sm-10">
                Manage Privileges
                 </div>            
              </div>
            </a>
        </li>
		<li <?php if(stristr($_SERVER['REQUEST_URI'],'manageuserservices')){ echo 'class="active"';}?>>
            <a href="/backoffice/admin/default/manageuserservices" >
                  <div class="row">
                <div class="col-xs-2 col-lg-2 col-md-2 col-sm-2"> 
                <span class="list-icon">
                    <img src="<?php echo $basePath; ?>/assets/applicant/images/assign-services.png">
                      <img src="<?php echo $basePath; ?>/assets/applicant/images/assign-services-white.png" class="whiteicon">
                </span>
                </div>                
                 <div class="col-xs-10 col-lg-10 col-md-10 col-sm-10">
                Assign Services
                 </div>            
              </div>
            </a>
        </li>
		<li <?php if(stristr($_SERVER['REQUEST_URI'],'usertransfer')){ echo 'class="active"';}?>>
            <a href="/backoffice/admin/default/usertransfer" >
                  <div class="row">
                <div class="col-xs-2 col-lg-2 col-md-2 col-sm-2"> 
                <span class="list-icon">
                    <img src="<?php echo $basePath; ?>/assets/applicant/images/user-transfer.png">
                      <img src="<?php echo $basePath; ?>/assets/applicant/images/user-transfer-white.png" class="whiteicon">
                </span>
                </div>                
                 <div class="col-xs-10 col-lg-10 col-md-10 col-sm-10">
                User Transfer
                 </div>            
              </div>
            </a>
        </li>