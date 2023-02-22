<section class="panel site-min-height">
   <div class="panel-body">
      <a href="#downloadId" data-toggle="modal" class="btn btn-xs btn-success">
      Enter Application Submission Id
      </a>
   </div>
   <div aria-hidden="true" aria-labelledby="downloadId" role="dialog" tabindex="-1" id="downloadId" class="modal fade">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
            <h4 class="modal-title">Applications</h4>
         </div>
         <div class="modal-body">
            <?php
               foreach (Yii::app()->user->getFlashes() as $key => $message) {
                   if ($key == 'Error') {
               ?>
            <div class="alert alert-block alert-danger fade in">
               <button data-dismiss="alert" class="close close-sm" type="button">
               <i class="fa fa-times"></i>
               </button>
               <?php
                  } else {
                      echo "<div class='alert alert-info fade in'>
                                  <button data-dismiss='alert' class='close close-sm' type='button'>
                                      <i class='fa fa-times'></i>
                                  </button>";
                  }
                  
                  echo $message . "</div>\n";
                  }
                  ?>
               <form role="form" action="<?php echo Yii::app()->createAbsoluteUrl('admin/downloadAllDocuments');?>" method="post">
                  <div class="form-group">
                     <label for="exampleInputEmail1">Enter Application Submission Id</label>
                     <input type="number" class="form-control" id="application_id" name="Applications[application_id]" placeholder="Enter Application Submission Id">
                  </div>
                  <button type="submit" class="btn btn-default">Submit</button>
               </form>
            </div>
         </div>
      </div>
   </div>
   <?php 
      if(isset($is_data)){
      	?>
   <header class="panel-heading tab-bg-dark-navy-blue">
      <ul class="nav nav-tabs nav-justified ">
         <li class="active">
            <a href="#investor" data-toggle="tab">
            Investor's Documents
            </a>
         </li>
         <li>
            <a href="#verifier" data-toggle="tab">
            Verifier's Documents
            </a>
         </li>
         <li>
            <a href="#application" data-toggle="tab">
            Application
            </a>
         </li>
      </ul>
   </header>
   <div class="panel-body">
      <div class="tab-content tasi-tab">
         <div class="tab-pane active" id="investor">
            <div class="adv-table">
               <table  class="display table table-bordered table-striped" id="all_applications">
                  <thead>
                     <tr>
                        <th>Document Name</th>
                        <th><i class='fa fa-download'></i>Download</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php 
                        if(!empty($doc)){
                        	foreach ($doc as $doc) {
                        		echo "<tr>
                        					<td>$doc[doc_name]</td>
                        			  		<td><a href='data:".$doc['doc_type'].";base64, $doc[doc_blob_data]' download='$doc[doc_name]";
                        			  		if($doc['doc_type']=='image/jpeg')
                        			  		   echo ".jpg";
                        			  		if($doc['doc_type']=='application/pdf')
                        			  		   echo ".pdf";
                        			  		echo "'>Download</a></td>
                        			  </tr>";
                        	}
                        }
                        ?>
                  </tbody>
               </table>
            </div>
         </div>
         <div class="tab-pane" id="verifier">
            <div class="adv-table">
               <table  class="display table table-bordered table-striped" id="all_applications">
                  <thead>
                     <tr>
                        <th>Document Name</th>
                        <th>Download</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php 
                        if(!empty($verifier_docs)){
                        	foreach ($verifier_docs as $doc) {
                        		echo "<tr>
                        					<td>".$doc->document_name."</td>
                        			  		<td><a href='data:".$doc->document_name.";base64, ".$doc->document."' download='".$doc->document_mime_type;
                        			  		if($doc->document_mime_type=='image/jpeg')
                        			  		   echo ".jpg";
                        			  		if($doc->document_mime_type=='application/pdf')
                        			  		   echo ".pdf";
                        			  		echo "'>Download</a></td>
                        			  </tr>";
                        	}
                        }
                        ?>
                  </tbody>
               </table>
            </div>
         </div>
         <div class="tab-pane" id="application">
            <div class="adv-table">
            	<?php 
            	   echo "&nbsp;<a target='_blank' href='".Yii::app()->createAbsoluteUrl('admin/ApplicationView/downloadAppAny/id/'). "/".$app_sub_id."/name/".$app_name."'> Click here to download</a>";
            	   ?>
            </div>
        </div>
      </div>
   </div>
   <?php
      }
      
      ?>
</section>
<?php
   if(!isset($is_data)){
   ?>
<script type="text/javascript">
   $('document').ready(function(){
   	$('#downloadId').modal("show");
   })
</script>
<?php
}
