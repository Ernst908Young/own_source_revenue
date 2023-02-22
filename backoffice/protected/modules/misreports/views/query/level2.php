<title>Query Report</title>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<?php $baseUrl = Yii::app()->theme->baseUrl; ?>
<div class="dashboard-home">
    <div class="applied-status" >
        <ul class="breadcrumb">
          <li><a href="/backoffice/admin">Home</a></li>
           <li>Reports</li>
             <li>
            <a href="<?php echo @$_SESSION['grl1previousurl'] ?>">
            Query Report Level 1
            </a>
          </li>
          <li>Query Report Level 2</li>
          </ul>
    

<div class="reservation-form p-0">
<div class="form-part bussiness-det">                          
            <h4 class="form-heading">
            Query Report
            </h4>

        <div class="form-row row">  


        <table class="table table-striped table-bordered table-hover" >         
        <tr>
          <td class="a_cent" style="font-size: 16px;"><strong style="color: #333;">Query ID: </strong> <?php echo $qmain['querycode']; ?></td>

          <td class="a_cent" style="font-size: 16px;"><strong style="color: #333; font-size: 16px;">Mobile: </strong> <?php echo $qmain['mobile_no']; ?></td> 
          <td class="a_cent" style="font-size: 16px;"><strong style="color: #333; font-size: 16px;">Email: </strong> <?php echo $qmain['email']; ?></td>  

          

            
          
          
        </tr>
        <tr>
          <td class="a_cent" style="font-size: 16px;"><strong style="color: #333; font-size: 16px;">Query Type: </strong> <?php echo $qmain['query_type']; ?></td>  

          <td class="a_cent" style="font-size: 16px;"><strong style="color: #333; font-size: 16px;">Service Category: </strong>
  <?php 
                                                   
 echo $qmain['category_name'] 
                                                ?>  
           </td>  
          <td class="a_cent" style="font-size: 16px;"><strong style="color: #333; font-size: 16px;">Service Name: </strong> <?php echo $qmain['service_name']; ?></td>  
          
          
          
          
        </tr> 
          <tr>
            <td class="a_cent" style="font-size: 16px;"><strong  style='color: #333; font-size: 16px;'>Status: </strong><?php echo  $qmain['status']==1?'<span class="label label-success">Open</span>':'<span class="label label-danger">Closed</span>' ?> 
          </td>
            <td class="a_cent" style="font-size: 16px;"><strong  style='color: #333; font-size: 16px;'>Created On: </strong> <?php echo date("d M Y h:i a",strtotime($qmain['created_on'])) ?>   </td>
            <td class="a_cent" style="font-size: 16px;"><strong  style='color: #333; font-size: 16px;'>Priority: </strong> <?php echo $qmain['querypriority'] ?>   </td>
          </tr> 
      </table>


            <div class="col-md-12">
        <strong  style='color: #333;'>Subject: </strong> 
        <br><?php echo  $qmain['subject']; ?>
          </div>
         




<!-- <table class="table table-striped table-bordered table-hover"> -->
  <hr style="color: #36c6d3;" />  
  <strong style="color: #000;">Replies Received</strong>
        <?php foreach($messages as $mk=>$mv){ ?><br><br>
          <small>
          <div class="row">
            <div class="col-md-3">
              <strong>By: </strong> 
                <?php echo $mv['user_type']=='URU' ? "Un-Register User" : ($mv['user_type']=='AU' ? "Applicant User" : "Support Team User")?>
            </div>
            <div class="col-md-4">
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <strong>On: </strong> <i><?php echo date("d M Y h:i a",strtotime($mv['msgdatetime'])) ; ?></i>
            </div>
            <div class="col-md-4"></div>
          </div>
        </small>
         <div class="row">
            <div class="col-md-12">
            <?php echo $mv['message']; ?>
          </div>
          </div>
        <?php } ?>
      <!-- </table> -->

     
      </div>
  </div>
</div>
</div>