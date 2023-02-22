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
            }else
            $dashboard_active = 'active';
     }
    }
    $sc_id  = NULL;
} 
?>

<div class="dashborad-list">
    <div class="close-toggle">
        <i class="fa fa-angle-left" aria-hidden="true"></i>
    </div>
    <div class="logo">
      <a href="/" class="logo">
            <img src="/themes/investuk/assets/login/assests/images/AshokStambh.png" style="width: 70px;
    padding: 10px;">
            <strong style="font-size: 18px;  font-weight: 700px; color: #565b5f;">E-Judiciary System</strong>
        </a>
    </div>
    <ul class="dashboard-menu">
       <li class="<?php echo $dashboard_active; ?>">
          <a href="/backoffice/infowizard/dashboard">
              <!-- <span class="list-icon">
                   <img src="<1?php echo $basePath; ?>/assets/applicant/images/dash-1.png">
                   <img src="<1?php echo $basePath; ?>/assets/applicant/images/dashboard-white.png" class="whiteicon">
              </span> -->
              <span class="title">Dashboard</span>
              
          </a>
      </li>

       <li class="">
          <a href="<?=$this->createUrl('/infowizard/serviceMaster/listservicepage')?>">
               <span class="title">List Of Services</span>
          </a>
      </li>
      <li class="">
          <a href="javascript:void(0);" class="submenu">
            <span class="list-icon">
             <img src="<?php echo $basePath; ?>/assets/applicant/images/dash-1.png">
             <img src="<?php echo $basePath; ?>/assets/applicant/images/dashboard-white.png" class="whiteicon">
            </span>Masters
          </a>
           <div class="submenulist">
              <ul>
                   <li>
                      <a href="<?= $this->createUrl('/infowizard/formCategory') ?>">
                          <span class="title">Category Master</span>
                      </a>
                  </li>
                  <li>
                      <a href="<?= $this->createUrl('/infowizard/infowizardFormvariableMaster/create') ?>">
                          <span class="title">Form Field Master</span>
                      </a>
                  </li> 
                    <li>
                      <a href="<?= $this->createUrl('/infowizard/declaration/index') ?>">
                          <span class="title">Declaration Master</span>
                      </a>
                  </li> 
                  <li>
                    <a href="<?=$this->createUrl('/infowizard/infowizardDocumentchklist')?>" >
                    <span class="title"> Document Master</span>                
                    </a>
                 </li>
                 <!--  <li>
                      <a href="<?= $this->createUrl('/infowizard/formTypes') ?>">
                          <span class="title">Form Type Master</span>
                      </a>
                  </li> -->
              </ul>
           </div>
         </li>
     
       
       
      <li>
                <a href="<?= $this->createUrl('/infowizard/subForm/subFormListing/startPaging/1/endPaging/10') ?>">
                    <span class="title">Sub Form - Page Category Mapping & Form Genrator</span>
                </a>
            </li>

        
      

       <!-- <li class="">
          <a href="javascript:void(0);" class="submenu">
            <span class="list-icon">
             <img src="<?php echo $basePath; ?>/assets/applicant/images/dash-1.png">
             <img src="<?php echo $basePath; ?>/assets/applicant/images/dashboard-white.png" class="whiteicon">
            </span>Services
          </a>
           <div class="submenulist">
              <ul>
                  <li>
                     <a href="<?=$this->createUrl('/infowizard/serviceMaster/listservicepage')?>">
                      List Of Services
                    </a>                   
                  </li>  
                  <li>
                     <a href="<?=$this->createUrl('/infowizard/infowizardQuesansMapping/checkservice')?>">
                      <span class="title">Know your Approval</span>
                     </a>
                  </li> 
                  <li>
                    <a href="<?=$this->createUrl('/infowizard/PreServiceMapping')?>">
                    <span class="title">
                     Sectorial Profile - Pre-Requisite Service Mapping
                    </span>
                    </a>
                  </li>  
                   <li>
                    <a href="<?=$this->createUrl('/infowizard/serviceCertificateDocumentMapping/create')?>">
                    <span class="title">Service-Approval Certificate Mapping</span>
                    </a>
                 </li>

              </ul>
          </div>
        </li> -->

        <!--  <li class="">
          <a href="javascript:void(0);" class="submenu">
            <span class="list-icon">
             <img src="<?php echo $basePath; ?>/assets/applicant/images/dash-1.png">
             <img src="<?php echo $basePath; ?>/assets/applicant/images/dashboard-white.png" class="whiteicon">
            </span>Masters
          </a>
           <div class="submenulist">
              <ul>
                  <li>
                     <a href="<?=$this->createUrl('/infowizard/IssuerMaster/index')?>">
                      <span class="title">Issuer Master</span>
                      </a>                  
                  </li>  
                  <li>
                    <a href="<?=$this->createUrl('/infowizard/IssuerbyMaster/index')?>" >
                      <span class="title">Issued By Master</span>
                      </a>
                  </li> 
                  <li>
                     <a href="<?=$this->createUrl('/infowizard/DocunenttypeMaster/index')?>">
                       <span class="title">Document Type Master</span>
                    </a>
                  </li>  
                   <li>
                    <a href="<?=$this->createUrl('/infowizard/infowizardDocumentchklist')?>" >
                    <span class="title">Document Master</span>
                    </a>
                 </li>
                  <li>
                    <a href="<?=$this->createUrl('/infowizard/actMaster')?>">
                    <span class="title">Act Master</span>
                    </a>
                  </li>
             
                  
             
                   <li>
                    <a href="<?=$this->createUrl('/infowizard/professionalMaster')?>">
                    <span class="title">Professional Master</span>
                    </a>
                  </li>
                  <li>
                    <a href="<?=$this->createUrl('/userCreate/ListUser')?>">
                    <span class="title">Departmental Users</span>
                    </a>
                  </li>

              </ul>
          </div>
        </li> -->

         <!-- <li class="">
          <a href="javascript:void(0);" class="submenu">
            <span class="list-icon">
             <img src="<?php echo $basePath; ?>/assets/applicant/images/dash-1.png">
             <img src="<?php echo $basePath; ?>/assets/applicant/images/dashboard-white.png" class="whiteicon">
            </span>SubForm
          </a>
           <div class="submenulist">
              <ul>
                   <li>
                <a href="<?= $this->createUrl('/infowizard/infowizardFormvariableMaster/create') ?>">
                    <span class="title">Form Field Master</span>
                </a>
            </li>

            <li>
                <a href="<?= $this->createUrl('/infowizard/formCategory') ?>">
                    <span class="title">Category Master</span>
                </a>
            </li>

            <li>
                <a href="<?= $this->createUrl('/infowizard/formTypes') ?>">
                    <span class="title">Form Type Master</span>
                </a>
            </li>

            <li>
                <a href="<?= $this->createUrl('/infowizard/serviceFormMapping/create') ?>" >
                    <span class="title">Sub Form - Step 1</span>
                </a>
            </li>
            <li>
                <a href="<?= $this->createUrl('/infowizard/subForm/subFormListing/startPaging/1/endPaging/10') ?>">
                    <span class="title">Sub Form - Page Category Mapping & Form Genrator</span>
                </a>
            </li>
            <li>
                <a href="<?= $this->createUrl('/infowizard/serviceFormWorkflow/creation/service_id//workflowID/1/id/0') ?>">
                    <span class="title">Sub Form - Workflow Configurator</span> 
                </a>
            </li>

              </ul>
          </div>
        </li> -->
         
  
      
   
    

               <!--  <li class="nav-item start">
                    <a href="<?=Yii::app()->createAbsoluteUrl('/mis/reportConfigurations/create');?>" class="nav-link nav-toggle">
                    <i class="icon-list"></i>
                    <span class="title">Report Configurator</span>
                    </a>
                </li>


  <li class="nav-item">
        <a href="javascript:;" class="nav-link nav-toggle">
            <i class="icon-bulb"></i>
            <span class="title">Approval Wizard</span>
            <span class="arrow"></span> 
        </a>
        <ul class="sub-menu">

  <li class="nav-item  ">
            <a href="<?=$this->createUrl('/infowizard/infowizardQuestionMaster/listQuestion')?>" class="nav-link ">
            <span class="title">Step 1 - Question Master</span>
            </a>
         </li>

  <li class="nav-item  ">
            <a href="<?=$this->createUrl('/infowizard/infowizardQuesansMapping/page')?>" class="nav-link ">
            <span class="title">Step 2.a - Map Answer for Questions</span>
            </a>
         </li>
       
    
     <li class="nav-item  ">
            <a href="<?=$this->createUrl('/infowizard/infowizardQuesansMapping/listquestionanswer')?>" class="nav-link ">
            <span class="title">Step 2.b - Update Question Answer Mapping </span>
            </a>
         </li>

 <li class="nav-item  ">
            <a href="<?=$this->createUrl('/infowizard/infowizardQuesansMapping/excludequestion')?>" class="nav-link ">
            <span class="title">Step 2.c - Exclude Questions / Answers </span>
            </a>
         </li>


            <li class="nav-item  ">
                <a href="<?= $this->createUrl('/infowizard/serviceMaster/listSubServicePage/iw/Y/id/1') ?>" class="nav-link ">
                    <span class="title">Step 3 - Map QA for Sub Service</span>
                </a>
            </li>


        </ul> 
    </li>  -->


    </ul>
</div>