<div class="invest-dashboard-top-charts content-blocks" style="padding: 22px 15px 0px 74px;">    
    <div>
        <div class="row">
            <div class="col-sm-6">
                <?php $ticketlink = Yii::app()->urlManager->createUrl('/ticketing/default/supportindex'); ?>
                <a href="<?php echo $ticketlink ;?>">
                <div style="text-align: center; background-color: #0000ff14; color: blue; padding: 22px 0px 15px 0px;">
                   <strong style="font-size: 16px;">Total Ticket Count</strong><br>
                   <span style="font-size: 25px;">
<?php $tc = Yii::app()->db->createCommand("SELECT COUNT(supportmaincode) as tc FROM supportmain")->queryRow();
echo $tc['tc'];
 ?>
                   </span>
                   <br><br>
                   <small>Manage Ticket Click Here</small>
                </div> 
                </a>               
            </div>
            <div class="col-sm-6">
                <?php $querylink = Yii::app()->urlManager->createUrl('/queries/default/supportindex'); ?>
                <a href="<?php echo $querylink ;?>">
                <div style="text-align: center; background-color: #80008017; color: purple; padding: 22px 0px 15px 0px">
                    <strong style="font-size: 16px;">Total Queries Count</strong><br>
                   <span style="font-size: 25px;">
                       <?php $qc = Yii::app()->db->createCommand("SELECT COUNT(id) as qc FROM querymain")->queryRow();
                            echo $qc['qc'];
                         ?>
                   </span>
                   <br><br>
                   <small>Manage Queries Click Here</small>
                </div>   
                  </a>               
            </div>
        </div>
            
    </div>
        <div class="clearfix"></div>
    </div>
</div>