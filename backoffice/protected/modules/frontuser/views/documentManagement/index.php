<link href="/backoffice/themes/swcsNewTheme/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="/backoffice/themes/swcsNewTheme/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
<link href="/backoffice/themes/swcsNewTheme/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
<link href="/backoffice/themes/swcsNewTheme/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
<link href="/backoffice/themes/swcsNewTheme/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="/backoffice/themes/swcsNewTheme/css/demo.css">
<link rel="stylesheet" type="text/css" href="/backoffice/themes/swcsNewTheme/css/component.css">
<style>
.showErrors li,p{text-align:left;margin-bottom:5px;}
</style>
<section class="panel site-min-height">
    <header class="panel-heading">
        Document Management
    </header>
    <div class="panel-body">
       
<?php // session_start(); echo '<pre>'; print_r($_SESSION); ?>
        <!-- <form class="form-horizontal" role="form" action="http://www.swcs.dev/backoffice/frontuser/application_form/RedirectToApplicationWithCaf" method="post"> -->
            <div class="form-group">
                <div class="row">
                  <div class="col-lg-12 label label-danger showErrorsDiv" style="display: none">
                        <span style="color:#fff;font-size: 1.5em" class="showErrors"></span>
                  </div>
                </div>
                <div class="row"><br></div>
                <div class="row">
				<label for="inputEmail1" class="col-lg-2 col-sm-2 control-label">Document Check List </label>
                <div class="col-lg-4">
                  <select class="form-control selectCAF" name="PrevCaf[CafID]" id="">
						<option value="">---Select Document Check List---</option>
						<option value="22">Pan Card (UK-DCL-2)</option>
						<option value="22">Aadhar Card (UK-DCL-3)</option>
						<option value="22">DL (UK-DCL-4)</option>
						<option value="22">Passport (UK-DCL-5)</option>
				  </select>
                </div>
				</div>
				
				<div class="row">
				<label for="inputEmail1" class="col-lg-2 col-sm-2 control-label">Document Check List </label>
                <div class="col-lg-4">
                  <select class="form-control selectCAF" name="PrevCaf[CafID]" id="">
						<option value="">---Select Document Check List---</option>
						<option value="22">Pan Card (UK-DCL-2)</option>
						<option value="22">Aadhar Card (UK-DCL-3)</option>
						<option value="22">DL (UK-DCL-4)</option>
						<option value="22">Passport (UK-DCL-5)</option>
				  </select>
                </div>
				</div>
				
				<div class="col-lg-3">
                  <input type="file" required="" style="display:none" name="caf_applications_uploads" class="inputfile inputfile-1" id="caf_applications_uploads_0">
				  <label for="caf_applications_uploads_0">
					<i class="fa fa-upload btn btn-primary"></i> <span>Choose a file…</span>
				  </label>
                          
                </div>
				<div class="col-lg-3">
                      &nbsp;<input value="Upload" class="btn btn-primary" type="submit">    
                </div>
            </div>
            <div class="row col-lg-12" style="border-top:1px solid red;"><br><br></div>
            <table id="pending_application" class="table table-striped table-bordered">
                            <thead>
                              <tr>
                                <th style="width:5%">S.No.</th>
                                <th style="width:15%">Document Name</th>
                                <th style="width:20%">Upload New Doc</th>
                                <th style="width:20%">Uploaded Document</th>
                                <th style="width:5%">Version</th>
                                <th style="width:5%">Status</th>
                                <th style="width:25%;text-align:center;">Actions</th>
                                <th style="width:5%">Select Doc</th>
                              </tr>
                            </thead>
                            <tbody><tr>
                      <td rowspan="2">1</td>
                      <td rowspan="2">* Land Owner Test Doc</td><td rowspan="2"><form action="http://www.swcs.dev/backoffice/frontuser/application_form/uploadInvestorDocuments" onsubmit="ShowLoader()" method="POST" enctype="multipart/form-data"><input type="hidden" name="selected_doc_type" value="application/pdf">                      <input type="hidden" name="PrevCaf[CALL_BACK_URL]" value="http://www.swcs.dev/backoffice/frontuser/application_form/redirectToApplicationDelete/service_id/7/application/7/service_provider/test/service_name/test4/service_tag/dGVzdA==">
                      <input type="hidden" name="PrevCaf[service_id]" value="7">
                      <input type="hidden" name="PrevCaf[service_name]" value="test4">
                      <input type="hidden" name="PrevCaf[service_tag]" value="test">
                      <input type="hidden" name="FileUpload[max_size]" value="25000">
                    <input type="hidden" name="FileUpload[doc_id]" value="98">
                          <input type="hidden" name="FileUpload[application_id]" value="7">
                          <input type="hidden" name="FileUpload[document_version]" value="2">
                          <input type="hidden" name="FileUpload[YII_CSRF_TOKEN]" value="Y0YyUlprRWlaakxtOHkzMndyNmp3RV8yZ1FTcm1PQTGRwV6Ot-VtBcR-cXxiSYAGLIyUfptDvMQjbvG5bNMfmw==">
                          <input type="file" required="" style="display:none" name="caf_applications_uploads" class="inputfile inputfile-1" id="caf_applications_uploads_0">
                          <label for="caf_applications_uploads_0">
                            <i class="fa fa-upload"></i> <span>Choose a file…</span>
                          </label>
                          &nbsp;<input value="Upload" class="btn btn-primary" type="submit">
                      </form></td><td><i class="text-danger fa fa fa-file-pdf-o"></i> Test_document_PDF_2_1.pdf</td><td>2.0</td><td><span class="btn btn-sm btn-danger"><i class="fa fa-times"></i>  Rejected</span></td><td><a class="btn btn-sm btn-warning" href="http://www.swcs.dev/backoffice/frontuser/application_form/downloadInvestorDocument/document/MzYyMw==" title="Download Document"> <i class="fa fa-download"></i> Download</a>
                            <a data-toggle="modal" data-target=".bs-example-modal-lg" class="btn btn-info btn-shadow" href="#" title="Get Document Info" onclick="documentInfo(&quot;Land Owner Test Doc&quot;,&quot;3623&quot;,&quot;Test_document_PDF_2_1.pdf&quot;,&quot;application/pdf&quot;,&quot;2&quot;,&quot;Rejected&quot;,&quot;2017-07-28 10:07:26&quot;)"><i class="fa fa-info"> </i> Get Info</a>
                          </td>
                          <td>&nbsp;</td>
                          </tr><tr><td><i class="text-danger fa fa fa-file-pdf-o"></i> Output.pdf</td><td>1.0</td><td><span class="btn btn-sm btn-info"><i class="fa fa-info"></i>  Pending</span></td><td><a class="btn btn-sm btn-warning" href="http://www.swcs.dev/backoffice/frontuser/application_form/downloadInvestorDocument/document/MzYyMQ==" title="Download Document"> <i class="fa fa-download"></i> Download</a>
                            <a data-toggle="modal" data-target=".bs-example-modal-lg" class="btn btn-info btn-shadow" href="#" title="Get Document Info" onclick="documentInfo(&quot;Land Owner Test Doc&quot;,&quot;3621&quot;,&quot;Output.pdf&quot;,&quot;application/pdf&quot;,&quot;1&quot;,&quot;Pending&quot;,&quot;2017-07-28 07:07:07&quot;)"><i class="fa fa-info"> </i> Get Info</a>
                          </td>
                          <td><input type="radio" class="selectDoc_98" name="selectedDoc_98" required="" value="98~3621~Output.pdf~application/pdf~P~1"></td>
                          </tr><tr>
                      <td rowspan="1">2</td>
                      <td rowspan="1"> Land Owner Test Doc</td><td rowspan="1"><form action="http://www.swcs.dev/backoffice/frontuser/application_form/uploadInvestorDocuments" onsubmit="ShowLoader()" method="POST" enctype="multipart/form-data"><input type="hidden" name="selected_doc_type" value="application/pdf">                      <input type="hidden" name="PrevCaf[CALL_BACK_URL]" value="http://www.swcs.dev/backoffice/frontuser/application_form/redirectToApplicationDelete/service_id/7/application/7/service_provider/test/service_name/test4/service_tag/dGVzdA==">
                      <input type="hidden" name="PrevCaf[service_id]" value="7">
                      <input type="hidden" name="PrevCaf[service_name]" value="test4">
                      <input type="hidden" name="PrevCaf[service_tag]" value="test">
                      <input type="hidden" name="FileUpload[max_size]" value="25000">
                    <input type="hidden" name="FileUpload[doc_id]" value="99">
                          <input type="hidden" name="FileUpload[application_id]" value="7">
                          <input type="hidden" name="FileUpload[document_version]" value="1">
                          <input type="hidden" name="FileUpload[YII_CSRF_TOKEN]" value="Y0YyUlprRWlaakxtOHkzMndyNmp3RV8yZ1FTcm1PQTGRwV6Ot-VtBcR-cXxiSYAGLIyUfptDvMQjbvG5bNMfmw==">
                          <input type="file" required="" style="display:none" name="caf_applications_uploads" class="inputfile inputfile-1" id="caf_applications_uploads_1">
                          <label for="caf_applications_uploads_1">
                            <i class="fa fa-upload"></i> <span>Choose a file…</span>
                          </label>
                          &nbsp;<input value="Upload" class="btn btn-primary" type="submit">
                      </form></td><td><i class="text-danger fa fa fa-file-pdf-o"></i> Test_document_PDF_2.pdf</td><td>1.0</td><td><span class="btn btn-sm btn-info"><i class="fa fa-info"></i>  Pending</span></td><td><a class="btn btn-sm btn-warning" href="http://www.swcs.dev/backoffice/frontuser/application_form/downloadInvestorDocument/document/MzYyMA==" title="Download Document"> <i class="fa fa-download"></i> Download</a>
                            <a data-toggle="modal" data-target=".bs-example-modal-lg" class="btn btn-info btn-shadow" href="#" title="Get Document Info" onclick="documentInfo(&quot;Land Owner Test Doc&quot;,&quot;3620&quot;,&quot;Test_document_PDF_2.pdf&quot;,&quot;application/pdf&quot;,&quot;1&quot;,&quot;Pending&quot;,&quot;2017-07-28 07:07:31&quot;)"><i class="fa fa-info"> </i> Get Info</a>
                          </td>
                          <td><input type="radio" class="selectDoc_99" name="selectedDoc_99" required="" value="99~3620~Test_document_PDF_2.pdf~application/pdf~P~1"></td>
                          </tr><tr>
                      <td rowspan="1">3</td>
                      <td rowspan="1">* Aadhar Card For Service</td><td rowspan="1"><form action="http://www.swcs.dev/backoffice/frontuser/application_form/uploadInvestorDocuments" onsubmit="ShowLoader()" method="POST" enctype="multipart/form-data"><input type="hidden" name="selected_doc_type" value="application/pdf">                      <input type="hidden" name="PrevCaf[CALL_BACK_URL]" value="http://www.swcs.dev/backoffice/frontuser/application_form/redirectToApplicationDelete/service_id/7/application/7/service_provider/test/service_name/test4/service_tag/dGVzdA==">
                      <input type="hidden" name="PrevCaf[service_id]" value="7">
                      <input type="hidden" name="PrevCaf[service_name]" value="test4">
                      <input type="hidden" name="PrevCaf[service_tag]" value="test">
                      <input type="hidden" name="FileUpload[max_size]" value="5000">
                    <input type="hidden" name="FileUpload[doc_id]" value="100">
                          <input type="hidden" name="FileUpload[application_id]" value="7">
                          <input type="hidden" name="FileUpload[document_version]" value="1">
                          <input type="hidden" name="FileUpload[YII_CSRF_TOKEN]" value="Y0YyUlprRWlaakxtOHkzMndyNmp3RV8yZ1FTcm1PQTGRwV6Ot-VtBcR-cXxiSYAGLIyUfptDvMQjbvG5bNMfmw==">
                          <input type="file" required="" style="display:none" name="caf_applications_uploads" class="inputfile inputfile-1" id="caf_applications_uploads_2">
                          <label for="caf_applications_uploads_2">
                            <i class="fa fa-upload"></i> <span>Choose a file…</span>
                          </label>
                          &nbsp;<input value="Upload" class="btn btn-primary" type="submit">
                      </form></td><td><i class="text-danger fa fa fa-file-pdf-o"></i> Test_document_PDF_2.pdf</td><td>1.0</td><td><span class="btn btn-sm btn-success"><i class="fa fa-check"></i>  Verified</span></td><td><a class="btn btn-sm btn-warning" href="http://www.swcs.dev/backoffice/frontuser/application_form/downloadInvestorDocument/document/MzYyNA==" title="Download Document"> <i class="fa fa-download"></i> Download</a>
                            <a data-toggle="modal" data-target=".bs-example-modal-lg" class="btn btn-info btn-shadow" href="#" title="Get Document Info" onclick="documentInfo(&quot;Aadhar Card For Service&quot;,&quot;3624&quot;,&quot;Test_document_PDF_2.pdf&quot;,&quot;application/pdf&quot;,&quot;1&quot;,&quot;Verified&quot;,&quot;2017-07-28 10:07:44&quot;)"><i class="fa fa-info"> </i> Get Info</a>
                          </td>
                          <td><input type="radio" class="selectDoc_100" name="selectedDoc_100" required="" value="100~3624~Test_document_PDF_2.pdf~application/pdf~V~1"></td>
                          </tr><tr>
                      <td rowspan="0">4</td>
                      <td rowspan="0"> Aadhar Card For Service</td><td rowspan="0"><form action="http://www.swcs.dev/backoffice/frontuser/application_form/uploadInvestorDocuments" onsubmit="ShowLoader()" method="POST" enctype="multipart/form-data"><input type="hidden" name="selected_doc_type" value="application/pdf">                      <input type="hidden" name="PrevCaf[CALL_BACK_URL]" value="http://www.swcs.dev/backoffice/frontuser/application_form/redirectToApplicationDelete/service_id/7/application/7/service_provider/test/service_name/test4/service_tag/dGVzdA==">
                      <input type="hidden" name="PrevCaf[service_id]" value="7">
                      <input type="hidden" name="PrevCaf[service_name]" value="test4">
                      <input type="hidden" name="PrevCaf[service_tag]" value="test">
                      <input type="hidden" name="FileUpload[max_size]" value="10000">
                    <input type="hidden" name="FileUpload[doc_id]" value="101">
                          <input type="hidden" name="FileUpload[application_id]" value="7">
                          <input type="hidden" name="FileUpload[document_version]" value="0">
                          <input type="hidden" name="FileUpload[YII_CSRF_TOKEN]" value="Y0YyUlprRWlaakxtOHkzMndyNmp3RV8yZ1FTcm1PQTGRwV6Ot-VtBcR-cXxiSYAGLIyUfptDvMQjbvG5bNMfmw==">
                          <input type="file" required="" style="display:none" name="caf_applications_uploads" class="inputfile inputfile-1" id="caf_applications_uploads_3">
                          <label for="caf_applications_uploads_3">
                            <i class="fa fa-upload"></i> <span>Choose a file…</span>
                          </label>
                          &nbsp;<input value="Upload" class="btn btn-primary" type="submit">
                      </form></td><td>NA</td>
                    <td>NA</td>
                    <td>NA</td>
                    <td>NA</td>
                    <td><input type="hidden" required="" value="" name="requiredDoc"></td></tr></tbody></table>            <div class="form-group">
                
            </div>
        
        <form id="finalFormSubmit" action="http://www.swcs.dev/backoffice/frontuser/application_form/RedirectToApplicationWithCaf" method="POST">
        </form>
        <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title text-center" id="myModalLabel"></h4>
              </div>
              <div class="modal-body">
                <div class="row">
                  <div class="col-md-12 modal_body_content">
                    
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-sm btn-default" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
    </div>
</div></section>
<!-- Datatables -->
  <script src="/backoffice/themes/swcsNewTheme/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="/backoffice/themes/swcsNewTheme/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
  <script src="/backoffice/themes/swcsNewTheme/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>

