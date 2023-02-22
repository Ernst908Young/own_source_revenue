<?php
 //for($i=1; $i<=100; $i++){
/*	Yii::app()->db->createCommand("INSERT INTO bo_infowiz_formfield_options (formfield_id, options, type, is_active, user_agent, remote_ip, created) VALUES (1121, $i, 'radio', 'Y', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36', '61.2.157.109','2021-06-30 17:06:37')")->execute();*/

/*$q = Yii::app()->db->createCommand("SELECT * FROM  bo_infowiz_formfield_options  WHERE formfield_id=969 ORDER BY id ASC")->queryAll();
foreach($q as $val){
	$id = $val['id'];
	$p = $val['options'];
	Yii::app()->db->createCommand("UPDATE  bo_infowiz_formfield_options SET prefrence= $p  WHERE id=$id")->execute();
}*/

//}
 ?> <style type="text/css">
.form-part.bussiness-det .form-group>div {
	margin-bottom: 0px;
}

.form-control-feedback {
	color: red;
}

.select-box:after {
	border: 0;
}
p.balance_count {
    font-size: 11px;
}
</style>

<div class="dashboard-home">
	<div class="applied-status">
		<ul class="breadcrumb">
			<li><a href="/panchayatiraj/backoffice/investor/home/investorWalkthrough">Home</a></li>
			<li>Asset Sub Category</li>
		</ul>
		<div class="status-title d-flex flex-wrap align-items-center justify-content-between">
			<h4>Create Asset Sub Category</h4>
			<div class="serach-bar">
			</div>
		</div>
	</div>
	<div class="m-wizard m-wizard--3 m-wizard--success" id="m_wizard">
		<div class="reservation-form"> 

			<form id="m_form" method="post" action="<?php echo Yii::app()->createAbsoluteUrl("/admin/default/subcategory"); ?>" enctype="multipart/form-data">
				<div class="form-part bussiness-det">
					<h4 class="form-heading">Add New Asset Sub Category</h4>
					<div class="form-row row">
						<div class="col-lg-6 form-group text-start mb-3">
							<label> Asset Category <span style="color: red;">*</span></label>
							<select name="category_id" placeholder="Select service category" id="servicecategory" class="select2-me" onchange="getservices($(this).val())">
								<option value="">Select Service Category </option> <?php 
							$service_category =array_merge($service_category,array(array('id'=>'0','category_name'=>'Others')));
							foreach ($service_category as $key => $val) { ?> <option value="<?php echo $val['id']; ?>"><?php echo $val['category_name']; ?></option> <?php } ?>
							</select>
						</div>	
						<div class="col-lg-6 form-group text-start mb-3">
							<label> Asset Category <span style="color: red;">*</span></label>
							<select name="asset_type" placeholder="Select service category" id="servicecategory" class="select2-me" onchange="getservices($(this).val())">
								<option value=""> Select Type</option>
								<option value="Pysical"> Pysical</option>
								<option value="Service">Service </option>
						
							</select>
						</div>
						<div class="col-lg-6 form-group text-start mb-3">
							<label> Sub Category <span style="color: red;">*</span></label>
							<input type="text" name="subcategory" class="form-control" placeholder="Sub Category" required maxlength="300" onkeyup="countChars(this,'charNumSubject',300);">
							<small style="display:none;"><span id="charNumSubject">400</span>/400 characters remaining</small>
						</div>
				
						
					</div>
					<div class="form-row row">
						<div class="form-group col-md-12" style="text-align: center;">
							<a href="javascript:void(0);" class="submitForm custome-btn" data-wizard-action="submit">
								<span>
									<i class="fa fa-check"></i> &nbsp;&nbsp; <span> Submit </span>
								</span>
							</a>
							<!--  <button type="submit" class="btn-secondary" style="font-size: 18px; width: 120px;">Submit</button> -->
						</div>
					</div>
				</div>
			
			</form>
			<div id="sample_1_wrapper" class="dataTables_wrappers dataTables_wrapper">
                <table width="100%" id='sample_1'>
                    <thead> 
                        <tr>
                            <th class="text-center">
                            <h5>SR. No.</h5>
                            </th>
                            <th class="text-center">
                            <h5>Category</h5>
                            </th>
                            <th class="text-center">
                            <h5>Asset Type</h5>
                            </th>
                            <th class="text-center">
                            <h5>Subcategory</h5>
                            </th>
                            
                        </tr>
                    </thead>
                    <tbody class="ticket-item">
                        <?php $n=1;foreach ($service_subcategory as $key => $val) { ?>    
                        <tr>
                            <td class="text-center"><?php echo $n ?></td>
                            <td class="text-center">Residential</td>
                            <td class="text-center"><?php echo $val['asset_type'] ?></td>
                            <td class="text-center"><?php echo $val['subcategory'] ?></td>
                        </tr>
                        <?php   $n++;}
                            
                        ?>
                    </tbody> 
                </table>
            </div>
		</div>
	</div>
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

<?php

   $base=Yii::app()->theme->baseUrl;

?>

<!-- BEGIN PAGE LEVEL PLUGINS -->

<script src="<?=$base?>/assets/global/scripts/datatable.js" type="text/javascript"></script>

<script src="<?=$base?>/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>

<script src="<?=$base?>/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>

<!-- <script src="<?=$base?>/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script> -->

<!-- END PAGE LEVEL PLUGINS -->

<!-- BEGIN PAGE LEVEL PLUGINS -->

<!-- <link href="<?=$base?>/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />

<link href="<?=$base?>/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" /> -->

<!-- END PAGE LEVEL PLUGINS -->

<script type="text/javascript">

   var TableDatatablesButtons = function() {

     var e = function() {

             var e = $("#sample_1");

             e.dataTable({

                 language: {

                     aria: {

                         sortAscending: ": activate to sort column ascending",

                         sortDescending: ": activate to sort column descending"

                     },

                     emptyTable: "No data available in table",

                    info: "<span style='font-size:15px'>Showing _START_ to _END_ of _TOTAL_ entries</span>",
                    infoEmpty: "<span style='font-size:15px'>No entries found</span>",
                    infoFiltered: "<span style='font-size:15px'>(filtered1 from _MAX_ total entries)</span>",
                    lengthMenu: "<span style='font-size:15px; font-weight:100; margin-top:5px;'>Entries:</span>  <span style='margin-left:5px;'>_MENU_ </span>",
                    search: "<span style='font-size:15px; font-weight:100; margin-top:5px;'>Search:</span>",

                     zeroRecords: "No matching records found"

                 },

                 buttons: [],

                 responsive: !0,

                 "ordering": false,


                 lengthMenu: [

                     [5, 10, 15, 20, -1],

                     [5, 10, 15, 20, "All"]

                 ],

                 pageLength: 10,

                 dom: "<'row'<'col-md-6 col-sm-12 form-group'l><'col-md-6 col-sm-12 form-group'f>r><'mb-3't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>"

             })

         },

     

         n = function() {

            
             var e = new Datatable;

             e.init({

                 src: $("#datatable_ajax"),

                 onSuccess: function(e, t) {},

                 onError: function(e) {},

                 onDataLoad: function(e) {},

                 loadingMessage: "Loading...",

                 dataTable: {

                     bStateSave: !0,

                     lengthMenu: [

                         [10, 20, 50, 100, 150, -1],

                         [10, 20, 50, 100, 150, "All"]

                     ],

                     pageLength: 10,

                     ajax: {

                         url: "../demo/table_ajax.php"

                     },

                     "ordering": false,


                     buttons: []

                 }

             }), e.getTableWrapper().on("click", ".table-group-action-submit", function(t) {

                 t.preventDefault();

                 var a = $(".table-group-action-input", e.getTableWrapper());

                 "" != a.val() && e.getSelectedRowsCount() > 0 ? (e.setAjaxParam("customActionType", "group_action"), e.setAjaxParam("customActionName", a.val()), e.setAjaxParam("id", e.getSelectedRows()), e.getDataTable().ajax.reload(), e.clearAjaxParams()) : "" == a.val() ? App.alert({

                     type: "danger",

                     icon: "warning",

                     message: "Please select an action",

                     container: e.getTableWrapper(),

                     place: "prepend"

                 }) : 0 === e.getSelectedRowsCount() && App.alert({

                     type: "danger",

                     icon: "warning",

                     message: "No record selected",

                     container: e.getTableWrapper(),

                     place: "prepend"

                 })

             }), $("#datatable_ajax_tools > li > a.tool-action").on("click", function() {

                 var t = $(this).attr("data-action");

                 e.getDataTable().button(t).trigger()

             })

         };

     return {

         init: function() {

             jQuery().dataTable && (e(), n())

         }

     }

   }();

   jQuery(document).ready(function() {

     TableDatatablesButtons.init();
   /* $("#sample_1_length").find("label").attr('style','font-size:15px; font-weight:100;');
    $("#sample_1_length").find("select").attr("style","width:50px; margin-left:5px;");

    $("#sample_1_filter").find("label").attr('style','font-size:15px; font-weight:100;');
    $("#sample_1_filter").find("input").attr("placeholder",'Search by keywords');
    $("#sample_1_info").attr("style","font-size:15px; margin-top:10px;");
    $("#sample_1_paginate").attr("style",'margin-top:15px;');*/
   });

</script>   