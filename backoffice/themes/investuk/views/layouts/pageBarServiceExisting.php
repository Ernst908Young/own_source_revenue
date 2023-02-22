<style>.homeredirect:hover{color:blue;}
.mt-element-step .step-thin .done {background-color:#36c6d3 !important;}
.dt-buttons{margin-top:-222px !important}
.custom-big-step{min-height:76px; !important}

</style>	
		</br>
<?php //if (preg_match('/\bare\b/',$a))
//print_r($_SERVER['HTTP_REFERER']);

if(!isset($_GET['type'])){$_GET['type']='EU';}
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
								if(!empty(@$_SESSION['RESPONSE']['user_id']) || (isset($_GET['panel']) && $_GET['panel'] = 'investor')) 
									echo "Welcome to Applicant Monitoring Panel ";
								else{
									if(isset($iuid) && $iuid != '')
										echo " Details of IUID - ".$iuid ;
								}
								?> 
							</p>
						</div>
						<div class="dashboard-inner-hd-right"><a href="/backoffice/frontuser/home/serviceExisting/type/EU/" class="blue-btn-new"><i class="fa fa-angle-left"></i>Back</a></div>
						<div class="clearfix"></div>
					</h2>
                    <!--<div class="welcome-date hidden-xs"><i class="icon-calendar"></i>&nbsp;<?php echo date('d-M-Y'); ?></div>-->
					<div class="clearfix"></div>
					</div>
				</div><br>
		 <br>
		<div class="mt-element-step">
                                            
        <div class="white-bg-block content-blocks" style="height: 133px !important;">
			<div class="col-xs-12 col-sm-3 col-md-2">
                <a class="top-number-bts <?php $eu="";if ($_GET['type'] == "EU") { ?> active <?php } ?>" href="/backoffice/frontuser/home/investorWalkthroughLevel2/type/EU/financial_year/ALL/is/SE">
                    <span>1</span>
                    <p>Register for Existing Establishment</p>
                </a>
            </div>
			<div class="col-xs-12 col-sm-3 col-md-2">
                <a class="top-number-bts <?php if ($_GET['type'] == "Incentive") { ?> active <?php } ?>" href="/backoffice/dms/DocumentManagement/myDocuments/docStatus/U/is/SE/type/Incentive">
                    <span>2</span>
                    <p>Declare Existing Incentive Registration</p>
                </a>
            </div>
           <div class="col-xs-12 col-sm-3 col-md-2">
                <a class="top-number-bts <?php if ($_GET['type'] == "PES") { ?> active <?php } ?>" href="/backoffice/frontuser/applyService/ApplyServiceListing/type/PES/is/SE">
                    <span>3</span>
                    <p>Apply for Pre-Establishment Services</p>
                </a>
            </div>
			<div class="col-xs-12 col-sm-3 col-md-2">
                <a class="top-number-bts <?php if ($_GET['type'] == "POS") { $eu="Yes"; ?> active <?php } ?>" href="/backoffice/frontuser/applyService/ApplyServiceListing/type/POS/is/SE">
                    <span>4</span>
                    <p>Apply for Pre-Operation Services</p>
                </a>
            </div>
			<div class="col-xs-12 col-sm-3 col-md-2">
                <a class="top-number-bts <?php if ($_GET['type'] == "PO") { $eu="Yes"; ?> active <?php } ?>" href="/backoffice/frontuser/applyService/ApplyServiceListing/type/PO/is/SE">
                    <span>5</span>
                    <p>Other Department Services</p>
                </a>
            </div>
			<div class="col-xs-12 col-sm-3 col-md-2">
                <a class="top-number-bts <?php if ($_GET['type'] == "CI") { ?> active <?php } ?>" href="/backoffice/frontuser/application_form/applicationListClaim/service/Incentive/serviceProvider/9/type/CI/is/SE">
                    <span>6</span>
                    <p>Claim Incentives</p>
                </a>
            </div>            
        </div>
        </div>
		<br>
                <?php if ($_GET['type'] == "EU") { ?>
                <div class="applycaf">
                    <span class="pull-left" style="">
                        <a href="/backoffice/frontuser/ApplyService/ApplyServiceListing/is/SE/type/POS/id/1" class="btn btn-success">Apply For Registration of Existing Enterprise</a></span>
                </div>
                <br>
                <?php } ?>

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