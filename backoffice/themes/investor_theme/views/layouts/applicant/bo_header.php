
<?php 
$notificationcount = 0;

if(isset($_SESSION['uid'])){
    if($_SESSION['uid']!=''){
        $uid = $_SESSION['uid'];
        $notification = Yii::app()->db->createCommand("SELECT * From alert_notification where user_type='BO' AND created_by=$uid AND is_seen=0 order by id desc")->queryAll();
        $notificationcount = sizeof($notification);
       
    }

} ?>
<div class="contemt-header">
    <div class="row align-items-center">
        <div class="col-md-8 col-sm-9 col-12">
            <div class="user-name">
                <span title = "Click to see the menu" class="toggle-icon"><i class="fa fa-bars" aria-hidden="true"></i></span>
                <a href="javascript:void(0);">
                    <!-- <span class="user-name">Goverment of Punjab</span> -->
                </a>
        </div>
        </div>
        <div class="col-md-4 col-sm-3 col-12">
            <div class="d-flex justify-content-end">
                  <div class="notific header-notification text-end mx-3">									
                 <a href="javascript:void(0);" class="notitfication"><img src="<?php echo $basePath; ?>/assets/applicant/images/bell.png"><span class="counter"><?= $notificationcount ?></span></a>
                <div class="position-relative">
                <div class="dropboxnotification">
                    <div class="card">
                        <div class="card-header text-center">
                            <h4>Notifications</h4>
                        </div>
                        <div class="card-body p-0">
                            <ul class="notiful">
                                <?php if(isset($notification)){
                                    if(is_array($notification)){ ?>
                                        <li class="notiflist">
                                                <div class="d-flex justify-content-start">
                                                    <span class="sp">
                                                        <i class="fa fa-check"></i>
                                                    </span>
                                                    <p>
                                                        <a href="<?= Yii::app()->createAbsoluteUrl('/profile/notification/allseen')?>" title="Click to clear all as you read">
                                                           Clear all the notifications
                                                        </a>
                                                    </p>
                                                </div>
                                                
                                            </li>
                                       <?php foreach ($notification as $key => $value) { ?>
                                           <li class="notiflist">
                                                <div class="d-flex justify-content-start">
                                                    <span class="sp"><?= $value['module_code']?></span>
                                                    <p>
                                                        <a href="<?= Yii::app()->createAbsoluteUrl('/profile/notification/dashboard',array('an_id'=>base64_encode($value['id']),'nc'=>base64_encode(true)))?>" title="<?= $value['notify_text'] ?>">
                                                         <b><?= $value['module_name']?> : </b>   
                                                        <?= mb_strimwidth($value['notify_text'],0,50,'...') ?></a>
                                                    </p>
                                                </div>
                                                <div class="d-flex justify-content-end">
                                                    <span><?= date('d-m-Y h:i a',strtotime($value['created_on'])) ?></span>
                                                </div>
                                            </li>
                                       <?php }
                                    }
                                } ?>
                            </ul>
                        </div>
                    </div>
                </div>
                </div>
            </div>
            <div class="user-name user-name1 position-relative">
                <a href="javascript:void(0);">
                    <span class="user-img"><img src="<?php echo $basePath; ?>/assets/applicant/images/user-icon.png"></span>
                    <span class="user-names">
                        <?php                     
                           if(isset($_SESSION['uname']))
                                  echo "<span class='username'>".$_SESSION['uname']."</span>";
                        ?>
                    </span>
                </a>
                <div class="dropbox">
                    <div class="usernamebox">
							<img src="<?php echo $basePath; ?>/assets/applicant/images/awesome-user-circle.png">
                            <p class="user-name-color">
                                <?php               
								if(isset($_SESSION['uname']))
                                  echo "<span class='username'>".$_SESSION['uname']."</span>";                               
                               ?>
                            </p>
                            <span style="font-size: 10px;"><?php echo @$_SESSION['email'];?></span>
                    </div>
                    <ul class="mt-3 header-menu">
                        <li>
                            <a href="<?= Yii::app()->createAbsoluteUrl('/profile/default/myaccountbo')?>">
                             <i class="icon-user"></i>My Account
                            </a>
                        </li>
                        <!-- <li>
                             <a href="<1?= Yii::app()->createAbsoluteUrl('/profile/default/myAccount')?>">
                                 <i class="icon-note"></i> Edit Profile 
                             </a>
                        </li> -->
                        
                        <li><a href="/panchayatiraj/backoffice/site/logout">
                                                   Log Out </a>
                           </li>
                    </ul>
                </div>
            </div>
            
        </div>
        </div>
    </div>
</div>

<script>  
  $(document).ready(function(){  
      $(".notific").click(function(){  
          $(".dropboxnotification").toggleClass("dropshow");
      });  
  });  
</script>