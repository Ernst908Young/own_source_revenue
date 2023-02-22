<?php
/* Rahul Kumar 29062018 */

/* Including Header  */
include($_SERVER["DOCUMENT_ROOT"].'/panchayatiraj/themes/investuk/header.php');
/* End Of Adding Header */

$controller=Yii::app()->controller;
$action=$controller->action;

//Getting the current action
?>
<div class="inner-header">
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<h2 class="pageTitle"></h2>
				<ul class="inner-header-breadcrum">
					<li><a href="#">You are now on</a></li>
					<li class="pageTitle"></li>
				</ul>
			</div>
		</div>
	</div>
</div>
<div class="body_section">
	<div class="container">
		<div class="mid-section">
			<?php
			///echo 'document '.$_SERVER["DOCUMENT_ROOT"];
				/* Including Inner Content */
				echo $content;
				/* End of Adding Inner Content */
			?>
		</div>
	</div>
</div>
<?php
/* Including Footer  */
include($_SERVER["DOCUMENT_ROOT"].'/panchayatiraj/themes/investuk/footer.php');
/* End of Adding Footer */
?>

<script>
    $(window).load(function(){
     var pt=  $(".page-title").html();
        $(".pageTitle").html(pt);
        $(".main-header").css('display','none');
    });
    $(document).ready(function(){
     var pt=  $(".page-title").html();
        $(".pageTitle").html(pt);
        $(".main-header").css('display','none');

    });
</script>
