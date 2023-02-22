<title>User Management</title>
<style>
.form-part .form-group > div.services {
    max-width: 100%;
    margin-bottom: 44px;
}
#div_error{text-align:center;}
ul.dashboard-menu > li a {
    padding: 0 15px 0 60px;
}
.flash-Error{color:red;}
</style>
<?php 
$baseUrl = Yii::app()->theme->baseUrl;
$basePath="/themes/investuk";
/*$userID = $_SESSION['uid'];
$pd_records = Yii::app()->db->createCommand("SELECT * from tbl_payment where payment_mode=3 AND payment_status='pending'")->queryAll(); */
$sql = "select count(*) as total_user from bo_user where system_user<>'Y'";
		$res = Yii::app()->db->createCommand($sql)->queryRow();
$sql = "select count(*) as total_user from bo_user where system_user<>'Y' and is_active='1'";
		$active = Yii::app()->db->createCommand($sql)->queryRow();	
$sql = "select count(*) as total_role from bo_roles where system_role<>'Y' and is_role_active='Y'";
		$active_role = Yii::app()->db->createCommand($sql)->queryRow();				
?>
<div class="dashboard-conetnt">                        
    <div class="dashboard-home">
        <div class="home-top position-relative">                  
            <div class="home-row d-flex flex-wrap">
                <div class="counter-item bord-1">
                    <div class="data-counter">
                        <div class="counter-left">
                            
                                <span>Roles</span>
                                <span class="counter-number"><?php echo $active_role['total_role'];?></span>
                            <div class="counter-icon">
                            <img src="/themes/investuk/assets/applicant/images/counter-1.png">
                        </div>
                        </div>
                        
                    </div>
                </div>
                <div class="counter-item bord-2">
                    <div class="data-counter">
                        <div class="counter-left">
                         
                            <span>All Users</span>
                            <span class="counter-number font-montserrat"><?php echo $res['total_user'];?></span>
							<div class="counter-icon">
								<img src="/themes/investuk/assets/applicant/images/counter-2.png">
							</div>
                        </div>
                       
                    </div>
                </div>
				   <div class="counter-item bord-2">
                    <div class="data-counter">
                        <div class="counter-left">
                           
                            <span>Active Users</span>
                            <span class="counter-number font-montserrat"><?php echo $active['total_user'];?></span>
							<div class="counter-icon">
								<img src="/themes/investuk/assets/applicant/images/counter-2.png">
							</div>
                        </div>
                       
                    </div>
                </div>
               <!-- <div class="counter-item bord-3">
                    <div class="data-counter">
                        <div class="counter-left">
                            <span>PENDING FOR RESUBMISSION</span>
                            <span class="counter-number">0</span>
                        </div>
                        <div class="counter-icon">
                            <img src="images/counter-3.png">
                        </div>
                    </div>
                </div>
                <div class="counter-item bord-4">
                    <div class="data-counter">
                        <div class="counter-left">
                            <span>APPLICATION UNDER REVIEW</span>
                            <span class="counter-number">0</span>
                        </div>
                        <div class="counter-icon">
                            <img src="images/counter-4.png">
                        </div>
                    </div>
                </div>
                <div class="counter-item bord-5">
                    <div class="data-counter">
                        <div class="counter-left">
                            <span>APPROVED</span>
                            <span class="counter-number font-montserrat">10</span>
                        </div>
                        <div class="counter-icon">
                            <img src="images/counter-5.png">
                        </div>
                    </div>
                </div>-->
            </div>
        </div>
  

    </div>
</div>
              

