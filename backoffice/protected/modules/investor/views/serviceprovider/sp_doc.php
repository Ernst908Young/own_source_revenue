<title>Service Provider Document Upload</title>
<style type="text/css">
  .form-part.bussiness-det .form-group > div {
    margin-bottom: 0px;
}
.form-control-feedback{
  color: red;
}
.select-box:after {
    border: 0;
}
.spdoc{
	border: 1px solid black;
	padding: 5px;
	text-align: center;
}
</style>

<div class="dashboard-home">
    <div class="applied-status">
    	<ul class="breadcrumb">
          <li><a href="/backoffice/investor/home/investorWalkthrough">Dashboard</a></li>
        
          <li>Documents</li>
          </ul>
        
             </div>
      

        <div class="m-wizard m-wizard--3 m-wizard--success" id="m_wizard">
<div class="reservation-form">  
	<?php 

//echo $_SESSION['RESPONSE']['agent_user_id'];
          $files_arr = [];
          $user_id = $_SESSION['RESPONSE']['agent_user_id'];  
          $filesdoc = Yii::app()->db->createCommand("SELECT * FROM sso_sp_documents WHERE user_id=".$user_id)->queryAll(); 
          foreach ($filesdoc as $key => $value) {
            $files_arr[] = $value;
          
        } 

        if(!empty($files_arr)){

        ?>
 <div class="form-part bussiness-det">   
 	 <h4 class="form-heading">Uploaded Documents</h4>

	<div class="form-row row">
    <div class="col-md-12 mb-3">
			<?php 
			foreach ($files_arr as $f => $d) { 
					
					?>

					<a target="_blank" href="/backoffice/doc/mydoc?view=<?php echo DefaultUtility::getDockey($d['file_path']); ?>&from=ticket"style="color:blue;">
                       Document <?= ($f+1)?>,
                    </a>

					<!-- echo  '<a target="_blank" href="'.$d['msgfilepath'].'" style="color:blue;">Documnet '.($f+1).', </a>'; -->
				<?php }
					?>
			
      </div>
	</div>
</div>
<?php } ?>
<form id="spdoc_form" method="post"  enctype="multipart/form-data">






    <div class="form-part bussiness-det">   
        <h4 class="form-heading">Upload Supporting Documents</h4>
       
<div class="form-row">
               <div class="col-lg-12 form-group text-start">                    
                <label>Upload Supporting Document</label>
            </div>
				     <input type="file" id="input-id" name="input-100[]" multiple  accept="image/*, application/pdf"> 

	   	      <small><i>(Supported Format .PDF, .JPG, .PNG.  Maximum file size allowed 5 MB)</i></small>
	   	      
              </div> 
           
           
        </div>
        
   
       </form>
</div>            

</div>
  </div>
	
	 

	
	   







<script type="text/javascript">
	$(document).ready(function(){
	
$("#input-id").fileinput({
        uploadUrl: "/backoffice/investor/services/fileupload",
        enableResumableUpload: true,
        showCaption:false,
        showRemove:false,
         showCancel: false,
         showUpload:true,
        resumableUploadOptions: {        
        },
        uploadExtraData: {
            'uploadToken': 'SOME-TOKEN', 
        },
        maxFileCount: 5,
         maxFileSize: 5000,
        allowedFileTypes: ['image','pdf'],   
        initialPreviewAsData: true,
        overwriteInitial: false,     
        theme: 'fas',
        deleteUrl: "http://localhost/file-delete.php"
    });
$(".kv-fileinput-error, .fileinput-remove").hide();




		

		
	});

	
</script>

<script src="/backoffice/themes/swcsNewTheme/fb/vendors/base/vendors.bundle.js" type="text/javascript"></script>
<script src="/backoffice/themes/swcsNewTheme/fb/demo/default/base/scripts.bundle.js" type="text/javascript"></script>
<script src="/backoffice/themes/swcsNewTheme/fb/demo/default/custom/components/forms/wizard/ticketwizard.js" type="text/javascript"></script>
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


 
<!-- default icons used in the plugin are from Bootstrap 5.x icon library (which can be enabled by loading CSS below) -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.min.css" crossorigin="anonymous">
 
<!-- alternatively you can use the font awesome icon library if using with `fas` theme (or Bootstrap 4.x) by uncommenting below. -->
<!-- link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" crossorigin="anonymous" -->
 
<!-- the fileinput plugin styling CSS file -->
<link href="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.2/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
 
<!-- if using RTL (Right-To-Left) orientation, load the RTL CSS file after fileinput.css by uncommenting below -->
<!-- link href="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.2/css/fileinput-rtl.min.css" media="all" rel="stylesheet" type="text/css" /-->
 
 
<!-- piexif.min.js is needed for auto orienting image files OR when restoring exif data in resized images and when you
    wish to resize images before upload. This must be loaded before fileinput.min.js -->
<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.2/js/plugins/piexif.min.js" type="text/javascript"></script>
 
<!-- sortable.min.js is only needed if you wish to sort / rearrange files in initial preview. 
    This must be loaded before fileinput.min.js -->
<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.2/js/plugins/sortable.min.js" type="text/javascript"></script>
 
<!-- bootstrap.bundle.min.js below is needed if you wish to zoom and preview file content in a detail modal
    dialog. bootstrap 5.x or 4.x is supported. You can also use the bootstrap js 3.3.x versions. -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
 
<!-- the main fileinput plugin script JS file -->
<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.2/js/fileinput.min.js"></script>
 
<!-- following theme script is needed to use the Font Awesome 5.x theme (`fas`). Uncomment if needed. -->
<!-- script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.2/themes/fas/theme.min.js"></script -->
 
<!-- optionally if you need translation for your language then include the locale file as mentioned below (replace LANG.js with your language locale) -->
<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.2/js/locales/LANG.js"></script>

