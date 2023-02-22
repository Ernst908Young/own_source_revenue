<!DOCTYPE html>
<html lang="en-US">
	<head>
		<title>Please wait...</title>
		<style type="text/css">
			body, html{
				background-color:#dedede;
			}
		</style>
	</head>
	<body>
		<?php
		if($data && $app_url){
		?>
		<h1>Please wait...</h1>
		<div>
		<form id='formid' method="post" action="<?=$app_url; ?>" >
			<?php foreach($data as $key=>$value){ ?>
			<p><input type="hidden" value='<?php echo @$value; ?>' name="<?php echo @$key; ?>" /></p>
			<?php } ?>
			<input type="submit" value="Click me if you are stuck on this page" >
		</form>
		</div>
		<script type="text/javascript">
			document.getElementById('formid').submit();
		</script>
		<?php }else{ ?>
		<h1>Error...</h1>
		<p>Please try again. Something went wrong.</p>
		<?php } ?>
	</body>
</html>