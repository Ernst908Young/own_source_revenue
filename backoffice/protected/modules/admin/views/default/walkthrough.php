<?php
/* @var $this HomeController */

$this->breadcrumbs = array(
    'Home',
);
$baseUrl = Yii::app()->theme->baseUrl;
?>
<style type="text/css">

    .dashboard-stat.yellow{

        background-color: #F1C40F;



    }



    @media (min-width: 700px){

        .col-lg-3 {

            width: 20%;

        }





    }

    .href_link:hover{

        color:#23527c;

    }

    .href_link1{

        color: #ffffff;

        font-size: 13px;

        font-family: "Open Sans",sans-serif;

        font-weight: 300;

        text-align: center;

        vertical-align: top;

        padding: 2px 5px;

    }

</style>
<div id="content">
    <style type="text/css">
        .dataTables_wrapper .dt-buttons{
            margin-right: 18px;
        }
        .marquee_container { float:left; margin-right:195px; margin-left: 195px; margin-top: -45px;}
        .marquee_container p {  display:inline; margin-left:16px; color:red; font-size:14.5px; line-height:33px; text-indent:8px; padding:25px;}
        .date_container {color: #fff;float: right;height: 60px;position: absolute;right: 10px;text-align: right;width: 100px;z-index: 999;}
    </style>
    <script type="text/javascript">
        function updateClock( )
        {
            var currentTime = new Date( );
            var currentdate = currentTime.toDateString();
            var currentHours = currentTime.getHours( );
            var currentMinutes = currentTime.getMinutes( );
            var currentSeconds = currentTime.getSeconds( );
            // Pad the minutes and seconds with leading zeros, if required
            currentMinutes = (currentMinutes < 10 ? "0" : "") + currentMinutes;
            currentSeconds = (currentSeconds < 10 ? "0" : "") + currentSeconds;
            // Choose either "AM" or "PM" as appropriate
            var timeOfDay = (currentHours < 12) ? "AM" : "PM";
            // Convert the hours component to 12-hour format if needed
            currentHours = (currentHours > 12) ? currentHours - 12 : currentHours;
            // Convert an hours component of "0" to "12"
            currentHours = (currentHours == 0) ? 12 : currentHours;
            // Compose the string for display
            var currentTimeString = currentdate + " " + currentHours + ":" + currentMinutes + ":" + currentSeconds + " " + timeOfDay;
            $("#clock").html(currentTimeString);

        }

    </script>



    <div class="site-min-height">

        <style>

            a:hover{color:blue;}
        </style>

        <style type="text/css">
            #chartdiv {
                width: 100%;
                height: 500px;
            }
        </style>

        <script type="text/javascript">

            function updateClock( )
            {
                var currentTime = new Date( );
                var currentdate = currentTime.toDateString();
                var currentHours = currentTime.getHours( );
                var currentMinutes = currentTime.getMinutes( );
                var currentSeconds = currentTime.getSeconds( );

                // Pad the minutes and seconds with leading zeros, if required
                currentMinutes = (currentMinutes < 10 ? "0" : "") + currentMinutes;
                currentSeconds = (currentSeconds < 10 ? "0" : "") + currentSeconds;

                // Choose either "AM" or "PM" as appropriate
                var timeOfDay = (currentHours < 12) ? "AM" : "PM";

                // Convert the hours component to 12-hour format if needed
                currentHours = (currentHours > 12) ? currentHours - 12 : currentHours;

                // Convert an hours component of "0" to "12"
                currentHours = (currentHours == 0) ? 12 : currentHours;

                // Compose the string for display
                var currentTimeString = currentdate + " " + currentHours + ":" + currentMinutes + ":" + currentSeconds + " " + timeOfDay;


                $("#clock").html(currentTimeString);

            }

        </script>

        <!-- BEGIN CONTENT BODY -->
        <br>


        <br>
        <div class="portlet-body">

        </div>





        <style type="text/css">
            .pd_child{ padding-left: 50px !important; }
        </style>
            <div class="portlet-body">
<div class="page-bar">
      <ul class="page-breadcrumb">
         <li>
                 <b> Welcome to Investor Monitoring Panel - Uttarakhand </b>
         </li>
      </ul>

      <div class="page-toolbar">
         <div id="" class="pull-right tooltips btn btn-sm" data-container="body" data-placement="bottom" data-original-title="" title="">
           <span class="thin uppercase hidden-xs" id="clock"><?php echo date('d-M-Y'); ?>&nbsp;</span>
            <span class="thin uppercase hidden-xs"></span>&nbsp;

         </div>
      </div>
   </div>
   </div>
        <br>
        <div class="portlet-body">
      

    <div class="clearfix">
   <br>
   <div class="page-bar">
   <form name="form" action="" method="POST"> 
   <table>
   <tbody>
       <tr>
   <td><b>Currently you are viewing data for "2018-2019", If you want to change then select Financial Year : </b>&nbsp;&nbsp;</td>
   <td>
  <select name="financial_year" class="form-control" onchange="this.form.submit()"  >
          <option value="ALL" <?php if($financial_year=="ALL"){ echo "selected='selected'"; } ?> >ALL</option>
   <?php for($i=$pp;$i<$yyy;$i++){ $j=$i+1; $k=$i.'-'.$j; ?>
         <option value="<?php echo $k; ?>" <?php if($financial_year==$k){ echo "selected='selected'"; } ?>><?php echo $k; ?></option>
    <?php } ?>
    </select>
       </td>
   </tr>


   </tbody></table>
         </form>
         </div>
        <hr>
		</div></div>
        <div class="row">

            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">

                <a class="dashboard-stat dashboard-stat-v2 yellow " href="/backoffice/frontuser/home/investorWalkthroughLevel2/type/CAF">

                    <div class="visual">

                        <i class="fa fa-comments"></i>

                    </div>

                    <div class="details">

                        <div class="number">

                            <span class="incomplete"></span>

                        </div>

                        <div class="desc">Incomplete</div>

                    </div>

                </a>

            </div>
            

            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">

                <a class="dashboard-stat dashboard-stat-v2 blue" href="/backoffice/frontuser/home/investorWalkthroughLevel2/type/CAF">

                    <div class="visual">

                        <i class="fa fa-bar-chart-o"></i>

                    </div>

                    <div class="details">

                        <div class="number">

                            <span class="pending"></span></div>

                        <div class="desc">Pending</div>

                    </div>

                </a>

            </div>

            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">

                <a class="dashboard-stat dashboard-stat-v2 purple" href="/backoffice/frontuser/home/investorWalkthroughLevel2/type/CAF">

                    <div class="visual">

                        <i class="fa fa-shopping-cart"></i>

                    </div>

                    <div class="details">

                        <div class="number">

                            <span class="reverted"></span>

                        </div>

                        <div class="desc">Reverted</div>

                    </div>

                </a>

            </div>

            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">

                <a class="dashboard-stat dashboard-stat-v2 green" href="/backoffice/frontuser/home/investorWalkthroughLevel2/type/CAF">

                    <div class="visual">

                        <i class="fa fa-globe"></i>

                    </div>

                    <div class="details">

                        <div class="number">

                            <span class="inprogress"></span></div>

                        <div class="desc">In Process</div>

                    </div>

                </a>

            </div>

            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">

                <a class="dashboard-stat dashboard-stat-v2" href="/backoffice/frontuser/home/investorWalkthroughLevel2/type/CAF" style="background:green;color:#fff;">

                    <div class="visual">

                        <i class="fa fa-globe"></i>

                    </div>

                    <div class="details">

                        <div class="number">

                            <span class="rejected"></span></div>

                        <div class="desc">Disposed </div>

                    </div>

                </a>

            </div>

        </div>


        <br>


        <div class="row">
            <div class="portlet light bordered col-md-12" style="margin-bottom:0px !important;">
                <!-- BEGIN SAMPLE TABLE PORTLET-->
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-list"></i>
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="table-scrollable">
                            
                            <table class="table table-bordered table-hover movetoDashboard">
                                <thead>
                                    <tr style="background-color:#BBBBBB;">
                                        <th style="font-weight:bold;font-size:16px;">Service</th>
                                        <th style="text-align:center;font-size:16px;font-weight:bold;"> Archived</th>
                                        <th style="text-align:center;font-size:16px;font-weight:bold;"> Incomplete</th>
                                        <th style="text-align:center;font-size:16px;font-weight:bold;"> Pending</th>
                                        <th style="text-align:center;font-size:16px;font-weight:bold;"> Reverted</th>
                                        <th style="text-align:center;font-size:16px;font-weight:bold;"> In Process</th>
                                        <th style="text-align:center;font-size:16px;font-weight:bold;"> Approved</th>
                                        <th style="text-align:center;font-size:16px;font-weight:bold;"> Rejected</th>
                                        <th style="text-align:center;font-size:16px;font-weight:bold;"> Total</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th style="background-color:#f3f4f6;"> In-Principle Approval (CAF)</th>
                                        <td style="text-align:center;"> <?php echo $archived = ApplicationV2Ext::ApplicationAndStausWiseCountforAnInvestor('11', '1', 'Z', 'INV'); ?> </td>
                                        <td style="text-align:center;"> <?php echo $incomplete1 = ApplicationV2Ext::ApplicationAndStausWiseCountforAnInvestor('11', '1', 'I', 'INV'); ?>  </td>
                                        <td style="text-align:center;"> <?php echo $pending1 = ApplicationV2Ext::ApplicationAndStausWiseCountforAnInvestor('11', '1', 'P', 'INV'); ?> </td>
                                        <td style="text-align:center;"> <?php echo $reverted1 = ApplicationV2Ext::ApplicationAndStausWiseCountforAnInvestor('11', '1', 'RBI', 'INV'); ?>  </td>
                                        <td style="text-align:center;"> <?php echo $inProgress1 = ApplicationV2Ext::ApplicationAndStausWiseCountforAnInvestor('11', '1', 'F', 'INV'); ?>  </td>
                                        <td style="text-align:center;"> <?php echo $approved1 = ApplicationV2Ext::ApplicationAndStausWiseCountforAnInvestor('11', '1', 'A', 'INV'); ?>  </td>
                                        <td style="text-align:center;"> <?php echo $rejected1 = ApplicationV2Ext::ApplicationAndStausWiseCountforAnInvestor('11', '1', 'R', 'INV'); ?>  </td>
                                        <td style="text-align:center;"> <?php echo $totalCAF = $archived + $incomplete1 + $pending1 + $reverted1 + $inProgress1 + $approved1 + $rejected1; ?> </td>



                                    </tr>
                                    <tr>
                                        <th style="background-color:#f3f4f6;">Existing unit Registration</th>
                                        <td style="text-align:center;"> <?php echo $archived = ApplicationV2Ext::ApplicationAndStausWiseCountforAnInvestor('11', '11', 'Z', 'INV'); ?> </td>
                                        <td style="text-align:center;"> <?php echo $incomplete2 = ApplicationV2Ext::ApplicationAndStausWiseCountforAnInvestor('11', '11', 'I', 'INV'); ?>  </td>
                                        <td style="text-align:center;"> <?php echo $pending2 = ApplicationV2Ext::ApplicationAndStausWiseCountforAnInvestor('11', '11', 'P', 'INV'); ?> </td>
                                        <td style="text-align:center;"> <?php echo $reverted2 = ApplicationV2Ext::ApplicationAndStausWiseCountforAnInvestor('11', '11', 'RBI', 'INV'); ?>  </td>
                                        <td style="text-align:center;"> <?php echo $inProgress2 = ApplicationV2Ext::ApplicationAndStausWiseCountforAnInvestor('11', '11', 'F', 'INV'); ?>  </td>
                                        <td style="text-align:center;"> <?php echo $approved2 = ApplicationV2Ext::ApplicationAndStausWiseCountforAnInvestor('11', '11', 'A', 'INV'); ?>  </td>
                                        <td style="text-align:center;"> <?php echo $rejected2 = ApplicationV2Ext::ApplicationAndStausWiseCountforAnInvestor('11', '11', 'R', 'INV'); ?>  </td>
                                        <td style="text-align:center;"> <?php echo $totalExistingCAF = $archived + $incomplete2 + $pending2 + $reverted2 + $inProgress2 + $approved2 + $rejected2; ?> </td>
                                    </tr>

                                    <tr>                                       
                                        <th style="background-color:#f3f4f6;"> Applications for Dept. Services <br>(with Approved CAF)</th>
                                        <td style="text-align:center;">  <?php echo $archived = ApplicationV2Ext::ApplicationAndStausWiseCountforAnInvestorForServices('11', 'Z', 'Y', 'INV'); ?> </td>
                                        <td style="text-align:center;">   <?php echo $incomplete3 = ApplicationV2Ext::ApplicationAndStausWiseCountforAnInvestorForServices('11', 'ServiceIncomplete', 'Y', 'INV'); ?> </td>
                                        <td style="text-align:center;">   <?php echo $pending3 = ApplicationV2Ext::ApplicationAndStausWiseCountforAnInvestorForServices('11', 'P', 'Y', 'INV'); ?></td>
                                        <td style="text-align:center;">   <?php echo $reverted3 = ApplicationV2Ext::ApplicationAndStausWiseCountforAnInvestorForServices('11', 'RBI', 'Y', 'INV'); ?></td>
                                        <td style="text-align:center;">   <?php echo $inProgress3 = ApplicationV2Ext::ApplicationAndStausWiseCountforAnInvestorForServices('11', 'ServiceInprogress', 'Y', 'INV'); ?></td>
                                        <td style="text-align:center;">   <?php echo $approved3 = ApplicationV2Ext::ApplicationAndStausWiseCountforAnInvestorForServices('11', 'A', 'Y', 'INV'); ?></td>
                                        <td style="text-align:center;">   <?php echo $rejected3 = ApplicationV2Ext::ApplicationAndStausWiseCountforAnInvestorForServices('11', 'R', 'Y', 'INV'); ?></td>                                    
                                        <td style="text-align:center;"> <?php echo $totalExistingCAF = $archived + $incomplete3 + $pending3 + $reverted3 + $inProgress3 + $approved3 + $rejected3; ?> </td>                                  
                                    </tr>




                                    </tr>
                                    <tr>
                                        <th style="background-color:#f3f4f6;"> Applications for Dept. Services <br>(without CAF)</th>
                                        <td style="text-align:center;">  <?php echo $archived = ApplicationV2Ext::ApplicationAndStausWiseCountforAnInvestorForServices('11', 'Z', 'N', 'INV'); ?> </td>
                                        <td style="text-align:center;">   <?php echo $incomplete4 = ApplicationV2Ext::ApplicationAndStausWiseCountforAnInvestorForServices('11', "ServiceIncomplete", 'N', 'INV'); ?> </td>
                                        <td style="text-align:center;">   <?php echo $pending4 = ApplicationV2Ext::ApplicationAndStausWiseCountforAnInvestorForServices('11', 'P', 'N', 'INV'); ?></td>
                                        <td style="text-align:center;">   <?php echo $reverted4 = ApplicationV2Ext::ApplicationAndStausWiseCountforAnInvestorForServices('11', 'RBI', 'N', 'INV'); ?></td>
                                        <td style="text-align:center;">   <?php echo $inProgress4 = ApplicationV2Ext::ApplicationAndStausWiseCountforAnInvestorForServices('11', 'ServiceInprogress', 'N', 'INV'); ?></td>
                                        <td style="text-align:center;">   <?php echo $approved4 = ApplicationV2Ext::ApplicationAndStausWiseCountforAnInvestorForServices('11', 'A', 'N', 'INV'); ?></td>
                                        <td style="text-align:center;">   <?php echo $rejected4 = ApplicationV2Ext::ApplicationAndStausWiseCountforAnInvestorForServices('11', 'R', 'N', 'INV'); ?></td>                                    
                                        <td style="text-align:center;"> <?php echo $totalExistingCAF = $archived + $incomplete4 + $pending4 + $reverted4 + $inProgress4 + $approved4 + $rejected4; ?> </td>                                   
                                    </tr>

                                    <tr>
                                        <th style="background-color:#f3f4f6;">Land Allotment (Mini Industrial Estate)</th>
                                        <td style="text-align:center;"> <?php echo $archived = ApplicationV2Ext::ApplicationAndStausWiseCountforAnInvestor('11', '8', 'Z', 'INV'); ?> </td>
                                        <td style="text-align:center;"> <?php echo $incomplete5 = ApplicationV2Ext::ApplicationAndStausWiseCountforAnInvestor('11', '8', 'I', 'INV'); ?>  </td>
                                        <td style="text-align:center;"> <?php echo $pending5 = ApplicationV2Ext::ApplicationAndStausWiseCountforAnInvestor('11', '8', 'P', 'INV'); ?> </td>
                                        <td style="text-align:center;"> <?php echo $reverted5 = ApplicationV2Ext::ApplicationAndStausWiseCountforAnInvestor('11', '8', 'RBI', 'INV'); ?>  </td>
                                        <td style="text-align:center;"> <?php echo $inProgress5 = ApplicationV2Ext::ApplicationAndStausWiseCountforAnInvestor('11', '8', 'F', 'INV'); ?>  </td>
                                        <td style="text-align:center;"> <?php echo $approved5 = ApplicationV2Ext::ApplicationAndStausWiseCountforAnInvestor('11', '8', 'A', 'INV'); ?>  </td>
                                        <td style="text-align:center;"> <?php echo $rejected5 = ApplicationV2Ext::ApplicationAndStausWiseCountforAnInvestor('11', '8', 'R', 'INV'); ?>  </td>
                                        <td style="text-align:center;"> <?php echo $totalLandApplication = $archived + $incomplete5 + $pending5 + $reverted5 + $inProgress5 + $approved5 + $rejected5; ?> </td>
                                    </tr>



                                    </tr>



                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- END SAMPLE TABLE PORTLET-->
            </div>
        </div>



        <div class="clearfix"></div>



    </div></div>




<?php
$base = Yii::app()->theme->baseUrl;
?>

<!-- BEGIN PAGE LEVEL PLUGINS -->

<script src="<?= $base ?>/assets/global/scripts/datatable.js" type="text/javascript"></script>

<script src="<?= $base ?>/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>

<script src="<?= $base ?>/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>

<script src="<?= $base ?>/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>

<!-- END PAGE LEVEL PLUGINS -->







<!-- BEGIN PAGE LEVEL PLUGINS -->

<link href="<?= $base ?>/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />

<link href="<?= $base ?>/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />

<!-- END PAGE LEVEL PLUGINS -->


<style>
    .modal {
        text-align: center;
    }
    @media screen and (min-width: 768px) { 
        .modal:before {
            display: inline-block;
            vertical-align: middle;
            content: " ";
            height: 100%;
        }
    }
    .modal-dialog {
        display: inline-block;
        text-align: left;
        vertical-align: middle;
    }
    .movetoDashboard{
        cursor: pointer;
    }
</style>
<script>
    
    $(".movetoDashboard").click(function(){
        window.location.href="/backoffice/frontuser/home/investorWalkthroughLevel2/type/CAF"; 
    });
    
    $(".incomplete").html("<?php echo $totalIncomplete=$incomplete1+$incomplete2+$incomplete3+$incomplete4+$incomplete5;?>");
    $(".pending").html("<?php echo $totalPending=$pending1+$pending2+$pending3+$pending4+$pending5;?>");    
    $(".reverted").html("<?php echo $totalReverted=$reverted1+$reverted2+$reverted3+$reverted4+$reverted5;?>");
    $(".inprogress").html("<?php echo $totalInprogress=$inProgress1+$inProgress2+$inProgress3+$inProgress4+$inProgress5?>");
    $(".rejected").html("<?php $totalapproved=$approved1+$approved2+$approved3+$approved4+$approved5; $totalRejected=$rejected1+$rejected2+$rejected3+$rejected4+$rejected5; echo $totalapproved+$totalRejected?>");
    </script>