<br>
<div class="reservation-form"> 

        <div class="status-title d-flex flex-wrap align-items-center justify-content-between">
            <h4>Payment History Details</h4>
         
        </div>
        <?php if($mainpay){         	
        	?>
        <table class="table table-striped table-bordered table-hover">					
	<tr>		
		<td class="a_cent" style="font-size: 16px;"><strong style="color: #333; font-size: 16px;">SRN: </strong> <?php echo $mainpay['submission_id']; ?></td>
		<td class="a_cent" style="font-size: 16px;"><strong style="color: #333; font-size: 16px;">Service Category: </strong> <?php echo $mainpay['category_name']; ?></td>
	</tr>
	<tr>
		<td class="a_cent" style="font-size: 16px;"><strong style="color: #333; font-size: 16px;">Service Name: </strong> <?php echo $mainpay['service_name']; ?></td>
		
		<td class="a_cent" style="font-size: 16px;"><strong  style='color: #333; font-size: 16px;'>Service Total Fee: </strong>
			<?php  
               echo $mainpay['service_total_fee']; ?> 
		</td>		
	</tr>
</table>
<div class="form-part bussiness-det">   
        <h4 class="form-heading">Payment Transaction Details</h4>
        <div class="form-row row">
            
            <?php 
            foreach($payment as $k=>$val){ ?>
                <div class="col-lg-12" style="margin-bottom: 10px;">
                    <div style="padding: 10px; border: 1px solid black;">
                        <div class="row">
                            <div class="col-md-6">
                                <b>Payment Mode : </b><?php echo Statuscode::paymentmode($val['payment_mode']); ?> 
                            </div>
                            <?php if($val['payment_mode']==1){ ?>
                            <div class="col-md-6">
                                <b>Transcation No. : </b><span style="color: blue; cursor: pointer; " onclick="getrevirydetail(<?= $val['id'] ?>)"><?= $val['transaction_number'] ?></span>
                            </div>
                        <?php }else{ ?>
                            <div class="col-md-6">
                                <b>Chalan No. : </b><?= $val['chalan_no'] ?> 
                            </div>
                        <?php } ?>
                        
                            <div class="col-md-6">
                                <b>Status : </b><?php  
                                    if($val['payment_mode']==1){
                                        if($val['is_payment_verified']){
                                            $verify_msg = ' and verified';
                                        }else{
                                            $verify_msg = ' but not verify';
                                        }
                                        echo $val['payment_status'].$verify_msg; 
                                    }else{
                                        echo $val['payment_status']; 
                                    }
                                    
                                         ?>
                            </div>
                            <?php if($val['payment_mode']==3){ ?>
                                <div class="col-md-6"> 
                                    <b>Payment Type : </b><?php echo $val['payment_type'] ?>
                                </div>
                                <div class="col-md-6"> 
                                    <b>Comment : </b><?php echo $val['msg'] ?>
                                </div>
                                <div class="col-md-6"> 
                                    <b>Payment Received By : </b><?php if($val['payment_received_by']){
                                        $bouser = Yii::app()->db->createCommand("SELECT * FROM bo_user where uid=".$val['payment_received_by'])->queryRow(); 
                                        echo $bouser['full_name'];
                                    }else{
                                        echo 'NA';
                                    } ?>
                                </div>
                            <?php } ?>
                            <div class="col-md-6">               
                                <b>Created On : </b><?php echo date("d M Y h:i a",strtotime($val['created_at'])) ?>
                            </div>
                            <div class="col-md-6">               
                                <b>Updated On : </b><?php echo date("d M Y h:i a",strtotime($val['updated_at'])) ?>
                            </div>

                            <div class="col-lg-12 transdiv" id="trans_details_<?= $val['transaction_number'] ?>">
                            
                        </div>

                        </div>
                    </div>
                </div>

            <?php } ?>  
                
        </div>
    </div>
    <div class="form-part bussiness-det">   
        <h4 class="form-heading">Payment Refund Request</h4>
        <div class="form-row row">
            <?php 
              foreach($paymentrefundrequest as $k=>$val){ ?>
                <div class="col-lg-12" style="margin-bottom: 10px;">
                    <div style="padding: 10px; border: 1px solid black;">
                        <div class="row">
                            <div class="col-md-6">
                                <b>Reason for refund : </b><?php echo $val['reason_for_change']; ?> 
                            </div>
                          
                           
                            <div class="col-md-6">               
                                <b>Created On : </b><?php echo date("d M Y h:i a",strtotime($val['created_at'])) ?>
                            </div>
                            <div class="col-md-6">               
                                <b>Updated On : </b><?php echo date("d M Y h:i a",strtotime($val['updated_at'])) ?>
                            </div>

                          
                            
                        </div>

                        </div>
                    </div>
                </div>

            <?php } ?>  
                
        </div>
        <div class="form-part bussiness-det">   
        <h4 class="form-heading">Payment Refund Success</h4>
        <div class="form-row row">
            <?php 
              foreach($paymentefund as $k=>$val){ ?>
                <div class="col-lg-12" style="margin-bottom: 10px;">
                    <div style="padding: 10px; border: 1px solid black;">
                        <div class="row">
                            <div class="col-md-6">
                                <b>Payment Status: </b><?php echo $val['payment_status']; ?> 
                            </div>
                             <div class="col-md-6">
                                <b>Transaction Number: </b><?php echo $val['transaction_number']; ?> 
                            </div>
                           
                            <div class="col-md-6">               
                                <b>Created On : </b><?php echo date("d M Y h:i a",strtotime($val['created_at'])) ?>
                            </div>
                            <div class="col-md-6">               
                                <b>Updated On : </b><?php echo date("d M Y h:i a",strtotime($val['updated_at'])) ?>
                            </div>

                          
                            
                        </div>

                        </div>
                    </div>
                </div>

            <?php } ?>  
                
        </div>
<?php }else{
	echo "<b style='color:red;'>There is no payment record found</b>";
} ?>
	
    </div>
</div>

<script type="text/javascript">
	function getrevirydetail(p_id){
		$.ajax({
                type: "GET",
                dataType: 'json',
                url: "/backoffice/investor/services/paytrasndetail",
                data:{p_id:p_id}, 
                beforeSend: function(){
                	$('.transdiv').html("");
                },
                success: function(result) {    
                if(result.status==false){                
                      $('#trans_details_'+result.trans_no).html('No data found');
                }else{
                     $('#trans_details_'+result.trans_no).html(result.ptdata);
                }                                   
              }             
            });		
	}
</script>