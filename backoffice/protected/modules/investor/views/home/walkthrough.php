<title>Dashboard</title>
<?php
/* @var $this HomeController */
//$this->breadcrumbs = array('Home',);
$baseUrl = Yii::app()->theme->baseUrl;
$basePath="/themes/investuk";
$userID = $_SESSION['RESPONSE']['user_id'];
//echo $userID;
//print_r($_SESSION);
 //echo Yii::app()->params['CR_IN'];
/* $cdmaxid = BoCompanyDetails::getreg_no('S'); 
 echo $cdmaxid;*/

 /*for ($i=3; $i <= 50 ; $i++) { 
   Yii::app()->db->createCommand("INSERT INTO bo_infowiz_formfield_options (formfield_id, options,user_agent, prefrence) VALUES(2400, $i, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/94.0.4606.81 Safari/537.36',$i)")->execute();
 }*/


?>
<?php if(Yii::app()->user->hasFlash('success')): ?>

<div style="text-align:center;font-size:16px;color:green;">
    <?php echo Yii::app()->user->getFlash('success'); ?>
</div>

<?php endif; ?> 
<div class="dashboard-home">
   
    <div class="home-top position-relative">
        
            <?php 

//echo $basePath;
$sc_id = isset($_GET['sc_id']) ? $_GET['sc_id'] : NULL;
 $sta = isset($_GET['sta']) ? $_GET['sta'] : NULL;                     
        ?>
       <div class="user-select d-flex justify-content-start my-3">
                <div class="select-wrap">
                      <?php 
                      $sc_arr = Yii::app()->db->createCommand("SELECT * FROM bo_information_wizard_services_category where is_active=1")->queryAll(); 
                     /* $sc_arr = [1=>'Industrial Tribunal',2=>'Income-Tax Appellate Tribunal',3=>'Customs, Excise and Service Tax Appellate Tribunal',4=>'Appellate Tribunal',5=>'Central Administrative Tribunal',6=>'Securities Appellate Tribunal',7=>'Railway Claims Tribunal',8=>'Debts Recovery Appellate Tribunal',9=>'Telecom Disputes Settlement and Appellate Tribunal',10=>'National Company Law Appellate Tribunal',11=>'National Consumer Disputes Redressal Commission',12=>'Appellate Tribunal for Electricity',13=>'Armed Forces Tribunal',14=>'National Green Tribunal'];*/
                      ?>
                    <select onchange="categchang($(this).val())">
                        <option value="">All Category</option>                        
                         <?php 

                         $k=1; 
                         foreach($sc_arr as $key=>$val){ 

                          $sc_select= $sc_id==$k ? 'selected' : '' ;
                            ?>
                             
						<option value="<?= $key ?>" <?= $sc_select ?> ><?= $val['category_name'] ?></option>
						                               
                         <?php $k++; } ?>
                    </select>
                </div>
				
				<!-- <div class="select-wrap-filing">
                      <?php $sc_arr = Yii::app()->db->createCommand("SELECT * FROM bo_information_wizard_services_category where is_active=1")->queryAll(); ?>
                    <select onchange="categchang($(this).val())">
                        <option value="">All e-Filing</option>
<option value="">Comany Act 2013</option>
							<option value="">IBC Code 2016</option>
							<option value="">Caveat Filing</option>
							<option value="">Documents Filing</option>
							<option value="">Resend Security Code</option>
							<option value="">Re-Filing</option>                            
                         <?php 

                         $k=1; foreach($sc_arr as $val){ 

                          $sc_select= $sc_id==$k ? 'selected' : '' ;
                            ?>
                             
						                               
                         <?php $k++; } ?>
                    </select>
                </div> -->
                <div class="select-wrap status">
                    <select id="status_s" onchange="statusegchang($(this).val())">
                        <option value="">All Status</option>                        
                         <?php 
                            $sta_arr = ['Draft'=>'Draft','Payment Due'=>'Payment Due','Approved'=>'Approved'];    
                            foreach($sta_arr as $val){ ?>
                                <option value="<?php echo $val; ?>"><?php echo $val; ?></option>              
                         <?php $k++; } ?>
                    </select>
                </div>
           </div>
           
           
               
<div class="home-row d-flex flex-wrap">
  
    <div class="counter-item bord-3">
          <a href="#" onclick="statusegchang('Draft')">
            <div class="data-counter">
                <div class="counter-left">
                        <span>DRAFT </span>
                        <span class="counter-number font-montserrat">
                         <?php echo $this->GetServiceWiseCount($sc_id,'Draft',$userID); ?></span>
                    <div class="counter-icon">
                        <img src="<?php echo $basePath; ?>/assets/applicant/images/icons/draft_hover.png">
                    </div>
                </div>
            </div>
          </a>
    </div>
  
    <div class="counter-item bord-3">
         <a href="#" onclick="statusegchang('Payment Due')">
        <div class="data-counter">
            <div class="counter-left">
                <span>PAYMENT DUE</span>
                <span class="counter-number font-montserrat">
                    <?php echo $this->GetServiceWiseCount($sc_id,'Payment Due',$userID); ?>
                </span>
                <div class="counter-icon">
                   <!--  <img src="<1?php echo $basePath; ?>/assets/applicant/images/icons/payment due_hover.png"> -->
                    <img src="<?php echo $basePath; ?>/assets/applicant/images/payment-due.png">
                </div>
            </div>
        </div>
         </a>
    </div>
       
    <div class="counter-item bord-3">
         <a href="#" onclick="statusegchang('Approved')">
        <div class="data-counter">
            <div class="counter-left">
                <span>Approved</span>
                <span class="counter-number font-montserrat">
                   <?php 
                        echo $this->GetServiceWiseCount($sc_id,'Approved',$userID)   
                   ?>
                </span>
                <div class="counter-icon">
                     <img src="<?php echo $basePath; ?>/assets/applicant/images/icons/approved_hover.png">

                </div>
            </div>
        </div>
         </a>
    </div>  
      
    
                       
</div>
    </div>
    <div class="applied-status">
        <div class="status-title d-flex flex-wrap align-items-center justify-content-between">
            <h4>Recent applied service status</h4>
           <!--  <div class="serach-bar">
                <form>
                    <div class="search-field position-relative">
                        <input type="text" name="" placeholder="Search" id="servsearch" onkeyup="servsearchf()">
                    <button class="search-btn">
                        <i class="fa fa-search" aria-hidden="true"></i>
                    </button>
                    </div>
                </form>
            </div> -->
        </div>
        
        <?php $this->renderPartial('/services/all_appsub',['sc_id'=>$sc_id,'userID'=>$userID,'basePath'=>$basePath,'baseUrl'=>$baseUrl]) ?>
          
    </div>
</div>



<script type="text/javascript">
    function categchang(sc_id){
           var url = "<?php echo Yii::app()->createUrl('/investor/home/investorWalkthrough') ?>";
		  
           var param = '/sc_id/'+sc_id;
		  // alert(url+param);
			window.location.href = url+param; 
    }

    function statusegchang(status){
        //alert(status);
        e = $.Event('keyup');
        e.keyCode= 13; // enter

        $("#sample_1_filter").find('input').val(status).trigger(e);
        $("#status_s").val(status);
    }


 /*  function servsearchf(){
    var input, filter, maindiv,innerdiv,childdiv, found, i, j, txtValue;
      input = document.getElementById("servsearch");
      filter = input.value.toUpperCase();
      maindiv = document.getElementById("service_records");
      innerdiv = maindiv.getElementsByClassName("item-row");
      for (i = 0; i < innerdiv.length; i++) {

        childdiv = innerdiv[i].getElementsByTagName("div");
        for (j = 0; j < childdiv.length; j++) {
            if (childdiv[j].innerHTML.toUpperCase().indexOf(filter) > -1) {
                found = true;
            }
        }
        if (found) {
            innerdiv[i].style.display = "";
            found = false;
        } else {
            innerdiv[i].style.display = "none";
        }
  
      }
   }*/

  
</script>
                 




