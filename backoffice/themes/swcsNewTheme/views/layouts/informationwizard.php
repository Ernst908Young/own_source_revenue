<ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
   <li class="sidebar-toggler-wrapper hide">
      <div class="sidebar-toggler">
         <span></span>
      </div>
   </li>
   <li class="nav-item start active open">
      <a href="<?=Yii::app()->createAbsoluteUrl('/infowizard/dashboard');?>" class="nav-link nav-toggle">
      <i class="icon-home"></i>
      <span class="title">Dashboard</span>
      <span class="selected"></span>
      </a>
   </li>

 
  
   
  <li class="nav-item">
      <a href="javascript:;" class="nav-link nav-toggle">
      <i class="icon-bulb"></i>
      <span class="title">Services</span>
      <span class="arrow"></span> 
      </a>
      <ul class="sub-menu">
	  
		  <li class="nav-item  ">
            <a href="<?=$this->createUrl('/infowizard/serviceMaster/listservicepage')?>" class="nav-link ">
            <span class="title">List Of Services</span>
            </a>
         </li>
		  <li class="nav-item  ">
            <a href="<?=$this->createUrl('/infowizard/infowizardQuesansMapping/checkservice')?>" class="nav-link ">
            <span class="title">Know your Approval</span>
            </a>
         </li>
		 <li class="nav-item  ">
            <a href="<?=$this->createUrl('/infowizard/PreServiceMapping')?>" class="nav-link ">
            <span class="title">Sectorial Profile - Pre-Requisite Service Mapping</span>
            </a>
         </li>
		 <li class="nav-item  ">
            <a href="<?=$this->createUrl('/infowizard/serviceCertificateDocumentMapping/create')?>" class="nav-link ">
            <span class="title">Service-Approval Certificate Mapping</span>
            </a>
         </li>
         </ul>
      </li>
	<li class="nav-item">
      <a href="javascript:;" class="nav-link nav-toggle">
		  <i class="icon-bulb"></i>
		  <span class="title">Masters</span>
		  <span class="arrow"></span> 
      </a>
      <ul class="sub-menu"> 
		  <li class="nav-item  ">
            <a href="<?=$this->createUrl('/infowizard/IssuerMaster/index')?>" class="nav-link ">
            <span class="title">Issuer Master</span>
            </a>
         </li>
		 
		  <li class="nav-item  ">
            <a href="<?=$this->createUrl('/infowizard/IssuerbyMaster/index')?>" class="nav-link ">
            <span class="title">Issued By Master</span>
            </a>
         </li>
		 
		  <li class="nav-item  ">
            <a href="<?=$this->createUrl('/infowizard/DocunenttypeMaster/index')?>" class="nav-link ">
            <span class="title">Document Type Master</span>
            </a>
         </li>
				
		  <li class="nav-item  ">
            <a href="<?=$this->createUrl('/infowizard/infowizardQuestionMaster/listQuestion')?>" class="nav-link ">
            <span class="title">Question Master</span>
            </a>
         </li>
		
		 <li class="nav-item  ">
            <a href="<?=$this->createUrl('/infowizard/infowizardQuesansMapping/listquestionanswer')?>" class="nav-link ">
            <span class="title">Question Answer Master</span>
            </a>
         </li>
         
	 
		 <li class="nav-item  ">
            <a href="<?=$this->createUrl('/infowizard/infowizardDocumentchklist')?>" class="nav-link ">
            <span class="title">Document Master</span>
            </a>
         </li>
		 
		  <li class="nav-item  ">
            <a href="<?=$this->createUrl('/infowizard/actMaster')?>" class="nav-link ">
            <span class="title">Act Master</span>
            </a>
                  </li>
		 
		  <li class="nav-item  ">
            <a href="<?=$this->createUrl('/infowizard/infowizardFormvariableMaster/listformfield')?>" class="nav-link ">
            <span class="title">Form Field Master</span>
            </a>
                  </li>
		 
		  <li class="nav-item  ">
            <a href="<?=$this->createUrl('/infowizard/professionalMaster')?>" class="nav-link ">
            <span class="title">Professional Master</span>
            </a>
                  </li>
		 <li class="nav-item  ">
            <a href="<?=$this->createUrl('/userCreate/ListUser')?>" class="nav-link ">
            <span class="title">Departmental Users</span>
            </a>
                  </li>
		 
		 </ul>
	</li>
   
    <li class="nav-item">
        <a href="javascript:;" class="nav-link nav-toggle">
            <i class="icon-bulb"></i>
            <span class="title">SubForm</span>
            <span class="arrow"></span> 
        </a>
        <ul class="sub-menu">

            <li class="nav-item  ">
                <a href="<?= $this->createUrl('/infowizard/infowizardFormvariableMaster/create') ?>" class="nav-link ">
                    <span class="title">Form Field Master</span>
                </a>
            </li>

            <li class="nav-item  ">
                <a href="<?= $this->createUrl('/infowizard/formCategory') ?>" class="nav-link ">
                    <span class="title">Category Master</span>
                </a>
            </li>

             <li class="nav-item  ">
                <a href="<?= $this->createUrl('/infowizard/declaration') ?>" class="nav-link ">
                    <span class="title">Declaration Master</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="<?= $this->createUrl('/infowizard/formTypes') ?>" class="nav-link ">
                    <span class="title">Form Type Master</span>
                </a>
            </li>

            <li class="nav-item  ">
                <a href="<?= $this->createUrl('/infowizard/serviceFormMapping/create') ?>" class="nav-link ">
                    <span class="title">Sub Form - Step 1</span>
                </a>
            </li>
            <li class="nav-item  ">
                <a href="<?= $this->createUrl('/infowizard/subForm/subFormListing/startPaging/1/endPaging/10') ?>" class="nav-link ">
                    <span class="title">Sub Form - Page Category Mapping & Form Genrator</span>
                </a>
            </li>
            <li class="nav-item  ">
				<a href="<?= $this->createUrl('/infowizard/serviceFormWorkflow/creation/service_id//workflowID/1/id/0') ?>" class="nav-link ">
					<span class="title">Sub Form - Workflow Configurator</span> 
				</a>
			</li>
            <li class="nav-item  ">
				<a href="<?= $this->createUrl('/infowizard/FormBuilderConfiguration/create/department_id/1') ?>" class="nav-link ">
					<span class="title">Sub Form - Workflow Configurator-2 </span> 
				</a>
			</li>
		</ul>
    </li>
	<li class="nav-item">	
		<a href="<?= $this->createUrl('/cafTemplates/admin') ?>" class="nav-link ">
			<i class="icon-bulb"></i>
            <span class="title">CAF Templates</span>
            <span class="arrow"></span> 
		</a>
	</li>
	<li class="nav-item">	
		<a href="<?= $this->createUrl('/infowizard/serviceMaster/listSubServicePage/iw/Y/id/1') ?>" class="nav-link ">
			<i class="icon-bulb"></i>
            <span class="title">Approval QA Mapping</span>
            <span class="arrow"></span> 
		</a>
	</li>

</ul>
<script>
    $(window).load(function () {
        var $items = $('.select2-me');
        if ($items.length>0)
        { //  alert($items.length);
            $(".nav-toggle").hover(function (e) {
               // alert($(this).next('ul').show());
               // $(this).closest('ul').hide();
               $(".sub-menu").hide();
                $(this).next('ul').show();
                return false;
            });
        }
    });
</script>