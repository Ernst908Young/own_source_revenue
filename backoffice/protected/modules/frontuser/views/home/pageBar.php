<?php

        if(!empty($_GET['financial_year'])){ $fy="financial_year/".$_GET['financial_year'];}else{$fy="";}
        
        $typo="".$fy;
        if(!empty(@$_SESSION['RESPONSE']['user_id'])){
			$userID=@$_SESSION['RESPONSE']['user_id'];
		}else if($_SESSION['role_id']==2){      
			$userID= base64_decode($_GET['uid']);
			$typo="uid/$_GET[uid]/iuid/$_GET[iuid]".$fy;
		}else{
			$userID=0;
		}
		$urlI="/backoffice/frontuser/home/investorWalkthroughLevel2/".$typo;
		if(isset($_GET['iuid']))
			$iuid= base64_decode($_GET['iuid']);
			?>
			
			
			            <div class="page-bar">
			                <div class="col-md-8">
                    <ul class="page-breadcrumb">
                        <li>
                            <span class="pull-left"><b> <?php if(!empty(@$_SESSION['RESPONSE']['user_id'])) 
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
                    <span class="pull-right" style="margin-top:5px;"><a href="/backoffice/frontuser/home/investorWalkthrough/financial_year/<?php echo $financial_year;  ?>" class="btn btn-success"><i class="fa fa-arrow-left"></i>&nbsp; Back</a></span>
                    </div>
				
		</div>	