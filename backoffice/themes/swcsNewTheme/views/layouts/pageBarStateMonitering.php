<div class="page-bar">
       <div class="col-md-8">
      <ul class="page-breadcrumb">
         <li>
             <span class="pull-left"><a href="/backoffice/admin" title="Go to Dashboard " class="fa fa-home homeredirect" ></a></span>
                     <?php $showFixedBar=0; if(DefaultUtility::isHODNodal())
                            { echo "Welcome to Department Monitoring Panel";
                            } 
                           else if(DefaultUtility::isSECRETARY())
                               { echo "Welcome to Secretariat Monitoring Panel";
                               } 
                          else if(DefaultUtility::is_PRINCIPAL_SECRETARY()){
                              $showFixedBar="Y";
                               echo "<b>Welcome to State Monitoring Panel : Uttarakhand</b> ";

                           }
                            else if(DefaultUtility::is_CHEIF_SECRETARY()){
                                 $showFixedBar="Y";
                                 echo "<b>Welcome to State Monitoring Panel - Uttarakhand</b> ";
                            } else if(RolesExt::isMISManager()){
                                 $showFixedBar="Y";
                                 echo "<b>Welcome to MIS Manager Panel - Uttarakhand</b> ";
                            }else if(RolesExt::isDMUser()){
								$showFixedBar="1";
								echo "<b>Welcome to DM Panel - Uttarakhand</b> ";
							}else{
							
							}
                               ?> 
         </li>
      </ul>
           </div>
           <div class="col-md-4">
		   <?php $theme = Yii::app()->theme->name; 
			if($theme=='investuk')
			{
				$url = "/backoffice/mis/newReport/OverallNewReport";
			}else{			
				$url = "/backoffice/admin";
			}			
		   ?>
        <span class="pull-right" style="margin-top:5px;"><a href="<?php echo $url;?>" class="btn btn-success"><i class="fa fa-arrow-left"></i>&nbsp; Back</a></span>
    </div>
   </div>
