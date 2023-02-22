<title>Dashboard</title>
<?php
//print_r($_SESSION);
/* @var $this HomeController */
$this->breadcrumbs = array('Home',);
$baseUrl = Yii::app()->theme->baseUrl;
$basePath="/themes/investuk";
$email = $_SESSION['RESPONSE']['agent_email'];
$userID = $_SESSION['RESPONSE']['agent_user_id'];

				
$user = Yii::app()->db->createCommand("SELECT a.id ,a.email,c.reg_no,c.company_name, a.user_id, up.*
FROM agent_service_provider a
INNER JOIN sso_users u ON u.user_id= a.user_id
INNER JOIN sso_profiles up ON up.user_id= u.user_id
INNER JOIN bo_company_details c ON c.id = a.company_id
where u.is_account_active='Y' AND  a.is_active=1 AND u.user_type=1 AND a.is_revoke=0 AND a.sp_status IN ('N','O') AND (a.email = '".$email."' OR agent_user_id=$userID)")->queryAll();

/*$user = Yii::app()->db->createCommand("SELECT a.id ,a.email,c.reg_no,c.company_name, a.user_id, up.*
FROM agent_service_provider a
INNER JOIN sso_users u ON u.user_id= a.user_id
 INNER JOIN sso_profiles up ON up.user_id= u.user_id
  LEFT JOIN bo_company_details c ON c.id = a.company_id
where  a.email='".$email."' OR agent_user_id=$userID AND  a.is_active=1 AND u.user_type=1 AND a.is_revoke=0")->queryAll();*/
				
	//print_r($user);


 
?>

<?php if(Yii::app()->user->hasFlash('success')): ?>

<div style="text-align:center;font-size:16px;color:green;">
    <?php echo Yii::app()->user->getFlash('success'); ?>
</div>

<?php endif; ?> 

<?php if(@$_SESSION['individualuser_id']){
    $ind_user_id = $_SESSION['individualuser_id'];
}else{
    $ind_user_id = NULL;
} ?>

<?php if(@$_SESSION['asp_id']){
    $asp_id = $_SESSION['asp_id'];
}else{
    $asp_id = NULL;
} ?>


<div class="dashboard-home">   
    <div class="home-top position-relative"> 
          
        <?php 
            $sc_id = isset($_GET['sc_id']) ? $_GET['sc_id'] : NULL;
            $sta = isset($_GET['sta']) ? $_GET['sta'] : NULL;                     
        ?>
       <div class="form-row row">
           
              
                <div class="col-lg-3 select-wrap status">
                      <?php $sc_arr = Yii::app()->db->createCommand("SELECT * FROM bo_information_wizard_services_category where is_active=1")->queryAll(); ?>
                    <select onchange="categchang($(this).val())" class="form-control" style="color: black;">
                        <option value="">All Services</option>                        
                         <?php 

                         $k=1; foreach($sc_arr as $val){ 

                          $sc_select= $sc_id==$k ? 'selected' : '' ;
                            ?>
                              <option value="<?php echo $k; ?>" <?php echo $sc_select ?>><?php echo $val['category_name']; ?></option>                                    
                         <?php $k++; } ?>
                    </select>
                </div>
                <div class="col-lg-3 select-wrap status">
                    <select id="status_s" onchange="statusegchang($(this).val())" class="form-control"- style="color: black;">
                        <option value="">All Status</option>                        
                         <?php 
                              $sta_arr = ['Draft'=>'Draft','Payment Due'=>'Payment Due','Approved'=>'Approved'];   
                          foreach($sta_arr as $val){   ?>
                              <option value="<?php echo $val; ?>"><?php echo $val; ?></option>                                    
                         <?php $k++; } ?>
                    </select>
                </div>
                
           </div>
           
           <br>
               
<div class="home-row d-flex flex-wrap">
          <div class="counter-item bord-3">
             <a href="#" onclick="statusegchang('Draft')">
        <div class="data-counter">
            <div class="counter-left">
                    <span>DRAFT</span>
                    <span class="counter-number font-montserrat">
                     <?php 
                     if($ind_user_id){
                        echo $this->GetServiceWiseCount($sc_id,'Draft',$ind_user_id);
                     }else{
                        echo '0';
                     }
                      ?></span>
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
                    <?php  if($ind_user_id){
                        echo $this->GetServiceWiseCount($sc_id,'Payment Due',$ind_user_id);
                        }else{
                        echo '0';
                     }
                     ?>
                </span>
            <div class="counter-icon">
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
                <span>APPROVED</span>
                <span class="counter-number font-montserrat">
                   <?php  if($ind_user_id){
                        echo $this->GetServiceWiseCount($sc_id,'Approved',$ind_user_id); 
                        }else{
                        echo '0';
                     }  
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
        
        <?php $this->renderPartial('/services/all_appsub',['sc_id'=>$sc_id,'userID'=>$userID,'basePath'=>$basePath,'baseUrl'=>$baseUrl,'ind_user_id'=> $ind_user_id]) ?>
          
    </div>
</div>

<div class="modal" id="myModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
      
        <!-- Modal Header -->
       
        
        <!-- Modal body -->
        <div class="modal-body">
           
                <small class="mb-3">Please ask for the one time activation key from the user who has nominated you as a <?=  $_SESSION['RESPONSE']['sp_type'] ?>.</small><br><br>
                <input type="text" id="activationcode" name="activationcode" placeholder="Enter the activation key provided by the User" class="form-control">
                <span id="activationcode_error" style="color: red;"></span>
                <input type="hidden" id="asp_id" />
                <br>
                <div class="modal-footer">
                     <span class="btn-primary" id="acbtn" onclick="matchkey()">Submit</span>
           
                    <a href='/backoffice/investor/home/investorWalkthrough' class='btn-primary'>Close</a>
      </div>
                 <!-- <div class="text-center">
              
            </div> -->
        </div>
    
        <!-- Modal footer -->
       
        
      </div>
    </div>
  </div>


<script type="text/javascript">
    function categchang(sc_id){
           var url = "<?php echo Yii::app()->createUrl('/investor/home/investorWalkthrough') ?>";
           var param = '/sc_id/'+sc_id;
       window.location.href = url+param; 
    }

    function statusegchang(status){
        //alert(status);
        e = $.Event('keyup');
        e.keyCode= 13; // enter

        $("#sample_1_filter").find('input').val(status).trigger(e);
         $("#status_s").val(status);
    }

    /*function userlist(userid){
        if(userid){
                $.ajax({
                type: "POST",
                url: "/backoffice/investor/home/getassignusercompanies/individualuser_id/" + userid,
                success: function(result) {                   
                    $("#company_list").html(result);
                    $('#myModal').modal('show');                     
                }
            });
        }else{
            $("#company_list").html('<option value="">Select Company</option>');
        }         
    }*/

    function goforactivationkey(id){
        if(id){
                $.ajax({
                type: "POST",
                dataType: 'json',
                url: "/backoffice/investor/serviceprovider/checkactivationcode/asp_id/" + id,  
               /* beforeSend: function(){
                    $("#activationcode_error").text('Please Wait...');
                },*/
                success: function(result) {    
                if(result.status==true){
                    $("#asp_id").val(result.asp_id);
                    $('#myModal').modal('show');   
                }else{
                     window.location.href = "/backoffice/investor/home/investorWalkthrough";     
                }               
                                    
                }             
            });
        }else{
            
        }   
    }

    function matchkey(){
        var key = $("#activationcode").val();
        var asp_id = $("#asp_id").val();
        if(key){
            $.ajax({
                type: "POST",
                  dataType: 'json',
                url: "/backoffice/investor/serviceprovider/matchActionvationkey/key/" + key + "/asp_id/"+asp_id, 
                beforeSend: function(){
                   // $("#acbtn").addClass('hidden');  
                    $("#activationcode_error").text("Please wait for notification...");
                },
                success: function(result) {  
                   // $("#acbtn").removeClass("hidden");  
                if(result.status==false){
                      $("#activationcode_error").text("Sorry this key not match. Or key is expired");
                }else{
                     window.location.href = "/backoffice/investor/home/investorWalkthrough";     
                }               
                                    
                }             
            });
        }else{

        }
    }

    function companyselect(c_id){
        if(c_id){
            alert("Company is selected "+c_id);
        }else{
            alert("Company is unselect");
        }
        
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
                 




