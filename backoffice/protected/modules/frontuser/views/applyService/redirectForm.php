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
		<?php /* echo "<pre>"; print_r($data);die;  */
		if($data && $app_url)
		{
                    
		?>
			<h1>Please wait...</h1>
			<div>
				<?php 
				if(isset($data['stype']) && !empty($data['stype'])){
					$app_url = $app_url.'/stype/'.$data['stype'];
					
				?>
					<form id='formid' method="post" action="<?=$app_url; ?>">
				<?php }else{ ?>
					<form id='formid' method="post" action="<?=$app_url; ?>">
				<?php } ?>
					<?php foreach($data as $key=>$value){ ?>
					<p><input type="hidden" value='<?php echo @$value; ?>' name="<?php echo @$key; ?>" /></p>
					<?php } ?>								
					<?php if(isset($data['service_id']) && in_array($data['service_id'],array('47','282','283'))){
					?>
					<p><input type="hidden" value="<?php echo $_SESSION['RESPONSE']['user_id'].time(); ?>" name="app_id" /></p>
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