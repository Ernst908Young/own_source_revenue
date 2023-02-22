<title>Dashboard</title>
<?php $basePath="/themes/investuk"; ?>
<div class="dashboard-home">
    <div class="home-top position-relative">
      <div class="home-row d-flex flex-wrap">
    <div class="counter-item bord-3">
        <?php $ticketlink = Yii::app()->urlManager->createUrl('/ticketing/default/supportindex'); ?>
                <a href="<?php echo $ticketlink ;?>">
        <div class="data-counter">
            <div class="counter-left">
                    <span>Total Ticket</span>
                    <span class="counter-number font-montserrat">
                        <?php $tc = Yii::app()->db->createCommand("SELECT COUNT(supportmaincode) as tc FROM supportmain")->queryRow();
                            echo $tc['tc'];
                        ?></span>
                <div class="counter-icon">
                    <img src="<?php echo $basePath; ?>/assets/applicant/images/ticket-white.png">
                </div>
            </div>
        </div>
      </a>
    </div>
    <div class="counter-item bord-3">
           <?php $querylink = Yii::app()->urlManager->createUrl('/queries/default/supportindex'); ?>
                <a href="<?php echo $querylink ;?>">
        <div class="data-counter">
            <div class="counter-left">
                    <span>Total Queries</span>
                    <span class="counter-number font-montserrat">
                        <?php $qc = Yii::app()->db->createCommand("SELECT COUNT(id) as qc FROM querymain")->queryRow();
                            echo $qc['qc'];
                         ?>
                </span>
                <div class="counter-icon">
                    <img src="<?php echo $basePath; ?>/assets/applicant/images/ticket-white.png">
                </div>
            </div>
        </div>
     </a>
    </div>
    <div class="counter-item bord-3">
        <?php $ticketlink = Yii::app()->urlManager->createUrl('/grievance/default/supportindex'); ?>
                <a href="<?php echo $ticketlink ;?>">
        <div class="data-counter">
            <div class="counter-left">
                    <span>Total Grievances</span>
                    <span class="counter-number font-montserrat">
                        <?php $tc = Yii::app()->db->createCommand("SELECT COUNT(code) as tc FROM grievance")->queryRow();
                            echo $tc['tc'];
                        ?></span>
                <div class="counter-icon">
                    <img src="<?php echo $basePath; ?>/assets/applicant/images/grievance-white.png">
                </div>
            </div>
        </div>
      </a>
    </div>
           
           
          
            
        </div>
      </div>
    </div>

