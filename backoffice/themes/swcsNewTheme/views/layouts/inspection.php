<ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">

   		<?php if (DefaultUtility::isValidDepartmentLogin() && DefaultUtility::isRoInspection()){ ?>

        <li class="nav-item  ">

            <a href="<?=$this->createUrl('/cis/cisInspectionIndustries/sync')?>" class="nav-link ">

            <span class="title">All Inspection</span>

            </a>

         </li>

        <li class="nav-item  ">

            <a href="<?=$this->createUrl('/cis/cisInspectionIndustries/create')?>" class="nav-link ">

            <span class="title">Schedule Inspection</span>

            </a>

         </li>

		  <li class="nav-item  ">

            <a href="<?=$this->createUrl('/cis/cisOfficeMaster/create')?>" class="nav-link ">

            <span class="title">Office Master</span>

            </a>

         </li>

		  <li class="nav-item  ">

            <a href="<?=$this->createUrl('/cis/cisJurisditionMaster/create')?>" class="nav-link ">

            <span class="title">Jurisdiction Master</span>

            </a>

         </li>

		  <li class="nav-item  ">

            <a href="<?=$this->createUrl('/cis/cisExistinginspectionMaster/create')?>" class="nav-link ">

            <span class="title">Inspector Master</span>

            </a>

         </li>

	

                <?php } ?>

         <?php if (DefaultUtility::isValidDepartmentLogin() && DefaultUtility::isInspectionInvestor()){ ?>

		  <li class="nav-item  ">

            <a href="<?=$this->createUrl('/cis/cisInspectionIndustries/schedule')?>" class="nav-link ">

            <span class="title">Scheduled Inspection</span>

            </a>

         </li>

         <?php } ?>

                      

</ul>