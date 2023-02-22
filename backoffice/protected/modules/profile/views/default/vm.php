<title>User Guide</title>
<div class="dashboard-home">
   <div class="applied-status">
   	 <ul class="breadcrumb">
          <li><a href="/backoffice/admin">Home</a></li>
          <li>User Guide</li>       
     </ul>
        <div class="status-title d-flex flex-wrap align-items-center justify-content-between">
            <h4 style="margin-bottom: 5px;">Video & User manual</h4>         
        </div>

        <p>
        	This section lists all the help documents and videos available for various services being offered by CAIPO in the new portal. Users are requested to read through the online help for any queries and issues.<br><br>
In case of Complaints / Suggestions / Feedback, please raise a query in CAIPO Helpdesk Service. You can also reach out to us on our Helpline number: +1 (246) 535-2401 from 9:00 AM to 6:00 PM Monday to Friday and 11:00 AM to 5:00 PM on Saturday.
        </p>

<?php 
$basePath="/themes/investuk";
//verifier
 if (in_array($_SESSION['role_id'],array('83'))) {
 	$this->renderPartial('vm/_vm_verifier');
 } 

// approver
 if (in_array($_SESSION['role_id'],array('84'))) {
 	$this->renderPartial('vm/_vm_approver');
 } 

 if (in_array($_SESSION['role_id'],array('85'))) {
 	$this->renderPartial('vm/_vm_support');
 } 

  if (in_array($_SESSION['role_id'],array('86'))) {
 	$this->renderPartial('vm/_vm_admin');
 } 

  if (in_array($_SESSION['role_id'],array('95'))) {
 	$this->renderPartial('vm/_vm_casheir');
 } 
 ?>

</div>
</div>
