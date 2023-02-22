<style>.homeredirect:hover{color:blue;}
.mt-element-step .step-thin .done {background-color:#36c6d3 !important;}
.dt-buttons{margin-top:-222px !important}
.custom-big-step{min-height:60px; !important}
@media (min-width:1200px){
.part-7outof12{width:16.2857143% !important;}
}
</style>	
		</br>
<?php //if (preg_match('/\bare\b/',$a))
//print_r($_SERVER['HTTP_REFERER']);

if(!isset($_GET['type'])){$_GET['type']='CAF';}
    if(!empty($_GET['financial_year'])){ $fy="financial_year/".$_GET['financial_year'];}else{$fy="";$_GET['financial_year']="ALL";}

    $typo="".$fy;
    if(!empty(@$_SESSION['RESPONSE']['user_id'])){
        $userID=@$_SESSION['RESPONSE']['user_id'];
    }else if($_SESSION['role_id']==2){
        $userID= base64_decode($_GET['uid']);
        $typo="uid/$_GET[uid]/iuid/$_GET[iuid]".$fy;
    }else{
        $userID=0;
    }
    $urlI="/backoffice/frontuser/home/serviceNew/".$typo;
    if(isset($_GET['iuid']))
        $iuid= base64_decode($_GET['iuid']);
    ?>
			
    <div class="site-min-height">
        <div class="dashboard-welcome">
            <h2 class="full-width">
                <div class="dashboard-inner-hd-left">
                    <p class="dashbrd-inner-hd">
                        <!--<a href="/backoffice/frontuser/home/investorWalkthrough" title="Go to Dashboard : Level 1" class="fa fa-home homeredirect" ></a>-->
                        <?php
                        if(!empty(@$_SESSION['RESPONSE']['user_id']) || (isset($_GET['panel']) && $_GET['panel'] = 'investor')){
                            echo "Welcome to Applicant Monitoring Panel";
                        }
                        else{
                            if(isset($iuid) && $iuid != ''){
                              //  echo " Details of IUID - ".$iuid ;
                            }
                        }?>
                    </p>
                </div>
                <div class="dashboard-inner-hd-right"><a href="/backoffice/frontuser/home/serviceNew/type/CAF" class="blue-btn-new"><i class="fa fa-angle-left"></i>Back</a></div>
                <div class="clearfix"></div>
            </h2>
            <!--<div class="welcome-date hidden-xs"><i class="icon-calendar"></i>&nbsp;<?php echo date('d-M-Y'); ?></div>-->
            <div class="clearfix"></div>
        </div>
    </div><br>
 
    <div class="mt-element-step">
        <div class="white-bg-block content-blocks" style="height: 133px !important;">
            <div class="col-xs-12 col-sm-4 col-md-3 part-7outof12">
               <a class="top-number-bts <?php if ($_GET['type'] == "BM") { ?> active <?php } ?>" href="/backoffice/frontuser/applyService/ApplyServiceListing/type/BM/id/1/is/no">
                    <span>1</span>
                    <p>Name Reservation Services</p>
                </a>
            </div>
            <div class="col-xs-12 col-sm-4 col-md-3 part-7outof12">
                <a class="top-number-bts <?php if ($_GET['type'] == "Incop") { ?> active <?php } ?>" href="/backoffice/frontuser/applyService/ApplyServiceListing/type/Incop/id/1/is/no">
                    <span>2</span>
                    <p>Incorporation Services</p>
                </a>
            </div>
            <div class="col-xs-12 col-sm-4 col-md-3 part-7outof12">
                <a class="top-number-bts <?php if ($_GET['type'] == "Cont") { ?> active <?php } ?>" href="/backoffice/frontuser/applyService/ApplyServiceListing/type/Cont/id/1/is/no">
                    <span>3</span>
                    <p>Continuance Services</p>
                </a>
            </div>
            <div class="col-xs-12 col-sm-4 col-md-3 part-7outof12">
                <a class="top-number-bts <?php if ($_GET['type'] == "Amal") { ?> active <?php } ?>" href="/backoffice/frontuser/applyService/ApplyServiceListing/type/Amal/id/1/is/no">
                    <span>4</span>
                    <p>Amalgamation Services</p>
                </a>
            </div>
			
            <div class="col-xs-12 col-sm-4 col-md-3 part-7outof12">
                <a class="top-number-bts <?php if ($_GET['type'] == "ClS") { ?> active <?php } ?>" href="/backoffice/frontuser/applyService/ApplyServiceListing/type/ClS/id/1/is/no">
                    <span>5</span>
                    <p>Clousre Services</p>
                </a>
            </div>
			<!-- <div class="col-xs-12 col-sm-4 col-md-3 part-7outof12">
                <a class="top-number-bts <?php if ($_GET['type'] == "EF") { ?> active <?php } ?>" href="/backoffice/frontuser/applyService/ApplyServiceListing/type/EF/id/1/is/no">
                    <span>6</span>
                    <p>Help Desk</p>
                </a>
            </div> -->

            <div class="col-xs-12 col-sm-4 col-md-3 part-7outof12">
                <a class="top-number-bts <?php if ($_GET['type'] == "OS") { ?> active <?php } ?>" href="/backoffice/frontuser/applyService/ApplyServiceListing/type/OS/id/1/is/no">
                    <span>6</span>
                    <p>Other Services</p>
                </a>
            </div>
           <!--  <div class="col-xs-12 col-sm-3 col-md-2 part-7outof12">
                  <a class="top-number-bts <?php if ($_GET['type'] == "OS") { ?> active <?php } ?>" href="http://169.38.99.248/backoffice/frontuser/ApplyService/ApplyServiceListing/is/no/type/OS/id/138/is/no">
                    <span>6</span>
                    <p>Other Services</p>
                </a>
            </div>
            <div class="col-xs-12 col-sm-3 col-md-2 part-7outof12">
                    <a class="top-number-bts " href="http://169.38.99.248/backoffice/frontuser/ApplyService/ApplyServiceListing/is/no/type/INC/id/1">
                    <span>7</span>
                    <p>Payment</p>
                </a>
            </div>
             <div style="margin-top:10px;" class="col-md-2 bg-grey  mt-step-col <?php // if($_GET['type']=="LAND"){  ?> done <?php //}  ?>" relurl="/backoffice/frontuser/home/investorWalkthroughLevel2/type/LAND/<?php //echo $typo;  ?>">
                <div class="mt-step-number bg-white font-grey">7</div>
                <div class="mt-step-title uppercase font-grey-cascade"><a href="/backoffice/mis/prodTestDev/CafNodalDepartmentTransactions/application/MjIwNA=="></a></div>

                <div class="mt-step-content font-grey-cascade"title="Land Applications">Land Applications</div>
            </div>-->
        </div>
    </div><br>
    <?php if(isset($_GET['type']) && $_GET['type']=='CAF'){?>
        <div class="applycaf">
            <span class="pull-left" style="">
                <a href="/backoffice/frontuser/home/cafForm" class="btn btn-success">
                    <i class=""></i>&nbsp; Apply for In-Principle Approval(CAF)
                </a>
            </span>		
        </div>
    <?php }?>
    
    <?php if(isset($_GET['type']) && $_GET['type']=='INC'){?>
        <div class="applycaf">
            <span class="pull-left" style="">
                <a target = "_blank" href="/backoffice/infowizard/serviceMaster/incentiveCalculator" class="btn btn-success">
                    <i class=""></i>&nbsp; Incentive Calculator
                </a>
            </span><br>		
        </div>
    <?php }?>

    <?php if(isset($_GET['type']) && $_GET['type']=='QUERIES'){?>
        <div class="applycaf">
            <span class="pull-left" style="">
                <a href="/query/autologin.php?luser=demo.swcs.uk@gmail.com&flag=open&type=investor">
                    <i class=""></i>&nbsp; Ask Question
                </a>
            </span>
        </div>
    <?php }?>

    <?php if(isset($_GET['type']) && $_GET['type']=='TICKETS'){?>
        <div class="applycaf">
            <span class="pull-left" style="">
                <a href="/ticket/open.php?user_id=MTE=" class="btn btn-success">
                    <i class=""></i>&nbsp; Create Ticket
                </a>
            </span>
        </div>
    <?php }?>

    <?php if(isset($_GET['type']) && $_GET['type']=='GRIEVANCE'){?>
        <div class="applycaf">
            <span class="pull-left" style="">
                <a href="/backoffice/GrievanceNew/grievanceDetail/createGrievance" class="btn btn-success">
                    <i class=""></i>&nbsp; Create Grievance
                </a>
            </span>
        </div>
    <?php }?>
<br>
<script>
// alert("==");
$(document).ready(function(){
   // alert("==");
    $(".mt-step-col").css('cursor','pointer');
    $(".mt-step-col").click(function(){
       var relurl=$(this).attr("relurl");
      // alert(relurl);
       window.location.href=relurl;
    });
});
</script>