<style type="text/css">
  .portlet.box.yellow-crusta{
      border: 1px solid #27a4b0;
  }
  .portlet.box.yellow-crusta>.portlet-title, .portlet.yellow-crusta, .portlet>.portlet-body.yellow-crusta{
        background-color: #27a4b0;
  }
</style>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="index.html">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Payment Detail</span>
        </li>
    </ul>
</div>
<h1 class="page-title"> &nbsp;
    <small>&nbsp;</small>
</h1>
<div class="row">
  <div class="col-md-6 col-sm-12">
    <div class="portlet yellow-crusta box">
      <div class="portlet-title">
        <div class="caption">
          <i class="fa fa-cogs"></i>Payment Detail </div>
      </div>
      <div class="portlet-body">
        <div class="row static-info">
          <div class="col-md-5 name"> Order #: </div>
          <div class="col-md-7 value orderNumber"> 
            <span class="label label-danger label-sm"> Will be notify by sms </span>
          </div>
        </div>
        <div class="row static-info">
          <div class="col-md-5 name"> Grand Total: </div>
          <div class="col-md-7 value"> <i class="fa fa-inr" ></i> <?=$amount?> </div>
        </div>
        <div class="row static-info">
          <div class="col-md-5 name"> Order Date &amp; Time: </div>
          <div class="col-md-7 value"> <?=date('Y-m-d H:i:s')?> </div>
        </div>
        <div class="row static-info">
          <div class="col-md-5 name"> Order Status: </div>
          <div class="col-md-7 value">
            
              <form action="/backoffice/payment/paymentDetail/worldLinePaymentService" method="post">
                <div class="form-group">
                     <input type="hidden" readonly="readonly" value="" id="OrderId" name="Payment[OrderId]">
                     <input type="hidden" value="<?php echo $amount; ?>" id="amount" name="Payment[amount]">
                     <input type="hidden" value="S" id="meTransReqType" name="Payment[meTransReqType]">
                     <input type="hidden" value="<?php echo $submission_id; ?>" id="submission_id" name="Payment[submission_id]">
                     <input type="hidden" value="<?php echo $application_id; ?>" id="application_id" name="Payment[application_id]">
                     <input type="hidden" value="<?php echo $iuid; ?>" id="iuid" name="Payment[iuid]">                  
                     <input type="submit" class="btn btn-success" value="Pay Now">
                     <i class="error"></i>
                  </div>
              </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
      var d = new Date();
      var n = d.getTime();
      var orderID = n +  '' +randomFromTo(0,1000);
      
      $("#OrderId").val(orderID);
      $(".orderNumber").html(orderID);
      return true;
    })
      
    function randomFromTo(from, to){
      return Math.floor(Math.random() * (to - from + 1) + from);
    }
  </script>