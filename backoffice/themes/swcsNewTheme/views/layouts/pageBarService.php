<style>.homeredirect:hover{color:blue;}
.mt-element-step .step-thin .done {background-color:#36c6d3 !important;}
.dt-buttons{margin-top:-222px !important}
.custom-big-step{min-height:60px; !important}

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
			
			
			            <div class="page-bar">
			                <div class="col-md-8">
                    <ul class="page-breadcrumb">
                        <li>
                            <span class="pull-left"><a href="/backoffice/frontuser/home/serviceNew" title="Go to Departmental Services : New" class="fa fa-home homeredirect" ></a><b> <?php if(!empty(@$_SESSION['RESPONSE']['user_id']) || (isset($_GET['panel']) && $_GET['panel'] = 'investor')) 
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
                    <span class="pull-right" style="margin-top:5px;"><a href="/backoffice/frontuser/home/serviceNew/type/CAF" class="btn btn-success"><i class="fa fa-arrow-left"></i>&nbsp; Back</a></span>
                    </div>
				
		</div>	
		
		<br>
		
               
               <!-- <div class="page-bar">
                <form name="form" action="" method="GET"> 
                    <table>
                        <tbody>
                            <tr>
                                <td style="border:none !important"><b>Currently you are viewing data for <?php //echo @$_GET['financial_year'];?> FY, If you want to change then select Financial Year : </b>&nbsp;&nbsp;</td>
                                <td style="border:none !important">
                                        <select name="financial_year" readonly class="form-control" onchange="window.location = '/backoffice/frontuser/home/serviceNew/type/CAF/financial_year/' + this.value">
                                        <option value="<?php //echo @$_GET['financial_year']; ?>"><?php //echo @$_GET['financial_year']; ?></option>
                                           
                                    </select>
                                </td>
                            </tr>
                        </tbody></table>
                </form>
            </div>
		 <br>-->
		<div class="mt-element-step">
                                            
        <div class="row step-thin">

            <div class="col-md-2 bg-grey  mt-step-col <?php if ($_GET['type'] == "CAF") { ?> done <?php } ?>" relurl="/backoffice/frontuser/home/investorWalkthroughLevel2/type/CAF/is/service/<?php echo $typo; ?>">
                <div class="mt-step-number bg-white font-grey">1</div>
                <div class="mt-step-title uppercase font-grey-cascade"></div>
                <div class="mt-step-content font-grey-cascade custom-big-step" title=" In-Principle Approvals (CAF)">Apply for In-Principle Approvals</div>
            </div>


            <div class="col-md-2 bg-grey  mt-step-col <?php if ($_GET['type'] == "Incentive") { ?> done <?php } ?>" relurl="/backoffice/frontuser/application_form/applicationListIncentive/service/Incentive/serviceProvider/9/type/Incentive">

                <div class="mt-step-number bg-white font-grey">2</div>
                <div class="mt-step-title uppercase font-grey-cascade"><a href="/backoffice/frontuser/application_form/applicationListIncentive/service/Incentive/serviceProvider/9"></a></div>

                <div class="mt-step-content font-grey-cascade custom-big-step" title="Register for Incentives" > Register for Incentives</div>

            </div>



            <div class="col-md-2 bg-grey  mt-step-col <?php if ($_GET['type'] == "PES") { ?> done <?php } ?>" relurl="/backoffice/frontuser/applyService/ApplyServiceListing/type/PES">
                <div class="mt-step-number bg-white font-grey">3</div>
                <div class="mt-step-title uppercase font-grey-cascade"><a href="/backoffice/frontuser/applyService/ApplyServiceListing/type/PES"></a></div>
                <div class="mt-step-content font-grey-cascade custom-big-step" title="Apply for Pre-Establishment Services">Apply for Pre-Establishment Services</div>
            </div>


            <div class="col-md-2 bg-grey  mt-step-col <?php if ($_GET['type'] == "POS") { ?> done <?php } ?>" relurl="/backoffice/frontuser/applyService/ApplyServiceListing/type/POS">
                <div class="mt-step-number bg-white font-grey">4</div>
                <div class="mt-step-title uppercase font-grey-cascade"><a href="/backoffice/frontuser/applyService/ApplyServiceListing/type/POS"></a></div>
                <div class="mt-step-content font-grey-cascade custom-big-step" title="Apply for Pre-Establishment Services">Apply for Pre-Operation Services</div>
            </div>

            <div class="col-md-2 bg-grey  mt-step-col <?php if ($_GET['type'] == "PO") { ?> done <?php } ?>" relurl="/backoffice/frontuser/applyService/ApplyServiceListing/type/PO">
                <div class="mt-step-number bg-white font-grey">5</div>
                <div class="mt-step-title uppercase font-grey-cascade"><a href="/backoffice/frontuser/applyService/ApplyServiceListing/type/PO"></a></div>
                <div class="mt-step-content font-grey-cascade custom-big-step"title="Apply for Post Operation">Other Department Services</div>
            </div>
            <div class="col-md-2 bg-grey  mt-step-col <?php if ($_GET['type'] == "CI") { ?> done <?php } ?>" relurl="/backoffice/frontuser/application_form/applicationListClaim/service/Incentive/serviceProvider/9/type/CI">
                <div class="mt-step-number bg-white font-grey">6</div>
                <div class="mt-step-title uppercase font-grey-cascade"><a href="/backoffice/frontuser/application_form/applicationListClaim/service/Incentive/serviceProvider/9/type/CI"></a></div>
                <div class="mt-step-content font-grey-cascade custom-big-step"title="Claim Incentives">Claim Incentives</div>
            </div>

<!-- <div style="margin-top:10px;" class="col-md-2 bg-grey  mt-step-col <?php // if($_GET['type']=="LAND"){  ?> done <?php //}  ?>" relurl="/backoffice/frontuser/home/investorWalkthroughLevel2/type/LAND/<?php //echo $typo;  ?>">
    <div class="mt-step-number bg-white font-grey">7</div>
    <div class="mt-step-title uppercase font-grey-cascade"><a href="/backoffice/mis/prodTestDev/CafNodalDepartmentTransactions/application/MjIwNA=="></a></div>
    
    <div class="mt-step-content font-grey-cascade"title="Land Applications">Land Applications</div>
</div>-->
        </div>
        </div>
		<br>
		<?php if(isset($_GET['type']) && $_GET['type']=='CAF'){?>
		<div class="applycaf">
                    <span class="pull-left" style=""><a href="/backoffice/frontuser/home/cafForm" class="btn btn-success"><i class=""></i>&nbsp; Apply for In-Principle Approval(CAF) </a></span>
                </div>

												
		<?php }?>	

		<?php if(isset($_GET['type']) && $_GET['type']=='QUERIES'){?>
		<div class="applycaf">
                    <span class="pull-left" style=""><a href="https://caipotesturl.com/query/autologin.php?luser=demo.swcs.uk@gmail.com&flag=open&type=investor"><i class=""></i>&nbsp; Ask Question </a></span>
                </div>

												
		<?php }?>

		<?php if(isset($_GET['type']) && $_GET['type']=='TICKETS'){?>
		<div class="applycaf">
                    <span class="pull-left" style=""><a href="https://caipotesturl.com/ticket/open.php?user_id=MTE=" class="btn btn-success"><i class=""></i>&nbsp; Create Ticket </a></span>
                </div>

												
		<?php }?>

		<?php if(isset($_GET['type']) && $_GET['type']=='GRIEVANCE'){?>
		<div class="applycaf">
                    <span class="pull-left" style=""><a href="/backoffice/GrievanceNew/grievanceDetail/createGrievance" class="btn btn-success"><i class=""></i>&nbsp; Create Grievance </a></span>
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