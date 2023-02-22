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
if($category=='entities' || $category=='helpdesk'){
  $sc_disabled = '';
}else{
  $sc_disabled = 'disabled';
}


$basePath="/themes/investuk"; ?>
<div class="dashboard-home">
    <div class="applied-status" >
        <ul class="breadcrumb">
          <li><a href="/backoffice/dss/default/dashboard/otd/dss">Home</a></li>          
          <li>DSS <?= ucfirst($category) ?> Level 1</li>
          </ul>
    

<div class="reservation-form p-0">
<div class="form-part bussiness-det">                          
            <h4 class="form-heading">
                DSS <?= ucfirst($category) ?> Level 1
            </h4>
        
         
        
      <form method="get">
        <div class="form-row row">             
          <div class="col-lg-3 form-group">   
            <label>Category</label>
              <select name="category" placeholder="Category" class="select2-me" id="category" labelname="category">
                    
                 <?php 
                 $category_arr = Dss::category();
                   foreach($category_arr as $k=>$v){ 
                    $selects = !empty($category)  ? ($k==$category ? 'selected' : '') : '' ;
                    ?>
                      <option value="<?= $k ?>" <?= $selects ?>>
                        <?php echo $v ?>
                      </option>
                   <?php } ?>

              </select>            
          </div>
          <div class="col-lg-3 form-group">   
            <label>Sub Category</label>
              <select name="sub_category" placeholder="Category" class="select2-me" id="sub_category" labelname="sub_category" <?= $sc_disabled ?>>
                    
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
               $pdfurl = "/backoffice/dss/default/printpdf?category=$category&sub_category=$sub_category&from_date=$from_date&to_date=$to_date";
              
          ?>
          <div class="col-lg-6 form-group" style="margin-top: 35px;">
            <button type="submit" class="btn-primary">Apply</button>
            <!-- <a href="<1?= $pdfurl ?>"  class="btn-primary">PDF</a> -->
          </div>
        </div>
      </form>
      <form action="<?= $pdfurl ?>" method="post">
            <div class="form-row row">
              <div class="col-lg-1 form-group">
                <textarea name="linegraphdata" id="linegraphdata" hidden="hidden"></textarea>
                <textarea name="bargraphdata" id="bargraphdata" hidden="hidden"></textarea>
                <textarea name="piechartdata" id="piechartdata" hidden="hidden"></textarea>
                <textarea name="donutchartdata" id="donutchartdata" hidden="hidden"></textarea>
                <textarea name="multilinegraphdata" id="multilinegraphdata" hidden="hidden"></textarea>
                <textarea name="multibargraphdata" id="multibargraphdata" hidden="hidden"></textarea>
              </div>
              <div class="col-lg-2 form-group" style="text-align: center; margin-top: -63px;">
                <button type="submit" class="btn-primary">PDF</button>
              </div>
             </div>
          </form>
      <?php 
        switch ($category) {
         case 'entities':
            echo $this->renderPartial('entities/level1',['category'=>$category,'year'=>$year,'data_array'=>$data_array]);
          break;

        case 'filings':

          echo $this->renderPartial('filings/level1',['category'=>$category,'year'=>$year,'data_array'=>$data_array]);
                 
          break;

        case 'helpdesk':
            echo $this->renderPartial('helpdesk/level1',['category'=>$category,'year'=>$year,'data_array'=>$data_array]);
          break;

        case 'revenue':
          echo $this->renderPartial('revenue/level1',['category'=>$category,'year'=>$year,'data_array'=>$data_array]);
          break;

        case 'service provider':
          
          echo $this->renderPartial('serviceprovider/level1',['category'=>$category,'year'=>$year,'data_array'=>$data_array]);
          
          break;
        case 'BO user analysis':
            echo $this->renderPartial('BO user analysis/level1',['category'=>$category,'year'=>$year,'data_array'=>$data_array]);
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


