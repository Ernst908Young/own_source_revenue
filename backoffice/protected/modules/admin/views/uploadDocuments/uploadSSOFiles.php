<section class="site-min-height wrapper">
		<div class="row">
		    <div class="col-lg-12">
		        <section class="panel">
		            <header class="panel-heading">
		               Upload Investor File
		                 <span class="tools pull-right">
		                   <a href="javascript:;" class="fa fa-chevron-down"></a>
		                   <a href="javascript:;" class="fa fa-times"></a>
		               	 </span>
		            </header>
		            <div class="panel-body">
		                <form action="<?php echo Yii::app()->createAbsoluteUrl('/admin/uploadDocuments/uploadSSODeptFiles');?>" method="post" enctype='multipart/form-data' name='upload_investor_form' class="tasi-form">
		                        <div class="form-inline">
		                            <label class="control-label col-md-3">Select File</label>
		                            <div class="controls">
		                                <div class="fileupload fileupload-new col-md-3" data-provides="fileupload">
		                                  <span class="btn btn-white btn-file">
		                                  <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select file</span>
		                                  <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
		                                  <input type="file" name='investor_form' required class="default" />
		                                  </span>
		                                    <span class="fileupload-preview" style="margin-left:5px;"></span>
		                                    <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none; margin-left:5px;"></a>
		                                </div>
		                                <?php 
		                                	if(is_object($model))
		                                		echo "<input type='hidden' name='submission_id' value='".$model->sno."'>";
		                                ?>
		                                <input type="submit" class="btn btn-primary fa fa-upload" value="upload">
		                            </div>
		                        </div>
		                  </form>
		                  <div class="row">&nbsp;</div>
			                  <a class="btn btn-success" href="<?php echo Yii::app()->createAbsoluteUrl('/admin/uploadDocuments');?>">Back</a>
		            </div>
		        </section>
		    </div>
		</div>
</section>