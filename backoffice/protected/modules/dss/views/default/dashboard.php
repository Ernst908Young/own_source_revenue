<?php 
 
 $basePath="/themes/investuk";



?>


<div class="dashboard-home">
	 <div class="home-top position-relative">
	 	<span style="color:white; font-size: 20px;">Decision Support System - Dashboard</span>
		<div class="home-row d-flex flex-wrap">

			
		    <div class="counter-item bord-3">
		          <a href="/backoffice/dss/default/index/otd/dss?category=entities">
		            <div class="data-counter">
		                <div class="counter-left">
                        <span>Total Entities Registered </span>
                        <span class="counter-number font-montserrat">
                            <?= $reg_entity_count ?>
                        </span>                         
		                    <div class="counter-icon">
		                        <img src="<?php echo $basePath; ?>/assets/applicant/images/dss_icons/total-entities-white.png">
		                    </div>
		                </div>
		            </div>
		          </a>
		    </div>

	<div class="counter-item bord-3">
         <a href="/backoffice/dss/default/index/otd/dss?category=filings">
            <div class="data-counter">
                <div class="counter-left">
                        <span>Total Filings </span>
                        <span class="counter-number font-montserrat">
                            <?= $filings_count ?>
                        </span>
                         
                    <div class="counter-icon">
                        <img src="<?php echo $basePath; ?>/assets/applicant/images/dss_icons/filings-white.png">
                    </div>
                </div>
            </div>
          </a>
    </div>
  
   
      
    <div class="counter-item bord-3">
        <a href="/backoffice/dss/default/index/otd/dss?category=helpdesk">
        <div class="data-counter">
            <div class="counter-left">
                <span>Total Helpdesk Count</span>
                <span class="counter-number font-montserrat">
                 <?= $helpdesk_count ?>
                </span>
                <div class="counter-icon">
                     <img src="<?php echo $basePath; ?>/assets/applicant/images/dss_icons/helpdesk-white.png">

                </div>
            </div>
        </div>
         </a>
    </div>  

     <div class="counter-item bord-3">
         <a href="/backoffice/dss/default/index/otd/dss?category=revenue">
        <div class="data-counter">
            <div class="counter-left">
                <span>Total Revenue</span>
                <span class="counter-number font-montserrat">
                   <?= $total_revenue ?>
                </span>
                <div class="counter-icon">
                    <img src="<?php echo $basePath; ?>/assets/applicant/images/dss_icons/revenue-white.png">
                </div>
            </div>
        </div>
         </a>
    </div>

    <div class="counter-item bord-3">
         <a href="/backoffice/dss/default/index/otd/dss?category=service provider">
        <div class="data-counter">
            <div class="counter-left">
                <span>Service Provider</span>
                <span class="counter-number font-montserrat">
                   <?= $sp_user_count ?>
                </span>
                <div class="counter-icon">
                    <img src="<?php echo $basePath; ?>/assets/applicant/images/dss_icons/service--provider-white.png">
                </div>
            </div>
        </div>
         </a>
    </div>

    <div class="counter-item bord-3">
         <a href="/backoffice/dss/default/index/otd/dss?category=BO user analysis">
        <div class="data-counter">
            <div class="counter-left">
                <span>Bo User Analysis</span>
                <span class="counter-number font-montserrat">
                   <?= $bouser_analysis ?>
                </span>
                <div class="counter-icon">
                    <img src="<?php echo $basePath; ?>/assets/applicant/images/dss_icons/user-analysis-white.png">
                </div>
            </div>
        </div>
         </a>
    </div>
                    
</div>
    </div>

   	
	</div>
</div>

