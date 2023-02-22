<?php

$roleInfo=$this->getUserInfo($model->uid);

?>

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

		<h1>Please wait...</h1>

		<div>

		<form id='formid' method="post" action="http://uksubsidy.in/subsidyauth.php" >
		<input type="hidden" name="token" value="<?=$token?>">
		

		</form>

		</div>

		<script type="text/javascript">

			document.getElementById('formid').submit();

		</script>

	</body>

</html>