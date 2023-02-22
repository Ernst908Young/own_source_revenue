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
			
			
			            <div class="page-bar">
			                <div class="col-md-8">
                    <ul class="page-breadcrumb">
                        <li>
                            <span class="pull-left"><a href="/backoffice/frontuser/home/serviceExisting" title="Go to Departmental Services : Existing" class="fa fa-home homeredirect" ></a><b> <?php if(!empty(@$_SESSION['RESPONSE']['user_id']) || (isset($_GET['panel']) && $_GET['panel'] = 'investor')) 
																	echo "Welcome to Investor Monitoring Panel - Uttarakhand";
																else{
																	if(isset($iuid) && $iuid != '')
																	echo " Details of IUID - ".$iuid ;
																}?> 
                                </b></span> 
                        </li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <span class="pull-right" style="margin-top:5px;"><a href="/backoffice/frontuser/home/serviceExisting/type/EU/" class="btn btn-success"><i class="fa fa-arrow-left"></i>&nbsp; Back</a></span>
                    </div>
				
		</div>	
		

		 <br>
		<div class="mt-element-step">
                                            
        <div class="row step-thin">

            <div class="col-md-2 bg-grey  mt-step-col <?php $eu="";if ($_GET['type'] == "EU") { ?> done <?php } ?>" relurl="/backoffice/frontuser/home/investorWalkthroughLevel2/type/EU/financial_year/ALL/is/SE">
                <div class="mt-step-number bg-white font-grey">1</div>
                <div class="mt-step-title uppercase font-grey-cascade"></div>
                <div class="mt-step-content font-grey-cascade custom-big-step" title=" Register for Existing Establishment">Register for Existing Establishment</div>
            </div>


            <div class="col-md-2 bg-grey  mt-step-col <?php if ($_GET['type'] == "Incentive") { ?> done <?php } ?>" relurl="/backoffice/dms/DocumentManagement/myDocuments/docStatus/U/is/SE/type/Incentive">

                <div class="mt-step-number bg-white font-grey">2</div>
                <div class="mt-step-title uppercase font-grey-cascade"><a href="/backoffice/dms/DocumentManagement/myDocuments/docStatus/U/is/SE/type/Incentive"></a></div>

                <div class="mt-step-content font-grey-cascade custom-big-step" title="Register for Incentives" > Declare Existing Incentive Registration</div>

            </div>



            <div class="col-md-2 bg-grey  mt-step-col <?php if ($_GET['type'] == "PES") { ?> done <?php } ?>" relurl="/backoffice/frontuser/applyService/ApplyServiceListing/type/PES/is/SE">
                <div class="mt-step-number bg-white font-grey">3</div>
                <div class="mt-step-title uppercase font-grey-cascade"><a href="/backoffice/frontuser/applyService/ApplyServiceListing/type/PES/is/SE"></a></div>
                <div class="mt-step-content font-grey-cascade custom-big-step" title="Apply for Pre-Establishment Services">Apply for Pre-Establishment Services</div>
            </div>


            <div class="col-md-2 bg-grey  mt-step-col <?php if ($_GET['type'] == "POS") { $eu="Yes"; ?> done <?php } ?>" relurl="/backoffice/frontuser/applyService/ApplyServiceListing/type/POS/is/SE">
                <div class="mt-step-number bg-white font-grey">4</div>
                <div class="mt-step-title uppercase font-grey-cascade"><a href="/backoffice/frontuser/applyService/ApplyServiceListing/type/POS/is/SE"></a></div>
                <div class="mt-step-content font-grey-cascade custom-big-step" title="Apply for Pre-Establishment Services">Apply for Pre-Operation Services</div>
            </div>

            <div class="col-md-2 bg-grey  mt-step-col <?php if ($_GET['type'] == "PO") { $eu="Yes"; ?> done <?php } ?>" relurl="/backoffice/frontuser/applyService/ApplyServiceListing/type/PO/is/SE">
                <div class="mt-step-number bg-white font-grey">5</div>
                <div class="mt-step-title uppercase font-grey-cascade"><a href="/backoffice/frontuser/applyService/ApplyServiceListing/type/PO/is/SE"></a></div>
                <div class="mt-step-content font-grey-cascade custom-big-step"title="Apply for Post Operation">Other Department Services</div>
            </div>
            <div class="col-md-2 bg-grey  mt-step-col <?php if ($_GET['type'] == "CI") { ?> done <?php } ?>" relurl="/backoffice/frontuser/application_form/applicationListClaim/service/Incentive/serviceProvider/9/type/CI/is/SE">
                <div class="mt-step-number bg-white font-grey">6</div>
                <div class="mt-step-title uppercase font-grey-cascade"><a href="/backoffice/frontuser/application_form/applicationListClaim/service/Incentive/serviceProvider/9/type/CI/is/SE"></a></div>
                <div class="mt-step-content font-grey-cascade custom-big-step"title="Claim Incentives">Claim Incentives</div>
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