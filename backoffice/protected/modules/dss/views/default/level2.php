<title>DSS- <?= $category ?></title>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script
src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js">
</script>
<style type="text/css">
  .mr-10{
    margin-right:10px;
  }
</style>
<?php $baseUrl = Yii::app()->theme->baseUrl;
$basePath="/themes/investuk"; ?>
<div class="dashboard-home">
    <div class="applied-status" >
        <ul class="breadcrumb">
          <li><a href="/backoffice/dss/default/dashboard/otd/dss">Home</a></li>    
           <li>
            <a href="/backoffice/dss/default/index/otd/dss?category=<?= $category ?>&from_date=<?= $from_date?>&to_date=<?= $to_date ?>">
              DSS <?= ucfirst($category) ?> Level 1
            </a>
          </li>       
          <li>DSS <?= ucfirst($category) ?> Level 2</li>
          </ul>
    

<div class="reservation-form p-0">
<div class="form-part bussiness-det">                          
            <h4 class="form-heading">
                DSS <?= ucfirst($category) ?> Level 2
            </h4>
        
         
        
      <form method="get" action='/backoffice/dss/default/level2'>
        <div class="form-row row">             
          <input type="hidden" name="category" value="<?= $category ?>">
          <div class="col-lg-3 form-group">   
            <label>Sub Category</label>
              <select name="sub_category" placeholder="Category" class="select2-me" id="sub_category" labelname="sub_category">
                    
                 <?php 
                 $sub_category_arr = Dss::subcategory($category);
                   foreach($sub_category_arr as $k=>$v){ 
                    $selects = !empty($sub_category)  ? ($k==$sub_category ? 'selected' : '') : '' ;
                    ?>
                      <option value="<?= $k ?>" <?= $selects ?>>
                        <?php echo $v ?>
                      </option>
                   <?php } ?>

              </select>            
          </div>
         <div class="col-lg-3 form-group">
            <label>From Date</label>
            <input type="inputType" autocomplete="off" id="from_date" name="from_date" class="datepicker form-control from_date" labelname="from_date" value="<?= $from_date ?>" readonly required />
          </div>
          <div class="col-lg-3 form-group">
            <label>To Date</label>
            <input type="inputType" autocomplete="off" id="to_date" name="to_date" class="datepicker form-control to_date" labelname="to_date" value="<?= $to_date ?>" readonly required />
          </div>

           

          <?php 
               $pdfurl = "/backoffice/dss/default/level2pdf?category=$category&sub_category=$sub_category&from_date=$from_date&to_date=$to_date";
              
          ?>
          <div class="col-lg-6 form-group" style="margin-top: 35px;">
            <button type="submit" class="btn-primary">Apply</button>
            <!-- <a href="<?= $pdfurl ?>"  class="btn-primary">PDF</a> -->
          </div>
        </div>
      </form>
      <form action="<?= $pdfurl ?>" method="post" target="_blank">
            <div class="form-row row">
              <div class="col-lg-1 form-group">
                <textarea name="linegraphdata" id="linegraphdata" hidden="hidden"></textarea>
                <textarea name="bargraphdata" id="bargraphdata" hidden="hidden"></textarea>
                <textarea name="piechartdata" id="piechartdata" hidden="hidden"></textarea>
                <textarea name="donutchartdata" id="donutchartdata" hidden="hidden"></textarea>
                <textarea name="multilinegraphdata" id="multilinegraphdata" hidden="hidden"></textarea>
              </div>
              <div class="col-lg-2 form-group" style="text-align: center; margin-top: -63px;">
                <button type="submit" class="btn-primary">PDF</button>
              </div>
             </div>
          </form>
      <?php 
        switch ($category) {
         case 'entities':
        
            echo $this->renderPartial('entities/level2',['category'=>$category,'sub_category'=>$sub_category,
              'data_array'=>$data_array]);
          break;
       
        case 'helpdesk':
          $xaxis = ["Total No. of Rejected","Total No. of Resolved/Closed","Total of Received","Total No. of Re-opened"];
          $yaxis = ['60','40','10','20'];
           $year_xaxis = ["2018","2019",'2020','2021','2022'];
          $year_yaxis = ["290","225",'35','70','500'];
            echo $this->renderPartial('helpdesk/level2',['category'=>$category,'sub_category'=>$sub_category,'data_array'=>$data_array, 'xaxis'=>$xaxis,'yaxis'=>$yaxis,'year_xaxis'=>$year_xaxis,'year_yaxis'=>$year_yaxis]);
          break;
        
        
        default:
          
          break;
      }
        

      ?>

 
</div>       
</div>
 




</div>
</div>

  <script type="text/javascript">
    $(document).ready(function () {
      var date = new Date();
  date.setDate(date.getDate());
      $('.datepicker').datepicker({
          changeMonth: true,
          changeYear: true,
            dateFormat: 'dd-mm-yy',
            autoclose:true,
            maxDate: date
            });
    });
  </script>



<script src="<?= Yii::app()->theme->baseUrl ?>/assets/global/plugins/jquery-repeater/jquery.repeater.js" type="text/javascript">
</script>
<script src="<?= Yii::app()->theme->baseUrl ?>/assets/pages/scripts/form-repeater.min.js" type="text/javascript">
</script>
<!-- form repeater js -->

<link rel="stylesheet" href="<?= Yii::app()->theme->baseUrl ?>/assets/frontend/dashboard/css/plugins/select2/select2.css">
<!-- select2 -->
<script src="<?= Yii::app()->theme->baseUrl ?>/assets/frontend/dashboard/js/plugins/select2/select2.min.js"></script>
<!-- Theme framework -->
<script src="<?= Yii::app()->theme->baseUrl ?>/assets/frontend/dashboard/js/eakroko.min.js"></script>


<script src="<?=$baseUrl?>/assets/global/scripts/datatable.js" type="text/javascript"></script>

<script src="<?=$baseUrl?>/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>

<script src="<?=$baseUrl?>/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>


