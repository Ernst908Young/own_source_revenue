<div class="reservation-step row">

 <?php 
	foreach ($aap as $pageKey => $ap) 
	{        $active = $pageKey==0 ?  "active" : '';
	?>
    <div class="form-group col-md-4 form-step <?= $active ?>" id="div_tab<?= $pageKey+1 ?>">
   <div class="m-wizard__step m-wizard__step--current" m-wizard-target="m_wizard_form_step_<?php echo $pageKey+1; ?>">
        <div class="step-inner m-wizard__step-info">   
            <span> <?php echo $pageKey+1; ?> </span>
            <a href="#" class="m-wizard__step-number">
           
            <?php echo $ap['page_name']; ?>
          
            </a>      
        </div>
    <!-- <div class="progress-bar bar-1">   
        <div class="progress">
            <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
    </div> -->
                   
          </div>
    </div>    
     <?php 
	} 
	?>
</div>




		                                 
	