<style type="text/css">
.user-type{padding: 18px !important;text-align: center;font-size: 22px;color: #0091d7;}
.zoom {  border-radius: 50% !important;    border: 5px solid #e5e5e5 !important;   transition: transform .2s; /* Animation */ margin: 0 auto;}
.zoom:hover {  transform: scale(1.2);   }
.icard-body{border-radius: 10px !important; border: 1px solid #F05518;padding:10px; margin-top: 10px;}
.col-xl-3 {
    flex: 0 0 25%;
    max-width: 25%;
}
.card {
    position: relative;   
    border: 1px solid rgba(0,0,0,.05);
    border-radius: .375rem;
    background-color: #ffffff;
}
.card-stats .card-body {
    padding: 1rem 1.5rem;
}
.card-body {
    flex: 1 1 auto;
    padding: 1.5rem;
}

.text-muted {
    color: #8898aa !important;
}
.text-uppercase {
    text-transform: uppercase !important;
}
.h5, h5 {
    font-size: .8125rem;
}
.col-auto {
    flex: 0 0 auto;
    width: auto;
    max-width: none;
}
.alert{font-size: 20px;
font-weight: bold;}
.top-pad{
	padding-top: 37px;
    padding-bottom: 28px;	
}	
.reg-com-crd{
	background:#fff;
	border:solid 1px #e6e6e6;
	-webkit-box-shadow: 0px 2px 12px -1px rgba(0,0,0,0.3);
	-moz-box-shadow: 0px 2px 12px -1px rgba(0,0,0,0.3);
	box-shadow: 0px 2px 12px -1px rgba(0,0,0,0.3);
	position:relative;
}
.reg-com-crd-info{
	padding:15px;
	min-height:100px;
}
.reg-com-name{
	margin-bottom:10px;
	font-size:18px;
	line-height: 18px;
}
.reg-com-icn, .reg-com-nm{
	display:table-cell;
	vertical-align:top;
}
.reg-com-loc{
	font-size:14px;
}
.reg-com-btm{
	background:#e0f2fa;
	padding:5px;
}
.reg-com-btm a{
	color:#156587;
}
.reg-com-btm a img{
	margin-right:10px;
}
.reg-com-crd-noti{
	position:absolute;
	right: -20px;
	top: -20px;
	width:50px;
	height:50px;
	text-align:center;
	background: #e47031;
	border-radius: 100px !important;
}
.reg-com-crd-noti a{
	color: #fff;
	display: block;
	width: 100%;
	height: 100%;
	padding-top: 13px;
}
.reg-com-icn{
	padding-right:10px;
}

.round-stats h3{
    font-size: 28px !important;	
}	
</style>
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog ">
    <!-- Modal content-->
 <div class="modal-content">
      <div class="modal-header"> 
          <h2 class="modal-title" text-center="" style="font-weight: bold;font-size: 20px;color:#0091d7;text-align: center;">Select Your Role    
      
      </div>
      <div class="modal-body">
        <p class="text-center" style="font-size: 15px;margin: 0px;">Go to your dashboard by selecting the role that best describes you.</p>
        <div class=""></div>
        <div class="clearfix" style="margin:10px;"></div>
       <div class="col-md-12">
        <div class="col-md-1"></div>
          <div class="col-md-5 text-center">
         
            <a href="<?php echo BASE_URL ?>/backoffice/frontuser/home/investorWalkthrough"><img class="rounded user-typ zoom" src="/themes/backend/uploads/individual.png" width="140" height="140">
            <h3 class="text-center user-type">Individual </h3></a>
<p class="font-weight-light " style="margin: 5px">For making transaction for your company.</p>
          </div>
          
          
           <div class="col-md-5 text-center">
           <a href="<?php echo BASE_URL ?>/backoffice/frontuser/home/ServiceProviderDashboard/show/sp">  <img src="/themes/backend/uploads/service_provider.jpg" class=" rounded user-typ zoom" width="140" height="140">
              <h3 class="text-center user-type">Service Provider </h3></a>
<p class="font-weight-light " style="margin: 5px">To manage one or more than one companies behalf of company owner.</p> 
          </div>
          <div class="col-md-1"></div>
           

        </div>
        <div class="clearfix"></div>
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->

      
      </div>
    </div>
      

  </div>
</div>


<?php if(isset($show) && $show=='sp'){ ?>
	<div class="dashboard-welcome">
		<h2>Welcome to Service Provider Dashboard</h2>				
		<div class="welcome-date hidden-xs"><i class="icon-calendar"></i> <?php echo date('d-M-Y'); ?></div>
		<div class="clearfix"></div>
	</div>
	<div class="invest-dashboard-top-charts content-blocks" style="padding: 20px 15px 0px 74px;">	
    <div>
        <div class="col-xs-12 col-sm-4 col-md-2 col-lg-2">
            <div class="round-stats grey">
                <h3 class="incomplete">4</h3>
                <p>Total Registered Company</p>
            </div>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-2 col-lg-2">
            <div class="round-stats orange2">
                <h3 class="incomplete">15</h3>
                <h3 class="pending"></h3>
                <p>Total Uploaded Document</p>
            </div>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-2 col-lg-2">
            <div class="round-stats green2">
                <h3 class="incomplete">7</h3>
                <h3 class="reverted"></h3>
                <p>Total Raised Query</p>
            </div>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-2 col-lg-2">
            <div class="round-stats">
                <h3 class="inprogress">3</h3>
                <p>Total Raised Ticket</p>
            </div>
        </div>       
		<div class="col-xs-12 col-sm-4 col-md-2 col-lg-2">
            <div class="round-stats green3">
                <h3 class="rejected">1</h3>
                <p>Total Grievance</p>
            </div>
        </div>
		<div class="col-xs-12 col-sm-4 col-md-2 col-lg-2">
            <div class="round-stats green3">
                <h3 class="rejected">$5.2K</h3>
                <p>Total Paid Amount</p>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>

<div class="content-blocks">
    <div class="portlet box green">
        <div class="portlet-title">
            <div class="caption">
                <i class="icon-list"></i>Registered Companies</div><div class="tools" id="tabletoggle">
                <a href="javascript:;" class="collapse" data-original-title="" title="">
                </a>
            </div>
        </div>
        <div class="portlet-body">
			 <div class="col-xs-12 col-sm-6 col-md-3 top-pad">
				<div class="reg-com-crd">
					<div class="reg-com-crd-info">
						<div class="reg-com-name">
							<label class="reg-com-icn"><img src="/themes/investuk/images/building_icon_sml.png" alt="" /></label>
							<span class="reg-com-nm">Sunrun Solar Power Inc.</span>
						</div>
						<div class="reg-com-loc">
							<label class="reg-com-icn"><img src="/themes/investuk/images/location_icon.png" alt="" /></label>
							<span class="reg-com-nm">Perry Gap, Bridgetown, Barbados</span>
						</div>
					</div>
					<div class="reg-com-btm text-right"><a href="<?php echo BASE_URL ?>/backoffice/frontuser/home/investorWalkthrough/name/<?php echo  base64_encode("Sunrun Solar Power Inc.");?>"><img src="/themes/investuk/images/small_aro_icon.png" alt="" />Go to Dashboard</a></div>
					<div class="reg-com-crd-noti"><a href="#"><label><img src="/themes/investuk/images/notification_icon.png" alt="" /></label><span>2</span></a></div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-3 top-pad">
				<div class="reg-com-crd">
					<div class="reg-com-crd-info">
						<div class="reg-com-name">
							<label class="reg-com-icn"><img src="/themes/investuk/images/building_icon_sml.png" alt="" /></label>
							<span class="reg-com-nm">Insurance Corporation Ltd.</span>
						</div>
						<div class="reg-com-loc">
							<label class="reg-com-icn"><img src="/themes/investuk/images/location_icon.png" alt="" /></label>
							<span class="reg-com-nm">Worthing Corporate Centre, Worthing BB15008, Barbados</span>
						</div>
					</div>
					<div class="reg-com-btm text-right"><a href="<?php echo BASE_URL ?>/backoffice/frontuser/home/investorWalkthrough/name/<?php echo  base64_encode("Insurance Corporation Ltd.");?>"><img src="/themes/investuk/images/small_aro_icon.png" alt="" />Go to Dashboard</a></div>
					<!--<div class="reg-com-crd-noti"><a href="#"><label><img src="/themes/investuk/images/notification_icon.png" alt="" /></label><span>2</span></a></div>-->
				</div>
			</div>
			 <div class="col-xs-12 col-sm-6 col-md-3 top-pad">
				<div class="reg-com-crd">
					<div class="reg-com-crd-info">
						<div class="reg-com-name">
							<label class="reg-com-icn"><img src="/themes/investuk/images/building_icon_sml.png" alt="" /></label>
							<span class="reg-com-nm">Light & Power Holdings Ltd.</span>
						</div>
						<div class="reg-com-loc">
							<label class="reg-com-icn"><img src="/themes/investuk/images/location_icon.png" alt="" /></label>
							<span class="reg-com-nm">Spring Garden Substation Road, Spring Garden, Barbados</span>
						</div>
					</div>
					<div class="reg-com-btm text-right"><a href="<?php echo BASE_URL ?>/backoffice/frontuser/home/investorWalkthrough/name/<?php echo  base64_encode("Light & Power Holdings Ltd.");?>"><img src="/themes/investuk/images/small_aro_icon.png" alt="" />Go to Dashboard</a></div>
					<!--<div class="reg-com-crd-noti"><a href="#"><label><img src="/themes/investuk/images/notification_icon.png" alt="" /></label><span>2</span></a></div>-->
				</div>
			</div>
			 <div class="col-xs-12 col-sm-6 col-md-3 top-pad">
				<div class="reg-com-crd">
				<div class="reg-com-crd-info">
					<div class="reg-com-name">
						<label class="reg-com-icn"><img src="/themes/investuk/images/building_icon_sml.png" alt="" /></label>
						<span class="reg-com-nm">One Media Limited.</span>
					</div>
					<div class="reg-com-loc">
						<label class="reg-com-icn"><img src="/themes/investuk/images/location_icon.png" alt="" /></label>
						<span class="reg-com-nm">38 Roebuck Street,PO Box 640C Bridgetown Barbados</span>
					</div>
					</div>
					<div class="reg-com-btm text-right"><a href="<?php echo BASE_URL ?>/backoffice/frontuser/home/investorWalkthrough/name/<?php echo  base64_encode("One Media Limited.");?>"><img src="/themes/investuk/images/small_aro_icon.png" alt="" />Go to Dashboard</a></div>
					<div class="reg-com-crd-noti"><a href="#"><label><img src="/themes/investuk/images/notification_icon.png" alt="" /></label><span>5</span></a></div>
				</div>
			</div>
			<div class="clearfix"></div>
        </div>
    </div>
</div>
<?php }/* else{ ?>
<script>
$("#myModal").modal('show');

</script>
<?php } */ ?>